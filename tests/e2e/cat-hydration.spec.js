const { test, expect } = require('@playwright/test');
const go = (page, p) => page.goto(p, { waitUntil: 'domcontentloaded' });
const URL = 'tools/cat-hydration-guide/';
const calc = (page) => page.getByRole('button', { name: /Calculate Water Needs/ }).click();

test('10 lb cat on dry food: about 222 ml from the bowl, 454 ml excessive line', async ({ page }) => {
  await go(page, URL);
  await page.locator('#pz_hy_weight').fill('10');
  await calc(page);
  const r = page.locator('#pz-calc-result');
  // 50 ml/kg × 4.536 kg = 227 ml total, minus ~5 ml from half a cup of kibble
  await expect(r.locator('.pz-result-number')).toHaveText('222 ml');
  await expect(r).toContainText('204–249 ml');
  await expect(r).toContainText('454 ml');
});

test('wet food reduces the bowl target', async ({ page }) => {
  await go(page, URL);
  await page.locator('#pz_hy_weight').fill('10');
  await page.locator('#pz_hy_diet').selectOption('wet');
  await expect(page.locator('#pz_hy_dry_wrap')).toBeHidden();
  await page.locator('#pz_hy_cans').fill('2');
  await calc(page);
  // two 3 oz cans: 2 × 85 g × 0.78 = 133 ml from food, 227 − 133 = 94 ml
  await expect(page.locator('#pz-calc-result .pz-result-number')).toHaveText('94 ml');
  await expect(page.locator('#pz-calc-result')).toContainText('133 ml');
});

test('missing or unusual weight is rejected', async ({ page }) => {
  await go(page, URL);
  await calc(page);
  await expect(page.locator('#pz-calc-result')).toContainText("enter your cat's weight");
  await page.locator('#pz_hy_weight').fill('90');
  await calc(page);
  await expect(page.locator('#pz-calc-result')).toContainText('looks unusual');
});

test('hydration page has its own content, no boilerplate and no vet claims', async ({ page }) => {
  await go(page, URL);
  await expect(page.locator('h2', { hasText: 'How Your Cat’s Water Needs Are Worked Out' })).toBeVisible();
  await expect(page.locator('h2', { hasText: 'Recommended Products' })).toHaveCount(0);
  const text = await page.locator('body').innerText();
  expect(text).not.toMatch(/Vet[- ]Reviewed|vet-approved (tools|brands)|peer-reviewed/i);
  await expect(page.locator('.pz-further-list a[href*="cornell.edu"]')).toBeVisible();
});

test('hydration calculator stays indexable (it has its own content)', async ({ page }) => {
  await go(page, '');
  const home = (await page.locator('meta[name="robots"]').first().getAttribute('content')) || '';
  test.skip(/noindex/.test(home), 'whole site is noindex (local environment)');
  await go(page, URL);
  expect((await page.locator('meta[name="robots"]').first().getAttribute('content')) || '').not.toMatch(/noindex/);
});
