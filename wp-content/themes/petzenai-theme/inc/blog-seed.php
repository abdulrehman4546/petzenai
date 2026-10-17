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
            $id = wp_insert_post( [
                'post_type'     => 'post',
                'post_status'   => $status,
                'post_title'    => $post['title'],
                'post_name'     => $post['slug'],
                'post_content'  => $post['content'],
                'post_excerpt'  => $post['excerpt'] ?? '',
                'post_author'   => $author,
                'post_category' => $cat_id ? [ $cat_id ] : [],
            ], true );
            if ( $had_kses ) kses_init_filters();
            if ( is_wp_error( $id ) || ! $id ) continue;
            if ( ! empty( $post['description'] ) ) update_post_meta( $id, 'rank_math_description', $post['description'] );
            if ( ! empty( $post['keyword'] ) )     update_post_meta( $id, 'rank_math_focus_keyword', $post['keyword'] );
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
