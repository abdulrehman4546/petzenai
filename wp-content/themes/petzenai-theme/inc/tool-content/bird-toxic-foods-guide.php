<?php
/**
 * Tool-specific content for: Foods Toxic to Birds: Complete Safety List (registry key: bird_toxic_foods_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_bird_toxic_foods_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Avocado, chocolate, caffeine, alcohol, and onion or garlic in any real quantity are all unsafe for pet birds and should never be offered. These foods are widely and consistently flagged as unsafe for birds, regardless of species, so the safest approach is to keep them out of reach entirely rather than offering a small amount as a treat.</div>
<?php }

function pz_what_is_bird_toxic_foods_guide() {
    ob_start(); ?>
    <p>This guide lists the foods that are widely and uncontroversially considered unsafe for pet birds, so you can check before sharing something from your own plate or kitchen. It focuses on foods with broad agreement across avian care sources, not obscure or disputed claims.</p>
    <p>Birds are often fed from the table with good intentions, but several common human foods that are harmless or even healthy for people carry real risk for a bird. Avocado, chocolate, caffeine, and alcohol are the names that come up most consistently across bird care guidance.</p>
    <p>This list is meant as a quick safety reference, not a substitute for an avian vet if your bird has already eaten something on it — if that happens, contact an avian vet or a poison control line promptly rather than waiting to see what happens.</p>
    <?php return ob_get_clean();
}

function pz_why_important_bird_toxic_foods_guide() {
    ob_start(); ?>
    <p>Birds are often given table scraps because owners assume anything safe for a person is probably fine in small amounts, but several everyday foods are genuinely unsafe for birds.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🥑</span>
        <div><strong>Avocado is unsafe for birds</strong><p>Avocado is one of the most consistently flagged unsafe foods for pet birds and should never be offered, including the skin, pit, or flesh.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🍫</span>
        <div><strong>Chocolate and caffeine are both unsafe</strong><p>Chocolate and caffeinated drinks like coffee and tea are unsafe for birds and should be kept well out of reach, not just off the feeding list.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🍷</span>
        <div><strong>Alcohol is unsafe even in small amounts</strong><p>Birds are small enough that even a small amount of alcohol is risky, so spilled drinks and unattended glasses are a real hazard around a pet bird.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧄</span>
        <div><strong>Onion and garlic in quantity are unsafe</strong><p>Onion and garlic are commonly flagged as unsafe for birds in any real quantity, so dishes containing them should not be shared, even if a tiny trace seems harmless.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_bird_toxic_foods_guide() {
    return [
        ['title' => 'Keep avocado completely out of reach', 'desc' => 'Avocado in any form is unsafe for birds, so keep guacamole, avocado toast, and whole avocados away from a bird\'s cage and any out-of-cage area.'],
        ['title' => 'Never offer chocolate or caffeinated drinks', 'desc' => 'Chocolate, coffee, tea, and energy drinks are all unsafe for birds and should be kept off counters and tables a bird can reach during out-of-cage time.'],
        ['title' => 'Supervise drinks and alcohol closely', 'desc' => 'Alcohol is unsafe even in small amounts, so cover or put away drinks whenever your bird is out of its cage.'],
        ['title' => 'Avoid dishes with onion or garlic', 'desc' => 'Onion and garlic in any real quantity are unsafe for birds, so cooked dishes containing them should not be shared as table scraps.'],
        ['title' => 'Check unfamiliar foods before sharing', 'desc' => 'If you are unsure whether something is safe, treat it as off-limits and check with an avian vet rather than guessing.'],
        ['title' => 'Store unsafe foods where a bird cannot reach them', 'desc' => 'Out-of-cage time means a bird can access counters and tables, so store avocado, chocolate, and alcohol somewhere it genuinely cannot get to.'],
    ];
}

function pz_tips_bird_toxic_foods_guide() {
    return [
        ['Keep table scraps to known-safe foods only', 'Sticking to foods you know are safe for your bird\'s species avoids the guesswork of checking every new item in the moment.'],
        ['Be especially careful during meals and parties', 'Unattended plates and drinks during busy moments are when a bird is most likely to get into something unsafe.'],
        ['Watch for unattended cups and glasses', 'A bird exploring a table can easily dip into a drink left within reach, so clearing cups promptly during out-of-cage time helps.'],
        ['Tell guests and family what not to share', 'Well-meaning visitors may try to share chocolate or a sip of a drink without realizing it is unsafe for a bird, so a quick heads-up helps.'],
        ['Act quickly if your bird eats something unsafe', 'Contact an avian vet or a poison control line right away if your bird has eaten avocado, chocolate, or anything containing alcohol, rather than waiting to see if symptoms appear.'],
    ];
}

function pz_mistakes_bird_toxic_foods_guide() {
    return [
        ['❌ Assuming a small amount is harmless', 'Foods like avocado, chocolate, and alcohol are treated as unsafe in any amount for a bird, not just in large quantities.'],
        ['❌ Sharing from your own plate without checking', 'A dish that is perfectly fine for a person can still contain onion, garlic, chocolate, or caffeine that is unsafe for a bird.'],
        ['❌ Leaving drinks unattended near an out-of-cage bird', 'Alcohol and caffeinated drinks left on a table are an easy way for a curious bird to get into something unsafe.'],
        ['❌ Not telling guests about unsafe foods', 'Visitors may offer a treat without knowing it is unsafe, so a quick reminder before they interact with your bird helps prevent accidents.'],
        ['❌ Waiting to see symptoms before calling a vet', 'If a bird has eaten something known to be unsafe, contacting an avian vet promptly is safer than waiting to see whether symptoms show up.'],
    ];
}

function pz_faq_bird_toxic_foods_guide() {
    return [
        ['Is avocado really unsafe for birds?', 'Yes — avocado is one of the most widely and consistently flagged unsafe foods for pet birds and should never be offered in any form.'],
        ['Can birds have chocolate at all?', 'No — chocolate is unsafe for birds and should be kept out of reach entirely, not offered even as an occasional small treat.'],
        ['Is caffeine unsafe for birds?', 'Yes — coffee, tea, and other caffeinated drinks are unsafe for birds and should be kept away from areas a bird can access.'],
        ['Can birds have onion or garlic?', 'Onion and garlic in any real quantity are commonly flagged as unsafe for birds, so dishes containing them should not be shared.'],
        ['What should I do if my bird eats something on this list?', 'Contact an avian vet or a poison control line promptly, rather than waiting to see if symptoms appear.'],
        ['Is a small sip of alcohol okay for a bird?', 'No — birds are small enough that even a small amount of alcohol carries real risk, so drinks should be kept well away from a bird.'],
    ];
}
