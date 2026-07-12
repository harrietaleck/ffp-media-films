<?php
/**
 * Template Name: Booking
 *
 * @package FFP_Photography
 */
get_header();

$packages = array(
    array(
        'id'       => 'essential',
        'name'     => __( 'Essential', 'ffp-photography' ),
        'price'    => '$450',
        'desc'     => __( '2hr session · 40+ edited images · online gallery', 'ffp-photography' ),
        'featured' => false,
    ),
    array(
        'id'       => 'signature',
        'name'     => __( 'Signature', 'ffp-photography' ),
        'price'    => '$950',
        'desc'     => __( '4hr session · 100+ images · gallery + USB drive', 'ffp-photography' ),
        'featured' => true,
    ),
    array(
        'id'       => 'premium',
        'name'     => __( 'Premium', 'ffp-photography' ),
        'price'    => '$1,800',
        'desc'     => __( 'Full day · 300+ images · album + prints + video', 'ffp-photography' ),
        'featured' => false,
    ),
);
?>

<!-- Page Hero -->
<section class="page-hero" aria-labelledby="booking-page-title">
    <div class="container">
        <nav class="breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'ffp-photography' ); ?>">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'ffp-photography' ); ?></a>
            <span class="breadcrumb-sep" aria-hidden="true">/</span>
            <span><?php esc_html_e( 'Book a Session', 'ffp-photography' ); ?></span>
        </nav>
        <span class="section-label"><?php esc_html_e( 'Let\'s Connect', 'ffp-photography' ); ?></span>
        <h1 class="page-hero-title" id="booking-page-title"><?php esc_html_e( 'Book a Session', 'ffp-photography' ); ?></h1>
        <div class="divider" aria-hidden="true"></div>
        <p class="section-subtitle">
            <?php esc_html_e( 'Every great photograph starts with a conversation. Share your vision and we\'ll make it happen.', 'ffp-photography' ); ?>
        </p>
    </div>
</section>

<!-- Booking Form Section -->
<section class="section section--dark" id="booking-main">
    <div class="container">
        <div class="booking-page-grid">

            <!-- Left: Packages + Form -->
            <div class="booking-main-col">

                <!-- Package Selection -->
                <div style="margin-bottom:var(--space-lg)">
                    <span class="section-label"><?php esc_html_e( 'Step 1 — Choose a Package', 'ffp-photography' ); ?></span>
                    <h2 style="font-family:var(--font-serif);font-size:1.8rem;margin-bottom:1rem;color:var(--clr-off-white)"><?php esc_html_e( 'Select Your Package', 'ffp-photography' ); ?></h2>
                    <div class="booking-packages" id="package-selection">
                        <?php foreach ( $packages as $pkg ) : ?>
                        <div class="package-card <?php echo $pkg['featured'] ? 'featured selected' : ''; ?>" data-package="<?php echo esc_attr( $pkg['id'] ); ?>">
                            <?php if ( $pkg['featured'] ) : ?>
                            <span class="package-badge"><?php esc_html_e( 'Most Popular', 'ffp-photography' ); ?></span>
                            <?php endif; ?>
                            <div>
                                <div class="package-name"><?php echo esc_html( $pkg['name'] ); ?></div>
                                <div class="package-desc"><?php echo esc_html( $pkg['desc'] ); ?></div>
                            </div>
                            <div class="package-price"><?php echo esc_html( $pkg['price'] ); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Booking Form -->
                <div>
                    <span class="section-label"><?php esc_html_e( 'Step 2 — Your Details', 'ffp-photography' ); ?></span>
                    <h2 style="font-family:var(--font-serif);font-size:1.8rem;margin-bottom:1.5rem;color:var(--clr-off-white)"><?php esc_html_e( 'Tell Us About Your Session', 'ffp-photography' ); ?></h2>

                    <div class="form-message" id="booking-message-page" role="alert" aria-live="polite"></div>

                    <form class="ffp-booking-form" id="booking-form-page" novalidate>
                        <?php wp_nonce_field( 'ffp_booking_nonce', 'ffp_nonce_page' ); ?>
                        <input type="hidden" name="package" id="selected-package" value="Signature">

                        <div class="form-row">
                            <div class="form-group">
                                <label for="bp-first-name"><?php esc_html_e( 'First Name *', 'ffp-photography' ); ?></label>
                                <input type="text" id="bp-first-name" name="first_name" required autocomplete="given-name" placeholder="Jane">
                            </div>
                            <div class="form-group">
                                <label for="bp-last-name"><?php esc_html_e( 'Last Name *', 'ffp-photography' ); ?></label>
                                <input type="text" id="bp-last-name" name="last_name" required autocomplete="family-name" placeholder="Smith">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="bp-email"><?php esc_html_e( 'Email Address *', 'ffp-photography' ); ?></label>
                                <input type="email" id="bp-email" name="email" required autocomplete="email" placeholder="jane@example.com">
                            </div>
                            <div class="form-group">
                                <label for="bp-phone"><?php esc_html_e( 'Phone Number *', 'ffp-photography' ); ?></label>
                                <input type="tel" id="bp-phone" name="phone" required autocomplete="tel" placeholder="+1 (555) 000-0000">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="bp-service"><?php esc_html_e( 'Service Type *', 'ffp-photography' ); ?></label>
                                <select id="bp-service" name="service" required>
                                    <option value="" disabled selected><?php esc_html_e( 'Select a service', 'ffp-photography' ); ?></option>
                                    <?php
                                    $services = array(
                                        'Wedding Photography',
                                        'Engagement Shoot',
                                        'Portrait Session',
                                        'Family Photography',
                                        'Maternity & Newborn',
                                        'Commercial & Brand',
                                        'Event Coverage',
                                        'Boudoir Photography',
                                        'Fashion Editorial',
                                        'Other',
                                    );
                                    $preset = isset( $_GET['service'] ) ? sanitize_text_field( $_GET['service'] ) : '';
                                    foreach ( $services as $svc ) :
                                    ?>
                                    <option value="<?php echo esc_attr( $svc ); ?>" <?php selected( $preset, $svc ); ?>>
                                        <?php echo esc_html( $svc ); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="bp-event-date"><?php esc_html_e( 'Preferred Date *', 'ffp-photography' ); ?></label>
                                <input type="date" id="bp-event-date" name="event_date" required min="<?php echo esc_attr( date( 'Y-m-d', strtotime( '+1 day' ) ) ); ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="bp-event-type"><?php esc_html_e( 'Event / Session Type', 'ffp-photography' ); ?></label>
                                <input type="text" id="bp-event-type" name="event_type" placeholder="<?php esc_attr_e( 'e.g. Outdoor, Studio, Church', 'ffp-photography' ); ?>">
                            </div>
                            <div class="form-group">
                                <label for="bp-location"><?php esc_html_e( 'Location / Venue', 'ffp-photography' ); ?></label>
                                <input type="text" id="bp-location" name="location" autocomplete="address-level2" placeholder="<?php esc_attr_e( 'City or specific venue', 'ffp-photography' ); ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="bp-guests"><?php esc_html_e( 'Number of Guests / Subjects', 'ffp-photography' ); ?></label>
                                <input type="number" id="bp-guests" name="guests" min="1" max="9999" placeholder="<?php esc_attr_e( 'e.g. 120', 'ffp-photography' ); ?>">
                            </div>
                            <div class="form-group">
                                <label for="bp-how-found"><?php esc_html_e( 'How Did You Find Us?', 'ffp-photography' ); ?></label>
                                <select id="bp-how-found" name="how_found">
                                    <option value=""><?php esc_html_e( 'Select...', 'ffp-photography' ); ?></option>
                                    <option value="Instagram"><?php esc_html_e( 'Instagram', 'ffp-photography' ); ?></option>
                                    <option value="Google"><?php esc_html_e( 'Google Search', 'ffp-photography' ); ?></option>
                                    <option value="Referral"><?php esc_html_e( 'Friend / Family Referral', 'ffp-photography' ); ?></option>
                                    <option value="Facebook"><?php esc_html_e( 'Facebook', 'ffp-photography' ); ?></option>
                                    <option value="Pinterest"><?php esc_html_e( 'Pinterest', 'ffp-photography' ); ?></option>
                                    <option value="Wedding Website"><?php esc_html_e( 'Wedding Website', 'ffp-photography' ); ?></option>
                                    <option value="Other"><?php esc_html_e( 'Other', 'ffp-photography' ); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bp-message"><?php esc_html_e( 'Your Vision & Special Requests', 'ffp-photography' ); ?></label>
                            <textarea id="bp-message" name="message" rows="5" placeholder="<?php esc_attr_e( 'Tell us about your dream shoot — mood, style, must-have shots, inspiration images, any special requirements...', 'ffp-photography' ); ?>"></textarea>
                        </div>

                        <div class="form-submit-wrap">
                            <p class="form-privacy">
                                <?php
                                printf(
                                    wp_kses(
                                        __( 'By submitting this form you agree to our <a href="%s">Privacy Policy</a>.', 'ffp-photography' ),
                                        array( 'a' => array( 'href' => array() ) )
                                    ),
                                    esc_url( home_url( '/privacy-policy' ) )
                                );
                                ?>
                            </p>
                            <button type="submit" class="btn btn-primary">
                                <span class="btn-text"><?php esc_html_e( 'Submit Booking Request', 'ffp-photography' ); ?></span>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </button>
                        </div>
                    </form>
                </div>

            </div><!-- /booking-main-col -->

            <!-- Right: Summary Sidebar -->
            <div class="booking-sidebar">

                <div class="booking-summary" id="booking-summary">
                    <h3><?php esc_html_e( 'Booking Summary', 'ffp-photography' ); ?></h3>
                    <div class="summary-row">
                        <span class="summary-label"><?php esc_html_e( 'Package', 'ffp-photography' ); ?></span>
                        <span class="summary-value" id="summary-package"><?php esc_html_e( 'Signature', 'ffp-photography' ); ?></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label"><?php esc_html_e( 'Service', 'ffp-photography' ); ?></span>
                        <span class="summary-value" id="summary-service"><?php esc_html_e( '—', 'ffp-photography' ); ?></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label"><?php esc_html_e( 'Date', 'ffp-photography' ); ?></span>
                        <span class="summary-value" id="summary-date"><?php esc_html_e( '—', 'ffp-photography' ); ?></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label"><?php esc_html_e( 'Location', 'ffp-photography' ); ?></span>
                        <span class="summary-value" id="summary-location"><?php esc_html_e( '—', 'ffp-photography' ); ?></span>
                    </div>
                    <div class="summary-row summary-total">
                        <span class="summary-label"><?php esc_html_e( 'Starting From', 'ffp-photography' ); ?></span>
                        <span class="summary-value" id="summary-price">$950</span>
                    </div>
                </div>

                <!-- What to Expect -->
                <div style="background:var(--clr-bg-card);border:1px solid var(--clr-border);padding:1.5rem;margin-top:var(--space-sm)">
                    <h4 style="font-family:var(--font-serif);font-size:1.1rem;margin-bottom:1rem;color:var(--clr-off-white)"><?php esc_html_e( 'What Happens Next', 'ffp-photography' ); ?></h4>
                    <ol style="list-style:none;padding:0;margin:0;counter-reset:steps">
                        <?php
                        $steps = array(
                            __( 'We receive your request and review availability.', 'ffp-photography' ),
                            __( 'You\'ll hear back within 24 hours to confirm details.', 'ffp-photography' ),
                            __( 'A booking contract & invoice will be sent to you.', 'ffp-photography' ),
                            __( 'A 25% deposit secures your date.', 'ffp-photography' ),
                            __( 'We create magic together on the day!', 'ffp-photography' ),
                        );
                        foreach ( $steps as $i => $step ) :
                        ?>
                        <li style="display:flex;gap:.75rem;margin-bottom:.75rem;font-size:.875rem;color:var(--clr-text);counter-increment:steps">
                            <span style="width:22px;height:22px;border-radius:50%;border:1px solid var(--clr-gold);color:var(--clr-gold);font-size:.65rem;font-weight:700;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0"><?php echo esc_html( $i + 1 ); ?></span>
                            <?php echo esc_html( $step ); ?>
                        </li>
                        <?php endforeach; ?>
                    </ol>
                </div>

                <!-- Contact direct -->
                <div style="margin-top:var(--space-sm);text-align:center">
                    <p style="font-size:.8rem;color:var(--clr-text-muted);margin-bottom:.5rem"><?php esc_html_e( 'Prefer to talk first?', 'ffp-photography' ); ?></p>
                    <?php $phone = get_theme_mod( 'ffp_phone', '' ); if ( $phone ) : ?>
                    <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>" class="btn btn-ghost" style="width:100%;justify-content:center">
                        <?php echo esc_html( $phone ); ?>
                    </a>
                    <?php else : ?>
                    <a href="mailto:<?php echo esc_attr( get_option( 'admin_email' ) ); ?>" class="btn btn-ghost" style="width:100%;justify-content:center">
                        <?php esc_html_e( 'Email Us Directly', 'ffp-photography' ); ?>
                    </a>
                    <?php endif; ?>
                </div>

            </div><!-- /booking-sidebar -->

        </div><!-- /booking-page-grid -->
    </div>
</section>

<?php get_footer(); ?>
