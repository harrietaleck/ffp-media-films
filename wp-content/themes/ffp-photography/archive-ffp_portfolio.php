<?php
/**
 * Portfolio Archive Template
 * Mirrors page-portfolio.php for CPT archive URL (/portfolio/)
 *
 * @package FFP_Photography
 */

// Redirect to the Portfolio page if it exists
$portfolio_page = get_page_by_path( 'portfolio' );
if ( $portfolio_page ) {
    wp_redirect( get_permalink( $portfolio_page->ID ), 301 );
    exit;
}

// Fallback: render inline
get_header();
?>

<section class="page-hero">
    <div class="container">
        <span class="section-label"><?php esc_html_e( 'The Work', 'ffp-photography' ); ?></span>
        <h1 class="page-hero-title"><?php post_type_archive_title(); ?></h1>
        <div class="divider" aria-hidden="true"></div>
    </div>
</section>

<section class="section section--dark">
    <div class="container container--wide">
        <div class="portfolio-masonry">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php ffp_render_gallery_item( get_post() ); ?>
            <?php endwhile; ?>
        </div>
        <?php the_posts_pagination(); ?>
    </div>
</section>

<?php get_footer(); ?>
