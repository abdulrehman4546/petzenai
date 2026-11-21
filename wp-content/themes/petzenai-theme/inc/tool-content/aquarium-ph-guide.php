<?php
/**
 * Tool-specific content for: Aquarium pH Levels: Complete Guide (registry key: aquarium_ph_guide).
 * Registry type is 'guide' and uses the generic GUIDE/TRACKER renderer in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_aquarium_ph_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A pH in roughly the 6.5-7.5 range is commonly suitable for many community fish, but species needs vary a lot — African cichlids often prefer higher pH, while many South American species prefer lower, softer water. A stable "imperfect" pH is generally safer for fish than one that swings around, even if it averages closer to the ideal number.</div>
<?php }

function pz_what_is_aquarium_ph_guide() {
    ob_start(); ?>
    <p>pH measures how acidic or alkaline aquarium water is, on a scale where 7 is neutral. Many common community fish do reasonably well in a pH commonly cited around 6.5-7.5, but this is a general range, not a universal target — some species, like African cichlids, often prefer notably higher pH, while many South American species prefer lower, softer water.</p>
    <p>This guide covers that general range, why species-specific research matters more than chasing a single "ideal" number, and why a stable pH that isn't perfectly centered is usually safer than one that swings around even if it averages closer to a textbook target.</p>
    <?php return ob_get_clean();
}

function pz_why_important_aquarium_ph_guide() {
    ob_start(); ?>
    <p>pH affects how well fish tolerate their environment, and both the absolute level and its stability over time matter for fish health.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🧪</span>
        <div><strong>6.5-7.5 is a common range, not a universal rule</strong><p>Many community fish tolerate this range, but species-specific needs can fall well outside it.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐠</span>
        <div><strong>Some species have notably different pH preferences</strong><p>African cichlids commonly prefer higher pH, while many South American species prefer lower, softer water — research your specific fish rather than assuming the general range applies.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📉</span>
        <div><strong>Sudden pH swings are generally riskier than a stable off-target number</strong><p>A tank holding a steady pH that isn't perfectly centered is usually less stressful for fish than one that swings up and down, even around a more "ideal" average.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🔬</span>
        <div><strong>Testing is the only reliable way to know your actual pH</strong><p>Tap water and tank water can differ, and pH can drift over time, so periodic testing rather than assumption is the practical approach.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_aquarium_ph_guide() {
    return [
        ['title' => 'Test your source water before setup', 'desc' => 'Knowing your tap or source water\'s pH gives a baseline before fish are added.'],
        ['title' => 'Research your specific species\' pH preference', 'desc' => 'Look up whether your fish fall in the general 6.5-7.5 community range or need something notably higher or lower, like many cichlids or soft-water species.'],
        ['title' => 'Test tank water periodically, not just once', 'desc' => 'pH can drift over time due to factors like tank biology and decor, so an occasional recheck helps catch changes early.'],
        ['title' => 'Avoid chasing a perfect number with frequent additives', 'desc' => 'Repeated chemical adjustments can cause more pH instability than they fix — stability is usually more important than hitting an exact figure.'],
        ['title' => 'Make any necessary adjustments gradually', 'desc' => 'If pH needs to shift to suit your species, gradual changes are generally safer for fish than a sudden correction.'],
        ['title' => 'Match new fish to your tank\'s existing pH where possible', 'desc' => 'Choosing species that suit your water\'s natural pH is often simpler than trying to continuously alter the water to suit a mismatched species.'],
    ];
}

function pz_tips_aquarium_ph_guide() {
    return [
        ['Prioritize stability over hitting an exact number', 'A steady pH that is a bit outside the "ideal" range is generally less stressful for fish than one that fluctuates.'],
        ['Test at a consistent time of day', 'pH can shift slightly throughout the day, so testing at a similar time helps give comparable readings.'],
        ['Keep a simple log of readings over time', 'Tracking pH over weeks makes it easier to spot a gradual drift before it becomes a bigger swing.'],
        ['Research before mixing species with different pH needs', 'Combining species with very different pH preferences in one tank can make it hard to suit either comfortably.'],
        ['Avoid sudden large water changes in mismatched water', 'If your tap water\'s pH differs notably from your tank\'s, a very large sudden change can shift pH abruptly.'],
    ];
}

function pz_mistakes_aquarium_ph_guide() {
    return [
        ['❌ Chasing a single "perfect" pH number', 'Constant chemical adjustment to hit an exact figure often causes more instability than it solves.'],
        ['❌ Ignoring species-specific pH needs', 'Assuming the general 6.5-7.5 community range applies to every fish overlooks species like cichlids or soft-water fish with different preferences.'],
        ['❌ Only testing once at setup', 'pH can drift over time, so a single initial test doesn\'t tell you what\'s happening months later.'],
        ['❌ Making large, sudden pH adjustments', 'A fast swing in either direction shocks fish far more than simply living with water that sits slightly off the textbook number.'],
        ['❌ Mixing species with very different pH preferences', 'This can make it difficult to keep conditions suitable for either group of fish.'],
    ];
}

function pz_faq_aquarium_ph_guide() {
    return [
        ['What pH is best for a community fish tank?', 'A commonly cited range is about 6.5-7.5 for many community fish, though species needs vary.'],
        ['Do all fish need the same pH?', 'No — species like African cichlids commonly prefer higher pH, while many South American species prefer lower, softer water.'],
        ['Is a stable pH more important than a perfect pH?', 'Generally yes — a steady pH that isn\'t perfectly centered is usually less stressful for fish than one that swings around.'],
        ['How often should I test aquarium pH?', 'Periodic testing, rather than a single check at setup, helps catch gradual drift over time.'],
        ['Should I use chemical products to adjust pH?', 'Frequent chemical adjustments can create instability, so many keepers prioritize species selection suited to their existing water instead.'],
        ['Can sudden pH changes harm fish?', 'Sudden swings are generally considered riskier than a stable pH that is somewhat outside the ideal range.'],
    ];
}
