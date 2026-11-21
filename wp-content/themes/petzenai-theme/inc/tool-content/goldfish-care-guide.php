<?php
/**
 * Tool-specific content for: Goldfish Care Guide: Tank Setup & Feeding (registry key: goldfish_care_guide).
 * Registry type changed from generic to a dedicated 'guide' widget (the default guide fallback asks for
 * pet name/age/breed/weight, which makes no sense here). Static widget is
 * pz_render_guide_goldfish_care_guide() in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_goldfish_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Goldfish are a coldwater species, commonly kept around 65-72°F without needing a heater. They produce far more waste relative to their size than most keepers expect, so they need larger tanks and stronger filtration than their small starting size suggests. Well-cared-for goldfish are often cited as living 10-15+ years or longer, a lifespan frequently cut short by undersized bowl-style keeping.</div>
<?php }

function pz_what_is_goldfish_care_guide() {
    ob_start(); ?>
    <p>Goldfish care differs in a few key ways from the assumptions many new keepers start with. As a coldwater species, goldfish are commonly kept around 65-72°F, a different category from tropical fish that need a heater — the point here is simply that goldfish fall in that cooler category, not the warmer tropical range.</p>
    <p>What surprises most new keepers is bioload: goldfish produce a lot more waste relative to their body size than many other common aquarium fish, which means they typically need bigger tanks and more filtration capacity than their initial small size would suggest. This guide also covers why goldfish can live a long time — commonly cited as 10-15+ years or more with good care — and why that long potential lifespan is so often cut short by small-bowl keeping, plus how fancy and common/comet varieties differ enough to affect care.</p>
    <?php return ob_get_clean();
}

function pz_why_important_goldfish_care_guide() {
    ob_start(); ?>
    <p>Several widely held assumptions about goldfish don't match what the species actually needs, which leads to undersized, under-filtered setups.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">❄️</span>
        <div><strong>Goldfish are coldwater, not tropical</strong><p>They're commonly kept around 65-72°F, a cooler category than tropical species, generally without needing supplemental heating in most homes.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💩</span>
        <div><strong>Goldfish produce a surprisingly high bioload</strong><p>Relative to their size, goldfish generate more waste than many other common aquarium fish, so filtration and tank size need to account for that, not just the fish's current length.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📅</span>
        <div><strong>Goldfish can live a long time with proper care</strong><p>A lifespan of 10-15+ years is commonly cited for well-kept goldfish, though small-bowl keeping is a frequent reason that potential lifespan is cut short.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐟</span>
        <div><strong>Fancy and common/comet varieties aren't identical to care for</strong><p>Fancy goldfish body shapes often swim less efficiently than sleeker common or comet types, which can affect feeding, tank layout, and what to watch for physically.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_goldfish_care_guide() {
    return [
        ['title' => 'Confirm goldfish fall in the coldwater category for your setup', 'desc' => 'Most homes don\'t need a heater for goldfish, since they\'re commonly kept around 65-72°F.'],
        ['title' => 'Size the tank for bioload, not just current fish length', 'desc' => 'Because goldfish produce more waste than their size implies, plan for a larger tank and stronger filtration than you might for a similarly sized tropical fish.'],
        ['title' => 'Identify whether you have a fancy or common/comet variety', 'desc' => 'Fancy body shapes generally swim less efficiently, which can affect how you feed and what swimming changes are worth watching for.'],
        ['title' => 'Plan filtration with goldfish\'s waste output in mind', 'desc' => 'Stronger filtration than the tank size alone would suggest is a common recommendation specifically because of goldfish bioload.'],
        ['title' => 'Set realistic long-term expectations', 'desc' => 'Goldfish are often cited as living 10-15+ years or more, so their housing is more of a long-term commitment than a short-lived bowl fish.'],
        ['title' => 'Monitor water quality more closely than you might for a lighter-waste species', 'desc' => 'Given the higher bioload, periodic testing helps catch water quality issues before they build up.'],
    ];
}

function pz_tips_goldfish_care_guide() {
    return [
        ['Don\'t assume goldfish are a "beginner bowl fish"', 'Their actual space, filtration, and longevity needs are more demanding than the classic small-bowl image suggests.'],
        ['Match tank size to adult bioload, not juvenile size', 'Goldfish grow and keep producing more waste over a long lifespan, so plan ahead rather than sizing for the fish\'s current length.'],
        ['Research swimming ability before choosing fancy varieties', 'Some fancy body types are more prone to buoyancy or swimming difficulties than sleeker common or comet goldfish.'],
        ['Keep filtration maintenance consistent given the higher waste load', 'Goldfish tanks often benefit from more attentive filter upkeep than lighter-bioload species.'],
        ['Think in years, not months, when planning a goldfish\'s home', 'A well-kept goldfish\'s long potential lifespan makes the initial setup worth getting right from the start.'],
    ];
}

function pz_mistakes_goldfish_care_guide() {
    return [
        ['❌ Keeping goldfish in a small decorative bowl', 'This undersized setup doesn\'t account for their bioload or long-term growth, and is commonly linked to cutting their potential 10-15+ year lifespan short.'],
        ['❌ Sizing the tank only to the goldfish\'s current length', 'Goldfish bioload and growth mean a tank sized for the young fish often becomes inadequate as it matures.'],
        ['❌ Under-filtering because the tank "looks" big enough', 'Goldfish produce more waste than many similarly sized fish, so filtration needs often exceed what the tank size alone would suggest.'],
        ['❌ Assuming all goldfish varieties swim and behave the same', 'Fancy body types can have different swimming ability and care needs compared to common or comet goldfish.'],
        ['❌ Adding a heater goldfish don\'t need', 'As a coldwater species, goldfish are commonly kept around 65-72°F, generally without supplemental heating in most home environments.'],
    ];
}

function pz_faq_goldfish_care_guide() {
    return [
        ['Do goldfish need a heater?', 'Usually not — goldfish are a coldwater species commonly kept around 65-72°F, which most homes reach without supplemental heating.'],
        ['Why do goldfish need such a big tank?', 'Goldfish produce a lot more waste relative to their size than many other aquarium fish, so tank size and filtration need to account for that bioload, not just the fish\'s length.'],
        ['How long do goldfish live?', 'Well-cared-for goldfish are commonly cited as living 10-15+ years or more, though that lifespan is often cut short by small-bowl keeping.'],
        ['Are fancy goldfish harder to care for than common goldfish?', 'In some ways yes — fancy body shapes often swim less efficiently than sleeker common or comet types, which can affect feeding and the physical issues worth watching for.'],
        ['Can goldfish live with tropical fish?', 'Generally not recommended, since goldfish are coldwater while tropical fish need warmer heated water, and the two categories\' comfortable ranges don\'t overlap well.'],
        ['Is a small bowl ever appropriate for a goldfish?', 'No — bowl-style keeping is a frequently cited reason goldfish don\'t reach their potential long lifespan, due to insufficient space and filtration for their bioload.'],
    ];
}
