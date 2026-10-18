const { test, expect } = require('@playwright/test');
const go = (page, p) => page.goto(p, { waitUntil: 'domcontentloaded' });
const GA = 'G-DSGEETLLHD';

test('GA4 tag is on public pages with consent defaults set before the config call', async ({ page }) => {
  const gtmRequests = [];
  page.on('request', (r) => { if (r.url().includes('googletagmanager.com/gtag/js')) gtmRequests.push(r.url()); });
  await go(page, '');
  const head = await page.locator('head').innerHTML();
  expect(head).toContain(`googletagmanager.com/gtag/js?id=${GA}`);
  const consent = head.indexOf("gtag('consent', 'default'");
  const config = head.indexOf(`gtag('config', '${GA}')`);
  expect(consent, 'consent default present').toBeGreaterThan(-1);
  expect(config, 'config present').toBeGreaterThan(consent);          // consent must be declared first
  for (const c of ['DE', 'FR', 'GB', 'CH']) expect(head).toContain(`"${c}"`);
  // the analytics tag is printed before the AdSense loader
  expect(head.indexOf('googletagmanager.com/gtag/js')).toBeLessThan(head.indexOf('adsbygoogle.js'));
  await page.waitForTimeout(1500);
  expect(gtmRequests.length, 'browser requested gtag.js').toBeGreaterThan(0);
  const dl = await page.evaluate(() => (window.dataLayer || []).length);
  expect(dl).toBeGreaterThan(2);
});

test('GA4 tag is present on tool pages and blog posts too', async ({ page }) => {
  for (const p of ['tools/cat-calorie-calculator/', 'blog/how-many-calories-does-a-cat-need/', 'privacy-policy/']) {
    await go(page, p);
    expect(await page.locator('head').innerHTML(), p).toContain(`gtag/js?id=${GA}`);
  }
});

test('privacy policy says Google Analytics is used and links the opt-out add-on', async ({ page }) => {
  await go(page, 'privacy-policy/');
  const html = await page.content();
  expect(html).toContain('Google Analytics 4');
  expect(html).toContain('tools.google.com/dlpage/gaoptout');
});
