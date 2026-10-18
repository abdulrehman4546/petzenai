const { test, expect } = require('@playwright/test');
const go = (page, p) => page.goto(p, { waitUntil: 'domcontentloaded' });

test('food calculator links to the two calorie calculators that actually exist', async ({ page, request }) => {
  await go(page, 'tools/pet-food-portion-calculator/');
  for (const slug of ['dog-calorie-calculator', 'cat-calorie-calculator']) {
    const link = page.locator(`a[href$="/tools/${slug}/"]`).first();
    await expect(link).toBeAttached();
    expect((await request.get(`tools/${slug}/`)).status()).toBe(200);
  }
  await expect(page.locator('a[href$="/cat-calorie-calculator/"]:not([href*="/tools/"])')).toHaveCount(0);
});

test('key pages have no broken internal links', async ({ page, request }) => {
  const seen = new Set();
  for (const p of ['', 'tools/', 'tools/dog-health/', 'about/', 'blog/', 'privacy-policy/']) {
    await go(page, p);
    const hrefs = await page.locator('a[href]').evaluateAll((a, origin) => a.map((x) => x.href).filter((h) => h.startsWith(origin)), new URL(page.url()).origin);
    for (const h of hrefs) {
      const u = h.split('#')[0].split('?')[0];
      if (seen.has(u) || /\.(css|js|png|jpe?g|svg|ico|xml|webp|woff2?|zip)$/.test(u) || /wp-admin|wp-login|\/feed\//.test(u)) continue;
      seen.add(u);
      const status = (await request.get(u)).status();
      expect(status, `${p || '/'} -> ${u}`).toBe(200);
    }
  }
  expect(seen.size).toBeGreaterThan(40);
});

test('tool pages do not show a fake "Last Updated" date', async ({ page }) => {
  for (const p of ['tools/dog-fever-checker/', 'tools/cat-calorie-calculator/', 'tools/rabbit-cage-size-calculator/']) {
    await go(page, p);
    await expect(page.locator('.pz-auto-tool-sidebar')).not.toContainText('Last Updated');
  }
});

test('no AI claims for tools that are not AI', async ({ page }) => {
  await go(page, '');
  const home = await page.locator('main').innerText();
  expect(home).not.toMatch(/AI[- ]generated|our AI\b|AI recommends|AI[- ]powered/i);
  await go(page, 'tools/ai-pet-name-generator/');
  await expect(page.locator('h1').first()).toContainText(/Pet Name/);
  expect(await page.locator('h1').first().innerText()).not.toMatch(/\bAI\b/);
  expect(await page.title()).not.toMatch(/\bAI\b/);
});
