<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'petzenai_pet_quiz', function () {
    ob_start(); ?>
<div class="pz-tool pz-tool--quiz" id="tool-quiz" role="main" aria-label="What Pet Should I Get Quiz"
     itemscope itemtype="https://schema.org/SoftwareApplication">
  <meta itemprop="name" content="What Pet Should I Get Quiz">
  <meta itemprop="applicationCategory" content="LifestyleApplication">

  <div class="pz-tool-header">
    <span class="pz-tool-icon" aria-hidden="true">❓</span>
    <h1 class="pz-tool-title">What Pet Should I Get?</h1>
    <p class="pz-tool-desc">Answer 10 quick questions about your lifestyle and our AI will recommend the perfect pet companion for you.</p>
  </div>

  <div class="pz-quiz-progress" id="quiz-progress" aria-hidden="true">
    <div class="pz-quiz-progress-bar" id="quiz-progress-bar" style="width:0%"></div>
  </div>
  <div class="pz-quiz-step-label" id="quiz-step-label" aria-live="polite">Question 1 of 10</div>

  <div class="pz-quiz-body" id="quiz-body">
    <!-- Questions rendered by tools.js -->
  </div>

  <div class="pz-result pz-quiz-result" id="quiz-result" aria-live="polite" hidden>
    <div class="pz-result-header">
      <span class="pz-result-icon" id="quiz-pet-icon">🐾</span>
      <h2>Your Perfect Pet Match!</h2>
    </div>
    <div class="pz-quiz-match">
      <div class="pz-quiz-match-pet"   id="quiz-match-pet">—</div>
      <div class="pz-quiz-match-score" id="quiz-match-score"></div>
    </div>
    <p class="pz-quiz-match-desc" id="quiz-match-desc"></p>
    <div class="pz-quiz-runner-ups"    id="quiz-runner-ups"></div>
    <div style="margin-top:24px">
      <button class="pz-btn-secondary" onclick="pzQuizReset()">🔄 Retake Quiz</button>
    </div>
  </div>
</div>
<?php return ob_get_clean();
} );
