<?php
/**
 * Tool-specific content for: Foods Toxic to Rabbits: Safety Guide (registry key: rabbit_toxic_foods_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_rabbit_toxic_foods_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Chocolate, avocado, bread, pasta, dairy products, and meat are not appropriate foods for a rabbit, since rabbits are herbivores built around hay, vegetables, and a small amount of pellets. Sugary or starchy human snacks should also be kept away from her.</div>
<?php }

function pz_what_is_rabbit_toxic_foods_guide() {
    ob_start(); ?>
    <p>This guide lists human and household foods that are not appropriate for a pet rabbit, so you can recognize what to keep out of reach.</p>
    <p>Rabbits are herbivores with a digestive system built around hay, fresh vegetables, and a small amount of pellets. Most processed human foods, meat, and dairy fall outside what her digestion is set up to handle.</p>
    <p>This list covers foods that are clearly unsafe or simply inappropriate for a rabbit's diet, not a complete catalog of every food in existence, so when in doubt about something not listed here, it is best to leave it out of her diet.</p>
    <?php return ob_get_clean();
}

function pz_why_important_rabbit_toxic_foods_guide() {
    ob_start(); ?>
    <p>Knowing which foods to keep away from a rabbit matters because her digestive system is sensitive and not built to process many common human foods.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🍫</span>
        <div><strong>Chocolate is unsafe</strong><p>Chocolate is not appropriate for rabbits and should be kept well out of reach at all times.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🥑</span>
        <div><strong>Avocado is unsafe</strong><p>Avocado is another food that should never be offered to a rabbit.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🍞</span>
        <div><strong>Starchy, sugary foods do not fit her diet</strong><p>Bread, pasta, and sugary snacks are far outside the hay-and-vegetable diet her digestion is built around.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🧀</span>
        <div><strong>Dairy and meat are inappropriate</strong><p>Rabbits are herbivores, so dairy products and meat have no place in a rabbit's diet.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_rabbit_toxic_foods_guide() {
    return [
        ['title' => 'Keep chocolate completely out of reach', 'desc' => 'Store chocolate somewhere a rabbit cannot access it, including wrappers she might chew on.'],
        ['title' => 'Avoid avocado entirely', 'desc' => 'Do not offer any part of an avocado to a rabbit.'],
        ['title' => 'Skip bread, pasta, and other starchy snacks', 'desc' => 'These foods do not fit a rabbit\'s hay-based digestive needs, so leave them off her menu.'],
        ['title' => 'Avoid dairy products and meat', 'desc' => 'Rabbits are herbivores, so milk, cheese, and any meat are not appropriate foods for her.'],
        ['title' => 'Be cautious with foods not on this list', 'desc' => 'If you are unsure whether something is safe, it is better to leave it out of her diet than to guess.'],
        ['title' => 'Stick to her established safe diet', 'desc' => 'Hay, a measured portion of pellets, and a daily mix of fresh vegetables remain the foundation to build around.'],
    ];
}

function pz_tips_rabbit_toxic_foods_guide() {
    return [
        ['Store risky foods well out of reach', 'Rabbits can be curious chewers, so keep chocolate, bread, and other inappropriate foods somewhere she cannot access.'],
        ['Check labels on treats before offering them', 'Some packaged rabbit treats contain added sugar or starch, so it is worth checking what is actually in them.'],
        ['Supervise if she is ever near human food', 'A rabbit exploring a kitchen or dining area should be watched so she does not grab something off a plate or counter.'],
        ['When in doubt, leave it out', 'If you are not sure whether a food is appropriate for a rabbit, it is simplest to skip offering it.'],
        ['Keep her regular diet consistent', 'A stable diet of hay, measured pellets, and fresh vegetables reduces the temptation to offer something new and untested.'],
    ];
}

function pz_mistakes_rabbit_toxic_foods_guide() {
    return [
        ['❌ Sharing table food out of habit', 'Bread, pasta, dairy, and meat may seem harmless to share, but none of them fit a rabbit\'s herbivore diet.'],
        ['❌ Leaving chocolate or avocado within reach', 'Both should be stored somewhere a curious rabbit cannot get to them.'],
        ['❌ Assuming a small amount is fine', 'Foods that are not appropriate for rabbits do not become appropriate just because the amount is small.'],
        ['❌ Offering an unfamiliar food without checking first', 'If a food is not part of her established safe list, it is better to check than to assume it is fine.'],
        ['❌ Letting treats replace her main diet', 'Even safe treats should stay occasional additions, not a substitute for hay, pellets, and vegetables.'],
    ];
}

function pz_faq_rabbit_toxic_foods_guide() {
    return [
        ['What foods are unsafe for rabbits?', 'Chocolate and avocado are clearly unsafe, and foods like bread, pasta, dairy products, and meat are inappropriate for a rabbit\'s herbivore diet even though they are not framed as toxic in the same way.'],
        ['Can rabbits eat bread or pasta?', 'No — these starchy human foods fall well outside the hay-and-vegetable diet a rabbit\'s digestion is built around.'],
        ['Why can\'t rabbits have dairy or meat?', 'Rabbits are herbivores, so their digestive system is not built to process dairy products or meat.'],
        ['Is a small amount of an unsafe food okay?', 'It is best avoided altogether — foods that are not appropriate for rabbits do not become appropriate in a smaller amount.'],
        ['What should I do if my rabbit eats something she should not have?', 'Contact a vet, especially if she shows any change in eating, droppings, or behavior afterward.'],
        ['What is safe to feed a rabbit instead?', 'Hay as the base, a measured portion of pellets, and a daily mix of fresh vegetables, with fruit kept to an occasional treat.'],
    ];
}
