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
  test.setTimeout(240000);
  const targets = new Map();                        // url -> page it was found on
  for (const p of ['', 'tools/', 'tools/dog-health/', 'about/', 'blog/', 'privacy-policy/']) {
    await go(page, p);
    const origin = new URL(page.url()).origin;
    const hrefs = await page.locator('a[href]').evaluateAll((a, o) => a.map((x) => x.href).filter((h) => h.startsWith(o)), origin);
    for (const h of hrefs) {
      const u = h.split('#')[0].split('?')[0];
      if (targets.has(u) || /\.(css|js|png|jpe?g|svg|ico|xml|webp|woff2?|zip)$/.test(u) || /wp-admin|wp-login|\/feed\//.test(u)) continue;
      targets.set(u, p || '/');
    }
  }
  expect(targets.size).toBeGreaterThan(40);
  const list = [...targets.entries()];
  const bad = [];
  for (let i = 0; i < list.length; i += 8) {        // 8 at a time
    await Promise.all(list.slice(i, i + 8).map(async ([u, from]) => {
      const status = (await request.get(u, { maxRedirects: 5 })).status();
      if (status !== 200) bad.push(`${from} -> ${u} (${status})`);
    }));
  }
  expect(bad, bad.join('\n')).toEqual([]);
});

test('tool pages do not show a fake "Last Updated" date', async ({ page }) => {
  for (const p of ['tools/dog-fever-checker/', 'tools/cat-calorie-calculator/', 'tools/rabbit-cage-size-calculator/']) {
    await go(page, p);
    await expect(page.locator('.pz-auto-tool-sidebar')).not.toContainText('Last Updated');
  }
});

test('no AI claims for tools that are not AI', async ({ page }) => {
  await go(page, '');
  const home = await page.locator('body').innerText();
  expect(home).not.toMatch(/AI[- ]generated|our AI\b|AI recommends|AI[- ]powered/i);
  await go(page, 'tools/ai-pet-name-generator/');
  await expect(page.locator('h1').first()).toContainText(/Pet Name/);
  expect(await page.locator('h1').first().innerText()).not.toMatch(/\bAI\b/);
  expect(await page.title()).not.toMatch(/\bAI\b/);
});
