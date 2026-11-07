<?php
/**
 * Tool-specific content for: Cat Hyperthyroidism: Symptoms & Treatment (registry key: cat_hyperthyroidism_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_cat_hyperthyroidism_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Hyperthyroidism in cats usually causes weight loss despite a ravenous appetite, along with increased thirst, hyperactivity, vomiting, and a scruffy coat. It is one of the most common hormonal diseases in cats over 10 years old and is caused by a benign enlargement of the thyroid gland. A simple blood test confirms it, and treatment options include daily medication, a prescription iodine-restricted diet, or radioactive iodine therapy, which can be curative. See a vet if your senior cat is losing weight while eating well.</div>
<?php }

function pz_what_is_cat_hyperthyroidism_guide() {
    ob_start(); ?>
    <p>Hyperthyroidism is caused by overproduction of thyroid hormone, almost always from a benign growth on one or both thyroid glands in the neck. The excess hormone speeds up the body's metabolism, which is why affected cats often eat more than ever but still lose weight.</p>
    <p>It is primarily a disease of older cats, with most diagnosed cases in cats over 10 years of age, making it one of the most common endocrine disorders in senior cats according to the Cornell Feline Health Center. The exact cause of the thyroid gland changes is not fully understood, though diet and environmental factors have been studied as possible contributors.</p>
    <p>Diagnosis is confirmed with a blood test measuring total T4, a thyroid hormone level, sometimes alongside a free T4 test if the total T4 result is borderline. Because hyperthyroidism puts strain on the heart and kidneys, your vet will typically also check kidney values and blood pressure as part of the workup.</p>
    <?php return ob_get_clean();
}

function pz_why_important_cat_hyperthyroidism_guide() {
    ob_start(); ?>
    <p>Hyperthyroidism is very treatable, and cats that are diagnosed and managed promptly generally do well, but the disease can strain the heart and kidneys if it goes untreated for a long time.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">❤️</span>
        <div><strong>It stresses the heart</strong><p>Excess thyroid hormone makes the heart work harder and can lead to a thickened heart muscle. This heart change often improves once the thyroid condition is treated.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🩺</span>
        <div><strong>It can mask kidney disease</strong><p>Hyperthyroidism increases blood flow to the kidneys, which can make underlying kidney disease look better than it really is on bloodwork until the thyroid is treated.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📉</span>
        <div><strong>Weight loss can be severe if missed</strong><p>Because appetite often stays normal or increases, owners sometimes don't notice a problem until significant muscle and weight loss has already occurred.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💊</span>
        <div><strong>Multiple effective treatments exist</strong><p>From daily medication to a curative radioactive iodine treatment, most cats have a path to good control, and some treatments resolve the condition entirely.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_cat_hyperthyroidism_guide() {
    return [
        ['title' => 'Watch for the classic symptom pattern', 'desc' => 'Weight loss with a big or ravenous appetite, increased thirst, restlessness or hyperactivity, and sometimes vomiting, diarrhea, or a messy, unkempt coat are the hallmark signs.'],
        ['title' => 'Get a thyroid blood test (T4)', 'desc' => 'This simple, widely available blood test is usually the first step. Most hyperthyroid cats have a clearly elevated total T4, though some early or mild cases may need a free T4 test to confirm.'],
        ['title' => 'Have heart and kidney function checked', 'desc' => 'Your vet will likely check blood pressure, kidney values, and may recommend a heart check, since hyperthyroidism affects both and can mask early kidney disease.'],
        ['title' => 'Discuss treatment options with your vet', 'desc' => 'Options include daily anti-thyroid medication (tablets or a transdermal gel), a strict iodine-restricted prescription diet, or radioactive iodine therapy, which can permanently resolve the condition in many cats.'],
        ['title' => 'Start treatment and recheck bloodwork', 'desc' => 'Whichever option you choose, your vet will recheck T4 levels and kidney function a few weeks in to make sure the dose or approach is working and not uncovering hidden kidney disease.'],
        ['title' => 'Monitor long-term, even after treatment', 'desc' => 'Cats on daily medication need ongoing monitoring for life. Cats treated with radioactive iodine still need periodic checks, since a small number can become under- or overactive in the thyroid again.'],
    ];
}

function pz_tips_cat_hyperthyroidism_guide() {
    return [
        ['Track weight at home between vet visits', 'A kitchen scale used consistently can catch weight loss earlier than it is visible to the eye, especially in longer-haired cats.'],
        ['Give medication at consistent times', 'Daily anti-thyroid medication works best when given on a steady schedule; ask your vet about reminders or pill-dispensing apps if you struggle to remember doses.'],
        ['If using the iodine-restricted diet, feed it exclusively', 'Even small amounts of other food or treats containing iodine can reduce how well this diet controls the condition, so it generally needs to be the cat\'s only food.'],
        ['Ask about radioactive iodine therapy for a lasting solution', 'For many cats, this treatment can resolve hyperthyroidism long-term and avoid the need for daily medication, though it requires a short hospital stay at a specialized facility.'],
        ['Keep up with recheck bloodwork', 'Thyroid levels and kidney function can shift over time, even on a treatment that initially worked well, so periodic monitoring is part of good long-term management.'],
        ['Watch for signs the dose needs adjusting', 'Returning weight loss, increased appetite, or new vomiting on a previously stable treatment plan can mean the dose needs to be reassessed by your vet.'],
    ];
}

function pz_mistakes_cat_hyperthyroidism_guide() {
    return [
        ['❌ Assuming a hungry, active cat must be healthy', 'A big appetite combined with weight loss is actually a classic warning sign of hyperthyroidism, not a sign of good health, particularly in a senior cat.'],
        ['❌ Skipping the kidney workup', 'Because hyperthyroidism can mask kidney disease, treating the thyroid without monitoring kidney values can unmask a kidney problem that then needs its own management.'],
        ['❌ Stopping medication once the cat seems better', 'Hyperthyroidism from medication alone is a lifelong management condition; stopping medication typically allows symptoms to return.'],
        ['❌ Feeding treats or other food alongside an iodine-restricted diet', 'This commonly reduces the diet\'s effectiveness, since even small amounts of iodine from other foods can interfere with the intended effect.'],
        ['❌ Ignoring new vomiting, diarrhea, or restlessness in an older cat', 'These can be early hyperthyroid signs rather than "just getting older," and a simple blood test can clarify what\'s going on.'],
        ['❌ Not rechecking bloodwork after starting treatment', 'The initial medication dose is a starting point, not a final answer. Follow-up testing is how your vet confirms the dose is actually working.'],
    ];
}

function pz_faq_cat_hyperthyroidism_guide() {
    return [
        ['What are the main symptoms of hyperthyroidism in cats?', 'Weight loss despite a strong or increased appetite, increased thirst and urination, hyperactivity or restlessness, vomiting, and a rough or greasy coat are the most common symptoms, usually appearing in cats over 10 years old.'],
        ['How is feline hyperthyroidism diagnosed?', 'A blood test measuring total T4 (thyroxine) is the standard first test. If results are borderline, your vet may run a free T4 test or repeat testing to confirm the diagnosis.'],
        ['Can hyperthyroidism in cats be cured?', 'Radioactive iodine therapy can be curative for many cats by destroying the overactive thyroid tissue. Daily medication and the iodine-restricted diet control the condition but generally need to be continued long-term rather than curing it.'],
        ['Is hyperthyroidism related to diet?', 'Researchers have studied possible dietary and environmental links, including canned food and flame-retardant chemicals, but no single definitive cause has been established. The iodine-restricted prescription diet is a treatment, not a cause-based cure.'],
        ['Why does my cat need kidney testing with a thyroid diagnosis?', 'Hyperthyroidism increases blood flow to the kidneys, which can temporarily make kidney function look better than it truly is. Vets recheck kidney values after treatment starts to see the true picture.'],
        ['How long does treatment take to work?', 'Daily medication can start lowering thyroid hormone within days to weeks, with bloodwork rechecks typically a few weeks after starting or adjusting the dose. Radioactive iodine therapy may take several weeks to a few months to fully normalize levels.'],
        ['Is hyperthyroidism in cats life-threatening?', 'Untreated, it can lead to serious heart strain and other complications over time, but with appropriate treatment, most cats have a good prognosis and can live comfortably for years.'],
    ];
}
