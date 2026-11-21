<?php
/**
 * Tool-specific content for: Rabbit Health Symptoms Checker (registry key: rabbit_health_checker).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_rabbit_health_checker() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Watch for a rabbit that stops eating or eats much less than usual, produces fewer or smaller droppings, seems unusually quiet or hunched, or has swelling, discharge, or trouble moving. Any of these are signs to get her checked by a vet, since rabbits can decline quickly when something is wrong.</div>
<?php }

function pz_what_is_rabbit_health_checker() {
    ob_start(); ?>
    <p>This checker covers recognizable warning signs that something may be wrong with a pet rabbit — things like a drop in appetite, changes in droppings, lethargy, and signs related to her teeth — so you know when a vet visit is the right call.</p>
    <p>Rabbits tend to hide illness well and can go downhill quickly once a problem starts, so noticing early changes in eating, droppings, and behavior matters more than waiting for an obvious symptom.</p>
    <p>This is a list of signs to watch for, not a diagnosis. Any of these signs is a reason to contact a vet rather than wait and see.</p>
    <?php return ob_get_clean();
}

function pz_why_important_rabbit_health_checker() {
    ob_start(); ?>
    <p>Rabbits are prey animals that often mask discomfort, so the first visible sign of a problem can already be fairly advanced.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🍽️</span>
        <div><strong>Appetite changes come first</strong><p>A rabbit that eats less or stops eating hay, which is usually the first food she goes off, is showing one of the earliest and most telling signs something is wrong.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💩</span>
        <div><strong>Droppings reflect digestion</strong><p>Fewer, smaller, or oddly shaped droppings can point to a slowdown in her gut that needs attention.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">😴</span>
        <div><strong>Behavior shifts are a clue</strong><p>A rabbit that is unusually quiet, hunched, or hiding more than normal is often communicating discomfort she cannot show any other way.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦷</span>
        <div><strong>Teeth affect everything else</strong><p>Overgrown or uneven teeth can make eating painful, which then shows up as the same appetite and droppings changes listed above.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_rabbit_health_checker() {
    return [
        ['title' => 'Check whether she is eating normally', 'desc' => 'Look specifically at hay intake, since hay is often the first food a rabbit stops eating when something is wrong.'],
        ['title' => 'Look at her droppings', 'desc' => 'Note whether droppings are fewer, smaller, misshapen, or missing entirely compared to her usual pattern.'],
        ['title' => 'Watch her posture and activity level', 'desc' => 'A hunched posture, reluctance to move, or unusual quietness can all be signs of discomfort.'],
        ['title' => 'Check for visible changes', 'desc' => 'Look for swelling, discharge from the eyes or nose, drooling, or a dirty bottom that was not there before.'],
        ['title' => 'Note any changes in breathing or movement', 'desc' => 'Labored breathing, head tilt, or difficulty moving around normally are signs that warrant prompt attention.'],
        ['title' => 'Contact a vet if anything on this list applies', 'desc' => 'Rabbits can decline quickly, so it is better to have a vet rule out a problem than to wait and see.'],
    ];
}

function pz_tips_rabbit_health_checker() {
    return [
        ['Learn her normal baseline', 'Knowing what her usual appetite, droppings, and activity look like makes it much easier to notice when something changes.'],
        ['Check droppings as part of a daily routine', 'A quick daily glance at the litter box can catch a digestive slowdown earlier than waiting for other symptoms.'],
        ['Weigh her periodically', 'A gradual weight change can be an early sign of a developing issue before other symptoms appear.'],
        ['Keep a vet contact ready', 'Knowing which vet near you treats rabbits ahead of time saves time if something comes up suddenly.'],
        ['Act quickly on a stopped appetite', 'A rabbit that has not eaten for several hours, especially no hay, should not be left to wait and see.'],
    ];
}

function pz_mistakes_rabbit_health_checker() {
    return [
        ['❌ Waiting to see if appetite loss resolves on its own', 'A rabbit that stops eating can decline quickly, so this is one sign that is better checked sooner rather than later.'],
        ['❌ Ignoring a change in dropping size or number', 'This is often one of the earliest visible signs of a digestive issue and is easy to miss if the litter box is not checked regularly.'],
        ['❌ Assuming quiet behavior just means she is relaxed', 'A hunched, withdrawn, or unusually still rabbit can be showing discomfort rather than simply resting.'],
        ['❌ Overlooking dental signs', 'Drooling, dropped food, or reluctance to eat hard foods can point to a tooth problem that needs a vet to assess.'],
        ['❌ Trying to diagnose or treat at home without a vet', 'This checker is a list of signs to watch for, not a substitute for a vet examining her directly.'],
    ];
}

function pz_faq_rabbit_health_checker() {
    return [
        ['What are early signs something is wrong with a rabbit?', 'A drop in appetite, especially for hay, changes in the number or shape of droppings, and unusual quietness or hunching are common early signs worth watching for.'],
        ['How urgent is it if my rabbit stops eating?', 'It is urgent. Rabbits can decline quickly once appetite drops, so a rabbit that is not eating, especially not eating hay, should be seen by a vet rather than waiting.'],
        ['What do changes in droppings mean?', 'Fewer, smaller, or misshapen droppings can point to a slowdown in digestion and are worth mentioning to a vet, especially alongside reduced appetite.'],
        ['Can tooth problems affect a rabbit\'s overall health?', 'Yes — overgrown or uneven teeth can make eating painful, which then shows up as reduced appetite and changes in droppings.'],
        ['Is lethargy always a sign of illness?', 'Not always, but a rabbit that is unusually quiet, hunched, or hiding more than normal compared to her own baseline is worth having checked.'],
        ['Should I try home remedies before calling a vet?', 'No — this checker is meant to help you recognize signs worth acting on, not to replace a vet visit when something seems off.'],
    ];
}
