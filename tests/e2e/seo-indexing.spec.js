const { test, expect } = require('@playwright/test');
const fs = require('fs');
const path = require('path');

const src = fs.readFileSync(path.join(__dirname, '../../wp-content/themes/petzenai-theme/inc/seo-indexing.php'), 'utf8');
const KEY = src.match(/PZ_INDEXNOW_KEY', '([0-9a-f]{32})'/)[1];

test('IndexNow key file is served at the site root', async ({ request }) => {
  const res = await request.get(`${KEY}.txt`);
  expect(res.status()).toBe(200);
  expect((await res.text()).trim()).toBe(KEY);
});

test('hubs sitemap lists every tool category as a valid URL', async ({ request }) => {
  const res = await request.get('pz-sitemap-hubs.xml');
  expect(res.status()).toBe(200);
  const xml = await res.text();
  const locs = [...xml.matchAll(/<loc>([^<]+)<\/loc>/g)].map((m) => m[1]);
  expect(locs.length).toBeGreaterThanOrEqual(15);
  for (const l of locs) expect(l).toMatch(/\/tools\/[a-z-]+\/$/);
  expect(new Set(locs).size).toBe(locs.length);
});

test('every hub in the sitemap responds 200', async ({ request }) => {
  const xml = await (await request.get('pz-sitemap-hubs.xml')).text();
  const locs = [...xml.matchAll(/<loc>([^<]+)<\/loc>/g)].map((m) => m[1].replace(/^https?:\/\/[^/]+(\/petzenai)?\//, ''));
  for (const l of locs) expect((await request.get(l)).status(), l).toBe(200);
});

test('/sample-page/ never serves a second copy of the homepage', async ({ request }) => {
  const res = await request.get('sample-page/', { maxRedirects: 0 });
  expect([301, 404]).toContain(res.status());
});

test('homepage and tools hub are not redirected away', async ({ request }) => {
  expect((await request.get('', { maxRedirects: 0 })).status()).toBe(200);
  expect((await request.get('tools/', { maxRedirects: 0 })).status()).toBe(200);
});
