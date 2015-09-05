<?php

// Function to remove version numbers
/* Hide WP version strings from scripts and styles
 * @return {string} $src
 * @filter script_loader_src
 * @filter style_loader_src
 */
function le_remove_wp_version_strings( $src ) {
     global $wp_version;
     parse_str(parse_url($src, PHP_URL_QUERY), $query);
     if ( !empty($query['ver']) && $query['ver'] === $wp_version ) {
          $src = remove_query_arg('ver', $src);
     }
     return $src;
}
add_filter( 'script_loader_src', 'le_remove_wp_version_strings' );
add_filter( 'style_loader_src', 'le_remove_wp_version_strings' );

/* Hide WP version strings from generator meta tag */
function le_remove_version() {
    return '';
}
add_filter('the_generator', 'le_remove_version');


// Register Script

function le_custom_scripts() {

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', false, '', false );
	wp_enqueue_script( 'jquery' );

	wp_register_script( 'uikit-min', trailingslashit( get_template_directory_uri() ) . 'apps/uikit/js/uikit.min.js', false, '', false );
	wp_enqueue_script( 'uikit-min' );
    
    /*
        wp_register_script( 'jQuery Y', '/apps/js/jquery_y.js', false, '1.2', true );
	wp_enqueue_script( 'jQuery Y' );
    */

}
add_action( 'wp_enqueue_scripts', 'le_custom_scripts' );

// Register Style

function le_custom_styles() {

	wp_register_style( 'le_custom_css', trailingslashit( get_template_directory_uri() ) . 'apps/css/custom.css', false, '', 'all' );
	wp_enqueue_style( 'le_custom_css' );

	wp_register_style( 'uikit-almost-flat', trailingslashit( get_template_directory_uri() ) . 'apps/uikit/css/uikit.almost-flat.min.css', false, '', 'all' );
	wp_enqueue_style( 'uikit-almost-flat' );

}
add_action( 'wp_enqueue_scripts', 'le_custom_styles', 9999 );

// Custom menu locations
if ( ! function_exists( 'le_custom_navigation_menus' ) ) {

// Register Navigation Menus
function le_custom_navigation_menus() {

	$locations = array(
		'Menu-1' => __( 'Base for menu X', 'hybrid-base' ),
		'Menu-2' => __( 'Base for menu Y', 'hybrid-base' ),
	);
	register_nav_menus( $locations );

}
add_action( 'init', 'le_custom_navigation_menus' );

}

// Custom widget area
if ( ! function_exists( 'le_custom_sidebars' ) ) {

// Register Sidebars
function le_custom_sidebars() {

	$args = array(
		'id'            => 'sid_1',
		'class'         => 'sid_1',
		'name'          => __( 'sid_1', 'hybrid-base' ),
		'description'   => __( 'Sidebar sid_1', 'hybrid-base' ),
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	);
	register_sidebar( $args );

	$args = array(
		'id'            => 'sid_2',
		'class'         => 'sid_2',
		'name'          => __( 'sid_2', 'hybrid-base' ),
		'description'   => __( 'Sidebar sid_2', 'hybrid-base' ),
	);
	register_sidebar( $args );

}
add_action( 'widgets_init', 'le_custom_sidebars' );

}