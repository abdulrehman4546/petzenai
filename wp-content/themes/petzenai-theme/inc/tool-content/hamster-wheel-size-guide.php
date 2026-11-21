<?php
/**
 * Tool-specific content for: Hamster Wheel Size Guide by Breed (registry key: hamster_wheel_size_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_hamster_wheel_size_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Syrian hamsters need a wheel at least 11 inches (28 cm) across; dwarf species like Roborovski, Campbell's, and Winter White hamsters need at least 8 inches (20 cm). The key test is a flat back — if your hamster's spine curves while running, the wheel is too small.</div>
<?php }

function pz_what_is_hamster_wheel_size_guide() {
    ob_start(); ?>
    <p>This guide explains how to pick a running wheel size that actually fits your hamster, rather than relying on whatever size comes bundled with a cage starter kit, which is very often too small.</p>
    <p>Wheel size depends on species and the individual hamster's body length, not on cage size or price point. A wheel marketed as "hamster-sized" by a pet store is frequently sized for a dwarf hamster and sold alongside Syrian hamster cages, which is where most sizing mistakes happen.</p>
    <p>Getting this right matters because a too-small wheel forces a curved spine with every stride, and that posture problem is far easier to prevent with the right wheel than to correct afterward.</p>
    <?php return ob_get_clean();
}

function pz_why_important_hamster_wheel_size_guide() {
    ob_start(); ?>
    <p>A wheel is not an optional accessory — hamsters are built to run long distances overnight, and the wrong size turns a core piece of enrichment into a source of strain.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🦴</span>
        <div><strong>A curved spine during running is a real problem</strong><p>When a wheel is too small, a hamster's back arches upward with every stride instead of staying flat, which puts repeated strain on the spine over months of nightly use.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🏷️</span>
        <div><strong>"Hamster-sized" on packaging is not reliable</strong><p>Many budget wheels labeled simply for "hamsters" are sized for dwarf species and end up undersized when sold alongside Syrian hamster cages, which is the most common sizing mistake owners make.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🌙</span>
        <div><strong>Hamsters run a lot every single night</strong><p>A hamster can cover a meaningful distance on its wheel overnight, so even a small sizing mismatch gets repeated thousands of times before it's noticed.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🔧</span>
        <div><strong>Wheel style matters alongside size</strong><p>Solid-surface wheels with a closed back are safer than wire-rung wheels, which can catch tiny feet or tails regardless of whether the diameter is otherwise correct.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_hamster_wheel_size_guide() {
    return [
        ['title' => 'Identify your hamster\'s species', 'desc' => 'Syrian hamsters are larger and need bigger wheels than dwarf species such as Roborovski, Campbell\'s, or Winter White hamsters.'],
        ['title' => 'Measure nose-to-base-of-tail length', 'desc' => 'A quick, gentle estimate of body length (not including the tail) tells you the minimum wheel diameter your hamster needs to keep a flat back.'],
        ['title' => 'Choose a wheel at least that long in diameter', 'desc' => 'As a baseline, aim for at least 11 inches (28 cm) for Syrian hamsters and at least 8 inches (20 cm) for dwarf species, sizing up if your hamster is on the larger end for its species.'],
        ['title' => 'Pick a solid-surface, closed-back design', 'desc' => 'Solid running surfaces and a closed back reduce the risk of caught feet or tails compared to open wire-rung wheels.'],
        ['title' => 'Watch your hamster run on it', 'desc' => 'A properly sized wheel lets your hamster run with a flat, level back. If the spine curves upward noticeably, size up.'],
        ['title' => 'Re-check as your hamster grows', 'desc' => 'Young hamsters can outgrow an undersized wheel within weeks, so recheck the fit a month or two after bringing a young hamster home.'],
    ];
}

function pz_tips_hamster_wheel_size_guide() {
    return [
        ['Watch the back, not just the feet', 'A flat back while running is the clearest sign a wheel fits; curved or arched posture means the wheel is too small, even if the feet aren\'t slipping off.'],
        ['Size up if you\'re between two sizes', 'When a hamster is at the upper end of its species\' typical size, choosing the larger wheel option avoids outgrowing it later.'],
        ['Avoid wheels with a center support post', 'Some budget wheel designs have a central post or axle that intrudes into the running surface, which can interfere with a hamster\'s stride even at the right diameter.'],
        ['Place the wheel on a level, stable surface', 'A wobbly or tilted wheel changes how your hamster has to balance while running, undermining an otherwise correctly sized wheel.'],
        ['Clean the wheel regularly', 'Hamsters sometimes urinate while running; a wheel wiped down every few days stays more appealing to use and more pleasant to be near.'],
        ['Offer the wheel at night', 'Hamsters are naturally nocturnal, so placing the cage somewhere a nighttime wheel won\'t disturb sleep gets the most use out of it.'],
    ];
}

function pz_mistakes_hamster_wheel_size_guide() {
    return [
        ['❌ Trusting the wheel that comes with a cage kit', 'Bundled starter-kit wheels are frequently undersized, especially for Syrian hamsters, and are one of the most common sources of a curved running posture.'],
        ['❌ Assuming "hamster-sized" means it fits any hamster', 'Packaging rarely distinguishes between dwarf and Syrian sizing, so the diameter needs to be checked directly, not assumed from the label.'],
        ['❌ Choosing a wire-rung wheel for easy cleaning', 'Open wire rungs are easier to rinse but pose a real risk of trapping tiny feet or a tail mid-run; a solid surface is worth the extra cleaning effort.'],
        ['❌ Ignoring posture because the hamster still uses the wheel', 'A hamster will often keep running on an undersized wheel out of instinct even while visibly arching its back, so usage alone doesn\'t confirm a good fit.'],
        ['❌ Not resizing after a young hamster grows', 'A wheel that fit a juvenile hamster can become too small within weeks as it reaches adult size, especially for Syrian hamsters.'],
    ];
}

function pz_faq_hamster_wheel_size_guide() {
    return [
        ['What size wheel does a Syrian hamster need?', 'At least 11 inches (28 cm) in diameter. Syrian hamsters are the largest commonly kept pet hamster species, and many bundled cage-kit wheels fall well short of this size.'],
        ['What size wheel do dwarf hamsters need?', 'Roborovski, Campbell\'s, and Winter White hamsters need at least 8 inches (20 cm), smaller than what a Syrian hamster needs but still often larger than a budget starter-kit wheel.'],
        ['How do I know if my hamster\'s wheel is too small?', 'Watch your hamster run: if its back curves or arches upward instead of staying flat, the wheel is undersized, even if your hamster continues to use it regularly.'],
        ['Are wire-rung wheels safe?', 'They carry a higher risk of catching small feet or a tail compared to solid-surface, closed-back wheels, regardless of whether the diameter is correct.'],
        ['Can a wheel be too big?', 'Not in the same way a too-small wheel causes problems — a slightly larger wheel is generally fine, so when in doubt between two sizes, sizing up is the safer choice.'],
        ['Do I need to replace the wheel as my hamster grows?', 'Yes, particularly for hamsters still reaching adult size. A wheel that fit as a juvenile can become too small within weeks for a fast-growing Syrian hamster.'],
        ['Does wheel material matter besides size?', 'Yes — a solid running surface with a closed back is safer and generally quieter than an open wire-rung design, and is worth prioritizing alongside getting the diameter right.'],
    ];
}
