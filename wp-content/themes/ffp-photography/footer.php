<?php
/**
 * Site Footer Template
 *
 * @package FFP_Photography
 */
$photographer = get_theme_mod( 'ffp_photographer_name', 'FFP Photography' );
$instagram    = get_theme_mod( 'ffp_instagram', '' );
$phone        = get_theme_mod( 'ffp_phone', '' );
$admin_email  = get_option( 'admin_email' );
?>

<!-- Instagram Strip -->
<?php if ( $instagram ) : ?>
<section class="insta-strip" aria-label="<?php esc_attr_e( 'Instagram Feed', 'ffp-photography' ); ?>">
    <?php
    // Placeholder tiles — replace with actual Instagram feed plugin output
    $placeholder_colors = array( '#1a1a1a', '#161616', '#1e1e1e', '#121212', '#1c1c1c', '#181818' );
    for ( $i = 1; $i <= 6; $i++ ) :
    ?>
    <a href="https://instagram.com/<?php echo esc_attr( $instagram ); ?>" target="_blank" rel="noopener noreferrer" class="insta-item" aria-label="<?php printf( esc_attr__( 'Instagram post %d', 'ffp-photography' ), $i ); ?>">
        <img src="<?php echo esc_url( FFP_THEME_URI . '/assets/images/insta-' . $i . '.jpg' ); ?>"
             alt="<?php printf( esc_attr__( 'Instagram — %s', 'ffp-photography' ), $photographer ); ?>"
             loading="lazy"
             onerror="this.parentElement.style.background='<?php echo esc_js( $placeholder_colors[ $i - 1 ] ); ?>';this.style.display='none'">
        <div class="insta-item-overlay" aria-hidden="true">
            <span class="insta-icon">&#9678;</span>
        </div>
    </a>
    <?php endfor; ?>
</section>
<?php endif; ?>

<!-- Site Footer -->
<footer class="site-footer" role="contentinfo">
    <div class="footer-top">
        <div class="container">
            <div class="footer-grid">

                <!-- Brand -->
                <div class="footer-brand">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
                        <?php
                        $parts = explode( ' ', $photographer, 2 );
                        echo esc_html( $parts[0] );
                        if ( isset( $parts[1] ) ) : ?>
                            <span><?php echo esc_html( $parts[1] ); ?></span>
                        <?php endif; ?>
                    </a>
                    <p><?php esc_html_e( 'Capturing life\'s most precious moments with artistry and authenticity. Based worldwide, available everywhere.', 'ffp-photography' ); ?></p>
                    <div class="social-links">
                        <?php if ( $instagram ) : ?>
                        <a href="https://instagram.com/<?php echo esc_attr( $instagram ); ?>" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Instagram">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
                        </a>
                        <?php endif; ?>
                        <a href="#" class="social-link" aria-label="Facebook">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        </a>
                        <a href="#" class="social-link" aria-label="Pinterest">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12c0 4.24 2.65 7.86 6.39 9.29-.09-.78-.17-1.98.04-2.83.18-.77 1.22-5.16 1.22-5.16s-.31-.62-.31-1.55c0-1.45.84-2.54 1.89-2.54.89 0 1.32.67 1.32 1.47 0 .9-.57 2.24-.87 3.48-.25 1.04.52 1.88 1.54 1.88 1.85 0 3.09-2.37 3.09-5.18 0-2.14-1.44-3.64-3.5-3.64-2.38 0-3.78 1.79-3.78 3.64 0 .72.28 1.49.62 1.91.07.08.08.16.06.24-.06.26-.2.82-.23.94-.04.15-.13.18-.3.11-1.12-.52-1.82-2.17-1.82-3.5 0-2.85 2.07-5.47 5.97-5.47 3.13 0 5.57 2.23 5.57 5.21 0 3.11-1.96 5.61-4.68 5.61-.91 0-1.77-.48-2.07-1.03l-.56 2.1c-.2.78-.75 1.76-1.12 2.36.85.26 1.75.4 2.68.4 5.52 0 10-4.48 10-10S17.52 2 12 2z"/></svg>
                        </a>
                        <a href="#" class="social-link" aria-label="YouTube">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.95C18.88 4 12 4 12 4s-6.88 0-8.59.47a2.78 2.78 0 0 0-1.95 1.95C1 8.12 1 12 1 12s0 3.88.46 5.58a2.78 2.78 0 0 0 1.95 1.95C5.12 20 12 20 12 20s6.88 0 8.59-.47a2.78 2.78 0 0 0 1.95-1.95C23 15.88 23 12 23 12s0-3.88-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="currentColor" stroke="none"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-col">
                    <h4><?php esc_html_e( 'Navigate', 'ffp-photography' ); ?></h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'ffp-photography' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>"><?php esc_html_e( 'Portfolio', 'ffp-photography' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php esc_html_e( 'About', 'ffp-photography' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/booking' ) ); ?>"><?php esc_html_e( 'Book a Session', 'ffp-photography' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/blog' ) ); ?>"><?php esc_html_e( 'Blog', 'ffp-photography' ); ?></a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div class="footer-col">
                    <h4><?php esc_html_e( 'Services', 'ffp-photography' ); ?></h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url( home_url( '/booking?service=wedding' ) ); ?>"><?php esc_html_e( 'Wedding Photography', 'ffp-photography' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/booking?service=portrait' ) ); ?>"><?php esc_html_e( 'Portrait Sessions', 'ffp-photography' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/booking?service=engagement' ) ); ?>"><?php esc_html_e( 'Engagement Photos', 'ffp-photography' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/booking?service=commercial' ) ); ?>"><?php esc_html_e( 'Commercial Shoots', 'ffp-photography' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/booking?service=event' ) ); ?>"><?php esc_html_e( 'Event Coverage', 'ffp-photography' ); ?></a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="footer-col">
                    <h4><?php esc_html_e( 'Contact', 'ffp-photography' ); ?></h4>
                    <?php if ( $phone ) : ?>
                    <div class="footer-contact-item">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.69 3.5 2 2 0 0 1 3.66 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.6a16 16 0 0 0 6 6l1-1a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
                    </div>
                    <?php endif; ?>
                    <div class="footer-contact-item">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <a href="mailto:<?php echo esc_attr( $admin_email ); ?>"><?php echo esc_html( $admin_email ); ?></a>
                    </div>
                    <div class="footer-contact-item" style="margin-top:.5rem">
                        <a href="<?php echo esc_url( home_url( '/booking' ) ); ?>" class="btn btn-outline" style="font-size:.65rem;padding:.6rem 1.25rem"><?php esc_html_e( 'Book a Session', 'ffp-photography' ); ?></a>
                    </div>
                </div>

            </div><!-- /footer-grid -->
        </div><!-- /container -->
    </div><!-- /footer-top -->

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem">
            <p>&copy; <?php echo date( 'Y' ); ?> <?php echo esc_html( $photographer ); ?>. <?php esc_html_e( 'All rights reserved.', 'ffp-photography' ); ?></p>
            <ul class="footer-legal">
                <li><a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'ffp-photography' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/terms' ) ); ?>"><?php esc_html_e( 'Terms', 'ffp-photography' ); ?></a></li>
            </ul>
        </div>
    </div>

</footer>
<!-- /Site Footer -->

<!-- Lightbox -->
<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Image viewer', 'ffp-photography' ); ?>">
    <div class="lightbox-inner">
        <button class="lightbox-close" id="lightbox-close" aria-label="<?php esc_attr_e( 'Close', 'ffp-photography' ); ?>">&times;</button>
        <img class="lightbox-img" id="lightbox-img" src="" alt="">
        <button class="lightbox-prev" id="lightbox-prev" aria-label="<?php esc_attr_e( 'Previous', 'ffp-photography' ); ?>">&#8592;</button>
        <button class="lightbox-next" id="lightbox-next" aria-label="<?php esc_attr_e( 'Next', 'ffp-photography' ); ?>">&#8594;</button>
        <p class="lightbox-caption" id="lightbox-caption"></p>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
