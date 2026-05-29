<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'petzenai_age_calc', function () {
    ob_start(); ?>
<div class="pz-tool" id="tool-age" role="main" aria-label="Pet Age Calculator"
     itemscope itemtype="https://schema.org/SoftwareApplication">
  <meta itemprop="name" content="Pet Age Calculator">
  <meta itemprop="applicationCategory" content="LifestyleApplication">

  <div class="pz-tool-header">
    <span class="pz-tool-icon" aria-hidden="true">🎂</span>
    <h1 class="pz-tool-title">Pet Age Calculator</h1>
    <p class="pz-tool-desc">Convert your pet's age to human years using science-backed, breed-specific formulas — not the outdated "multiply by 7" myth.</p>
  </div>

  <div class="pz-tool-body">
    <div class="pz-form-grid pz-form-grid--2">
      <div class="pz-field">
        <label for="age-animal">Pet Type</label>
        <select id="age-animal" onchange="pzAgeUpdateBreeds()" aria-label="Pet type">
          <option value="dog">🐶 Dog</option>
          <option value="cat">🐱 Cat</option>
          <option value="rabbit">🐰 Rabbit</option>
          <option value="bird">🐦 Bird (Parrot)</option>
          <option value="hamster">🐹 Hamster</option>
        </select>
      </div>
      <div class="pz-field" id="age-breed-wrap">
        <label for="age-breed">Dog Breed Size</label>
        <select id="age-breed" aria-label="Dog breed size">
          <option value="small">Small (under 9 kg)</option>
          <option value="medium">Medium (9–23 kg)</option>
          <option value="large">Large (23–45 kg)</option>
          <option value="giant">Giant (45+ kg)</option>
        </select>
      </div>
      <div class="pz-field">
        <label for="age-years">Age in Years</label>
        <input type="number" id="age-years" placeholder="e.g. 3" min="0" max="30" step="1" aria-label="Pet age years">
      </div>
      <div class="pz-field">
        <label for="age-months">Additional Months</label>
        <input type="number" id="age-months" placeholder="0–11" min="0" max="11" step="1" value="0" aria-label="Additional months">
      </div>
    </div>
    <button class="pz-btn-calculate" data-original="🎂 Convert to Human Age" onclick="pzAgeCalc()">
      🎂 Convert to Human Age
    </button>
  </div>

  <div class="pz-result" id="age-result" aria-live="polite" hidden>
    <div class="pz-result-header">
      <span class="pz-result-icon">🎉</span>
      <h2>Human Age Equivalent</h2>
    </div>
    <div class="pz-age-display">
      <div class="pz-age-big" id="age-human-years">—</div>
      <div class="pz-age-label">Human Years Old</div>
    </div>
    <div class="pz-result-cards">
      <div class="pz-result-card">
        <div class="pz-result-label">Life Stage</div>
        <div class="pz-result-value" id="age-stage">—</div>
      </div>
      <div class="pz-result-card">
        <div class="pz-result-label">Avg Life Expectancy</div>
        <div class="pz-result-value" id="age-expectancy">—</div>
      </div>
    </div>
    <div class="pz-result-tip" id="age-tip"></div>
  </div>
</div>
<?php return ob_get_clean();
} );
