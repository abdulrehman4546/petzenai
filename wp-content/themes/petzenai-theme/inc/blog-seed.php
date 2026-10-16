<?php
/**
 * Blog post seeder.
 *
 * Each file in inc/blog-content/ returns one post (title, slug, category, content, SEO description, focus keyword).
 * When an administrator opens wp-admin, any post that has not been added yet is created as a DRAFT so the owner can
 * review it and press Publish. Nothing is published automatically, and a post that was seeded once is never
 * re-created (so deleting a draft sticks). Existing posts with the same slug are never overwritten.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_seed_blog_posts() {
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
            $id = wp_insert_post( [
                'post_type'     => 'post',
                'post_status'   => 'draft',
                'post_title'    => $post['title'],
                'post_name'     => $post['slug'],
                'post_content'  => $post['content'],
                'post_excerpt'  => $post['excerpt'] ?? '',
                'post_author'   => get_current_user_id(),
                'post_category' => $cat_id ? [ $cat_id ] : [],
            ], true );
            if ( is_wp_error( $id ) || ! $id ) continue;
            if ( ! empty( $post['description'] ) ) update_post_meta( $id, 'rank_math_description', $post['description'] );
            if ( ! empty( $post['keyword'] ) )     update_post_meta( $id, 'rank_math_focus_keyword', $post['keyword'] );
            $done[ $key ] = (int) $id; $changed = true;
        } catch ( \Throwable $e ) {
            error_log( 'PetZenAI blog seed failed for ' . $key . ': ' . $e->getMessage() );
        }
    }
    if ( $changed ) update_option( 'pz_seeded_posts', $done, false );
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
