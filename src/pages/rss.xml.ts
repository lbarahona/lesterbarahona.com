import rss from '@astrojs/rss';
import { getCollection } from 'astro:content';
import type { APIContext } from 'astro';

export async function GET(context: APIContext) {
  const posts = (await getCollection('blog')).sort((a, b) => b.data.date.valueOf() - a.data.date.valueOf());
  return rss({
    title: 'Lester Barahona',
    description: 'Write-ups on SRE, Kubernetes, migrations and AI agents for operations.',
    site: context.site!,
    items: posts.map((post) => ({
      title: post.data.title,
      pubDate: post.data.date,
      description: post.data.description,
      link: `/${post.id}/`,
    })),
  });
}
