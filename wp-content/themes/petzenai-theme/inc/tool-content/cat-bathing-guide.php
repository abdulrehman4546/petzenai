<?php
/**
 * Tool-specific content for: How to Bathe a Cat: Step-by-Step Guide (registry key: cat_bathing_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_cat_bathing_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Most cats never need routine baths because self-grooming keeps their coat clean, but a bath is worthwhile if your cat gets into something sticky, oily, or toxic, has a skin condition your vet recommends treating with a medicated shampoo, or cannot groom herself well. Use lukewarm water, a cat-specific shampoo, and work quickly and calmly.</div>
<?php }

function pz_what_is_cat_bathing_guide() {
    ob_start(); ?>
    <p>This guide covers when a cat actually needs a bath, versus when regular brushing is enough, and how to bathe one safely when it is necessary. Cats are efficient self-groomers, so routine bathing is the exception rather than the rule for most of them.</p>
    <p>There are a handful of real reasons to bathe a cat: visible grease or stickiness in the coat, a substance on the fur that she should not lick off, a vet-recommended medicated shampoo for a skin condition, or an inability to self-groom due to obesity, arthritis, or illness.</p>
    <p>Because most cats find water stressful, the aim of this guide is to make a necessary bath as quick, calm, and low-drama as possible, with everything set up before your cat ever touches water.</p>
    <?php return ob_get_clean();
}

function pz_why_important_cat_bathing_guide() {
    ob_start(); ?>
    <p>Knowing when to bathe, and when not to, protects your cat's skin and your relationship with her, since an unnecessary or badly handled bath can cause lasting water-shyness.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🧴</span>
        <div><strong>Over-bathing strips natural oils</strong><p>Cat skin produces oils that protect and condition the coat; frequent unnecessary bathing can dry out skin and lead to irritation or a dull coat.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">☣️</span>
        <div><strong>Some substances need to come off, not be licked off</strong><p>Paint, oil, certain chemicals, or anything toxic on the fur should be washed off promptly rather than left for your cat to remove by grooming.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚖️</span>
        <div><strong>Obesity and arthritis limit self-grooming</strong><p>Cats that cannot reach certain areas of their own body due to weight or joint pain may accumulate grease or debris that a bath, done gently, can help clear.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🩺</span>
        <div><strong>Medicated shampoos require the real thing</strong><p>If a vet prescribes a medicated bath for fleas, ringworm, or a skin infection, contact time with the shampoo matters, so following the specific instructions given is important.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_cat_bathing_guide() {
    return [
        ['title' => 'Set up everything before you start', 'desc' => 'Have towels, cat shampoo, a cup or handheld sprayer, and a non-slip mat in the sink or tub ready before bringing your cat in.'],
        ['title' => 'Brush out mats and loose fur first', 'desc' => 'Tangles tighten when wet, so remove as much loose fur and any existing mats before your cat touches water.'],
        ['title' => 'Use a few inches of lukewarm water', 'desc' => 'Fill the tub or sink shallow, just enough to wet the lower body, and keep the water comfortably warm, never hot or cold.'],
        ['title' => 'Wet and lather gently, avoiding the face', 'desc' => 'Use a cup or low-pressure sprayer to wet the coat, then apply a cat-specific shampoo, keeping water and suds away from the eyes, ears, and nose.'],
        ['title' => 'Rinse thoroughly', 'desc' => 'Leftover shampoo residue can irritate skin, so rinse until the water runs clear and the coat no longer feels slippery.'],
        ['title' => 'Towel dry and keep her warm', 'desc' => 'Wrap her in a towel immediately, blot rather than rub, and keep her in a warm draft-free room until fully dry.'],
    ];
}

function pz_tips_cat_bathing_guide() {
    return [
        ['Trim nails before the bath, not during', 'A quick nail trim beforehand reduces the chance of a scratch if your cat struggles during the bath itself.'],
        ['Only use shampoo made for cats', 'Human or dog shampoo can have a pH or ingredients that irritate cat skin; always use a product labeled safe for cats.'],
        ['Work fast but do not rush rinsing', 'Minimize total bath time to reduce stress, but never shortcut the rinse, since leftover shampoo is itself irritating.'],
        ['Have a second person help if possible', 'One person holding and reassuring while the other washes makes the whole process faster and calmer for everyone, including the cat.'],
        ['Use a rubber mat in the tub or sink', 'A non-slip surface helps your cat feel more secure and reduces frantic scrambling for grip.'],
        ['Keep the room warm afterward', 'A wet cat chills quickly; dry her thoroughly and keep her somewhere warm until her coat is fully dry, especially in cooler weather.'],
    ];
}

function pz_mistakes_cat_bathing_guide() {
    return [
        ['❌ Bathing a cat with no real reason to', 'Routine bathing is unnecessary for most healthy cats and can dry out skin that is already well cared for by self-grooming.'],
        ['❌ Using dog or human shampoo', 'These products are not formulated for cat skin pH and can cause dryness or irritation.'],
        ['❌ Getting water or soap near the eyes and ears', 'This can cause pain, irritation, or in the case of ears, contribute to infection; wash the head area with a damp cloth instead of submerging it.'],
        ['❌ Skipping the rinse to save time', 'Leftover shampoo residue on the skin is a common cause of post-bath itching and irritation.'],
        ['❌ Letting a wet cat air dry in a cold room', 'A soaked coat holds a lot of water and a chilled cat can become genuinely uncomfortable; towel dry promptly and keep her warm.'],
        ['❌ Attempting a full bath alone on a highly resistant cat', 'A single person fighting a frightened cat in water is a recipe for scratches and a worse experience next time; get help or consider a professional groomer.'],
    ];
}

function pz_faq_cat_bathing_guide() {
    return [
        ['Do cats actually need baths?', 'Most healthy cats groom themselves well enough that routine bathing is not needed. Baths are reserved for specific situations: something sticky or toxic on the coat, a vet-recommended medicated shampoo, or an inability to self-groom due to obesity, arthritis, or illness.'],
        ['What kind of shampoo should I use?', 'Always use a shampoo formulated specifically for cats. Human and dog shampoos can have a different pH and ingredients that irritate cat skin.'],
        ['How do I keep my cat calm during a bath?', 'Prepare everything in advance so the bath itself is quick, use lukewarm water, keep a non-slip mat under her feet, and consider having a second person help hold and reassure her.'],
        ['Is it normal for my cat to panic in water?', 'Many cats have little exposure to water and find it genuinely stressful; this is common and not a sign anything is wrong, though working quickly and calmly helps reduce the stress each time.'],
        ['How often can I safely bathe my cat?', 'Unless a vet recommends more frequent medicated bathing for a skin condition, occasional bathing only as needed is best; frequent bathing can dry out the skin and strip natural oils.'],
        ['What should I do if my cat gets something toxic on her fur?', 'Wash the affected area with lukewarm water and a mild cat-safe shampoo as soon as possible to prevent her from licking it off, and contact your vet or a pet poison hotline if the substance may be toxic.'],
        ['Should senior or arthritic cats be bathed differently?', 'Yes, support their joints carefully while handling them in and out of the water, keep the bath brief, and consider a shallower basin so they do not need to stand in deep water.'],
    ];
}
