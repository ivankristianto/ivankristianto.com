<?php

define( 'CHILD_THEME_NAME', 'minimalist' );
define( 'CHILD_THEME_URL', 'https://www.ivankristianto.com' );
define( 'CHILD_THEME_VERSION', '1.2.0' );
define( 'CHILD_THEME_DB_VERSION', '1' );
define( 'CHILD_APP_DIR', 'app' );

/**
 * Add theme supports
 */
add_theme_support( 'calibrefx-template-styles' );
add_theme_support(
	'infinite-scroll', array(
		'type'           => 'scroll',
		'footer_widgets' => false,
		'container'      => 'content',
		'footer'         => 'wrapper',
		'wrapper'        => true,
		'render'         => false,
		'posts_per_page' => false,
	)
);

/**
 * Add fonts for the logo
 */
function add_comfortaa_font() {
	?>
	<link href='//fonts.googleapis.com/css?family=Comfortaa:700' rel='stylesheet' type='text/css'>
<?php
}
add_action( 'wp_head', 'add_comfortaa_font' );

function add_search_box_to_menu( $items, $args ) {
	if ( $args->theme_location == 'primary' ) {
		return $items . get_search_form( false );
	}

	return $items;
}
add_filter( 'wp_nav_menu_items', 'add_search_box_to_menu', 10, 2 );

function min_enqueue_scripts() {
	wp_enqueue_script( 'min.functions', CHILD_JS_URL . '/functions.js', array( 'jquery' ) );
}
add_action( 'calibrefx_meta', 'min_enqueue_scripts' );

function min_init_themes() {
	remove_action( 'calibrefx_meta', 'calibrefx_do_meta', 10 );
}
add_action( 'init', 'min_init_themes' );

function min_readmore_text() {
	return __( 'Read more...', 'minimalist' );
}
add_filter( 'calibrefx_readmore_text', 'min_readmore_text' );

function gallery_display( $content ) {
	$attached_images = get_children( 'post_type=attachment&post_mime_type=image&post_parent=' . get_the_id() );
	$arrKeys         = array_keys( $attached_images );
	if ( ! empty( $arrKeys ) ) {
		$arrKeys  = implode( ',', $arrKeys );
		$content .= '<div class="entry-gallery">';
		$content .= do_shortcode( '[gallery type="rectangular" link="file" size="large" ids="' . $arrKeys . '"]' );
		$content .= '</div>';
	}

	return $content;
}

function date_display( $content ) {
	$content .= '<div class="published-date">';
	$content .= do_shortcode( '[post_date format="relative"]' );
	$content .= '</div>';

	return $content;
}

function disable_wp_emojicons() {

	// all actions related to emojis
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	// filter to remove TinyMCE emojis
	add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

/**
 * Echo AMP Auto Ads Script
 */
function ik_amp_extended_component() {
	echo '<script async custom-element="amp-auto-ads" src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js"></script>';
}
add_action( 'amp_post_template_head', 'ik_amp_extended_component', 25 );
