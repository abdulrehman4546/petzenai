<?php
/**
 * Unique intro/guide content for the "Cat Nutrition" tool category page
 * (/tools/cat-nutrition/). Follows the per-item override convention used by
 * inc/tool-content/*.php, but keyed by category slug instead of tool slug.
 *
 * Returns an HTML string (already escaped where needed) or '' if nothing
 * is registered for the given category — callers should fall back to the
 * generic templated copy in that case.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_category_intro_cat_nutrition() {
    ob_start();
    ?>
    <p>Cats are obligate carnivores, which means their bodies are built to run on animal protein, not on grains, vegetables or plant-based substitutes. Unlike dogs, cats cannot make their own taurine, arachidonic acid or vitamin A from plant precursors — they need these nutrients ready-made from meat and organ tissue. That single biological fact explains most of the feeding mistakes owners make: feeding a dog-style diet, relying too heavily on carbohydrate-filled kibble, or assuming any "complete and balanced" label means the food suits every life stage. The tools below help with the day-to-day math — portions, calories, hydration — but understanding the basics first makes those numbers far more useful.</p>

    <h2>What Cats Actually Need From Their Food</h2>
    <p>A nutritionally sound cat diet centers on a few essentials: a named animal protein as the first ingredient, enough moisture, and a short list of fats and micronutrients that cats cannot synthesize on their own.</p>
    <ul>
      <li><strong>Protein first.</strong> Look for chicken, turkey, fish or a named meat meal at the top of the ingredient list, not "meat by-products" or a long run of grains before any animal protein appears.</li>
      <li><strong>Taurine.</strong> This amino acid supports heart and eye health. Commercial cat foods are formulated to include it, but homemade or raw diets assembled without guidance often fall short.</li>
      <li><strong>Moisture.</strong> Cats evolved from desert ancestors and have a weak thirst drive, so they often don't drink enough to compensate for a dry-food-only diet. Wet food, broths or a water fountain all help keep intake up.</li>
      <li><strong>Essential fatty acids.</strong> Arachidonic acid, found in animal fat, supports skin, coat and immune function and cats cannot make it from plant oils the way dogs can.</li>
      <li><strong>Life-stage formulation.</strong> Kitten, adult maintenance, and senior formulas differ in calorie density and nutrient ratios — a kitten-specific food supports rapid growth, while a senior formula is usually lower in calories and easier to digest.</li>
    </ul>

    <h2>Common Cat Nutrition Mistakes</h2>
    <p>Most feeding problems come from habits that seem harmless but add up over months or years.</p>
    <ul>
      <li><strong>Free-feeding dry food all day.</strong> It's convenient, but it makes portion control nearly impossible and is one of the most common contributors to indoor cat obesity.</li>
      <li><strong>Trusting the bag's feeding chart as gospel.</strong> Those charts are written for an average cat and often overstate what a typical neutered, indoor cat actually burns. A calorie calculator based on your cat's own weight, age and activity level gives a more realistic starting point.</li>
      <li><strong>Switching foods abruptly.</strong> Cats have sensitive digestive systems and a strong preference for familiar food; a sudden switch can cause vomiting, diarrhea, or a cat that simply refuses to eat. Transition over 7–10 days, mixing in increasing amounts of the new food.</li>
      <li><strong>Assuming "grain-free" means healthier.</strong> Grain-free isn't the same as low-carbohydrate, and some grain-free formulas replace grains with other starches. What matters more is the overall protein and moisture content, not the absence of a single ingredient category.</li>
      <li><strong>Feeding dog food, raw milk, or table scraps as a staple.</strong> Dog food lacks adequate taurine for cats, cow's milk causes digestive upset in most adult cats due to lactose intolerance, and many "people foods" — onions, garlic, grapes, raw dough — are genuinely toxic to cats.</li>
      <li><strong>Ignoring weight trends.</strong> Because cats are small, a slow, steady weight gain can go unnoticed for a long time. Checking body condition (feeling for ribs under a thin layer of fat) every few weeks catches creeping weight gain before it becomes a health issue.</li>
    </ul>

    <h2>When to See a Vet</h2>
    <p>Diet can prevent many problems, but it isn't a substitute for veterinary care. Talk to a vet if your cat shows a sudden change in appetite (eating much more or much less than usual), unexplained weight loss or gain, repeated vomiting or diarrhea, or if you're planning a therapeutic diet for a diagnosed condition like kidney disease or diabetes. Kittens, pregnant or nursing cats, and senior cats all have nutritional needs that benefit from a vet's input rather than guesswork, since the right balance can shift quickly with age or health status.</p>
    <p>The calculators and guides below are a practical starting point for everyday feeding decisions — use them alongside, not instead of, guidance from your cat's own vet.</p>
    <?php
    return ob_get_clean();
}
