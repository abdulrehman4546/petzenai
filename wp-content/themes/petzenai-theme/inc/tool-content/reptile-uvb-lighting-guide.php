<?php
/**
 * Tool-specific content for: Reptile UVB Lighting Guide: Types & Schedule (registry key: reptile_uvb_lighting_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 * General cross-species guide — references bearded-dragon-care-guide (strict UVB need) and leopard-gecko-care-guide (less strict UVB need) for species context.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_reptile_uvb_lighting_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> UVB lighting helps many reptiles produce vitamin D3, which supports calcium metabolism — a different role from basking heat lamps, which just provide warmth on a separate wavelength. How strictly a species needs UVB varies: bearded dragons need strong UVB as a core requirement, while leopard geckos don't need it as strictly, though some keepers still provide a low level. One often-missed detail is that UVB output degrades over time even when the bulb still looks like it's lighting up normally, so bulbs need replacing on a schedule rather than only when they visibly stop working.</div>
<?php }

function pz_what_is_reptile_uvb_lighting_guide() {
    ob_start(); ?>
    <p>UVB lighting is a type of lighting distinct from basking heat, aimed at supporting vitamin D3 synthesis rather than simply providing warmth. This guide covers what UVB actually does, how its importance varies by species, and the bulb replacement schedule that keeps it working.</p>
    <p>For species-specific UVB context, the bearded dragon and leopard gecko care guides on this site cover how a bearded dragon needs strong UVB as a core requirement, while a leopard gecko's UVB need is less strict.</p>
    <?php return ob_get_clean();
}

function pz_why_important_reptile_uvb_lighting_guide() {
    ob_start(); ?>
    <p>UVB lighting is easy to confuse with basking heat, but it plays a different role and its importance varies enough by species that a one-size-fits-all approach doesn't work.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">☀️</span>
        <div><strong>UVB supports vitamin D3 and calcium metabolism</strong><p>This is a distinct function from basking warmth, which operates on a different wavelength and purpose entirely.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦎</span>
        <div><strong>UVB needs vary significantly by species</strong><p>A bearded dragon needs strong UVB as a core requirement, while a leopard gecko doesn't need it as strictly, though some keepers still provide a low level.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💡</span>
        <div><strong>UVB output degrades even when the bulb still lights up</strong><p>A bulb can look like it's working normally while its actual UVB output has dropped well below what's needed, which is why a replacement schedule matters.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📅</span>
        <div><strong>Replacement should follow a schedule, not just visible failure</strong><p>Waiting until a bulb visibly stops lighting up means it may have already been providing little to no effective UVB for a while.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_reptile_uvb_lighting_guide() {
    return [
        ['title' => 'Confirm whether your species needs strict UVB', 'desc' => 'Species vary a lot here — a bearded dragon needs strong UVB, while a leopard gecko doesn\'t need it as strictly.'],
        ['title' => 'Set up UVB lighting separately from a basking heat source', 'desc' => 'UVB and basking heat serve different purposes, so one doesn\'t substitute for the other.'],
        ['title' => 'Follow the manufacturer\'s replacement schedule for the UVB bulb', 'desc' => 'This matters because UVB output can decline well before the bulb visibly stops lighting up.'],
        ['title' => 'Don\'t judge bulb effectiveness by whether it still produces visible light', 'desc' => 'A bulb that still looks lit can nonetheless be producing far less usable UVB than it once did.'],
        ['title' => 'Position UVB lighting at the distance the manufacturer recommends', 'desc' => 'UVB intensity drops off with distance, so placement affects how much actually reaches the reptile.'],
        ['title' => 'Revisit your setup if you change reptile species', 'desc' => 'Since UVB needs vary by species, a setup that suited one reptile may not suit another.'],
    ];
}

function pz_tips_reptile_uvb_lighting_guide() {
    return [
        ['Keep a replacement date noted somewhere visible', 'A simple reminder helps avoid relying on whether the bulb still visibly lights up.'],
        ['Don\'t treat basking heat and UVB as interchangeable', 'They serve different purposes, so a heat lamp alone doesn\'t cover a UVB requirement.'],
        ['Check species-specific guidance before skipping UVB', 'Some species, like the leopard gecko, have a less strict UVB need, but others, like the bearded dragon, treat it as essential.'],
        ['Mind the recommended distance from the UVB source', 'Placing the light too far away can reduce the effective UVB reaching the reptile even with a fresh bulb.'],
        ['Reassess lighting needs after any species change in the household', 'A UVB setup built for one species may not match what a newly added species needs.'],
    ];
}

function pz_mistakes_reptile_uvb_lighting_guide() {
    return [
        ['❌ Assuming a basking heat lamp also provides UVB', 'Basking heat and UVB serve different purposes on different wavelengths, so one doesn\'t cover the other.'],
        ['❌ Only replacing a UVB bulb once it visibly stops lighting up', 'UVB output can drop well before that point, leaving a reptile without enough effective UVB for a while.'],
        ['❌ Giving every species the same UVB setup', 'UVB needs vary enough by species that a strict setup suited to a bearded dragon isn\'t necessarily needed for a leopard gecko.'],
        ['❌ Placing the UVB bulb farther away than recommended', 'UVB intensity drops with distance, so incorrect placement can reduce how much actually reaches the reptile.'],
        ['❌ Skipping UVB entirely for a species that needs it', 'Treating UVB as optional for a species like the bearded dragon, which needs it as a core requirement, can leave a real gap in care.'],
    ];
}

function pz_faq_reptile_uvb_lighting_guide() {
    return [
        ['What does UVB lighting actually do?', 'It supports vitamin D3 synthesis, which plays a role in calcium metabolism — a different function from the warmth a basking light provides.'],
        ['Is UVB the same as basking heat?', 'No, they serve different purposes on different wavelengths, so a basking heat lamp alone doesn\'t meet a UVB need.'],
        ['Do all reptiles need the same amount of UVB?', 'No, UVB needs vary by species — a bearded dragon needs strong UVB, while a leopard gecko doesn\'t need it as strictly.'],
        ['How often should a UVB bulb be replaced?', 'On the schedule the manufacturer recommends, since UVB output can decline over time even while the bulb still visibly lights up.'],
        ['Can I tell a UVB bulb needs replacing just by looking at it?', 'Not reliably — a bulb can still look lit while producing far less effective UVB than it should, which is why a replacement schedule matters.'],
    ];
}
