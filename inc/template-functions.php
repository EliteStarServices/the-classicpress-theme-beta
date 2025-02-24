<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Susty
 */

/**
 * Adds custom classes to the array of body classes.
 */
function susty_wp_body_classes( $classes ) {
	/**
	 * Adds a class of hfeed to non-singular pages.
	 */
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	/**
	 * Adds a class of no-sidebar when there is no sidebar present.
	 */
	if ( ! is_active_sidebar( 'main-sidebar' ) && ! is_active_sidebar( 'blog-sidebar' ) ) {
		$classes[] = 'no-sidebar';
	}
	/**
	 * Add the page slug as a class to the <body>
	 * Gives greater flexibility for styling
	 */
	if ( is_singular() ) {
		global $post;
		$classes[] = 'page-' . $post->post_name;
	}	
	return $classes;
}
add_filter( 'body_class', 'susty_wp_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function susty_wp_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'susty_wp_pingback_header' );

/**
 * Add excerpts to pages
 */
add_post_type_support( 'page', 'excerpt' );
