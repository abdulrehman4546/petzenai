<?php
/**
 * Tool-specific content for: New Pet Checklist: Everything You Need (registry key: new_pet_checklist).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_new_pet_checklist() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Before bringing a new pet home, have the essentials ready first: food and water bowls, species-appropriate food, a bed or crate, a litter box or potty setup, basic grooming tools, ID (collar/tag or microchip appointment), and a vet appointment booked for the first week. Everything else — toys, extra gear, training tools — can follow once the basics are covered.</div>
<?php }

function pz_what_is_new_pet_checklist() {
    ob_start(); ?>
    <p>This guide is a practical rundown of what to have ready before a new pet comes home, and what to do in the first week after arrival. It is written to cut through the long "everything you could possibly buy" lists that pet stores hand out, and focus on what actually matters in the first days.</p>
    <p>New pet owners tend to either overbuy on gear that goes unused or underprepare on the handful of things that matter most, like a vet visit and proper ID. This guide separates genuine must-haves from optional extras so you can prioritize spending and setup time correctly.</p>
    <p>It applies broadly across cats, dogs, and most common small pets, with notes where a particular species needs something specific, since the core preparation — safe space, appropriate food, ID, and a vet visit — is similar regardless of species.</p>
    <?php return ob_get_clean();
}

function pz_why_important_new_pet_checklist() {
    ob_start(); ?>
    <p>Being prepared before a pet arrives reduces stress for the animal and avoids common early mistakes that are harder to fix later.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🆔</span>
        <div><strong>ID gets skipped more than people expect</strong><p>A collar with an ID tag or a microchip appointment is easy to deprioritize in the excitement of a new pet, but it is one of the few things that genuinely matters if the pet gets lost in the first weeks while still learning the new home.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🩺</span>
        <div><strong>An early vet visit catches issues before they become bigger ones</strong><p>A checkup soon after adoption establishes a baseline, confirms vaccination and parasite prevention status, and catches anything that was not obvious at first glance.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🏠</span>
        <div><strong>A safe, defined space reduces stress in the first days</strong><p>A new environment is overwhelming for most animals; a smaller, contained space to start in helps a pet settle faster than having the run of the whole house immediately.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💸</span>
        <div><strong>Prioritizing essentials avoids wasted spending</strong><p>Pet stores often push extensive gear lists; knowing what is actually necessary versus optional keeps first-week costs and clutter under control.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_new_pet_checklist() {
    return [
        ['title' => 'Set up a defined space before arrival day', 'desc' => 'A single room or a crate/enclosure sized for the species gives a new pet a manageable area to adjust in rather than the whole house at once.'],
        ['title' => 'Have species-appropriate food ready', 'desc' => 'Ideally the same food the pet was already eating, at least for the first week, to avoid digestive upset during an already stressful transition.'],
        ['title' => 'Get bowls, bedding, and bathroom setup in place', 'desc' => 'Food and water bowls, a bed, and a litter box, crate pad, or appropriate bathroom area depending on species, all set up before the pet arrives rather than scrambled together after.'],
        ['title' => 'Sort out ID before day one', 'desc' => 'A collar with a tag showing a working phone number, and a microchip appointment scheduled if the pet does not already have one, cover the two most reliable ways to get a lost pet home.'],
        ['title' => 'Book a vet visit for the first week', 'desc' => 'Even if the pet seems perfectly healthy, an early checkup establishes a baseline and confirms vaccines, parasite prevention, and any species-specific needs are on track.'],
        ['title' => 'Pet-proof the immediate space', 'desc' => 'Secure loose wires, toxic plants, small objects that could be swallowed, and anything breakable, matched to the specific species and its size.'],
    ];
}

function pz_tips_new_pet_checklist() {
    return [
        ['Ask for a small amount of the pet\'s current food from the shelter or breeder', 'Even a few days\' worth lets you transition to a new food gradually instead of switching cold on arrival day.'],
        ['Keep the first 24-48 hours low-key', 'Limiting visitors, noise, and excitement lets a new pet settle into its space before being introduced to the whole household and routine.'],
        ['Buy a properly sized crate or carrier even for a small pet', 'It is useful for vet visits, travel, and safe confinement during the adjustment period, not just a training tool for dogs.'],
        ['Set up ID immediately, even for an "indoor-only" pet', 'Indoor pets escape too, often during exactly the disoriented adjustment period right after arrival, which is when ID matters most.'],
        ['Hold off on buying every toy and accessory at once', 'Start with a few basics and add more once you see what your specific pet actually likes and uses.'],
        ['Write down or photograph any paperwork from the shelter, breeder, or previous owner', 'Vaccination records, prior medical notes, or microchip numbers are easy to misplace in the first busy days and useful to have on hand at the first vet visit.'],
    ];
}

function pz_mistakes_new_pet_checklist() {
    return [
        ['❌ Giving a new pet free run of the whole house immediately', 'Too much space and stimulation at once can overwhelm a pet still adjusting; a smaller defined area to start reduces stress and makes problems like accidents easier to manage.'],
        ['❌ Switching food immediately on arrival', 'A sudden food change on top of a stressful move increases the chance of digestive upset; transition gradually over a week or so if you are changing food at all.'],
        ['❌ Delaying the first vet visit because the pet "seems fine"', 'Some health issues are not obvious at a glance; an early checkup catches problems and establishes a baseline while they are easiest to address.'],
        ['❌ Skipping ID because the pet will be supervised', 'Pets escape unexpectedly, and the first weeks in a new home are a particularly high-risk period since the animal does not yet know its way back.'],
        ['❌ Overwhelming a new pet with visitors and introductions right away', 'Meeting the whole extended family, other pets, and neighbors all in the first day adds unnecessary stress on top of an already big transition.'],
        ['❌ Assuming one checklist fits every species exactly the same', 'A new pet checklist needs the right specifics for the species — a crate and leash matter for a dog, a secure enclosure and hide spots matter for a small pet — even though the broad categories are similar.'],
    ];
}

function pz_faq_new_pet_checklist() {
    return [
        ['What are the absolute must-haves before bringing a new pet home?', 'Species-appropriate food, water and food bowls, a bed or crate, a litter box or bathroom setup if relevant, ID (tag and/or microchip), and a scheduled vet visit for the first week. Everything else is helpful but optional in the first days.'],
        ['Should I switch my new pet to a different food right away?', 'It is usually better to keep the same food they were already eating for at least the first week, then transition gradually over several days if you want to switch, to avoid digestive upset during an already stressful time.'],
        ['How soon should a new pet see a vet?', 'Within the first week is a commonly recommended window, even if the pet seems completely healthy, so a baseline exam can confirm vaccination status, check for parasites, and catch anything not obvious on the surface.'],
        ['Does a strictly indoor pet still need ID?', 'Yes — indoor pets escape too, often during the disoriented adjustment period right after moving to a new home, which is exactly when having a tag or microchip matters most.'],
        ['How much space should a new pet have at first?', 'Starting with a single room or appropriately sized enclosure, rather than the whole house, helps a pet settle in gradually and makes it easier to supervise and manage accidents or stress behaviors.'],
        ['What paperwork should I keep from the shelter or breeder?', 'Vaccination records, any prior medical notes, microchip registration details, and adoption or purchase paperwork are all worth keeping together and bringing to the first vet visit.'],
        ['How long does it typically take a new pet to settle in?', 'It varies by individual animal and species, from a few days to several weeks, and depends a lot on how calm and gradual the introduction to the new home and household is.'],
    ];
}
