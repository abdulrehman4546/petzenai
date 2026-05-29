<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'petzenai_name_gen', function () {
    ob_start(); ?>
<div class="pz-tool" id="tool-names" role="main" aria-label="AI Pet Name Generator"
     itemscope itemtype="https://schema.org/SoftwareApplication">
  <meta itemprop="name" content="AI Pet Name Generator">
  <meta itemprop="applicationCategory" content="LifestyleApplication">

  <div class="pz-tool-header">
    <span class="pz-tool-icon" aria-hidden="true">✨</span>
    <h1 class="pz-tool-title">AI Pet Name Generator</h1>
    <p class="pz-tool-desc">Find the perfect name for your new companion. 10,000+ unique names filtered by pet type, gender, and personality — powered by AI.</p>
  </div>

  <div class="pz-tool-body">
    <div class="pz-form-grid">
      <div class="pz-field">
        <label for="name-animal">Pet Type</label>
        <select id="name-animal" aria-label="Pet type">
          <option value="dog">🐶 Dog</option>
          <option value="cat">🐱 Cat</option>
          <option value="rabbit">🐰 Rabbit</option>
          <option value="bird">🐦 Bird</option>
          <option value="hamster">🐹 Hamster</option>
          <option value="fish">🐠 Fish</option>
        </select>
      </div>
      <div class="pz-field">
        <label for="name-gender">Gender</label>
        <select id="name-gender" aria-label="Pet gender">
          <option value="any">🐾 Any</option>
          <option value="male">♂️ Male</option>
          <option value="female">♀️ Female</option>
        </select>
      </div>
      <div class="pz-field">
        <label for="name-personality">Personality / Vibe</label>
        <select id="name-personality" aria-label="Personality">
          <option value="cute">🥰 Cute &amp; Sweet</option>
          <option value="fierce">🦁 Bold &amp; Fierce</option>
          <option value="funny">😂 Funny &amp; Quirky</option>
          <option value="elegant">✨ Elegant &amp; Royal</option>
          <option value="nature">🌿 Nature-Inspired</option>
          <option value="food">🍕 Food-Themed</option>
          <option value="mythical">🧙 Mythical &amp; Fantasy</option>
        </select>
      </div>
      <div class="pz-field">
        <label for="name-letter">Starts With Letter <small>(optional)</small></label>
        <input type="text" id="name-letter" placeholder="e.g. M" maxlength="1" aria-label="Starting letter" style="text-transform:uppercase">
      </div>
      <div class="pz-field">
        <label for="name-count">How Many Names?</label>
        <select id="name-count" aria-label="Number of names">
          <option value="10">10 names</option>
          <option value="20" selected>20 names</option>
          <option value="50">50 names</option>
        </select>
      </div>
    </div>
    <button class="pz-btn-calculate" data-original="✨ Generate Names" onclick="pzNameGen()">
      ✨ Generate Names
    </button>
  </div>

  <div class="pz-result" id="names-result" aria-live="polite" hidden>
    <div class="pz-result-header">
      <span class="pz-result-icon">🌟</span>
      <h2 id="names-result-title">Generated Names</h2>
    </div>
    <div class="pz-names-grid" id="names-grid" role="list" aria-label="Generated pet names"></div>
    <div style="margin-top:20px">
      <button class="pz-btn-secondary" onclick="pzNameGen()">🔄 Generate More Names</button>
    </div>
  </div>
</div>
<?php return ob_get_clean();
} );
