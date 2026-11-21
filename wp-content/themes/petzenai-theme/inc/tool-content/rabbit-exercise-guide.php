<?php
/**
 * Tool-specific content for: Rabbit Exercise Needs & Playtime Guide (registry key: rabbit_exercise_guide).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_rabbit_exercise_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A rabbit needs real out-of-cage time every day, generally in a safe space of around 24 to 32 square feet or more, for several hours rather than just a few minutes. A rabbit who does not get this tends to show it through destructive chewing, weight gain, or a listless, withdrawn mood.</div>
<?php }

function pz_what_is_rabbit_exercise_guide() {
    ob_start(); ?>
    <p>Exercise for a pet rabbit means genuine out-of-cage time in a space large enough to run, jump, and explore — not just being let out of the cage door into a cramped area. This guide covers how much space and time she needs, how to set up a safe exercise pen, and the signs that tell you she is not getting enough.</p>
    <p>A cage or hutch, even a generously sized one, is meant for resting, eating, and using the litter box. It is not a substitute for the larger area she needs to actually move around in every day.</p>
    <p>A safe exercise space, whether a pen, a bunny-proofed room, or supervised access to more of the house, is generally recommended at around 24 to 32 square feet or more, offered for several hours a day rather than a brief supervised stint.</p>
    <?php return ob_get_clean();
}

function pz_why_important_rabbit_exercise_guide() {
    ob_start(); ?>
    <p>A rabbit who does not get enough room to move tends to show it through behavior and health changes rather than simply seeming a bit bored.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🏃</span>
        <div><strong>Daily free-roam time is a real need, not a bonus</strong><p>Several hours of safe space to run and jump every day supports healthy weight, joint condition, and mental wellbeing.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">📐</span>
        <div><strong>Space size matters, not just access</strong><p>A tiny gap of floor space technically outside the cage does not give her room to actually run or jump the way a properly sized pen or room does.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦷</span>
        <div><strong>Under-exercised rabbits often chew destructively</strong><p>Excess energy with nowhere to go frequently gets redirected into chewing furniture, cords, or baseboards.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚖️</span>
        <div><strong>Limited movement shows up as weight and mood changes</strong><p>A rabbit confined too much can gain weight and seem unusually listless or withdrawn compared to her normal self.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_rabbit_exercise_guide() {
    return [
        ['title' => 'Set up a dedicated exercise space', 'desc' => 'A pen, bunny-proofed room, or a secured section of a larger room all work, as long as the space adds up to roughly 24 to 32 square feet or more.'],
        ['title' => 'Bunny-proof the area before letting her loose', 'desc' => 'Tuck away or cover cords, block access to anything you do not want chewed, and remove small objects she could swallow.'],
        ['title' => 'Offer the space for several hours a day', 'desc' => 'A brief few minutes is not enough — aim for an extended daily stretch, whether in one block or spread across the day.'],
        ['title' => 'Add things to interact with inside the space', 'desc' => 'Tunnels, boxes to hide in, and safe chew toys give her more reasons to move around rather than just sitting still.'],
        ['title' => 'Watch for signs she is not getting enough room', 'desc' => 'Destructive chewing, unexplained weight gain, or a noticeably flat, listless mood can all point to insufficient exercise space or time.'],
        ['title' => 'Adjust the setup if those signs show up', 'desc' => 'Expanding the pen, adding more daily hours, or bunny-proofing a larger area are all reasonable responses if she seems under-exercised.'],
    ];
}

function pz_tips_rabbit_exercise_guide() {
    return [
        ['Think in terms of hours, not minutes', 'A quick supervised stretch out of the cage is a start, but several hours of real space to move in daily is the actual target.'],
        ['Rotate toys and layout occasionally', 'Rearranging tunnels and boxes in the exercise space keeps it interesting rather than becoming a static, ignored setup.'],
        ['Pair exercise time with hay access', 'Letting her graze on hay while she has room to move keeps both needs covered at once.'],
        ['Watch her more closely during very hot or very cold stretches', 'Extreme temperatures can affect how much she wants to move, so adjust expectations rather than assuming low activity always means a lack of exercise space.'],
        ['Use destructive chewing as a signal, not just a nuisance', 'Before assuming it is "just a rabbit thing," consider whether she is getting enough daily space and time to burn off energy elsewhere.'],
    ];
}

function pz_mistakes_rabbit_exercise_guide() {
    return [
        ['❌ Treating a few minutes out of the cage as enough exercise', 'A rabbit generally needs several hours of real space to move in daily, not a brief supervised stretch.'],
        ['❌ Using a cramped area and calling it an exercise pen', 'A space well under the recommended 24 to 32 square feet or more does not give her room to actually run or jump.'],
        ['❌ Assuming destructive chewing is just a personality quirk', 'It is often a sign of excess energy with nowhere to go, pointing toward insufficient exercise space or time rather than a fixed trait.'],
        ['❌ Skipping bunny-proofing before free-roam time', 'An unprotected space invites chewed cords and furniture, which is more about the setup than the rabbit\'s behavior.'],
        ['❌ Ignoring a sudden drop in activity level', 'A rabbit who becomes noticeably more listless than her normal self is worth a closer look rather than assuming she is simply getting older or calmer.'],
    ];
}

function pz_faq_rabbit_exercise_guide() {
    return [
        ['How much exercise space does a rabbit need?', 'Generally around 24 to 32 square feet or more of safe space, offered for several hours a day rather than just a short supervised stint.'],
        ['How many hours of free-roam time does a rabbit need daily?', 'Several hours a day is the general target, whether given in one block or spread across the day, rather than a brief few minutes out of the cage.'],
        ['What are signs my rabbit is not getting enough exercise?', 'Destructive chewing, unexplained weight gain, and a noticeably listless or withdrawn mood are common signs that point to insufficient space or time to move.'],
        ['Can I use a spare room instead of a pen?', 'Yes, as long as it is properly bunny-proofed and offers roughly the same amount of usable floor space as a recommended exercise pen.'],
        ['Does a bigger cage replace the need for separate exercise time?', 'No — even a generously sized cage is mainly for resting, eating, and using the litter box, not a substitute for dedicated daily exercise space.'],
        ['Can too little exercise affect a rabbit\'s weight?', 'Yes — limited daily movement can contribute to weight gain over time, which is one of the more common signs of an under-exercised rabbit.'],
    ];
}
