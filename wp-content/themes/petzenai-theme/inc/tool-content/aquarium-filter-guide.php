<?php
/**
 * Tool-specific content for: Aquarium Filter Guide: Types & Maintenance (registry key: aquarium_filter_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_aquarium_filter_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> The three common aquarium filter types are hang-on-back (HOB) power filters, canister filters, and sponge or internal filters. A frequently cited sizing rule of thumb is a filter rated to turn over the tank's full water volume several times per hour, though actual needs vary with bioload and tank setup.</div>
<?php }

function pz_what_is_aquarium_filter_guide() {
    ob_start(); ?>
    <p>An aquarium filter circulates and cleans tank water, and it also happens to be where most of the beneficial bacteria that break down fish waste actually live, on the filter media itself. The main filter types differ in how they're positioned and how much media they hold: hang-on-back (HOB) filters clip to the back of the tank and are common on smaller setups, canister filters sit outside the tank and hold more media for larger or more heavily stocked tanks, and sponge or internal filters sit inside the tank and are often favored for breeding or fry tanks because they're gentler.</p>
    <p>This guide covers the differences between those filter types, a general sizing concept for matching filter capacity to tank volume, and how filter media connects to the beneficial bacteria colony a tank depends on.</p>
    <?php return ob_get_clean();
}

function pz_why_important_aquarium_filter_guide() {
    ob_start(); ?>
    <p>Choosing an appropriately sized, appropriate-type filter matters because the filter is both the water-cleaning mechanism and the main home for the bacteria colony that keeps ammonia and nitrite from building up.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">💧</span>
        <div><strong>HOB filters suit many standard setups</strong><p>Hang-on-back filters are widely used on common tank sizes thanks to easy installation and straightforward media changes.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🛢️</span>
        <div><strong>Canister filters handle larger or heavier bioloads</strong><p>Because they hold more filter media, canister filters are commonly chosen for bigger tanks or tanks with a lot of fish waste to process.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧽</span>
        <div><strong>Sponge and internal filters are gentler</strong><p>Lower flow and no intake that could pull in small fish make sponge filters common choices for fry or breeding tanks.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦠</span>
        <div><strong>Filter media holds the bacteria colony</strong><p>The bacteria colony established during cycling largely settles on the filter media itself, not loose in the open water, which is why filter choice and media care tie directly into keeping a tank cycled.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_aquarium_filter_guide() {
    return [
        ['title' => 'Match filter type to your tank setup', 'desc' => 'Consider an HOB filter for a standard community tank, a canister filter for a larger or more heavily stocked tank, or a sponge filter for a breeding or fry setup.'],
        ['title' => 'Check the filter\'s rated turnover against tank volume', 'desc' => 'A commonly cited rule of thumb is a filter capable of moving several times the tank\'s total volume per hour, though heavier bioloads may call for more capacity.'],
        ['title' => 'Install the filter and let it run continuously', 'desc' => 'Filters are meant to run around the clock, since both water circulation and the bacteria colony on the media depend on steady flow.'],
        ['title' => 'Rinse mechanical media in removed tank water instead of straight from the tap', 'desc' => 'This protects the established bacteria colony living on the media, the same general practice used when maintaining the tank during routine cleaning.'],
        ['title' => 'Replace or rinse media on a staggered schedule', 'desc' => 'Avoid replacing all filter media at once; staggering changes helps preserve an established bacteria colony rather than resetting it.'],
        ['title' => 'Watch flow rate over time', 'desc' => 'A noticeable drop in flow often signals clogged media that needs rinsing or replacement.'],
    ];
}

function pz_tips_aquarium_filter_guide() {
    return [
        ['Size up rather than down when in doubt', 'A filter rated for a larger volume than your tank generally gives a margin of safety for bioload.'],
        ['Never turn off the filter for an extended period', 'The bacteria colony on the media needs continuous oxygenated water flow to stay alive.'],
        ['Keep spare media on hand', 'Having replacement cartridges or sponge sections ready avoids a gap in filtration when media needs to be changed.'],
        ['Match filter choice to fish that are sensitive to flow', 'Species that prefer calmer water may do better with a sponge or internal filter than a high-flow canister outlet.'],
        ['Clean the intake area periodically', 'Debris around the intake can restrict flow even when the media itself is clean.'],
    ];
}

function pz_mistakes_aquarium_filter_guide() {
    return [
        ['❌ Rinsing filter media straight under the tap', 'Tap water isn\'t treated with the bacteria colony in mind, and this habit is a common way keepers accidentally wipe out the media\'s colony.'],
        ['❌ Replacing all filter media at the same time', 'This can wipe out most of the established bacteria colony at once, similar to restarting part of the cycling process.'],
        ['❌ Undersizing the filter for the tank\'s bioload', 'A filter rated only for the tank\'s raw volume, with no margin for a heavier fish load, often struggles to keep up.'],
        ['❌ Turning the filter off overnight or during water changes for too long', 'Extended downtime can stress or kill the bacteria colony that depends on continuous water flow.'],
        ['❌ Ignoring a drop in flow rate', 'Reduced flow usually means clogged media that needs attention, not simply a filter running quietly.'],
    ];
}

function pz_faq_aquarium_filter_guide() {
    return [
        ['What are the main types of aquarium filters?', 'The most common types are hang-on-back (HOB) power filters, canister filters, and sponge or internal filters, each suited to different tank sizes and uses.'],
        ['How do I size a filter for my tank?', 'A commonly cited rule of thumb is choosing a filter rated to turn over the tank\'s full volume several times per hour, with more capacity for a heavier bioload.'],
        ['Why does filter media matter for the nitrogen cycle?', 'Filter media is where most of the beneficial bacteria that convert ammonia and nitrite actually live, so the media is central to a tank staying cycled.'],
        ['Can I rinse filter media under the tap?', 'It\'s generally better to use removed tank water instead, so the media\'s bacteria colony isn\'t put at risk.'],
        ['Is a sponge filter enough for a community tank?', 'It can be, especially for lightly stocked or smaller tanks, though heavier bioloads often benefit from the extra media capacity of an HOB or canister filter.'],
        ['How often should filter media be changed?', 'Staggering media changes rather than replacing everything at once helps protect the established bacteria colony.'],
    ];
}
