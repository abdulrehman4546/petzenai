<?php
/**
 * Tool-specific content for: Fish Tank Lighting Guide: Hours & Types (registry key: fish_tank_lighting_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_fish_tank_lighting_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Most community tanks do well with about 8-10 hours of consistent lighting per day. A live-plant tank generally needs more specific, stronger lighting than a fish-only tank, and too much light combined with excess nutrients is a common cause of algae problems.</div>
<?php }

function pz_what_is_fish_tank_lighting_guide() {
    ob_start(); ?>
    <p>Aquarium lighting serves two different purposes depending on the tank: letting fish see a normal day-night pattern, and in planted tanks, providing the energy live plants need for photosynthesis. A fish-only tank can generally run on simpler, dimmer lighting than a tank growing live plants, which typically needs brighter, more specific lighting suited to the plant species kept.</p>
    <p>This guide covers typical lighting duration, the difference between fish-only and planted-tank lighting needs, and how lighting interacts with algae growth.</p>
    <?php return ob_get_clean();
}

function pz_why_important_fish_tank_lighting_guide() {
    ob_start(); ?>
    <p>Lighting duration and consistency affect fish stress levels, plant growth, and how prone a tank is to algae, so it is worth more thought than just picking a bright-looking fixture.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">⏰</span>
        <div><strong>Consistency matters more than exact timing</strong><p>A regular daily on-off pattern, commonly around 8-10 hours, helps fish settle into a predictable day-night rhythm.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🌱</span>
        <div><strong>Live plants need more specific lighting than fish do</strong><p>A tank growing live plants generally needs brighter or more targeted lighting for photosynthesis than a fish-only setup requires.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🟢</span>
        <div><strong>Excess light plus excess nutrients commonly drives algae</strong><p>Too many lit hours combined with leftover food or fish waste supplying nutrients is a frequent recipe for algae growth.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">😣</span>
        <div><strong>Irregular lighting can stress fish</strong><p>Fish generally do better with a predictable light cycle than with lighting that is turned on and off at random times.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_fish_tank_lighting_guide() {
    return [
        ['title' => 'Decide whether the tank is fish-only or planted', 'desc' => 'A planted tank generally needs stronger, more specific lighting than a fish-only tank to support photosynthesis.'],
        ['title' => 'Choose a lighting duration, commonly around 8-10 hours', 'desc' => 'This range is commonly cited as suitable for a typical community tank, giving fish a clear day-night pattern.'],
        ['title' => 'Use a timer rather than manual switching', 'desc' => 'A timer keeps the daily lighting schedule consistent, which is more important for fish than the exact number of hours chosen.'],
        ['title' => 'Watch for early algae signs after setting a schedule', 'desc' => 'A new or changed lighting schedule can shift algae growth, so check the tank over the following weeks.'],
        ['title' => 'Adjust duration or intensity if algae becomes a problem', 'desc' => 'Reducing lit hours or intensity is a common first step when algae growth increases, alongside checking for excess nutrients.'],
        ['title' => 'Match lighting intensity to any live plants kept', 'desc' => 'Different plant species have different light needs, so research the specific plants in a planted tank rather than assuming one fixture suits all.'],
    ];
}

function pz_tips_fish_tank_lighting_guide() {
    return [
        ['Keep the schedule consistent day to day', 'Fish generally handle a steady light cycle better than one that changes unpredictably.'],
        ['Use a timer to automate on-off times', 'This removes the chance of forgetting to turn lights off or on and keeps the cycle regular.'],
        ['Research plant-specific lighting needs separately from fish needs', 'A planted tank\'s lighting requirements are generally set by the plants, not by the fish living in it.'],
        ['Reduce lit hours gradually if algae appears', 'Cutting duration slowly, rather than making a drastic change all at once, is a common approach to managing algae.'],
        ['Avoid placing a tank in direct sunlight as a substitute for a fixture', 'Uncontrolled natural light exposure is harder to keep consistent than a timed artificial light source.'],
    ];
}

function pz_mistakes_fish_tank_lighting_guide() {
    return [
        ['❌ Leaving lights on around the clock', 'Constant lighting removes the day-night pattern fish benefit from and often encourages algae growth.'],
        ['❌ Using a bright planted-tank fixture on a fish-only tank without plants', 'Extra light with no plants to use it tends to just feed algae growth instead.'],
        ['❌ Changing the lighting schedule randomly day to day', 'Inconsistent timing is more stressful for fish than a steady schedule, even one with slightly fewer or more hours.'],
        ['❌ Assuming more light always means healthier plants', 'Excess lighting without matching plant needs or nutrient balance commonly leads to algae problems rather than better plant growth.'],
        ['❌ Ignoring algae growth instead of adjusting lighting', 'Persistent algae is often a sign that lit hours or intensity need to be reduced, not just scrubbed away repeatedly.'],
    ];
}

function pz_faq_fish_tank_lighting_guide() {
    return [
        ['How many hours of light does a fish tank need per day?', 'A commonly cited range for a typical community tank is about 8-10 hours, with consistency mattering as much as the exact number.'],
        ['Do planted tanks need different lighting than fish-only tanks?', 'Yes, live plants generally need brighter or more specific lighting for photosynthesis than a fish-only tank requires.'],
        ['Can too much light cause algae?', 'Too much lit time combined with excess nutrients from waste or uneaten food is a common contributor to algae growth.'],
        ['Should I use a timer for aquarium lighting?', 'A timer helps keep the daily lighting schedule consistent, which is generally easier on fish than manual, irregular switching.'],
        ['What happens if lighting is inconsistent?', 'An irregular light cycle can be more stressful for fish than a steady schedule, even if the total hours are similar.'],
        ['How do I fix an algae problem related to lighting?', 'Reducing lit hours or intensity, and checking for excess nutrients, are common first steps.'],
    ];
}
