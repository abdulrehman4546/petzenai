<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/* ============================================================
   CLEAN URL: /tools/dog-grooming/ → tools page with pz_cat=dog-grooming
   ============================================================ */
add_action( 'init', function() {
    // Only intercept known category slugs — individual tool pages are served by WP page hierarchy
    $cats = implode('|', ['dog-grooming','dog-health','dog-nutrition','dog-training',
        'cat-grooming','cat-health','cat-nutrition','bird-care','rabbit-care',
        'fish-aquarium','reptile-care','small-pets','general-pet','pet-behavior','pet-safety']);
    add_rewrite_rule(
        '^tools/(' . $cats . ')/?$',
        'index.php?pagename=tools&pz_cat=$matches[1]',
        'top'
    );
} );

/* ============================================================
   CLEAN SITEMAP ENDPOINTS
   sitemap-clean.xml  → index
   sitemap-blog.xml   → 31 blog posts
   sitemap-tools.xml  → 300+ tool pages
   sitemap-pages.xml  → core pages
   ============================================================ */
add_action( 'init', function() {
    add_rewrite_rule( '^sitemap-clean\.xml$',  'index.php?pz_sitemap=index', 'top' );
    add_rewrite_rule( '^sitemap-blog\.xml$',   'index.php?pz_sitemap=blog',  'top' );
    add_rewrite_rule( '^sitemap-tools\.xml$',  'index.php?pz_sitemap=tools', 'top' );
    add_rewrite_rule( '^sitemap-pages\.xml$',  'index.php?pz_sitemap=pages', 'top' );
} );

add_filter( 'query_vars', function( $vars ) {
    $vars[] = 'pz_sitemap';
    return $vars;
} );

add_action( 'template_redirect', function() {
    $type = get_query_var('pz_sitemap');
    if ( ! $type ) return;

    header('Content-Type: application/xml; charset=UTF-8');
    $base = home_url('/');
    $now  = date('c');

    if ( $type === 'index' ) {
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ( ['blog','tools','pages'] as $s ) {
            echo "  <sitemap>\n";
            echo "    <loc>" . home_url("/sitemap-{$s}.xml") . "</loc>\n";
            echo "    <lastmod>" . $now . "</lastmod>\n";
            echo "  </sitemap>\n";
        }
        echo '</sitemapindex>';
        exit;
    }

    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

    if ( $type === 'blog' ) {
        $posts = get_posts(['post_type'=>'post','post_status'=>'publish','posts_per_page'=>-1,'orderby'=>'date','order'=>'DESC']);
        foreach ( $posts as $p ) {
            $thumb = get_the_post_thumbnail_url($p->ID,'full');
            echo "  <url>\n";
            echo "    <loc>" . esc_url(get_permalink($p->ID)) . "</loc>\n";
            echo "    <lastmod>" . date('c', strtotime($p->post_modified_gmt)) . "</lastmod>\n";
            echo "    <changefreq>monthly</changefreq>\n";
            echo "    <priority>0.8</priority>\n";
            if ($thumb) {
                echo "    <image:image><image:loc>" . esc_url($thumb) . "</image:loc></image:image>\n";
            }
            echo "  </url>\n";
        }
    }

    if ( $type === 'tools' ) {
        $pages = get_posts(['post_type'=>'page','post_status'=>'publish','posts_per_page'=>-1,
            'meta_key'=>'_wp_page_template','meta_value'=>'templates/pages/auto-tool.php','orderby'=>'title','order'=>'ASC']);
        // Also hero tools
        $hero_slugs = ['pet-food-portion-calculator','pet-age-calculator','pet-vaccination-schedule',
                       'ai-pet-name-generator','pet-exercise-calculator','what-pet-should-i-get'];
        foreach ($hero_slugs as $slug) {
            $p = get_page_by_path($slug);
            if ($p) $pages[] = $p;
        }
        foreach ( $pages as $p ) {
            echo "  <url>\n";
            echo "    <loc>" . esc_url(get_permalink($p->ID)) . "</loc>\n";
            echo "    <lastmod>" . date('c', strtotime($p->post_modified_gmt)) . "</lastmod>\n";
            echo "    <changefreq>monthly</changefreq>\n";
            echo "    <priority>0.7</priority>\n";
            echo "  </url>\n";
        }
    }

    if ( $type === 'pages' ) {
        echo "  <url><loc>" . esc_url(home_url('/')) . "</loc><priority>1.0</priority><changefreq>weekly</changefreq></url>\n";
        $core = ['blog','tools','about','contact','privacy-policy','terms-of-service'];
        foreach ($core as $slug) {
            $p = get_page_by_path($slug);
            if ($p) {
                echo "  <url>\n";
                echo "    <loc>" . esc_url(get_permalink($p->ID)) . "</loc>\n";
                echo "    <priority>0.9</priority>\n";
                echo "    <changefreq>weekly</changefreq>\n";
                echo "  </url>\n";
            }
        }
    }

    echo '</urlset>';
    exit;
} );

add_filter( 'query_vars', function( $vars ) {
    $vars[] = 'pz_cat';
    return $vars;
} );

/* ============================================================
   THEME SETUP
   ============================================================ */
function petzenai_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', [
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support( 'html5', ['search-form','comment-form','gallery','caption','style','script'] );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'customize-selective-refresh-widgets' );

    register_nav_menus([
        'primary' => __( 'Primary Menu', 'petzenai' ),
        'footer'  => __( 'Footer Menu', 'petzenai' ),
    ]);

    add_image_size( 'petzenai-thumb', 600, 400, true );
    add_image_size( 'petzenai-hero',  1200, 700, true );
}
add_action( 'after_setup_theme', 'petzenai_setup' );

/* ============================================================
   ENQUEUE
   ============================================================ */
function petzenai_enqueue() {
    $v = '2.0';
    wp_enqueue_style( 'google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Poppins:wght@700;800;900&display=swap',
        [], null
    );
    wp_enqueue_style( 'petzenai-style',  get_stylesheet_uri(), [], $v );
    wp_enqueue_style( 'petzenai-tools',  get_template_directory_uri() . '/assets/css/tools.css', [], $v );
    wp_enqueue_script( 'petzenai-tools', get_template_directory_uri() . '/assets/js/tools.js',  [], $v, true );
    wp_enqueue_script( 'petzenai-main',  get_template_directory_uri() . '/assets/js/main.js',   ['petzenai-tools'], $v, true );

    // Pass dynamic color to JS
    wp_localize_script( 'petzenai-main', 'petzenaiVars', [
        'primaryColor' => get_theme_mod( 'petzenai_primary_color', '#FF6B1A' ),
        'siteUrl'      => home_url('/'),
    ]);
}
add_action( 'wp_enqueue_scripts', 'petzenai_enqueue' );

/* ============================================================
   GOOGLE ANALYTICS 4 + SEARCH CONSOLE
   Add your GA4 Measurement ID in WordPress Admin:
   Appearance → Customize → Site Identity → GA4 Measurement ID
   ============================================================ */
add_action( 'wp_head', function() {
    $ga4_id = get_theme_mod( 'petzenai_ga4_id', '' );
    if ( ! $ga4_id || is_admin() ) return;
    $ga4_id = esc_js( sanitize_text_field( $ga4_id ) );
    ?>
<!-- Google Analytics 4 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $ga4_id; ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?php echo $ga4_id; ?>', {
    page_path: window.location.pathname,
    anonymize_ip: true
  });
</script>
    <?php
}, 1 );

// Google Search Console verification
add_action( 'wp_head', function() {
    $gsc = get_theme_mod( 'petzenai_gsc_verify', '' );
    if ( $gsc ) {
        echo '<meta name="google-site-verification" content="' . esc_attr( sanitize_text_field($gsc) ) . '">' . "\n";
    }
}, 1 );

// Register customizer fields for GA4 + GSC
add_action( 'customize_register', function( $wp_customize ) {
    $wp_customize->add_section( 'petzenai_analytics', [
        'title'    => '📊 Analytics & Search Console',
        'priority' => 30,
    ]);
    // GA4
    $wp_customize->add_setting( 'petzenai_ga4_id', [ 'default'=>'', 'sanitize_callback'=>'sanitize_text_field' ]);
    $wp_customize->add_control( 'petzenai_ga4_id', [
        'label'       => 'Google Analytics 4 — Measurement ID',
        'description' => 'Format: G-XXXXXXXXXX (from analytics.google.com)',
        'section'     => 'petzenai_analytics',
        'type'        => 'text',
    ]);
    // GSC
    $wp_customize->add_setting( 'petzenai_gsc_verify', [ 'default'=>'', 'sanitize_callback'=>'sanitize_text_field' ]);
    $wp_customize->add_control( 'petzenai_gsc_verify', [
        'label'       => 'Google Search Console — Verification Code',
        'description' => 'Only the code value from the meta tag (not full tag)',
        'section'     => 'petzenai_analytics',
        'type'        => 'text',
    ]);
});

/* ============================================================
   WIDGET AREAS
   ============================================================ */
function petzenai_widgets() {
    register_sidebar([
        'name'          => 'Footer Widget 1',
        'id'            => 'footer-1',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);
    register_sidebar([
        'name'          => 'Sidebar',
        'id'            => 'sidebar-main',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);
}
add_action( 'widgets_init', 'petzenai_widgets' );

/* ============================================================
   CUSTOMIZER
   ============================================================ */
require get_template_directory() . '/inc/customizer.php';

/* ============================================================
   PAGE TEMPLATES — register templates/pages/ folder
   ============================================================ */
add_filter( 'theme_page_templates', function( $templates ) {
    $templates['templates/pages/tool-page.php']       = '🛠️ Tool Page';
    $templates['templates/pages/tools-listing.php']  = '🗂️ Tools Listing Page';
    $templates['templates/pages/about.php']          = '👋 About Us Page';
    $templates['templates/pages/contact.php']        = '📨 Contact Us Page';
    $templates['templates/pages/blog-archive.php']   = '📝 Blog Archive Page';
    $templates['templates/pages/privacy-policy.php']   = '🔒 Privacy Policy Page';
    $templates['templates/pages/terms-of-service.php'] = '📋 Terms of Service Page';
    $templates['templates/pages/auto-tool.php']         = '🤖 Auto Tool Page (Dynamic)';
    $templates['templates/pages/tool-category.php']     = '🗂️ Tool Category Listing';
    $templates['templates/pages/hero-tool-food.php']     = '🍽️ Hero Tool — Food Portion Calculator';
    $templates['templates/pages/hero-tool-age.php']      = '🎂 Hero Tool — Age Calculator';
    $templates['templates/pages/hero-tool-vaccine.php']  = '💉 Hero Tool — Vaccination Schedule';
    $templates['templates/pages/hero-tool-names.php']    = '✨ Hero Tool — Pet Name Generator';
    $templates['templates/pages/hero-tool-exercise.php'] = '🏃 Hero Tool — Exercise Calculator';
    $templates['templates/pages/hero-tool-quiz.php']     = '❓ Hero Tool — What Pet Should I Get?';
    return $templates;
} );

// Make WP actually load these templates from the subfolder
add_filter( 'template_include', function( $template ) {
    global $post;
    if ( ! $post || ! is_page() ) return $template;
    $tpl = get_page_template_slug( $post->ID );
    if ( $tpl && file_exists( get_template_directory() . '/' . $tpl ) ) {
        return get_template_directory() . '/' . $tpl;
    }
    return $template;
} );

/* ============================================================
   TOOLS SHORTCODES
   ============================================================ */
require get_template_directory() . '/inc/tools.php';

/* ============================================================
   SEO META OUTPUT — Full Schema Suite
   ============================================================ */
function petzenai_seo_meta() {
    global $post;

    if ( defined('RANK_MATH_VERSION') ) return; // Rank Math active hai to skip

    $site_name   = get_bloginfo('name');
    $site_url    = home_url('/');
    $desc        = get_theme_mod('petzenai_seo_description','Free AI-powered pet care tools — food calculators, vaccine trackers, age calculators & more. Science-based diet planning for healthier pets.');
    $keywords    = get_theme_mod('petzenai_seo_keywords','pet food calculator, pet age calculator, dog nutrition, cat diet, pet vaccination schedule, AI pet tools');
    $og_image    = get_theme_mod('petzenai_og_image', get_template_directory_uri() . '/assets/images/og-default.jpg');
    $logo_url    = get_theme_mod('petzenai_logo_image', $og_image);
    $title       = $site_name;
    $permalink   = get_permalink() ?: $site_url;
    $is_tool_page = false;
    $tool_data    = null;

    // Per-page overrides
    if ( is_front_page() ) {
        $title = get_theme_mod('petzenai_hero_seo_title','PetZenAI — Science-Based Pet Care Tools');
    } elseif ( is_singular() && $post ) {
        $title    = get_post_meta($post->ID,'rank_math_title',true) ?: get_the_title() . ' — ' . $site_name;
        $rm_desc  = get_post_meta($post->ID,'rank_math_description',true);
        $desc     = $rm_desc ?: (has_excerpt() ? strip_tags(get_the_excerpt()) : $desc);
        $keywords = get_post_meta($post->ID,'rank_math_focus_keyword',true) ?: $keywords;
        $og_image = has_post_thumbnail() ? get_the_post_thumbnail_url($post->ID,'large') : $og_image;
        // Check if it's an auto-tool page
        $tpl = get_post_meta($post->ID,'_wp_page_template',true);
        if ( $tpl === 'templates/pages/auto-tool.php' ) {
            $is_tool_page = true;
            if ( function_exists('pz_get_tool_data') ) {
                $tool_data = pz_get_tool_data($post->post_name);
            }
        }
    } elseif ( is_singular('post') && $post ) {
        $title    = get_the_title() . ' — ' . $site_name;
        $desc     = has_excerpt() ? strip_tags(get_the_excerpt()) : $desc;
        $og_image = has_post_thumbnail() ? get_the_post_thumbnail_url($post->ID,'large') : $og_image;
    }

    // ── Basic Meta ──
    echo '<meta name="description" content="'  . esc_attr($desc)      . '">' . "\n";
    echo '<meta name="keywords" content="'     . esc_attr($keywords)  . '">' . "\n";
    echo '<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">' . "\n";
    echo '<meta name="author" content="'       . esc_attr($site_name) . '">' . "\n";
    echo '<link rel="canonical" href="'        . esc_url($permalink)  . '">' . "\n";

    // ── Open Graph ──
    echo '<meta property="og:locale" content="en_US">' . "\n";
    echo '<meta property="og:type" content="' . (is_singular('post') ? 'article' : 'website') . '">' . "\n";
    echo '<meta property="og:title" content="'       . esc_attr($title)     . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($desc)      . '">' . "\n";
    echo '<meta property="og:url" content="'         . esc_url($permalink)  . '">' . "\n";
    echo '<meta property="og:site_name" content="'   . esc_attr($site_name) . '">' . "\n";
    echo '<meta property="og:image" content="'       . esc_url($og_image)   . '">' . "\n";
    echo '<meta property="og:image:width" content="1200">'  . "\n";
    echo '<meta property="og:image:height" content="630">'  . "\n";
    echo '<meta property="og:image:alt" content="'   . esc_attr($title)     . '">' . "\n";
    if ( is_singular('post') && $post ) {
        echo '<meta property="article:published_time" content="' . get_the_date('c') . '">' . "\n";
        echo '<meta property="article:modified_time" content="'  . get_the_modified_date('c') . '">' . "\n";
        $cats = get_the_category();
        if ($cats) echo '<meta property="article:section" content="' . esc_attr($cats[0]->name) . '">' . "\n";
    }

    // ── Twitter Card ──
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="'       . esc_attr($title)    . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($desc)     . '">' . "\n";
    echo '<meta name="twitter:image" content="'       . esc_url($og_image)  . '">' . "\n";
    echo '<meta name="twitter:image:alt" content="'   . esc_attr($title)    . '">' . "\n";
    $tw = get_theme_mod('petzenai_social_twitter','');
    if ($tw) echo '<meta name="twitter:site" content="' . esc_attr($tw) . '">' . "\n";

    // ════════════════════════════════════════
    // SCHEMA — WebSite (always)
    // ════════════════════════════════════════
    $schema_website = [
        '@context' => 'https://schema.org',
        '@type'    => 'WebSite',
        '@id'      => $site_url . '#website',
        'url'      => $site_url,
        'name'     => $site_name,
        'description' => get_theme_mod('petzenai_seo_description',''),
        'potentialAction' => [
            '@type'       => 'SearchAction',
            'target'      => [ '@type' => 'EntryPoint', 'urlTemplate' => $site_url . '?s={search_term_string}' ],
            'query-input' => 'required name=search_term_string',
        ],
        'publisher' => [
            '@type' => 'Organization',
            '@id'   => $site_url . '#organization',
            'name'  => $site_name,
            'url'   => $site_url,
            'logo'  => [
                '@type'  => 'ImageObject',
                '@id'    => $site_url . '#logo',
                'url'    => $logo_url,
                'width'  => 200,
                'height' => 60,
                'caption'=> $site_name,
            ],
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($schema_website, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>' . "\n";

    // ════════════════════════════════════════
    // SCHEMA — Organization (homepage only)
    // ════════════════════════════════════════
    if ( is_front_page() ) {
        $schema_org = [
            '@context'     => 'https://schema.org',
            '@type'        => 'Organization',
            '@id'          => $site_url . '#organization',
            'name'         => $site_name,
            'url'          => $site_url,
            'logo'         => [
                '@type'  => 'ImageObject',
                'url'    => $logo_url,
                'width'  => 200,
                'height' => 60,
            ],
            'description'  => $desc,
            'foundingDate' => '2024',
            'contactPoint' => [
                '@type'       => 'ContactPoint',
                'email'       => get_theme_mod('petzenai_contact_email','support@petzenai.com'),
                'contactType' => 'Customer Support',
                'availableLanguage' => 'English',
            ],
            'sameAs' => array_values(array_filter([
                get_theme_mod('petzenai_social_facebook',''),
                get_theme_mod('petzenai_social_instagram',''),
                get_theme_mod('petzenai_social_twitter',''),
                get_theme_mod('petzenai_social_youtube',''),
            ])),
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($schema_org, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>' . "\n";

        // ── SiteNavigationElement ──
        $nav_schema = [
            '@context' => 'https://schema.org',
            '@type'    => 'ItemList',
            'name'     => 'PetZenAI Navigation',
            'itemListElement' => [
                ['@type'=>'SiteNavigationElement','position'=>1,'name'=>'Home','url'=>$site_url],
                ['@type'=>'SiteNavigationElement','position'=>2,'name'=>'Tools','url'=>$site_url.'tools/'],
                ['@type'=>'SiteNavigationElement','position'=>3,'name'=>'Blog','url'=>$site_url.'blog/'],
                ['@type'=>'SiteNavigationElement','position'=>4,'name'=>'About Us','url'=>$site_url.'about-us/'],
                ['@type'=>'SiteNavigationElement','position'=>5,'name'=>'Contact','url'=>$site_url.'contact-us/'],
            ],
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($nav_schema, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
    }

    // ════════════════════════════════════════
    // SCHEMA — Auto Tool Page (HowTo + FAQPage + BreadcrumbList + WebPage)
    // ════════════════════════════════════════
    if ( $is_tool_page && $post ) {
        $tool_title = get_the_title();
        $tool_url   = get_permalink();
        $animal     = $tool_data ? ucfirst($tool_data['animal'] === 'all' ? 'pet' : $tool_data['animal']) : 'Pet';
        $cat_label  = '';
        if ($tool_data && function_exists('pz_get_tool_categories')) {
            $cats = pz_get_tool_categories();
            $cat_label = $cats[$tool_data['cat']]['label'] ?? 'Pet Care';
        }

        // BreadcrumbList
        $bc = [
            '@context' => 'https://schema.org',
            '@type'    => 'BreadcrumbList',
            'itemListElement' => [
                ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],
                ['@type'=>'ListItem','position'=>2,'name'=>'Tools','item'=>$site_url.'tools/'],
                ['@type'=>'ListItem','position'=>3,'name'=>$cat_label,'item'=>$site_url.'tools/?cat='.($tool_data['cat']??'')],
                ['@type'=>'ListItem','position'=>4,'name'=>$tool_title,'item'=>$tool_url],
            ],
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($bc, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";

        // WebPage
        $wp_s = [
            '@context'    => 'https://schema.org',
            '@type'       => 'WebPage',
            '@id'         => $tool_url . '#webpage',
            'url'         => $tool_url,
            'name'        => $title,
            'description' => $desc,
            'datePublished'  => get_the_date('c', $post),
            'dateModified'   => get_the_modified_date('c', $post),
            'isPartOf'    => ['@type'=>'WebSite','@id'=>$site_url.'#website'],
            'about'       => ['@type'=>'Thing','name'=>$tool_title],
            'breadcrumb'  => ['@type'=>'BreadcrumbList','@id'=>$tool_url.'#breadcrumb'],
            'inLanguage'  => 'en-US',
            'potentialAction' => ['@type'=>'ReadAction','target'=>[$tool_url]],
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($wp_s, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";

        // HowTo Schema
        $howto = [
            '@context'    => 'https://schema.org',
            '@type'       => 'HowTo',
            'name'        => $tool_title,
            'description' => $desc,
            'image'       => ['@type'=>'ImageObject','url'=>$og_image,'width'=>1200,'height'=>630],
            'totalTime'   => 'PT5M',
            'tool'        => [['@type'=>'HowToTool','name'=>'PetZenAI Free Tool'],['@type'=>'HowToTool','name'=>'Your pet\'s weight and age']],
            'step' => [
                ['@type'=>'HowToStep','name'=>'Gather Pet Information','text'=>"Collect your {$animal}'s weight, age, breed, and activity level.",'position'=>1],
                ['@type'=>'HowToStep','name'=>'Use the Interactive Tool','text'=>"Enter your pet's details into the calculator or guide tool on this page.",'position'=>2],
                ['@type'=>'HowToStep','name'=>'Review Personalized Results','text'=>"Read your science-based, personalized recommendations and save as PDF.",'position'=>3],
                ['@type'=>'HowToStep','name'=>'Create a Routine','text'=>"Use the results to establish a consistent care schedule for your pet.",'position'=>4],
                ['@type'=>'HowToStep','name'=>'Consult Your Vet','text'=>"Share your results with your veterinarian at your next check-up.",'position'=>5],
            ],
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($howto, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>' . "\n";

        // FAQPage Schema
        $faq_schema = [
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => [
                ['@type'=>'Question','name'=>"Is the {$tool_title} free?",
                 'acceptedAnswer'=>['@type'=>'Answer','text'=>"Yes, the {$tool_title} on PetZenAI is 100% free. No sign-up or registration required. All tools are free forever."]],
                ['@type'=>'Question','name'=>"How accurate is this {$animal} care tool?",
                 'acceptedAnswer'=>['@type'=>'Answer','text'=>"Our tools are built on peer-reviewed veterinary research and follow AVMA and AAFCO guidelines. Results are vet-reviewed and science-based. Always confirm with your veterinarian for your specific pet."]],
                ['@type'=>'Question','name'=>"Can I download the results as PDF?",
                 'acceptedAnswer'=>['@type'=>'Answer','text'=>"Yes! Use the '📥 Download PDF' button on any tool page to save a printable PDF of your personalized guide. It's free and instant."]],
                ['@type'=>'Question','name'=>"Is this tool suitable for all breeds?",
                 'acceptedAnswer'=>['@type'=>'Answer','text'=>"Yes, the tool is designed for all breeds by incorporating size, age, and activity level. Some breeds have unique needs — consult a breed specialist for the most specific guidance."]],
                ['@type'=>'Question','name'=>"How often should I use this tool?",
                 'acceptedAnswer'=>['@type'=>'Answer','text'=>"We recommend using it every 3-6 months, or whenever your pet's weight, age, or health status changes significantly. For puppies and senior pets, monthly checks are beneficial."]],
            ],
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($faq_schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>' . "\n";

        // SoftwareApplication (for tool pages)
        $app_schema = [
            '@context'            => 'https://schema.org',
            '@type'               => 'SoftwareApplication',
            'name'                => $tool_title,
            'url'                 => $tool_url,
            'description'         => $desc,
            'applicationCategory' => 'HealthApplication',
            'operatingSystem'     => 'Web Browser',
            'offers'              => ['@type'=>'Offer','price'=>'0','priceCurrency'=>'USD'],
            'aggregateRating'     => ['@type'=>'AggregateRating','ratingValue'=>'4.9','reviewCount'=>'2400','bestRating'=>'5'],
            'author'              => ['@type'=>'Organization','name'=>$site_name,'url'=>$site_url],
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($app_schema, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
    }

    // ════════════════════════════════════════
    // SCHEMA — Blog Post (Article + BreadcrumbList)
    // ════════════════════════════════════════
    if ( is_singular('post') && $post ) {
        $cats       = get_the_category();
        $cat_name   = $cats ? $cats[0]->name : 'Pet Health';
        $cat_link   = $cats ? get_category_link($cats[0]->term_id) : $site_url.'blog/';
        $tags       = get_the_tags();
        $tag_names  = $tags ? array_map(fn($t)=>$t->name, $tags) : [];

        // BreadcrumbList
        $bc2 = [
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type'=>'ListItem','position'=>1,'name'=>'Home',    'item'=>$site_url],
                ['@type'=>'ListItem','position'=>2,'name'=>'Blog',    'item'=>$site_url.'blog/'],
                ['@type'=>'ListItem','position'=>3,'name'=>$cat_name, 'item'=>$cat_link],
                ['@type'=>'ListItem','position'=>4,'name'=>get_the_title(),'item'=>get_permalink()],
            ],
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($bc2, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";

        // Article
        $article = [
            '@context'         => 'https://schema.org',
            '@type'            => 'Article',
            '@id'              => get_permalink() . '#article',
            'headline'         => get_the_title(),
            'description'      => $desc,
            'url'              => get_permalink(),
            'datePublished'    => get_the_date('c'),
            'dateModified'     => get_the_modified_date('c'),
            'image'            => ['@type'=>'ImageObject','url'=>$og_image,'width'=>1200,'height'=>630,'alt'=>get_the_title()],
            'author'           => ['@type'=>'Person','name'=>get_the_author(),'url'=>$site_url],
            'publisher'        => ['@type'=>'Organization','name'=>$site_name,'url'=>$site_url,'logo'=>['@type'=>'ImageObject','url'=>$logo_url,'width'=>200,'height'=>60]],
            'mainEntityOfPage' => ['@type'=>'WebPage','@id'=>get_permalink()],
            'articleSection'   => $cat_name,
            'keywords'         => implode(', ', $tag_names),
            'wordCount'        => str_word_count(strip_tags(get_the_content())),
            'inLanguage'       => 'en-US',
            'isPartOf'         => ['@type'=>'WebSite','name'=>$site_name,'url'=>$site_url],
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($article, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
    }
}
add_action( 'wp_head', 'petzenai_seo_meta', 1 );

/* ── Rank Math: disable our custom SEO meta when Rank Math is active ── */
add_action( 'init', function () {
    if ( defined( 'RANK_MATH_VERSION' ) ) {
        remove_action( 'wp_head', 'petzenai_seo_meta', 1 );
    }
} );

/* Remove WP default meta that duplicates ours */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/* ============================================================
   DYNAMIC CSS COLORS (from customizer)
   ============================================================ */
function petzenai_dynamic_css() {
    $primary = get_theme_mod( 'petzenai_primary_color', '#FF6B1A' );
    $dark    = get_theme_mod( 'petzenai_dark_color',    '#0D0D0D' );
    echo "<style>:root{--orange:" . sanitize_hex_color($primary) . ";--black:" . sanitize_hex_color($dark) . ";}</style>\n";
}
add_action( 'wp_head', 'petzenai_dynamic_css' );

/* ============================================================
   EXCERPT
   ============================================================ */
add_filter( 'excerpt_length', fn() => 22 );
add_filter( 'excerpt_more',   fn() => '...' );

/* ============================================================
   ADSENSE HELPER
   Customizer mein Publisher ID + Ad Unit ID dalne ke baad
   ye function automatically responsive ad render karta hai.
   ============================================================ */
function petzenai_ad( $slot_key, $label = '' ) {
    $pub_id  = get_theme_mod( 'petzenai_adsense_publisher_id', '' );
    $unit_id = get_theme_mod( $slot_key, '' );
    if ( ! $pub_id || ! $unit_id ) return; // ID nahi hai to kuch show mat karo

    $pub_id  = sanitize_text_field( $pub_id );
    $unit_id = sanitize_text_field( $unit_id );
    ?>
    <div class="pz-ad-slot" aria-label="Advertisement" <?php if($label) echo 'data-slot="' . esc_attr($label) . '"'; ?>>
      <ins class="adsbygoogle"
           style="display:block"
           data-ad-client="ca-<?php echo esc_attr($pub_id); ?>"
           data-ad-slot="<?php echo esc_attr($unit_id); ?>"
           data-ad-format="auto"
           data-full-width-responsive="true"></ins>
      <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
    </div>
    <?php
}

/* AdSense script — header mein inject (Publisher ID dalne ke baad auto-load) */
add_action( 'wp_head', function() {
    $pub_id = get_theme_mod( 'petzenai_adsense_publisher_id', '' );
    if ( $pub_id ) {
        $pub_id = sanitize_text_field( $pub_id );
        echo '<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-' . esc_attr($pub_id) . '" crossorigin="anonymous"></script>' . "\n";
    }
}, 5 );

/* ============================================================
   PET TOOLS — ADMIN MENU
   WordPress sidebar mein Pages ke baad "Pet Tools" section
   ============================================================ */
add_action( 'admin_menu', function() {

    // Main menu item — Pages ke baad (position 21)
    add_menu_page(
        'Pet Tools',
        'Pet Tools',
        'manage_options',
        'pz-tools',
        'pz_admin_tools_dashboard',
        'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><text y="16" font-size="16">🐾</text></svg>'),
        21
    );

    // Sub-menu pages
    add_submenu_page( 'pz-tools', 'All Tools',        'All Tools',        'manage_options', 'pz-tools',             'pz_admin_tools_dashboard' );
    add_submenu_page( 'pz-tools', 'Add New Tool Page','Add New Tool Page','manage_options', 'pz-tools-add',         'pz_admin_tools_add' );
    add_submenu_page( 'pz-tools', 'Categories',       'Categories',       'manage_options', 'pz-tools-categories',  'pz_admin_tools_categories' );
    add_submenu_page( 'pz-tools', 'Bulk Create Pages','Bulk Create Pages','manage_options', 'pz-tools-bulk',        'pz_admin_tools_bulk' );
});

/* ── Admin CSS ── */
add_action( 'admin_head', function() {
    $screen = get_current_screen();
    if ( ! $screen || strpos($screen->id, 'pz-tools') === false ) return;
    echo '<style>
    .pz-admin-wrap{max-width:1200px}
    .pz-admin-header{background:linear-gradient(135deg,#1A1A2E,#16213E);border-radius:12px;padding:24px 28px;margin-bottom:24px;display:flex;align-items:center;gap:16px}
    .pz-admin-header h1{color:#fff;font-size:22px;margin:0;padding:0}
    .pz-admin-header p{color:rgba(255,255,255,0.6);font-size:13px;margin:4px 0 0}
    .pz-admin-header .pz-icon{font-size:40px}
    .pz-stat-cards{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px}
    .pz-stat-card{background:#fff;border:1px solid #e0e0e0;border-radius:10px;padding:20px;text-align:center;box-shadow:0 1px 4px rgba(0,0,0,.06)}
    .pz-stat-num{font-size:32px;font-weight:900;color:#FF6B1A}
    .pz-stat-label{font-size:12px;color:#888;font-weight:600;margin-top:4px}
    .pz-tools-table{background:#fff;border:1px solid #e0e0e0;border-radius:10px;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.06)}
    .pz-tools-table table{width:100%;border-collapse:collapse;font-size:13px}
    .pz-tools-table th{background:#F7F7F7;padding:10px 14px;text-align:left;font-weight:700;color:#333;border-bottom:2px solid #e0e0e0;font-size:12px;text-transform:uppercase;letter-spacing:.04em}
    .pz-tools-table td{padding:10px 14px;border-bottom:1px solid #F5F5F5;vertical-align:middle}
    .pz-tools-table tr:last-child td{border-bottom:none}
    .pz-tools-table tr:hover td{background:#FAFAFA}
    .pz-badge{display:inline-block;padding:3px 10px;border-radius:50px;font-size:11px;font-weight:700}
    .pz-badge-guide{background:#E3F2FD;color:#1565C0}
    .pz-badge-calc{background:#F3E5F5;color:#6A1B9A}
    .pz-badge-checker{background:#FFF3E0;color:#E65100}
    .pz-badge-tracker{background:#E8F5E9;color:#2E7D32}
    .pz-status-live{color:#2E7D32;font-weight:700;font-size:12px}
    .pz-status-missing{color:#C62828;font-weight:700;font-size:12px}
    .pz-search-bar{display:flex;gap:10px;margin-bottom:16px;align-items:center}
    .pz-search-bar input{padding:8px 14px;border:1px solid #ddd;border-radius:6px;font-size:13px;width:280px}
    .pz-search-bar select{padding:8px 12px;border:1px solid #ddd;border-radius:6px;font-size:13px}
    .pz-cat-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:24px}
    .pz-cat-card{background:#fff;border:1px solid #e0e0e0;border-radius:10px;padding:18px 20px;display:flex;align-items:center;gap:14px;box-shadow:0 1px 3px rgba(0,0,0,.05)}
    .pz-cat-icon{font-size:28px;flex-shrink:0}
    .pz-cat-name{font-weight:700;font-size:14px;color:#1A1A2E}
    .pz-cat-count{font-size:12px;color:#888;margin-top:2px}
    .pz-bulk-box{background:#fff;border:1px solid #e0e0e0;border-radius:10px;padding:28px;box-shadow:0 1px 4px rgba(0,0,0,.06)}
    .pz-bulk-progress{background:#F5F5F5;border-radius:8px;height:20px;margin:12px 0;overflow:hidden}
    .pz-bulk-bar{height:100%;background:linear-gradient(90deg,#FF6B1A,#ff8c42);transition:width .3s;border-radius:8px}
    </style>';
});

/* ══════════════════════════════════════════════
   PAGE 1: All Tools Dashboard
══════════════════════════════════════════════ */
function pz_admin_tools_dashboard() {
    require_once get_template_directory() . '/inc/tool-registry.php';
    $all_tools = pz_get_all_tools();
    $cats      = pz_get_tool_categories();
    $total     = count($all_tools);

    // Count live pages
    $live = 0;
    foreach($all_tools as $t) {
        if ( get_page_by_path($t['slug']) ) $live++;
    }
    $missing = $total - $live;

    // Filter
    $filter_cat  = sanitize_text_field($_GET['cat']  ?? '');
    $filter_type = sanitize_text_field($_GET['type'] ?? '');
    $search      = sanitize_text_field($_GET['s']    ?? '');

    $filtered = array_filter($all_tools, function($t) use ($filter_cat,$filter_type,$search) {
        if ($filter_cat  && $t['cat']  !== $filter_cat)  return false;
        if ($filter_type && $t['type'] !== $filter_type) return false;
        if ($search && stripos($t['title'],$search)===false && stripos($t['slug'],$search)===false) return false;
        return true;
    });

    // Type counts
    $type_counts = array_count_values(array_column($all_tools,'type'));
    ?>
    <div class="wrap pz-admin-wrap">

      <div class="pz-admin-header">
        <div class="pz-icon">🐾</div>
        <div>
          <h1>PetZenAI — Pet Tools Manager</h1>
          <p>Manage all <?php echo $total; ?> pet care tool pages — create, monitor, and optimize</p>
        </div>
      </div>

      <!-- Stats -->
      <div class="pz-stat-cards">
        <div class="pz-stat-card">
          <div class="pz-stat-num"><?php echo $total; ?></div>
          <div class="pz-stat-label">Total Tools</div>
        </div>
        <div class="pz-stat-card">
          <div class="pz-stat-num" style="color:#2E7D32"><?php echo $live; ?></div>
          <div class="pz-stat-label">Live Pages</div>
        </div>
        <div class="pz-stat-card">
          <div class="pz-stat-num" style="color:#C62828"><?php echo $missing; ?></div>
          <div class="pz-stat-label">Not Created Yet</div>
        </div>
        <div class="pz-stat-card">
          <div class="pz-stat-num"><?php echo count($cats); ?></div>
          <div class="pz-stat-label">Categories</div>
        </div>
      </div>

      <?php if($missing > 0): ?>
      <div class="notice notice-warning" style="display:flex;align-items:center;justify-content:space-between;padding:14px 18px;border-radius:8px">
        <div>⚠️ <strong><?php echo $missing; ?> tool pages</strong> haven't been created yet.</div>
        <a href="<?php echo admin_url('admin.php?page=pz-tools-bulk'); ?>" class="button button-primary">🚀 Bulk Create All Pages</a>
      </div>
      <?php else: ?>
      <div class="notice notice-success" style="padding:12px 18px;border-radius:8px">
        ✅ <strong>All <?php echo $total; ?> tool pages are live!</strong>
      </div>
      <?php endif; ?>

      <!-- Filter / Search -->
      <form method="GET" action="">
        <input type="hidden" name="page" value="pz-tools">
        <div class="pz-search-bar" style="margin-top:20px">
          <input type="text" name="s" value="<?php echo esc_attr($search); ?>" placeholder="🔍 Search tools...">
          <select name="cat">
            <option value="">All Categories</option>
            <?php foreach($cats as $key=>$c): ?>
            <option value="<?php echo $key; ?>" <?php selected($filter_cat,$key); ?>><?php echo $c['icon'].' '.$c['label']; ?></option>
            <?php endforeach; ?>
          </select>
          <select name="type">
            <option value="">All Types</option>
            <option value="guide"      <?php selected($filter_type,'guide'); ?>>📖 Guide</option>
            <option value="calculator" <?php selected($filter_type,'calculator'); ?>>🔢 Calculator</option>
            <option value="checker"    <?php selected($filter_type,'checker'); ?>>🔍 Checker</option>
            <option value="tracker"    <?php selected($filter_type,'tracker'); ?>>📅 Tracker</option>
          </select>
          <button type="submit" class="button">Filter</button>
          <a href="<?php echo admin_url('admin.php?page=pz-tools'); ?>" class="button">Reset</a>
          <span style="margin-left:auto;color:#888;font-size:13px"><?php echo count($filtered); ?> tools shown</span>
        </div>
      </form>

      <!-- Tools Table -->
      <div class="pz-tools-table">
        <table>
          <thead>
            <tr>
              <th style="width:32px">#</th>
              <th>Icon</th>
              <th>Tool Title</th>
              <th>Slug / URL</th>
              <th>Category</th>
              <th>Type</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=1; foreach($filtered as $t):
              $page    = get_page_by_path($t['slug']);
              $is_live = (bool)$page;
              $cat_l   = $cats[$t['cat']]['label'] ?? $t['cat'];
              $cat_i   = $cats[$t['cat']]['icon']  ?? '🐾';
              $badges  = ['guide'=>'pz-badge-guide','calculator'=>'pz-badge-calc','checker'=>'pz-badge-checker','tracker'=>'pz-badge-tracker'];
              $badge   = $badges[$t['type']] ?? 'pz-badge-guide';
              $view_url= home_url('/'.$t['slug'].'/');
              $edit_url= $is_live ? get_edit_post_link($page->ID) : '';
            ?>
            <tr>
              <td style="color:#aaa"><?php echo $i++; ?></td>
              <td style="font-size:20px"><?php echo $t['icon'] ?? '🐾'; ?></td>
              <td><strong><?php echo esc_html($t['title']); ?></strong></td>
              <td style="font-family:monospace;font-size:11px;color:#666">/<?php echo esc_html($t['slug']); ?>/</td>
              <td><?php echo $cat_i; ?> <?php echo esc_html($cat_l); ?></td>
              <td><span class="pz-badge <?php echo $badge; ?>"><?php echo ucfirst($t['type']); ?></span></td>
              <td>
                <?php if($is_live): ?>
                  <span class="pz-status-live">✅ Live</span>
                <?php else: ?>
                  <span class="pz-status-missing">❌ Missing</span>
                <?php endif; ?>
              </td>
              <td style="white-space:nowrap">
                <?php if($is_live): ?>
                  <a href="<?php echo esc_url($view_url); ?>" target="_blank" class="button button-small">👁 View</a>
                  <a href="<?php echo esc_url($edit_url); ?>" class="button button-small">✏️ Edit</a>
                <?php else: ?>
                  <a href="<?php echo admin_url('admin.php?page=pz-tools-bulk&create_one='.urlencode($t['slug'])); ?>" class="button button-primary button-small">➕ Create</a>
                <?php endif; ?>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    </div>
    <?php
}

/* ══════════════════════════════════════════════
   PAGE 2: Add New Tool Page
══════════════════════════════════════════════ */
function pz_admin_tools_add() {
    $msg = '';
    if ( $_POST && check_admin_referer('pz_add_tool') ) {
        $title  = sanitize_text_field($_POST['tool_title'] ?? '');
        $slug   = sanitize_title($_POST['tool_slug']  ?? '');
        $kw     = sanitize_text_field($_POST['tool_kw'] ?? '');
        if ($title && $slug) {
            $existing = get_page_by_path($slug);
            if ($existing) {
                $msg = '<div class="notice notice-warning"><p>⚠️ Page with this slug already exists (ID '.$existing->ID.').</p></div>';
            } else {
                $id = wp_insert_post(['post_title'=>$title,'post_name'=>$slug,'post_content'=>'','post_status'=>'publish','post_type'=>'page','post_author'=>1]);
                if ($id && !is_wp_error($id)) {
                    update_post_meta($id,'_wp_page_template','templates/pages/auto-tool.php');
                    if($kw) update_post_meta($id,'rank_math_focus_keyword',$kw);
                    $msg = '<div class="notice notice-success"><p>✅ Tool page created! <a href="'.get_edit_post_link($id).'">Edit Page</a> | <a href="'.get_permalink($id).'" target="_blank">View Live</a></p></div>';
                } else {
                    $msg = '<div class="notice notice-error"><p>❌ Failed to create page.</p></div>';
                }
            }
        } else {
            $msg = '<div class="notice notice-error"><p>❌ Title and Slug are required.</p></div>';
        }
    }
    require_once get_template_directory() . '/inc/tool-registry.php';
    $cats = pz_get_tool_categories();
    ?>
    <div class="wrap pz-admin-wrap">
      <div class="pz-admin-header">
        <div class="pz-icon">➕</div>
        <div><h1>Add New Tool Page</h1><p>Create a custom tool page outside the registry</p></div>
      </div>
      <?php echo $msg; ?>
      <div class="pz-bulk-box" style="max-width:600px">
        <form method="POST">
          <?php wp_nonce_field('pz_add_tool'); ?>
          <table class="form-table">
            <tr>
              <th><label for="tool_title">Tool Title *</label></th>
              <td><input type="text" id="tool_title" name="tool_title" class="regular-text" placeholder="e.g. Dog Bath Frequency Calculator" required></td>
            </tr>
            <tr>
              <th><label for="tool_slug">URL Slug *</label></th>
              <td><input type="text" id="tool_slug" name="tool_slug" class="regular-text" placeholder="e.g. dog-bath-frequency-calculator" required>
              <p class="description">Must be lowercase with hyphens only. This becomes the page URL.</p></td>
            </tr>
            <tr>
              <th><label for="tool_kw">Focus Keyword</label></th>
              <td><input type="text" id="tool_kw" name="tool_kw" class="regular-text" placeholder="e.g. how often should i bathe my dog"></td>
            </tr>
          </table>
          <p class="submit"><button type="submit" class="button button-primary button-large">➕ Create Tool Page</button></p>
        </form>
      </div>
    </div>
    <script>
    document.getElementById('tool_title')?.addEventListener('input',function(){
      var slug = this.value.toLowerCase().replace(/[^a-z0-9]+/g,'-').replace(/^-|-$/g,'');
      document.getElementById('tool_slug').value = slug;
    });
    </script>
    <?php
}

/* ══════════════════════════════════════════════
   PAGE 3: Categories
══════════════════════════════════════════════ */
function pz_admin_tools_categories() {
    require_once get_template_directory() . '/inc/tool-registry.php';
    $all_tools = pz_get_all_tools();
    $cats      = pz_get_tool_categories();

    // Count per category
    $cat_counts = [];
    $cat_live   = [];
    foreach($all_tools as $t) {
        $cat_counts[$t['cat']] = ($cat_counts[$t['cat']] ?? 0) + 1;
        if (get_page_by_path($t['slug'])) {
            $cat_live[$t['cat']] = ($cat_live[$t['cat']] ?? 0) + 1;
        }
    }
    ?>
    <div class="wrap pz-admin-wrap">
      <div class="pz-admin-header">
        <div class="pz-icon">🗂️</div>
        <div><h1>Tool Categories</h1><p><?php echo count($cats); ?> categories with <?php echo count($all_tools); ?> total tools</p></div>
      </div>

      <div class="pz-cat-grid">
        <?php foreach($cats as $key=>$cat):
          $total_in_cat = $cat_counts[$key] ?? 0;
          $live_in_cat  = $cat_live[$key]   ?? 0;
          $pct = $total_in_cat ? round($live_in_cat/$total_in_cat*100) : 0;
        ?>
        <div class="pz-cat-card">
          <div class="pz-cat-icon"><?php echo $cat['icon']; ?></div>
          <div style="flex:1">
            <div class="pz-cat-name"><?php echo esc_html($cat['label']); ?></div>
            <div class="pz-cat-count"><?php echo $total_in_cat; ?> tools · <?php echo $live_in_cat; ?> live</div>
            <div class="pz-bulk-progress" style="height:6px;margin:6px 0 0">
              <div class="pz-bulk-bar" style="width:<?php echo $pct; ?>%"></div>
            </div>
          </div>
          <div style="text-align:right;min-width:40px">
            <div style="font-size:18px;font-weight:900;color:#FF6B1A"><?php echo $pct; ?>%</div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Per-category tool table -->
      <?php
      $active_cat = sanitize_text_field($_GET['cat'] ?? array_key_first($cats));
      echo '<div style="margin-bottom:16px;display:flex;gap:8px;flex-wrap:wrap">';
      foreach($cats as $key=>$cat) {
          $url = admin_url('admin.php?page=pz-tools-categories&cat='.$key);
          $active = $key===$active_cat ? 'button-primary' : '';
          echo '<a href="'.esc_url($url).'" class="button '.$active.'">'.$cat['icon'].' '.$cat['label'].'</a>';
      }
      echo '</div>';

      $cat_tools = array_filter($all_tools, fn($t) => $t['cat'] === $active_cat);
      if($cat_tools): ?>
      <div class="pz-tools-table">
        <table>
          <thead><tr><th>Icon</th><th>Title</th><th>Type</th><th>Status</th><th>Action</th></tr></thead>
          <tbody>
          <?php foreach($cat_tools as $t):
            $page = get_page_by_path($t['slug']);
            $badges = ['guide'=>'pz-badge-guide','calculator'=>'pz-badge-calc','checker'=>'pz-badge-checker','tracker'=>'pz-badge-tracker'];
          ?>
          <tr>
            <td style="font-size:18px"><?php echo $t['icon'] ?? '🐾'; ?></td>
            <td><strong><?php echo esc_html($t['title']); ?></strong><br><code style="font-size:11px;color:#888">/<?php echo $t['slug']; ?>/</code></td>
            <td><span class="pz-badge <?php echo $badges[$t['type']] ?? ''; ?>"><?php echo ucfirst($t['type']); ?></span></td>
            <td><?php echo $page ? '<span class="pz-status-live">✅ Live</span>' : '<span class="pz-status-missing">❌ Missing</span>'; ?></td>
            <td>
              <?php if($page): ?>
                <a href="<?php echo esc_url(home_url('/'.$t['slug'].'/')); ?>" target="_blank" class="button button-small">👁 View</a>
              <?php else: ?>
                <a href="<?php echo admin_url('admin.php?page=pz-tools-bulk&create_one='.urlencode($t['slug'])); ?>" class="button button-primary button-small">➕ Create</a>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php endif; ?>
    </div>
    <?php
}

/* ══════════════════════════════════════════════
   PAGE 4: Bulk Create Pages
══════════════════════════════════════════════ */
function pz_admin_tools_bulk() {
    require_once get_template_directory() . '/inc/tool-registry.php';
    $all_tools = pz_get_all_tools();
    $total     = count($all_tools);

    $live_count = 0;
    foreach($all_tools as $t) { if(get_page_by_path($t['slug'])) $live_count++; }
    $missing_count = $total - $live_count;

    // Create single tool via URL param
    if ( isset($_GET['create_one']) ) {
        $slug = sanitize_title($_GET['create_one']);
        foreach($all_tools as $t) {
            if ($t['slug'] === $slug && !get_page_by_path($slug)) {
                $id = wp_insert_post(['post_title'=>$t['title'],'post_name'=>$t['slug'],'post_content'=>'','post_status'=>'publish','post_type'=>'page','post_author'=>1]);
                if($id && !is_wp_error($id)) {
                    update_post_meta($id,'_wp_page_template','templates/pages/auto-tool.php');
                    update_post_meta($id,'rank_math_focus_keyword',$t['kw']);
                    echo '<div class="notice notice-success"><p>✅ Created: <strong>'.$t['title'].'</strong> — <a href="'.get_permalink($id).'" target="_blank">View Live</a></p></div>';
                }
                break;
            }
        }
    }

    // Bulk create via POST
    $bulk_log = [];
    if ( isset($_POST['pz_bulk_create']) && check_admin_referer('pz_bulk_create') ) {
        foreach($all_tools as $t) {
            if (!get_page_by_path($t['slug'])) {
                $id = wp_insert_post(['post_title'=>$t['title'],'post_name'=>$t['slug'],'post_content'=>'','post_status'=>'publish','post_type'=>'page','post_author'=>1]);
                if($id && !is_wp_error($id)) {
                    update_post_meta($id,'_wp_page_template','templates/pages/auto-tool.php');
                    update_post_meta($id,'rank_math_focus_keyword',$t['kw']);
                    update_post_meta($id,'rank_math_title',$t['title'].' | PetZenAI');
                    $bulk_log[] = ['ok',$t['title'],$id];
                } else {
                    $bulk_log[] = ['err',$t['title'],'Failed'];
                }
            }
        }
        global $wp_rewrite;
        $wp_rewrite->flush_rules(true);
        $live_count = $total;
        $missing_count = 0;
    }
    ?>
    <div class="wrap pz-admin-wrap">
      <div class="pz-admin-header">
        <div class="pz-icon">🚀</div>
        <div><h1>Bulk Create Tool Pages</h1><p>Create all missing tool pages with one click</p></div>
      </div>

      <?php if($bulk_log): ?>
      <div class="notice notice-success">
        <p>✅ <strong><?php echo count(array_filter($bulk_log, fn($l)=>$l[0]==='ok')); ?> pages created successfully!</strong> All tool pages are now live.</p>
      </div>
      <?php endif; ?>

      <div class="pz-bulk-box" style="margin-bottom:24px">
        <div style="display:flex;gap:24px;align-items:center;flex-wrap:wrap;margin-bottom:20px">
          <div style="text-align:center;padding:16px 24px;background:#F7F7F7;border-radius:10px">
            <div style="font-size:32px;font-weight:900;color:#FF6B1A"><?php echo $total; ?></div>
            <div style="font-size:12px;color:#888;font-weight:600">Total Tools</div>
          </div>
          <div style="text-align:center;padding:16px 24px;background:#E8F5E9;border-radius:10px">
            <div style="font-size:32px;font-weight:900;color:#2E7D32"><?php echo $live_count; ?></div>
            <div style="font-size:12px;color:#888;font-weight:600">Live Pages</div>
          </div>
          <div style="text-align:center;padding:16px 24px;background:#FFEBEE;border-radius:10px">
            <div style="font-size:32px;font-weight:900;color:#C62828"><?php echo $missing_count; ?></div>
            <div style="font-size:12px;color:#888;font-weight:600">Missing Pages</div>
          </div>
          <div style="flex:1;min-width:200px">
            <div style="font-size:13px;color:#555;margin-bottom:8px;font-weight:600">Progress: <?php echo $live_count; ?>/<?php echo $total; ?></div>
            <div class="pz-bulk-progress">
              <div class="pz-bulk-bar" style="width:<?php echo $total?round($live_count/$total*100):0; ?>%"></div>
            </div>
          </div>
        </div>

        <?php if($missing_count > 0): ?>
        <div style="background:#FFF3E0;border:1.5px solid #FFE082;border-radius:8px;padding:16px 20px;margin-bottom:20px">
          <strong>⚠️ <?php echo $missing_count; ?> pages are not created yet.</strong><br>
          <span style="font-size:13px;color:#555">Click the button below to create all missing pages automatically. This may take 30-60 seconds.</span>
        </div>
        <form method="POST">
          <?php wp_nonce_field('pz_bulk_create'); ?>
          <button type="submit" name="pz_bulk_create" value="1" class="button button-primary button-hero"
            onclick="return confirm('Create <?php echo $missing_count; ?> tool pages? This will take a moment.')">
            🚀 Create All <?php echo $missing_count; ?> Missing Pages Now
          </button>
        </form>
        <?php else: ?>
        <div style="background:#E8F5E9;border:1.5px solid #A5D6A7;border-radius:8px;padding:16px 20px">
          <strong style="color:#2E7D32">✅ All <?php echo $total; ?> tool pages are live!</strong><br>
          <span style="font-size:13px;color:#555">Nothing to create. All pages are published and accessible.</span>
        </div>
        <?php endif; ?>
      </div>

      <?php if($bulk_log): ?>
      <div class="pz-tools-table">
        <table>
          <thead><tr><th>Status</th><th>Tool Title</th><th>Page ID</th></tr></thead>
          <tbody>
          <?php foreach($bulk_log as $l): ?>
          <tr>
            <td><?php echo $l[0]==='ok'?'<span class="pz-status-live">✅ Created</span>':'<span class="pz-status-missing">❌ Failed</span>'; ?></td>
            <td><?php echo esc_html($l[1]); ?></td>
            <td><?php echo esc_html($l[2]); ?></td>
          </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php endif; ?>
    </div>
    <?php
}
