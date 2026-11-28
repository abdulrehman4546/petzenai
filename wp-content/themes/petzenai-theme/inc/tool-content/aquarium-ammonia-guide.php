<?php
/**
 * Tool-specific content for: Aquarium Ammonia: Causes, Effects & Fix (registry key: aquarium_ammonia_guide).
 * Registry type is 'guide' and uses a dedicated static widget in inc/tool-renderer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_hero_quickanswer_aquarium_ammonia_guide() { ?>
    <div class="pz-hero-quickanswer"><strong>Quick answer:</strong> Ammonia is the first stage of the nitrogen cycle, produced by fish waste and uneaten food, before beneficial bacteria convert it into nitrite and then nitrate. A brand-new, uncycled tank has the highest ammonia risk since it lacks established bacteria, but an established tank can still spike from overfeeding, overstocking, decaying matter, or filter media accidentally rinsed in tap water.</div>
<?php }

function pz_what_is_aquarium_ammonia_guide() {
    ob_start(); ?>
    <p>Ammonia is the first of the three main compounds tracked in the aquarium nitrogen cycle, produced as fish waste and uneaten food break down. Beneficial bacteria then convert that ammonia into nitrite, and a second group of bacteria converts nitrite into the less harmful nitrate — the same two-step conversion process described in a fish tank cycling guide.</p>
    <p>This guide covers why ammonia is the riskiest of the three compounds, why a new or uncycled tank faces the highest exposure, basic testing, and the common causes of an ammonia spike even in a tank that has already finished cycling.</p>
    <?php return ob_get_clean();
}

function pz_why_important_aquarium_ammonia_guide() {
    ob_start(); ?>
    <p>Ammonia is harmful to fish at elevated levels, and understanding where it comes from and what causes it to spike helps you catch a problem before it becomes serious.</p>
    <div class="pz-why-grid">
      <div class="pz-why-item">
        <span class="pz-why-icon">🧪</span>
        <div><strong>Ammonia is the first stage of the nitrogen cycle</strong><p>Beneficial bacteria convert ammonia into nitrite, and then a different group converts nitrite into nitrate — ammonia is the starting point of that process.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">⚠️</span>
        <div><strong>A new or uncycled tank has the highest ammonia risk</strong><p>Without established bacteria to break it down, ammonia from fish waste and uneaten food has nowhere to go and can build up quickly.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🍽️</span>
        <div><strong>Overfeeding and overstocking are common spike causes</strong><p>More waste and uneaten food than the bacteria colony can keep up with is a frequent reason ammonia rises even in an established tank.</p></div>
      </div>
      <div class="pz-why-item">
        <span class="pz-why-icon">🚰</span>
        <div><strong>Rinsing filter media under the tap can trigger a spike</strong><p>Untreated tap water carries disinfectant compounds that can wipe out the bacteria colony doing the ammonia conversion work, so that colony takes a hit right when the tank needs it most.</p></div>
      </div>
    </div>
    <?php return ob_get_clean();
}

function pz_steps_aquarium_ammonia_guide() {
    return [
        ['title' => 'Test ammonia regularly, especially in a new tank', 'desc' => 'A liquid or strip test kit is the standard way to track ammonia rather than guessing based on how the tank looks.'],
        ['title' => 'Expect the highest risk during the uncycled period', 'desc' => 'A tank without established bacteria has no way to break down ammonia yet, which is why new tanks need extra attention.'],
        ['title' => 'Check feeding amounts if ammonia rises in an established tank', 'desc' => 'Overfeeding leaves excess food to decay, adding more ammonia than the bacteria colony may be able to process.'],
        ['title' => 'Reconsider stocking levels if ammonia spikes repeatedly', 'desc' => 'Overstocking produces more waste than a given bacteria colony and filtration setup may be able to keep up with.'],
        ['title' => 'Remove dead fish or decaying plant matter promptly', 'desc' => 'Decomposing matter is an additional ammonia source that\'s easy to overlook once a tank is established.'],
        ['title' => 'Rinse filter media with water pulled from the tank itself', 'desc' => 'Keeping the ammonia-converting bacteria colony intact matters more during a rinse than getting the media spotless.'],
    ];
}

function pz_tips_aquarium_ammonia_guide() {
    return [
        ['Keep test kits on hand before you need them', 'Having ammonia test supplies ready makes it easier to check promptly when something seems off.'],
        ['Be extra cautious with ammonia during the cycling period', 'A new tank\'s lack of established bacteria is the single biggest risk factor for ammonia buildup.'],
        ['Match feeding amounts to what fish actually eat quickly', 'Reducing leftover food lowers one of the most common ongoing ammonia sources.'],
        ['Pull some water from the tank specifically for rinsing media', 'This sidesteps exposing the ammonia-converting bacteria colony to disinfectants present in straight-from-the-tap water.'],
        ['Act promptly on a positive ammonia reading rather than waiting', 'Addressing the cause early is generally easier than letting a spike continue.'],
    ];
}

function pz_mistakes_aquarium_ammonia_guide() {
    return [
        ['❌ Assuming a new tank is safe for fish right away', 'An uncycled tank has no established bacteria to process ammonia, making it the highest-risk period.'],
        ['❌ Rinsing filter media straight from the faucet', 'Disinfectant compounds in untreated tap water can knock out the bacteria colony that converts ammonia on the media.'],
        ['❌ Overfeeding "just in case" fish seem hungry', 'Extra uneaten food is a common and avoidable source of ammonia in an established tank.'],
        ['❌ Adding too many fish at once to an established tank', 'A sudden increase in waste can outpace the existing bacteria colony\'s capacity, triggering a spike.'],
        ['❌ Leaving a dead fish or decaying plant matter in the tank', 'Decomposing matter continues adding ammonia until it\'s removed.'],
    ];
}

function pz_faq_aquarium_ammonia_guide() {
    return [
        ['Why is ammonia dangerous in a fish tank?', 'Ammonia is harmful to fish at elevated levels and is the first compound in the nitrogen cycle, before bacteria convert it into nitrite and then nitrate.'],
        ['Why does a new tank have more ammonia risk?', 'A brand-new, uncycled tank lacks the established bacteria needed to break ammonia down, so it can build up quickly.'],
        ['Can an established tank still get an ammonia spike?', 'Yes — overfeeding, overstocking, decaying matter, or rinsing filter media in tap water can all trigger a spike even after cycling is complete.'],
        ['How do I test for ammonia?', 'A liquid or test-strip ammonia kit is the standard way to check levels rather than relying on how the water looks.'],
        ['Why does rinsing filter media under the tap matter?', 'Straight tap water carries disinfectant compounds that can knock back the bacteria colony on the media, which is the colony actually responsible for converting ammonia.'],
    ];
}
