<?php
/**
 * Tool-specific content for: Canary Care Guide: Diet, Singing & Health (registry key: canary_care_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_canary_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Canaries are kept mainly for their song rather than for hands-on interaction, and male canaries sing far more than females, which is worth knowing before picking a bird if singing is the point. Unlike parrots and other flock birds, a single canary generally does fine alone and often does better that way, since two canaries housed together can become aggressive rather than bonded. Their care centers on a simple seed-and-pellet diet with fresh greens, a cage with horizontal room to fly, and a lifespan commonly cited around 10 to 15 years.</div>
<?php }

function pz_what_is_canary_care_guide() {
    ob_start(); ?>
    <p>This guide covers what makes canary care different from the parrot-family birds most pet bird advice is written for. Canaries aren't parrots at all; they're finches bred for centuries primarily for their singing voice, and that history shapes almost everything about how they're kept.</p>
    <p>The biggest difference is temperament and social structure. Parrots and parrot-family birds like lovebirds or budgies are flock animals that generally need company, whether from another bird or from frequent interaction with their owner. Canaries don't share that need. A canary kept alone in a suitably sized cage typically does fine, and in many cases prefers solitude, since canaries can be territorial and two canaries sharing a cage sometimes fight rather than keep each other company.</p>
    <p>The other defining trait is song. Male canaries are the singers; their song is the whole reason the species became popular as a pet, and a male in good health will sing regularly, especially in the morning. Females typically make simple calls rather than full song. Canaries also aren't talkers or mimics the way parrots can be, so anyone expecting words or tricks from a canary is thinking of the wrong type of bird entirely.</p>
    <?php return ob_get_clean();
}

function pz_why_important_canary_care_guide() {
    ob_start(); ?>
    <p>Getting canary care right starts with recognizing it's a fundamentally different care profile from parrot-family birds, not a smaller or simpler version of the same thing.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🎵</span>
        <div><strong>Song is the reason to have a canary at all</strong><p>If the goal is a singing bird, a male canary is the right choice; females generally don't sing, so sex matters a lot more here than with most other pet birds.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧍</span>
        <div><strong>Solo housing is normal, not a compromise</strong><p>Unlike flock-dependent parrots, a single canary in a properly sized cage generally does well on its own, and pairing two canaries can lead to territorial aggression rather than companionship.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">↔️</span>
        <div><strong>Cage shape matters more than cage interaction time</strong><p>Canaries are active flyers that need horizontal flying room more than they need hands-on attention, so cage dimensions matter more for this species than daily handling does.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🥗</span>
        <div><strong>Diet is simple compared with larger parrots</strong><p>A canary-specific seed mix or pellet blend with regular fresh greens covers most of their nutritional needs, without the variety-heavy diet planning larger parrots require.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_canary_care_guide() {
    return [
        ['title' => 'Decide if you want a singer, and pick a male if so', 'desc' => 'Male canaries sing; females generally don\'t, so confirm the sex of the bird you\'re getting if song is the reason for keeping one.'],
        ['title' => 'Choose a cage that\'s wide rather than tall', 'desc' => 'Canaries fly horizontally more than they climb, so a long, wide cage suits them better than a tall narrow one built for climbing parrots.'],
        ['title' => 'House your canary alone unless you have a specific breeding setup', 'desc' => 'A single canary in an appropriately sized cage typically does well on its own; housing two together risks territorial conflict rather than bonding.'],
        ['title' => 'Feed a canary-specific seed or pellet mix plus fresh greens', 'desc' => 'Canary feed blends are formulated for this species\' smaller size and needs; add leafy greens and small amounts of vegetables a few times a week.'],
        ['title' => 'Place the cage somewhere with a stable routine and light cycle', 'desc' => 'Canaries do best with a predictable daily schedule, consistent light and darkness hours, and a location away from drafts or constant disruption.'],
        ['title' => 'Watch for stopped singing or appetite changes', 'desc' => 'A male that suddenly stops singing, or any canary that stops eating normally, is a signal worth checking into rather than waiting out.'],
    ];
}

function pz_tips_canary_care_guide() {
    return [
        ['Don\'t expect talking or mimicry from a canary', 'This species communicates through song and simple calls, not speech or mimicked sounds, so that expectation belongs with parrots instead.'],
        ['Give a molting canary time and a little extra rest', 'Singing often decreases during a molt, which is a normal temporary change in behavior rather than a sign something is wrong.'],
        ['Position the cage near natural light but out of direct sun and drafts', 'Canaries respond well to a natural day-night rhythm, which also supports consistent singing in males.'],
        ['Keep bathing water available regularly', 'Canaries generally enjoy shallow bathing water a few times a week and it supports feather condition.'],
        ['Don\'t assume a quiet canary is simply shy', 'A previously vocal male that goes quiet for more than a day or two is worth a closer look rather than assumed personality.'],
    ];
}

function pz_mistakes_canary_care_guide() {
    return [
        ['❌ Housing two canaries together expecting companionship', 'This species doesn\'t pair up the way flock birds do, and putting two canaries in one cage can lead to fighting rather than bonding.'],
        ['❌ Buying a female expecting a singing bird', 'Song is primarily a male trait in canaries; a female bought for singing will likely disappoint that specific expectation.'],
        ['❌ Using a tall, narrow cage built for climbing birds', 'Canaries need horizontal flying space, and a cage shaped for a climbing parrot doesn\'t suit their flight pattern well.'],
        ['❌ Expecting hands-on bonding like a parrot', 'Canaries are generally not a handling-focused pet; trying to force frequent physical interaction goes against the species\' nature.'],
        ['❌ Ignoring a sudden stop in singing', 'A male canary that quits singing abruptly is showing a behavior change that\'s worth checking rather than dismissing.'],
    ];
}

function pz_faq_canary_care_guide() {
    return [
        ['Do canaries need a companion bird?', 'No. Unlike parrots, a single canary in a suitably sized cage typically does fine alone, and often prefers it, since two canaries together can become territorial.'],
        ['Why won\'t my canary sing?', 'Only males sing as a rule, and even males sing less during molting or when stressed, unwell, or kept on an inconsistent routine.'],
        ['Can canaries learn to talk like parrots?', 'No, canaries don\'t mimic speech or sounds the way some parrots do; their vocal repertoire is song and simple calls.'],
        ['How long do canaries typically live?', 'Owners commonly report a lifespan around 10 to 15 years for a well-kept canary, noticeably shorter than many larger parrot species.'],
        ['What should a canary cage look like?', 'Wider and longer rather than tall, since canaries fly horizontally rather than climbing, with enough room for short flights between perches.'],
        ['What do canaries eat day to day?', 'A canary-formulated seed or pellet mix as the base, with fresh leafy greens and small amounts of vegetables added regularly.'],
        ['Is it cruel to keep just one canary?', 'No. This species is naturally more solitary than flock birds like parrots, so a single canary with proper cage size and care is a normal, appropriate setup.'],
    ];
}
