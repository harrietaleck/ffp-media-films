<?php
/**
 * FFP Photography Theme Functions
 *
 * @package FFP_Photography
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'FFP_THEME_VERSION', '1.0.0' );
define( 'FFP_THEME_DIR', get_template_directory() );
define( 'FFP_THEME_URI', get_template_directory_uri() );

/* ============================================================
   THEME SETUP
============================================================ */
function ffp_theme_setup() {
    load_theme_textdomain( 'ffp-photography', FFP_THEME_DIR . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list',
        'gallery', 'caption', 'style', 'script',
    ) );
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Additional image sizes
    add_image_size( 'ffp-thumb',      600,  450, true );
    add_image_size( 'ffp-large',     1200,  900, true );
    add_image_size( 'ffp-hero',      1920, 1080, true );
    add_image_size( 'ffp-square',     600,  600, true );
    add_image_size( 'ffp-portrait',   600,  800, true );

    // Navigation menus
    register_nav_menus( array(
        'primary'   => __( 'Primary Navigation', 'ffp-photography' ),
        'footer'    => __( 'Footer Navigation',  'ffp-photography' ),
        'social'    => __( 'Social Links Menu',  'ffp-photography' ),
    ) );
}
add_action( 'after_setup_theme', 'ffp_theme_setup' );

/* ============================================================
   CONTENT WIDTH
============================================================ */
function ffp_content_width() {
    $GLOBALS['content_width'] = 1280;
}
add_action( 'after_setup_theme', 'ffp_content_width', 0 );

/* ============================================================
   ENQUEUE SCRIPTS & STYLES
============================================================ */
function ffp_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style(
        'ffp-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Montserrat:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );

    // Main stylesheet (style.css = theme header)
    wp_enqueue_style(
        'ffp-main',
        FFP_THEME_URI . '/assets/css/main.css',
        array( 'ffp-fonts' ),
        FFP_THEME_VERSION
    );

    // Main JS
    wp_enqueue_script(
        'ffp-main',
        FFP_THEME_URI . '/assets/js/main.js',
        array(),
        FFP_THEME_VERSION,
        true
    );

    // Localize script for AJAX
    wp_localize_script( 'ffp-main', 'ffpData', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'ffp_booking_nonce' ),
        'siteUrl' => get_site_url(),
        'i18n'    => array(
            'bookingSuccess' => __( 'Your booking request has been submitted! We will be in touch within 24 hours.', 'ffp-photography' ),
            'bookingError'   => __( 'Something went wrong. Please try again or contact us directly.', 'ffp-photography' ),
            'sending'        => __( 'Sending...', 'ffp-photography' ),
            'required'       => __( 'Please fill in all required fields.', 'ffp-photography' ),
        ),
    ) );

    // Comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'ffp_enqueue_assets' );

/* ============================================================
   CUSTOM POST TYPE: PORTFOLIO
============================================================ */
function ffp_register_post_types() {
    $labels = array(
        'name'               => __( 'Portfolio',         'ffp-photography' ),
        'singular_name'      => __( 'Portfolio Item',    'ffp-photography' ),
        'add_new'            => __( 'Add New',           'ffp-photography' ),
        'add_new_item'       => __( 'Add New Portfolio Item', 'ffp-photography' ),
        'edit_item'          => __( 'Edit Portfolio Item', 'ffp-photography' ),
        'view_item'          => __( 'View Portfolio Item', 'ffp-photography' ),
        'all_items'          => __( 'All Portfolio Items', 'ffp-photography' ),
        'search_items'       => __( 'Search Portfolio',  'ffp-photography' ),
        'not_found'          => __( 'No portfolio items found.', 'ffp-photography' ),
        'not_found_in_trash' => __( 'No portfolio items found in trash.', 'ffp-photography' ),
    );

    register_post_type( 'ffp_portfolio', array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'portfolio' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-camera',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'taxonomies'         => array( 'ffp_category', 'ffp_tag' ),
    ) );
}
add_action( 'init', 'ffp_register_post_types' );

/* ============================================================
   CUSTOM TAXONOMIES
============================================================ */
function ffp_register_taxonomies() {
    // Portfolio Category
    register_taxonomy( 'ffp_category', array( 'ffp_portfolio' ), array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'              => __( 'Portfolio Categories', 'ffp-photography' ),
            'singular_name'     => __( 'Category',            'ffp-photography' ),
            'add_new_item'      => __( 'Add New Category',    'ffp-photography' ),
        ),
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'rewrite'           => array( 'slug' => 'portfolio-category' ),
    ) );

    // Portfolio Tag
    register_taxonomy( 'ffp_tag', array( 'ffp_portfolio' ), array(
        'hierarchical'  => false,
        'labels'        => array(
            'name'          => __( 'Portfolio Tags', 'ffp-photography' ),
            'singular_name' => __( 'Tag',            'ffp-photography' ),
        ),
        'show_ui'       => true,
        'show_in_rest'  => true,
        'rewrite'       => array( 'slug' => 'portfolio-tag' ),
    ) );
}
add_action( 'init', 'ffp_register_taxonomies' );

/* ============================================================
   CUSTOM POST TYPE: BOOKINGS (admin only)
============================================================ */
function ffp_register_booking_post_type() {
    register_post_type( 'ffp_booking', array(
        'labels'        => array(
            'name'          => __( 'Bookings',    'ffp-photography' ),
            'singular_name' => __( 'Booking',     'ffp-photography' ),
            'all_items'     => __( 'All Bookings', 'ffp-photography' ),
            'view_item'     => __( 'View Booking', 'ffp-photography' ),
        ),
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-calendar-alt',
        'supports'           => array( 'title', 'custom-fields' ),
    ) );
}
add_action( 'init', 'ffp_register_booking_post_type' );

/* ============================================================
   AJAX BOOKING HANDLER
============================================================ */
function ffp_handle_booking_submission() {
    check_ajax_referer( 'ffp_booking_nonce', 'nonce' );

    $required_fields = array( 'name', 'email', 'phone', 'service', 'event_date' );
    foreach ( $required_fields as $field ) {
        if ( empty( $_POST[ $field ] ) ) {
            wp_send_json_error( array(
                'message' => __( 'Please fill in all required fields.', 'ffp-photography' ),
            ) );
        }
    }

    // Sanitize
    $name        = sanitize_text_field( $_POST['name'] );
    $email       = sanitize_email( $_POST['email'] );
    $phone       = sanitize_text_field( $_POST['phone'] );
    $service     = sanitize_text_field( $_POST['service'] );
    $event_date  = sanitize_text_field( $_POST['event_date'] );
    $event_type  = sanitize_text_field( $_POST['event_type'] ?? '' );
    $location    = sanitize_text_field( $_POST['location'] ?? '' );
    $guests      = sanitize_text_field( $_POST['guests'] ?? '' );
    $package     = sanitize_text_field( $_POST['package'] ?? '' );
    $message     = sanitize_textarea_field( $_POST['message'] ?? '' );
    $how_found   = sanitize_text_field( $_POST['how_found'] ?? '' );

    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => __( 'Please enter a valid email address.', 'ffp-photography' ) ) );
    }

    // Save as a custom post
    $post_title   = sprintf( '%s — %s (%s)', $service, $name, $event_date );
    $booking_id   = wp_insert_post( array(
        'post_type'   => 'ffp_booking',
        'post_title'  => $post_title,
        'post_status' => 'publish',
    ) );

    if ( is_wp_error( $booking_id ) ) {
        wp_send_json_error( array( 'message' => __( 'Could not save booking. Please try again.', 'ffp-photography' ) ) );
    }

    // Store meta
    $meta = compact( 'name', 'email', 'phone', 'service', 'event_date', 'event_type', 'location', 'guests', 'package', 'message', 'how_found' );
    foreach ( $meta as $key => $value ) {
        update_post_meta( $booking_id, '_ffp_' . $key, $value );
    }
    update_post_meta( $booking_id, '_ffp_status', 'pending' );
    update_post_meta( $booking_id, '_ffp_submitted', current_time( 'mysql' ) );

    // Email to admin
    $admin_email   = get_option( 'admin_email' );
    $subject_admin = sprintf( __( 'New Booking Request: %s — %s', 'ffp-photography' ), $service, $name );
    $body_admin    = ffp_booking_email_body( $meta, $booking_id );
    wp_mail( $admin_email, $subject_admin, $body_admin, ffp_email_headers() );

    // Confirmation email to client
    $subject_client = __( 'Your Booking Request — FFP Photography', 'ffp-photography' );
    $body_client    = ffp_client_confirmation_email( $meta );
    wp_mail( $email, $subject_client, $body_client, ffp_email_headers() );

    wp_send_json_success( array(
        'message'    => __( 'Thank you! Your booking request has been received. We\'ll be in touch within 24 hours.', 'ffp-photography' ),
        'booking_id' => $booking_id,
    ) );
}
add_action( 'wp_ajax_ffp_booking',        'ffp_handle_booking_submission' );
add_action( 'wp_ajax_nopriv_ffp_booking', 'ffp_handle_booking_submission' );

/* ============================================================
   EMAIL HELPERS
============================================================ */
function ffp_email_headers() {
    return array(
        'Content-Type: text/html; charset=UTF-8',
        'From: FFP Photography <' . get_option( 'admin_email' ) . '>',
    );
}

function ffp_booking_email_body( array $data, int $booking_id ) : string {
    $edit_link = admin_url( 'post.php?post=' . $booking_id . '&action=edit' );
    ob_start(); ?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><style>
body{font-family:Georgia,serif;background:#0a0a0a;color:#c8c2b8;margin:0;padding:0}
.wrap{max-width:600px;margin:40px auto;background:#161616;border:1px solid #2a2a2a}
.header{background:#0a0a0a;padding:32px;border-bottom:1px solid #2a2a2a;text-align:center}
.header h1{font-size:1.6rem;color:#c9a84c;letter-spacing:.2em;margin:0}
.body{padding:32px}
.row{display:flex;gap:12px;margin-bottom:12px;border-bottom:1px solid #2a2a2a;padding-bottom:12px}
.label{color:#7a746c;font-size:.8rem;letter-spacing:.15em;text-transform:uppercase;min-width:120px}
.value{color:#f0ece4;font-size:.9rem}
.btn{display:inline-block;background:#c9a84c;color:#0a0a0a;padding:12px 24px;text-decoration:none;font-family:Montserrat,sans-serif;font-size:.75rem;font-weight:700;letter-spacing:.2em;text-transform:uppercase;margin-top:16px}
.footer{padding:20px 32px;background:#0a0a0a;border-top:1px solid #2a2a2a;font-size:.75rem;color:#7a746c}
</style></head>
<body>
<div class="wrap">
    <div class="header"><h1>FFP Photography</h1><p style="color:#7a746c;font-size:.75rem;letter-spacing:.2em;text-transform:uppercase;margin:8px 0 0">New Booking Request</p></div>
    <div class="body">
        <?php foreach ( $data as $k => $v ) : if ( empty( $v ) ) continue; ?>
        <div class="row"><span class="label"><?php echo esc_html( ucwords( str_replace('_',' ',$k) ) ); ?></span><span class="value"><?php echo esc_html( $v ); ?></span></div>
        <?php endforeach; ?>
        <a href="<?php echo esc_url( $edit_link ); ?>" class="btn">View Booking in Admin</a>
    </div>
    <div class="footer">FFP Photography &mdash; Booking ID #<?php echo esc_html( $booking_id ); ?></div>
</div>
</body></html>
<?php return ob_get_clean();
}

function ffp_client_confirmation_email( array $data ) : string {
    ob_start(); ?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><style>
body{font-family:Georgia,serif;background:#0a0a0a;color:#c8c2b8;margin:0;padding:0}
.wrap{max-width:600px;margin:40px auto;background:#161616;border:1px solid #2a2a2a}
.header{background:#0a0a0a;padding:32px;border-bottom:1px solid #2a2a2a;text-align:center}
.header h1{font-size:1.6rem;color:#c9a84c;letter-spacing:.2em;margin:0}
.body{padding:32px}
.body p{line-height:1.8;margin-bottom:16px}
.highlight{color:#c9a84c}
.footer{padding:20px 32px;background:#0a0a0a;border-top:1px solid #2a2a2a;font-size:.75rem;color:#7a746c}
</style></head>
<body>
<div class="wrap">
    <div class="header"><h1>FFP Photography</h1><p style="color:#7a746c;font-size:.75rem;letter-spacing:.2em;text-transform:uppercase;margin:8px 0 0">Booking Confirmation</p></div>
    <div class="body">
        <p>Dear <span class="highlight"><?php echo esc_html( $data['name'] ); ?></span>,</p>
        <p>Thank you for reaching out to FFP Photography! We have received your booking inquiry for <span class="highlight"><?php echo esc_html( $data['service'] ); ?></span> on <span class="highlight"><?php echo esc_html( $data['event_date'] ); ?></span>.</p>
        <p>We will review your request and get back to you within <strong>24 hours</strong> to discuss availability, details, and next steps.</p>
        <p>If you need to reach us sooner, please reply to this email or give us a call.</p>
        <p>We look forward to capturing your special moments!</p>
        <p>Warm regards,<br><span class="highlight">The FFP Photography Team</span></p>
    </div>
    <div class="footer">&copy; <?php echo date('Y'); ?> FFP Photography. All rights reserved.</div>
</div>
</body></html>
<?php return ob_get_clean();
}

/* ============================================================
   ADMIN: BOOKING LIST COLUMNS
============================================================ */
function ffp_booking_columns( $columns ) {
    return array(
        'cb'         => $columns['cb'],
        'title'      => __( 'Booking', 'ffp-photography' ),
        'client'     => __( 'Client', 'ffp-photography' ),
        'email'      => __( 'Email', 'ffp-photography' ),
        'service'    => __( 'Service', 'ffp-photography' ),
        'event_date' => __( 'Event Date', 'ffp-photography' ),
        'status'     => __( 'Status', 'ffp-photography' ),
        'date'       => __( 'Submitted', 'ffp-photography' ),
    );
}
add_filter( 'manage_ffp_booking_posts_columns', 'ffp_booking_columns' );

function ffp_booking_column_content( $column, $post_id ) {
    switch ( $column ) {
        case 'client':
            echo esc_html( get_post_meta( $post_id, '_ffp_name', true ) );
            break;
        case 'email':
            $email = get_post_meta( $post_id, '_ffp_email', true );
            echo '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>';
            break;
        case 'service':
            echo esc_html( get_post_meta( $post_id, '_ffp_service', true ) );
            break;
        case 'event_date':
            echo esc_html( get_post_meta( $post_id, '_ffp_event_date', true ) );
            break;
        case 'status':
            $status = get_post_meta( $post_id, '_ffp_status', true ) ?: 'pending';
            $colors = array( 'pending' => '#c9a84c', 'confirmed' => '#4cc978', 'completed' => '#4c8cc9', 'cancelled' => '#c94c4c' );
            $color  = $colors[ $status ] ?? '#7a746c';
            printf( '<span style="color:%s;font-weight:600;text-transform:uppercase;font-size:.75rem;letter-spacing:.1em">%s</span>', esc_attr( $color ), esc_html( $status ) );
            break;
    }
}
add_action( 'manage_ffp_booking_posts_custom_column', 'ffp_booking_column_content', 10, 2 );

/* ============================================================
   WIDGETS / SIDEBARS
============================================================ */
function ffp_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Blog Sidebar', 'ffp-photography' ),
        'id'            => 'sidebar-blog',
        'description'   => __( 'Widgets in this area will appear in the blog sidebar.', 'ffp-photography' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'ffp_widgets_init' );

/* ============================================================
   CUSTOMIZER OPTIONS
============================================================ */
function ffp_customizer( $wp_customize ) {
    // Section: Photography Info
    $wp_customize->add_section( 'ffp_photography', array(
        'title'    => __( 'Photography Settings', 'ffp-photography' ),
        'priority' => 30,
    ) );

    // Hero tagline
    $wp_customize->add_setting( 'ffp_hero_tagline', array( 'default' => 'Capturing Life\'s Most Precious Moments' ) );
    $wp_customize->add_control( 'ffp_hero_tagline', array(
        'label'   => __( 'Hero Tagline', 'ffp-photography' ),
        'section' => 'ffp_photography',
        'type'    => 'textarea',
    ) );

    // Photographer name
    $wp_customize->add_setting( 'ffp_photographer_name', array( 'default' => 'FFP Photography' ) );
    $wp_customize->add_control( 'ffp_photographer_name', array(
        'label'   => __( 'Photographer Name', 'ffp-photography' ),
        'section' => 'ffp_photography',
        'type'    => 'text',
    ) );

    // Instagram handle
    $wp_customize->add_setting( 'ffp_instagram', array( 'default' => '' ) );
    $wp_customize->add_control( 'ffp_instagram', array(
        'label'   => __( 'Instagram Handle (without @)', 'ffp-photography' ),
        'section' => 'ffp_photography',
        'type'    => 'text',
    ) );

    // Phone
    $wp_customize->add_setting( 'ffp_phone', array( 'default' => '' ) );
    $wp_customize->add_control( 'ffp_phone', array(
        'label'   => __( 'Phone Number', 'ffp-photography' ),
        'section' => 'ffp_photography',
        'type'    => 'text',
    ) );

    // Years of experience
    $wp_customize->add_setting( 'ffp_years_exp', array( 'default' => '8' ) );
    $wp_customize->add_control( 'ffp_years_exp', array(
        'label'   => __( 'Years of Experience', 'ffp-photography' ),
        'section' => 'ffp_photography',
        'type'    => 'number',
    ) );
}
add_action( 'customize_register', 'ffp_customizer' );

/* ============================================================
   HELPER: GET PORTFOLIO ITEMS
============================================================ */
function ffp_get_portfolio_items( $args = array() ) {
    $defaults = array(
        'post_type'      => 'ffp_portfolio',
        'post_status'    => 'publish',
        'posts_per_page' => 12,
        'orderby'        => 'menu_order date',
        'order'          => 'ASC',
    );
    return get_posts( wp_parse_args( $args, $defaults ) );
}

/* ============================================================
   HELPER: RENDER GALLERY ITEM
============================================================ */
function ffp_render_gallery_item( $post, $class = '' ) {
    $id       = $post->ID;
    $title    = get_the_title( $id );
    $img_id   = get_post_thumbnail_id( $id );
    $img_url  = $img_id ? wp_get_attachment_image_url( $img_id, 'ffp-large' ) : FFP_THEME_URI . '/assets/images/placeholder.jpg';
    $img_full = $img_id ? wp_get_attachment_image_url( $img_id, 'full' ) : $img_url;
    $cats     = get_the_terms( $id, 'ffp_category' );
    $cat_name = $cats && ! is_wp_error( $cats ) ? $cats[0]->name : '';
    ?>
    <div class="gallery-item <?php echo esc_attr( $class ); ?>" data-lightbox="<?php echo esc_url( $img_full ); ?>" data-caption="<?php echo esc_attr( $title ); ?>">
        <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy">
        <div class="gallery-item-overlay">
            <div class="gallery-item-info">
                <h3><?php echo esc_html( $title ); ?></h3>
                <?php if ( $cat_name ) : ?>
                    <span><?php echo esc_html( $cat_name ); ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
}

/* ============================================================
   EXCERPT LENGTH
============================================================ */
function ffp_excerpt_length( $length ) { return 20; }
add_filter( 'excerpt_length', 'ffp_excerpt_length' );

function ffp_excerpt_more( $more ) { return '&hellip;'; }
add_filter( 'excerpt_more', 'ffp_excerpt_more' );

/* ============================================================
   BODY CLASSES
============================================================ */
function ffp_body_classes( $classes ) {
    if ( is_front_page() ) $classes[] = 'is-front-page';
    if ( is_page( 'portfolio' ) || is_post_type_archive( 'ffp_portfolio' ) ) $classes[] = 'is-portfolio';
    if ( is_page( 'booking' ) ) $classes[] = 'is-booking';
    return $classes;
}
add_filter( 'body_class', 'ffp_body_classes' );

/* ============================================================
   DISABLE ADMIN BAR FOR NON-ADMINS (cleaner front-end)
============================================================ */
function ffp_remove_admin_bar() {
    if ( ! current_user_can( 'administrator' ) ) {
        show_admin_bar( false );
    }
}
add_action( 'after_setup_theme', 'ffp_remove_admin_bar' );

/* ============================================================
   REMOVE EMOJI SCRIPTS (performance)
============================================================ */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/* ============================================================
   LOAD INC FILES
============================================================ */
$inc_files = array(
    '/inc/booking-meta-boxes.php',
);

foreach ( $inc_files as $file ) {
    $path = FFP_THEME_DIR . $file;
    if ( file_exists( $path ) ) {
        require_once $path;
    }
}
