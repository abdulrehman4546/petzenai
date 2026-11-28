<?php
/**
 * Tool-specific content for: Reptile Shedding Problems & Solutions Guide (registry key: reptile_shedding_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 * General cross-species guide — not species-specific; covers shedding (ecdysis) across most reptiles.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_reptile_shedding_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Shedding, known as ecdysis, is a normal process most reptiles go through periodically as they grow. Getting humidity right for the species plays a major role in a clean, complete shed, and running humidity too low is a common reason a shed ends up incomplete, leaving patches of old skin behind instead of peeling away in one smooth layer. Retained shed stuck on the toes or tail tip is worth watching, since in severe cases it can cut off circulation. It's also normal for appetite or behavior to shift somewhat around a shed, so some change during this period isn't automatically a cause for concern.</div>
<?php }

function pz_what_is_reptile_shedding_guide() {
    ob_start(); ?>
    <p>Shedding, or ecdysis, is the process by which most reptiles periodically shed their outer layer of skin as they grow. This guide looks at shedding across species generally rather than for one particular reptile, since the underlying process and the common things that can go wrong with it are similar across many commonly kept reptiles.</p>
    <p>It covers the role humidity plays in a clean, complete shed, what signs of a stuck or retained shed look like and why they're worth watching, and the normal shifts in appetite or behavior that can show up around a shed cycle.</p>
    <?php return ob_get_clean();
}

function pz_why_important_reptile_shedding_guide() {
    ob_start(); ?>
    <p>Understanding shedding as a normal process, along with what can go wrong with it, helps separate an expected shed cycle from something that actually needs attention.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🔄</span>
        <div><strong>Shedding is a normal, periodic process</strong><p>Most reptiles shed their outer skin layer periodically as part of normal growth, which is expected rather than unusual.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💧</span>
        <div><strong>Humidity plays a major role in a clean shed</strong><p>Getting humidity appropriate for the species supports a complete shed, while running it too low is a common reason a shed comes off in patches or gets stuck.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚠️</span>
        <div><strong>Retained shed on toes or tail tip is worth watching</strong><p>Shed that doesn't come off cleanly in these areas can, in severe cases, cut off circulation, which makes it worth checking for rather than ignoring.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🍽️</span>
        <div><strong>Appetite or behavior shifts around shedding are often normal</strong><p>Some reptiles become less food-motivated or act differently around a shed cycle, and this kind of temporary shift is a recognized normal pattern rather than automatic cause for concern.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_reptile_shedding_guide() {
    return [
        ['title' => 'Learn your species\' expected shedding frequency and pattern', 'desc' => 'Shedding frequency and appearance vary by species, so knowing what\'s typical helps you recognize a normal cycle.'],
        ['title' => 'Keep humidity appropriate for your species during shed cycles', 'desc' => 'Humidity that matches the species\' needs supports a clean, complete shed rather than a patchy or stuck one.'],
        ['title' => 'Check toes and the tail tip after a shed for retained skin', 'desc' => 'These areas are prone to holding onto stuck shed, and leftover skin here is worth checking for every shed cycle.'],
        ['title' => 'Address retained shed promptly if you find it', 'desc' => 'Since stuck shed on toes or the tail tip can cut off circulation in severe cases, it\'s worth dealing with rather than leaving in place.'],
        ['title' => 'Expect some shift in appetite or activity around shedding', 'desc' => 'A temporary change in food interest or behavior during a shed cycle is a recognized normal pattern in many reptiles.'],
        ['title' => 'Provide rough surfaces or soaking options appropriate to your species', 'desc' => 'Many reptiles use texture or moisture to help work shed loose, so having appropriate options in the enclosure can support a smoother shed.'],
    ];
}

function pz_tips_reptile_shedding_guide() {
    return [
        ['Track shed cycles over time to learn your reptile\'s pattern', 'Noticing how often and how completely your reptile sheds helps you recognize when something looks different from normal.'],
        ['Don\'t let humidity drop during an expected shed window', 'Since low humidity is a common cause of incomplete sheds, keeping it on target during a shed cycle matters more than usual.'],
        ['Check between toes and around the tail tip specifically', 'These spots are the most common places for shed to get retained and are easy to overlook in a quick visual check.'],
        ['Don\'t panic over a temporary dip in appetite around a shed', 'A reduced interest in food during shedding is a recognized pattern in some reptiles rather than a sign something is wrong.'],
        ['Offer a humid hide or soaking opportunity if a shed looks stuck', 'Added moisture can help loosen retained shed that didn\'t come off cleanly on its own.'],
    ];
}

function pz_mistakes_reptile_shedding_guide() {
    return [
        ['❌ Ignoring humidity levels during a shed cycle', 'Running humidity too low for the species is a common reason sheds come off in patches or get stuck.'],
        ['❌ Overlooking toes and the tail tip after a shed', 'Retained shed in these spots is easy to miss but can cut off circulation in severe cases if left unaddressed.'],
        ['❌ Assuming any appetite change means illness', 'A temporary shift in food interest around shedding is a recognized normal pattern in many reptiles, separate from an actual health issue.'],
        ['❌ Forcing off shed skin that hasn\'t loosened naturally', 'Pulling at skin that isn\'t ready to come off can cause injury rather than help.'],
        ['❌ Using the same shedding expectations across every species', 'Shedding frequency and appearance vary by species, so one reptile\'s pattern isn\'t automatically the standard for another.'],
    ];
}

function pz_faq_reptile_shedding_guide() {
    return [
        ['What is reptile shedding?', 'Shedding, or ecdysis, is the normal, periodic process most reptiles go through as they shed their outer skin layer while growing.'],
        ['Why does humidity matter for shedding?', 'Humidity that matches the species\' needs supports a clean, complete shed, while humidity that runs too low is a common cause of patchy or stuck sheds.'],
        ['What does stuck or retained shed look like?', 'It typically shows up as leftover skin on the toes or tail tip that hasn\'t come off with the rest of the shed, and it\'s worth checking for since it can cut off circulation in severe cases.'],
        ['Is it normal for appetite to change during shedding?', 'Yes, a temporary shift in appetite or behavior around a shed cycle is a recognized normal pattern in many reptiles.'],
        ['Should I pull off shed skin that hasn\'t come off on its own?', 'It\'s better to support a natural shed with appropriate humidity or soaking rather than forcing off skin that hasn\'t loosened yet.'],
    ];
}
