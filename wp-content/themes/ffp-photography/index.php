<?php
/**
 * The main template file — blog index
 *
 * @package FFP_Photography
 */
get_header();
?>

<section class="page-hero" aria-labelledby="blog-page-title">
    <div class="container">
        <nav class="breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'ffp-photography' ); ?>">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'ffp-photography' ); ?></a>
            <span class="breadcrumb-sep" aria-hidden="true">/</span>
            <span><?php esc_html_e( 'Blog', 'ffp-photography' ); ?></span>
        </nav>
        <span class="section-label"><?php esc_html_e( 'Stories & Inspiration', 'ffp-photography' ); ?></span>
        <h1 class="page-hero-title" id="blog-page-title"><?php esc_html_e( 'Journal', 'ffp-photography' ); ?></h1>
        <div class="divider" aria-hidden="true"></div>
    </div>
</section>

<section class="section section--dark">
    <div class="container">
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:2rem">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                <article <?php post_class( 'service-card' ); ?> style="padding:0;overflow:hidden">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                        <?php the_post_thumbnail( 'ffp-thumb', array( 'style' => 'width:100%;height:220px;object-fit:cover;display:block' ) ); ?>
                    </a>
                    <?php endif; ?>
                    <div style="padding:1.5rem 2rem">
                        <div style="font-size:.65rem;letter-spacing:.2em;text-transform:uppercase;color:var(--clr-gold);margin-bottom:.5rem">
                            <?php echo get_the_date(); ?>
                        </div>
                        <h2 style="font-family:var(--font-serif);font-size:1.4rem;margin-bottom:.75rem">
                            <a href="<?php the_permalink(); ?>" style="color:var(--clr-off-white);text-decoration:none">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                        <div style="font-size:.875rem;color:var(--clr-text-muted);line-height:1.7;margin-bottom:1.25rem">
                            <?php the_excerpt(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="btn btn-ghost" style="font-size:.65rem;padding:.5rem 1rem">
                            <?php esc_html_e( 'Read More', 'ffp-photography' ); ?>
                        </a>
                    </div>
                </article>
                <?php endwhile; ?>
            <?php else : ?>
                <p style="color:var(--clr-text-muted)"><?php esc_html_e( 'No posts found.', 'ffp-photography' ); ?></p>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div style="margin-top:var(--space-lg);text-align:center">
            <?php
            the_posts_pagination( array(
                'mid_size'           => 2,
                'prev_text'          => '&larr; ' . __( 'Previous', 'ffp-photography' ),
                'next_text'          => __( 'Next', 'ffp-photography' ) . ' &rarr;',
                'before_page_number' => '',
            ) );
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
