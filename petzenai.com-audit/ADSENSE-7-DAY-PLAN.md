# PetZenAI: AdSense ke liye 7 din ka plan (2026-10-07 se 2026-10-13)

Apply date: 2026-10-14 ya 15 (din 8-9 buffer/monitor).

## Sabse bara risk
308 tool pages ek hi template se bane hain. AdSense inhe "low value / scaled content" samajh sakta hai. Sirf SEO fix kafi nahi: pages ko genuinely useful aur unique dikhana hai, aur bad pages ko noindex ya merge karna hai.

## Din 1 (Mon 7 Oct): Cleanup + indexing safai
- [ ] /sample-page/ delete; -2 slugs (dog-zoomies-guide-2, rabbit-grooming-guide-2) ko sahi slug par 301
- [ ] robots.txt se /sitemap-clean.xml wali line hatao
- [ ] Search Console + Bing Webmaster connect, sitemap_index.xml submit
- [ ] GSC mein dekho kitne pages "Crawled - currently not indexed" hain (yeh quality ka signal hai)
- [ ] Sab 308 tool pages ki list banao: title, word count, unique content %, traffic

## Din 2 (Tue): Tool pages ki quality (sab se ahem)
- [ ] Har tool page par kam az kam 400-600 UNIQUE words (species-specific advice, example, FAQ). Template wali boilerplate line hatao
- [ ] Top 60-80 best pages pehle poori tarah fix; baqi weak pages temporary noindex (yeh Din 7 par dobara dekho)
- [ ] Meta descriptions fix: "Free Reptile reptile..." wala duplication (tool-renderer ka bug, ek fix se sab pages theek)
- [ ] Duplicate/near-duplicate pages merge ya noindex

## Din 3 (Wed): Speed (Core Web Vitals)
- [ ] Tool template ka ~440 KB inline JS external cached file mein, data per tool load
- [ ] Images: width/height, loading=lazy, WebP
- [ ] PageSpeed Insights: mobile LCP < 2.5s, CLS < 0.1 on 5 sample pages
- [ ] Caching/gzip check, unused plugins hatao

## Din 4 (Thu): Trust pages (AdSense policy ke liye zaroori)
- [ ] About: asli naam/team, mission, kaun likhta hai, vet reviewer ka naam + credentials
- [ ] Contact: working email + form (test karo)
- [ ] Privacy Policy: Google AdSense/cookies/DoubleClick/personalised ads ka section, third-party vendors link
- [ ] Naye pages: Disclaimer (medical: "vet ka mashwara nahi"), Editorial Policy, Author pages (/author/ abhi 404)
- [ ] Footer mein sab links; header menu saaf (Home, Tools, Blog, About, Contact)
- [ ] Cookie consent banner (CMP, EEA/UK ke liye Google certified) abhi site par nahi hai

## Din 5 (Fri): Schema + on-page
- [ ] Homepage: Organization schema (logo, sameAs), title "PetZenAI | Free Pet Care Calculators & Guides", alag meta description
- [ ] Homepage par 600+ words: kya milta hai, categories, trust signals
- [ ] Calculators par WebApplication schema; Article schema mein author + dateModified
- [ ] Security headers (HSTS, X-Content-Type-Options, Referrer-Policy) + /wp-json/wp/v2/users band
- [ ] Internal links: har tool page se 3-5 related tools/blog, har blog se tool

## Din 6 (Sat): Blog content
- [ ] Aakhri post Aug 1 ki hai, site "rukhi hui" lagti hai. 4-6 naye original articles (1500+ words, apni research, koi copy nahi, har ek mein author + date + sources)
- [ ] Purani 31 posts mein se kamzor wali update
- [ ] Har article par images apni ya licensed; copyright check

## Din 7 (Sun): Final QA
- [ ] Poori site par broken links, 404, redirect chains (crawler chalao)
- [ ] Mobile test (menu, calculators), kisi page par "under construction" ya khali content na ho
- [ ] ads.txt pehle se live hai (pub-4379837532366669). Check karo ke yeh ID AdSense account wali hi hai
- [ ] GSC dobara dekho: indexing, errors. Noindex kiye pages ka faisla
- [ ] Re-run SEO audit; target score 85+

## Din 8-14: Buffer, phir apply
- Din 8-10: naye articles index hone ka intezar, GSC mein request indexing
- Din 12-14: sab checklist dobara; custom domain, HTTPS, traffic ka thora data
- Din 15: AdSense apply (site ownership code header mein)

## AdSense reject hone ki aam wajuhat
Thin/duplicate content, privacy/about/contact missing, copied content, kam traffic/pages jinhein Google ne index hi na kiya, navigation mushkil, health claims bina source.
Note: koi bhi plan approval guarantee nahi karta; Google khud faisla karta hai.

## GSC data (2026-10-07, 47 pages sample)
- 21 indexed, 24 "Crawled - currently not indexed", 1 discovered not indexed (privacy-policy), 1 unknown to Google (terms-of-service)
- 90 din: 55 clicks, 9,203 impressions
- Galat sitemaps submitted GSC mein: /petzenai.com/sitemap_index.xml, /sitemap-clean.xml, 2 page URLs; purane post-sitemap.xml, page-sitemap.xml. Sirf sitemap_index.xml rakho
- Din 1 mein add: privacy-policy aur terms-of-service ke liye Request Indexing (AdSense reviewer inhe dekhta hai)
