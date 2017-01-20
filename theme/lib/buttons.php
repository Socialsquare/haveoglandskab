<?php

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
