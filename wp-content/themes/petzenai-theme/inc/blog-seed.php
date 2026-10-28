<?php
/**
 * Blog post seeder.
 *
 * Each file in inc/blog-content/ returns one post (title, slug, category, content, SEO description, focus keyword).
 * Any post that has not been added yet is created with PZ_BLOG_SEED_STATUS ('publish' once the owner has approved
 * going live; set 'draft' to review first). A post that was seeded once is never re-created (so deleting it sticks),
 * and an existing post with the same slug is never overwritten.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! defined( 'PZ_BLOG_SEED_STATUS' ) ) define( 'PZ_BLOG_SEED_STATUS', 'publish' );


/**
 * Download a stock photo and set it as the post's featured image (used for the blog index card and og:image).
 * $featured = [ 'url' => ..., 'alt' => ... ]. Does nothing if the post already has a featured image.
 * $featured = [ 'file' => 'assets/img/blog/x.jpg', 'alt' => ... ] uses our own image from the theme instead, and replaces
 * the current featured image once (remembered on the attachment as _pz_featured_src).
 * @return int attachment id, or 0
 */
function pz_seed_set_featured_image( $post_id, $featured, $slug ) {
    if ( ! $post_id ) return 0;
    $file = ! empty( $featured['file'] ) ? get_template_directory() . '/' . ltrim( $featured['file'], '/' ) : '';
    if ( $file ) {
        $cur = get_post_thumbnail_id( $post_id );
        if ( ! is_file( $file ) || ( $cur && get_post_meta( $cur, '_pz_featured_src', true ) === $featured['file'] ) ) return 0;
    } elseif ( empty( $featured['url'] ) || has_post_thumbnail( $post_id ) ) {
        return 0;
    }
    try {
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
        if ( $file ) {
            $tmp = wp_tempnam( basename( $file ) );
            if ( ! $tmp || ! @copy( $file, $tmp ) ) return 0;
            $name = basename( $file );
        } else {
            $tmp = download_url( $featured['url'], 30 );
            if ( is_wp_error( $tmp ) ) return 0;
            $name = sanitize_file_name( $slug . '.jpg' );
        }
        $att = media_handle_sideload( [ 'name' => $name, 'tmp_name' => $tmp ], $post_id, $featured['alt'] ?? '' );
        if ( is_wp_error( $att ) ) { @unlink( $tmp ); return 0; }
        update_post_meta( $att, '_wp_attachment_image_alt', $featured['alt'] ?? '' );
        if ( $file ) update_post_meta( $att, '_pz_featured_src', $featured['file'] );
        set_post_thumbnail( $post_id, $att );
        return (int) $att;
    } catch ( \Throwable $e ) {
        error_log( 'PetZenAI featured image failed for ' . $slug . ': ' . $e->getMessage() );
        return 0;
    }
}

/** Give already-published seeded posts their featured image if they do not have one yet. @return int[] post ids updated */
function pz_seed_backfill_featured_images() {
    $done = get_option( 'pz_seeded_posts', [] );
    $out  = [];
    foreach ( (array) glob( get_template_directory() . '/inc/blog-content/*.php' ) as $file ) {
        $key = basename( $file, '.php' );
        $post = include $file;
        if ( ! is_array( $post ) || empty( $post['featured'] ) ) continue;
        $id = isset( $done[ $key ] ) && is_int( $done[ $key ] ) ? $done[ $key ] : 0;
        if ( ! $id ) { $found = get_page_by_path( $post['slug'], OBJECT, 'post' ); $id = $found ? (int) $found->ID : 0; }
        if ( $id && pz_seed_set_featured_image( $id, $post['featured'], $post['slug'] ) ) $out[] = $id;
    }
    return $out;
}


/**
 * Apply the 'status' written in a content file ('draft' or 'publish'), once per change.
 * The last applied value is remembered per post, so something the owner publishes or unpublishes by hand in wp-admin is
 * never undone; it only acts again when the status in the content file itself is changed.
 * @return string[] log lines
 */
function pz_sync_post_statuses() {
    $applied = get_option( 'pz_post_status_applied', [] );
    $applied = is_array( $applied ) ? $applied : [];
    $log     = [];
    foreach ( (array) glob( get_template_directory() . '/inc/blog-content/*.php' ) as $file ) {
        $post = include $file;
        if ( ! is_array( $post ) || empty( $post['slug'] ) || empty( $post['status'] ) ) continue;
        $slug = $post['slug']; $want = $post['status'];
        $when = pz_seed_publish_at( $post );
        $sig  = $want . ( $want === 'publish' && $when ? '@' . $when : '' );   // a changed publish date applies again
        if ( ( $applied[ $slug ] ?? null ) === $sig ) continue;
        $found = get_page_by_path( $slug, OBJECT, 'post' );
        if ( $found && in_array( $want, [ 'draft', 'publish' ], true ) ) {
            $args = [ 'ID' => $found->ID, 'post_status' => $want ];
            if ( $want === 'publish' && $when ) {                               // scheduled: WordPress makes it 'future' until then
                $args += [ 'post_date' => $when, 'post_date_gmt' => get_gmt_from_date( $when ), 'edit_date' => true ];
                if ( strtotime( get_gmt_from_date( $when ) . ' UTC' ) > time() ) $args['post_status'] = 'future';
            }
            if ( $found->post_status !== $args['post_status'] || isset( $args['post_date'] ) ) {
                $had_kses = has_filter( 'content_save_pre', 'wp_filter_post_kses' );
                if ( $had_kses ) kses_remove_filters();      // status change only: do not re-filter our trusted content
                $r = wp_update_post( $args, true );
                if ( $had_kses ) kses_init_filters();
                $log[] = $slug . ': ' . $found->post_status . ' -> ' . $args['post_status'] . ( isset( $args['post_date'] ) ? ' (' . $when . ')' : '' ) . ( is_wp_error( $r ) ? ' (failed)' : '' );
            }
        }
        $applied[ $slug ] = $sig;
    }
    update_option( 'pz_post_status_applied', $applied, false );
    return $log;
}

/**
 * Push rewritten content to posts that already exist. A content file opts in with a 'revision' number; when it differs
 * from the last one applied, the post's title, content, excerpt and SEO meta are updated (status and date are kept).
 * Files without 'revision' are never re-applied, so manual edits in wp-admin to those posts are safe.
 * @return string[] log lines
 */
function pz_sync_post_content() {
    $applied = get_option( 'pz_post_revision_applied', [] );
    $applied = is_array( $applied ) ? $applied : [];
    $log     = [];
    foreach ( (array) glob( get_template_directory() . '/inc/blog-content/*.php' ) as $file ) {
        $post = include $file;
        if ( ! is_array( $post ) || empty( $post['slug'] ) || empty( $post['revision'] ) || empty( $post['content'] ) ) continue;
        $slug = $post['slug']; $rev = (string) $post['revision'];
        if ( ( $applied[ $slug ] ?? null ) === $rev ) continue;
        $found = get_page_by_path( $slug, OBJECT, 'post' );
        if ( ! $found ) continue;                            // not created yet: the seeder creates it with this content
        $had_kses = has_filter( 'content_save_pre', 'wp_filter_post_kses' );
        if ( $had_kses ) kses_remove_filters();              // trusted theme content
        $r = wp_update_post( [ 'ID' => $found->ID, 'post_title' => $post['title'], 'post_content' => $post['content'], 'post_excerpt' => $post['excerpt'] ?? '' ], true );
        if ( $had_kses ) kses_init_filters();
        if ( is_wp_error( $r ) ) { $log[] = $slug . ': update failed'; continue; }
        if ( ! empty( $post['description'] ) ) update_post_meta( $found->ID, 'rank_math_description', $post['description'] );
        if ( ! empty( $post['keyword'] ) )     update_post_meta( $found->ID, 'rank_math_focus_keyword', $post['keyword'] );
        $applied[ $slug ] = $rev;
        $log[] = $slug . ': content revision ' . $rev;
    }
    update_option( 'pz_post_revision_applied', $applied, false );
    return $log;
}

/**
 * Add one in-article image (from assets/img/blog/) to older posts that were written in wp-admin and have none.
 * The figure goes just before the post's second H2 (after the intro and first section). Each post is done once
 * (option pz_post_images_applied), and a post that already contains the image file is left alone.
 * @return string[] log lines
 */
function pz_add_post_images() {
    $images = [
        'budgerigar-care-guide'              => [ 'budgie-pair-cage', 'Green and blue budgerigars perched in a spacious cage with wooden perches and toys', 'A roomy cage with natural perches and toys keeps budgies active.' ],
        'cat-grooming-at-home-guide'         => [ 'cat-brushing-at-home', 'Owner brushing a relaxed long-haired cat at home with a slicker brush', 'Short, calm brushing sessions help long-haired cats avoid mats.' ],
        'cat-nutrition-guide'                => [ 'cat-nutrition-wet-dry-food', 'Cat choosing between a bowl of wet cat food and a bowl of dry kibble, with fresh water nearby', 'Wet and dry food can both be part of a complete cat diet.' ],
        'dog-anxiety-signs-causes-solutions' => [ 'anxious-dog-hiding', 'Anxious dog with ears back hiding under a coffee table', 'Hiding, flattened ears and a tucked tail are common signs of anxiety.' ],
        'dog-flea-tick-prevention-guide'     => [ 'dog-flea-tick-check', 'Owner parting a dog\'s fur to check the skin for fleas and ticks', 'Check the neck, ears and belly for fleas and ticks after walks.' ],
        'dog-separation-anxiety-treatment'   => [ 'dog-waiting-at-door', 'Dog waiting alone by the front door for its owner to come home', 'Many dogs with separation anxiety wait by the door when left alone.' ],
        'hamster-care-guide-beginners'       => [ 'hamster-cage-setup', 'Syrian hamster in a large cage with deep bedding, a solid running wheel and a hideout', 'Deep bedding, a solid wheel and hideouts make a good hamster setup.' ],
        'how-to-introduce-new-pet-to-home'   => [ 'dog-meets-cat-introduction', 'Dog and cat meeting calmly through a pet gate in a hallway', 'A pet gate lets a new dog and cat see each other safely at first.' ],
        'how-to-potty-train-a-puppy'         => [ 'puppy-potty-training-grass', 'Owner rewarding a puppy with a treat on the grass during potty training', 'Reward your puppy right after it goes in the right spot.' ],
        'senior-dog-care-guide'              => [ 'senior-dog-resting', 'Gray-muzzled senior Labrador resting on an orthopedic dog bed by a window', 'A supportive bed helps older dogs with stiff joints rest comfortably.' ],
    ];
    $applied = get_option( 'pz_post_images_applied', [] );
    $applied = is_array( $applied ) ? $applied : [];
    $base    = '/wp-content/themes/' . get_template() . '/assets/img/blog/';
    $log     = [];
    foreach ( $images as $slug => $img ) {
        list( $name, $alt, $caption ) = $img;
        if ( ( $applied[ $slug ] ?? '' ) === $name . '|v2' ) continue;
        $post = get_page_by_path( $slug, OBJECT, 'post' );
        if ( ! $post || ! is_file( get_template_directory() . '/assets/img/blog/' . $name . '.webp' ) ) continue;
        $content = (string) $post->post_content;
        // The old hotlinked stock photo at the top of these posts did not match its alt text (or no longer loads): remove it.
        $unsplash = '/(<!-- wp:image[^>]*-->\s*)?(<figure[^>]*>\s*|<p>\s*)?<img[^>]*src="https:\/\/images\.unsplash\.com\/[^"]*"[^>]*>(\s*<figcaption>.*?<\/figcaption>)?(\s*<\/figure>|\s*<\/p>)?(\s*<!-- \/wp:image -->)?\s*/is';
        $cleaned  = preg_replace( $unsplash, '', $content, 1 );
        if ( is_string( $cleaned ) && $cleaned !== $content ) {
            $had_kses = has_filter( 'content_save_pre', 'wp_filter_post_kses' );
            if ( $had_kses ) kses_remove_filters();
            $r = wp_update_post( [ 'ID' => $post->ID, 'post_content' => $cleaned ], true );
            if ( $had_kses ) kses_init_filters();
            if ( ! is_wp_error( $r ) ) { $content = $cleaned; $log[] = $slug . ': removed old stock photo'; }
        }
        if ( strpos( $content, $name . '.webp' ) === false ) {
            $figure = '<figure class="pz-blog-img"><img src="' . esc_attr( $base . $name . '.webp' ) . '" srcset="' . esc_attr( $base . $name . '-768.webp' ) . ' 768w, ' . esc_attr( $base . $name . '.webp' ) . ' 1200w" sizes="(max-width: 600px) 100vw, 560px" alt="' . esc_attr( $alt ) . '" width="1200" height="675" loading="lazy" decoding="async"><figcaption>' . esc_html( $caption ) . ' (AI-generated image)</figcaption></figure>';
            // Second H2, or the block comment that opens it in block-editor content; fall back to after the first paragraph.
            $pos = false;
            if ( preg_match_all( '/<h2[\s>]/i', $content, $m, PREG_OFFSET_CAPTURE ) && count( $m[0] ) >= 2 ) {
                $pos = $m[0][1][1];
                $before = substr( $content, 0, $pos );
                $c = strrpos( $before, '<!-- wp:heading' );
                if ( $c !== false && preg_match( '/^<!-- wp:heading[^>]*-->\s*$/', substr( $before, $c ) ) ) $pos = $c;
            } elseif ( ( $p = stripos( $content, '</p>' ) ) !== false ) {
                $pos = $p + 4;
            }
            if ( $pos === false ) continue;
            $block   = strpos( $content, '<!-- wp:' ) !== false ? "<!-- wp:html -->\n" . $figure . "\n<!-- /wp:html -->\n\n" : $figure . "\n\n";
            $content = substr( $content, 0, $pos ) . $block . substr( $content, $pos );
            $had_kses = has_filter( 'content_save_pre', 'wp_filter_post_kses' );
            if ( $had_kses ) kses_remove_filters();          // trusted theme markup (srcset, sizes)
            $r = wp_update_post( [ 'ID' => $post->ID, 'post_content' => $content ], true );
            if ( $had_kses ) kses_init_filters();
            if ( is_wp_error( $r ) ) { $log[] = $slug . ': image insert failed'; continue; }
        }
        $applied[ $slug ] = $name . '|v2';
        $log[] = $slug . ': ' . $name;
    }
    update_option( 'pz_post_images_applied', $applied, false );
    return $log;
}

/**
 * Older posts hotlinked stock photos from images.unsplash.com, several reused across posts with alt text that did not
 * describe the photo. Serve them from the theme instead (compressed WebP + 768w), with alt text that matches the image,
 * a different photo where one was reused on an unrelated post, and no photo where none fits (until our own is added).
 * Map: post slug => [ unsplash photo id => [ local image name, width, height, alt ] or null to remove ]. Done once per post.
 * @return string[] log lines
 */
function pz_localize_stock_images() {
    $own = [ 1200, 675 ]; $stock = [ 1200, 800 ];
    $map = [
        'best-pet-names-2025'                     => [ '1415369629372' => [ 'stock-1415369629372', $stock, 'Person giving a high five to a tabby cat at home' ] ],
        'cat-litter-box-complete-guide'           => [ '1757527669809' => [ 'stock-1757527669809', $stock, 'Two cats resting together in a quiet corner' ] ],
        'cat-vaccination-schedule'                => [ '1415369629372' => [ 'stock-1514888286974', $stock, 'Healthy black and white cat looking over a ledge' ] ],
        'dog-age-in-human-years'                  => [ '1770836037793' => [ 'stock-1770836037793', $stock, 'Veterinarian checking a dachshund during a health exam' ] ],
        'dog-body-language-guide'                 => [ '1664730807673' => [ 'stock-1664730807673', $stock, 'Dog seen from behind with its ears raised and alert' ] ],
        'dog-dental-care-guide'                   => [ '1536318811424' => [ 'stock-1536318811424', $stock, 'Close-up of a dog\'s open mouth showing its teeth and gums' ] ],
        'dog-grooming-at-home-guide'              => [ '1415369629372' => [ 'dog-bath-at-home', $own, 'Dog being bathed in a bathtub with a handheld shower at home' ] ],
        'dog-vaccination-schedule-guide'          => [ '1770836037793' => [ 'stock-1770836037275', $stock, 'Veterinarian treating a dachshund\'s leg during a clinic visit' ] ],
        'freshwater-aquarium-setup-beginners'     => [ '1691387824643' => [ 'stock-1691387824643', $stock, 'Planted freshwater aquarium with lush green plants and driftwood' ] ],
        'guinea-pig-care-guide'                   => [ '1512087499053' => [ 'stock-1512087499053', $stock, 'Guinea pig sitting on grass next to a carrot' ] ],
        'how-much-exercise-does-a-dog-need'       => [ '1415369629372' => [ 'stock-1587300003388', $stock, 'Happy border collie standing on a beach during a walk' ] ],
        'how-much-to-feed-dog'                    => [ '1415369629372' => null ],
        'how-to-choose-a-vet-guide'               => [ '1770836037275' => [ 'stock-1770836037275', $stock, 'Veterinarian treating a small dog\'s leg during an appointment' ] ],
        'new-puppy-checklist-everything-you-need' => [ '1777383504078' => [ 'stock-1777383504078', $stock, 'Small dog resting on a blanket inside a wooden kennel' ] ],
        'pet-insurance-guide-worth-it'            => [ '1770836037275' => [ 'stock-1770836037275', $stock, 'Veterinarian treating a dog\'s leg, the kind of visit pet insurance can help cover' ] ],
        'puppy-socialization-guide'               => [ '1555988483' => [ 'stock-1555988483', $stock, 'Owner holding a young merle puppy' ] ],
        'rabbit-care-guide-beginners'             => [ '1551102450' => [ 'stock-1551102450', $stock, 'Brown hare sitting in long grass' ] ],
        'signs-your-pet-is-sick'                  => [
            '1770836037793' => [ 'stock-1770836037793', $stock, 'Veterinarian examining a dachshund during a health check' ],
            '1770836037275' => [ 'stock-1770836037275', $stock, 'Veterinarian treating a dog\'s leg during an urgent visit' ],
            '1415369629372' => [ 'stock-1415369629372', $stock, 'Owner holding a cat\'s paw while checking it at home' ],
        ],
        'traveling-with-pets-guide'               => [ '1774790479490' => [ 'stock-1774790479490', $stock, 'Small dog riding in a sling carrier while its owner walks' ] ],
        'what-pet-should-i-get-guide'             => [ '1415369629372' => [ 'stock-1415369629372', $stock, 'Person giving a high five to a tabby cat at home' ] ],
    ];
    $applied = get_option( 'pz_stock_images_applied', [] );
    $applied = is_array( $applied ) ? $applied : [];
    $base    = '/wp-content/themes/' . get_template() . '/assets/img/blog/';
    $log     = [];
    foreach ( $map as $slug => $photos ) {
        if ( ! empty( $applied[ $slug ] ) ) continue;
        $post = get_page_by_path( $slug, OBJECT, 'post' );
        if ( ! $post ) continue;
        $content = (string) $post->post_content;
        $changed = 0;
        foreach ( $photos as $id => $img ) {
            $tag = '<img[^>]*src="https:\/\/images\.unsplash\.com\/photo-' . preg_quote( $id, '/' ) . '[^"]*"[^>]*>';
            if ( $img === null ) {
                $new = preg_replace( '/(<!-- wp:image[^>]*-->\s*)?(<figure[^>]*>\s*|<p>\s*)?' . $tag . '(\s*<figcaption>.*?<\/figcaption>)?(\s*<\/figure>|\s*<\/p>)?(\s*<!-- \/wp:image -->)?\s*/is', '', $content, 1, $n );
            } else {
                list( $name, $wh, $alt ) = $img;
                if ( ! is_file( get_template_directory() . '/assets/img/blog/' . $name . '.webp' ) ) continue;
                $html = '<img src="' . esc_attr( $base . $name . '.webp' ) . '" srcset="' . esc_attr( $base . $name . '-768.webp' ) . ' 768w, ' . esc_attr( $base . $name . '.webp' ) . ' 1200w" sizes="(max-width: 600px) 100vw, 560px" alt="' . esc_attr( $alt ) . '" width="' . $wh[0] . '" height="' . $wh[1] . '" loading="lazy" decoding="async" style="height:auto;border-radius:12px;margin-bottom:24px">';
                $new = preg_replace_callback( '/' . $tag . '/i', function () use ( $html ) { return $html; }, $content, 1, $n );
            }
            if ( is_string( $new ) && $n ) { $content = $new; $changed++; }
        }
        if ( $changed ) {
            $had_kses = has_filter( 'content_save_pre', 'wp_filter_post_kses' );
            if ( $had_kses ) kses_remove_filters();          // trusted theme markup (srcset, sizes)
            $r = wp_update_post( [ 'ID' => $post->ID, 'post_content' => $content ], true );
            if ( $had_kses ) kses_init_filters();
            if ( is_wp_error( $r ) ) { $log[] = $slug . ': stock image update failed'; continue; }
        }
        $applied[ $slug ] = 1;
        $log[] = $slug . ': ' . $changed . ' stock photo(s) localized';
    }
    update_option( 'pz_stock_images_applied', $applied, false );
    return $log;
}

/** 'publish_at' from a content file ('Y-m-d H:i', site time zone) as 'Y-m-d H:i:s', or '' when absent/invalid. */
function pz_seed_publish_at( $post ) {
    $raw = trim( (string) ( $post['publish_at'] ?? '' ) );
    $d   = $raw !== '' ? DateTime::createFromFormat( 'Y-m-d H:i', $raw ) : false;
    return $d ? $d->format( 'Y-m-d H:i:00' ) : '';
}

/**
 * Publish scheduled posts whose time has passed. WordPress relies on WP-Cron, which only runs on uncached
 * requests, so behind the page cache a post can sit on "Missed schedule". Checked at most every 15 minutes.
 */
add_action( 'init', function () {
    if ( get_transient( 'pz_missed_schedule_check' ) ) return;
    set_transient( 'pz_missed_schedule_check', 1, 15 * MINUTE_IN_SECONDS );
    $due = get_posts( [ 'post_type' => 'post', 'post_status' => 'future', 'numberposts' => 20, 'fields' => 'ids',
                        'date_query' => [ [ 'column' => 'post_date_gmt', 'before' => gmdate( 'Y-m-d H:i:s' ) ] ] ] );
    foreach ( $due as $id ) { wp_publish_post( $id ); }
}, 20 );

/** @return int[] ids of posts created by this call */
function pz_seed_blog_posts( $status = null ) {
    $status  = $status ?: PZ_BLOG_SEED_STATUS;
    $created = [];
    $author  = (int) get_current_user_id();
    if ( ! $author ) {                                   // front-end run: use the first administrator
        $admins = get_users( [ 'role' => 'administrator', 'number' => 1, 'fields' => 'ID' ] );
        $author = $admins ? (int) $admins[0] : 1;
    }
    $done = get_option( 'pz_seeded_posts', [] );
    if ( ! is_array( $done ) ) $done = [];
    $changed = false;

    foreach ( (array) glob( get_template_directory() . '/inc/blog-content/*.php' ) as $file ) {
        $key = basename( $file, '.php' );
        if ( isset( $done[ $key ] ) ) continue;
        try {
            $post = include $file;
            if ( ! is_array( $post ) || empty( $post['slug'] ) || empty( $post['title'] ) || empty( $post['content'] ) ) continue;

            if ( get_page_by_path( $post['slug'], OBJECT, 'post' ) ) {      // already on the site: leave it alone
                $done[ $key ] = 'exists'; $changed = true; continue;
            }
            $cat_id = 0;
            if ( ! empty( $post['category'] ) ) {
                $term = term_exists( $post['category'], 'category' );
                if ( $term ) $cat_id = (int) ( is_array( $term ) ? $term['term_id'] : $term );
            }
            $had_kses = has_filter( 'content_save_pre', 'wp_filter_post_kses' );
            if ( $had_kses ) kses_remove_filters();          // trusted theme content: keep our tables, classes and links intact
            $args = [
                'post_type'     => 'post',
                'post_status'   => ! empty( $post['status'] ) ? $post['status'] : $status,
                'post_title'    => $post['title'],
                'post_name'     => $post['slug'],
                'post_content'  => $post['content'],
                'post_excerpt'  => $post['excerpt'] ?? '',
                'post_author'   => $author,
                'post_category' => $cat_id ? [ $cat_id ] : [],
            ];
            if ( $args['post_status'] === 'publish' && ( $when = pz_seed_publish_at( $post ) ) ) {
                $args['post_date']     = $when;                // a future date makes WordPress schedule it
                $args['post_date_gmt'] = get_gmt_from_date( $when );
            }
            $id = wp_insert_post( $args, true );
            if ( $had_kses ) kses_init_filters();
            if ( is_wp_error( $id ) || ! $id ) continue;
            if ( ! empty( $post['description'] ) ) update_post_meta( $id, 'rank_math_description', $post['description'] );
            if ( ! empty( $post['keyword'] ) )     update_post_meta( $id, 'rank_math_focus_keyword', $post['keyword'] );
            if ( ! empty( $post['featured'] ) )    pz_seed_set_featured_image( $id, $post['featured'], $post['slug'] );
            $done[ $key ] = (int) $id; $changed = true; $created[] = (int) $id;
        } catch ( \Throwable $e ) {
            if ( ! empty( $had_kses ) ) kses_init_filters();
            error_log( 'PetZenAI blog seed failed for ' . $key . ': ' . $e->getMessage() );
        }
    }
    if ( $changed ) update_option( 'pz_seeded_posts', $done, false );
    return $created;
}

add_action( 'admin_init', function () {
    if ( ! current_user_can( 'manage_options' ) || wp_doing_ajax() || wp_doing_cron() ) return;
    pz_seed_blog_posts();
} );

/** Tell the owner which seeded posts are waiting for review (disappears once they are published or deleted). */
add_action( 'admin_notices', function () {
    if ( ! current_user_can( 'manage_options' ) ) return;
    $drafts = [];
    foreach ( (array) get_option( 'pz_seeded_posts', [] ) as $id ) {
        if ( is_int( $id ) && get_post_status( $id ) === 'draft' ) $drafts[] = $id;
    }
    if ( ! $drafts ) return;
    echo '<div class="notice notice-info"><p><strong>PetZenAI:</strong> ' . count( $drafts ) . ' new blog post draft(s) are ready for your review: ';
    $links = [];
    foreach ( $drafts as $id ) { $links[] = '<a href="' . esc_url( get_edit_post_link( $id ) ) . '">' . esc_html( get_the_title( $id ) ) . '</a>'; }
    echo implode( ' · ', $links ) . '. Read them, then press Publish.</p></div>';
} );

/** Tell IndexNow (Bing, Yandex and others) as soon as a post goes live, including scheduled posts publishing on their own. */
add_action( 'transition_post_status', function ( $new, $old, $post ) {
    if ( $new !== 'publish' || $old === 'publish' || $post->post_type !== 'post' || ! defined( 'PZ_INDEXNOW_KEY' ) ) return;
    if ( wp_parse_url( home_url(), PHP_URL_HOST ) !== 'petzenai.com' ) return;      // never from the local copy
    wp_remote_post( 'https://api.indexnow.org/indexnow', [
        'timeout'  => 5,
        'blocking' => false,
        'headers'  => [ 'Content-Type' => 'application/json; charset=utf-8' ],
        'body'     => wp_json_encode( [ 'host' => 'petzenai.com', 'key' => PZ_INDEXNOW_KEY, 'keyLocation' => home_url( '/' . PZ_INDEXNOW_KEY . '.txt' ), 'urlList' => [ get_permalink( $post ), home_url( '/blog/' ) ] ] ),
    ] );
}, 10, 3 );
