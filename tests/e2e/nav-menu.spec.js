const { test, expect } = require('@playwright/test');

test.describe('desktop', () => {
  test.use({ viewport: { width: 1280, height: 800 } });

  test('Tools dropdown opens on hover and links to categories', async ({ page }) => {
    await page.goto('');
    const sub = page.locator('.nav-sub');
    await expect(sub).toBeHidden();
    await page.locator('.nav-item-has-sub > a').hover();
    await expect(sub).toBeVisible();
    await expect(sub.getByRole('menuitem', { name: /Dog Grooming/ })).toHaveAttribute('href', /\/tools\/dog-grooming\/$/);
    await expect(sub.getByRole('menuitem', { name: /View all tools/ })).toBeVisible();
  });

  test('category link navigates to a working category page', async ({ page }) => {
    await page.goto('');
    await page.locator('.nav-item-has-sub > a').hover();
    await page.locator('.nav-sub a', { hasText: 'Dog Health' }).click();
    await expect(page).toHaveURL(/\/tools\/dog-health\/$/);
    await expect(page.locator('h1')).toHaveCount(1);
  });

  test('top-level items are present', async ({ page }) => {
    await page.goto('');
    for (const name of ['Home', 'Tools', 'Blog', 'About Us', 'Contact Us']) {
      await expect(page.locator('#navMenu > li > a', { hasText: name })).toBeAttached();
    }
  });
});

test.describe('mobile', () => {
  test.use({ viewport: { width: 390, height: 800 } });

  test('hamburger opens menu and caret expands Tools categories', async ({ page }) => {
    await page.goto('');
    await page.locator('#navToggle').click();
    await expect(page.locator('#navMenu')).toHaveClass(/open/);
    await expect(page.locator('.nav-sub')).toBeHidden();
    await page.locator('.nav-sub-toggle').click();
    await expect(page.locator('.nav-sub')).toBeVisible();
    await expect(page.locator('.nav-sub-toggle')).toHaveAttribute('aria-expanded', 'true');
    await page.locator('.nav-sub a', { hasText: 'Cat Health' }).click();
    await expect(page).toHaveURL(/\/tools\/cat-health\/$/);
  });
});
