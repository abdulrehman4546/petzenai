<!-- Footer -->
<footer class="footer" role="contentinfo">
  <div class="container">
    <div class="footer-grid">
      <div>
        <div class="footer-brand-logo">
          <span class="logo-icon">🐾</span> PetZen<span>AI</span>
        </div>
        <p class="footer-brand-desc">Science-based diet planning and vet-formulated tools for healthier, happier pets across America. Your trusted partner in pet wellness.</p>
        <div class="footer-socials">
          <?php $fb = get_theme_mod('petzenai_social_facebook',''); ?>
          <?php if($fb): ?><a href="<?php echo esc_url($fb); ?>" class="footer-social" aria-label="Facebook" target="_blank" rel="noopener">📘</a><?php endif; ?>
          <?php $ig = get_theme_mod('petzenai_social_instagram',''); ?>
          <?php if($ig): ?><a href="<?php echo esc_url($ig); ?>" class="footer-social" aria-label="Instagram" target="_blank" rel="noopener">📸</a><?php endif; ?>
          <?php $tw = get_theme_mod('petzenai_social_twitter',''); ?>
          <?php if($tw): ?><a href="<?php echo esc_url($tw); ?>" class="footer-social" aria-label="Twitter" target="_blank" rel="noopener">🐦</a><?php endif; ?>
          <?php $yt = get_theme_mod('petzenai_social_youtube',''); ?>
          <?php if($yt): ?><a href="<?php echo esc_url($yt); ?>" class="footer-social" aria-label="YouTube" target="_blank" rel="noopener">▶️</a><?php endif; ?>
        </div>
      </div>
      <div>
        <h4 class="footer-col-title">Quick Links</h4>
        <ul class="footer-links">
          <li><a href="<?php echo home_url('/'); ?>">Home</a></li>
          <li><a href="<?php echo home_url('/about/'); ?>">About Us</a></li>
          <li><a href="<?php echo home_url('/blog/'); ?>">Blog</a></li>
          <li><a href="<?php echo home_url('/contact/'); ?>">Contact</a></li>
        </ul>
      </div>
      <div>
        <h4 class="footer-col-title">Our Tools</h4>
        <ul class="footer-links">
          <li><a href="<?php echo home_url('/tools/pet-food-portion-calculator/'); ?>">Food Calculator</a></li>
          <li><a href="<?php echo home_url('/tools/pet-age-calculator/'); ?>">Age Calculator</a></li>
          <li><a href="<?php echo home_url('/tools/pet-vaccination-schedule/'); ?>">Vaccine Tracker</a></li>
          <li><a href="<?php echo home_url('/tools/ai-pet-name-generator/'); ?>">Name Generator</a></li>
          <li><a href="<?php echo home_url('/tools/pet-exercise-calculator/'); ?>">Exercise Planner</a></li>
        </ul>
      </div>
      <div>
        <h4 class="footer-col-title">Contact</h4>
        <ul class="footer-links">
          <li>📧 support@petzenai.com</li>
          <li>🕐 Mon–Fri: 9AM–8PM EST</li>
          <li>🕐 Sat–Sun: 10AM–4PM EST</li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© <?php echo date('Y'); ?> PetZenAI. All rights reserved.</p>
      <div class="footer-bottom-links">
        <a href="<?php echo home_url('/privacy-policy/'); ?>">Privacy Policy</a>
        <a href="<?php echo home_url('/terms-of-service/'); ?>">Terms of Service</a>
        <a href="<?php echo home_url('/sitemap/'); ?>">Sitemap</a>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
