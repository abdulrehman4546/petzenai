const { test, expect } = require('@playwright/test');

// Shared renderer regression guard: these pages share tool-renderer.php with
// the ~300 other tool pages, so a break here usually means a sitewide break.
const TOOLS = [
  'dog-bathing-frequency-calculator',
  'dog-nail-trimming-guide',
  'dog-fever-checker',
  'cat-bathing-guide',
];

for (const slug of TOOLS) {
  test.describe(slug, () => {
    test('loads with one H1, no JS errors, and valid JSON-LD', async ({ page }) => {
      const errors = [];
      page.on('pageerror', (e) => errors.push(e.message));

      const res = await page.goto(`tools/${slug}/`, { waitUntil: 'domcontentloaded' });
      expect(res.status()).toBe(200);
      await expect(page.locator('h1')).toHaveCount(1);
      await expect(page.locator('#pz-tool-interactive, #pz-int-tool').first()).toBeVisible();

      const blocks = await page.locator('script[type="application/ld+json"]').allTextContents();
      expect(blocks.length).toBeGreaterThan(0);
      for (const b of blocks) expect(() => JSON.parse(b)).not.toThrow();

      expect(errors).toEqual([]);
    });
  });
}

test('unknown tool slug returns 404', async ({ request }) => {
  const res = await request.get('tools/this-tool-does-not-exist/');
  expect(res.status()).toBe(404);
});

test('tools listing page loads and links to tool categories', async ({ page }) => {
  const res = await page.goto('tools/', { waitUntil: 'domcontentloaded' });
  expect(res.status()).toBe(200);
  await expect(page.locator('a[href*="/tools/dog-grooming/"]').first()).toBeAttached();
});
