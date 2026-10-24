const { test, expect } = require('@playwright/test');
const go = (page, p) => page.goto(p, { waitUntil: 'domcontentloaded' });
const URL = 'tools/kitten-feeding-guide/';
const calc = (page) => page.getByRole('button', { name: /Get My Kitten’s Feeding Plan/ }).click();

test('3 lb kitten aged 2–4 months on wet food: 198–243 kcal, 4 meals, about 2.8 cans', async ({ page }) => {
  await go(page, URL);
  await page.locator('#pz_kf_weight').fill('3');
  await calc(page);
  const r = page.locator('#pz-guide-result');
  // RER = 70 × 1.361^0.75 = 88 kcal; × 2.5 = 220 kcal, ±10%; 220 / 80 kcal per can = 2.75 cans
  await expect(r.locator('.pz-result-number')).toHaveText('198–243');
  await expect(r).toContainText('over 4 meals');
  await expect(r).toContainText('2.8 × 3 oz cans');
  await expect(r).toContainText('88 kcal');
});

test('6–12 month kitten (3 kg, half wet, half dry) uses 2 × RER and 2–3 meals', async ({ page }) => {
  await go(page, URL);
  await page.getByRole('button', { name: 'kg', exact: true }).click();
  await page.locator('#pz_kf_age').selectOption('m6');
  await page.locator('#pz_kf_diet').selectOption('mix');
  await expect(page.locator('#pz_kf_dry_wrap')).toBeVisible();
  await page.locator('#pz_kf_weight').fill('3');
  await calc(page);
  const r = page.locator('#pz-guide-result');
  // RER = 70 × 3^0.75 = 160 kcal; × 2.0 = 319 kcal, ±10%; half from 80 kcal cans (2), half from 375 kcal cups (0.43)
  await expect(r.locator('.pz-result-number')).toHaveText('287–351');
  await expect(r).toContainText('2–3 meals');
  await expect(r).toContainText('0.43 cup');
  await expect(r).toContainText('12 months');
});

test('kittens under 4 weeks get a milk-only schedule, not food amounts', async ({ page }) => {
  await go(page, URL);
  await page.locator('#pz_kf_age').selectOption('neo');
  await expect(page.locator('#pz_kf_diet_wrap')).toBeHidden();
  await page.locator('#pz_kf_weight').fill('0.5');
  await calc(page);
  const r = page.locator('#pz-guide-result');
  await expect(r).toContainText('kitten milk replacer');
  await expect(r).toContainText('Never give cow’s or goat’s milk');
  await expect(r).toContainText('~10 feeds a day');
  await expect(r).not.toContainText('kcal');
});

test('missing or unusual weight is rejected', async ({ page }) => {
  await go(page, URL);
  await calc(page);
  await expect(page.locator('#pz-guide-result')).toContainText("enter your kitten's weight");
  await page.locator('#pz_kf_weight').fill('20');
  await calc(page);
  await expect(page.locator('#pz-guide-result')).toContainText('looks unusual');
});

test('kitten feeding page has its own content, no boilerplate and no vet claims', async ({ page }) => {
  await go(page, URL);
  await expect(page.locator('h2', { hasText: 'Kitten Feeding Chart by Age' })).toBeVisible();
  await expect(page.locator('text=Can kittens drink milk?').first()).toBeAttached();
  await expect(page.locator('h2', { hasText: 'Recommended Products' })).toHaveCount(0);
  const text = await page.locator('body').innerText();
  expect(text).not.toMatch(/Vet[- ]Reviewed|vet-approved (tools|brands)|peer-reviewed/i);
  await expect(page.locator('.pz-further-list a[href*="cornell.edu"]')).toBeVisible();
  await expect(page.locator('.pz-further-list a[href*="wsava.org/global-guidelines/global-nutrition-guidelines"]')).toBeVisible();
});

test('kitten feeding guide stays indexable (it has its own content)', async ({ page }) => {
  await go(page, '');
  const home = (await page.locator('meta[name="robots"]').first().getAttribute('content')) || '';
  test.skip(/noindex/.test(home), 'whole site is noindex (local environment)');
  await go(page, URL);
  expect((await page.locator('meta[name="robots"]').first().getAttribute('content')) || '').not.toMatch(/noindex/);
});
