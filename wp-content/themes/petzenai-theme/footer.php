<!-- Footer -->
<footer class="footer" role="contentinfo">
  <div class="container">
    <div class="footer-grid">
      <div>
        <div class="footer-brand-logo">
          <span class="logo-icon">🐾</span> PetZen<span>AI</span>
        </div>
        <p class="footer-brand-desc">Science-based diet planning and AI-powered tools for healthier, happier pets across America. Your trusted partner in pet wellness.</p>
        <div class="footer-socials">
          <a href="#" class="footer-social" aria-label="Facebook">📘</a>
          <a href="#" class="footer-social" aria-label="Instagram">📸</a>
          <a href="#" class="footer-social" aria-label="Twitter">🐦</a>
          <a href="#" class="footer-social" aria-label="YouTube">▶️</a>
        </div>
      </div>
      <div>
        <h4 class="footer-col-title">Quick Links</h4>
        <ul class="footer-links">
          <li><a href="<?php echo home_url('/'); ?>">Home</a></li>
          <li><a href="<?php echo home_url('/about-us/'); ?>">About Us</a></li>
          <li><a href="<?php echo home_url('/blog/'); ?>">Blog</a></li>
          <li><a href="<?php echo home_url('/contact-us/'); ?>">Contact</a></li>
        </ul>
      </div>
      <div>
        <h4 class="footer-col-title">Our Tools</h4>
        <ul class="footer-links">
          <li><a href="<?php echo home_url('/pet-food-portion-calculator/'); ?>">Food Calculator</a></li>
          <li><a href="<?php echo home_url('/pet-age-calculator/'); ?>">Age Calculator</a></li>
          <li><a href="<?php echo home_url('/pet-vaccination-schedule/'); ?>">Vaccine Tracker</a></li>
          <li><a href="<?php echo home_url('/ai-pet-name-generator/'); ?>">Name Generator</a></li>
          <li><a href="<?php echo home_url('/pet-exercise-calculator/'); ?>">Exercise Planner</a></li>
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
