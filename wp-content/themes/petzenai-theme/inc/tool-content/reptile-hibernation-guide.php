<?php
/**
 * Tool-specific content for: Reptile Hibernation (Brumation) Guide (registry key: reptile_hibernation_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 * General cross-species guide on brumation — not species-specific; builds on the brief mentions
 * in bearded-dragon-care-guide.php and tortoise-care-guide.php with a deeper dive.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_reptile_hibernation_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> What people often call reptile "hibernation" is more accurately called brumation, a distinct seasonal slowdown reptiles go through rather than the deep, uninterrupted mammalian hibernation most people picture. A brumating reptile typically eats less and moves less but may still wake periodically, unlike a hibernating mammal. Some commonly kept species, such as tortoises, brumate fairly often in the wild, while many pet keepers choose not to let certain other species brumate in captivity at all. Knowing the difference between normal brumation and a reptile that's simply unwell matters, since the two can look similar at a glance.</div>
<?php }

function pz_what_is_reptile_hibernation_guide() {
    ob_start(); ?>
    <p>"Hibernation" is the word most people reach for, but the term reptile keepers actually use is brumation. It describes the same general idea — a seasonal slowdown in activity and eating — but it isn't biologically identical to the deep hibernation seen in mammals like bears or ground squirrels, which is why the distinct term exists.</p>
    <p>This guide goes deeper than the brief mentions of brumation on our <a href="/tools/bearded-dragon-care-guide/">bearded dragon</a> and <a href="/tools/tortoise-care-guide/">tortoise</a> care guides, covering the signs a reptile may be heading into brumation, when it's reasonable to let it happen versus when an owner should intervene, and how the picture differs across species.</p>
    <p>Because brumation and illness can look similar from the outside, especially a slowdown in eating and activity, this guide also covers the main things that separate a normal seasonal pattern from something that needs a vet.</p>
    <?php return ob_get_clean();
}

function pz_why_important_reptile_hibernation_guide() {
    ob_start(); ?>
    <p>Understanding brumation helps owners avoid two opposite mistakes: panicking over a normal seasonal pattern, or missing a genuine health problem because it was dismissed as "just brumation."</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">❄️</span>
        <div><strong>Brumation isn't the same as mammal hibernation</strong><p>A brumating reptile often still wakes periodically to drink or move around, unlike the deep, largely uninterrupted state seen in a hibernating mammal, which is part of why reptile keepers use a separate term.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐢</span>
        <div><strong>How often it happens varies a lot by species</strong><p>Tortoises are among the more commonly brumating groups, while some other pet reptiles are rarely allowed to brumate in captivity at all, often by the keeper's own choice rather than the animal's need.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🔍</span>
        <div><strong>Brumation and illness can look alike at first glance</strong><p>Reduced eating and lower activity show up in both a normal seasonal slowdown and in a genuinely sick reptile, so telling the two apart takes more than a quick look.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚖️</span>
        <div><strong>Whether to let brumation happen is often a keeper's decision</strong><p>Unlike in the wild, a captive reptile's environment is controlled by its owner, so for many species, whether brumation happens at all comes down to a deliberate choice rather than something that simply occurs on its own.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_reptile_hibernation_guide() {
    return [
        ['title' => 'Learn whether your species commonly brumates', 'desc' => 'Tortoises are among the more commonly brumating groups, while brumation is less universal or less often intentionally allowed in other commonly kept reptiles, so research your specific species first.'],
        ['title' => 'Watch for the early signs', 'desc' => 'A gradual drop in appetite, less time basking or moving around, and more time spent hidden away, especially as the season cools, are common early signs a reptile may be preparing to brumate.'],
        ['title' => 'Decide, with guidance, whether to let it happen', 'desc' => 'For species that commonly brumate, many keepers choose to let a healthy adult go through it under controlled conditions, while young, underweight, or unwell reptiles are generally not good candidates.'],
        ['title' => 'Keep conditions controlled if brumation is allowed to proceed', 'desc' => 'A deliberately managed, cooler and quieter setup is different from an animal left to slow down in an unmonitored or inappropriate environment.'],
        ['title' => 'Check in periodically rather than leaving it completely alone', 'desc' => 'Even during brumation, periodic checks for weight loss, dehydration, or unusual lethargy help catch a problem early rather than assuming everything is fine until it clearly isn\'t.'],
        ['title' => 'Know when to intervene or involve a vet', 'desc' => 'Significant weight loss, inability to wake or respond normally, or signs that don\'t match the gradual pattern of a normal seasonal slowdown are reasons to step in rather than wait it out.'],
    ];
}

function pz_tips_reptile_hibernation_guide() {
    return [
        ['Use "brumation" rather than "hibernation" when researching your species', 'The two terms get used interchangeably in casual conversation, but searching with the correct term often turns up more species-accurate care information.'],
        ['Don\'t assume every reptile needs to brumate', 'Many pet reptiles are kept active year-round by choice, with no brumation period at all, and that\'s a legitimate, commonly chosen approach for a number of species.'],
        ['Weigh a reptile before and periodically during brumation if your species allows it', 'A baseline weight gives you something concrete to compare against if you\'re trying to judge whether weight loss during the period is within a normal range.'],
        ['Keep young or underweight reptiles active rather than letting them brumate', 'Brumation is generally considered more appropriate for healthy adults than for juveniles or animals that are already underweight.'],
        ['Have a plan for what "checking in" looks like before brumation starts', 'Deciding in advance how often you\'ll check water, weight, or general condition makes it easier to stay consistent once the animal has slowed down.'],
    ];
}

function pz_mistakes_reptile_hibernation_guide() {
    return [
        ['❌ Assuming all reptiles hibernate the same way mammals do', 'Brumation is a distinct pattern, and a brumating reptile commonly still wakes periodically, unlike the deep hibernation seen in mammals like bears.'],
        ['❌ Letting a sick or underweight reptile brumate', 'Brumation is generally considered more appropriate for healthy adults; a reptile that\'s already unwell or underweight is a poor candidate for being left to slow down further.'],
        ['❌ Walking away completely for the whole season', 'Even during a managed brumation period, periodic checks on weight and general condition help catch a genuine problem instead of assuming silence means everything is fine.'],
        ['❌ Mistaking illness for brumation', 'Because reduced eating and lower activity show up in both, ruling out illness, especially in a species or individual that doesn\'t typically brumate, matters before assuming the slowdown is seasonal.'],
        ['❌ Forcing brumation on a species that isn\'t commonly allowed to do it in captivity', 'For reptiles many keepers intentionally keep active year-round, there\'s little reason to induce a brumation period just because a wild relative might experience one.'],
    ];
}

function pz_faq_reptile_hibernation_guide() {
    return [
        ['Is reptile hibernation the same as brumation?', 'They describe a similar general concept — a seasonal slowdown — but brumation is the more accurate term, since a brumating reptile often still wakes periodically, unlike the deep, largely uninterrupted hibernation seen in mammals.'],
        ['Which pet reptiles commonly brumate?', 'Tortoises are among the more commonly brumating groups. How often brumation happens, or whether it\'s allowed to happen at all, varies by species, and some other commonly kept pet reptiles are rarely allowed to brumate in captivity by choice of the keeper.'],
        ['What are signs a reptile may be preparing to brumate?', 'A gradual drop in appetite, less basking and movement, and more time spent hidden, often as the season cools, are common early signs, though the same signs can also point to illness depending on the species and circumstances.'],
        ['How can I tell brumation apart from illness?', 'Brumation tends to come on gradually and track with cooler seasonal conditions, while illness can appear more suddenly or come with other signs. Significant weight loss, trouble waking or responding normally, or anything that doesn\'t fit a gradual seasonal pattern is worth treating as a possible health issue rather than assuming it\'s brumation.'],
        ['Should I let my reptile brumate?', 'For species that commonly brumate, many keepers choose to let a healthy adult go through a controlled brumation period, while young, underweight, or unwell reptiles are generally better kept active instead. This is a decision worth researching for your specific species rather than assuming one answer fits all reptiles.'],
        ['Do I need to check on a brumating reptile?', 'Yes. Even during a managed brumation period, periodically checking weight, hydration, and general condition helps catch a genuine problem early, rather than leaving the animal completely unmonitored for the whole season.'],
    ];
}
