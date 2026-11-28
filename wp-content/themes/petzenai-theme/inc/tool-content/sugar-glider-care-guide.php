<?php
/**
 * Tool-specific content for: Sugar Glider Care Guide: Diet & Bonding (registry key: sugar_glider_care_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 * New small-pets cluster, distinct from every other animal in this cluster: a marsupial, not a rodent,
 * with a gliding membrane for moving between heights, strongly social and prone to stress when kept
 * alone, nocturnal, and needs a more specialized, research-intensive diet than a typical small pet.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_sugar_glider_care_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Sugar gliders are marsupials — pouched mammals with a reproductive biology that's genuinely different from the rodents elsewhere in this cluster, not just a different species of the same type of animal. A gliding membrane lets them launch and glide between heights instead of just climbing or jumping. Where many small pets tolerate solitude, sugar gliders tend to decline without company; group living is closer to a requirement than a preference for them. They're most active after dark, and feeding them well takes more research into a varied, carefully balanced diet than a bag of pellets alone would cover.</div>
<?php }

function pz_what_is_sugar_glider_care_guide() {
    ob_start(); ?>
    <p>Sugar gliders are small marsupials, not rodents, which sets them apart taxonomically from every other small pet in this cluster, including a <a href="/tools/hamster-care-guide/">hamster</a> or <a href="/tools/chinchilla-care-guide/">chinchilla</a>.</p>
    <p>This guide covers their gliding membrane, the strong social needs that make solitary housing a welfare risk, their nocturnal schedule, and the more specialized diet they require compared to a typical small pet.</p>
    <?php return ob_get_clean();
}

function pz_why_important_sugar_glider_care_guide() {
    ob_start(); ?>
    <p>Caring for a sugar glider well means working with, not against, a biology built for gliding between trees in a tight-knit group, which is a very different starting point than the rodents elsewhere in this cluster.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🦘</span>
        <div><strong>A marsupial — pouch-raised young, not a rodent</strong><p>Sugar gliders carry and raise their young in a pouch, the same reproductive strategy as a kangaroo, which is a fundamentally different biology from the placental rodents like hamsters, gerbils, and mice they're often shelved next to.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🪂</span>
        <div><strong>A gliding membrane for moving between heights</strong><p>Sugar gliders have a specialized membrane that lets them glide from height to height, a distinct physical feature not shared by any other animal in this cluster.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">👥</span>
        <div><strong>Built for colony life, not solo living</strong><p>In the wild, sugar gliders live in tight colonies and groom, sleep, and forage together; a single pet glider isolated from others can spiral into real distress, which is the opposite problem from a naturally solitary small pet like a hedgehog that actually needs to be kept alone.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🥗</span>
        <div><strong>A more specialized diet than a typical small pet</strong><p>A sugar glider's nutritional needs are more complex and research-intensive than a simple pellet-based diet, so their feeding plan deserves more dedicated attention than most small pets need.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_sugar_glider_care_guide() {
    return [
        ['title' => 'Plan to keep more than one sugar glider', 'desc' => 'Because sugar gliders are highly social and can become stressed or depressed if kept alone, companionship is a genuine welfare need rather than an optional nice-to-have.'],
        ['title' => 'Set up a tall enclosure with climbing and gliding room', 'desc' => 'Their gliding membrane is built for moving between heights, so vertical space and safe gliding distance matter more than floor space alone.'],
        ['title' => 'Research their diet thoroughly before bringing one home', 'desc' => 'A sugar glider\'s nutritional needs are more specialized and research-intensive than a typical small pet\'s pellet-based diet, so this deserves dedicated attention rather than assuming a simple commercial mix is enough.'],
        ['title' => 'Save the climbing and gliding sessions for after dark', 'desc' => 'A sugar glider\'s gliding and foraging instincts switch on once the sun goes down, so evening is when it\'s actually worth setting up branches and launch points for them to use.'],
        ['title' => 'Introduce new gliders to an existing group carefully', 'desc' => 'Scent-swap bedding between the newcomer and the resident group for a few days before any face-to-face contact, since even a social species can turn aggressive toward an unfamiliar glider introduced too fast.'],
        ['title' => 'Monitor for signs of stress if housing changes', 'desc' => 'Because isolation is a genuine risk factor for sugar gliders, watch closely any time group composition changes, such as after a companion is lost.'],
    ];
}

function pz_tips_sugar_glider_care_guide() {
    return [
        ['Don\'t keep a single sugar glider by itself long-term', 'They\'re highly social, and isolation can lead to real stress or depression rather than just mild unhappiness.'],
        ['Give enough vertical space for gliding, not just climbing', 'Their gliding membrane is a distinct physical feature, so height and open gliding paths matter more than they would for a floor-focused small pet.'],
        ['Take the diet seriously before you commit', 'A sugar glider\'s nutritional needs are more specialized and research-intensive than most small pets, so this is worth working out in detail in advance.'],
        ['Expect activity at night, not during the day', 'Sugar gliders are nocturnal, so plan bonding time and enrichment for the evening rather than daytime hours.'],
        ['Remember sugar gliders are marsupials, not rodents', 'Treating their care like a rodent\'s, the way you might for a hamster or gerbil, misses meaningful biological differences.'],
    ];
}

function pz_mistakes_sugar_glider_care_guide() {
    return [
        ['❌ Keeping a single sugar glider alone', 'Sugar gliders are highly social and can become stressed or depressed if kept alone, a stronger welfare concern than simply preferring company.'],
        ['❌ Treating sugar gliders like rodents', 'Sugar gliders are marsupials, not rodents, so care approaches borrowed from a hamster or gerbil don\'t automatically apply.'],
        ['❌ Using a simple pellet-based diet without further research', 'A sugar glider\'s diet is more specialized and research-intensive than a typical small pet\'s, so a basic commercial mix alone likely falls short.'],
        ['❌ Setting up a floor-focused enclosure without vertical gliding room', 'Their gliding membrane is built for moving between heights, so a flat setup doesn\'t match their natural movement.'],
        ['❌ Scheduling play sessions in the daytime', 'A sugar glider that\'s curled up and still during daylight hours isn\'t sick or unhappy — it\'s simply saving its energy for gliding and foraging after dark.'],
    ];
}

function pz_faq_sugar_glider_care_guide() {
    return [
        ['Are sugar gliders rodents?', 'No. They\'re marsupials, meaning females carry and nurse their young in a pouch, the same reproductive setup as a kangaroo rather than anything seen in a hamster, gerbil, or mouse.'],
        ['Can a sugar glider be kept alone?', 'It\'s best avoided. Their colony instincts run deep, and a lone glider can genuinely decline in mood and health without others of its kind around.'],
        ['What is the gliding membrane sugar gliders are known for?', 'A specialized membrane that lets them glide between heights, a distinct physical feature not found in the other small pets in this cluster.'],
        ['Is a sugar glider\'s diet complicated?', 'Yes, relatively. Their nutritional needs are more specialized and research-intensive than a typical small pet\'s simple pellet-based diet, so it\'s worth researching thoroughly before getting one.'],
        ['When are sugar gliders awake and active?', 'After dark. They sleep through most of the day and wake around dusk, so the best window for bonding, climbing, and gliding time is in the evening and overnight.'],
    ];
}
