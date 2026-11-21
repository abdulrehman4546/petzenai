<?php
/**
 * Tool-specific content for: Fish Disease Symptoms Checker (registry key: fish_disease_checker).
 * Registry type is 'checker' and uses the existing fish-specific question set in
 * pz_get_checker_questions() in inc/tool-renderer.php — no custom widget needed here, since that generic
 * checker flow already asks fish-appropriate questions (eating, swimming, visible changes, droppings, water quality).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_fish_disease_checker() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> White spots (commonly called ich), ragged or deteriorating fins (fin rot), cottony or fuzzy patches (fungal infections), and trouble swimming upright (swim bladder issues) are among the most frequently recognized signs of fish illness. Many of these trace back to poor water quality, so testing your water is a useful first step alongside watching for these signs.</div>
<?php }

function pz_what_is_fish_disease_checker() {
    ob_start(); ?>
    <p>This checker walks through common recognizable signs of fish illness — changes in eating, swimming, appearance, droppings, and water quality — to help you spot when something looks off. It's built around recognition, not diagnosis or treatment: the goal is helping you notice a pattern worth acting on, not telling you what medication to use.</p>
    <p>A recurring theme among recognizable fish health issues, including white spots, fin rot, fungal patches, and swimming trouble, is that they frequently trace back to underlying water quality problems. Because of that, checking your water parameters is a useful companion step whenever a fish is showing signs of illness, not just a separate maintenance task.</p>
    <?php return ob_get_clean();
}

function pz_why_important_fish_disease_checker() {
    ob_start(); ?>
    <p>Recognizing early signs and acting on water quality as a likely root cause gives a fish the best chance of a better outcome.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">⚪</span>
        <div><strong>White spots are among the most commonly cited beginner fish disease signs</strong><p>Often referred to as ich, small white spots scattered over the body and fins are one of the more recognizable and frequently discussed symptoms in community aquariums.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🪶</span>
        <div><strong>Fin rot shows up as ragged, shortening, or discolored fins</strong><p>This is often linked to poor water conditions and can progress if the underlying water quality issue isn't addressed.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🍄</span>
        <div><strong>Fungal infections often appear as cottony or fuzzy patches</strong><p>These patches are a visible sign worth noting, especially alongside other changes in behavior or appetite.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💧</span>
        <div><strong>Water quality testing is a useful root-cause check</strong><p>Many recognizable fish health issues are connected to underlying water conditions, so testing alongside watching for symptoms helps address causes, not just signs.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_fish_disease_checker() {
    return [
        ['title' => 'Observe eating behavior first', 'desc' => 'A fish eating less than usual or refusing food entirely is often one of the earliest noticeable changes.'],
        ['title' => 'Watch how the fish is swimming', 'desc' => 'Sluggish movement, floating, sinking, spinning, or staying at the bottom or surface can point to a swim bladder issue or other underlying problem.'],
        ['title' => 'Check for visible physical changes', 'desc' => 'Look for white spots, discoloration, fin damage, fuzzy or cottony patches, or unusual bloating.'],
        ['title' => 'Note any changes in droppings', 'desc' => 'White, stringy, or otherwise unusual-looking droppings can be an additional clue worth tracking alongside other signs.'],
        ['title' => 'Test your water parameters', 'desc' => 'Since many fish health issues trace back to water quality, testing helps identify whether that\'s a likely contributing factor.'],
        ['title' => 'Quarantine a fish showing signs when possible', 'desc' => 'Separating an affected fish can help limit the signs from spreading to tankmates while you address water quality and observe further changes.'],
    ];
}

function pz_tips_fish_disease_checker() {
    return [
        ['Test water quality whenever you notice a symptom', 'Because so many fish health issues connect back to water conditions, this is a useful habit rather than an afterthought.'],
        ['Keep a simple log of what you observe and when', 'Tracking changes over a few days makes it easier to see whether a sign is improving, staying the same, or getting worse.'],
        ['Quarantine new fish before adding them to an established tank', 'This can help avoid introducing a recognizable health issue to an otherwise stable tank.'],
        ['Don\'t assume one visible sign means one specific cause', 'Several different issues can produce similar-looking symptoms, so watching the fuller pattern matters more than a single sign alone.'],
        ['Act promptly rather than waiting to see if signs resolve on their own', 'Early attention to water quality and the visible signs generally gives a better chance than delaying.'],
    ];
}

function pz_mistakes_fish_disease_checker() {
    return [
        ['❌ Only checking the fish and ignoring the water', 'Many recognizable fish health issues trace back to water quality, so skipping water testing misses a likely root cause.'],
        ['❌ Waiting for multiple severe signs before taking any action', 'Acting on early signs like reduced appetite or minor fin changes is generally more useful than waiting for things to visibly worsen.'],
        ['❌ Assuming white spots will resolve without any changes to the tank', 'Addressing underlying water conditions alongside watching the visible signs gives a better chance of improvement.'],
        ['❌ Skipping quarantine for new fish', 'Adding new fish directly to an established tank can risk introducing a recognizable health issue to the whole tank.'],
        ['❌ Confusing normal behavior with a disease sign', 'Occasional resting near the bottom or brief changes in activity aren\'t automatically a problem — watching for a sustained pattern matters more than a single moment.'],
    ];
}

function pz_faq_fish_disease_checker() {
    return [
        ['What are white spots on fish usually a sign of?', 'Small white spots scattered over the body and fins are commonly referred to as ich and are among the most frequently cited beginner fish disease signs.'],
        ['What does fin rot look like?', 'Fin rot commonly shows up as ragged, shortening, or discolored fin edges, often linked to underlying water quality issues.'],
        ['Why does water quality matter for fish disease?', 'Many recognizable fish health issues trace back to water conditions, so testing water alongside watching for symptoms addresses a likely root cause, not just the visible sign.'],
        ['Should I quarantine a sick fish?', 'When possible, yes — separating an affected fish can help limit signs from spreading to tankmates while you investigate water quality and watch for changes.'],
        ['What does trouble swimming upright usually indicate?', 'Floating, sinking, or struggling to stay upright is often associated with swim bladder issues, which are worth noting alongside other signs like appetite and appearance.'],
        ['Can this checker tell me exactly what disease my fish has or how to treat it?', 'No — this tool is built around recognizing common signs, not diagnosing a specific disease or providing treatment instructions. Testing your water and observing the fuller pattern of signs is the practical next step.'],
    ];
}
