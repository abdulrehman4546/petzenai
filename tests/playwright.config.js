const { defineConfig } = require('@playwright/test');

module.exports = defineConfig({
  testDir: './e2e',
  timeout: 30000,
  use: {
    baseURL: process.env.PZ_BASE_URL || 'http://localhost/petzenai/',
    headless: true,
  },
});
