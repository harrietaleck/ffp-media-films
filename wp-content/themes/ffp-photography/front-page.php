<?php
/**
 * Front Page Template (Homepage)
 *
 * @package FFP_Photography
 */
get_header();

$photographer = get_theme_mod( 'ffp_photographer_name', 'FFP Photography' );
$tagline      = get_theme_mod( 'ffp_hero_tagline', "Capturing Life's\nMost Precious\nMoments" );
$years_exp    = (int) get_theme_mod( 'ffp_years_exp', 8 );
?>

<!-- ============================================================
     HERO SECTION
============================================================ -->
<section class="hero" id="hero" aria-label="<?php esc_attr_e( 'Hero', 'ffp-photography' ); ?>">

    <div class="hero-bg" id="hero-bg" role="img" aria-label="<?php esc_attr_e( 'Hero background photograph', 'ffp-photography' ); ?>">
        <?php
        // Attempt to use the front-page featured image or a fallback
        $hero_img = get_theme_mod( 'header_image', '' );
        if ( $hero_img ) {
            echo '<img src="' . esc_url( $hero_img ) . '" alt="" aria-hidden="true" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0">';
        }
        ?>
    </div>

    <div class="hero-overlay" aria-hidden="true"></div>

    <div class="hero-content">
        <p class="hero-eyebrow"><?php esc_html_e( 'Fine Art Photography', 'ffp-photography' ); ?></p>

        <h1 class="hero-title">
            <?php
            $lines = explode( "\n", $tagline );
            foreach ( $lines as $i => $line ) {
                if ( $i === 1 ) {
                    echo '<em>' . esc_html( trim( $line ) ) . '</em>';
                } else {
                    echo esc_html( trim( $line ) );
                }
                if ( $i < count( $lines ) - 1 ) echo '<br>';
            }
            ?>
        </h1>

        <p class="hero-subtitle">
            <?php printf(
                esc_html__( 'Weddings, portraits, engagements &amp; beyond — captured with intention by %s.', 'ffp-photography' ),
                esc_html( $photographer )
            ); ?>
        </p>

        <div class="hero-actions">
            <a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>" class="btn btn-primary">
                <?php esc_html_e( 'View Portfolio', 'ffp-photography' ); ?>
            </a>
            <a href="<?php echo esc_url( home_url( '/booking' ) ); ?>" class="btn btn-outline">
                <?php esc_html_e( 'Book a Session', 'ffp-photography' ); ?>
            </a>
        </div>
    </div>

    <div class="hero-scroll" id="hero-scroll" role="button" tabindex="0" aria-label="<?php esc_attr_e( 'Scroll down', 'ffp-photography' ); ?>">
        <span><?php esc_html_e( 'Scroll', 'ffp-photography' ); ?></span>
        <span class="hero-scroll-line" aria-hidden="true"></span>
    </div>

</section>


<!-- ============================================================
     FEATURED WORK
============================================================ -->
<section class="section section--dark" id="featured-work" aria-labelledby="featured-work-heading">
    <div class="container">
        <div class="text-center" style="margin-bottom:var(--space-lg)">
            <span class="section-label"><?php esc_html_e( 'Selected Work', 'ffp-photography' ); ?></span>
            <h2 class="section-title" id="featured-work-heading"><?php esc_html_e( 'Recent Work', 'ffp-photography' ); ?></h2>
            <div class="divider" aria-hidden="true"></div>
            <p class="section-subtitle">
                <?php esc_html_e( 'Every frame tells a story. Explore a selection of recent sessions from weddings to intimate portraits.', 'ffp-photography' ); ?>
            </p>
        </div>

        <?php
        $featured_items = ffp_get_portfolio_items( array( 'posts_per_page' => 6, 'meta_key' => '_ffp_featured', 'meta_value' => '1', 'ignore_sticky_posts' => true ) );
        // Fallback: just get latest 6
        if ( empty( $featured_items ) ) {
            $featured_items = ffp_get_portfolio_items( array( 'posts_per_page' => 6 ) );
        }
        ?>

        <?php if ( $featured_items ) : ?>
        <div class="gallery-grid" role="list">
            <?php foreach ( $featured_items as $item ) :
                setup_postdata( $item );
                ffp_render_gallery_item( $item );
            endforeach;
            wp_reset_postdata(); ?>
        </div>
        <?php else : ?>
        <!-- Demo placeholders when no portfolio items exist yet -->
        <div class="gallery-grid" role="list">
            <?php
            $demo_labels = array(
                array( 'Wedding', 'The Anderson Family' ),
                array( 'Portrait', 'Emily & James' ),
                array( 'Engagement', 'Golden Hour Series' ),
                array( 'Commercial', 'Studio Session' ),
                array( 'Event', 'Gala Evening' ),
                array( 'Portrait', 'Lifestyle Editorial' ),
            );
            foreach ( $demo_labels as $label ) :
            ?>
            <div class="gallery-item" style="background:var(--clr-bg-card)">
                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--clr-bg-card),var(--clr-surface))">
                    <div style="text-align:center;opacity:.4">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    </div>
                </div>
                <div class="gallery-item-overlay" style="opacity:1;background:linear-gradient(to top,rgba(0,0,0,.6) 0%,transparent 60%)">
                    <div class="gallery-item-info">
                        <h3><?php echo esc_html( $label[1] ); ?></h3>
                        <span><?php echo esc_html( $label[0] ); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="text-center" style="margin-top:var(--space-lg)">
            <a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>" class="btn btn-outline">
                <?php esc_html_e( 'View Full Portfolio', 'ffp-photography' ); ?>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </div>
</section>


<!-- ============================================================
     SERVICES SECTION
============================================================ -->
<section class="section section--alt" id="services" aria-labelledby="services-heading">
    <div class="container">
        <div class="text-center" style="margin-bottom:var(--space-lg)">
            <span class="section-label"><?php esc_html_e( 'What We Offer', 'ffp-photography' ); ?></span>
            <h2 class="section-title" id="services-heading"><?php esc_html_e( 'Photography Services', 'ffp-photography' ); ?></h2>
            <div class="divider" aria-hidden="true"></div>
            <p class="section-subtitle">
                <?php esc_html_e( 'From intimate portraits to grand celebrations — tailored packages to suit your vision and budget.', 'ffp-photography' ); ?>
            </p>
        </div>

        <div class="services-grid">

            <article class="service-card">
                <span class="service-icon" aria-hidden="true">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                </span>
                <h3><?php esc_html_e( 'Wedding Photography', 'ffp-photography' ); ?></h3>
                <p><?php esc_html_e( 'Your wedding day deserves to be immortalised with timeless, elegant imagery. Full-day coverage, two photographers, and a beautifully curated gallery.', 'ffp-photography' ); ?></p>
                <div class="service-price"><?php esc_html_e( 'From $2,800', 'ffp-photography' ); ?> <span><?php esc_html_e( '/ full day', 'ffp-photography' ); ?></span></div>
                <a href="<?php echo esc_url( home_url( '/booking?service=Wedding+Photography' ) ); ?>" class="btn btn-ghost" style="margin-top:1.5rem;font-size:.65rem"><?php esc_html_e( 'Book Now', 'ffp-photography' ); ?></a>
            </article>

            <article class="service-card">
                <span class="service-icon" aria-hidden="true">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </span>
                <h3><?php esc_html_e( 'Portrait Sessions', 'ffp-photography' ); ?></h3>
                <p><?php esc_html_e( 'Whether it\'s a personal brand shoot, family portrait, or creative editorial — we craft images that reflect your true essence in a relaxed setting.', 'ffp-photography' ); ?></p>
                <div class="service-price"><?php esc_html_e( 'From $450', 'ffp-photography' ); ?> <span><?php esc_html_e( '/ session', 'ffp-photography' ); ?></span></div>
                <a href="<?php echo esc_url( home_url( '/booking?service=Portrait+Session' ) ); ?>" class="btn btn-ghost" style="margin-top:1.5rem;font-size:.65rem"><?php esc_html_e( 'Book Now', 'ffp-photography' ); ?></a>
            </article>

            <article class="service-card">
                <span class="service-icon" aria-hidden="true">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                </span>
                <h3><?php esc_html_e( 'Engagement Shoots', 'ffp-photography' ); ?></h3>
                <p><?php esc_html_e( 'Celebrate your love story before the big day. A relaxed, fun session in a location meaningful to you — perfect for save-the-dates.', 'ffp-photography' ); ?></p>
                <div class="service-price"><?php esc_html_e( 'From $680', 'ffp-photography' ); ?> <span><?php esc_html_e( '/ session', 'ffp-photography' ); ?></span></div>
                <a href="<?php echo esc_url( home_url( '/booking?service=Engagement+Shoot' ) ); ?>" class="btn btn-ghost" style="margin-top:1.5rem;font-size:.65rem"><?php esc_html_e( 'Book Now', 'ffp-photography' ); ?></a>
            </article>

            <article class="service-card">
                <span class="service-icon" aria-hidden="true">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                </span>
                <h3><?php esc_html_e( 'Commercial & Brand', 'ffp-photography' ); ?></h3>
                <p><?php esc_html_e( 'High-quality commercial photography for brands, businesses, and products. Elevate your visual identity with images that convert.', 'ffp-photography' ); ?></p>
                <div class="service-price"><?php esc_html_e( 'From $1,200', 'ffp-photography' ); ?> <span><?php esc_html_e( '/ half day', 'ffp-photography' ); ?></span></div>
                <a href="<?php echo esc_url( home_url( '/booking?service=Commercial+%26+Brand' ) ); ?>" class="btn btn-ghost" style="margin-top:1.5rem;font-size:.65rem"><?php esc_html_e( 'Book Now', 'ffp-photography' ); ?></a>
            </article>

        </div>
    </div>
</section>


<!-- ============================================================
     ABOUT STRIP
============================================================ -->
<section class="section section--dark" id="about-home" aria-labelledby="about-home-heading">
    <div class="container">
        <div class="about-grid">

            <div class="about-image-wrap">
                <?php
                $about_img = get_theme_mod( 'ffp_about_image', '' );
                if ( $about_img ) :
                ?>
                <img src="<?php echo esc_url( $about_img ); ?>" alt="<?php echo esc_attr( $photographer ); ?>" loading="lazy">
                <?php else : ?>
                <div style="width:100%;aspect-ratio:4/5;background:linear-gradient(135deg,var(--clr-bg-card),var(--clr-surface));display:flex;align-items:center;justify-content:center;opacity:.5">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                </div>
                <?php endif; ?>
                <div class="about-image-accent" aria-hidden="true"></div>
            </div>

            <div class="about-text">
                <span class="section-label"><?php esc_html_e( 'The Photographer', 'ffp-photography' ); ?></span>
                <h2 class="section-title" id="about-home-heading">
                    <?php printf( esc_html__( 'Hello, I\'m %s', 'ffp-photography' ), esc_html( $photographer ) ); ?>
                </h2>
                <div class="divider" style="margin-left:0" aria-hidden="true"></div>
                <p><?php esc_html_e( 'Photography is more than a profession — it\'s a passion for preserving the fleeting magic of authentic moments. With an eye for light, emotion, and story, I craft images that you\'ll treasure for generations.', 'ffp-photography' ); ?></p>
                <p><?php esc_html_e( 'Based in the heart of the city but available worldwide, I specialise in weddings, portraits, engagements, and commercial work for brands that care about beautiful visuals.', 'ffp-photography' ); ?></p>

                <div class="about-stats">
                    <div class="stat-item">
                        <span class="stat-number"><?php echo esc_html( $years_exp ); ?>+</span>
                        <span class="stat-label"><?php esc_html_e( 'Years Exp.', 'ffp-photography' ); ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">500+</span>
                        <span class="stat-label"><?php esc_html_e( 'Sessions', 'ffp-photography' ); ?></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">98%</span>
                        <span class="stat-label"><?php esc_html_e( 'Happy Clients', 'ffp-photography' ); ?></span>
                    </div>
                </div>

                <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="btn btn-outline" style="margin-top:var(--space-md)">
                    <?php esc_html_e( 'Learn More About Me', 'ffp-photography' ); ?>
                </a>
            </div>

        </div>
    </div>
</section>


<!-- ============================================================
     TESTIMONIALS
============================================================ -->
<section class="section section--alt" id="testimonials" aria-labelledby="testimonials-heading">
    <div class="container">
        <div class="text-center" style="margin-bottom:var(--space-lg)">
            <span class="section-label"><?php esc_html_e( 'Client Love', 'ffp-photography' ); ?></span>
            <h2 class="section-title" id="testimonials-heading"><?php esc_html_e( 'What Clients Say', 'ffp-photography' ); ?></h2>
            <div class="divider" aria-hidden="true"></div>
        </div>

        <div class="testimonials-wrap">
            <div class="testimonial-slider" role="region" aria-label="<?php esc_attr_e( 'Testimonials', 'ffp-photography' ); ?>">

                <div class="testimonial-slide active" role="group" aria-roledescription="slide">
                    <p class="testimonial-text"><?php esc_html_e( '"The photos from our wedding day are absolutely breathtaking. Every detail, every glance, every tear of joy — perfectly captured. We couldn\'t be more grateful."', 'ffp-photography' ); ?></p>
                    <div class="testimonial-author">
                        <div>
                            <div class="testimonial-name"><?php esc_html_e( 'Sarah & Michael Thompson', 'ffp-photography' ); ?></div>
                            <div class="testimonial-role"><?php esc_html_e( 'Wedding, 2024', 'ffp-photography' ); ?></div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-slide" role="group" aria-roledescription="slide">
                    <p class="testimonial-text"><?php esc_html_e( '"Our brand shoot exceeded every expectation. The images completely transformed our marketing. Professional, creative, and an absolute pleasure to work with."', 'ffp-photography' ); ?></p>
                    <div class="testimonial-author">
                        <div>
                            <div class="testimonial-name"><?php esc_html_e( 'Amara Clarke', 'ffp-photography' ); ?></div>
                            <div class="testimonial-role"><?php esc_html_e( 'Commercial Client, 2024', 'ffp-photography' ); ?></div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-slide" role="group" aria-roledescription="slide">
                    <p class="testimonial-text"><?php esc_html_e( '"My portrait session felt like spending time with a friend who just happened to have an extraordinary gift. The final gallery left me speechless — truly stunning work."', 'ffp-photography' ); ?></p>
                    <div class="testimonial-author">
                        <div>
                            <div class="testimonial-name"><?php esc_html_e( 'Olivia Bennett', 'ffp-photography' ); ?></div>
                            <div class="testimonial-role"><?php esc_html_e( 'Portrait Session, 2025', 'ffp-photography' ); ?></div>
                        </div>
                    </div>
                </div>

            </div><!-- /testimonial-slider -->

            <div class="testimonial-dots" role="tablist" aria-label="<?php esc_attr_e( 'Testimonial navigation', 'ffp-photography' ); ?>">
                <button class="testimonial-dot active" data-index="0" role="tab" aria-selected="true" aria-label="<?php esc_attr_e( 'Testimonial 1', 'ffp-photography' ); ?>"></button>
                <button class="testimonial-dot" data-index="1" role="tab" aria-selected="false" aria-label="<?php esc_attr_e( 'Testimonial 2', 'ffp-photography' ); ?>"></button>
                <button class="testimonial-dot" data-index="2" role="tab" aria-selected="false" aria-label="<?php esc_attr_e( 'Testimonial 3', 'ffp-photography' ); ?>"></button>
            </div>
        </div>
    </div>
</section>


<!-- ============================================================
     BOOKING CTA SECTION
============================================================ -->
<section class="section booking-section" id="booking-cta" aria-labelledby="booking-cta-heading">
    <div class="container">
        <div class="booking-grid">

            <div class="booking-info">
                <span class="section-label"><?php esc_html_e( 'Ready to Begin?', 'ffp-photography' ); ?></span>
                <h2 id="booking-cta-heading"><?php esc_html_e( "Let's Create Something Beautiful Together", 'ffp-photography' ); ?></h2>
                <div class="divider" style="margin-left:0" aria-hidden="true"></div>
                <p><?php esc_html_e( 'Every session starts with a conversation. Fill in a few details below and we\'ll get back to you within 24 hours to discuss your vision.', 'ffp-photography' ); ?></p>
                <ul class="booking-highlights">
                    <li><?php esc_html_e( 'Free initial consultation call', 'ffp-photography' ); ?></li>
                    <li><?php esc_html_e( 'Customised packages to suit your budget', 'ffp-photography' ); ?></li>
                    <li><?php esc_html_e( 'Online gallery delivery within 4 weeks', 'ffp-photography' ); ?></li>
                    <li><?php esc_html_e( 'Print & album ordering available', 'ffp-photography' ); ?></li>
                    <li><?php esc_html_e( 'Available for travel worldwide', 'ffp-photography' ); ?></li>
                </ul>
            </div>

            <div class="booking-form-wrap">
                <h3 class="form-title"><?php esc_html_e( 'Request a Session', 'ffp-photography' ); ?></h3>
                <p class="form-subtitle"><?php esc_html_e( 'Tell us a little about your session', 'ffp-photography' ); ?></p>

                <div class="form-message" id="booking-message-home" role="alert" aria-live="polite"></div>

                <form class="ffp-booking-form" id="booking-form-home" novalidate>
                    <?php wp_nonce_field( 'ffp_booking_nonce', 'ffp_nonce_home' ); ?>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="bh-name"><?php esc_html_e( 'Your Name *', 'ffp-photography' ); ?></label>
                            <input type="text" id="bh-name" name="name" required autocomplete="name" placeholder="<?php esc_attr_e( 'Jane Smith', 'ffp-photography' ); ?>">
                        </div>
                        <div class="form-group">
                            <label for="bh-email"><?php esc_html_e( 'Email Address *', 'ffp-photography' ); ?></label>
                            <input type="email" id="bh-email" name="email" required autocomplete="email" placeholder="jane@example.com">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="bh-service"><?php esc_html_e( 'Service *', 'ffp-photography' ); ?></label>
                            <select id="bh-service" name="service" required>
                                <option value="" disabled selected><?php esc_html_e( 'Select a service', 'ffp-photography' ); ?></option>
                                <option value="Wedding Photography"><?php esc_html_e( 'Wedding Photography', 'ffp-photography' ); ?></option>
                                <option value="Engagement Shoot"><?php esc_html_e( 'Engagement Shoot', 'ffp-photography' ); ?></option>
                                <option value="Portrait Session"><?php esc_html_e( 'Portrait Session', 'ffp-photography' ); ?></option>
                                <option value="Commercial & Brand"><?php esc_html_e( 'Commercial & Brand', 'ffp-photography' ); ?></option>
                                <option value="Event Coverage"><?php esc_html_e( 'Event Coverage', 'ffp-photography' ); ?></option>
                                <option value="Other"><?php esc_html_e( 'Other', 'ffp-photography' ); ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bh-date"><?php esc_html_e( 'Event Date *', 'ffp-photography' ); ?></label>
                            <input type="date" id="bh-date" name="event_date" required min="<?php echo esc_attr( date( 'Y-m-d', strtotime( '+1 day' ) ) ); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="bh-phone"><?php esc_html_e( 'Phone Number *', 'ffp-photography' ); ?></label>
                        <input type="tel" id="bh-phone" name="phone" required autocomplete="tel" placeholder="+1 (555) 000-0000">
                    </div>

                    <div class="form-group">
                        <label for="bh-message"><?php esc_html_e( 'Tell us about your session', 'ffp-photography' ); ?></label>
                        <textarea id="bh-message" name="message" rows="3" placeholder="<?php esc_attr_e( 'Venue, vision, special requests...', 'ffp-photography' ); ?>"></textarea>
                    </div>

                    <div class="form-submit-wrap">
                        <p class="form-privacy">
                            <?php esc_html_e( 'Your information is kept private and never shared.', 'ffp-photography' ); ?>
                        </p>
                        <button type="submit" class="btn btn-primary">
                            <span class="btn-text"><?php esc_html_e( 'Send Request', 'ffp-photography' ); ?></span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>
