<?php
/**
 * Tool-specific content for: Parrot Feeding Guide: Diet & Nutrition (registry key: parrot_feeding_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_parrot_feeding_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A pet parrot's diet should be built around a quality pelleted food as the base, with fresh vegetables and a smaller amount of fruit added daily, and seeds treated as an occasional treat rather than the main meal. Larger parrot species (African greys, amazons, macaws, cockatoos) need the variety just as much as small parrot species — the mistake is usually feeding only seed, which leaves gaps a seed mix alone can't fill.</div>
<?php }

function pz_what_is_parrot_feeding_guide() {
    ob_start(); ?>
    <p>This guide covers how to feed a pet parrot — meaning larger parrot species such as African greys, amazons, macaws, cockatoos, eclectus, and Pionus parrots, as distinct from smaller parakeets like budgies. It focuses on what a balanced daily diet looks like and why an all-seed diet falls short, rather than on cage size or training.</p>
    <p>Parrots in the wild spend much of the day foraging across dozens of different plant foods. A pet parrot fed only a seed mix from a bag is eating a narrow, high-fat diet compared to that natural variety, which is why a pelleted food, not seed, should form the diet's base instead.</p>
    <p>Getting feeding right matters because a parrot's diet affects it over a very long lifespan — many parrot species live for decades — so a feeding habit set early tends to stay in place for a very long time.</p>
    <?php return ob_get_clean();
}

function pz_why_important_parrot_feeding_guide() {
    ob_start(); ?>
    <p>What goes in the food bowl is one of the biggest levers an owner has over a parrot's long-term health, more so than with many other pets, because parrots live so long with whatever feeding pattern gets established.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🌻</span>
        <div><strong>Seed alone is an unbalanced diet</strong><p>Seeds are calorie-dense and fatty, and a parrot allowed to pick out only its favorite seeds from a mix can end up eating an even narrower, less balanced diet than the mix itself provides.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🥬</span>
        <div><strong>Fresh vegetables fill gaps pellets and seed don't</strong><p>Leafy greens and other vegetables offered daily provide variety a dry diet alone doesn't, and also give a parrot something to forage through and chew on.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦜</span>
        <div><strong>Species size doesn't change the basic approach</strong><p>Whether it's a smaller conure or a large macaw, the same base pattern — pellets plus fresh vegetables and some fruit, with seed as a treat — applies; only the portion size scales with the bird.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚠️</span>
        <div><strong>Some common human foods are unsafe</strong><p>Avocado, chocolate, caffeine, and alcohol are all unsafe for parrots, so feeding from the table carries real risk even when the intention is just to share a treat.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_parrot_feeding_guide() {
    return [
        ['title' => 'Make pellets the base of the diet', 'desc' => 'Choose a quality pellet formulated for your parrot\'s species size and make it the largest part of the daily diet, using the <a href="/tools/bird-food-portion-calculator/">bird food portion calculator</a> to size the overall feeding amount.'],
        ['title' => 'Add fresh vegetables every day', 'desc' => 'Offer a rotating mix of vegetables such as leafy greens, carrots, and squash daily, swapping varieties so the parrot gets a broader range of nutrients over the week.'],
        ['title' => 'Include fruit in smaller amounts', 'desc' => 'Fruit can be offered as a smaller daily portion alongside vegetables — enough for variety and enrichment without it crowding out pellets and vegetables.'],
        ['title' => 'Treat seed as an extra, not the base', 'desc' => 'If you offer seed at all, keep it to a small treat portion rather than letting it become the main food, since seed alone is unbalanced.'],
        ['title' => 'Remove uneaten fresh food within a few hours', 'desc' => 'Fresh vegetables and fruit spoil faster than pellets, especially in a warm room, so take out what hasn\'t been eaten rather than leaving it in the cage all day.'],
        ['title' => 'Watch body condition and adjust', 'desc' => 'If your parrot is gaining or losing weight, adjust portions and recheck which foods it is actually eating versus leaving in the bowl.'],
    ];
}

function pz_tips_parrot_feeding_guide() {
    return [
        ['Chop vegetables to match the species\' size', 'Small pieces are easier for smaller parrot species to pick up and manage, while larger parrots can handle bigger chunks or whole pieces that also give them something to work on.'],
        ['Use food as part of enrichment, not just a bowl fill', 'Hiding pellets or vegetables in a foraging toy gives a parrot something to work for, instead of a full bowl that removes that natural task entirely.'],
        ['Introduce new foods gradually', 'A parrot used to mostly seed may be slow to try pellets or vegetables at first; offering new foods alongside familiar ones, rather than as a sudden full swap, usually works better.'],
        ['Keep a consistent feeding schedule', 'Feeding at similar times each day makes it easier to notice if your parrot is eating less than usual, which is often an early sign something is off.'],
        ['Don\'t assume a full-looking bowl means a balanced diet', 'A bowl piled with seed can look generous while still being nutritionally narrow; check what is actually in the mix, not just how full it looks.'],
        ['Keep drinking water fresh and separate from food debris', 'Parrots often drop food into water dishes, so checking and changing water more than once a day keeps it appealing and clean.'],
    ];
}

function pz_mistakes_parrot_feeding_guide() {
    return [
        ['❌ Feeding only a seed mix', 'An all-seed diet is calorie-dense and nutritionally narrow, and letting the parrot pick favorite seeds out of the mix narrows it even further.'],
        ['❌ Offering avocado, chocolate, caffeine, or alcohol', 'These are unsafe for parrots and should never be offered, even in small amounts or as an occasional treat.'],
        ['❌ Leaving fresh food in the cage all day', 'Vegetables and fruit left too long in a warm room can spoil and should be removed within a few hours rather than left until the next feeding.'],
        ['❌ Switching foods abruptly', 'A sudden full switch from seed to pellets can lead to a parrot refusing to eat the new food; gradual introduction alongside familiar food works better.'],
        ['❌ Assuming all parrot species eat identically', 'Base diet principles are similar across species, but portion size and some food preferences differ between a small conure and a large macaw, so size matters when planning amounts.'],
    ];
}

function pz_faq_parrot_feeding_guide() {
    return [
        ['What should a parrot eat every day?', 'A base of quality pellets, fresh vegetables offered daily, and a smaller amount of fruit, with any seed kept to a treat-sized portion rather than the main diet.'],
        ['Is an all-seed diet bad for parrots?', 'Yes — seed alone is calorie-dense and nutritionally narrow compared to a diet that includes pellets and fresh vegetables, and parrots often make it worse by picking out only their favorite seeds.'],
        ['What foods are unsafe for parrots?', 'Avocado, chocolate, caffeine, and alcohol are all unsafe and should never be offered to a parrot, regardless of the amount.'],
        ['Do larger parrots need a different diet than smaller ones?', 'The same base pattern of pellets, vegetables, and limited fruit applies across parrot species sizes; the main difference is portion size, which scales with the bird.'],
        ['How long can fresh vegetables stay in the cage?', 'Only a few hours, especially in a warm room — uneaten fresh food should be removed rather than left in the cage until the next feeding.'],
        ['My parrot won\'t eat pellets, only seed. What do I do?', 'Introduce pellets gradually alongside the seed the parrot already eats rather than swapping suddenly, and reduce seed availability over time as pellet eating increases.'],
        ['How do I know if my parrot is eating enough?', 'Watch body condition and weight over time, and note whether the parrot is actually eating the fresh food offered or just leaving it in the bowl.'],
    ];
}
