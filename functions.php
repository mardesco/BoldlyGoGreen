<?php
/**
 * @package    BoldlyGoGreen
 * @version    0.1.1
 * @author     Jesse Smith
 * @copyright  Copyright (c) 2013 by Jesse Smith for Mardesco
 * @link       http://mardesco.com/themes/boldly-go-green/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Add the child theme setup function to the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'bgg_theme_setup' );

/**
 * Setup function.  All child themes should run their setup within this function.  The idea is to add/remove 
 * filters and actions after the parent theme has been set up.  This function provides you that opportunity.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function bgg_theme_setup() {

	/*
	 * Add a custom background to overwrite the defaults.  Remove this section if you want to use 
	 * the parent theme defaults instead.
	 *
	 * @link http://codex.wordpress.org/Custom_Backgrounds
	 */
	add_theme_support(
		'custom-background',
		array(
			'default-color' => '0eba04',
			'default-image' => '%2$s/images/backgrounds/green_bg3.png',
		)
	);

	/*
	 * Add a custom header to overwrite the defaults.  Remove this section if you want to use the 
	 * the parent theme defaults instead.
	 *
	 * @link http://codex.wordpress.org/Custom_Headers
	 */
	add_theme_support( 
		'custom-header', 
		array(
			'default-text-color' => '252525',
			'default-image'      => '',
			'random-default'     => false,
		)
	);

	/* Filter to add custom default backgrounds (supported by the framework). */
	add_filter( 'hybrid_default_backgrounds', 'bgg_default_backgrounds' );

	/* Add a custom default color for the "primary" color option. */
	add_filter( 'theme_mod_color_primary', 'bgg_color_primary' );
}

/**
 * This works just like the WordPress `register_default_headers()` function.  You're just setting up an 
 * array of backgrounds.  The following backgrounds are merely examples from the parent theme.  Please 
 * don't use them.  Use your own backgrounds.  Or, remove this section (and the `add_filter()` call earlier) 
 * if you don't want to register custom backgrounds.
 *
 * @since  0.1.0
 * @access public
 * @param  array  $backgrounds
 * @return array
 */

function bgg_default_backgrounds( $backgrounds ) {

	$new_backgrounds = array(
		'light-green-stripe' => array(
			'url'           => '%2$s/images/backgrounds/green_bg3.png',
			'thumbnail_url' => '%2$s/images/backgrounds/green_bg3.png',
		)
	);

	return array_merge( $new_backgrounds, $backgrounds );
}


/**
 * Add a default custom color for the theme's "primary" color option.  Users can overwrite this from the 
 * theme customizer, so we want to make sure to check that there's no value before returning our custom 
 * color.  If you want to use the parent theme's default, remove this section of the code and the 
 * `add_filter()` call from earlier.  Otherwise, just plug in the 6-digit hex code for the color you'd like 
 * to use (the below is the parent theme default).
 *
 * @since  0.1.0
 * @access public
 * @param  string  $hex
 * @return string
 */
 
 // using same color as primary but keeping function for forward compat
function bgg_color_primary( $hex ) {
	return $hex ? $hex : '0b7800';//
}

//make the "read more" link in the_excerpt link to the post
//from http://codex.wordpress.org/Function_Reference/the_excerpt#Make_the_.22read_more.22_link_to_the_post
function new_excerpt_more($more) {
    global $post;
	return ' <a href="'. esc_url(get_permalink($post->ID)) . '">(...Read More)</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');