<?php
/**
 * Plugin Name: PetZenAI Setup & Blog Importer
 * Description: Imports all 4 blog posts with full SEO meta (Rank Math compatible). Run once, then deactivate.
 * Version: 1.0
 * Author: PetZenAI
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* ── Admin notice with import button ── */
add_action( 'admin_notices', function () {
    if ( get_option('petzenai_imported') ) {
        echo '<div class="notice notice-success"><p>✅ <strong>PetZenAI:</strong> All 4 blog posts imported successfully! You can now <strong>deactivate this plugin</strong>.</p></div>';
        return;
    }
    $url = wp_nonce_url( admin_url('admin-post.php?action=petzenai_import'), 'petzenai_import' );
    echo '<div class="notice notice-warning"><p>🐾 <strong>PetZenAI Setup:</strong> Blog posts not imported yet. <a href="' . esc_url($url) . '" class="button button-primary">Import All 4 Blog Posts Now</a></p></div>';
} );

add_action( 'admin_post_petzenai_import', function () {
    check_admin_referer( 'petzenai_import' );
    if ( ! current_user_can( 'manage_options' ) ) wp_die( 'Not allowed.' );
    petzenai_run_import();
    update_option( 'petzenai_imported', true );
    wp_redirect( admin_url( '?petzenai_done=1' ) );
    exit;
} );

/* ================================================================
   BLOG POST DATA — 4 Posts from petzenai.com
   ================================================================ */
function petzenai_get_posts_data() {
    return [

        /* ── POST 1 ── */
        [
            'slug'         => 'how-many-calories-should-a-cat-eat',
            'title'        => 'How Many Calories Should a Cat Eat? The Formula Vets Actually Use',
            'date'         => '2025-12-10 08:00:00',
            'category'     => 'Cat Nutrition',
            'excerpt'      => 'Most people guess at how much to feed their cat. Vets use a specific formula based on weight and activity level. Here\'s the exact method — and why bag guidelines are almost always wrong.',
            'focus_kw'     => 'how many calories should a cat eat',
            'seo_title'    => 'How Many Calories Should a Cat Eat? The Vet Formula Explained',
            'seo_desc'     => 'Discover the exact veterinary formula for cat calorie needs. Learn RER calculation, activity multipliers, and why most cats are overfed. Free cat food calculator included.',
            'image_url'    => 'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=1200&q=80&auto=format&fit=crop',
            'image_alt'    => 'Cat eating food from a bowl — how many calories should a cat eat',
            'content'      => petzenai_post1_content(),
        ],

        /* ── POST 2 ── */
        [
            'slug'         => 'dog-vaccine-chart-usa',
            'title'        => 'Dog Vaccine Chart USA: What Your Vet Won\'t Tell You Upfront',
            'date'         => '2025-12-18 08:00:00',
            'category'     => 'Dog Health',
            'excerpt'      => 'A complete dog vaccination schedule for USA pet owners — core vaccines, optional vaccines, puppy timelines, and real costs. Everything your vet assumes you already know.',
            'focus_kw'     => 'dog vaccine chart USA',
            'seo_title'    => 'Dog Vaccine Chart USA: Complete Schedule, Costs & Timeline (2025)',
            'seo_desc'     => 'Complete dog vaccination chart for USA. Core vaccines, puppy schedule, booster timing, costs ($15–$80), and lifestyle-based optional vaccines. Vet-approved guide.',
            'image_url'    => 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=1200&q=80&auto=format&fit=crop',
            'image_alt'    => 'Dog at vet getting vaccination — dog vaccine chart USA',
            'content'      => petzenai_post2_content(),
        ],

        /* ── POST 3 ── */
        [
            'slug'         => 'cat-age-calculator-how-old-is-your-cat',
            'title'        => 'Cat Age Calculator – How Old Is Your Cat Really?',
            'date'         => '2025-12-22 08:00:00',
            'category'     => 'Cat Care',
            'excerpt'      => 'Forget multiplying by 7. The real cat-to-human age formula is more complex — and far more accurate. Here\'s the science-backed method vets actually use, plus a full age chart.',
            'focus_kw'     => 'cat age calculator human years',
            'seo_title'    => 'Cat Age Calculator: Convert Cat Years to Human Years (2025 Guide)',
            'seo_desc'     => 'Use our free cat age calculator to find your cat\'s human age equivalent. Includes the vet-approved formula, full conversion chart, and senior care tips.',
            'image_url'    => 'https://images.unsplash.com/photo-1526336024174-e58f5cdd8e13?w=1200&q=80&auto=format&fit=crop',
            'image_alt'    => 'Cat relaxing — cat age calculator human years',
            'content'      => petzenai_post3_content(),
        ],

        /* ── POST 4 ── */
        [
            'slug'         => 'dog-feeding-chart-by-weight',
            'title'        => 'Dog Feeding Chart by Weight – The ONLY Guide You\'ll Ever Need',
            'date'         => '2025-12-25 08:00:00',
            'category'     => 'Dog Nutrition',
            'excerpt'      => 'A complete dog feeding chart by weight covering puppies, adults, seniors, and every size from 5 lbs to 100 lbs. Includes activity adjustments, common mistakes, and a 7-step system.',
            'focus_kw'     => 'dog feeding chart by weight',
            'seo_title'    => 'Dog Feeding Chart by Weight: Cups, Calories & Schedules (2025)',
            'seo_desc'     => 'Complete dog feeding chart by weight for all sizes. Includes daily cups, calories, puppy schedules, senior adjustments, and the rib test. Vet-reviewed guide.',
            'image_url'    => 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=1200&q=80&auto=format&fit=crop',
            'image_alt'    => 'Dog eating from bowl — dog feeding chart by weight',
            'content'      => petzenai_post4_content(),
        ],
    ];
}

/* ================================================================
   IMPORT RUNNER
   ================================================================ */
function petzenai_run_import() {
    $posts = petzenai_get_posts_data();

    foreach ( $posts as $p ) {
        // Skip if slug already exists
        if ( get_page_by_path( $p['slug'], OBJECT, 'post' ) ) continue;

        // Create / get category
        $cat = get_term_by( 'name', $p['category'], 'category' );
        if ( ! $cat ) {
            $cat = wp_insert_term( $p['category'], 'category' );
            $cat_id = is_wp_error($cat) ? 1 : $cat['term_id'];
        } else {
            $cat_id = $cat->term_id;
        }
        // Also add to 'blog' category
        $blog_cat = get_term_by( 'name', 'Blog', 'category' );
        if ( ! $blog_cat ) {
            $bc = wp_insert_term( 'Blog', 'category', ['slug' => 'blog'] );
            $blog_cat_id = is_wp_error($bc) ? 1 : $bc['term_id'];
        } else {
            $blog_cat_id = $blog_cat->term_id;
        }

        $post_id = wp_insert_post( [
            'post_title'   => $p['title'],
            'post_name'    => $p['slug'],
            'post_content' => $p['content'],
            'post_excerpt' => $p['excerpt'],
            'post_status'  => 'publish',
            'post_author'  => 1,
            'post_date'    => $p['date'],
            'post_category'=> [ $cat_id, $blog_cat_id ],
            'post_type'    => 'post',
        ] );

        if ( is_wp_error($post_id) || ! $post_id ) continue;

        /* ── Rank Math SEO meta ── */
        update_post_meta( $post_id, 'rank_math_title',            $p['seo_title'] );
        update_post_meta( $post_id, 'rank_math_description',      $p['seo_desc'] );
        update_post_meta( $post_id, 'rank_math_focus_keyword',    $p['focus_kw'] );
        update_post_meta( $post_id, 'rank_math_robots',           ['index','follow'] );
        update_post_meta( $post_id, 'rank_math_canonical_url',    home_url('/' . $p['slug'] . '/') );

        /* ── Open Graph (Rank Math) ── */
        update_post_meta( $post_id, 'rank_math_og_title',         $p['seo_title'] );
        update_post_meta( $post_id, 'rank_math_og_description',   $p['seo_desc'] );
        update_post_meta( $post_id, 'rank_math_twitter_title',    $p['seo_title'] );
        update_post_meta( $post_id, 'rank_math_twitter_description', $p['seo_desc'] );

        /* ── Also store for our fallback SEO ── */
        update_post_meta( $post_id, '_pz_seo_title',       $p['seo_title'] );
        update_post_meta( $post_id, '_pz_seo_description', $p['seo_desc'] );
        update_post_meta( $post_id, '_pz_focus_keyword',   $p['focus_kw'] );

        /* ── Set featured image via sideload ── */
        petzenai_set_featured_image( $post_id, $p['image_url'], $p['image_alt'], $p['title'] );
    }
}

function petzenai_set_featured_image( $post_id, $url, $alt, $title ) {
    if ( ! function_exists('media_sideload_image') ) {
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
    }
    $img_id = media_sideload_image( $url, $post_id, $title, 'id' );
    if ( ! is_wp_error( $img_id ) ) {
        update_post_meta( $img_id, '_wp_attachment_image_alt', sanitize_text_field($alt) );
        set_post_thumbnail( $post_id, $img_id );
    }
}

/* ================================================================
   POST CONTENT FUNCTIONS
   ================================================================ */
function petzenai_post1_content() {
    return <<<HTML
<!-- wp:paragraph -->
<p>Most cat owners guess at how much to feed their cat. They look at the back of the bag, maybe cut it in half, and hope for the best. But there's a better way — the same method veterinarians have used for decades.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>The Veterinary Formula for Cat Calories</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Vets calculate caloric needs using a two-step formula based on <strong>Resting Energy Requirement (RER)</strong>:</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>Step 1 — RER = 70 × (body weight in kg)^0.75
Step 2 — Daily calories = RER × Activity Multiplier</code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p>For example, a 4 kg adult indoor neutered cat:<br>RER = 70 × (4)^0.75 = 70 × 2.83 = <strong>198 kcal/day</strong><br>MER = 198 × 1.2 = <strong>~238 kcal/day</strong></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>Activity Multipliers — Which One Is Your Cat?</h2>
<!-- /wp:heading -->

<!-- wp:table -->
<figure class="wp-block-table"><table><thead><tr><th>Cat Type</th><th>Multiplier</th><th>Example</th></tr></thead><tbody><tr><td>Kitten (birth–4 months)</td><td>2.5×</td><td>Rapid growth phase</td></tr><tr><td>Kitten (4–12 months)</td><td>2.0×</td><td>Still growing</td></tr><tr><td>Adult — intact (not neutered)</td><td>1.6×</td><td>Full metabolism</td></tr><tr><td>Adult — neutered, indoor</td><td>1.2×</td><td>Most house cats</td></tr><tr><td>Adult — active / outdoor</td><td>1.6×</td><td>Hunts, roams</td></tr><tr><td>Overweight cat</td><td>1.0×</td><td>Weight loss mode</td></tr><tr><td>Senior (7+ years)</td><td>1.1×</td><td>Slower metabolism</td></tr><tr><td>Pregnant cat</td><td>2.0×</td><td>Third trimester</td></tr></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:heading {"level":2} -->
<h2>Daily Calorie Chart by Weight</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>For indoor neutered adult cats on a typical diet:</p>
<!-- /wp:paragraph -->

<!-- wp:table -->
<figure class="wp-block-table"><table><thead><tr><th>Cat Weight</th><th>Daily Calories (indoor neutered)</th><th>Dry Food (approx.)</th><th>Wet Food (approx.)</th></tr></thead><tbody><tr><td>2 kg (4.4 lbs)</td><td>118 kcal</td><td>⅓ cup</td><td>1 small can</td></tr><tr><td>3 kg (6.6 lbs)</td><td>166 kcal</td><td>½ cup</td><td>1.5 cans</td></tr><tr><td>4 kg (8.8 lbs)</td><td>212 kcal</td><td>⅔ cup</td><td>2 cans</td></tr><tr><td>5 kg (11 lbs)</td><td>255 kcal</td><td>¾ cup</td><td>2.5 cans</td></tr><tr><td>6 kg (13 lbs)</td><td>297 kcal</td><td>¾–1 cup</td><td>3 cans</td></tr><tr><td>7 kg (15 lbs)</td><td>336 kcal</td><td>1 cup</td><td>3.5 cans</td></tr></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:heading {"level":2} -->
<h2>Why Bag Guidelines Are Usually Wrong</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Pet food manufacturers have a financial incentive to recommend higher portions — more food consumed means more sales. Research from the <strong>Association for Pet Obesity Prevention</strong> shows that over 60% of cats in the United States are overweight or obese.</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li>Bag guidelines assume an <strong>active, unspayed/unneutered</strong> cat</li><li>Most indoor cats need <strong>20–30% less</strong> than the bag suggests</li><li>Labels don't account for treat calories</li><li>One cup of kibble ≈ 350–500 calories (brand-dependent)</li></ul>
<!-- /wp:list -->

<!-- wp:callout -->
<p><strong>💡 Pro Tip:</strong> Reduce bag recommendations by 20% and monitor your cat's body condition weekly. Adjust up or down by 10% based on the rib test.</p>
<!-- /wp:callout -->

<!-- wp:heading {"level":2} -->
<h2>Wet vs. Dry Food — Calorie Differences Matter</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The difference in caloric density between wet and dry food is dramatic:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li><strong>Dry kibble:</strong> 350–500 kcal per cup</li><li><strong>Wet/canned food:</strong> 70–100 kcal per 3 oz can</li><li>One cup of kibble ≈ 4–5 cans of wet food in calories</li></ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>Cats on wet food diets naturally consume more water and often maintain healthier weights because the high moisture content increases satiety.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>The 4 Biggest Cat Feeding Mistakes</h2>
<!-- /wp:heading -->

<!-- wp:list {"ordered":true} -->
<ol><li><strong>Free-feeding</strong> — Leaving food out all day. Most cats will overeat when food is always available.</li><li><strong>Ignoring neuter/spay changes</strong> — After spaying or neutering, a cat's caloric needs drop by 25–30% almost immediately.</li><li><strong>Forgetting treat calories</strong> — Treats should be no more than 10% of daily calories. One dental treat can be 25–40 calories.</li><li><strong>Not adjusting for age</strong> — Senior cats (7+) need slightly fewer calories but higher protein to preserve muscle mass.</li></ol>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2>How to Check Your Cat's Weight at Home</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>You don't need a special scale. Here's the easy method:</p>
<!-- /wp:paragraph -->

<!-- wp:list {"ordered":true} -->
<ol><li>Step on your bathroom scale alone. Note your weight.</li><li>Pick up your cat. Note the combined weight.</li><li>Subtract. That's your cat's weight.</li></ol>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>Weigh your cat monthly and keep a simple log. A consistent gain of more than 0.5 kg over 3 months warrants a vet conversation.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>Use Our Free Cat Food Calculator</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Want the exact calculation done for your cat? Use our free <a href="/pet-food-portion-calculator/">Pet Food Portion Calculator</a> — just enter your cat's weight, age, and activity level and get the precise daily portion in seconds.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><em>⚠️ This article is for informational purposes. If your cat has a medical condition, consult your veterinarian for personalized dietary advice.</em></p>
<!-- /wp:paragraph -->
HTML;
}

function petzenai_post2_content() {
    return <<<HTML
<!-- wp:paragraph -->
<p>Getting your dog vaccinated sounds simple — until you're at the vet and realize you have no idea which vaccines your dog actually needs, which are legally required, and what everything costs. Here's the complete guide most vets assume you already know.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Core Vaccines — Every Dog Needs These</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Core vaccines are recommended for <em>all</em> dogs regardless of lifestyle, location, or breed.</p>
<!-- /wp:paragraph -->

<!-- wp:table -->
<figure class="wp-block-table"><table><thead><tr><th>Vaccine</th><th>Protects Against</th><th>Puppy Schedule</th><th>Adult Booster</th><th>Cost (USD)</th></tr></thead><tbody><tr><td><strong>Rabies</strong></td><td>Rabies virus (fatal, zoonotic)</td><td>12–16 weeks</td><td>Every 1–3 years (by state law)</td><td>$15–$25</td></tr><tr><td><strong>DHPP / DA2PP</strong></td><td>Distemper, Hepatitis, Parvovirus, Parainfluenza</td><td>6–8w, 10–12w, 14–16w</td><td>Every 3 years</td><td>$25–$40</td></tr></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:callout -->
<p>⚠️ <strong>Rabies is legally required</strong> in all 50 US states. Failure to vaccinate can result in fines or mandatory quarantine if your dog bites someone.</p>
<!-- /wp:callout -->

<!-- wp:heading {"level":2} -->
<h2>Complete Puppy Vaccination Schedule</h2>
<!-- /wp:heading -->

<!-- wp:table -->
<figure class="wp-block-table"><table><thead><tr><th>Age</th><th>Vaccines</th><th>Notes</th></tr></thead><tbody><tr><td>6–8 weeks</td><td>DHPP #1</td><td>First vet visit</td></tr><tr><td>10–12 weeks</td><td>DHPP #2, Leptospirosis #1, Bordetella</td><td>Core + lifestyle</td></tr><tr><td>14–16 weeks</td><td>DHPP #3, Rabies, Leptospirosis #2</td><td>Legally required</td></tr><tr><td>12–16 months</td><td>DHPP booster, Rabies booster</td><td>1-year boosters</td></tr><tr><td>Every 1–3 years</td><td>DHPP, Rabies (per state law)</td><td>Adult maintenance</td></tr></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:heading {"level":2} -->
<h2>Non-Core (Optional) Vaccines — Based on Lifestyle</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>These vaccines are recommended based on where you live and how your dog lives.</p>
<!-- /wp:paragraph -->

<!-- wp:table -->
<figure class="wp-block-table"><table><thead><tr><th>Vaccine</th><th>Who Needs It</th><th>Frequency</th><th>Cost</th></tr></thead><tbody><tr><td><strong>Bordetella</strong> (Kennel Cough)</td><td>Dogs in daycare, boarding, dog parks</td><td>Annual or every 6 months</td><td>$20–$45</td></tr><tr><td><strong>Leptospirosis</strong></td><td>Dogs near wildlife, water, or farms</td><td>Annual (2-dose initial)</td><td>$15–$25</td></tr><tr><td><strong>Lyme Disease</strong></td><td>Northeast, Upper Midwest, Northern CA</td><td>Annual (2-dose initial)</td><td>$20–$40</td></tr><tr><td><strong>Canine Influenza</strong></td><td>High-exposure dogs, outbreak areas</td><td>Annual (2-dose initial)</td><td>$35–$55</td></tr><tr><td><strong>Rattlesnake</strong></td><td>Hiking dogs in Southwest US</td><td>Annual</td><td>$25–$40</td></tr></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:heading {"level":2} -->
<h2>First-Year Vaccination Costs</h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul><li><strong>Core vaccines only:</strong> $300–$500 first year</li><li><strong>Core + all optional:</strong> $500–$800 first year</li><li><strong>Low-cost clinic (Petco, Tractor Supply):</strong> $15–$25 per vaccine</li><li><strong>Private vet clinic:</strong> $40–$80 per vaccine</li></ul>
<!-- /wp:list -->

<!-- wp:callout -->
<p>💡 <strong>Save Money Tip:</strong> Many Tractor Supply stores, Petco, and PetSmart locations host low-cost vaccination clinics on weekends. You get the same vaccines at 40–60% less cost than a private vet visit.</p>
<!-- /wp:callout -->

<!-- wp:heading {"level":2} -->
<h2>Adult Dog Vaccination Schedule</h2>
<!-- /wp:heading -->

<!-- wp:table -->
<figure class="wp-block-table"><table><thead><tr><th>Vaccine</th><th>Frequency</th><th>Notes</th></tr></thead><tbody><tr><td>Rabies</td><td>Every 1 or 3 years</td><td>Depends on state law and vaccine type</td></tr><tr><td>DHPP</td><td>Every 3 years</td><td>After the 1-year booster</td></tr><tr><td>Bordetella</td><td>Every 6–12 months</td><td>Required by most boarding facilities</td></tr><tr><td>Leptospirosis</td><td>Annual</td><td>Protection wanes quickly</td></tr><tr><td>Lyme</td><td>Annual</td><td>Tick-endemic areas only</td></tr></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:heading {"level":2} -->
<h2>Track Your Dog's Vaccines Automatically</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Use our free <a href="/pet-vaccination-schedule/">Pet Vaccination Schedule Tracker</a> — enter your dog's birth date and it generates a complete, personalized vaccine schedule showing which vaccines are overdue, coming up, and completed.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><em>⚠️ Vaccine recommendations can vary by region and individual health status. Always confirm with your licensed veterinarian.</em></p>
<!-- /wp:paragraph -->
HTML;
}

function petzenai_post3_content() {
    return <<<HTML
<!-- wp:paragraph -->
<p>You've probably heard that one cat year equals seven human years. It's a nice round number. It's also completely wrong. The real formula is more nuanced — and understanding it can actually change how you care for your cat.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>The Veterinarian-Approved Formula</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The American Animal Hospital Association (AAHA) and veterinary researchers use this calculation:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li><strong>Year 1:</strong> 1 cat year = 15 human years</li><li><strong>Year 2:</strong> +9 human years (total: 24)</li><li><strong>Year 3+:</strong> each additional cat year = 4 human years</li></ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>So a 5-year-old cat is not 35 in human years — they're actually <strong>36 human years old</strong> (24 + 3×4).</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>Complete Cat Age to Human Years Chart</h2>
<!-- /wp:heading -->

<!-- wp:table -->
<figure class="wp-block-table"><table><thead><tr><th>Cat's Age</th><th>Human Years Equivalent</th><th>Life Stage</th></tr></thead><tbody><tr><td>1 month</td><td>~1 year</td><td>Newborn</td></tr><tr><td>6 months</td><td>~10 years</td><td>Adolescent</td></tr><tr><td>1 year</td><td>15 years</td><td>Young adult</td></tr><tr><td>2 years</td><td>24 years</td><td>Young adult</td></tr><tr><td>3 years</td><td>28 years</td><td>Prime</td></tr><tr><td>5 years</td><td>36 years</td><td>Prime</td></tr><tr><td>7 years</td><td>44 years</td><td>Mature</td></tr><tr><td>10 years</td><td>56 years</td><td>Senior</td></tr><tr><td>12 years</td><td>64 years</td><td>Senior</td></tr><tr><td>15 years</td><td>76 years</td><td>Geriatric</td></tr><tr><td>20 years</td><td>96 years</td><td>Exceptional elder</td></tr></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:heading {"level":2} -->
<h2>Why Indoor vs. Outdoor Makes Such a Difference</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The single biggest factor in a cat's lifespan isn't breed, diet, or genetics — it's whether they live indoors or outdoors.</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li><strong>Indoor cats:</strong> Average lifespan 12–18 years (often 20+)</li><li><strong>Outdoor cats:</strong> Average lifespan 2–5 years</li></ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>Outdoor cats face cars, predators, diseases (FIV, FeLV), parasites, and extreme weather. An indoor cat at age 10 is the equivalent of a healthy 56-year-old human. An outdoor cat at 10 has beaten the odds significantly.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>Long-Living Cat Breeds</h2>
<!-- /wp:heading -->

<!-- wp:table -->
<figure class="wp-block-table"><table><thead><tr><th>Breed</th><th>Average Lifespan</th><th>Notes</th></tr></thead><tbody><tr><td>Siamese</td><td>15–20 years</td><td>Longest-lived domestic breed</td></tr><tr><td>Russian Blue</td><td>15–20 years</td><td>Known for excellent health</td></tr><tr><td>Domestic Shorthair (mixed)</td><td>15–20 years</td><td>Genetic diversity advantage</td></tr><tr><td>Ragdoll</td><td>12–17 years</td><td>Gentle, indoor-suited</td></tr><tr><td>Persian</td><td>12–15 years</td><td>Requires dental care</td></tr><tr><td>Maine Coon</td><td>12–15 years</td><td>Can develop HCM</td></tr></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:heading {"level":2} -->
<h2>Senior Cat Care: What Changes at 7+</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Once your cat turns 7 (equivalent to 44 human years), their health needs shift significantly:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li><strong>Vet visits:</strong> Twice yearly instead of once (cats hide illness extremely well)</li><li><strong>Diet:</strong> Higher protein to preserve muscle mass; kidney-supportive nutrition</li><li><strong>Environment:</strong> Ramps or steps to reach favorite spots; lower-sided litter box</li><li><strong>Teeth:</strong> Annual dental cleanings become more critical</li><li><strong>Bloodwork:</strong> Annual panel to catch kidney disease, hyperthyroidism early</li></ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2>Try Our Free Cat Age Calculator</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Want to know your cat's exact human age equivalent? Use our free <a href="/pet-age-calculator/">Pet Age Calculator</a> — it uses the official veterinary formula and shows your cat's life stage and care recommendations.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><em>⚠️ Age is one factor in health. Regular vet check-ups remain the gold standard for senior cat care.</em></p>
<!-- /wp:paragraph -->
HTML;
}

function petzenai_post4_content() {
    return <<<HTML
<!-- wp:paragraph -->
<p>After 12 years of raising dogs, I've watched countless owners — including myself early on — guess at portions, trust the bag, and wonder why their dog is always begging. Here's the complete, no-nonsense guide to feeding your dog the right amount.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Adult Dog Daily Feeding Chart by Weight</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>This chart applies to healthy adult dogs (ages 1–7) eating standard dry kibble (~370 kcal/cup):</p>
<!-- /wp:paragraph -->

<!-- wp:table -->
<figure class="wp-block-table"><table><thead><tr><th>Dog's Weight</th><th>Daily Food</th><th>Daily Calories</th><th>Meals Per Day</th></tr></thead><tbody><tr><td>5 lbs (toy breeds)</td><td>½ cup</td><td>200–250 kcal</td><td>2–3 meals</td></tr><tr><td>10 lbs (small)</td><td>¾ cup</td><td>275–350 kcal</td><td>2–3 meals</td></tr><tr><td>20 lbs (small-medium)</td><td>1¼ cups</td><td>450–550 kcal</td><td>2 meals</td></tr><tr><td>30 lbs (medium)</td><td>1¾ cups</td><td>600–700 kcal</td><td>2 meals</td></tr><tr><td>40 lbs (medium-large)</td><td>2¼ cups</td><td>750–900 kcal</td><td>2 meals</td></tr><tr><td>50 lbs (large)</td><td>2¾ cups</td><td>900–1,100 kcal</td><td>2 meals</td></tr><tr><td>60 lbs (large)</td><td>3 cups</td><td>1,050–1,250 kcal</td><td>2 meals</td></tr><tr><td>70 lbs (large)</td><td>3½ cups</td><td>1,250–1,400 kcal</td><td>2 meals</td></tr><tr><td>80 lbs (extra large)</td><td>3¾ cups</td><td>1,400–1,550 kcal</td><td>2 meals</td></tr><tr><td>100 lbs (giant)</td><td>4½ cups</td><td>1,700–1,900 kcal</td><td>2 meals</td></tr></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:heading {"level":2} -->
<h2>Puppy Feeding Chart by Age and Expected Adult Size</h2>
<!-- /wp:heading -->

<!-- wp:table -->
<figure class="wp-block-table"><table><thead><tr><th>Puppy Age</th><th>Expected Adult Size</th><th>Daily Amount</th><th>Meals/Day</th></tr></thead><tbody><tr><td>8–12 weeks</td><td>Small (under 20 lbs)</td><td>½–1 cup</td><td>4 meals</td></tr><tr><td>8–12 weeks</td><td>Medium (20–50 lbs)</td><td>1–2 cups</td><td>4 meals</td></tr><tr><td>8–12 weeks</td><td>Large (50+ lbs)</td><td>2–3 cups</td><td>4 meals</td></tr><tr><td>3–6 months</td><td>Small</td><td>¾–1½ cups</td><td>3 meals</td></tr><tr><td>3–6 months</td><td>Medium</td><td>1¾–2¾ cups</td><td>3 meals</td></tr><tr><td>3–6 months</td><td>Large</td><td>3–5 cups</td><td>3 meals</td></tr><tr><td>6–12 months</td><td>Small</td><td>1–1½ cups</td><td>2 meals</td></tr><tr><td>6–12 months</td><td>Medium</td><td>2–3 cups</td><td>2 meals</td></tr><tr><td>6–12 months</td><td>Large</td><td>3½–6 cups</td><td>2 meals</td></tr></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:callout -->
<p>⚠️ <strong>Large-breed puppies MUST eat large-breed puppy food.</strong> Regular puppy food causes rapid growth that permanently damages developing joints.</p>
<!-- /wp:callout -->

<!-- wp:heading {"level":2} -->
<h2>Activity Level Adjustments</h2>
<!-- /wp:heading -->

<!-- wp:table -->
<figure class="wp-block-table"><table><thead><tr><th>Activity Level</th><th>Adjustment</th><th>Examples</th></tr></thead><tbody><tr><td>Couch potato (minimal exercise)</td><td>Reduce 10–20%</td><td>Indoor dogs, elderly dogs</td></tr><tr><td>Normal (daily walks)</td><td>Use chart as-is</td><td>Most family dogs</td></tr><tr><td>Active (running, lots of play)</td><td>Increase 20–30%</td><td>Fetch-obsessed, hiking dogs</td></tr><tr><td>Working dogs</td><td>Increase 50–100%</td><td>Farm, police, service dogs</td></tr></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:heading {"level":2} -->
<h2>Senior Dog Feeding (7+ Years)</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Senior dogs have slower metabolisms and need 20–30% fewer calories than their adult amounts:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li>Switch to <strong>senior formula food</strong> (easier digestion, joint support)</li><li>Reduce daily portion by 20–30% from adult chart</li><li>Consider 3 smaller meals if digestive issues arise</li><li>Soften dry food if dental problems exist</li><li>Senior onset: small breeds (10–12 yrs), large breeds (6–8 yrs), giants (5–6 yrs)</li></ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2>The Weekly Rib Test</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The most accurate way to know if you're feeding the right amount:</p>
<!-- /wp:paragraph -->

<!-- wp:list {"ordered":true} -->
<ol><li>Stand over your dog</li><li>Run your hands firmly along both sides of the ribcage</li><li>You should feel ribs easily with gentle pressure — but not see them</li><li>There should be a visible waist when viewed from above</li><li>A slight belly tuck when viewed from the side</li></ol>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>If you have to press hard to feel ribs → overfed. If ribs are visibly prominent → underfed.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>The 4 Biggest Dog Feeding Mistakes</h2>
<!-- /wp:heading -->

<!-- wp:list {"ordered":true} -->
<ol><li><strong>Free-feeding</strong> — Leaving food out all day leads to obesity in most dogs. Scheduled meals help you detect illness early (appetite loss is often the first sign).</li><li><strong>Over-trusting bag guidelines</strong> — Manufacturers recommend higher amounts to sell more food. Start 10–20% below the bag recommendation.</li><li><strong>Ignoring treat calories</strong> — One large Milk-Bone ≈ 100 calories. Treats should be maximum 10% of daily calories.</li><li><strong>Not adjusting after neutering</strong> — Spaying or neutering reduces metabolic rate by ~25%. Reduce food immediately after the procedure.</li></ol>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2>My 7-Step System (12 Years of Experience)</h2>
<!-- /wp:heading -->

<!-- wp:list {"ordered":true} -->
<ol><li>Start with the chart as your baseline</li><li>Reduce by 10% from the chart (most dogs need slightly less)</li><li>Feed at the same times every day (7am & 6pm works well)</li><li>Do the rib test every Sunday</li><li>Weigh your dog monthly (stand on bathroom scale holding dog, subtract your weight)</li><li>If needed, adjust by 10% up or down</li><li>Wait 2 full weeks before changing again</li></ol>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>Stop obsessing over the perfect number. Your dog will tell you through their body condition. The chart gets you close — the rib test keeps you accurate.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>Use Our Free Dog Food Calculator</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Get a precise daily portion calculated specifically for your dog's weight, age, breed size, and activity level with our free <a href="/pet-food-portion-calculator/">Pet Food Portion Calculator</a>.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><em>⚠️ These are guidelines for healthy dogs. Dogs with medical conditions (diabetes, kidney disease, allergies) require veterinarian-prescribed diets.</em></p>
<!-- /wp:paragraph -->
HTML;
}
