<?php
/**
 * Tool-specific content for: Chameleon Care Guide: Humidity & Feeding (registry key: chameleon_care_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_chameleon_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> A chameleon is arboreal, spending its time climbing among branches rather than moving around on the floor of its enclosure, so vertical climbing space matters more here than the floor space emphasized for ground-dwelling reptiles. Chameleons drink from dripping or misted water rather than a standing water bowl, and they're generally more solitary and stress-prone with handling than many other reptiles. Their well-known color changes are mainly about mood, temperature, and communication rather than camouflage, and they need both strong UVB lighting and higher humidity than a desert species.</div>
<?php }

function pz_what_is_chameleon_care_guide() {
    ob_start(); ?>
    <p>A chameleon is an arboreal lizard, meaning it spends its time climbing among branches rather than moving around on the floor the way ground-dwelling reptiles do. That changes the housing priority from floor space toward vertical climbing structure, since a chameleon's enclosure needs to give it branches to move through rather than open floor to walk across.</p>
    <p>This guide covers that climbing-focused housing, the dripping or misted water source chameleons need instead of a standing bowl, their more solitary and handling-sensitive temperament, what color change actually communicates, and a UVB-plus-humidity combination that's higher-maintenance than a desert species' needs.</p>
    <?php return ob_get_clean();
}

function pz_why_important_chameleon_care_guide() {
    ob_start(); ?>
    <p>Chameleon care involves several specific needs that are easy to get wrong if a keeper applies habits learned from ground-dwelling reptiles.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🌿</span>
        <div><strong>Arboreal lifestyle means vertical space matters most</strong><p>A chameleon spends its time climbing branches rather than walking on the floor, so climbing structure and enclosure height matter more than floor space.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">💧</span>
        <div><strong>Water comes from dripping or misting, not a bowl</strong><p>Chameleons generally drink water droplets off leaves and surfaces rather than from a standing water bowl, so dripping or misting systems are the way to offer water.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">😤</span>
        <div><strong>More solitary and handling-sensitive than many reptiles</strong><p>Chameleons tend to be more stress-prone with handling and generally do best housed alone rather than with other chameleons.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🎨</span>
        <div><strong>Color change reflects mood and communication, not camouflage</strong><p>A chameleon's color shifts are mainly tied to mood, temperature, and communicating with other chameleons, not to blending into the background.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">☀️</span>
        <div><strong>Needs strong UVB and higher humidity together</strong><p>Unlike a desert species that needs dry air, a chameleon needs both strong UVB lighting and a higher humidity level, a combination that takes more active maintenance.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🦗</span>
        <div><strong>Primarily insectivorous, and often more responsive to moving prey</strong><p>Chameleons mainly eat feeder insects such as crickets, and many keepers find a chameleon responds more to prey that's actively moving than to food sitting still in a dish. Gut-loading and dusting feeder insects with supplements beforehand is a common practice to help round out the diet.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_chameleon_care_guide() {
    return [
        ['title' => 'Prioritize vertical climbing structure over floor space', 'desc' => 'Since a chameleon is arboreal, branches and height matter more to its housing than open floor area.'],
        ['title' => 'Set up a dripper or misting system instead of a water bowl', 'desc' => 'Chameleons generally drink from water droplets on leaves and surfaces rather than a standing bowl.'],
        ['title' => 'House chameleons alone rather than together', 'desc' => 'Their more solitary nature means housing multiple chameleons together tends to add stress rather than company.'],
        ['title' => 'Limit handling and watch for stress signs', 'desc' => 'Chameleons are generally more stress-prone with handling than many other reptiles, so minimizing handling supports their wellbeing.'],
        ['title' => 'Provide both strong UVB lighting and elevated humidity', 'desc' => 'This combination is more demanding than a desert species\' dry-air setup and needs ongoing attention to both factors.'],
        ['title' => 'Read color changes as mood or communication cues, not a camouflage attempt', 'desc' => 'Noticing color shifts can give a sense of how a chameleon is feeling rather than signaling a need to hide.'],
        ['title' => 'Feed feeder insects that move, and gut-load or dust them beforehand', 'desc' => 'Since chameleons are primarily insectivorous and often respond better to moving prey, offering live feeder insects that have been gut-loaded or dusted with supplements supports a more complete diet.'],
    ];
}

function pz_tips_chameleon_care_guide() {
    return [
        ['Add real or secure branches throughout the enclosure height', 'Climbing structure spread through the vertical space suits an arboreal chameleon better than open floor area.'],
        ['Don\'t rely on a water bowl alone', 'A dripper or misting system matches how chameleons actually drink, which a standing bowl often doesn\'t.'],
        ['Avoid housing multiple chameleons in one enclosure', 'Their solitary tendencies mean cohabitation is more likely to cause stress than companionship.'],
        ['Keep handling brief and infrequent', 'Chameleons tend to tolerate handling less well than many other reptiles, so less frequent handling reduces stress.'],
        ['Track both UVB and humidity levels, not just one', 'Since chameleons need both strong UVB and higher humidity, monitoring only one factor can leave the other out of range.'],
        ['Offer live, moving feeder insects rather than relying on a food dish', 'Chameleons are primarily insectivorous and often respond more to prey that\'s actively moving, so live feeder insects tend to work better than food left sitting in a bowl.'],
    ];
}

function pz_mistakes_chameleon_care_guide() {
    return [
        ['❌ Setting up a ground-dwelling-style enclosure with lots of floor space', 'An arboreal chameleon needs vertical climbing structure far more than open floor area.'],
        ['❌ Offering only a standing water bowl', 'Chameleons generally drink from dripping or misted water, so a bowl alone may not provide water in a way they\'ll use.'],
        ['❌ Housing more than one chameleon together', 'Their solitary, stress-prone nature makes cohabitation more likely to cause problems than benefits.'],
        ['❌ Handling a chameleon frequently like a calmer reptile', 'Chameleons tend to be more stress-prone with handling than many other reptiles.'],
        ['❌ Assuming color change means the chameleon is hiding or camouflaging', 'Color shifts are mainly about mood, temperature, and communication, not blending into surroundings.'],
    ];
}

function pz_faq_chameleon_care_guide() {
    return [
        ['Do chameleons need climbing branches?', 'Yes — as an arboreal species, a chameleon spends its time climbing, so vertical branches matter more to its housing than floor space.'],
        ['How do chameleons drink water?', 'They generally drink from dripping or misted water on leaves and surfaces rather than a standing water bowl.'],
        ['Can I keep two chameleons together?', 'It\'s generally better not to, since chameleons tend to be solitary and can become stressed when housed together.'],
        ['Why does my chameleon change color?', 'Color change is mainly linked to mood, temperature, and communicating with other chameleons, not to camouflage.'],
        ['Do chameleons need UVB and humidity?', 'Yes, they need both strong UVB lighting and a higher humidity level than a desert species, which takes more active upkeep than a single-factor setup.'],
        ['What do chameleons eat?', 'Chameleons are primarily insectivorous, eating feeder insects such as crickets, and many are more responsive to prey that\'s actively moving than to food left sitting in a bowl. Gut-loading or dusting feeder insects with supplements beforehand is a common practice to help round out the diet.'],
    ];
}
