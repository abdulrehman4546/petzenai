<?php
/**
 * Tool-specific content for: Cat Diabetes: Symptoms, Diet & Management (registry key: cat_diabetes_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_cat_diabetes_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> The classic early signs of diabetes in cats are drinking much more water, urinating more, and losing weight despite a normal or increased appetite. It is most common in middle-aged to older cats, especially those that are overweight. Diagnosis needs bloodwork and a urine test from a vet, and most diabetic cats are managed with insulin and a diet change, with some going into remission. Any cat showing these signs needs a vet visit.</div>
<?php }

function pz_what_is_cat_diabetes_guide() {
    ob_start(); ?>
    <p>Diabetes mellitus in cats, almost always the type similar to human type 2 diabetes, happens when the body stops responding properly to insulin or cannot produce enough of it. Without enough working insulin, glucose builds up in the blood instead of moving into cells for energy, and it spills into the urine, pulling extra water with it.</p>
    <p>That mechanism explains the classic symptom pattern: increased thirst and urination from glucose in the urine, and weight loss because the body cannot use the sugar in the blood and starts breaking down fat and muscle for fuel instead, even though the cat may be eating normally or more than usual.</p>
    <p>According to the Cornell Feline Health Center and AAHA guidelines, diabetes typically affects middle-aged and older cats, and obesity is the single biggest risk factor. Diagnosis requires a vet to confirm persistently high blood glucose along with glucose in the urine, since stress alone can temporarily raise a cat's blood sugar.</p>
    <?php return ob_get_clean();
}

function pz_why_important_cat_diabetes_guide() {
    ob_start(); ?>
    <p>Diabetes is manageable, and many cats respond very well to treatment, but catching it early and managing it consistently makes a real difference to how a cat feels day to day and how likely remission is.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">⚖️</span>
        <div><strong>Obesity is the main driver</strong><p>Overweight cats are significantly more likely to develop diabetes, which is part of why keeping cats at a healthy weight is one of the most useful things an owner can do for long-term health.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🚨</span>
        <div><strong>Untreated diabetes can become an emergency</strong><p>Left unmanaged, diabetes can progress to a serious complication called diabetic ketoacidosis, which causes vomiting, lethargy and can be life-threatening without emergency care.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦶</span>
        <div><strong>Nerve damage can affect the legs</strong><p>Some diabetic cats develop a weakness in the back legs called diabetic neuropathy, which can cause a flat-footed, "plantigrade" walk. It often improves with good glucose control.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🔄</span>
        <div><strong>Some cats achieve remission</strong><p>With prompt diagnosis, a low-carbohydrate diet, and consistent insulin therapy, a meaningful number of diabetic cats reach remission, meaning they no longer need insulin, particularly when treatment starts early.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_cat_diabetes_guide() {
    return [
        ['title' => 'Watch for the classic signs', 'desc' => 'Increased thirst, increased urination (bigger or more frequent clumps in the litter box), weight loss despite normal appetite, and sometimes increased hunger are the hallmark signs.'],
        ['title' => 'Get bloodwork and a urinalysis', 'desc' => 'Your vet will check blood glucose and look for glucose and ketones in the urine. Because stress can raise glucose temporarily, your vet may also check a marker called fructosamine to confirm a true diabetes diagnosis.'],
        ['title' => 'Start insulin therapy as prescribed', 'desc' => 'Most diabetic cats need twice-daily insulin injections. Your vet will show you how to give them and set a starting dose, which is adjusted based on follow-up glucose monitoring.'],
        ['title' => 'Switch to a vet-recommended diabetic diet', 'desc' => 'A low-carbohydrate, higher-protein wet food is commonly recommended and can improve blood sugar control and support a chance of remission, especially when combined with insulin.'],
        ['title' => 'Monitor glucose trends at home or with your vet', 'desc' => 'Glucose curves, either at the clinic or with an at-home monitoring kit your vet trains you to use, help determine whether the insulin dose needs adjusting.'],
        ['title' => 'Watch for signs of low blood sugar', 'desc' => 'Weakness, stumbling, or collapse can indicate low blood sugar (hypoglycemia) from too much insulin relative to food intake. This needs immediate attention; ask your vet in advance what to do if it happens.'],
    ];
}

function pz_tips_cat_diabetes_guide() {
    return [
        ['Keep insulin and feeding schedules consistent', 'Giving insulin and meals at the same times every day helps avoid dangerous swings in blood sugar in either direction.'],
        ['Store insulin exactly as directed', 'Most insulins need refrigeration and gentle handling, not shaking. Follow your vet\'s and the label\'s storage instructions closely, since insulin that is mishandled can lose effectiveness.'],
        ['Track water intake and litter box habits', 'A simple daily note of how much your cat drinks and how the litter box looks helps you and your vet see whether the current plan is working.'],
        ['Keep a glucose log', 'Whether from home monitoring or clinic visits, a log of glucose readings over time is far more useful to your vet than a single number.'],
        ['Ask about an at-home glucose monitor', 'Continuous glucose monitors designed for pets can reduce the stress of frequent blood draws and give a fuller picture of how glucose changes through the day.'],
        ['Maintain a healthy weight', 'Weight loss in overweight diabetic cats, done gradually and under veterinary guidance, can improve insulin sensitivity and supports a better chance of remission.'],
    ];
}

function pz_mistakes_cat_diabetes_guide() {
    return [
        ['❌ Adjusting the insulin dose yourself', 'Insulin dosing needs to be guided by glucose curves and your vet\'s instructions. Changing it without guidance can cause dangerously low blood sugar.'],
        ['❌ Skipping a dose because your cat seems fine', 'Diabetes needs consistent management even on good days. Talk to your vet about a plan for when a dose is missed or your cat refuses to eat.'],
        ['❌ Switching insulin brands or types without veterinary advice', 'Different insulin products are not interchangeable at the same dose. Any change should go through your vet.'],
        ['❌ Ignoring sudden lethargy, vomiting, or collapse', 'These can signal diabetic ketoacidosis or a dangerous low blood sugar episode, both of which need emergency veterinary care right away.'],
        ['❌ Feeding a high-carbohydrate diet out of convenience', 'Many dry foods are higher in carbohydrates than is ideal for a diabetic cat. A vet-guided diet change is one of the most effective tools for better control.'],
        ['❌ Giving up on monitoring once things seem stable', 'Insulin needs can change over time, including dropping to zero in cats that reach remission. Regular rechecks catch these shifts before problems develop.'],
    ];
}

function pz_faq_cat_diabetes_guide() {
    return [
        ['What are the first signs of diabetes in cats?', 'The earliest and most common signs are drinking more water, urinating more, and losing weight even though appetite is normal or increased. Some cats also seem hungrier than usual.'],
        ['Can cat diabetes be cured?', 'There is no guaranteed cure, but some cats, especially with early diagnosis and a low-carbohydrate diet alongside insulin, achieve remission and no longer need insulin. Diabetes can return later, so ongoing monitoring still matters.'],
        ['Do all diabetic cats need insulin injections?', 'Most do, since insulin is currently the most effective and widely used treatment. Your vet may discuss other options in specific cases, but injectable insulin combined with diet remains the standard approach for most cats.'],
        ['Is diabetes in cats related to being overweight?', 'Yes, obesity is considered the single biggest risk factor for feline diabetes, because excess body fat reduces how well the body responds to insulin.'],
        ['What is diabetic ketoacidosis?', 'It is a serious, potentially life-threatening complication of uncontrolled diabetes, where the body breaks down fat too quickly and produces toxic byproducts called ketones. Signs include vomiting, lethargy, and reduced appetite, and it requires emergency veterinary treatment.'],
        ['How often does a diabetic cat need vet checkups?', 'Frequency varies, but most diabetic cats need periodic glucose curves and bloodwork, especially early in treatment or whenever symptoms change, to make sure the insulin dose is still appropriate.'],
        ['Can diet alone manage cat diabetes?', 'Diet changes, particularly a low-carbohydrate wet food, are an important part of management and can improve control, but most newly diagnosed diabetic cats still need insulin alongside the diet change, at least initially.'],
    ];
}
