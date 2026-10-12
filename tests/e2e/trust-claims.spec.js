const { test, expect } = require('@playwright/test');
const go = (page, p) => page.goto(p, { waitUntil: 'domcontentloaded' });
const CLAIMS = /Vet[- ]Reviewed|Vet Approved|Vet-Approved (Tools|Brands|Methods)|vet-formulated (calculators|tools)|peer-reviewed|veterinary nutritionists|50K\+|50,000|10,000\+|reviewed by licensed/i;

test('no unverifiable review/authority/usage claims on key pages', async ({ page }) => {
  for (const p of ['', 'about/', 'tools/', 'tools/dog-health/', 'tools/dog-fever-checker/', 'tools/dog-nail-trimming-guide/', 'tools/cat-bathing-guide/']) {
    await go(page, p);
    const text = await page.locator('body').innerText();
    expect(text, p).not.toMatch(CLAIMS);
  }
});

test('tool page ends with an honest disclaimer and real veterinary-organisation links', async ({ page }) => {
  await go(page, 'tools/dog-fever-checker/');
  const sec = page.locator('.pz-vet-section');
  await expect(sec).toContainText('Educational information only');
  const links = sec.locator('.pz-further-list a');
  expect(await links.count()).toBeGreaterThanOrEqual(3);
  for (const href of await links.evaluateAll((a) => a.map((x) => x.href))) expect(href).toMatch(/^https:\/\/(www\.)?[a-z.]+\//);
  await expect(links.first()).toHaveAttribute('rel', /noopener/);
});

test('generic boilerplate sections are gone from tools without their own data', async ({ page }) => {
  await go(page, 'tools/dog-fever-checker/');
  await expect(page.locator('h2', { hasText: 'Recommended Products' })).toHaveCount(0);
  await expect(page.locator('h2', { hasText: 'Breed & Size Considerations' })).toHaveCount(0);
});

test('About page makes no credential claims it cannot back up', async ({ page }) => {
  await go(page, 'about/');
  const t = await page.locator('main, body').first().innerText();
  expect(t).not.toMatch(/veterinary nutritionists|peer-reviewed|Vet-Reviewed/i);
});
