<?php
/**
 * Tool-specific content for: Reptile Feeding Calculator & Schedule (registry key: reptile_feeding_calculator).
 * Registry type changed from 'calculator' to 'guide' — a generic mammal weight/breed-size widget doesn't fit reptiles,
 * and feeding needs here are frequency/schedule guidance by reptile type rather than a single calculated output.
 * Uses a dedicated static widget in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_reptile_feeding_calculator() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Reptile feeding frequency varies hugely by type rather than following one universal schedule. Snakes like a ball python typically eat whole prey infrequently, commonly on a roughly one-to-two-week cycle as adults. Omnivorous lizards such as a bearded dragon eat more often, generally daily or close to it depending on age. Insectivorous geckos such as a leopard gecko often need frequent small feedings. This page gives schedule guidance by reptile type rather than a single calculated amount, since the right answer depends heavily on species.</div>
<?php }

function pz_what_is_reptile_feeding_calculator() {
    ob_start(); ?>
    <p>This page offers feeding frequency and schedule guidance organized by broad reptile type, rather than a single calculated amount, because how often a reptile eats varies enormously depending on whether it's a snake, an omnivorous lizard, or an insectivorous gecko.</p>
    <p>It's meant to be read alongside species-specific care guides on this site — the ball python guide covers its specific feeding schedule, the bearded dragon guide covers its omnivorous diet and how the insect-to-vegetable ratio shifts with age, and the leopard gecko guide covers its insect-only diet, with the frequency guidance on this page filling in the schedule side for the bearded dragon and leopard gecko.</p>
    <?php return ob_get_clean();
}

function pz_why_important_reptile_feeding_calculator() {
    ob_start(); ?>
    <p>Feeding frequency is one of the areas where reptile care differs most by type, which is why a single calculated number wouldn't fit every reptile.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🐍</span>
        <div><strong>Snakes eat whole prey infrequently</strong><p>A constrictor like a ball python typically eats whole prey and, as an adult, is commonly fed roughly every one to two weeks rather than daily.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦎</span>
        <div><strong>Omnivorous lizards generally eat more often</strong><p>A species like the bearded dragon generally eats daily or close to it, with the insect-to-vegetable ratio shifting as it matures.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦗</span>
        <div><strong>Insectivorous geckos often need frequent small feedings</strong><p>A species like the leopard gecko relies on insects and commonly needs more frequent, smaller feedings than a snake does.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📋</span>
        <div><strong>Schedule guidance works better here than one calculated output</strong><p>Because feeding needs vary so much by type, frequency guidance organized by reptile type is more useful than a single generic number.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_reptile_feeding_calculator() {
    return [
        ['title' => 'Identify which broad category your reptile falls into', 'desc' => 'Snake, omnivorous lizard, and insectivorous gecko each follow a different general feeding frequency pattern.'],
        ['title' => 'For snakes, expect an infrequent whole-prey schedule', 'desc' => 'Adult snakes such as a ball python are commonly fed roughly every one to two weeks rather than daily.'],
        ['title' => 'For omnivorous lizards, plan for daily or near-daily feeding', 'desc' => 'A bearded dragon generally eats daily or close to it, with the diet shifting from more insects to more vegetables with age.'],
        ['title' => 'For insectivorous geckos, plan for more frequent small feedings', 'desc' => 'A leopard gecko commonly needs smaller, more frequent feedings compared to the infrequent meals a snake eats.'],
        ['title' => 'Cross-check against your species\' dedicated care guide', 'desc' => 'Species-specific guides give more detail than this general frequency-by-type overview can.'],
        ['title' => 'Reassess frequency as a juvenile reptile matures into an adult', 'desc' => 'Feeding frequency commonly changes with age across most reptile types, not just diet composition.'],
    ];
}

function pz_tips_reptile_feeding_calculator() {
    return [
        ['Don\'t apply a snake\'s infrequent schedule to a lizard or gecko', 'Omnivorous lizards and insectivorous geckos generally need to eat far more often than an infrequently fed snake.'],
        ['Don\'t feed a snake as often as a daily-eating lizard', 'A snake\'s whole-prey, infrequent feeding pattern is a core difference from a lizard\'s daily or near-daily routine.'],
        ['Revisit frequency as your reptile ages', 'Juveniles and adults often need different feeding frequency within the same species, not just a different diet mix.'],
        ['Use species-specific guides for the finer details', 'This page covers general patterns by type, while a dedicated care guide covers the specifics for one species.'],
        ['Expect some normal variation even within a type', 'Individual reptiles can vary somewhat even within the same general feeding category.'],
    ];
}

function pz_mistakes_reptile_feeding_calculator() {
    return [
        ['❌ Feeding a snake on a daily lizard-style schedule', 'A snake\'s infrequent whole-prey feeding pattern is very different from the daily or near-daily routine an omnivorous lizard needs.'],
        ['❌ Feeding an insectivorous gecko as infrequently as a snake', 'A gecko commonly needs more frequent small feedings than the once-every-one-to-two-weeks pattern typical of an adult snake.'],
        ['❌ Expecting one universal reptile feeding schedule', 'Feeding frequency varies hugely between snakes, omnivorous lizards, and insectivorous geckos, so no single schedule fits all of them.'],
        ['❌ Ignoring how frequency changes with age', 'Feeding frequency commonly shifts as a reptile matures from juvenile to adult, within most of these types.'],
        ['❌ Skipping the species-specific guide for added detail', 'This general overview by type is a starting point; a dedicated species guide covers more specific feeding detail.'],
    ];
}

function pz_faq_reptile_feeding_calculator() {
    return [
        ['How often should I feed my reptile?', 'It depends heavily on type — snakes like a ball python eat infrequently, omnivorous lizards like a bearded dragon eat daily or close to it, and insectivorous geckos like a leopard gecko often need frequent small feedings.'],
        ['Why isn\'t there a single feeding amount calculator here?', 'Because feeding needs vary so much by reptile type, frequency guidance organized by type is more useful and more accurate than one generic calculated number.'],
        ['Do snakes and lizards eat on the same schedule?', 'No — a snake\'s whole-prey, infrequent feeding is very different from an omnivorous lizard\'s daily or near-daily routine.'],
        ['Does feeding frequency change as a reptile ages?', 'Yes, feeding frequency commonly shifts as a reptile matures from juvenile to adult, across most of these reptile types.'],
        ['Where can I find feeding details for my specific species?', 'The ball python care guide covers its specific feeding schedule directly. The bearded dragon care guide covers its omnivorous diet and how the ratio shifts with age, and the leopard gecko care guide covers its insect-only diet — this page fills in the frequency guidance for those two.'],
    ];
}
