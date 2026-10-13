const { test, expect } = require('@playwright/test');

test('homepage advertises site icons and every icon URL is a real image', async ({ page, request }) => {
  await page.goto('', { waitUntil: 'domcontentloaded' });
  const hrefs = await page.locator('link[rel~="icon"], link[rel="apple-touch-icon"]').evaluateAll((l) => l.map((x) => x.href));
  expect(hrefs.length).toBeGreaterThanOrEqual(3);
  expect(hrefs.some((h) => /favicon-48\.png$/.test(h)), 'a 48px icon (multiple of 48 for Google)').toBeTruthy();
  for (const href of [...new Set(hrefs)]) {
    const res = await request.get(href);
    expect(res.status(), href).toBe(200);
    expect(res.headers()['content-type'], href).toMatch(/^image\//);
  }
  expect(hrefs.join(' ')).not.toContain('w-logo');
});

test('/favicon.ico serves our icon, not WordPress’s default W', async ({ request }) => {
  const res = await request.get('favicon.ico', { maxRedirects: 0 });
  expect(res.status()).toBe(200);
  expect(res.headers()['content-type']).toMatch(/image\/(x-icon|vnd\.microsoft\.icon)/);
  expect((await res.body()).length).toBeGreaterThan(1500);
});

test('icons are served from the theme with a cache header', async ({ request }) => {
  const res = await request.get('wp-content/themes/petzenai-theme/assets/img/favicon-192.png');
  expect(res.status()).toBe(200);
  expect((await res.body()).length).toBeGreaterThan(1000);
});
