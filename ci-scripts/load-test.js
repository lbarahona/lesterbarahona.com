import http from 'k6/http';
import { check, sleep } from 'k6';
import { Rate, Trend, Counter } from 'k6/metrics';

// Custom metrics
const errorRate = new Rate('errors');
const pageLoadTime = new Trend('page_load_time');
const httpReqs = new Counter('http_reqs_total');

// Test configuration
export const options = {
  scenarios: {
    // Gradual ramp-up test
    ramp_up: {
      executor: 'ramping-vus',
      startVUs: 1,
      stages: [
        { duration: '2m', target: 10 }, // Ramp up to 10 users over 2 minutes
        { duration: '3m', target: 10 }, // Stay at 10 users for 3 minutes
        { duration: '1m', target: 0 },  // Ramp down over 1 minute
      ],
      gracefulRampDown: '30s',
    },
    
    // Spike test
    spike_test: {
      executor: 'ramping-vus',
      startTime: '6m',
      startVUs: 0,
      stages: [
        { duration: '30s', target: 50 }, // Sudden spike to 50 users
        { duration: '30s', target: 50 }, // Hold for 30 seconds
        { duration: '30s', target: 0 },  // Back to 0
      ],
      gracefulRampDown: '30s',
    },
  },
  
  // Performance thresholds
  thresholds: {
    http_req_duration: [
      'p(95)<2000', // 95% of requests should be below 2s
      'p(99)<5000', // 99% of requests should be below 5s
    ],
    http_req_failed: ['rate<0.02'], // Error rate should be less than 2%
    errors: ['rate<0.05'], // Custom error rate threshold
    page_load_time: ['avg<1500'], // Average page load time under 1.5s
  },
};

const BASE_URL = __ENV.TARGET_URL || 'https://lesterbarahona.com';

// Test pages to check
const pages = [
  '/',
  '/about',
  '/feed',
  '/sitemap.xml',
  '/robots.txt',
];

export default function () {
  // Simulate realistic user behavior
  const page = pages[Math.floor(Math.random() * pages.length)];
  const url = `${BASE_URL}${page}`;
  
  // Set realistic headers
  const params = {
    headers: {
      'User-Agent': 'k6-load-test/1.0 (Performance Testing)',
      'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
      'Accept-Language': 'en-US,en;q=0.5',
      'Accept-Encoding': 'gzip, deflate',
      'Connection': 'keep-alive',
      'Upgrade-Insecure-Requests': '1',
    },
    timeout: '30s',
  };
  
  // Record start time
  const startTime = new Date().getTime();
  
  // Make request
  const response = http.get(url, params);
  httpReqs.add(1);
  
  // Calculate page load time
  const loadTime = new Date().getTime() - startTime;
  pageLoadTime.add(loadTime);
  
  // Perform checks
  const checkResult = check(response, {
    'status is 200': (r) => r.status === 200,
    'response time < 3000ms': (r) => r.timings.duration < 3000,
    'content type is HTML': (r) => r.headers['Content-Type'] && r.headers['Content-Type'].includes('text/html'),
    'response has content': (r) => r.body.length > 0,
    'no server errors in content': (r) => !r.body.includes('Fatal error') && !r.body.includes('Warning:'),
    'page title present': (r) => r.body.includes('<title>'),
    'charset declared': (r) => r.body.includes('charset=') || r.headers['content-type'].includes('charset'),
  });
  
  // Track errors
  if (!checkResult) {
    errorRate.add(1);
    console.log(`Error on ${url}: Status ${response.status}, Duration ${response.timings.duration}ms`);
  } else {
    errorRate.add(0);
  }
  
  // Additional checks for specific pages
  if (page === '/') {
    check(response, {
      'homepage has navigation': (r) => r.body.includes('nav') || r.body.includes('menu'),
      'homepage has footer': (r) => r.body.includes('footer'),
    });
  }
  
  if (page === '/about') {
    check(response, {
      'about page has content': (r) => r.body.includes('about') || r.body.includes('About'),
    });
  }
  
  if (page === '/feed') {
    check(response, {
      'RSS feed is valid XML': (r) => r.body.includes('<?xml') && r.body.includes('<rss'),
    });
  }
  
  if (page === '/sitemap.xml') {
    check(response, {
      'sitemap is valid XML': (r) => r.body.includes('<?xml') && r.body.includes('<urlset'),
    });
  }
  
  // Simulate reading time (1-5 seconds)
  sleep(Math.random() * 4 + 1);
}

// Setup function - runs once before the test
export function setup() {
  console.log(`Starting load test against ${BASE_URL}`);
  
  // Verify the site is accessible
  const response = http.get(BASE_URL, { timeout: '10s' });
  if (response.status !== 200) {
    throw new Error(`Site not accessible: ${response.status}`);
  }
  
  console.log(`Site check passed: ${response.status}`);
  return { baseUrl: BASE_URL };
}

// Teardown function - runs once after the test
export function teardown(data) {
  console.log('Load test completed');
}

// Health check function for monitoring
export function healthCheck() {
  const response = http.get(`${BASE_URL}/wp-admin/admin-ajax.php?action=health`);
  check(response, {
    'health check responds': (r) => r.status === 200,
    'health check returns JSON': (r) => {
      try {
        const body = JSON.parse(r.body);
        return body.status !== undefined;
      } catch {
        return false;
      }
    },
  });
}

// Performance monitoring function
export function performanceCheck() {
  const response = http.get(`${BASE_URL}/wp-admin/admin-ajax.php?action=metrics`);
  check(response, {
    'metrics endpoint responds': (r) => r.status === 200,
    'metrics returns JSON': (r) => {
      try {
        const body = JSON.parse(r.body);
        return body.timestamp !== undefined;
      } catch {
        return false;
      }
    },
  });
  
  if (response.status === 200) {
    try {
      const metrics = JSON.parse(response.body);
      console.log(`Server metrics - Memory: ${metrics.memory?.current || 'N/A'}, Queries: ${metrics.database?.queries || 'N/A'}`);
    } catch (e) {
      console.log('Could not parse metrics response');
    }
  }
}