<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo esc_attr( get_bloginfo( 'description', 'display' ) ); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Page Loader -->
<div id="page-loader" aria-hidden="true">
    <span class="loader-logo"><?php echo esc_html( get_theme_mod( 'ffp_photographer_name', 'FFP' ) ); ?></span>
</div>

<!-- Site Header -->
<header class="site-header" id="site-header" role="banner">

    <!-- Logo -->
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home" aria-label="<?php bloginfo( 'name' ); ?> — Home">
        <?php
        if ( has_custom_logo() ) :
            the_custom_logo();
        else :
            $photographer = get_theme_mod( 'ffp_photographer_name', 'FFP Photography' );
            $parts        = explode( ' ', $photographer, 2 );
            echo esc_html( $parts[0] );
            if ( isset( $parts[1] ) ) : ?>
                <span><?php echo esc_html( $parts[1] ); ?></span>
            <?php endif;
        endif;
        ?>
    </a>

    <!-- Primary Navigation -->
    <nav id="primary-navigation" aria-label="<?php esc_attr_e( 'Primary', 'ffp-photography' ); ?>">
        <?php
        wp_nav_menu( array(
            'theme_location' => 'primary',
            'menu_id'        => 'primary-menu',
            'container'      => false,
            'menu_class'     => 'nav-menu',
            'fallback_cb'    => 'ffp_default_nav',
            'items_wrap'     => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
        ) );
        ?>
    </nav>

    <!-- Mobile Toggle -->
    <button class="nav-toggle" id="nav-toggle" aria-label="<?php esc_attr_e( 'Toggle navigation', 'ffp-photography' ); ?>" aria-expanded="false" aria-controls="primary-menu">
        <span></span>
        <span></span>
        <span></span>
    </button>

</header>
<!-- /Site Header -->

<?php
/**
 * Fallback nav when no menu is assigned.
 */
function ffp_default_nav() {
    ?>
    <ul class="nav-menu" id="primary-menu" role="menubar">
        <li role="none"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" role="menuitem"><?php esc_html_e( 'Home', 'ffp-photography' ); ?></a></li>
        <li role="none"><a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>" role="menuitem"><?php esc_html_e( 'Portfolio', 'ffp-photography' ); ?></a></li>
        <li role="none"><a href="<?php echo esc_url( home_url( '/about' ) ); ?>" role="menuitem"><?php esc_html_e( 'About', 'ffp-photography' ); ?></a></li>
        <li role="none"><a href="<?php echo esc_url( home_url( '/booking' ) ); ?>" class="nav-cta" role="menuitem"><?php esc_html_e( 'Book a Session', 'ffp-photography' ); ?></a></li>
    </ul>
    <?php
}
