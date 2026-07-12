<?php
/**
 * Template Name: Portfolio
 *
 * @package FFP_Photography
 */
get_header();

// Get all portfolio categories for filter bar
$categories = get_terms( array(
    'taxonomy' => 'ffp_category',
    'hide_empty' => true,
) );

// Get all portfolio items
$portfolio_items = ffp_get_portfolio_items( array( 'posts_per_page' => -1 ) );
?>

<!-- Page Hero -->
<section class="page-hero" aria-labelledby="portfolio-page-title">
    <div class="container">
        <nav class="breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'ffp-photography' ); ?>">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'ffp-photography' ); ?></a>
            <span class="breadcrumb-sep" aria-hidden="true">/</span>
            <span><?php esc_html_e( 'Portfolio', 'ffp-photography' ); ?></span>
        </nav>
        <span class="section-label"><?php esc_html_e( 'The Work', 'ffp-photography' ); ?></span>
        <h1 class="page-hero-title" id="portfolio-page-title"><?php esc_html_e( 'Portfolio', 'ffp-photography' ); ?></h1>
        <div class="divider" aria-hidden="true"></div>
        <p class="section-subtitle">
            <?php esc_html_e( 'A curated collection of weddings, portraits, engagements, and commercial work — each image a story in itself.', 'ffp-photography' ); ?>
        </p>
    </div>
</section>

<!-- Portfolio Gallery -->
<section class="section section--dark" id="portfolio-gallery">
    <div class="container container--wide">

        <!-- Category Filter -->
        <?php if ( $categories && ! is_wp_error( $categories ) ) : ?>
        <div class="filter-bar" role="group" aria-label="<?php esc_attr_e( 'Filter by category', 'ffp-photography' ); ?>">
            <button class="filter-btn active" data-filter="all"><?php esc_html_e( 'All', 'ffp-photography' ); ?></button>
            <?php foreach ( $categories as $cat ) : ?>
            <button class="filter-btn" data-filter="<?php echo esc_attr( $cat->slug ); ?>">
                <?php echo esc_html( $cat->name ); ?>
                <span style="opacity:.5;font-size:.8em;margin-left:4px">(<?php echo esc_html( $cat->count ); ?>)</span>
            </button>
            <?php endforeach; ?>
        </div>
        <?php else : ?>
        <!-- Demo filter bar -->
        <div class="filter-bar" role="group" aria-label="<?php esc_attr_e( 'Filter by category', 'ffp-photography' ); ?>">
            <button class="filter-btn active" data-filter="all"><?php esc_html_e( 'All', 'ffp-photography' ); ?></button>
            <button class="filter-btn" data-filter="weddings"><?php esc_html_e( 'Weddings', 'ffp-photography' ); ?></button>
            <button class="filter-btn" data-filter="portraits"><?php esc_html_e( 'Portraits', 'ffp-photography' ); ?></button>
            <button class="filter-btn" data-filter="engagements"><?php esc_html_e( 'Engagements', 'ffp-photography' ); ?></button>
            <button class="filter-btn" data-filter="commercial"><?php esc_html_e( 'Commercial', 'ffp-photography' ); ?></button>
            <button class="filter-btn" data-filter="events"><?php esc_html_e( 'Events', 'ffp-photography' ); ?></button>
        </div>
        <?php endif; ?>

        <!-- Masonry Grid -->
        <?php if ( $portfolio_items ) : ?>
        <div class="portfolio-masonry" id="portfolio-masonry" role="list">
            <?php
            foreach ( $portfolio_items as $item ) {
                setup_postdata( $item );
                $cats     = get_the_terms( $item->ID, 'ffp_category' );
                $cat_slugs = array();
                if ( $cats && ! is_wp_error( $cats ) ) {
                    $cat_slugs = wp_list_pluck( $cats, 'slug' );
                }
                $data_cats = implode( ' ', $cat_slugs );
                ffp_render_gallery_item( $item, '' );
            }
            wp_reset_postdata();
            ?>
        </div>
        <?php else : ?>
        <!-- Demo placeholders -->
        <div class="portfolio-masonry" id="portfolio-masonry" role="list">
            <?php
            $demo = array(
                array( 'Wedding Ceremony', 'Weddings', '#1a1509' ),
                array( 'Portrait Session', 'Portraits', '#091213' ),
                array( 'Golden Hour Engagement', 'Engagements', '#130d09' ),
                array( 'Brand Editorial', 'Commercial', '#0d0d13' ),
                array( 'Outdoor Wedding', 'Weddings', '#091309' ),
                array( 'Family Portrait', 'Portraits', '#130913' ),
                array( 'Sunset Engagement', 'Engagements', '#131209' ),
                array( 'Corporate Event', 'Events', '#09090d' ),
                array( 'Bridal Detail', 'Weddings', '#130909' ),
                array( 'Lifestyle Shoot', 'Portraits', '#090d09' ),
                array( 'Beach Engagement', 'Engagements', '#09130d' ),
                array( 'Product Commercial', 'Commercial', '#0d0913' ),
            );
            foreach ( $demo as $i => $d ) :
            ?>
            <div class="gallery-item" style="background:<?php echo esc_attr( $d[2] ); ?>;margin-bottom:4px;height:<?php echo ($i % 3 === 0) ? '380px' : '280px'; ?>">
                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;opacity:.3">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
                <div class="gallery-item-overlay" style="opacity:1">
                    <div class="gallery-item-info">
                        <h3><?php echo esc_html( $d[0] ); ?></h3>
                        <span><?php echo esc_html( $d[1] ); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Load More -->
        <div class="text-center" style="margin-top:var(--space-lg)">
            <button class="btn btn-ghost" id="portfolio-load-more" style="display:none">
                <?php esc_html_e( 'Load More', 'ffp-photography' ); ?>
            </button>
        </div>

    </div>
</section>

<!-- CTA -->
<section class="section section--alt" style="padding-block:var(--space-lg)">
    <div class="container text-center">
        <h2 style="font-size:clamp(1.8rem,4vw,2.8rem);margin-bottom:1rem"><?php esc_html_e( 'Like What You See?', 'ffp-photography' ); ?></h2>
        <p style="color:var(--clr-text-muted);margin-bottom:2rem;max-width:480px;margin-inline:auto">
            <?php esc_html_e( "Let's create images that you'll cherish forever. Get in touch to start your journey.", 'ffp-photography' ); ?>
        </p>
        <a href="<?php echo esc_url( home_url( '/booking' ) ); ?>" class="btn btn-primary">
            <?php esc_html_e( 'Book Your Session', 'ffp-photography' ); ?>
        </a>
    </div>
</section>

<?php get_footer(); ?>
