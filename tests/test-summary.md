# Test Automation Summary

Framework: Playwright (`@playwright/test` 1.60, matches the locally cached Chromium build).
Target: local XAMPP site at `http://localhost/petzenai/` (override with `PZ_BASE_URL`).
Run: `cd tests && npm install && npx playwright test`

## Generated Tests

### E2E Tests
- [x] tests/e2e/bathing-calculator.spec.js — pilot page `dog-bathing-frequency-calculator` (10 tests)
  - renders with one H1, wizard on step 1, Back disabled
  - wizard navigates forward/back through all 4 steps
  - schedule calculations: default (5–7 wks), muddy double-coat dry skin (6–8), minimum clamp (1–2)
  - shampoo dose for lbs and kg, next-bath date + Google Calendar link
  - puppy under 12 weeks shows a safety warning, no schedule
  - breed search suggestions, FAQ accordion
- [x] tests/e2e/tool-pages-smoke.spec.js — shared-renderer regression guard (6 tests)
  - 4 tool pages: HTTP 200, one H1, no JS page errors, parseable JSON-LD
  - unknown tool slug returns 404; /tools/ listing links to categories

### API Tests
- None: the site exposes no custom API endpoints.

## Result
16 passed, 0 failed.

## Coverage
- Tool pages with interaction tests: 1 of ~300 (the pilot)
- Tool pages with smoke tests: 4 of ~300

## Next Steps
- When the next pilot tool is finished, add an interaction spec for it, then widen the smoke list.
- Consider looping the smoke test over every slug in `inc/tool-registry.php`.
- Tests run against local only; nothing here touches production.
