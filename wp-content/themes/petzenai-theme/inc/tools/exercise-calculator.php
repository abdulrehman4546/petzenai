<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'petzenai_exercise_calc', function () {
    ob_start(); ?>
<div class="pz-tool" id="tool-exercise" role="main" aria-label="Pet Exercise Calculator"
     itemscope itemtype="https://schema.org/SoftwareApplication">
  <meta itemprop="name" content="Pet Exercise Calculator">
  <meta itemprop="applicationCategory" content="HealthApplication">

  <div class="pz-tool-header">
    <span class="pz-tool-icon" aria-hidden="true">🏃</span>
    <h1 class="pz-tool-title">Pet Exercise Calculator</h1>
    <p class="pz-tool-desc">Find out exactly how much daily exercise your pet needs based on breed energy level, age, weight, and health status.</p>
  </div>

  <div class="pz-tool-body">
    <div class="pz-form-grid">
      <div class="pz-field">
        <label for="ex-animal">Pet Type</label>
        <select id="ex-animal" onchange="pzExUpdateBreed()" aria-label="Pet type">
          <option value="dog">🐶 Dog</option>
          <option value="cat">🐱 Cat</option>
          <option value="rabbit">🐰 Rabbit</option>
          <option value="bird">🐦 Bird</option>
        </select>
      </div>
      <div class="pz-field" id="ex-breed-field">
        <label for="ex-breed">Dog Energy Level</label>
        <select id="ex-breed" aria-label="Energy level">
          <option value="low">🐌 Low (Basset, Bulldog)</option>
          <option value="medium" selected>🐕 Medium (Labrador, Poodle)</option>
          <option value="high">🚀 High (Husky, Border Collie)</option>
          <option value="very-high">⚡ Very High (Working Dogs)</option>
        </select>
      </div>
      <div class="pz-field">
        <label for="ex-age">Age / Life Stage</label>
        <select id="ex-age" aria-label="Life stage">
          <option value="puppy">🐣 Puppy / Young (under 1 yr)</option>
          <option value="adult" selected>🐾 Adult (1–7 yrs)</option>
          <option value="senior">👴 Senior (7+ yrs)</option>
        </select>
      </div>
      <div class="pz-field">
        <label for="ex-weight">Weight (kg)</label>
        <input type="number" id="ex-weight" placeholder="e.g. 15" min="0.1" max="100" step="0.5" aria-label="Pet weight in kg">
      </div>
      <div class="pz-field">
        <label for="ex-health">Health Status</label>
        <select id="ex-health" aria-label="Health status">
          <option value="healthy" selected>✅ Healthy</option>
          <option value="overweight">⚖️ Overweight</option>
          <option value="recovering">🩹 Recovering / Injured</option>
          <option value="senior-health">💊 Senior with Health Issues</option>
        </select>
      </div>
    </div>
    <button class="pz-btn-calculate" data-original="🏃 Calculate Exercise Plan" onclick="pzExerciseCalc()">
      🏃 Calculate Exercise Plan
    </button>
  </div>

  <div class="pz-result" id="exercise-result" aria-live="polite" hidden>
    <div class="pz-result-header">
      <span class="pz-result-icon">🏆</span>
      <h2>Your Pet's Daily Exercise Plan</h2>
    </div>
    <div class="pz-result-cards">
      <div class="pz-result-card pz-result-card--primary">
        <div class="pz-result-label">Total Daily Exercise</div>
        <div class="pz-result-value" id="ex-minutes">—</div>
      </div>
      <div class="pz-result-card">
        <div class="pz-result-label">Walk Sessions</div>
        <div class="pz-result-value" id="ex-walks">—</div>
      </div>
      <div class="pz-result-card">
        <div class="pz-result-label">Intensity Level</div>
        <div class="pz-result-value" id="ex-intensity">—</div>
      </div>
      <div class="pz-result-card">
        <div class="pz-result-label">Play Time</div>
        <div class="pz-result-value" id="ex-play">—</div>
      </div>
    </div>
    <div id="ex-activities"></div>
    <div class="pz-result-tip" id="ex-tip"></div>
    <div class="pz-disclaimer">⚠️ Consult your vet before starting a new exercise plan for senior or recovering pets.</div>
  </div>
</div>
<?php return ob_get_clean();
} );
