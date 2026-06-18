<?php
/**
 * 404 Not Found Template — PetZenAI
 */
get_header();
?>

<style>
.pz-404-section {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #0D1117;
    padding: 80px 20px;
    text-align: center;
}
.pz-404-inner {
    max-width: 600px;
    margin: 0 auto;
}
.pz-404-code {
    font-size: clamp(80px, 15vw, 160px);
    font-weight: 900;
    line-height: 1;
    background: linear-gradient(135deg, #FF6B1A, #ff9a5c);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 8px;
}
.pz-404-paw {
    font-size: 48px;
    margin-bottom: 24px;
    display: block;
}
.pz-404-title {
    font-size: clamp(22px, 4vw, 36px);
    font-weight: 900;
    color: #ffffff;
    margin-bottom: 16px;
}
.pz-404-desc {
    font-size: 16px;
    color: rgba(255, 255, 255, 0.6);
    line-height: 1.7;
    margin-bottom: 40px;
}
.pz-404-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    justify-content: center;
    margin-bottom: 48px;
}
.pz-404-links {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    justify-content: center;
}
.pz-404-link {
    color: rgba(255, 255, 255, 0.5);
    font-size: 14px;
    font-weight: 600;
    padding: 8px 18px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 50px;
    transition: all 0.2s;
    text-decoration: none;
}
.pz-404-link:hover {
    color: #FF6B1A;
    border-color: #FF6B1A;
}
</style>

<section class="pz-404-section" aria-label="Page Not Found">
    <div class="pz-404-inner">
        <div class="pz-404-code" aria-hidden="true">404</div>
        <span class="pz-404-paw" aria-hidden="true">🐾</span>
        <h1 class="pz-404-title">Page Not Found</h1>
        <p class="pz-404-desc">
            Oops! Looks like this page wandered off like a curious pet.<br>
            Don't worry — we have plenty of great tools and articles waiting for you.
        </p>
        <div class="pz-404-actions">
            <a href="<?php echo home_url('/'); ?>" class="btn-primary">
                Go Back Home →
            </a>
        </div>
        <div class="pz-404-links">
            <a href="<?php echo home_url('/tools/'); ?>" class="pz-404-link">🛠️ Browse Tools</a>
            <a href="<?php echo home_url('/blog/'); ?>" class="pz-404-link">📝 Read Blog</a>
            <a href="<?php echo home_url('/about/'); ?>" class="pz-404-link">👋 About Us</a>
            <a href="<?php echo home_url('/contact/'); ?>" class="pz-404-link">📧 Contact</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
