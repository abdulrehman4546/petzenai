<?php
/**
 * Tool-specific content for: Gerbil Care Guide for Beginners (registry key: gerbil_care_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 * New small-pets cluster, distinct from hamster: desert-adapted with low water needs, social species
 * housed in same-sex pairs/groups (contrast with a Syrian hamster's strict solitary rule), active diggers,
 * and generally more active during the day than a hamster's nocturnal pattern.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_gerbil_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Gerbils are desert-adapted animals with efficient kidneys that let them get by on far less water relative to their body size than many other small pets. They're a social species and tend to thrive with same-sex cagemates — a far cry from a Syrian hamster, which has to be housed by itself to avoid fights. Gerbils are enthusiastic diggers, so deep bedding for tunneling is a priority rather than an extra. They're also more active during the day than a hamster, which is nocturnal, so you'll see more daytime activity from a gerbil.</div>
<?php }

function pz_what_is_gerbil_care_guide() {
    ob_start(); ?>
    <p>Gerbils are small, desert-adapted rodents kept as pets, and several of their core needs differ from a <a href="/tools/hamster-care-guide/">hamster's</a> — gerbils are social animals that do better with same-sex company, are active during more of the day, and are driven diggers.</p>
    <p>This guide covers the desert physiology behind their low water needs, the social housing that contrasts with a Syrian hamster's solitary rule, their digging behavior, and their daytime activity pattern.</p>
    <?php return ob_get_clean();
}

function pz_why_important_gerbil_care_guide() {
    ob_start(); ?>
    <p>A few gerbil-specific facts matter more than people expect, and several of them run in the opposite direction from what new owners might assume based on a hamster.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">💧</span>
        <div><strong>Desert-adapted kidneys mean low water needs</strong><p>Gerbils evolved in arid environments and have efficient kidneys that let them get by on comparatively little water for their body size, which is a genuine physiological difference from most other small pets.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">👥</span>
        <div><strong>Pairing is the norm here, not the exception</strong><p>A single gerbil kept without cagemates tends to seem bored or withdrawn over time, where a Syrian hamster in the same setup is simply behaving as nature intended.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🕳️</span>
        <div><strong>Digging is a core natural behavior</strong><p>Gerbils are enthusiastic diggers, so deep bedding that supports tunneling is a welfare priority, not just a comfort upgrade.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">☀️</span>
        <div><strong>More active during the day than a hamster</strong><p>Gerbils show meaningfully more daytime activity than a hamster, which is nocturnal and most active from dusk through the night.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_gerbil_care_guide() {
    return [
        ['title' => 'Plan for same-sex pairs or a small group', 'desc' => 'Set up housing for at least two from the start — a solo gerbil can get by, but company is where this species actually does best, the reverse of the strict solo setup a Syrian hamster needs.'],
        ['title' => 'Add deep bedding for digging and tunneling', 'desc' => 'Gerbils are driven diggers, so substrate depth that supports tunneling behavior is a genuine welfare need, not a cosmetic touch.'],
        ['title' => 'Keep water available but don\'t overcompensate', 'desc' => 'Gerbils\' desert-adapted kidneys mean they naturally use less water than many other small pets, so fresh water should still be available but excess dampness in the habitat should be avoided.'],
        ['title' => 'Expect activity throughout more of the day', 'desc' => 'Unlike a hamster, which is nocturnal, gerbils show noticeably more daytime activity, so handling and enrichment can often happen earlier than you would with a hamster.'],
        ['title' => 'Feed a balanced commercial gerbil mix', 'desc' => 'A quality commercial mix formulated for gerbils, with small amounts of fresh vegetables, covers most nutritional needs.'],
        ['title' => 'Introduce same-sex pairs gradually', 'desc' => 'Letting two gerbils sniff each other through a divider first, then combining their scents on neutral territory before a full introduction, lowers the odds of a fight once they\'re fully together.'],
    ];
}

function pz_tips_gerbil_care_guide() {
    return [
        ['Don\'t house a gerbil alone by default', 'A lone gerbil tends to miss out on the companionship same-sex pairs or small groups provide — very different from a Syrian hamster, who needs to live without cagemates.'],
        ['Give bedding enough depth for real tunneling', 'A shallow layer doesn\'t support the digging behavior gerbils are driven to express.'],
        ['Don\'t assume a gerbil needs extra water because it\'s small', 'Their desert-adapted kidneys mean gerbils naturally use less water relative to body size than many other small pets.'],
        ['Expect more daytime activity than a hamster', 'Because gerbils are active during more of the day, you have more flexible, daytime-friendly windows for handling, rather than needing to time it around a nocturnal hamster\'s evening schedule.'],
        ['Watch a new pairing closely during introductions', 'A gradual, supervised introduction reduces the risk of conflict even between two social gerbils.'],
    ];
}

function pz_mistakes_gerbil_care_guide() {
    return [
        ['❌ Housing a gerbil completely alone', 'Gerbils are social and generally do better with same-sex company, unlike a Syrian hamster, which must be kept solitary.'],
        ['❌ Using shallow bedding that doesn\'t support digging', 'Gerbils are enthusiastic diggers, so bedding depth that allows real tunneling matters for their welfare.'],
        ['❌ Keeping the habitat overly damp', 'Because gerbils are desert-adapted and use comparatively little water, excess moisture in bedding can be a bigger problem for them than it is for some other small pets.'],
        ['❌ Expecting hamster-like nighttime-only activity', 'Gerbils are noticeably more active during the day than a nocturnal hamster, so applying hamster handling schedules doesn\'t fit.'],
        ['❌ Pairing unfamiliar adult gerbils without supervision', 'Two unfamiliar adult gerbils can scuffle if just dropped into the same habitat, so a slower, scent-swapping introduction protects against a fight breaking out.'],
    ];
}

function pz_faq_gerbil_care_guide() {
    return [
        ['Should gerbils be kept alone or with other gerbils?', 'With others, ideally. As a social species, gerbils generally fare better in same-sex pairs or small groups — a Syrian hamster is the one that needs to live by itself.'],
        ['Do gerbils need a lot of water?', 'No. Gerbils are desert-adapted with efficient kidneys, so they naturally need comparatively little water relative to their body size, though fresh water should still always be available.'],
        ['Why does my gerbil dig so much?', 'Digging is a core natural behavior for gerbils, so deep bedding that supports tunneling is an important welfare feature of their habitat, not just an enrichment extra.'],
        ['Are gerbils nocturnal like hamsters?', 'Not in the same way. Gerbils are noticeably more active during the day than a hamster, which is nocturnal and most active from dusk through the night.'],
        ['How should I introduce two gerbils to each other?', 'Gradually and under supervision. Gerbils are social, but pairing still goes more smoothly with a careful introduction than placing unfamiliar gerbils directly together.'],
    ];
}
