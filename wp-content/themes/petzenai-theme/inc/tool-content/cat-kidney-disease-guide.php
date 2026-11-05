<?php
/**
 * Tool-specific content for: Cat Kidney Disease: Early Signs & Management (registry key: cat_kidney_disease_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_cat_kidney_disease_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Increased thirst and urination, weight loss, and a reduced appetite are the most common early signs of chronic kidney disease (CKD) in cats, a condition that becomes more common with age and is especially worth screening for from around age 10 onward. There is no cure, but bloodwork can catch it early, and diet and management can slow its progression and protect quality of life. Any cat showing these signs needs a vet visit for bloodwork and urinalysis.</div>
<?php }

function pz_what_is_cat_kidney_disease_guide() {
    ob_start(); ?>
    <p>Chronic kidney disease, or CKD, is one of the most common conditions in older cats. It develops gradually as kidney tissue is lost over time, and because kidneys have a large filtering reserve, a cat can lose a significant portion of kidney function before any symptoms become noticeable at home.</p>
    <p>Vets stage CKD using a system called IRIS, based primarily on a blood marker called creatinine, sometimes alongside a newer marker called SDMA, which can detect kidney dysfunction earlier, potentially when only about a quarter of kidney function has been lost. The disease is staged from 1, the earliest and mildest, to 4, the most advanced, with signs becoming more noticeable as the stage progresses.</p>
    <p>There is currently no cure for CKD, but management, primarily through diet and monitoring, focuses on slowing progression, controlling symptoms, and preserving quality of life for as long as possible. Earlier detection generally allows more time for these measures to help.</p>
    <?php return ob_get_clean();
}

function pz_why_important_cat_kidney_disease_guide() {
    ob_start(); ?>
    <p>Because kidney disease often develops silently, understanding the early signs and the value of routine screening can lead to an earlier diagnosis and more years of good quality of life.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🩸</span>
        <div><strong>Early signs are easy to miss</strong><p>In the earliest IRIS stages, a cat may show few or no obvious symptoms, which is why bloodwork, not just watching behavior, is key for early detection.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📈</span>
        <div><strong>It becomes much more common with age</strong><p>CKD risk rises notably in cats around 10 years and older, which is part of why routine senior bloodwork is recommended starting around this age.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🍽️</span>
        <div><strong>Diet is a major management tool</strong><p>A kidney-support diet is commonly recommended starting at IRIS stage 2 and beyond, and can play a meaningful role in slowing progression and managing symptoms.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⏳</span>
        <div><strong>Earlier detection means more management options</strong><p>Catching CKD at an earlier stage generally allows more time to implement diet changes and monitoring before more serious complications develop.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_cat_kidney_disease_guide() {
    return [
        ['title' => 'Watch for increased thirst and urination', 'desc' => 'A cat drinking noticeably more water or producing larger or more frequent urine clumps in the litter box is one of the earliest and most common signs.'],
        ['title' => 'Monitor appetite and weight', 'desc' => 'A gradual decline in appetite or unexplained weight loss over weeks to months is a common sign, particularly as the disease progresses.'],
        ['title' => 'Note coat and energy changes', 'desc' => 'A duller coat, reduced grooming, or lower energy levels can accompany kidney disease, especially at more advanced stages.'],
        ['title' => 'Schedule routine senior bloodwork', 'desc' => 'Starting around age 10, annual or twice-yearly bloodwork and urinalysis can catch CKD markers like creatinine and SDMA before symptoms are obvious at home.'],
        ['title' => 'Follow up on an abnormal result with staging', 'desc' => 'If kidney values are elevated, your vet will typically use the IRIS staging system, based on creatinine and other markers, to determine severity and guide treatment.'],
        ['title' => 'Work with your vet on an ongoing management plan', 'desc' => 'This often includes a kidney-support diet, monitoring bloodwork over time, and treating any complications like high blood pressure or low potassium as they arise.'],
    ];
}

function pz_tips_cat_kidney_disease_guide() {
    return [
        ['Schedule senior wellness bloodwork starting around age 10', 'Routine screening is how most early-stage CKD is actually found, since symptoms are often minimal or absent at this point.'],
        ['Track water intake and litter box output', 'Noticing a gradual increase over weeks, rather than relying on memory alone, makes subtle changes easier to catch.'],
        ['Ask your vet about SDMA testing', 'This marker can sometimes detect kidney dysfunction earlier than creatinine alone, which may support earlier intervention.'],
        ['Discuss kidney-support diets once a diagnosis is confirmed', 'These diets are commonly recommended from IRIS stage 2 onward and are one of the more evidence-supported management tools available.'],
        ['Keep fresh water easily accessible everywhere in the home', 'Cats with CKD often benefit from extra encouragement to drink; multiple water stations or a fountain can help.'],
        ['Stick to your vet\'s recheck schedule', 'Regular monitoring lets your vet adjust the management plan as the disease progresses, rather than reacting only when symptoms worsen.'],
    ];
}

function pz_mistakes_cat_kidney_disease_guide() {
    return [
        ['❌ Waiting for obvious symptoms before testing', 'Because of the kidneys\' large reserve capacity, a cat can lose a significant portion of kidney function before symptoms are noticeable, which is why routine screening matters more than waiting for signs.'],
        ['❌ Assuming increased thirst is "just normal aging"', 'Increased thirst and urination are classic early signs of CKD and other conditions, and should prompt a vet visit rather than be dismissed as a typical part of getting older.'],
        ['❌ Trying a homemade kidney diet without professional guidance', 'Most homemade diets found in books or online are not complete and balanced for a cat with CKD, and getting the nutrient balance wrong can do more harm than good.'],
        ['❌ Stopping monitoring once a diet change is made', 'CKD is a progressive condition, and ongoing bloodwork is needed to track how it is changing over time and adjust management accordingly.'],
        ['❌ Skipping senior wellness visits to save money', 'Routine senior bloodwork is one of the most effective ways to catch CKD and other age-related conditions early, when there is more time to manage them well.'],
        ['❌ Assuming a stage 1 diagnosis does not need action', 'While management approaches for stage 1 are still debated among vets, an early diagnosis still provides valuable information for monitoring frequency and watching for progression.'],
    ];
}

function pz_faq_cat_kidney_disease_guide() {
    return [
        ['What are the early signs of kidney disease in cats?', 'Increased thirst and urination, gradual weight loss, and reduced appetite are the most common early signs. These can be subtle, since the kidneys have a large reserve and significant function can be lost before symptoms become noticeable.'],
        ['At what age should cats be screened for kidney disease?', 'Many vets recommend starting routine senior bloodwork, which includes kidney markers, around age 10, with annual or twice-yearly testing depending on the individual cat\'s health and risk factors.'],
        ['What is the IRIS staging system?', 'IRIS is a staging system vets use to classify the severity of chronic kidney disease, from stage 1 (earliest, often without clear symptoms) to stage 4 (most advanced), based primarily on blood creatinine levels, with proteinuria and blood pressure used as sub-stage factors.'],
        ['Can chronic kidney disease in cats be cured?', 'No, CKD currently has no cure. Management instead focuses on slowing its progression, treating complications, and maintaining the cat\'s quality of life, often for a meaningful length of time after diagnosis.'],
        ['Does diet really help with feline kidney disease?', 'Yes, a kidney-support diet is commonly recommended starting at IRIS stage 2 and is one of the better-supported management tools for slowing progression and managing symptoms, though its role at stage 1 is less clear-cut and still debated.'],
        ['What is SDMA and why does it matter?', 'SDMA is a blood marker that can indicate reduced kidney function earlier than the traditional marker, creatinine, sometimes when as little as about 25% of kidney function has been lost, which can support earlier diagnosis.'],
        ['What complications can happen in later-stage kidney disease?', 'Cats with more advanced CKD can develop complications such as muscle loss, low blood potassium, high blood pressure, and anemia, which vets typically manage with a combination of diet, medication, and sometimes supportive treatments like fluids.'],
    ];
}
