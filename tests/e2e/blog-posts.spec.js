const { test, expect } = require('@playwright/test');
const go = (page, p) => page.goto(p, { waitUntil: 'domcontentloaded' });

const POSTS = [
  { slug: 'how-many-calories-does-a-cat-need', h1: /How Many Calories Does a Cat Need/, tool: '/tools/cat-calorie-calculator/', table: '218 kcal' },
  { slug: 'how-often-should-you-bathe-a-dog', h1: /How Often Should You Bathe a Dog/, tool: '/tools/dog-bathing-frequency-calculator/', table: 'Double coat' },
];

for (const p of POSTS) {
  test(`blog post ${p.slug} is published, complete and linked to its tool`, async ({ page, request }) => {
    const res = await go(page, `blog/${p.slug}/`);
    expect(res.status()).toBe(200);
    await expect(page.locator('h1')).toHaveCount(1);
    await expect(page.locator('h1')).toHaveText(p.h1);
    const body = page.locator('.pz-single-article, article').first();
    await expect(body.locator('table.pz-compare-table').first()).toBeVisible();      // our table markup survived saving
    await expect(body).toContainText(p.table);
    await expect(body.locator(`a[href$="${p.tool}"]`).first()).toBeAttached();
    expect(await body.locator('h2').count()).toBeGreaterThanOrEqual(8);
    const text = await page.locator('body').innerText();
    expect(text).not.toMatch(/Vet[- ]Reviewed|vet-approved|certified pet care specialists|veterinary consultants/i);
    expect(text).toContain('not veterinary advice');
    const desc = await page.locator('meta[name="description"]').getAttribute('content');
    expect(desc.length).toBeGreaterThan(80);
    expect(desc.length).toBeLessThanOrEqual(160);
    for (const href of await body.locator('a[href^="/"]').evaluateAll((a) => [...new Set(a.map((x) => x.getAttribute('href')))])) {
      expect((await request.get(href.replace(/^\//, ''))).status(), href).toBe(200);
    }
  });
}

test('new posts appear on the blog index and in the post sitemap', async ({ page, request }) => {
  await go(page, 'blog/');
  for (const p of POSTS) await expect(page.locator(`a[href*="/blog/${p.slug}/"]`).first()).toBeAttached();
  const xml = await (await request.get('post-sitemap.xml')).text();
  for (const p of POSTS) expect(xml).toContain(`/blog/${p.slug}/`);
});
