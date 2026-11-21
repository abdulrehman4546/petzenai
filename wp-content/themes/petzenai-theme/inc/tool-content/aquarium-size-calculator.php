<?php
/**
 * Tool-specific content for: Fish Tank Size Calculator: Gallons Per Fish (registry key: aquarium_size_calculator).
 * Registry type is 'guide' (changed from 'calculator', which had no dedicated render function and fell
 * back to a mammal weight/life-stage/breed-size widget that made no sense for a fish tank). The page
 * widget is pz_render_guide_aquarium_size_calculator() below in inc/tool-renderer.php — a static
 * quick-reference card (gallons-per-inch rule of thumb + its limits), not an interactive calculator.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_aquarium_size_calculator() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A widely-cited starting rule of thumb is about one gallon of water per inch of adult fish length, but this is only a rough starting point — bioload, filtration strength, and how much a species actually swims and grows all shift the real number up or down.</div>
<?php }

function pz_what_is_aquarium_size_calculator() {
    ob_start(); ?>
    <p>Figuring out what size tank a fish needs starts with a simple, widely-cited guideline: roughly one gallon of water per inch of the fish's expected adult length. It's a useful starting point for a rough estimate, not a precise formula — two fish of the same adult length can have very different space needs depending on how much they swim, how messy they are, and how social or territorial they are.</p>
    <p>This guide walks through that starting rule of thumb and the main factors that push the real number higher: bioload (how much waste a fish produces relative to its size), filtration capacity, and whether a fish is kept alone or in a group. Treat any number from this rule as a floor to build from, not a target to hit exactly.</p>
    <?php return ob_get_clean();
}

function pz_why_important_aquarium_size_calculator() {
    ob_start(); ?>
    <p>Undersizing a tank is one of the more common and preventable mistakes in fishkeeping, and it affects water quality and fish health well before it becomes visually obvious.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">📏</span>
        <div><strong>"Gallon per inch" is a starting point, not a hard rule</strong><p>It's a widely-cited rough guideline, but it doesn't account for bioload, swimming behavior, or group size on its own.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💩</span>
        <div><strong>Bioload matters as much as length</strong><p>A messier, higher-waste species needs more water volume to dilute and process that waste than a similarly sized but lower-bioload fish.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🌀</span>
        <div><strong>Filtration capacity changes what a tank can support</strong><p>Stronger filtration can help a tank handle more bioload, but it doesn't eliminate the need for adequate swimming space.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐟</span>
        <div><strong>Group and schooling fish need more than a per-fish sum suggests</strong><p>Social species kept in groups often need more swimming room than simply multiplying a single fish's space requirement by the group size.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_aquarium_size_calculator() {
    return [
        ['title' => 'Look up the adult size of the fish, not its current size', 'desc' => 'A young fish at the pet store is often far from its full adult length, so plan the tank around where it will end up, not where it starts.'],
        ['title' => 'Apply the gallon-per-inch rule as a rough floor', 'desc' => 'Multiply the adult length in inches by roughly one gallon to get a starting minimum — then treat that number as a floor, not a target.'],
        ['title' => 'Adjust upward for bioload and messiness', 'desc' => 'Species known for being heavy waste producers or messy eaters generally need more volume than the basic rule suggests.'],
        ['title' => 'Account for schooling or group-living species', 'desc' => 'If the species needs to be kept in a group for its wellbeing, plan for more total space than a simple per-fish multiplication would give you.'],
        ['title' => 'Match filtration to the stocking level you land on', 'desc' => 'A tank at the higher end of its stocking capacity needs filtration strong enough to keep up with the resulting bioload.'],
        ['title' => 'Re-check sizing before adding new fish to an existing tank', 'desc' => 'Stocking decisions should account for every fish already in the tank, not just the new addition on its own.'],
    ];
}

function pz_tips_aquarium_size_calculator() {
    return [
        ['Research adult size before buying, not after', 'Many popular species sold small grow considerably larger, which changes the tank size they\'ll eventually need.'],
        ['Treat the gallon-per-inch rule as a floor, not a ceiling', 'Erring toward more space than the rough minimum gives more margin for bioload and behavior differences between species.'],
        ['Factor in swimming style, not just length', 'An active, fast-swimming species often benefits from more horizontal space than its length alone would suggest.'],
        ['Upgrade filtration before upgrading stocking', 'If you\'re considering adding more fish to a tank, confirm the filtration can handle the added bioload first.'],
        ['Research species-specific group size minimums', 'Schooling species often have a genuine minimum group size for wellbeing, which affects total space needs more than most new owners expect.'],
    ];
}

function pz_mistakes_aquarium_size_calculator() {
    return [
        ['❌ Sizing the tank around a fish\'s current size, not its adult size', 'A fish that\'s small now may need a much larger tank once fully grown, making this one of the most common sizing mistakes.'],
        ['❌ Treating the gallon-per-inch rule as an exact formula', 'It\'s a rough starting guideline, not a precise calculation — bioload, behavior, and filtration all shift the real number.'],
        ['❌ Ignoring bioload differences between species', 'Two fish of the same length can have very different real-world space needs depending on how much waste they produce.'],
        ['❌ Underestimating space needs for schooling fish', 'Multiplying a single fish\'s space requirement by the group size often undersells what a social species actually needs.'],
        ['❌ Adding more fish without reassessing filtration', 'A tank\'s filtration needs to scale with its total bioload, not just its total water volume.'],
    ];
}

function pz_faq_aquarium_size_calculator() {
    return [
        ['What is the gallon-per-inch rule for fish tanks?', 'It\'s a widely-cited rough guideline of about one gallon of water per inch of adult fish length, meant as a rough starting point rather than an exact formula.'],
        ['Is the gallon-per-inch rule accurate for every fish?', 'No — it doesn\'t account for bioload, swimming behavior, or whether a species needs to be kept in a group, all of which can push the real number higher.'],
        ['Should I size a tank for a fish\'s current size or adult size?', 'Always plan around the adult size, since many fish sold young are far from their full-grown length.'],
        ['Do schooling fish need more space than the gallon-per-inch rule suggests?', 'Often yes — species that need to be kept in groups for their wellbeing typically require more total swimming room than a simple per-fish multiplication would indicate.'],
        ['Does filtration affect how many fish a tank can hold?', 'Yes — stronger filtration can help a tank handle more bioload, but it doesn\'t replace the need for adequate swimming space.'],
        ['Does this tool give me an exact tank size number?', 'This page is built around general stocking and sizing guidance rather than a precise calculated output — use the gallon-per-inch starting point alongside species-specific research for your particular fish.'],
    ];
}
