<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'petzenai_vaccine_tracker', function () {
    ob_start(); ?>
<div class="pz-tool" id="tool-vaccine" role="main" aria-label="Pet Vaccination Schedule Tracker"
     itemscope itemtype="https://schema.org/SoftwareApplication">
  <meta itemprop="name" content="Pet Vaccination Schedule Tracker">
  <meta itemprop="applicationCategory" content="HealthApplication">

  <div class="pz-tool-header">
    <span class="pz-tool-icon" aria-hidden="true">💉</span>
    <h1 class="pz-tool-title">Pet Vaccination Schedule Tracker</h1>
    <p class="pz-tool-desc">Get a complete vet-recommended vaccination schedule for your dog or cat. See overdue, upcoming, and completed vaccines — all in one place.</p>
  </div>

  <div class="pz-tool-body">
    <div class="pz-form-grid pz-form-grid--2">
      <div class="pz-field">
        <label for="vac-animal">Pet Type</label>
        <select id="vac-animal" aria-label="Pet type">
          <option value="dog">🐶 Dog</option>
          <option value="cat">🐱 Cat</option>
        </select>
      </div>
      <div class="pz-field">
        <label for="vac-birthdate">Pet's Date of Birth</label>
        <input type="date" id="vac-birthdate" aria-label="Pet birth date" max="<?php echo esc_attr( date('Y-m-d') ); ?>">
      </div>
      <div class="pz-field">
        <label for="vac-lifestyle">Pet Lifestyle</label>
        <select id="vac-lifestyle" aria-label="Lifestyle">
          <option value="indoor">🏠 Mostly Indoor</option>
          <option value="outdoor" selected>🌿 Indoor / Outdoor</option>
          <option value="outdoor-only">🌳 Mostly Outdoor</option>
        </select>
      </div>
      <div class="pz-field">
        <label for="vac-region">Region</label>
        <select id="vac-region" aria-label="Region">
          <option value="usa">🇺🇸 USA</option>
          <option value="uk">🇬🇧 UK</option>
          <option value="eu">🇪🇺 Europe</option>
          <option value="other">🌍 Other</option>
        </select>
      </div>
    </div>
    <button class="pz-btn-calculate" data-original="💉 Generate Schedule" onclick="pzVaccineTracker()">
      💉 Generate Vaccination Schedule
    </button>
  </div>

  <div class="pz-result" id="vaccine-result" aria-live="polite" hidden>
    <div class="pz-result-header">
      <span class="pz-result-icon">📋</span>
      <h2>Vaccination Schedule</h2>
    </div>
    <div class="pz-vaccine-summary" id="vaccine-summary"></div>
    <div class="pz-vaccine-table-wrap">
      <table class="pz-vaccine-table" id="vaccine-table" role="table" aria-label="Vaccination schedule">
        <thead>
          <tr>
            <th scope="col">Vaccine</th>
            <th scope="col">Due Date</th>
            <th scope="col">Type</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody id="vaccine-tbody"></tbody>
      </table>
    </div>
    <div class="pz-disclaimer">⚠️ Always confirm vaccine schedules with your licensed veterinarian.</div>
  </div>
</div>
<?php return ob_get_clean();
} );
