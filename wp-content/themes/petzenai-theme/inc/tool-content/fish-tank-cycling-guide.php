<?php
/**
 * Tool-specific content for: Fish Tank Nitrogen Cycle Guide for Beginners (registry key: fish_tank_cycling_guide).
 * Registry type is 'guide' and uses the generic GUIDE/TRACKER renderer in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_fish_tank_cycling_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Cycling is the process of growing beneficial bacteria that convert ammonia into nitrite and then into nitrate. A brand-new tank commonly needs several weeks of cycling — often with no fish, or very few — before it is ready to safely support a normal fish population.</div>
<?php }

function pz_what_is_fish_tank_cycling_guide() {
    ob_start(); ?>
    <p>The nitrogen cycle in an aquarium refers to the process by which beneficial bacteria colonize the tank and convert fish waste and uneaten food into less harmful byproducts — first ammonia into nitrite, and then nitrite into nitrate. A brand-new tank doesn't have these bacteria established yet, which is why it commonly needs to cycle before it can safely support a typical fish population.</p>
    <p>This guide covers the basic concept of cycling, why a new tank commonly needs several weeks before it is considered cycled, and how test kits are used to track that process rather than guessing when it's finished.</p>
    <?php return ob_get_clean();
}

function pz_why_important_fish_tank_cycling_guide() {
    ob_start(); ?>
    <p>Cycling matters because ammonia and nitrite are both harmful to fish at elevated levels, and a newly set up tank has no established bacteria to break them down yet.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🔄</span>
        <div><strong>The cycle has two main bacterial conversion steps</strong><p>Beneficial bacteria convert ammonia into nitrite, and then a different group of bacteria converts nitrite into the less harmful nitrate.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⏳</span>
        <div><strong>Cycling commonly takes several weeks</strong><p>Building up a stable bacterial colony is a gradual process — there's no fixed exact day count, so it is commonly described as a period of several weeks.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐠</span>
        <div><strong>Adding fish before cycling (or adding too many too soon) is risky</strong><p>Without established bacteria, ammonia and nitrite can build up to harmful levels when fish waste has nowhere to go.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧪</span>
        <div><strong>Test kits are the main way to track cycling progress</strong><p>Watching ammonia and nitrite levels rise and then fall, as nitrate appears, is how most keepers confirm a tank has finished cycling.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_fish_tank_cycling_guide() {
    return [
        ['title' => 'Decide between fishless cycling or a very light fish-in approach', 'desc' => 'Fishless cycling, using an ammonia source instead of fish, avoids exposing fish to the ammonia and nitrite spikes during the process.'],
        ['title' => 'Add a source of ammonia to start the process', 'desc' => 'This feeds the bacteria that need to establish themselves, whether from a fishless ammonia source or, in a fish-in approach, from a very small, hardy fish population.'],
        ['title' => 'Test water regularly for ammonia, nitrite, and nitrate', 'desc' => 'Tracking these three values over time is how you follow the cycle\'s progress rather than guessing.'],
        ['title' => 'Watch for the typical pattern to emerge', 'desc' => 'Ammonia commonly rises first, then falls as nitrite rises, and finally nitrite falls as nitrate appears — this pattern indicates the bacteria colonies are establishing.'],
        ['title' => 'Wait until ammonia and nitrite both read zero consistently', 'desc' => 'A tank is commonly considered cycled once ammonia and nitrite stay at zero with nitrate present, generally after several weeks.'],
        ['title' => 'Add fish gradually once cycling is complete', 'desc' => 'Adding a full fish population all at once, even to a cycled tank, can still temporarily stress the bacterial balance — a gradual approach is generally gentler.'],
    ];
}

function pz_tips_fish_tank_cycling_guide() {
    return [
        ['Be patient with the timeline', 'Cycling commonly takes several weeks, and rushing the process by adding fish too early is one of the most common beginner mistakes.'],
        ['Keep a simple log of your test results', 'Tracking ammonia, nitrite, and nitrate over time makes the overall trend easier to see than isolated single readings.'],
        ['Consider fishless cycling if possible', 'Using an ammonia source instead of fish avoids putting fish through the ammonia and nitrite spikes that happen during cycling.'],
        ['Avoid cleaning the filter media too aggressively during cycling', 'The beneficial bacteria largely live on filter media and surfaces, so overly harsh cleaning can set the process back.'],
        ['Don\'t rely on a fixed day count', 'Cycling duration varies by tank, so testing water parameters is more reliable than counting days from setup.'],
    ];
}

function pz_mistakes_fish_tank_cycling_guide() {
    return [
        ['❌ Adding a full stock of fish to a brand-new tank', 'Without established bacteria, this can lead to harmful ammonia and nitrite spikes.'],
        ['❌ Assuming the tank is cycled based on time alone', 'Testing water parameters is more reliable than assuming a tank is ready after a set number of weeks.'],
        ['❌ Giving up on fishless cycling too early', 'The bacterial conversion process takes time to establish, and the typical ammonia-then-nitrite-then-nitrate pattern can take a while to fully emerge.'],
        ['❌ Overcleaning filter media during the cycling period', 'This can remove the beneficial bacteria that the whole process depends on.'],
        ['❌ Adding all intended fish at once right after cycling finishes', 'Even a cycled tank can benefit from a gradual approach to adding a full fish population.'],
    ];
}

function pz_faq_fish_tank_cycling_guide() {
    return [
        ['What is the nitrogen cycle in a fish tank?', 'It\'s the process by which beneficial bacteria convert ammonia into nitrite and then nitrite into nitrate, making a tank safer for fish.'],
        ['How long does it take to cycle a fish tank?', 'There\'s no fixed exact number, but it is commonly described as a period of several weeks.'],
        ['Can I add fish before the tank is cycled?', 'This is generally discouraged, since a tank without established bacteria can develop harmful ammonia and nitrite levels when fish waste accumulates.'],
        ['What is fishless cycling?', 'It\'s a method of cycling a tank using an ammonia source instead of fish, which avoids exposing fish to the ammonia and nitrite spikes during the process.'],
        ['How do I know when my tank is done cycling?', 'Testing shows ammonia and nitrite consistently at zero while nitrate is present, which commonly happens after several weeks.'],
        ['Does a cycled tank still need water testing?', 'Yes — ongoing testing helps monitor water quality even after the initial cycling process is complete.'],
    ];
}
