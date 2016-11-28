<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');



/**
 * Have&Landskap custom
 */

// Allow shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

// Button shortcodes
function button( $atts, $content = null ){
  return "<div class='btn btn-white btn-lg m-r-1 m-b-1'>" . $content . "</div>";

}
add_shortcode( 'button', __NAMESPACE__ . '\\button' );

// Column shortcodes
function column( $atts, $content = null ) {
	return "<div class='col-sm-6'>" . $content . "</div>";
}
add_shortcode( 'column', __NAMESPACE__ . '\\column' );

function columnWide( $atts, $content = null ) {
	return "<div class='col-xs-12'>" . $content . "</div>";
}
add_shortcode( 'column-wide', __NAMESPACE__ . '\\columnWide' );

// Social Icons
function icon( $atts ) {
  $a = shortcode_atts( array(
    'logo' => '',
    'url' => '#',
  ), $atts );
	return "<a href='{$a['url']}' target='_blank' class='social-icon'><img class='social-icon__img' src='". get_template_directory_uri() . "/dist/images/{$a['logo']}.svg'/></a>";
}
add_shortcode( 'icon', __NAMESPACE__ . '\\icon' );

// Logo
function logo( $atts ) {
  $a = shortcode_atts( array(
    'logo' => '',
    'url' => '#',
  ), $atts );
	return "<a href='{$a['url']}' target='_blank' class='social-icon'><img class='social-icon__img-big m-r-1' src='". get_template_directory_uri() . "/dist/images/{$a['logo']}.svg'/></a>";
}
add_shortcode( 'logo', __NAMESPACE__ . '\\logo' );
