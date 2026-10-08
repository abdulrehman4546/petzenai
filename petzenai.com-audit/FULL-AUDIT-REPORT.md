# SEO Audit: petzenai.com

Date: 2026-10-06 | Health Score: **68/100** | Type: Content/tools publisher (programmatic pet-care calculators + blog)

Scope: homepage, robots.txt, sitemaps, llms.txt, and a sample of 4 tool pages and 1 blog post (not a full 500-page crawl). Scores are judgement-based from this sample; no Google field data was available.

## Technical SEO (68/100)

Works: HTTPS, www/http 301s, canonicals, sitemaps (Rank Math, 31 posts/321 pages/11 cats), robots.txt with AI-bot rules

- **[High] robots.txt lists /sitemap-clean.xml which returns 404**: Sitemap: https://petzenai.com/sitemap-clean.xml is 404. Fix: Remove the line or create the file; keep sitemap_index.xml only.
- **[High] Stray pages indexable and in sitemap**: /sample-page/ (200, in sitemap), /dog-zoomies-guide-2/ and /rabbit-grooming-guide-2/ use -2 slugs while the base slug 404s. Fix: Delete sample-page; fix slugs to the canonical name and 301 any old URL.
- **[Medium] No security headers**: No HSTS, X-Content-Type-Options, X-Frame-Options, Referrer-Policy or CSP on the homepage. Fix: Add via .htaccess.
- **[Medium] User enumeration via REST**: /wp-json/wp/v2/users returns 200. Fix: Disable for unauthenticated users.
- **[Low] robots.txt Disallow: /*?* blocks all query URLs**: Prevents Google seeing pagination/UTM canonicals. Fix: Acceptable, but confirm no needed URLs use parameters.

## Content Quality (72/100)

Works: Blog post is deep (about 3,300 words, 15 H2s, RER formula, Person author); Tool pages have 2,000+ words of visible text, FAQ blocks

- **[High] Templated tool pages risk thin/duplicate-pattern content**: 308 tool URLs from one renderer; meta descriptions follow a template with noun duplication: 'Free Reptile reptile feeding calculator', 'Free Cat cat hydration'. Fix: Rewrite templated descriptions via the override system; prioritise pages with traffic.
- **[Medium] Homepage has about 370 words**: Light for the main hub. Fix: Add intro, category explanations, trust/author signals.
- **[Medium] Health claims need E-E-A-T**: 'Vet-reviewed' claims on tools; verify a named reviewer exists on pages (YMYL-adjacent). Fix: Add named vet reviewer, credentials and review dates.

## On-Page SEO (70/100)

Works: Unique titles, one H1 per page, good descriptions on hand-written pages

- **[Medium] Homepage title and description are the same string**: Title 'petzenai - Free AI-Powered Pet Care Tools - ...' is lower-case brand and longer than 60 chars; description repeats it without the 'petzenai -' prefix. Fix: Title: 'PetZenAI | Free Pet Care Calculators & Guides' (under 60 chars); write a distinct 150-char description.
- **[Low] Two different homepage titles**: Static page title differs from the sample-page title format, showing inconsistent brand casing. Fix: Standardise to PetZenAI.

## Schema / Structured Data (65/100)

Works: Tool pages: Article, FAQPage, BreadcrumbList, ItemList, Person

- **[High] Homepage lacks Organization schema**: Only Person, WebSite+SearchAction and CollectionPage. Fix: Add Organization with logo and sameAs.
- **[Medium] No WebApplication/SoftwareApplication on calculators**: Calculators typed as Article only. Fix: Add WebApplication schema (free, category HealthApplication/Utility).
- **[Info] FAQPage rich results restricted**: Google limits FAQ rich results to gov/health authority sites; keep it for AI citability, not SERP features. Fix: No action.

## Performance (CWV) (45/100)

Works: gzip, Apache caching header

- **[Critical] Tool pages are about 530 KB of HTML, 440 KB inline script**: bird-enrichment-guide: 528,740 bytes, 441,984 of inline JS; TTFB-to-complete 1.8-3.1 s. Likely whole data set embedded per page. Fix: Move shared JS to a cached external file and load calculator data per tool; expected to cut HTML by 80%+ and improve LCP/INP.
- **[Medium] Homepage 26 images, field-data not measured**: Lab only; CrUX/GSC not connected. Fix: Connect Search Console and run PageSpeed on top templates.

## AI Search Readiness (78/100)

Works: Explicit allow rules for GPTBot, ClaudeBot, PerplexityBot, Google-Extended; llms.txt present and well-structured

- **[Info] CCBot blocked**: Intentional; reduces Common Crawl-fed model exposure. Fix: Keep or review.
- **[Low] llms.txt covers only about 6 tools of 308**: Does not list category hubs thoroughly. Fix: Generate from sitemap categories.

## Images (80/100)

Works: All 26 homepage images have alt text

- **[Low] Lazy loading not detected on sampled pages**: 0 loading=lazy found on bird guide (0 img tags in server HTML; images may be injected by JS). Fix: Confirm images render in HTML for crawlers; add width/height and loading=lazy below fold.

