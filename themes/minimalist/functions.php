<?php

define( 'CHILD_THEME_NAME', 'minimalist' );
define( 'CHILD_THEME_URL', 'http://www.ivankristianto.com' );
define( 'CHILD_THEME_VERSION', '1.1.0' );
define( 'CHILD_THEME_DB_VERSION', '1' );
define( 'CHILD_APP_DIR', 'app' );

add_theme_support( 'calibrefx-template-styles' );

add_action( 'wp_head', 'add_comfortaa_font' );
function add_comfortaa_font() {
	?>
	<link href='//fonts.googleapis.com/css?family=Comfortaa:400,700' rel='stylesheet' type='text/css'>
<?php
}

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

function image_display( $content ) {
	   $content .= '<div class="entry-image">';
	$content    .= calibrefx_get_image(
		array(
			'format' => 'html',
			'size'   => 'full',
			'attr'   => array( 'class' => 'alignnone post-image img-responsive' ),
		)
	);
	$content    .= '</div>';

	return $content;
}

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

function ik_amp_extended_component() {
	echo '<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>';
	echo '<script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>';
}
add_action( 'amp_post_template_head', 'ik_amp_extended_component', 25 );

function ik_amp_google_analytic_element() {

	$data = wp_json_encode(
		[
			'vars'     => [
				'account' => 'UA-5721705-1'
			],
			'triggers' => [
				'trackPageview' => [
					'on'      => 'visible',
					'request' => 'pageview',
				],
				'trackClick'    => [
					'on'       => 'click',
					'selector' => 'a',
					'request'  => 'event',
					'vars'     => [
						'eventAction' => 'click',
					]
				],
			],
		]
	);

	echo <<< TAG
<amp-analytics type="googleanalytics">
  <script type="application/json">
  	$data
  </script>
</amp-analytics>
TAG;

}
add_action( 'ik_amp_after_body_open_tag', 'ik_amp_google_analytic_element' );