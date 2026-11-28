<?php
/**
 * Tool-specific content for: Hamster Care Guide: Cage, Diet & Health (registry key: hamster_care_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 * This is the shorter, at-a-glance tool-page companion referenced from the longer narrative blog post
 * inc/blog-content/hamster-care-guide-beginners.php. It intentionally stays a quick-reference checklist
 * rather than repeating the species-by-species depth already covered by hamster-cage-size-calculator.php,
 * hamster-wheel-size-guide.php, and hamster-lifespan-guide.php — it links to those for detail instead.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_hamster_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Hamsters need a cage with generous floor space, several inches of deep bedding for burrowing, and a wheel sized to let them run with a flat back. Syrian hamsters must be housed completely alone, since they are strictly solitary and will fight if paired. Hamsters are nocturnal, most active from dusk through the night, so handling sessions go better in the evening than during the day. Their diet is omnivorous, built around a quality commercial mix with small amounts of fresh vegetables and occasional protein.</div>
<?php }

function pz_what_is_hamster_care_guide() {
    ob_start(); ?>
    <p>This is a quick-reference checklist covering the fundamentals of hamster care: cage setup, the solitary housing rule, nocturnal activity, and diet basics. For deeper detail, our <a href="/tools/hamster-cage-size-calculator/">hamster cage size calculator</a>, <a href="/tools/hamster-wheel-size-guide/">hamster wheel size guide</a>, and <a href="/tools/hamster-lifespan-guide/">hamster lifespan guide</a> each go further into those specific topics, and our <a href="/blog/hamster-care-guide-beginners/">full beginner's guide</a> walks through everything in more narrative detail, including species differences, taming, and health signs.</p>
    <p>Use this page as a fast checklist if you already have the basics down and just want to confirm you're not missing anything important.</p>
    <?php return ob_get_clean();
}

function pz_why_important_hamster_care_guide() {
    ob_start(); ?>
    <p>A handful of hamster-specific facts matter more than people expect, and getting them wrong is a common source of preventable stress or harm.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🏠</span>
        <div><strong>Cage size is the most commonly underestimated factor</strong><p>Most pet store starter cages fall well short of the floor space a hamster actually needs, so checking real dimensions against a recommended minimum matters more than trusting the packaging.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🚫</span>
        <div><strong>Syrian hamsters must be housed alone</strong><p>This is fixed biology, not a matter of personality match — Syrian hamsters housed together, even littermates, will typically fight once they reach maturity, and these fights can be serious.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🌙</span>
        <div><strong>Hamsters are nocturnal</strong><p>Their natural activity window runs from dusk through the night, so waking a sleeping hamster during the day for play can trigger a startled, defensive reaction rather than being a kindness.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🛞</span>
        <div><strong>Wheel size needs to match body length</strong><p>A wheel that's too small forces an arched running posture, so matching wheel diameter to your hamster's species and size is a genuine welfare consideration, not a cosmetic choice.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_hamster_care_guide() {
    return [
        ['title' => 'Choose a cage with generous floor space', 'desc' => 'Prioritize usable floor area over decorative platforms, and check real dimensions rather than trusting pet store labeling — our cage size calculator has specific minimums.'],
        ['title' => 'Add several inches of deep bedding', 'desc' => 'Hamsters are natural burrowers, so substrate depth supports a core natural behavior, not just comfort.'],
        ['title' => 'Confirm your hamster is housed alone if it\'s a Syrian', 'desc' => 'Syrian hamsters are strictly solitary and must not be paired with another hamster; some dwarf species can sometimes cohabit with careful monitoring, but this is never guaranteed.'],
        ['title' => 'Match the wheel to the species and size', 'desc' => 'A wheel that lets your hamster run with a flat back, not an arched one, is the goal — see our wheel size guide for specific diameters by species.'],
        ['title' => 'Feed a balanced omnivorous diet', 'desc' => 'A quality commercial hamster mix or lab block, supplemented with small amounts of fresh vegetables and occasional protein, covers most nutritional needs.'],
        ['title' => 'Respect the nocturnal schedule', 'desc' => 'Plan handling sessions for evening onward, once your hamster has naturally woken, rather than disturbing daytime sleep.'],
    ];
}

function pz_tips_hamster_care_guide() {
    return [
        ['Measure before you buy a cage', 'Pet store packaging labeled "hamster cage" isn\'t a reliable guide to whether the floor space is actually adequate.'],
        ['Never assume a hamster wants a cage-mate', 'For the most popular pet hamster species, a companion is a welfare and safety risk rather than a kindness.'],
        ['Check wheel fit by watching your hamster run', 'A flat back while running is the clearest sign of a properly sized wheel; an arched back means it\'s time to size up.'],
        ['Let your hamster settle in before handling', 'A new hamster generally needs a week or two to adjust to a new home and your scent before handling begins.'],
        ['Use our other hamster tools for specifics', 'The cage size calculator, wheel size guide, and lifespan guide each cover one topic in more depth than this checklist.'],
    ];
}

function pz_mistakes_hamster_care_guide() {
    return [
        ['❌ Judging cage size by what\'s marketed for hamsters', 'Retail packaging isn\'t a reliable guide to whether the floor space inside actually meets a hamster\'s real needs — measure it yourself.'],
        ['❌ Pairing up a Syrian hamster for company', 'Solitary housing is fixed biology for this species rather than a preference, so companionship isn\'t a kindness here the way it might be for a different pet.'],
        ['❌ Disturbing a hamster during its daytime rest', 'A hamster roused suddenly while deeply asleep can react defensively, since this schedule mismatch isn\'t how the species naturally wants to interact.'],
        ['❌ Not double-checking the wheel that ships with a cage kit', 'Bundled accessories are chosen for cost and convenience, not necessarily for fitting a particular hamster\'s body length correctly.'],
        ['❌ Letting a hamster self-select only the tasty pieces from a seed mix', 'Picking out favorite bits while ignoring the rest can leave gaps in overall nutrition compared to a complete commercial mix.'],
    ];
}

function pz_faq_hamster_care_guide() {
    return [
        ['What\'s the single biggest setup mistake new hamster owners make?', 'Underestimating cage size. Our hamster cage size calculator breaks down specific floor-space minimums if you want the full detail.'],
        ['Is it ever okay to house two hamsters together?', 'Not for a Syrian hamster — that species is strictly solitary. A few dwarf species sometimes tolerate same-sex pairs with careful, ongoing monitoring, but it\'s never a guaranteed arrangement.'],
        ['When is the best time to handle a hamster?', 'In the evening or later, once it has naturally woken from its daytime rest, rather than during its main sleep window.'],
        ['How do I know if my hamster\'s current wheel actually fits?', 'Watch its back while it runs — it should stay roughly flat rather than curving upward. Our hamster wheel size guide covers exact diameters if you want to double-check against your hamster\'s species.'],
        ['Is a seed mix enough on its own for a hamster\'s diet?', 'Not reliably, since a hamster can pick out preferred pieces and skip the rest. A complete commercial mix or lab block as the base, with fresh extras added in, covers nutrition more consistently.'],
    ];
}
