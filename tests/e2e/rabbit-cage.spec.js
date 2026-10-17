const { test, expect } = require('@playwright/test');
const go = (page, p) => page.goto(p, { waitUntil: 'domcontentloaded' });
const URL = 'tools/rabbit-cage-size-calculator/';
const calc = (page) => page.getByRole('button', { name: /Calculate Cage Size/ }).click();

test('default medium rabbit: 12 sq ft target, 8 sq ft minimum, exercise area', async ({ page }) => {
  await go(page, URL);
  await calc(page);
  const r = page.locator('#pz-calc-result');
  await expect(r.locator('.pz-result-number')).toHaveText('12 sq ft');
  await expect(r).toContainText('48 × 24 × 24 in');
  await expect(r).toContainText('122 × 61 × 61 cm');
  await expect(r).toContainText('24–32 sq ft');
  await expect(r.locator('.pz-result-extras')).toBeVisible();
});

test('space scales with the number of rabbits and the size', async ({ page }) => {
  await go(page, URL);
  await page.locator('#pz_rb_count').selectOption('2');
  await calc(page);
  await expect(page.locator('#pz-calc-result .pz-result-number')).toHaveText('24 sq ft');
  await page.locator('#pz_rb_count').selectOption('1');
  await page.locator('#pz_rb_size').selectOption('giant');
  await calc(page);
  await expect(page.locator('#pz-calc-result .pz-result-number')).toHaveText('22.5 sq ft');
});

test('body-length rule raises the minimum length and bad input is rejected', async ({ page }) => {
  await go(page, URL);
  await page.locator('#pz_rb_len').fill('20');
  await calc(page);
  await expect(page.locator('#pz-calc-result')).toContainText('80 × 24 × 24 in');
  await page.locator('#pz_rb_len').fill('80');
  await calc(page);
  await expect(page.locator('#pz-calc-result')).toContainText('looks unusual');
});

test('rabbit calculator page has its own content, no boilerplate and no vet claims', async ({ page }) => {
  await go(page, URL);
  await expect(page.locator('h2', { hasText: 'How the Cage Size Is Worked Out' })).toBeVisible();
  await expect(page.locator('h2', { hasText: 'Recommended Products' })).toHaveCount(0);
  const text = await page.locator('body').innerText();
  expect(text).not.toMatch(/Vet[- ]Reviewed|vet-approved (tools|brands)|peer-reviewed/i);
  await expect(page.locator('.pz-further-list a[href*="rabbit.org"]')).toBeVisible();
});

test('rabbit calculator stays indexable (it has its own content)', async ({ page }) => {
  await go(page, '');
  const home = (await page.locator('meta[name="robots"]').first().getAttribute('content')) || '';
  test.skip(/noindex/.test(home), 'whole site is noindex (local environment)');
  await go(page, URL);
  expect((await page.locator('meta[name="robots"]').first().getAttribute('content')) || '').not.toMatch(/noindex/);
});
