const { test, expect } = require('@playwright/test');
const go = (page, p) => page.goto(p, { waitUntil: 'domcontentloaded' });
const words = async (page) => (await page.locator('main, body').first().innerText()).split(/\s+/).filter(Boolean).length;

test('AdSense loader and verification meta match the publisher id in ads.txt', async ({ page, request }) => {
  const ads = await (await request.get('ads.txt')).text();
  const pub = ads.match(/pub-\d{10,20}/)[0];
  await go(page, '');
  await expect(page.locator('meta[name="google-adsense-account"]')).toHaveAttribute('content', 'ca-' + pub);
  const src = await page.locator('script[src*="adsbygoogle.js"]').getAttribute('src');
  expect(src).toContain('client=ca-' + pub);
  expect(ads).toMatch(/google\.com, pub-\d+, DIRECT, f08c47fec0942fa0/);
});

test('privacy policy carries the disclosures AdSense requires', async ({ page }) => {
  await go(page, 'privacy-policy/');
  const text = await page.locator('main').innerText();
  expect(text.split(/\s+/).length).toBeGreaterThan(900);
  for (const phrase of [
    'Third-party vendors, including Google, use cookies to serve ads based on a user',
    'Google’s use of advertising cookies enables it and its partners',
    'adssettings.google.com', 'aboutads.info', 'partner-sites',
    'California', 'European Economic Area', 'not directed at children under 13',
  ]) {
    const html = await page.content();
    expect(text + html, phrase).toContain(phrase);
  }
  await expect(page.locator('a[href^="mailto:"]').first()).toBeVisible();
});

test('about, contact and terms pages are substantial and honest', async ({ page }) => {
  await go(page, 'about/');
  expect(await words(page)).toBeGreaterThan(420);
  const about = await page.locator('main').innerText();
  expect(about).not.toMatch(/veterinary nutritionists|peer-reviewed|Vet[- ]Reviewed/i);
  expect(about).toContain('not a veterinary practice');
  await go(page, 'contact/');
  await expect(page.locator('form')).toHaveCount(1);
  await expect(page.locator('a[href="mailto:support@petzenai.com"]').first()).toBeAttached();
  await go(page, 'terms-of-service/');
  expect(await words(page)).toBeGreaterThan(500);
});

test('every page links to privacy, terms, contact and about', async ({ page }) => {
  for (const p of ['', 'tools/', 'tools/dog-fever-checker/']) {
    await go(page, p);
    for (const path of ['/privacy-policy/', '/terms-of-service/', '/contact/', '/about/']) {
      await expect(page.locator(`footer a[href$="${path}"]`).first(), `${p} -> ${path}`).toBeAttached();
    }
  }
});

test('cat calorie calculator gives the documented result and cups of food', async ({ page }) => {
  await go(page, 'tools/cat-calorie-calculator/');
  await page.locator('#pz_cat_weight').fill('10');
  await page.getByRole('button', { name: /Calculate My Cat/ }).click();
  const result = page.locator('#pz-calc-result');
  await expect(result.locator('.pz-result-number')).toHaveText('235–287');
  await expect(result).toContainText('1.2× RER');
  await expect(result).toContainText('0.70 cup');
  await expect(result.locator('.pz-result-extras')).toBeVisible();
  // switching to wet food changes the default calories and the unit
  await page.locator('#pz_cat_food').selectOption('wet');
  await expect(page.locator('#pz_cat_kcal')).toHaveValue('80');
  await page.getByRole('button', { name: /Calculate My Cat/ }).click();
  await expect(result).toContainText('cans');
});

test('cat calorie calculator validates input and blocks crash dieting for kittens', async ({ page }) => {
  await go(page, 'tools/cat-calorie-calculator/');
  await page.getByRole('button', { name: /Calculate My Cat/ }).click();
  await expect(page.locator('#pz-calc-result')).toContainText('enter your cat');
  await page.locator('#pz_cat_weight').fill('3');
  await page.locator('#pz_cat_stage').selectOption('kitten12');
  await page.locator('#pz_cat_goal').selectOption('lose');
  await page.getByRole('button', { name: /Calculate My Cat/ }).click();
  await expect(page.locator('#pz-calc-result')).toContainText('not for growing kittens');
});

test('cat calorie page has its own content, no boilerplate sections and no vet claims', async ({ page }) => {
  await go(page, 'tools/cat-calorie-calculator/');
  await expect(page.locator('h2', { hasText: 'How Your Cat’s Calorie Target Is Calculated' })).toBeVisible();
  await expect(page.locator('h2', { hasText: 'Recommended Products' })).toHaveCount(0);
  const text = await page.locator('body').innerText();
  expect(text).not.toMatch(/Vet[- ]Reviewed|vet-approved (tools|brands)|peer-reviewed/i);
  await expect(page.locator('.pz-further-list a').first()).toBeVisible();
});

test('generic templated tools are noindex, custom tools stay indexable', async ({ page }) => {
  await go(page, '');
  const home = (await page.locator('meta[name="robots"]').first().getAttribute('content')) || '';
  test.skip(/noindex/.test(home), 'whole site is noindex (local environment)');
  const robots = async (p) => { await go(page, p); return (await page.locator('meta[name="robots"]').first().getAttribute('content')) || ''; };
  expect(await robots('tools/cat-nail-trimming-guide/')).toMatch(/noindex/);
  expect(await robots('tools/dog-bathing-frequency-calculator/')).not.toMatch(/noindex/);
  expect(await robots('tools/cat-calorie-calculator/')).not.toMatch(/noindex/);
  expect(await robots('tools/dog-health/')).not.toMatch(/noindex/);
});
