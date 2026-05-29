<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'petzenai_food_calc', function () {
    ob_start(); ?>
<div class="pz-tool" id="tool-food" role="main" aria-label="Pet Food Portion Calculator"
     itemscope itemtype="https://schema.org/SoftwareApplication">
  <meta itemprop="name" content="Pet Food Portion Calculator">
  <meta itemprop="applicationCategory" content="LifestyleApplication">
  <meta itemprop="operatingSystem" content="Web">

  <div class="pz-tool-header">
    <span class="pz-tool-icon" aria-hidden="true">🍽️</span>
    <h1 class="pz-tool-title">Pet Food Portion Calculator</h1>
    <p class="pz-tool-desc">Calculate the perfect daily food portions for your pet based on weight, age, and activity level. Science-based recommendations used by vets.</p>
  </div>

  <div class="pz-tool-body">
    <div class="pz-form-grid">
      <div class="pz-field">
        <label for="food-animal">Pet Type</label>
        <select id="food-animal" aria-label="Select pet type">
          <option value="dog">🐶 Dog</option>
          <option value="cat">🐱 Cat</option>
          <option value="rabbit">🐰 Rabbit</option>
          <option value="bird">🐦 Bird</option>
          <option value="hamster">🐹 Hamster / Guinea Pig</option>
        </select>
      </div>
      <div class="pz-field">
        <label for="food-weight">Pet Weight</label>
        <div class="pz-input-unit">
          <input type="number" id="food-weight" placeholder="e.g. 10" min="0.1" max="200" step="0.1" aria-label="Pet weight">
          <select id="food-unit" aria-label="Weight unit">
            <option value="kg">kg</option>
            <option value="lbs">lbs</option>
          </select>
        </div>
      </div>
      <div class="pz-field">
        <label for="food-age">Life Stage</label>
        <select id="food-age" aria-label="Pet life stage">
          <option value="puppy">Puppy / Kitten (under 1 yr)</option>
          <option value="adult" selected>Adult (1–7 yrs)</option>
          <option value="senior">Senior (7+ yrs)</option>
        </select>
      </div>
      <div class="pz-field">
        <label for="food-activity">Activity Level</label>
        <select id="food-activity" aria-label="Activity level">
          <option value="low">🛋️ Low (mostly indoors)</option>
          <option value="moderate" selected>🚶 Moderate (daily walks)</option>
          <option value="high">🏃 High (very active)</option>
          <option value="working">💪 Working / Sport</option>
        </select>
      </div>
      <div class="pz-field">
        <label for="food-condition">Body Condition</label>
        <select id="food-condition" aria-label="Body condition">
          <option value="underweight">Underweight</option>
          <option value="ideal" selected>Ideal Weight</option>
          <option value="overweight">Overweight</option>
        </select>
      </div>
      <div class="pz-field">
        <label for="food-type">Food Type</label>
        <select id="food-type" aria-label="Food type">
          <option value="dry">Dry Kibble</option>
          <option value="wet">Wet / Canned Food</option>
          <option value="raw">Raw Food</option>
          <option value="mixed">Mixed (50 / 50)</option>
        </select>
      </div>
    </div>
    <button class="pz-btn-calculate" data-original="🍽️ Calculate Daily Portion" onclick="pzFoodCalc()">
      🍽️ Calculate Daily Portion
    </button>
  </div>

  <div class="pz-result" id="food-result" aria-live="polite" hidden>
    <div class="pz-result-header">
      <span class="pz-result-icon">✅</span>
      <h2>Your Pet's Daily Food Plan</h2>
    </div>
    <div class="pz-result-cards">
      <div class="pz-result-card pz-result-card--primary">
        <div class="pz-result-label">Daily Food Amount</div>
        <div class="pz-result-value" id="food-daily-grams">—</div>
        <div class="pz-result-sub"  id="food-daily-cups">—</div>
      </div>
      <div class="pz-result-card">
        <div class="pz-result-label">Daily Calories</div>
        <div class="pz-result-value" id="food-daily-cal">—</div>
      </div>
      <div class="pz-result-card">
        <div class="pz-result-label">Meals Per Day</div>
        <div class="pz-result-value" id="food-meals">—</div>
      </div>
      <div class="pz-result-card">
        <div class="pz-result-label">Per Meal</div>
        <div class="pz-result-value" id="food-per-meal">—</div>
      </div>
    </div>
    <div class="pz-result-tip" id="food-tip"></div>
    <div class="pz-disclaimer">⚠️ These are guidelines. Always consult your vet for specific dietary needs.</div>
  </div>
</div>
<?php return ob_get_clean();
} );
