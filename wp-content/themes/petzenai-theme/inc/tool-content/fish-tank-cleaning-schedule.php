<?php
/**
 * Tool-specific content for: Fish Tank Cleaning Schedule Calculator (registry key: fish_tank_cleaning_schedule).
 * Registry type changed from 'calculator' to 'guide' (no dedicated render function existed, and the generic
 * fallback calculator is a mammal weight/breed-size/life-stage form, which makes no sense for a tank
 * maintenance schedule). The page widget is pz_render_guide_fish_tank_cleaning_schedule() in
 * inc/tool-renderer.php — a static reference card of routine maintenance tasks, not an interactive calculator.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_fish_tank_cleaning_schedule() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A common routine is a partial water change roughly weekly or biweekly, usually in the range of about 10-25% of tank volume, paired with gravel vacuuming and rinsing filter media in tank water (never tap water) to preserve the beneficial bacteria built up during cycling.</div>
<?php }

function pz_what_is_fish_tank_cleaning_schedule() {
    ob_start(); ?>
    <p>A fish tank cleaning schedule is a recurring maintenance routine, distinct from the one-time nitrogen cycling process a new tank goes through. Once a tank is cycled, ongoing maintenance — rather than a full reset — is what keeps water quality stable over the long term.</p>
    <p>This guide covers the core recurring tasks: partial water changes on a regular interval, gravel vacuuming to remove debris, and rinsing filter media carefully so the beneficial bacteria it hosts aren't wiped out in the process.</p>
    <?php return ob_get_clean();
}

function pz_why_important_fish_tank_cleaning_schedule() {
    ob_start(); ?>
    <p>Routine cleaning removes accumulating waste and debris that a filter alone doesn't fully handle, helping keep water parameters stable between bigger changes.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">💧</span>
        <div><strong>Partial water changes are the core of most schedules</strong><p>A commonly cited approach is changing roughly 10-25% of tank water on a weekly or biweekly basis, rather than doing a full 100% change.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🪵</span>
        <div><strong>Gravel vacuuming removes debris filters miss</strong><p>Waste and leftover food can settle into the substrate, where it won't get pulled into the filter on its own.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧽</span>
        <div><strong>Filter media should be rinsed in tank water, not tap water</strong><p>Tap water can contain chlorine or chloramine that harms the beneficial bacteria living on filter media, so using removed tank water to rinse it helps preserve that bacteria.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🌿</span>
        <div><strong>Algae scraping keeps glass and decor clear</strong><p>Routine scraping prevents buildup from becoming a bigger, harder-to-remove problem later.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_fish_tank_cleaning_schedule() {
    return [
        ['title' => 'Set a regular water change interval', 'desc' => 'Weekly or biweekly is a common starting interval, with roughly 10-25% of tank volume changed each time.'],
        ['title' => 'Vacuum the gravel during water changes', 'desc' => 'Removing debris from the substrate while draining water for the change is an efficient way to combine both tasks.'],
        ['title' => 'Rinse filter media in removed tank water', 'desc' => 'Using tank water instead of tap water to rinse media helps avoid killing the beneficial bacteria it hosts.'],
        ['title' => 'Scrape algae off glass and decor as needed', 'desc' => 'Doing this regularly keeps it manageable rather than letting it build up into a bigger job.'],
        ['title' => 'Check equipment during each cleaning session', 'desc' => 'Use the routine as a chance to confirm the filter, heater, and other equipment are working normally.'],
        ['title' => 'Adjust frequency based on your tank\'s bioload', 'desc' => 'A heavily stocked tank may need cleaning on the more frequent end of a weekly-to-biweekly range, while a lightly stocked tank may need less frequent attention.'],
    ];
}

function pz_tips_fish_tank_cleaning_schedule() {
    return [
        ['Stick to partial changes, not full resets', 'Changing the entire volume of water at once removes beneficial bacteria balance and can shock fish — partial changes are the standard approach.'],
        ['Match a cleaning calendar to your actual tank, not a generic rule', 'A heavily stocked or messier tank often needs more frequent attention than a lightly stocked one.'],
        ['Avoid over-cleaning filter media', 'Rinsing too hard or too often, even in tank water, can disturb the bacterial colony more than necessary.'],
        ['Use a gravel vacuum designed for aquarium use', 'This makes it easier to remove debris from the substrate without disturbing it more than needed.'],
        ['Keep a simple log of cleaning dates', 'This makes it easier to stay consistent and notice if a task has been skipped for longer than intended.'],
    ];
}

function pz_mistakes_fish_tank_cleaning_schedule() {
    return [
        ['❌ Doing a 100% water change', 'This removes far more of the established bacterial balance than a partial change and can stress fish — partial changes are the standard recurring approach.'],
        ['❌ Rinsing filter media in tap water', 'Chlorine or chloramine in tap water can harm the beneficial bacteria living on filter media.'],
        ['❌ Skipping gravel vacuuming for long stretches', 'Debris that settles into the substrate can accumulate and affect water quality if left unaddressed.'],
        ['❌ Cleaning on an irregular, inconsistent schedule', 'Routine maintenance works best as a consistent recurring habit rather than occasional large catch-up cleanings.'],
        ['❌ Confusing routine cleaning with the one-time cycling process', 'Cycling establishes a tank\'s bacteria before fish are added; cleaning is the ongoing maintenance that comes after, and the two serve different purposes.'],
    ];
}

function pz_faq_fish_tank_cleaning_schedule() {
    return [
        ['How often should I clean my fish tank?', 'A common routine is a partial water change roughly weekly or biweekly, combined with gravel vacuuming and periodic filter media rinsing.'],
        ['How much water should I change each time?', 'A commonly cited range is about 10-25% of tank volume per partial change, rather than a full change.'],
        ['Should I rinse my filter media in tap water?', 'No — tap water can contain chlorine or chloramine that harms beneficial bacteria, so rinsing in removed tank water is the standard approach.'],
        ['Is a full 100% water change ever a good idea?', 'Generally no for routine maintenance — partial changes are the standard recurring approach, since a full change removes much of the established bacterial balance at once.'],
        ['How is a cleaning schedule different from tank cycling?', 'Cycling is a one-time process of establishing bacteria in a new tank, while a cleaning schedule is the ongoing routine maintenance that follows afterward.'],
        ['Should cleaning frequency change based on how many fish I have?', 'Often yes — a more heavily stocked or messier tank commonly needs cleaning on the more frequent end of a typical range.'],
    ];
}
