const { test, expect } = require('@playwright/test');

const PATH = 'tools/dog-bathing-frequency-calculator/';
const go = (page, p) => page.goto(p, { waitUntil: 'domcontentloaded' });

async function calculate(page) {
  for (let i = 0; i < 4; i++) await page.locator('#pz-wiz-next').click();
  await expect(page.locator('#pz-calc-result .pz-result-number')).toBeVisible();
}

test('result shows copy/share actions and next-step links', async ({ page, context }) => {
  await context.grantPermissions(['clipboard-read', 'clipboard-write']);
  await go(page, PATH);
  await calculate(page);
  const extras = page.locator('#pz-calc-result .pz-result-extras');
  await expect(extras).toBeVisible();
  await expect(extras.locator('.pz-next-card')).toHaveCount(3);
  for (const href of await extras.locator('.pz-next-card').evaluateAll((a) => a.map((x) => x.getAttribute('href')))) {
    expect(href).toMatch(/\/tools\/[a-z0-9-]+\/$/);
  }
  await extras.getByRole('button', { name: /Copy result/ }).click();
  await expect(page.locator('#pz-toast')).toHaveClass(/show/);
  const clip = await page.evaluate(() => navigator.clipboard.readText());
  expect(clip).toContain('weeks between baths');
  expect(clip).toContain('/tools/dog-bathing-frequency-calculator/');
});

test('recalculating does not duplicate the action bar', async ({ page }) => {
  await go(page, PATH);
  await calculate(page);
  await page.locator('#pz-wiz-back').click();   // back to step 3 (result cleared)
  await page.locator('#pz-wiz-next').click();   // step 4
  await page.locator('#pz-wiz-next').click();   // calculate again
  await expect(page.locator('#pz-calc-result .pz-result-number')).toBeVisible();
  await expect(page.locator('#pz-calc-result .pz-result-extras')).toHaveCount(1);
});

test('related tools: 6 same-category cards plus cross-category explore block', async ({ page }) => {
  await go(page, PATH);
  await expect(page.locator('.pz-related-tools .tool-card')).toHaveCount(6);
  await expect(page.locator('.pz-explore-list a')).toHaveCount(3);
  await expect(page.locator('.pz-hub-chips a').first()).toHaveAttribute('href', /\/tools\//);
  const hrefs = await page.locator('.pz-related-tools .tool-card a.tool-link').evaluateAll((a) => a.map((x) => x.getAttribute('href')));
  expect(new Set(hrefs).size).toBe(6);
  expect(hrefs.every((h) => !h.includes('dog-bathing-frequency-calculator'))).toBeTruthy();
});

test('related links differ between tools in the same category', async ({ page }) => {
  const read = async (slug) => {
    await go(page, `tools/${slug}/`);
    return page.locator('.pz-auto-tool-sidebar .pz-sidebar-tool').evaluateAll((a) => a.map((x) => x.getAttribute('href')));
  };
  const a = await read('dog-bathing-frequency-calculator');
  const b = await read('dog-paw-care-guide');
  expect(a.length).toBeGreaterThanOrEqual(5);
  expect(b).not.toEqual(a);
});

test('recently viewed lists a previously opened tool', async ({ page }) => {
  await go(page, 'tools/dog-nail-trimming-guide/');
  await go(page, PATH);
  await expect(page.locator('#pz-recent')).toBeVisible();
  await expect(page.locator('#pz-recent-list a').first()).toHaveAttribute('href', /dog-nail-trimming-guide/);
});

test('progress bar and back-to-top react to scrolling', async ({ page }) => {
  await go(page, PATH);
  await expect(page.locator('.pz-progress')).toBeAttached();
  await page.evaluate(() => window.scrollTo(0, 1500));
  await expect(page.locator('.pz-top-btn')).toHaveClass(/show/);
  await page.locator('.pz-top-btn').click();
  await expect.poll(() => page.evaluate(() => window.scrollY)).toBeLessThan(50);
});

test('footer links to every category hub and home stats are real', async ({ page }) => {
  await go(page, '');
  expect(await page.locator('.footer-cats a').count()).toBeGreaterThanOrEqual(15);
  await expect(page.locator('.hero-stat-num').first()).toHaveAttribute('data-count', '300');
  await expect(page.locator('body')).not.toContainText('50,000');
});
