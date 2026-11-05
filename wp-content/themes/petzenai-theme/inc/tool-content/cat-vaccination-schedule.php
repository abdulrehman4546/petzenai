<?php
/**
 * Tool-specific content for: Cat Vaccination Schedule: Complete Guide (registry key: cat_vaccination_schedule).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_cat_vaccination_schedule() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Kittens typically start core vaccines (FVRCP and rabies) around 6-8 weeks old, with boosters every 3-4 weeks until about 16 weeks, then an adult booster around a year later. After that, core vaccines are usually given every 1-3 years depending on the vaccine and your vet's protocol, with additional non-core vaccines like FeLV recommended based on lifestyle and outdoor exposure.</div>
<?php }

function pz_what_is_cat_vaccination_schedule() {
    ob_start(); ?>
    <p>This guide walks through how feline vaccination schedules are generally structured, based on guidelines from veterinary organizations like AAHA and AAFP: which vaccines are considered "core" for every cat, which are "non-core" and depend on lifestyle, and roughly when kittens and adult cats typically receive each one.</p>
    <p>Core vaccines, FVRCP (feline viral rhinotracheitis, calicivirus, and panleukopenia) and rabies, are recommended for essentially all cats regardless of whether they go outdoors, because the diseases they prevent are common, serious, or required by law. Non-core vaccines, most notably FeLV (feline leukemia virus), are recommended based on individual risk, such as outdoor access or living with an FeLV-positive cat.</p>
    <p>Exact ages and intervals vary somewhat by vet, vaccine brand, and local regulations, and veterinary guidelines emphasize individualized risk assessment over one universal calendar. This guide gives the general shape of a typical schedule; your vet will tailor the specifics to your cat.</p>
    <?php return ob_get_clean();
}

function pz_why_important_cat_vaccination_schedule() {
    ob_start(); ?>
    <p>Following an appropriate vaccination schedule protects your cat from serious, sometimes fatal diseases and protects the cats and people around her.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🛡️</span>
        <div><strong>Core diseases are serious and common</strong><p>Panleukopenia, calicivirus, and rhinotracheitis can cause severe illness, especially in kittens, and rabies is both fatal and a public health concern, which is why these vaccines are considered essential for all cats.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🍼</span>
        <div><strong>Kittens need a booster series, not one shot</strong><p>A kitten's early immunity from her mother fades at an unpredictable rate, so a series of boosters a few weeks apart ensures she is protected once that maternal immunity is gone.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐾</span>
        <div><strong>Lifestyle changes what else is recommended</strong><p>A cat with outdoor access or exposure to other cats of unknown health status may benefit from FeLV vaccination, even if it is not considered core for every cat.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📅</span>
        <div><strong>Staying current avoids gaps in protection</strong><p>Missing boosters can leave windows where immunity has waned before the next dose, which is why sticking to the recommended schedule matters more than just "eventually" getting each shot.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_cat_vaccination_schedule() {
    return [
        ['title' => 'Start the kitten series around 6-8 weeks', 'desc' => 'The first FVRCP dose typically begins in this window, with the exact timing depending on your vet\'s protocol and your kitten\'s health.'],
        ['title' => 'Continue FVRCP boosters every 3-4 weeks', 'desc' => 'Boosters generally continue until the kitten is about 16 weeks old, since maternal antibodies can interfere with the vaccine at younger ages in ways that are hard to predict.'],
        ['title' => 'Give the rabies vaccine per local requirements', 'desc' => 'Rabies vaccination timing and legal requirements vary by location; your vet will know the applicable schedule and any local or state mandates.'],
        ['title' => 'Discuss FeLV vaccination based on lifestyle', 'desc' => 'If your kitten or cat has or may have outdoor access, or lives with cats of unknown FeLV status, ask your vet whether the FeLV vaccine is appropriate.'],
        ['title' => 'Schedule the one-year adult booster', 'desc' => 'Most protocols call for a booster of core vaccines about a year after the kitten series finishes.'],
        ['title' => 'Follow your vet\'s ongoing booster interval', 'desc' => 'After the first adult booster, core vaccines are typically given every 1-3 years depending on the specific vaccine, local law, and your cat\'s individual risk.'],
    ];
}

function pz_tips_cat_vaccination_schedule() {
    return [
        ['Keep a written or digital vaccine record', 'A clear record of dates and vaccine types helps any vet you see, including emergency clinics, know your cat\'s status quickly.'],
        ['Mention any reaction to a previous vaccine', 'If your cat had swelling, lethargy, or any unusual reaction before, tell your vet so they can adjust the approach if needed.'],
        ['Reassess lifestyle vaccines if things change', 'If an indoor-only cat starts going outside, or a new cat of unknown health status joins the household, revisit whether non-core vaccines like FeLV make sense.'],
        ['Do not skip the kitten booster series', 'A single kitten vaccine dose is not considered adequately protective; the series of boosters a few weeks apart is what builds full immunity.'],
        ['Ask about combination vs. separate vaccines', 'Some vets offer combined shots for convenience while others space out vaccines; either can be appropriate, so ask what your vet recommends for your cat.'],
        ['Keep up with boosters even for indoor-only cats', 'Core vaccines are recommended for all cats because some of what they protect against does not require outdoor exposure to pose a risk.'],
    ];
}

function pz_mistakes_cat_vaccination_schedule() {
    return [
        ['❌ Stopping the kitten series after one dose', 'A single shot without the follow-up boosters often does not provide full protection, since early doses can be partially blocked by maternal antibodies.'],
        ['❌ Assuming an indoor cat does not need core vaccines', 'Core vaccines like FVRCP and rabies are recommended for all cats regardless of indoor or outdoor lifestyle, since some exposure risks do not require going outside.'],
        ['❌ Giving the FeLV vaccine to every cat regardless of risk', 'FeLV is non-core and generally recommended based on individual lifestyle and exposure risk, not for every cat automatically; your vet can help assess whether it applies.'],
        ['❌ Letting boosters lapse for a long period', 'A long gap between boosters can mean reduced protection; if your cat has fallen behind, ask your vet whether the series needs to restart or can simply resume.'],
        ['❌ Ignoring local rabies vaccination laws', 'Many areas legally require rabies vaccination on a specific schedule regardless of a cat\'s lifestyle; check with your vet about local requirements.'],
        ['❌ Not telling your vet about a past vaccine reaction', 'Past reactions are useful information for planning future vaccines safely and should always be mentioned at the start of a visit.'],
    ];
}

function pz_faq_cat_vaccination_schedule() {
    return [
        ['What vaccines does every kitten need?', 'The core vaccines recommended for essentially all kittens are FVRCP, which protects against feline viral rhinotracheitis, calicivirus, and panleukopenia, along with rabies. These protect against diseases that are common, severe, or legally required to vaccinate against.'],
        ['When does the kitten vaccine series start and end?', 'It typically starts around 6-8 weeks old with FVRCP, followed by boosters roughly every 3-4 weeks until about 16 weeks. Rabies timing depends on local requirements. An adult booster usually follows about a year later.'],
        ['Does my indoor-only cat still need vaccines?', 'Yes. Core vaccines are recommended for all cats, indoor or outdoor, because the diseases they prevent are either highly contagious through indirect contact or, in the case of rabies, a public health concern with legal requirements in most areas.'],
        ['What is the difference between core and non-core vaccines?', 'Core vaccines, like FVRCP and rabies, are recommended for nearly every cat. Non-core vaccines, like FeLV, are recommended based on individual factors such as outdoor access or exposure to cats of unknown health status, rather than for every cat automatically.'],
        ['How often do adult cats need vaccine boosters?', 'After the first adult booster, core vaccines are generally given every 1-3 years depending on the specific vaccine and your vet\'s protocol, though local rabies laws may set their own required interval.'],
        ['Can vaccines cause side effects in cats?', 'Mild, short-term effects like slight lethargy, reduced appetite, or soreness at the injection site are common and usually resolve within a day or two. Serious reactions are uncommon; tell your vet about any past reaction before future vaccines.'],
        ['Should my cat get the FeLV vaccine?', 'This depends on lifestyle. Cats with outdoor access or exposure to cats of unknown FeLV status are generally better candidates than strictly indoor cats in a closed household. Ask your vet to assess your cat\'s individual risk.'],
    ];
}
