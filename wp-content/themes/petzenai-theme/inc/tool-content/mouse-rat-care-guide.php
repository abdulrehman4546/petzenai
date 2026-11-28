<?php
/**
 * Tool-specific content for: Pet Rat & Mouse Care Guide (registry key: mouse_rat_care_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 * New small-pets cluster covering mice and rats together: shorter-lived than most other pets in this
 * cluster (mice are small, rats are notably larger, closer to hedgehog size), rats generally more
 * intelligent/trainable and more socially bonded with humans than mice, both species social and better
 * in same-sex groups (not solitary like a Syrian hamster), and both prolific breeders where same-sex
 * housing specifically prevents rapid, unwanted litters given how quickly they breed.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_mouse_rat_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Pet mice and rats are closely related and often covered together, though rats are generally considered more intelligent, more trainable, and more socially bonded with their human caretakers than mice. Mice stay quite small, while rats grow considerably larger, roughly in the same size range as a hedgehog, but both are shorter-lived than most other pets in this cluster. A solo mouse or rat tends to seem bored or withdrawn compared to one with same-sex cagemates — group housing fits this pair naturally. Both breed so readily that housing males and females together without planning quickly leads to repeated litters, so same-sex groups are the practical way to keep numbers under control.</div>
<?php }

function pz_what_is_mouse_rat_care_guide() {
    ob_start(); ?>
    <p>Pet mice and rats are closely related rodents that are often covered together, though they're not identical — rats are generally considered more intelligent, more trainable, and more likely to bond socially with their human caretaker than mice.</p>
    <p>This guide covers their social housing needs, which run opposite to a Syrian hamster's solitary rule, their shorter lifespans compared to most other pets in this cluster, and the breeding considerations that come with same-sex group housing.</p>
    <?php return ob_get_clean();
}

function pz_why_important_mouse_rat_care_guide() {
    ob_start(); ?>
    <p>A few facts matter for anyone considering a pet mouse or rat, including how the two species differ from each other and how both differ from a hamster.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🧠</span>
        <div><strong>Rats are generally more trainable than mice</strong><p>Rats are widely considered more intelligent and more likely to form a social bond with their human caretaker than mice, a real distinguishing difference between the two species covered in this guide.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">👥</span>
        <div><strong>Isolation is the harder setup for this pair</strong><p>Keeping a single mouse or rat without any cagemates at all is usually the less comfortable option for the animal, so budgeting for at least two from the outset saves a later rehoming scramble.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⏳</span>
        <div><strong>Shorter lifespans than most pets in this cluster</strong><p>Mice are tiny, while rats are considerably bigger, around hedgehog-sized, but both species live shorter lives than most of the other small pets covered in this cluster, which matters for the length of commitment involved.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🚫</span>
        <div><strong>Litters can pile up fast if sexes mix</strong><p>A mouse or rat can be pregnant again within days of giving birth, so a single mixed-sex pair can turn into dozens of animals in a matter of months — same-sex grouping is what keeps numbers manageable.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_mouse_rat_care_guide() {
    return [
        ['title' => 'Decide between a mouse and a rat based on interaction style', 'desc' => 'If you want a pet that\'s more trainable and likely to bond socially with you, a rat is generally a better fit than a mouse.'],
        ['title' => 'House in same-sex groups rather than alone', 'desc' => 'Give mice or rats same-sex cagemates instead of a solo setup — a Syrian hamster needs the reverse, kept by itself to prevent fights.'],
        ['title' => 'Keep males and females separated', 'desc' => 'Both species are prolific breeders, so same-sex group housing is the practical way to prevent unwanted, frequent litters.'],
        ['title' => 'Plan for a shorter lifespan than most other pets in this cluster', 'desc' => 'Mice and rats are generally shorter-lived than most other small pets covered here, which is worth factoring into your decision upfront.'],
        ['title' => 'Provide enrichment suited to each species\' activity level', 'desc' => 'Both benefit from climbing structures, chew items, and regular interaction, with rats typically engaging more directly with training and handling.'],
        ['title' => 'Feed a balanced commercial diet for the species', 'desc' => 'A quality commercial mouse or rat food, supplemented with small amounts of fresh food, covers most nutritional needs for either species.'],
    ];
}

function pz_tips_mouse_rat_care_guide() {
    return [
        ['Choose a rat if trainability matters to you', 'Rats are generally considered more intelligent and more likely to bond with their caretaker than mice, which is worth weighing if interactive handling is a priority.'],
        ['Keep a group of the same sex rather than a lone mouse or rat', 'Isolation is hard on either species emotionally, and grouping by sex also sidesteps the breeding explosion that comes with mixing males and females.'],
        ['Separate males and females unless breeding is intended', 'Both species breed readily, so same-sex group housing prevents unplanned litters.'],
        ['Factor in the shorter lifespan when deciding', 'Mice and rats are generally shorter-lived than most other small pets in this cluster, so plan your expectations accordingly.'],
        ['Give rats more structured handling time', 'Because rats tend to bond more socially with people than mice do, regular handling and simple training pay off more noticeably with a rat.'],
    ];
}

function pz_mistakes_mouse_rat_care_guide() {
    return [
        ['❌ Assuming mice and rats need identical care', 'They\'re closely related, but rats are generally more trainable and more socially bonded with people than mice, a real difference worth planning around.'],
        ['❌ Housing a mouse or rat completely alone', 'A solitary setup suits a Syrian hamster, not a mouse or rat — both do better with same-sex cagemates for company.'],
        ['❌ Mixing males and females "just to see"', 'Female mice and rats can conceive again almost immediately after giving birth, so an unplanned pair can snowball into a large, unmanageable colony within weeks.'],
        ['❌ Underestimating how fast a mixed group multiplies', 'What starts as two animals can become a dozen or more before you notice, which is exactly why same-sex housing is the default recommendation, not a preference.'],
        ['❌ Expecting a mouse to be as trainable as a rat', 'Rats are generally considered more trainable and more socially bonded with their caretaker, so expecting the same level of interaction from a mouse can lead to disappointment.'],
    ];
}

function pz_faq_mouse_rat_care_guide() {
    return [
        ['Are rats or mice more trainable?', 'Rats are generally considered more intelligent, more trainable, and more likely to bond socially with their human caretaker than mice.'],
        ['Should pet mice or rats be housed alone?', 'No, keep them with same-sex companions — a mouse or rat left on its own tends to fare worse, the reverse of a Syrian hamster, which has to live by itself.'],
        ['Can I house a male and female mouse or rat together?', 'Only if you\'re prepared to breed them deliberately. Females can become pregnant again almost right after giving birth, so an unplanned mixed-sex pair can multiply into a large group faster than most owners expect.'],
        ['How long do pet mice and rats live compared to other small pets?', 'Mice stay small while rats grow notably larger, but both species have shorter lifespans than most of the other small pets covered in this cluster, so plan the length of commitment accordingly.'],
        ['Is a rat or a mouse a better fit for someone who wants an interactive pet?', 'A rat is generally the better fit, since rats are more likely to bond socially with their caretaker and respond well to training compared to mice.'],
    ];
}
