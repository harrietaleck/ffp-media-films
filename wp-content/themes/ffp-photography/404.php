<?php
/**
 * 404 Error Page Template
 *
 * @package FFP_Photography
 */
get_header();
?>

<main class="page-404" id="main-content" role="main">
    <div class="container text-center">
        <span class="page-404-number" aria-hidden="true">404</span>
        <span class="section-label"><?php esc_html_e( 'Page Not Found', 'ffp-photography' ); ?></span>
        <h1 style="font-family:var(--font-serif);font-size:clamp(1.8rem,4vw,2.8rem);color:var(--clr-off-white);margin:1rem 0">
            <?php esc_html_e( 'This frame is empty.', 'ffp-photography' ); ?>
        </h1>
        <p style="color:var(--clr-text-muted);max-width:400px;margin:0 auto 2.5rem">
            <?php esc_html_e( 'The page you\'re looking for has moved, been deleted, or never existed. Let\'s get you back on track.', 'ffp-photography' ); ?>
        </p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
                <?php esc_html_e( 'Back to Home', 'ffp-photography' ); ?>
            </a>
            <a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>" class="btn btn-outline">
                <?php esc_html_e( 'View Portfolio', 'ffp-photography' ); ?>
            </a>
        </div>
    </div>
</main>

<?php get_footer(); ?>
