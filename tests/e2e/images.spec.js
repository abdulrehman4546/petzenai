const { test, expect } = require('@playwright/test');
const go = (page, p) => page.goto(p, { waitUntil: 'domcontentloaded' });

test('category cards and reptile tool pages show no broken images', async ({ page, request }) => {
  test.setTimeout(240000);
  for (const p of ['tools/reptile-care/', 'tools/rabbit-care/', 'tools/fish-aquarium/', 'tools/bird-care/', 'tools/small-pets/', 'tools/bearded-dragon-care-guide/']) {
    await go(page, p);
    const srcs = [...new Set(await page.locator('img[src^="https://images.unsplash.com"]').evaluateAll((a) => a.map((x) => x.src)))];
    for (const src of srcs) expect((await request.get(src)).status(), `${p} -> ${src}`).toBe(200);
  }
});
