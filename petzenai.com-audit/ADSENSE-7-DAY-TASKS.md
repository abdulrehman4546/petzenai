# PetZenAI: AdSense 7 Din ke Detail Tasks
Status: [x] ho gaya | [ ] baqi | (A) aap karo | (C) Claude kar sakta hai

## Pehle se ho chuka
- [x] Search Console connect, sitemap_index.xml submit, 7 galat sitemaps delete
- [x] Code fixes commit (49bbf45): 50,000+ claims hataye, meta description cleanup, security headers, REST users band, robots sitemap line
- [ ] **git push origin main (A)**, phir khali push robots.txt ke liye, phir live check (C)

## Din 1: Safai + Indexing (2-3 ghante)
1. (A) Push + deploy verify
2. (A) WP Admin, Pages: "Sample Page" delete (Trash + Empty)
3. (A) dog-zoomies-guide-2 aur rabbit-grooming-guide-2: slug se "-2" hatao. Purane URL ka 301 Rank Math Redirections mein
4. (A) Customizer: Hero badge, Hero desc, CTA desc mein purana "50,000+" text ho to hatao
5. (A) GSC URL Inspection: /privacy-policy/ aur /terms-of-service/ ke liye Request Indexing
6. (A) Rank Math, Titles & Meta: Homepage title "PetZenAI | Free Pet Care Calculators & Guides" (60 char se kam), nayi alag description
7. (A) Rank Math, Schema: Organization (naam, logo, sameAs social links)
8. (C) Sab 308 tool pages ka spreadsheet: word count, unique %, indexed/not (GSC data se)

## Din 2: Tool pages ki quality (sab se zaroori, 6-8 ghante)
1. (C) Spreadsheet se 24+ "Crawled - not indexed" pages ki list
2. (C+A) Top 60 pages chuno (impressions ya search volume ke hisaab se)
3. (C) Har page ke liye 400-600 UNIQUE words draft: species-specific advice, example, 3 naye FAQ. (A) review karo, facts check
4. (A) Baqi ~250 weak pages: noindex (Rank Math, Advanced) jab tak content na ho
5. (C) Template se boilerplate/duplicate paragraphs kam karna (tool-renderer.php)
6. Target: 60 strong pages index-ready

## Din 3: Speed (4-5 ghante)
1. (C) Tool template ka ~440 KB inline JS: external cached file, data per tool
2. (C) Images: width/height, loading=lazy, WebP
3. (A) PageSpeed Insights (mobile) 5 pages par: LCP < 2.5s, CLS < 0.1
4. (A) Cache plugin/Cloudflare: gzip, browser cache, unused plugins band

## Din 4: Trust pages (AdSense ke liye must)
1. (A) About: asli naam/photo, kaun ho, mission. Vet reviewer ka naam + credentials (agar nahi hai to "vet-reviewed" claims hatao)
2. (A) Contact: working email + form test
3. (C) Privacy Policy mein AdSense/cookies/DoubleClick/personalised ads section, Google partner-sites link
4. (C) Naye pages: Disclaimer (medical), Editorial Policy, Author page
5. (A) Footer + menu: Home, Tools, Blog, About, Contact, Privacy, Terms, Disclaimer
6. (A) Cookie consent banner: Google-certified CMP (Complianz, CookieYes, ya Google Funding Choices)

## Din 5: Schema + Links
1. (C) WebApplication schema calculators par; Article mein author + dateModified
2. (C) Internal links: har tool se 3-5 related tools + blog, har blog se tool
3. (C) Homepage 600+ words (intro, categories, kaise kaam karta hai)
4. (A) Rich Results Test 3 pages par

## Din 6: Blog content (5-6 ghante)
1. (C) 5 topics chuno (GSC queries se)
2. (C) Har article 1500+ words draft, sources ke saath. (A) review, apni pet knowledge/experience add
3. (A) Original images (apni ya licensed), alt text
4. (A) Publish + GSC Request Indexing
5. Aakhri post Aug 1 ki hai; ab har hafte 1-2 post

## Din 7: Final QA
1. (C) Poori site crawl: broken links, 404, redirect chains
2. (A) Mobile test: menu, calculators, buttons
3. (A) Koi "under construction"/khali/copied page na ho
4. (A) ads.txt: pub-4379837532366669 AdSense account wali ID se match karo
5. (C) SEO audit dobara, target 85+
6. (C) GSC: indexed count dobara, 47 sample page

## Din 8-14: Buffer
- Din 8-11: naye content index hone do, GSC check roz
- Din 12-14: checklist final, indexed pages 60+ ho to apply ka faisla
- Din 15: AdSense apply (site code <head> mein)

## Reject se bachne ke rules
- Koi jhoota claim (users, reviews, rating) nahi
- Har page unique, kam az kam 400 words
- Privacy/About/Contact/Disclaimer live aur menu mein
- Cookie consent live

## Din 1 scan natija (2026-10-07, tool-pages-scan.csv, 307 pages)
- Median 2,106 visible words: pages lambe hain, masla length ka nahi, templated/duplicate pattern ka hai (Din 2 ka focus: uniqueness, 400-600 naye words ki zaroorat nahi)
- Asli thin pages sirf 7, aur yeh sabse zyada traffic wale hain: what-pet-should-i-get (532), ai-pet-name-generator (259), pet-age-calculator (268), pet-exercise-calculator (241), pet-food-portion-calculator (277), pet-vaccination-schedule (218), dog-separation-anxiety-training-2 (95, "-2" duplicate slug)
- 191 pages par GSC impressions hain; 116 par zero
- 7 pages ke meta description mein "50,000+" (live deploy ke baad theek hoga), 24 mein doubled word
- Din 2 plan badla: pehle in 6 flagship tools par 800+ words (intro, kaise kaam karta hai, FAQ, sources), phir baqi pages par duplicate boilerplate kam karna
