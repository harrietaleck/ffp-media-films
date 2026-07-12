<?php
/**
 * Single Post Template
 *
 * @package FFP_Photography
 */
get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

<section class="page-hero" aria-labelledby="post-title-<?php the_ID(); ?>">
    <div class="container">
        <nav class="breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'ffp-photography' ); ?>">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'ffp-photography' ); ?></a>
            <span class="breadcrumb-sep" aria-hidden="true">/</span>
            <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>"><?php esc_html_e( 'Journal', 'ffp-photography' ); ?></a>
            <span class="breadcrumb-sep" aria-hidden="true">/</span>
            <span><?php the_title(); ?></span>
        </nav>
        <span class="section-label"><?php echo get_the_date(); ?></span>
        <h1 class="page-hero-title" id="post-title-<?php the_ID(); ?>" style="font-size:clamp(1.8rem,5vw,3.5rem)">
            <?php the_title(); ?>
        </h1>
        <div class="divider" aria-hidden="true"></div>
    </div>
</section>

<?php if ( has_post_thumbnail() ) : ?>
<div style="max-height:600px;overflow:hidden">
    <?php the_post_thumbnail( 'ffp-hero', array( 'style' => 'width:100%;height:600px;object-fit:cover;display:block' ) ); ?>
</div>
<?php endif; ?>

<article class="post-content" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <?php the_content(); ?>
    </div>

    <?php
    wp_link_pages( array(
        'before' => '<div class="page-links">' . __( 'Pages:', 'ffp-photography' ),
        'after'  => '</div>',
    ) );
    ?>

    <!-- Post Nav -->
    <nav class="post-navigation" style="display:flex;justify-content:space-between;gap:1rem;margin-top:3rem;padding-top:2rem;border-top:1px solid var(--clr-border)">
        <div><?php previous_post_link( '%link', '&larr; %title' ); ?></div>
        <div><?php next_post_link( '%link', '%title &rarr;' ); ?></div>
    </nav>
</article>

<?php endwhile; ?>

<?php get_footer(); ?>
