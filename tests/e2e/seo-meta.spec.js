const { test, expect } = require('@playwright/test');
const go = (page, p) => page.goto(p, { waitUntil: 'domcontentloaded' });
const HUBS = ['dog-grooming', 'dog-health', 'cat-health', 'fish-aquarium', 'pet-safety'];

test('each category hub has unique title, description, canonical and a Collection schema', async ({ page }) => {
  const seen = { title: new Set(), desc: new Set() };
  for (const hub of HUBS) {
    await go(page, `tools/${hub}/`);
    const title = await page.title();
    const desc = await page.locator('meta[name="description"]').getAttribute('content');
    // og:url is derived from the canonical and is present even when the site is set to noindex (local).
    const canon = await page.locator('meta[property="og:url"]').getAttribute('content');
    expect(title.length, title).toBeLessThanOrEqual(60);
    expect(canon, hub).toMatch(new RegExp(`/tools/${hub}/$`));
    expect(desc.length).toBeGreaterThan(80);
    expect(desc.length).toBeLessThanOrEqual(160);
    seen.title.add(title); seen.desc.add(desc);
    const ld = (await page.locator('script[type="application/ld+json"]').allTextContents()).join('');
    expect(ld).toContain('CollectionPage');
    await expect(page.locator('h1')).toHaveCount(1);
    expect(await page.locator('h2').count()).toBeGreaterThanOrEqual(2);
    await expect(page.locator('body')).not.toContainText('50K+');
  }
  expect(seen.title.size).toBe(HUBS.length);
  expect(seen.desc.size).toBe(HUBS.length);
});

test('/tools/ keeps its own canonical', async ({ page }) => {
  await go(page, 'tools/');
  await expect(page.locator('meta[property="og:url"]')).toHaveAttribute('content', /\/tools\/$/);
});

test('homepage title is within 60 characters', async ({ page }) => {
  await go(page, '');
  expect((await page.title()).length).toBeLessThanOrEqual(60);
});

test('tool page titles are within 62 characters', async ({ page }) => {
  for (const s of ['dog-bathing-frequency-calculator', 'dog-tail-grooming-guide', 'koi-pond-care-guide', 'cat-bathing-guide']) {
    await go(page, `tools/${s}/`);
    const t = await page.title();
    expect(t.length, t).toBeLessThanOrEqual(62);
  }
});

test('tool page descriptions are specific, within SERP length and make no vet-review claims', async ({ page }) => {
  for (const s of ['dog-nail-trimming-guide', 'dog-fever-checker', 'dog-weight-calculator', 'cat-bathing-guide']) {
    await go(page, `tools/${s}/`);
    const d = await page.locator('meta[name="description"]').getAttribute('content');
    expect(d.length, s).toBeLessThanOrEqual(160);
    expect(d.length, s).toBeGreaterThan(70);
    expect(d, s).not.toMatch(/vet-(reviewed|backed|informed)|^Comprehensive /i);
  }
});
