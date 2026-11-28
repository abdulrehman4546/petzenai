<?php
/**
 * Tool-specific content for: Pet Turtle Care Guide: Tank, Diet & Health (registry key: turtle_care_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_turtle_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Most pet turtles are aquatic or semi-aquatic, so their housing needs both a water area for swimming and a dry basking area to climb out onto, unlike the fully terrestrial setups used for lizards and snakes. Diet varies a lot by species and shifts with age, with many turtles being omnivorous and the balance of plant-to-animal food changing as they mature. A healthy, intact shell is a turtle-specific thing to watch for, and many commonly kept pet turtles live for decades, often outliving their owners.</div>
<?php }

function pz_what_is_turtle_care_guide() {
    ob_start(); ?>
    <p>A pet turtle is an aquatic or semi-aquatic reptile, which sets its housing apart from the terrestrial lizards and snakes covered in other guides. Rather than a single land-based enclosure, a turtle's habitat generally needs both a water area it can swim in and a dry basking area it can climb onto.</p>
    <p>This guide covers that water-and-land housing setup, how diet varies by species and shifts with age, shell health as a turtle-specific concept distinct from the skin-shedding concerns of lizards, and the long, often decades-long lifespan many pet turtles have.</p>
    <?php return ob_get_clean();
}

function pz_why_important_turtle_care_guide() {
    ob_start(); ?>
    <p>Turtle care differs from the terrestrial reptiles covered elsewhere in several genuinely species-specific ways worth understanding before bringing one home.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🌊</span>
        <div><strong>Housing needs both water and a dry basking area</strong><p>As an aquatic or semi-aquatic species, a turtle needs a water area for swimming plus a separate dry area to climb out and bask on, unlike a fully terrestrial lizard or snake setup.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🥗</span>
        <div><strong>Diet varies widely by species and age</strong><p>Many pet turtles are omnivorous, but the ratio of plant to animal food can shift considerably as a turtle matures, and needs vary a great deal between species.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🐢</span>
        <div><strong>Shell health is a turtle-specific concern</strong><p>Keeping an eye on shell condition is a distinct concept from the skin-shedding issues that come up with lizards or snakes.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⏳</span>
        <div><strong>Many pet turtles live for decades</strong><p>A long lifespan, often spanning decades, means a turtle is frequently a much longer commitment than most other commonly kept reptiles.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_turtle_care_guide() {
    return [
        ['title' => 'Set up both a swimming area and a dry basking area', 'desc' => 'This water-and-land combination reflects the aquatic or semi-aquatic nature of most pet turtle species.'],
        ['title' => 'Research your specific species\' diet rather than using a generic plan', 'desc' => 'Diet needs vary considerably between turtle species, so species-specific information matters more here than with some other reptiles.'],
        ['title' => 'Adjust the plant-to-animal food ratio as the turtle ages', 'desc' => 'Many turtles shift their dietary balance as they mature, so a diet suited to a young turtle may not match an older one.'],
        ['title' => 'Check the shell regularly for visible changes', 'desc' => 'Shell condition is a turtle-specific thing to monitor, separate from skin-shedding concerns in lizards or snakes.'],
        ['title' => 'Plan for a long-term commitment', 'desc' => 'Many pet turtles live for decades, so housing and care plans should account for a much longer timeline than many other pets.'],
        ['title' => 'Keep both the water and basking areas clean', 'desc' => 'Maintaining both zones supports the overall habitat a turtle needs to stay healthy.'],
    ];
}

function pz_tips_turtle_care_guide() {
    return [
        ['Don\'t rely on a land-only setup borrowed from a lizard or snake', 'Most pet turtles need a water area in addition to dry land, which is a different housing approach entirely.'],
        ['Look up your turtle\'s species before finalizing a diet plan', 'Since diet needs vary so much by species, a plan that fits one turtle may not fit another.'],
        ['Revisit the diet as the turtle grows', 'The plant-to-animal ratio many turtles need can shift with age, so a diet set once isn\'t necessarily a lasting one.'],
        ['Watch the shell for anything that looks different over time', 'Shell health is a turtle-specific indicator worth tracking on its own, apart from any skin or coat concerns in other pets.'],
        ['Think in decades, not years, when planning for a turtle', 'A long, often decades-long lifespan is a key factor in deciding whether a turtle fits a household\'s long-term plans.'],
    ];
}

function pz_mistakes_turtle_care_guide() {
    return [
        ['❌ Housing a turtle with no water area at all', 'Most pet turtles are aquatic or semi-aquatic and need a swimming area alongside dry land, not a land-only enclosure.'],
        ['❌ Using one generic diet plan for every turtle species', 'Diet needs vary a lot by species, so a one-size-fits-all plan can miss what a particular turtle actually needs.'],
        ['❌ Never adjusting diet as the turtle matures', 'Many turtles shift their dietary balance with age, so sticking to a juvenile diet long-term may not suit an adult.'],
        ['❌ Overlooking shell condition', 'Shell health is a turtle-specific concept distinct from skin-shedding in lizards, and it\'s easy to overlook if you\'re not watching for it.'],
        ['❌ Underestimating how long a turtle commitment can last', 'Many pet turtles live for decades, often longer than owners initially plan for.'],
    ];
}

function pz_faq_turtle_care_guide() {
    return [
        ['Do pet turtles need water in their enclosure?', 'Yes, most pet turtles are aquatic or semi-aquatic and need a water area for swimming along with a dry basking area.'],
        ['What do pet turtles eat?', 'Diet varies a lot by species, and many turtles are omnivorous with a plant-to-animal ratio that shifts as they mature.'],
        ['What is shell health and why does it matter?', 'It\'s a turtle-specific concept referring to the condition of the shell, worth monitoring separately from skin-shedding issues seen in lizards or snakes.'],
        ['How long do pet turtles live?', 'Many commonly kept pet turtles live for decades, often outliving their owners, so it\'s a long-term commitment.'],
        ['Is turtle housing the same as a lizard\'s terrestrial setup?', 'No, since most turtles are aquatic or semi-aquatic, their housing needs both water and dry land rather than a fully terrestrial setup.'],
    ];
}
