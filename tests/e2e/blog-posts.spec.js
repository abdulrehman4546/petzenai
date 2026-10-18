const { test, expect } = require('@playwright/test');
const go = (page, p) => page.goto(p, { waitUntil: 'domcontentloaded' });

const NEW_POSTS = [
  { slug: 'halloween-pet-safety-tips', h1: /Halloween Pet Safety/, text: 'xylitol', tool: '/tools/pet-poison-emergency-guide/', imgs: 2 },
  { slug: 'antifreeze-poisoning-in-dogs-and-cats', h1: /Antifreeze Poisoning/, text: 'ethylene glycol', tool: '/tools/pet-cold-weather-safety/', imgs: 1 },
  { slug: 'thanksgiving-foods-for-dogs-and-cats', h1: /Thanksgiving Foods/, text: 'stuffing', tool: '/tools/dog-toxic-foods-guide/', imgs: 2 },
  { slug: 'daylight-saving-time-and-pets', h1: /Daylight Saving Time and Pets/, text: 'November 1, 2026', tool: '/blog/senior-dog-care-guide/', imgs: 2 },
];

for (const p of NEW_POSTS) {
  test(`trending post ${p.slug}: published with images, poison-helpline info and valid links`, async ({ page, request }) => {
    const res = await go(page, `blog/${p.slug}/`);
    expect(res.status()).toBe(200);
    await expect(page.locator('h1')).toHaveText(p.h1);
    const body = page.locator('.pz-single-article, article').first();
    await expect(body).toContainText(p.text);
    await expect(body).toContainText('not veterinary advice');
    await expect(body.locator(`a[href$="${p.tool}"]`).first()).toBeAttached();
    expect(await body.locator('table.pz-compare-table').count()).toBeGreaterThanOrEqual(1);
    // stock photos: present, with alt text, and actually served
    const imgs = body.locator('figure.pz-blog-img img');
    expect(await imgs.count()).toBeGreaterThanOrEqual(p.imgs);
    for (const src of await imgs.evaluateAll((a) => a.map((x) => x.src))) {
      expect((await request.get(src)).status(), src).toBe(200);
    }
    for (const alt of await imgs.evaluateAll((a) => a.map((x) => x.alt))) expect(alt.length).toBeGreaterThan(10);
    const text = await page.locator('body').innerText();
    expect(text).not.toMatch(/Vet[- ]Reviewed|vet-approved|certified pet care specialists/i);
    if (/poison|antifreeze|thanksgiving|halloween/i.test(p.slug)) {
      expect(text).toContain('(888) 426-4435');
      expect(text).toContain('(855) 764-7661');
    }
    for (const href of await body.locator('a[href^="/"]').evaluateAll((a) => [...new Set(a.map((x) => x.getAttribute('href')))])) {
      expect((await request.get(href.replace(/^\//, ''))).status(), href).toBe(200);
    }
  });
}

test('every trending post has a featured image (og:image) and shows on the blog index', async ({ page }) => {
  for (const p of NEW_POSTS) {
    await go(page, `blog/${p.slug}/`);
    const og = await page.locator('meta[property="og:image"]').getAttribute('content');
    expect(og, p.slug).toMatch(/\/wp-content\/uploads\//);
  }
  await go(page, 'blog/');
  for (const p of NEW_POSTS) await expect(page.locator(`a[href*="/blog/${p.slug}/"]`).first()).toBeAttached();
});

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
