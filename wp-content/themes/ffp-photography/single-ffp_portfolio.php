<?php
/**
 * Single Portfolio Item Template
 *
 * @package FFP_Photography
 */
get_header();
?>

<?php while ( have_posts() ) : the_post();
    $cats    = get_the_terms( get_the_ID(), 'ffp_category' );
    $cat     = $cats && ! is_wp_error( $cats ) ? $cats[0] : null;
    $img_url = get_the_post_thumbnail_url( get_the_ID(), 'ffp-hero' );
?>

<section class="page-hero" aria-labelledby="portfolio-item-title">
    <div class="container">
        <nav class="breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'ffp-photography' ); ?>">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'ffp-photography' ); ?></a>
            <span class="breadcrumb-sep">/</span>
            <a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>"><?php esc_html_e( 'Portfolio', 'ffp-photography' ); ?></a>
            <?php if ( $cat ) : ?>
            <span class="breadcrumb-sep">/</span>
            <span><?php echo esc_html( $cat->name ); ?></span>
            <?php endif; ?>
        </nav>
        <?php if ( $cat ) : ?>
        <span class="section-label"><?php echo esc_html( $cat->name ); ?></span>
        <?php endif; ?>
        <h1 class="page-hero-title" id="portfolio-item-title"><?php the_title(); ?></h1>
        <div class="divider" aria-hidden="true"></div>
    </div>
</section>

<?php if ( $img_url ) : ?>
<div style="max-height:700px;overflow:hidden" role="img" aria-label="<?php the_title_attribute(); ?>">
    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>" style="width:100%;height:700px;object-fit:cover;display:block">
</div>
<?php endif; ?>

<article class="post-content" <?php post_class(); ?>>
    <?php if ( get_the_content() ) : ?>
        <div class="entry-content"><?php the_content(); ?></div>
    <?php endif; ?>
</article>

<!-- More Portfolio Items -->
<section class="section section--alt" style="padding-block:var(--space-lg)">
    <div class="container">
        <div class="text-center" style="margin-bottom:var(--space-md)">
            <span class="section-label"><?php esc_html_e( 'Continue Exploring', 'ffp-photography' ); ?></span>
            <h2 style="font-family:var(--font-serif);font-size:2rem;color:var(--clr-off-white)"><?php esc_html_e( 'More Work', 'ffp-photography' ); ?></h2>
        </div>
        <div class="gallery-grid">
            <?php
            $more = ffp_get_portfolio_items( array(
                'posts_per_page' => 3,
                'post__not_in'   => array( get_the_ID() ),
            ) );
            foreach ( $more as $item ) {
                ffp_render_gallery_item( $item );
            }
            wp_reset_postdata();
            ?>
        </div>
        <div class="text-center" style="margin-top:var(--space-md)">
            <a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>" class="btn btn-outline"><?php esc_html_e( 'View Full Portfolio', 'ffp-photography' ); ?></a>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
