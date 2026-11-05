<?php
/**
 * Tool-specific content for: Cat Ear Cleaning Guide (registry key: cat_ear_cleaning_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_cat_ear_cleaning_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Most healthy cats need very little ear cleaning, since their ears are largely self-maintaining. Clean only the visible, outer part of the ear with a vet-approved cleaner when you see mild wax or debris, and see a vet instead of cleaning if you notice odor, redness, dark discharge, or your cat shaking her head or scratching at an ear repeatedly.</div>
<?php }

function pz_what_is_cat_ear_cleaning_guide() {
    ob_start(); ?>
    <p>This guide is centered on telling the difference between routine ear maintenance and the signs of an ear problem, since that distinction matters more than the mechanics of cleaning itself for most cat owners.</p>
    <p>Healthy cat ears are largely self-cleaning and need only occasional light maintenance of the visible outer ear. Cleaning that is done too often, or with the wrong products, can actually disrupt the ear's normal protective mechanisms and contribute to irritation rather than preventing it.</p>
    <p>Infection, mites, allergies, and wax buildup can all look similar at a glance, which is why this guide spends as much time on warning signs as it does on technique.</p>
    <?php return ob_get_clean();
}

function pz_why_important_cat_ear_cleaning_guide() {
    ob_start(); ?>
    <p>Knowing what is normal ear maintenance versus what is a red flag protects your cat from both untreated infections and from cleaning-related irritation caused by overdoing it.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🚩</span>
        <div><strong>Odor and discharge are the biggest warning signs</strong><p>A foul smell, dark brown or black discharge, redness, or swelling point toward infection or ear mites and call for a vet visit rather than a home cleaning.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🙅</span>
        <div><strong>Cleaning too often can cause harm</strong><p>Using ear cleaner when it is not needed can disrupt the ear's natural self-cleaning mechanisms and contribute to irritation, rather than prevent problems.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🪲</span>
        <div><strong>Ear mites and infections can look alike</strong><p>Both can cause dark wax, redness, and head shaking, and telling them apart usually needs a vet to look under magnification or examine a wax sample.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🔁</span>
        <div><strong>Repeat infections usually point to a cause</strong><p>A cat with recurring ear infections often has an underlying issue like allergies driving it, and simply cleaning more will not solve a problem that keeps coming back.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_cat_ear_cleaning_guide() {
    return [
        ['title' => 'Check before you clean', 'desc' => 'Look at the visible ear for odor, redness, swelling, dark discharge, or excessive wax before deciding cleaning is actually needed.'],
        ['title' => 'Use only a vet-approved cat ear cleaner', 'desc' => 'Never use cotton swabs, alcohol, or water alone; a proper cleaning solution is formulated to be safe for the ear canal.'],
        ['title' => 'Apply a few drops to the outer ear only', 'desc' => 'Gently massage the base of the ear from the outside for several seconds, then let your cat shake her head to bring debris up.'],
        ['title' => 'Wipe only what you can see', 'desc' => 'Use a cotton ball or soft cloth to wipe the visible part of the ear and the fold; never insert anything into the ear canal itself.'],
        ['title' => 'Stop and watch if signs persist', 'desc' => 'If head shaking, odor, or scratching continues after cleaning, that is a sign to see a vet rather than clean again.'],
        ['title' => 'Reward calm cooperation', 'desc' => 'A treat after each session helps a cat tolerate ear handling over time, since ears can be a sensitive area for many cats.'],
    ];
}

function pz_tips_cat_ear_cleaning_guide() {
    return [
        ['Let the cleaner, and the shake, do the work', 'Fluid applied to the outer canal combined with your cat shaking her head brings debris up without you needing to probe deeper.'],
        ['Never use cotton swabs inside the ear canal', 'They can push debris further in or injure the delicate ear canal; use them only on the outer, visible folds.'],
        ['Clean during a calm moment, not after a stressful event', 'A relaxed cat tolerates ear handling far better than one already on edge.'],
        ['Keep a towel nearby', 'Shaking after the cleaner is applied can fling fluid; a towel over your lap or nearby makes cleanup easy.'],
        ['Check both ears even if only one seems affected', 'Comparing to the unaffected ear helps you judge whether what you are seeing is actually unusual.'],
        ['Track frequency of any needed cleanings', 'If you find yourself cleaning often, that frequency itself is worth mentioning to a vet, since healthy ears rarely need frequent intervention.'],
    ];
}

function pz_mistakes_cat_ear_cleaning_guide() {
    return [
        ['❌ Cleaning ears on a routine schedule regardless of need', 'Healthy cat ears are largely self-maintaining; cleaning them when there is no buildup can disrupt normal ear defenses.'],
        ['❌ Using cotton swabs inside the ear canal', 'This risks pushing debris deeper or injuring the canal; swabs should only touch the visible outer ear and folds.'],
        ['❌ Mistaking an infection for simple wax buildup', 'Odor, dark discharge, redness, or swelling suggest infection or mites, not routine wax, and cleaning alone will not resolve the underlying problem.'],
        ['❌ Using human ear cleaning products or alcohol', 'These are not formulated for a cat\'s ear canal and can cause pain or irritation; use only a vet-approved cat ear cleaner.'],
        ['❌ Continuing to clean when signs do not improve', 'If head shaking, scratching, or odor continue after a cleaning, repeating the cleaning is not the answer; a vet visit is needed to identify the actual cause.'],
        ['❌ Ignoring recurring ear infections as just bad luck', 'Repeat infections usually have an underlying driver, often allergies, and deserve investigation rather than repeated rounds of cleaning or treatment.'],
    ];
}

function pz_faq_cat_ear_cleaning_guide() {
    return [
        ['How often should I clean my cat\'s ears?', 'Most healthy cats need very little routine ear cleaning. Clean only when you actually see mild wax or debris on the visible outer ear, rather than on a fixed schedule.'],
        ['What are the signs of an ear infection in cats?', 'Foul odor, redness, swelling, dark brown or black discharge, frequent head shaking, and scratching at the ear are common signs of infection or ear mites, and warrant a vet visit rather than home cleaning.'],
        ['Can I use cotton swabs to clean my cat\'s ears?', 'Only on the visible outer ear and folds, never inside the ear canal, where they can push debris deeper or cause injury.'],
        ['Is dark wax in my cat\'s ear always a sign of mites?', 'Dark brown or black wax can indicate either ear mites or a bacterial or yeast infection. The two can look similar, so a vet exam is usually needed to tell them apart and treat the actual cause.'],
        ['What should I use to clean my cat\'s ears?', 'A vet-approved cat ear cleaning solution is best. Avoid water alone, alcohol, or human ear products, since they are not formulated for a cat\'s sensitive ear canal.'],
        ['Why does my cat keep getting ear infections?', 'Recurring infections often point to an underlying cause such as allergies, rather than needing more frequent cleaning. If infections keep coming back, it is worth discussing the pattern with your vet rather than cleaning more often.'],
        ['Is it safe to clean my cat\'s ears myself at home?', 'Yes, for mild, routine maintenance using a proper cat ear cleaner on the visible outer ear. Anything beyond mild wax, or any sign of pain, odor, or discharge, is better handled by a vet.'],
    ];
}
