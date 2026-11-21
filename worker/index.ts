// Serves the static site and handles the contact form.
// POST /api/contact sends the message to Lester through Cloudflare Email Service.
// Everything else falls through to the static assets in ./dist.

interface Env {
  ASSETS: Fetcher;
  EMAIL: { send(message: Record<string, unknown>): Promise<{ messageId: string }> };
}

const FROM = 'hello@lesterbarahona.com';
const TO = 'lestermiller26@gmail.com';
const MAX = { name: 120, email: 200, message: 5000 };
const EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

function reply(request: Request, ok: boolean, message: string, status: number): Response {
  if ((request.headers.get('accept') ?? '').includes('application/json')) {
    return Response.json({ ok, message }, { status });
  }
  // Plain form post without JavaScript: go back to the contact section with the outcome.
  const url = new URL('/', request.url);
  url.searchParams.set('contact', ok ? 'sent' : 'error');
  url.hash = 'contact';
  return Response.redirect(url.toString(), 303);
}

async function contact(request: Request, env: Env): Promise<Response> {
  const origin = request.headers.get('origin');
  if (origin && new URL(origin).host !== new URL(request.url).host) {
    return reply(request, false, 'This form only accepts messages sent from this site.', 403);
  }

  let form: FormData;
  try {
    form = await request.formData();
  } catch {
    return reply(request, false, 'The form could not be read. Try again.', 400);
  }

  const name = String(form.get('name') ?? '').trim();
  const email = String(form.get('email') ?? '').trim();
  const message = String(form.get('message') ?? '').trim();

  // "company" is hidden from people; only bots fill it in. Report success and send nothing.
  if (String(form.get('company') ?? '') !== '') {
    return reply(request, true, 'Sent. I reply within one business day.', 200);
  }

  if (!name || !message || !EMAIL_RE.test(email)) {
    return reply(request, false, 'Add your name, a valid email address and a message.', 400);
  }
  if (name.length > MAX.name || email.length > MAX.email || message.length > MAX.message) {
    return reply(request, false, 'That message is too long. Shorten it and send again.', 400);
  }

  try {
    await env.EMAIL.send({
      to: TO,
      from: { email: FROM, name: 'lesterbarahona.com contact form' },
      replyTo: email,
      subject: `Website message from ${name.replace(/[\r\n]+/g, ' ')}`,
      text: `From: ${name} <${email}>\n\n${message}\n`,
    });
  } catch (err) {
    console.error('contact form send failed', err);
    return reply(request, false, `The message could not be sent. Email ${FROM} instead.`, 502);
  }
  return reply(request, true, 'Sent. I reply within one business day.', 200);
}

export default {
  async fetch(request: Request, env: Env): Promise<Response> {
    const { pathname } = new URL(request.url);
    if (pathname === '/api/contact') {
      if (request.method !== 'POST') return new Response('Method not allowed', { status: 405, headers: { allow: 'POST' } });
      return contact(request, env);
    }
    return env.ASSETS.fetch(request);
  },
};
