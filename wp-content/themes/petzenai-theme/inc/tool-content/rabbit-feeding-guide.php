<?php
/**
 * Tool-specific content for: Rabbit Feeding Guide: Diet, Hay & Vegetables (registry key: rabbit_feeding_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_rabbit_feeding_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A healthy rabbit diet is built mostly from unlimited grass hay, with a smaller daily measured amount of pellets, a mix of fresh leafy vegetables each day, and fresh water always available. Fruit and other treats are an occasional extra, not a daily staple.</div>
<?php }

function pz_what_is_rabbit_feeding_guide() {
    ob_start(); ?>
    <p>This guide covers the basic structure of a pet rabbit's diet: hay as the largest part of what she eats, pellets as a smaller daily supplement, fresh vegetables added every day, and fruit kept to an occasional treat.</p>
    <p>Keeping fiber moving through her gut is the real priority behind this whole structure. Hay should make up the large majority of her daily intake, with the other foods filling in nutrients that hay alone does not fully cover.</p>
    <p>Treat the amounts below as a general starting pattern. Individual rabbits vary by size and activity, so watch her weight and droppings and adjust portions if something looks off.</p>
    <?php return ob_get_clean();
}

function pz_why_important_rabbit_feeding_guide() {
    ob_start(); ?>
    <p>Getting the balance of hay, pellets, and vegetables right matters because a rabbit's digestive system depends on a steady supply of fiber to keep working properly.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🌾</span>
        <div><strong>Hay keeps digestion moving</strong><p>Constant access to hay supports gut motility and helps wear down continuously growing teeth, so a rabbit without enough hay is at higher risk of digestive slowdowns.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🥬</span>
        <div><strong>Vegetables add variety and nutrients</strong><p>A daily mix of fresh leafy vegetables fills in vitamins and minerals that hay and pellets alone do not fully provide.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚖️</span>
        <div><strong>Pellets are a supplement, not the base</strong><p>Pellets are concentrated and easy to overfeed, so keeping the portion measured and modest helps prevent weight gain.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🍓</span>
        <div><strong>Fruit is a treat, not a food group</strong><p>Fruit is higher in sugar than a rabbit's usual diet, so it works best as an occasional small addition rather than something offered daily.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_rabbit_feeding_guide() {
    return [
        ['title' => 'Offer unlimited grass hay', 'desc' => 'Keep timothy, orchard, or meadow hay available at all times, refreshing it daily and removing anything soiled or stale.'],
        ['title' => 'Measure out a daily portion of pellets', 'desc' => 'Offer a small, consistent measured amount of plain pellets once or twice a day rather than filling the bowl freely.'],
        ['title' => 'Add fresh vegetables every day', 'desc' => 'Build a daily mix from a few different leafy greens, introducing new ones gradually so her digestion can adjust.'],
        ['title' => 'Keep fruit to an occasional treat', 'desc' => 'Offer a small piece of fruit only now and then rather than as a regular part of her meals.'],
        ['title' => 'Keep fresh water available at all times', 'desc' => 'Check and refill her water daily, using either a bowl or a bottle, and clean the container regularly.'],
        ['title' => 'Watch her weight and droppings', 'desc' => 'Regular, well-formed droppings and a stable weight are good signs the overall diet is working; changes are worth paying attention to.'],
    ];
}

function pz_tips_rabbit_feeding_guide() {
    return [
        ['Rotate hay types if she gets picky', 'Offering a mix of timothy, orchard, and meadow hay can keep a fussy eater interested in eating enough of it.'],
        ['Introduce new vegetables one at a time', 'Adding a single new vegetable at a time, in a small amount, makes it easier to notice if something does not agree with her.'],
        ['Store hay somewhere dry and ventilated', 'Damp or moldy hay should be thrown out, since fresh, dry hay is a big part of what keeps her diet working well.'],
        ['Keep the pellet portion consistent', 'A set daily amount of pellets, rather than free feeding, makes it easier to spot weight changes early.'],
        ['Rinse and dry fresh vegetables well', 'Rinsing off dirt and residue and patting greens dry before offering them is a simple, low-effort habit worth keeping.'],
    ];
}

function pz_mistakes_rabbit_feeding_guide() {
    return [
        ['❌ Making pellets the main part of the diet', 'Pellets are meant to supplement hay, not replace it as the largest portion of what she eats.'],
        ['❌ Running out of hay', 'Even a short gap without hay removes the steady fiber her digestion depends on.'],
        ['❌ Offering fruit too often', 'Treating fruit as a daily food rather than an occasional extra adds more sugar than her diet is built for.'],
        ['❌ Introducing several new vegetables at once', 'Changing too much of the vegetable mix at the same time makes it harder to tell what caused any upset.'],
        ['❌ Leaving water unchecked', 'A dry bottle or dirty bowl can go unnoticed for a day if it is not checked as part of a daily routine.'],
    ];
}

function pz_faq_rabbit_feeding_guide() {
    return [
        ['What should make up most of a rabbit\'s diet?', 'Hay should make up the large majority of what a rabbit eats day to day, with pellets, vegetables, and the occasional treat filling in the rest.'],
        ['How much hay does a rabbit need?', 'Hay should be available at all times, refreshed daily, rather than given as a limited daily amount the way pellets and vegetables are.'],
        ['Can rabbits eat fruit every day?', 'It is better kept as an occasional treat rather than a daily food, since fruit is higher in sugar than the rest of a rabbit\'s typical diet.'],
        ['How many vegetables should a rabbit get each day?', 'A daily mix of a few different fresh leafy vegetables works well, introduced gradually so her digestion can adjust to each new vegetable.'],
        ['Do rabbits need a water bottle or a bowl?', 'Either works, as long as fresh water is available at all times and the container is checked and cleaned regularly.'],
        ['What if my rabbit stops eating normally?', 'A rabbit that goes off her food, especially hay, should be checked over, since appetite changes can point to a digestive issue that needs attention.'],
    ];
}
