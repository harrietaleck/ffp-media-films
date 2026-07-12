<?php
/**
 * Generic Page Template
 *
 * @package FFP_Photography
 */
get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

<section class="page-hero" aria-labelledby="page-title-<?php the_ID(); ?>">
    <div class="container">
        <span class="section-label"><?php bloginfo( 'name' ); ?></span>
        <h1 class="page-hero-title" id="page-title-<?php the_ID(); ?>"><?php the_title(); ?></h1>
        <div class="divider" aria-hidden="true"></div>
    </div>
</section>

<article class="post-content" id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php the_content(); ?>
</article>

<?php endwhile; ?>

<?php get_footer(); ?>
