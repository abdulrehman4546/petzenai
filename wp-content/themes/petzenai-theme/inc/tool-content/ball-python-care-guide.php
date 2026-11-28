<?php
/**
 * Tool-specific content for: Ball Python Care Guide: Feeding & Habitat (registry key: ball_python_care_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_ball_python_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A ball python is a constrictor snake that eats whole prey such as rodents, and adults are commonly fed roughly every one to two weeks rather than daily like many mammal pets. It's normal for a ball python to refuse food periodically, especially around shedding or breeding season, so a skipped meal isn't automatically a sign of illness. As a terrestrial, secretive species, it also needs a secure hide to retreat into, and its humidity needs differ from a desert species like a bearded dragon.</div>
<?php }

function pz_what_is_ball_python_care_guide() {
    ob_start(); ?>
    <p>A ball python is a terrestrial constrictor snake commonly kept as a pet, named for its tendency to curl into a tight ball when it feels threatened. Unlike an insectivorous or omnivorous lizard, a ball python eats whole prey such as appropriately sized rodents and swallows it in one piece rather than grazing throughout the day.</p>
    <p>This guide covers how often an adult ball python typically eats, why it's normal for them to go off food for a stretch, why a secure hide matters for this secretive species, and how its humidity needs differ from a desert lizard like a bearded dragon.</p>
    <?php return ob_get_clean();
}

function pz_why_important_ball_python_care_guide() {
    ob_start(); ?>
    <p>Ball python care differs from both the desert lizards and the diurnal geckos already covered in other guides, and a few of these differences surprise first-time snake owners.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🐭</span>
        <div><strong>Whole prey, fed infrequently</strong><p>As a constrictor, a ball python eats whole rodent prey, and adults are commonly fed roughly every one to two weeks — far less often than most first-time owners expect.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🚫</span>
        <div><strong>Going off food periodically is often normal</strong><p>A ball python refusing a meal, especially during shedding or breeding season, is a known and usually normal pattern rather than automatic cause for concern.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🏠</span>
        <div><strong>A secure hide matters for this secretive species</strong><p>Being terrestrial and secretive by nature, a ball python relies on having a tight, secure hide to retreat into rather than staying out in the open.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💧</span>
        <div><strong>Humidity needs differ from a desert species</strong><p>A ball python's humidity requirements are distinct from a desert-adapted lizard like a bearded dragon, so desert setups aren't a direct match.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_ball_python_care_guide() {
    return [
        ['title' => 'Offer appropriately sized whole prey on a roughly one-to-two-week cycle for adults', 'desc' => 'This spacing matches how infrequently an adult ball python typically needs to eat compared to daily-feeding pets.'],
        ['title' => 'Expect occasional refused meals without panicking', 'desc' => 'Periodic food refusal, particularly around shedding or breeding season, is a known pattern in this species.'],
        ['title' => 'Provide a tight, secure hide in the enclosure', 'desc' => 'A terrestrial, secretive species like the ball python relies on having somewhere enclosed to retreat into.'],
        ['title' => 'Set humidity levels suited to a ball python, not a desert species', 'desc' => 'Humidity needs here differ from a desert-adapted lizard like a bearded dragon, so the setups aren\'t interchangeable.'],
        ['title' => 'Track feeding attempts and shedding together', 'desc' => 'Noting when refusals line up with a shed cycle helps separate a normal pattern from something that needs closer attention.'],
        ['title' => 'Avoid handling right after a feeding', 'desc' => 'Giving a snake time to digest after a meal is a simple step that supports normal feeding behavior going forward.'],
    ];
}

function pz_tips_ball_python_care_guide() {
    return [
        ['Don\'t assume daily feeding like a mammal pet', 'A ball python\'s whole-prey, infrequent feeding pattern is a core difference from most mammal pet routines.'],
        ['Check for a shed cycle before worrying about a skipped meal', 'Food refusal lining up with shedding is a commonly recognized and usually normal pattern.'],
        ['Make sure the hide fits snugly', 'A hide that feels tight and enclosed suits this secretive species better than an overly open space.'],
        ['Don\'t copy a desert-species humidity setup', 'A bearded dragon\'s desert humidity needs are distinct from what a ball python needs.'],
        ['Give the snake quiet time after it eats', 'Minimizing handling right after a meal supports the snake\'s normal digestion.'],
    ];
}

function pz_mistakes_ball_python_care_guide() {
    return [
        ['❌ Feeding whole prey on a daily or near-daily schedule', 'Adult ball pythons are commonly fed roughly every one to two weeks, far less often than daily.'],
        ['❌ Assuming every refused meal signals illness', 'Periodic food refusal, especially around shedding or breeding season, is a recognized normal pattern in this species.'],
        ['❌ Leaving the enclosure without a secure hide', 'A terrestrial, secretive species like the ball python needs somewhere tight and enclosed to retreat into.'],
        ['❌ Using a desert-style humidity setup borrowed from a bearded dragon', 'Ball python humidity needs are distinct from a desert-adapted species.'],
        ['❌ Handling the snake immediately after feeding', 'Giving the snake time to digest undisturbed after a meal is a simple step that is often skipped.'],
    ];
}

function pz_faq_ball_python_care_guide() {
    return [
        ['How often do ball pythons eat?', 'Adults are commonly fed roughly every one to two weeks, since as constrictors they eat whole prey rather than grazing daily.'],
        ['Why is my ball python refusing food?', 'Periodic food refusal, particularly around shedding or breeding season, is a known and often normal pattern rather than automatic cause for concern.'],
        ['Do ball pythons need a hide?', 'Yes — as a terrestrial, secretive species, a ball python relies on having a tight, secure hide to retreat into.'],
        ['Do ball pythons need the same humidity as a bearded dragon?', 'No, their humidity needs differ from a desert-adapted species like the bearded dragon.'],
        ['Should I handle my ball python right after feeding?', 'It\'s better to give the snake quiet time to digest rather than handling it immediately after a meal.'],
    ];
}
