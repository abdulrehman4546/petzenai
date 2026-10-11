const { test, expect } = require('@playwright/test');

const PATH = 'tools/dog-bathing-frequency-calculator/';

async function next(page, times) {
  for (let i = 0; i < times; i++) await page.locator('#pz-wiz-next').click();
}

async function submit(page) {
  await page.locator('#pz-wiz-next').click();
  await expect(page.locator('#pz-calc-result .pz-result-number')).toBeVisible();
}

test.beforeEach(async ({ page }) => {
  await page.goto(PATH, { waitUntil: 'domcontentloaded' });
});

test('page renders with H1 and wizard on step 1', async ({ page }) => {
  await expect(page.locator('h1')).toHaveCount(1);
  await expect(page.locator('.pz-wizard-step.active')).toHaveAttribute('data-step', '0');
  await expect(page.locator('#pz-wiz-back')).toBeDisabled();
});

test('wizard navigates forward and back through all four steps', async ({ page }) => {
  await next(page, 3);
  await expect(page.locator('.pz-wizard-step.active')).toHaveAttribute('data-step', '3');
  await expect(page.locator('#pz-wiz-next')).toContainText('Get My Bath Schedule');
  await page.locator('#pz-wiz-back').click();
  await expect(page.locator('.pz-wizard-step.active')).toHaveAttribute('data-step', '2');
});

test('default profile gives 5–7 weeks', async ({ page }) => {
  await next(page, 3);
  await submit(page);
  await expect(page.locator('.pz-result-number')).toHaveText('5–7');
  await expect(page.locator('.pz-result-unit')).toHaveText('weeks between baths');
});

test('muddy double-coated dog with dry skin gives 6–8 weeks and coat warning', async ({ page }) => {
  await page.locator('.pz-coat-card[data-val="double"]').click();
  await next(page, 1);
  await page.locator('.pz-chip[data-val="muddy"]').click();
  await next(page, 1);
  await page.locator('#pz_skin_condition').selectOption('dry');
  await next(page, 1);
  await submit(page);
  await expect(page.locator('.pz-result-number')).toHaveText('6–8');
  await expect(page.locator('#pz-calc-result')).toContainText('Never shave a double coat');
});

test('hairless + muddy + oily + allergies clamps to the 1–2 week minimum', async ({ page }) => {
  await page.locator('.pz-coat-card[data-val="hairless"]').click();
  await next(page, 1);
  await page.locator('.pz-chip[data-val="muddy"]').click();
  await next(page, 1);
  await page.locator('#pz_skin_condition').selectOption('oily');
  await next(page, 1);
  await page.locator('#pz_allergies').selectOption('yes');
  await submit(page);
  await expect(page.locator('.pz-result-number')).toHaveText('1–2');
});

test('weight in lbs and kg maps to the right shampoo dose', async ({ page }) => {
  await next(page, 2);
  await page.locator('#pz_weight').fill('45');
  await next(page, 1);
  await submit(page);
  await expect(page.locator('#pz-calc-result')).toContainText('2–4 tbsp');

  await page.goto(PATH, { waitUntil: 'domcontentloaded' });
  await next(page, 2);
  await page.locator('.pz-unit-btn', { hasText: 'kg' }).click();
  await page.locator('#pz_weight').fill('30'); // ≈ 66 lbs
  await next(page, 1);
  await submit(page);
  await expect(page.locator('#pz-calc-result')).toContainText('4–6 tbsp');
});

test('last bath date produces a next-bath date and calendar link', async ({ page }) => {
  await next(page, 3);
  await page.locator('#pz_last_bath').fill('2026-01-01');
  await page.locator('#pz-wiz-next').click();
  const result = page.locator('#pz-calc-result');
  await expect(result).toContainText('Next Bath Due');
  await expect(result).toContainText('February 12, 2026'); // 6 weeks after Jan 1
  await expect(result.locator('a[href^="https://calendar.google.com/"]')).toBeVisible();
});

test('puppy under 12 weeks gets a safety warning instead of a schedule', async ({ page }) => {
  await next(page, 3);
  await page.locator('#pz_age').selectOption('puppy_young');
  await page.locator('#pz-wiz-next').click();
  await expect(page.locator('#pz-calc-result')).toContainText('Hold off on a full bath');
  await expect(page.locator('.pz-result-number')).toHaveCount(0);
});

test('breed search suggests breeds', async ({ page }) => {
  await page.locator('#pz_breed_search').fill('Poodle');
  await expect(page.locator('#pz_breed_results')).toBeVisible();
  await expect(page.locator('#pz_breed_results')).toContainText(/poodle/i);
});

test('FAQ accordion toggles', async ({ page }) => {
  const q = page.locator('.pz-faq-q').first();
  await q.click();
  await expect(q).toHaveAttribute('aria-expanded', 'true');
  await q.click();
  await expect(q).toHaveAttribute('aria-expanded', 'false');
});
