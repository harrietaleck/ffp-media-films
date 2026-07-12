<?php
/**
 * Template Name: About
 *
 * @package FFP_Photography
 */
get_header();

$photographer = get_theme_mod( 'ffp_photographer_name', 'FFP Photography' );
$years_exp    = (int) get_theme_mod( 'ffp_years_exp', 8 );
?>

<!-- Page Hero -->
<section class="page-hero" aria-labelledby="about-page-title">
    <div class="container">
        <nav class="breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'ffp-photography' ); ?>">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'ffp-photography' ); ?></a>
            <span class="breadcrumb-sep" aria-hidden="true">/</span>
            <span><?php esc_html_e( 'About', 'ffp-photography' ); ?></span>
        </nav>
        <span class="section-label"><?php esc_html_e( 'The Artist', 'ffp-photography' ); ?></span>
        <h1 class="page-hero-title" id="about-page-title"><?php esc_html_e( 'About Me', 'ffp-photography' ); ?></h1>
        <div class="divider" aria-hidden="true"></div>
    </div>
</section>

<!-- About Main -->
<section class="section section--dark" id="about-main">
    <div class="container">
        <div class="about-grid">

            <!-- Photo -->
            <div class="about-image-wrap">
                <?php
                $about_img = get_theme_mod( 'ffp_about_image', '' );
                if ( $about_img ) :
                ?>
                <img src="<?php echo esc_url( $about_img ); ?>" alt="<?php echo esc_attr( $photographer ); ?>" loading="eager">
                <?php else : ?>
                <div style="width:100%;aspect-ratio:4/5;background:linear-gradient(135deg,var(--clr-bg-card),var(--clr-surface));display:flex;align-items:center;justify-content:center">
                    <div style="opacity:.3;text-align:center">
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                        <p style="font-size:.7rem;letter-spacing:.2em;text-transform:uppercase;color:var(--clr-text-muted);margin-top:1rem"><?php esc_html_e( 'Add photographer photo', 'ffp-photography' ); ?></p>
                    </div>
                </div>
                <?php endif; ?>
                <div class="about-image-accent" aria-hidden="true"></div>
            </div>

            <!-- Text -->
            <div>
                <span class="section-label"><?php esc_html_e( 'My Story', 'ffp-photography' ); ?></span>
                <h2 style="font-family:var(--font-serif);font-size:clamp(2rem,4vw,3rem);color:var(--clr-off-white);margin-bottom:1rem">
                    <?php printf( esc_html__( 'Hi, I\'m %s', 'ffp-photography' ), esc_html( $photographer ) ); ?>
                </h2>
                <div class="divider" style="margin-left:0" aria-hidden="true"></div>

                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <div class="about-full">
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; else : ?>
                <div class="about-full">
                    <p><?php printf( esc_html__( 'Photography found me over %d years ago, and I\'ve never looked back. What started as a curiosity became an obsession — a way of seeing the world with fresh eyes, of pausing time and capturing something that might otherwise be lost forever.', 'ffp-photography' ), $years_exp ); ?></p>
                    <p><?php esc_html_e( 'I believe the best photographs aren\'t posed — they\'re discovered. My approach is documentary at heart: quiet, observational, and deeply respectful of the moments I\'m entrusted to capture. Whether it\'s the nervous laughter before the first dance, a grandfather\'s proud glance, or the golden light falling across a couple\'s faces, I\'m always hunting for the frame that makes you feel something.', 'ffp-photography' ); ?></p>
                    <p><?php esc_html_e( 'I\'m based in the city but travel regularly for destination weddings and editorial work. My studio is a place where natural light reigns supreme and every client is made to feel completely at ease.', 'ffp-photography' ); ?></p>
                    <p><?php esc_html_e( 'When I\'m not behind the lens, you\'ll find me in darkrooms, at exhibitions, or planning the next adventure with camera in hand.', 'ffp-photography' ); ?></p>
                </div>
                <?php endif; ?>

                <div class="about-stats" style="margin-top:var(--space-lg)">
                    <div class="stat-item">
                        <span class="stat-number"><?php echo esc_html( $years_exp ); ?>+</span>
                        <span class="stat-label"><?php esc_html_e( 'Years', 'ffp-photography' ); ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">500+</span>
                        <span class="stat-label"><?php esc_html_e( 'Sessions', 'ffp-photography' ); ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">40+</span>
                        <span class="stat-label"><?php esc_html_e( 'Countries', 'ffp-photography' ); ?></span>
                    </div>
                </div>

                <a href="<?php echo esc_url( home_url( '/booking' ) ); ?>" class="btn btn-primary" style="margin-top:var(--space-md)">
                    <?php esc_html_e( 'Work With Me', 'ffp-photography' ); ?>
                </a>
            </div>

        </div>
    </div>
</section>

<!-- Philosophy -->
<section class="section section--alt" id="philosophy" aria-labelledby="philosophy-heading">
    <div class="container container--narrow text-center">
        <span class="section-label"><?php esc_html_e( 'My Approach', 'ffp-photography' ); ?></span>
        <h2 class="section-title" id="philosophy-heading"><?php esc_html_e( 'Photography Philosophy', 'ffp-photography' ); ?></h2>
        <div class="divider" aria-hidden="true"></div>

        <blockquote style="font-family:var(--font-serif);font-size:clamp(1.2rem,3vw,1.8rem);color:var(--clr-off-white);line-height:1.5;font-style:italic;max-width:660px;margin:0 auto var(--space-lg)">
            &ldquo;<?php esc_html_e( 'Photography is the story I fail to put into words.', 'ffp-photography' ); ?>&rdquo;
            <footer style="font-style:normal;font-size:0.75rem;letter-spacing:.2em;text-transform:uppercase;color:var(--clr-gold);margin-top:1rem">— <?php esc_html_e( 'Destin Sparks', 'ffp-photography' ); ?></footer>
        </blockquote>

        <div class="services-grid" style="text-align:left;margin-top:var(--space-lg)">
            <?php
            $values = array(
                array(
                    'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>',
                    'title' => __( 'Authenticity', 'ffp-photography' ),
                    'text'  => __( 'I chase real moments, not manufactured poses. The best images happen when people forget there\'s a camera in the room.', 'ffp-photography' ),
                ),
                array(
                    'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1 6v16l7-4 8 4 7-4V2l-7 4-8-4-7 4z"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/></svg>',
                    'title' => __( 'Storytelling', 'ffp-photography' ),
                    'text'  => __( 'Every gallery is curated to tell your unique story — with beginning, middle, and an ending that leaves you breathless.', 'ffp-photography' ),
                ),
                array(
                    'icon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
                    'title' => __( 'Excellence', 'ffp-photography' ),
                    'text'  => __( 'From composition and light to post-processing — every image is treated with the same obsessive attention to detail.', 'ffp-photography' ),
                ),
            );
            foreach ( $values as $val ) :
            ?>
            <article class="service-card">
                <span class="service-icon"><?php echo $val['icon']; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
                <h3><?php echo esc_html( $val['title'] ); ?></h3>
                <p><?php echo esc_html( $val['text'] ); ?></p>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Gear -->
<section class="section section--dark" id="gear" aria-labelledby="gear-heading">
    <div class="container container--narrow">
        <div class="text-center" style="margin-bottom:var(--space-lg)">
            <span class="section-label"><?php esc_html_e( 'The Toolkit', 'ffp-photography' ); ?></span>
            <h2 class="section-title" id="gear-heading"><?php esc_html_e( 'Equipment', 'ffp-photography' ); ?></h2>
            <div class="divider" aria-hidden="true"></div>
            <p class="section-subtitle"><?php esc_html_e( 'Professional gear for professional results.', 'ffp-photography' ); ?></p>
        </div>
        <div class="gear-grid">
            <?php
            $gear = array(
                array( 'Camera Bodies', 'Sony A7R V, Sony A7 IV' ),
                array( 'Prime Lenses', '35mm f/1.4, 50mm f/1.2, 85mm f/1.4' ),
                array( 'Zoom Lenses',  '24–70mm f/2.8 GM, 70–200mm f/2.8 GM' ),
                array( 'Lighting',     'Godox AD600, Profoto B10 Plus' ),
                array( 'Accessories',  'Drone, Gimbals, ND Filters' ),
                array( 'Editing',      'Adobe Lightroom, Photoshop, Capture One' ),
            );
            foreach ( $gear as $item ) :
            ?>
            <div class="gear-item">
                <strong><?php echo esc_html( $item[0] ); ?></strong>
                <?php echo esc_html( $item[1] ); ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section booking-section" style="padding-block:var(--space-lg)">
    <div class="container text-center">
        <h2 style="font-size:clamp(1.8rem,4vw,2.8rem);margin-bottom:1rem"><?php esc_html_e( "Let's Create Together", 'ffp-photography' ); ?></h2>
        <p style="color:var(--clr-text-muted);margin-bottom:2rem;max-width:480px;margin-inline:auto">
            <?php esc_html_e( 'Your story deserves to be told beautifully. Reach out to discuss your vision.', 'ffp-photography' ); ?>
        </p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
            <a href="<?php echo esc_url( home_url( '/booking' ) ); ?>" class="btn btn-primary"><?php esc_html_e( 'Book a Session', 'ffp-photography' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>" class="btn btn-outline"><?php esc_html_e( 'View Portfolio', 'ffp-photography' ); ?></a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
