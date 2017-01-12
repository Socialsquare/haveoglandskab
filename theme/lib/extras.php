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

// Sort Udstillere overview alphabetically
add_action('pre_get_posts', __NAMESPACE__ . '\\udstiller_default_order');
function udstiller_default_order( $query ){
  if( 'udstillere' == $query->get('post_type') ){
  // Disable pagination
  $query->set('nopaging', 1);
  if( $query->get('orderby') == '' )
     $query->set('orderby','title');
  if( $query->get('order') == '' )
     $query->set('order','ASC');
  }
}

// Fjerne "arkiver:" label fra get_the_archive_title
function my_theme_archive_title( $title ) {
  if ( is_category() ) {
    $title = single_cat_title( '', false );
  } elseif ( is_tag() ) {
    $title = single_tag_title( '', false );
  } elseif ( is_author() ) {
    $title = '<span class="vcard">' . get_the_author() . '</span>';
  } elseif ( is_post_type_archive() ) {
    $title = post_type_archive_title( '', false );
  } elseif ( is_tax() ) {
    $title = single_term_title( '', false );
  }
  return $title;
}
add_filter( 'get_the_archive_title', __NAMESPACE__ . '\\my_theme_archive_title' );

// Allow shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

// Button
add_shortcode( 'button', __NAMESPACE__ . '\\button' );
function button( $atts, $content = null ) {
  $classes = 'btn btn-white btn-lg m-r-1 m-b-1';
  if(isset($atts['href'])) {
    $href = $atts['href'];
    return "<a class='$classes' href='$href'>$content</a>";
  } else {
    return "<div class='$classes'>$content</div>";
  }
}

// Columns
add_shortcode( 'column', __NAMESPACE__ . '\\column' );
function column( $atts, $content = null ) {
	return "<div class='col-sm-6'>" . $content . "</div>";
}

add_shortcode( 'column-wide', __NAMESPACE__ . '\\columnWide' );
function columnWide( $atts, $content = null ) {
	return "<div class='col-xs-12'>" . $content . "</div>";
}

// Social Icons
add_shortcode( 'icon', __NAMESPACE__ . '\\icon' );
function icon( $atts ) {
  $a = shortcode_atts( array(
    'logo' => '',
    'url' => '#',
  ), $atts );
	return "<a href='{$a['url']}' target='_blank' class='social-icon'><img class='social-icon__img' src='". get_template_directory_uri() . "/dist/images/{$a['logo']}.svg'/></a>";
}

// Logo
add_shortcode( 'logo', __NAMESPACE__ . '\\logo' );
function logo( $atts ) {
  $a = shortcode_atts( array(
    'logo' => '',
    'url' => '#',
  ), $atts );
	return "<a href='{$a['url']}' target='_blank' class='social-icon'><img class='social-icon__img-big m-r-1' src='". get_template_directory_uri() . "/dist/images/{$a['logo']}.svg'/></a>";
}

// Brugerhåndtering
add_filter( 'map_meta_cap', __NAMESPACE__ . '\\my_map_meta_cap', 10, 4 );
function my_map_meta_cap( $caps, $cap, $user_id, $args ) {

	/* If editing, deleting, or reading a udstiller, get the post and post type object. */
	if ( 'edit_udstiller' == $cap || 'delete_udstiller' == $cap || 'read_udstiller' == $cap ) {
		$post = get_post( $args[0] );
		$post_type = get_post_type_object( $post->post_type );

		/* Set an empty array for the caps. */
		$caps = array();
	}

	/* If editing a udstiller, assign the required capability. */
	if ( 'edit_udstiller' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->edit_posts;
		else
			$caps[] = $post_type->cap->edit_others_posts;
	}

	/* If deleting a udstiller, assign the required capability. */
	elseif ( 'delete_udstiller' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->delete_posts;
		else
			$caps[] = $post_type->cap->delete_others_posts;
	}

	/* If reading a private udstiller, assign the required capability. */
	elseif ( 'read_udstiller' == $cap ) {

		if ( 'private' != $post->post_status )
			$caps[] = 'read';
		elseif ( $user_id == $post->post_author )
			$caps[] = 'read';
		else
			$caps[] = $post_type->cap->read_private_posts;
	}

	/* Return the capabilities required by the user. */
	return $caps;
}

// Attach callback to 'tiny_mce_before_init'
// @see https://codex.wordpress.org/Plugin_API/Filter_Reference/tiny_mce_before_init
add_filter( 'tiny_mce_before_init', function( $init_array ) {
  // Define the style_formats array
  $style_formats = array(
    // Each array child is a format with it's own settings
    array(
      'title' => __('White button', 'haveoglandskab'),
      'selector' => 'a',
      'classes' => array('btn', 'btn-lg', 'btn-white')
    )
  );
  // Insert the array, JSON ENCODED, into 'style_formats'
  $init_array['style_formats'] = json_encode( $style_formats );

  return $init_array;
});

add_filter( 'mce_buttons_2', function( $buttons ) {
  //Add style selector to the beginning of the toolbar
  array_unshift( $buttons, 'styleselect' );
  return $buttons;
 });
