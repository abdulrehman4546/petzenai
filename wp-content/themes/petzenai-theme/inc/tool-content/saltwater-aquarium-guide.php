<?php
/**
 * Tool-specific content for: Saltwater Aquarium Setup Guide for Beginners (registry key: saltwater_aquarium_guide).
 * Registry type changed from generic to a dedicated 'guide' widget (the default guide fallback asks for
 * pet name/age/breed/weight, which makes no sense here). Static widget is
 * pz_render_guide_saltwater_aquarium_guide() in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_saltwater_aquarium_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A saltwater, or marine, tank differs from a freshwater one mainly in needing a salinity measurement (specific gravity), generally higher equipment and maintenance demands, and often live rock that needs to be "cured" before fish are added. Marine fish and invertebrates also tend to be more sensitive to swings in water parameters than most freshwater community fish.</div>
<?php }

function pz_what_is_saltwater_aquarium_guide() {
    ob_start(); ?>
    <p>A saltwater (marine) aquarium is fundamentally different from a freshwater setup, not just a freshwater tank with salt added. The core new concept is salinity, usually measured as specific gravity, which needs regular testing alongside the water quality checks any aquarium requires.</p>
    <p>Saltwater setups generally come with higher equipment, cost, and maintenance demands than freshwater tanks, partly because marine fish and invertebrates tend to be more sensitive to swings in water parameters. Many saltwater tanks also use live rock, porous rock colonized by beneficial organisms, which typically needs a "curing" period to let organic matter die off and stabilize before fish are introduced. This guide focuses on what's different about the marine side rather than repeating general freshwater water-quality basics.</p>
    <?php return ob_get_clean();
}

function pz_why_important_saltwater_aquarium_guide() {
    ob_start(); ?>
    <p>Approaching a saltwater tank with only freshwater assumptions is a common reason beginners run into trouble early on.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🧂</span>
        <div><strong>Salinity (specific gravity) is a new measurement to track</strong><p>Freshwater tanks don't require this at all, but marine tanks need regular salinity testing alongside standard water quality checks.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💰</span>
        <div><strong>Equipment and maintenance demands are generally higher</strong><p>Saltwater setups commonly require more specialized equipment and more consistent maintenance than an equivalent freshwater tank.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🪸</span>
        <div><strong>Live rock typically needs curing before fish go in</strong><p>This curing period lets organic matter on the rock die off and stabilize, which is a step freshwater setups don't involve.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚠️</span>
        <div><strong>Marine species are often more sensitive to parameter swings</strong><p>Saltwater fish and invertebrates commonly tolerate less fluctuation in water conditions than many freshwater community fish.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_saltwater_aquarium_guide() {
    return [
        ['title' => 'Learn to test and maintain salinity (specific gravity)', 'desc' => 'This is the core new measurement a marine tank requires that a freshwater setup doesn\'t involve at all.'],
        ['title' => 'Budget for generally higher equipment and maintenance needs', 'desc' => 'Saltwater setups commonly cost more and require more consistent upkeep than an equivalent freshwater tank.'],
        ['title' => 'Cure live rock before adding fish, if your setup uses it', 'desc' => 'Letting organic matter on the rock die off and stabilize during curing helps avoid a rough start for the tank\'s water quality.'],
        ['title' => 'Research your specific marine species\' sensitivity', 'desc' => 'Many saltwater species tolerate less parameter fluctuation than freshwater community fish, so stability matters even more here.'],
        ['title' => 'Test water parameters more frequently than you might for freshwater', 'desc' => 'Given the added sensitivity of many marine species, closer monitoring is generally the safer approach.'],
        ['title' => 'Research equipment needs specific to marine setups', 'desc' => 'Protein skimmers, specific lighting for corals, and other marine-specific equipment are considerations freshwater tanks typically don\'t need.'],
    ];
}

function pz_tips_saltwater_aquarium_guide() {
    return [
        ['Don\'t treat salinity testing as optional', 'It\'s one of the defining differences from freshwater care and needs regular monitoring, not a one-time check.'],
        ['Be patient with the live rock curing process', 'Rushing fish into a tank before curing is complete can expose them to unstable water conditions.'],
        ['Expect a steeper learning curve than freshwater', 'The higher sensitivity of marine species and added equipment mean saltwater tanks generally ask more of a beginner than freshwater does.'],
        ['Research specific marine species before buying, not after', 'Given the added parameter sensitivity, matching a species to your setup and experience level in advance matters more here than with hardier freshwater fish.'],
        ['Budget ongoing costs, not just the initial setup', 'Saltwater maintenance demands tend to be higher on an ongoing basis, not just at initial purchase.'],
    ];
}

function pz_mistakes_saltwater_aquarium_guide() {
    return [
        ['❌ Treating a saltwater tank like a freshwater tank with salt added', 'The differences go well beyond salinity, including equipment, maintenance demands, and species sensitivity.'],
        ['❌ Skipping or rushing the live rock curing process', 'Adding fish before curing is complete can expose them to unstable, still-stabilizing water conditions.'],
        ['❌ Underestimating ongoing maintenance and cost', 'Saltwater setups generally demand more consistent upkeep and specialized equipment than an equivalent freshwater tank.'],
        ['❌ Assuming marine species tolerate the same parameter swings as freshwater fish', 'Many saltwater species are more sensitive to fluctuation, so the stability standard needs to be higher.'],
        ['❌ Not testing salinity regularly', 'Specific gravity can drift, so periodic testing, not a single setup check, is needed to keep it in range.'],
    ];
}

function pz_faq_saltwater_aquarium_guide() {
    return [
        ['What\'s the main difference between saltwater and freshwater tanks?', 'Salinity (specific gravity) is the core new concept, along with generally higher equipment and maintenance demands and often more sensitive species.'],
        ['Do saltwater tanks need more maintenance than freshwater tanks?', 'Generally yes — saltwater setups commonly require more consistent upkeep and more specialized equipment than an equivalent freshwater tank.'],
        ['What is live rock curing?', 'It\'s a stabilization period for live rock that lets organic matter die off before fish are added, reducing the risk of poor water conditions early on.'],
        ['Are saltwater fish more sensitive than freshwater fish?', 'Many marine species tolerate less fluctuation in water parameters than common freshwater community fish, making stability especially important.'],
        ['Is saltwater aquarium keeping harder for beginners?', 'It generally involves a steeper learning curve than freshwater, due to the added salinity measurement, equipment needs, and species sensitivity.'],
        ['How often should I test salinity?', 'Regularly, not just at setup — specific gravity can drift over time, so periodic testing helps keep it within range.'],
    ];
}
