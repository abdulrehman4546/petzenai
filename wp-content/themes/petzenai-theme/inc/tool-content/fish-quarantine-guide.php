<?php
/**
 * Tool-specific content for: Fish Quarantine Tank: How & Why Guide (registry key: fish_quarantine_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_fish_quarantine_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A separate quarantine tank lets new fish be observed before joining an established tank, which helps prevent introducing illness to fish already living there. Quarantine periods are commonly described in terms of several weeks rather than an exact number of days, and the observation period is a good time to watch for the same kinds of signs covered in a fish disease checker.</div>
<?php }

function pz_what_is_fish_quarantine_guide() {
    ob_start(); ?>
    <p>A quarantine tank is a separate, smaller setup used to hold new fish apart from an established main tank for a period of observation before introducing them to their permanent home. The idea is simple: a new fish might be carrying something that isn't visible yet, and keeping it isolated for a while gives you a chance to notice problems before they can spread to an entire established tank.</p>
    <p>This guide covers why a separate quarantine tank is worth setting up, roughly how long to keep a new fish there, and what to watch for during that observation period.</p>
    <?php return ob_get_clean();
}

function pz_why_important_fish_quarantine_guide() {
    ob_start(); ?>
    <p>Skipping quarantine means any issue a new fish is carrying gets introduced directly to an established tank, where it can affect every fish already living there.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🏥</span>
        <div><strong>Quarantine helps catch problems before they spread</strong><p>Isolating a new fish for an observation period reduces the chance that an unnoticed issue reaches an entire established tank.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📅</span>
        <div><strong>Duration is commonly described as several weeks, not an exact number</strong><p>There's no single fixed day count that applies to every fish or situation, so a wider observation window is the more common approach.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">👀</span>
        <div><strong>The quarantine period is for active observation</strong><p>Watching appetite, behavior, and appearance during this time is what makes quarantine useful, not just the isolation itself.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐠</span>
        <div><strong>Protects fish already established in the main tank</strong><p>The fish already living in the main tank have the most to lose if a new arrival introduces an unnoticed problem.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_fish_quarantine_guide() {
    return [
        ['title' => 'Set up a separate quarantine tank in advance', 'desc' => 'Having it ready before bringing a new fish home avoids rushing the setup once the fish arrives.'],
        ['title' => 'Move the new fish into quarantine first, not the main tank', 'desc' => 'Going straight into the established tank skips the observation window that makes quarantine useful.'],
        ['title' => 'Observe for a period commonly described in weeks', 'desc' => 'A wider window, rather than a short exact number of days, gives more issues time to become noticeable.'],
        ['title' => 'Watch for the same signs covered in a fish disease checker', 'desc' => 'Changes in appetite, swimming, or appearance during quarantine are worth noting as part of that observation.'],
        ['title' => 'Only move the fish to the main tank once it looks consistently normal', 'desc' => 'A fish that still shows signs of a problem shouldn\'t be introduced to the established tank yet.'],
        ['title' => 'Keep quarantine equipment separate from main tank equipment', 'desc' => 'Using separate nets and tools for quarantine helps avoid accidentally carrying something over to the main tank.'],
    ];
}

function pz_tips_fish_quarantine_guide() {
    return [
        ['Keep quarantine simple but functional', 'A basic cycled setup with filtration and heating, if needed, is enough — it doesn\'t need to be elaborate.'],
        ['Use a longer observation window rather than a shorter one', 'Since quarantine duration is commonly described as several weeks, erring longer gives more time for issues to show.'],
        ['Check on the new fish daily during quarantine', 'Regular observation is what makes the quarantine period useful, not just the time that passes.'],
        ['Keep separate equipment for the quarantine tank', 'Dedicated nets and tools reduce the chance of carrying anything over to the main tank.'],
        ['Don\'t rush the timeline because the fish looks fine early on', 'Some issues take time to become visible, which is part of why a shorter quarantine period is less reliable.'],
    ];
}

function pz_mistakes_fish_quarantine_guide() {
    return [
        ['❌ Adding new fish directly to the main tank', 'This skips the observation window that helps catch problems before they reach fish already established there.'],
        ['❌ Cutting quarantine short because the fish seems fine', 'Some issues take time to become noticeable, so an early all-clear can be misleading.'],
        ['❌ Using the same net or tools in quarantine and the main tank', 'This can undo the benefit of quarantine by transferring something between tanks anyway.'],
        ['❌ Not watching closely during the quarantine period', 'Quarantine is only useful if the fish is actually observed for signs, not just left isolated.'],
        ['❌ Treating quarantine as unnecessary for "healthy-looking" fish', 'A fish can appear outwardly normal while still carrying something not yet visible.'],
    ];
}

function pz_faq_fish_quarantine_guide() {
    return [
        ['Why do new fish need a quarantine tank?', 'Keeping a new fish separate for an observation period helps catch problems before they can spread to fish already established in the main tank.'],
        ['How long should a fish stay in quarantine?', 'There\'s no single fixed number — it\'s commonly described as a period of several weeks rather than a short, exact day count.'],
        ['What should I watch for during quarantine?', 'The same general signs covered in a fish disease checker, such as changes in appetite, swimming, or appearance.'],
        ['Can I skip quarantine if the new fish looks healthy?', 'It\'s generally not recommended — some issues aren\'t visible right away, which is part of why the observation period matters.'],
        ['Should quarantine equipment be shared with the main tank?', 'No, using separate nets and tools helps avoid accidentally carrying something between the quarantine and main tanks.'],
    ];
}
