<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function petzenai_customizer( $wp_customize ) {

    /* ── Helper: add text control ── */
    $text = function( $id, $label, $section, $default = '', $desc = '' ) use ( $wp_customize ) {
        $wp_customize->add_setting( $id, [ 'default' => $default, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ] );
        $wp_customize->add_control( $id, [ 'label' => $label, 'description' => $desc, 'section' => $section, 'type' => 'text' ] );
    };
    $textarea = function( $id, $label, $section, $default = '' ) use ( $wp_customize ) {
        $wp_customize->add_setting( $id, [ 'default' => $default, 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh' ] );
        $wp_customize->add_control( $id, [ 'label' => $label, 'section' => $section, 'type' => 'textarea' ] );
    };
    $url_ctrl = function( $id, $label, $section, $default = '' ) use ( $wp_customize ) {
        $wp_customize->add_setting( $id, [ 'default' => $default, 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh' ] );
        $wp_customize->add_control( $id, [ 'label' => $label, 'section' => $section, 'type' => 'url' ] );
    };
    $color = function( $id, $label, $section, $default ) use ( $wp_customize ) {
        $wp_customize->add_setting( $id, [ 'default' => $default, 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh' ] );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, [ 'label' => $label, 'section' => $section ] ) );
    };
    $image = function( $id, $label, $section ) use ( $wp_customize ) {
        $wp_customize->add_setting( $id, [ 'default' => '', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh' ] );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $id, [ 'label' => $label, 'section' => $section ] ) );
    };

    /* ================================================================
       PANEL: PetZenAI Settings
       ================================================================ */
    $wp_customize->add_panel( 'petzenai_panel', [
        'title'    => '🐾 PetZenAI Settings',
        'priority' => 10,
    ]);

    /* ── SECTION: Brand & Colors ── */
    $wp_customize->add_section( 'petzenai_brand', [
        'title' => '🎨 Brand & Colors',
        'panel' => 'petzenai_panel',
    ]);
    $color( 'petzenai_primary_color', 'Primary Color (Orange)',  'petzenai_brand', '#FF6B1A' );
    $color( 'petzenai_dark_color',    'Dark Background Color',   'petzenai_brand', '#0D0D0D' );
    $color( 'petzenai_text_color',    'Body Text Color',         'petzenai_brand', '#333333' );
    $image( 'petzenai_logo_image',    'Upload Logo Image',       'petzenai_brand' );
    $text(  'petzenai_logo_text',     'Logo Text',               'petzenai_brand', 'PetZenAI' );
    $text(  'petzenai_tagline',       'Site Tagline',            'petzenai_brand', 'Science-Based Pet Care' );

    /* ── SECTION: Hero Section ── */
    $wp_customize->add_section( 'petzenai_hero', [
        'title' => '🦸 Hero Section',
        'panel' => 'petzenai_panel',
    ]);
    $text(    'petzenai_hero_badge',       'Badge Text (top)',       'petzenai_hero', '#1 AI Pet Care Platform in America' );
    $text(    'petzenai_hero_title_1',     'Heading Line 1',         'petzenai_hero', 'Science-Based' );
    $text(    'petzenai_hero_title_2',     'Heading Line 2 (colored)','petzenai_hero', 'Pet Nutrition' );
    $text(    'petzenai_hero_title_3',     'Heading Line 3',         'petzenai_hero', 'Tools & Planners' );
    $textarea('petzenai_hero_desc',        'Hero Description',       'petzenai_hero', 'Empower your pet\'s health with free, vet-formulated calculators, diet planners, and vaccination trackers — trusted by over 50,000 pet owners across the USA.' );
    $text(    'petzenai_hero_btn1_text',   'Button 1 Text',          'petzenai_hero', 'Explore Tools' );
    $url_ctrl('petzenai_hero_btn1_link',   'Button 1 Link',          'petzenai_hero', '' );
    $text(    'petzenai_hero_btn2_text',   'Button 2 Text',          'petzenai_hero', '🍽️ Food Calculator' );
    $url_ctrl('petzenai_hero_btn2_link',   'Button 2 Link',          'petzenai_hero', '' );
    $image(   'petzenai_hero_image',       'Hero Image',             'petzenai_hero' );
    $text(    'petzenai_hero_stat1_num',   'Stat 1 Number',          'petzenai_hero', '50000' );
    $text(    'petzenai_hero_stat1_label', 'Stat 1 Label',           'petzenai_hero', 'Pet Owners' );
    $text(    'petzenai_hero_stat2_num',   'Stat 2 Number',          'petzenai_hero', '6' );
    $text(    'petzenai_hero_stat2_label', 'Stat 2 Label',           'petzenai_hero', 'Free Tools' );
    $text(    'petzenai_hero_stat3_num',   'Stat 3 Number',          'petzenai_hero', '10000' );
    $text(    'petzenai_hero_stat3_label', 'Stat 3 Label',           'petzenai_hero', 'Pet Names' );

    /* ── SECTION: Tools Section ── */
    $wp_customize->add_section( 'petzenai_tools_section', [
        'title' => '🛠️ Tools Section',
        'panel' => 'petzenai_panel',
    ]);
    $text(    'petzenai_tools_tag',   'Section Tag',        'petzenai_tools_section', 'Free Tools' );
    $text(    'petzenai_tools_title', 'Section Title',      'petzenai_tools_section', '6 Powerful Pet Care Tools' );
    $textarea('petzenai_tools_desc',  'Section Description','petzenai_tools_section', 'Everything your pet needs — from daily nutrition to lifetime health tracking — built on veterinary science and evidence-based research.' );

    /* ── SECTION: Why Section ── */
    $wp_customize->add_section( 'petzenai_why', [
        'title' => '✅ Why PetZenAI Section',
        'panel' => 'petzenai_panel',
    ]);
    $text(    'petzenai_why_title',   'Section Title',   'petzenai_why', 'Your Pet Deserves Science, Not Guesswork' );
    $image(   'petzenai_why_image',   'Section Image',   'petzenai_why' );
    $text(    'petzenai_why_badge',   'Badge Text',      'petzenai_why', '🏆 Vet-Approved Tools' );
    $text(    'petzenai_why_feat1_title', 'Feature 1 Title', 'petzenai_why', 'Veterinary Science Backed' );
    $textarea('petzenai_why_feat1_desc',  'Feature 1 Desc',  'petzenai_why', 'All our tools are built on peer-reviewed nutritional research and veterinary guidelines.' );
    $text(    'petzenai_why_feat2_title', 'Feature 2 Title', 'petzenai_why', 'Science-Based Accuracy' );
    $textarea('petzenai_why_feat2_desc',  'Feature 2 Desc',  'petzenai_why', 'Our calculators adapt to your pet\'s breed, weight, age, and activity level for personalized, evidence-based recommendations.' );
    $text(    'petzenai_why_feat3_title', 'Feature 3 Title', 'petzenai_why', '100% Free Forever' );
    $textarea('petzenai_why_feat3_desc',  'Feature 3 Desc',  'petzenai_why', 'No subscriptions, no hidden fees. Every tool on PetZenAI is completely free for all pet owners.' );
    $text(    'petzenai_why_feat4_title', 'Feature 4 Title', 'petzenai_why', 'Instant Results' );
    $textarea('petzenai_why_feat4_desc',  'Feature 4 Desc',  'petzenai_why', 'Get science-backed answers in seconds. No sign-up required — just enter your pet\'s details and go.' );

    /* ── SECTION: CTA Section ── */
    $wp_customize->add_section( 'petzenai_cta', [
        'title' => '📣 CTA Section',
        'panel' => 'petzenai_panel',
    ]);
    $text(    'petzenai_cta_title',    'CTA Title',       'petzenai_cta', "Your Pet's Health Starts Here 🐾" );
    $textarea('petzenai_cta_desc',     'CTA Description', 'petzenai_cta', "Join 50,000+ pet owners using PetZenAI's free science-based tools." );
    $text(    'petzenai_cta_btn_text', 'Button Text',     'petzenai_cta', '🚀 Get Started — It\'s Free' );
    $url_ctrl('petzenai_cta_btn_link', 'Button Link',     'petzenai_cta', '' );

    /* ── SECTION: Footer ── */
    $wp_customize->add_section( 'petzenai_footer', [
        'title' => '🦶 Footer',
        'panel' => 'petzenai_panel',
    ]);
    $textarea('petzenai_footer_about',   'About Text',     'petzenai_footer', 'Science-based diet planning and vet-formulated tools for healthier, happier pets across America.' );
    $text(    'petzenai_contact_email',  'Contact Email',  'petzenai_footer', 'support@petzenai.com' );
    $text(    'petzenai_contact_hours1', 'Hours Line 1',   'petzenai_footer', 'Mon–Fri: 9AM–8PM EST' );
    $text(    'petzenai_contact_hours2', 'Hours Line 2',   'petzenai_footer', 'Sat–Sun: 10AM–4PM EST' );
    $text(    'petzenai_footer_copy',    'Copyright Text', 'petzenai_footer', '© 2025 PetZenAI. All rights reserved.' );

    /* ── SECTION: Social Links ── */
    $wp_customize->add_section( 'petzenai_social', [
        'title' => '📱 Social Links',
        'panel' => 'petzenai_panel',
    ]);
    $url_ctrl('petzenai_social_facebook',  'Facebook URL',  'petzenai_social', '' );
    $url_ctrl('petzenai_social_instagram', 'Instagram URL', 'petzenai_social', '' );
    $url_ctrl('petzenai_social_twitter',   'Twitter/X URL', 'petzenai_social', '' );
    $url_ctrl('petzenai_social_youtube',   'YouTube URL',   'petzenai_social', '' );
    $url_ctrl('petzenai_social_tiktok',    'TikTok URL',    'petzenai_social', '' );

    /* ── SECTION: SEO Settings ── */
    $wp_customize->add_section( 'petzenai_seo', [
        'title' => '🔍 SEO Settings',
        'panel' => 'petzenai_panel',
    ]);
    $text(    'petzenai_hero_seo_title',   'Homepage SEO Title',       'petzenai_seo', 'PetZenAI — Science-Based Pet Care Tools' );
    $textarea('petzenai_seo_description',  'Meta Description',         'petzenai_seo', 'Free vet-formulated pet care tools — food calculators, vaccine trackers, age calculators & more. Science-based diet planning for healthier pets.' );
    $textarea('petzenai_seo_keywords',     'Meta Keywords',            'petzenai_seo', 'pet food calculator, pet age calculator, dog nutrition, cat diet, pet vaccination schedule, AI pet tools' );
    $image(   'petzenai_og_image',         'OG/Social Share Image',    'petzenai_seo' );
    $text(    'petzenai_google_analytics', 'Google Analytics ID (G-)', 'petzenai_seo', '', 'e.g. G-XXXXXXXXXX' );

    /* ── SECTION: AdSense Settings ── */
    $wp_customize->add_section( 'petzenai_adsense', [
        'title'       => '💰 Google AdSense',
        'panel'       => 'petzenai_panel',
        'description' => 'AdSense Publisher ID aur Ad Unit IDs yahan paste karein. AdSense approve hone ke baad fill karein.',
    ]);
    $text( 'petzenai_adsense_publisher_id',  'Publisher ID',                'petzenai_adsense', '', 'e.g. pub-1234567890123456' );
    $text( 'petzenai_adsense_ad_blog_top',   'Blog Post — Top Ad Unit ID',  'petzenai_adsense', '', 'e.g. 1234567890' );
    $text( 'petzenai_adsense_ad_blog_mid',   'Blog Post — Middle Ad Unit ID','petzenai_adsense', '', 'e.g. 1234567890' );
    $text( 'petzenai_adsense_ad_sidebar',    'Sidebar Ad Unit ID',          'petzenai_adsense', '', 'e.g. 1234567890' );
    $text( 'petzenai_adsense_ad_tools',      'Tools Page Ad Unit ID',       'petzenai_adsense', '', 'e.g. 1234567890' );
}
add_action( 'customize_register', 'petzenai_customizer' );

/* ── Google Analytics output ── */
add_action('wp_head', function() {
    $ga = get_theme_mod('petzenai_google_analytics','');
    if ( $ga ) {
        echo "<script async src='https://www.googletagmanager.com/gtag/js?id=" . esc_attr($ga) . "'></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','" . esc_attr($ga) . "');</script>\n";
    }
}, 99 );
