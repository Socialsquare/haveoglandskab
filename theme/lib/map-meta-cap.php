<?php
function map_meta_cap_callback($capability_type) {
  return function ($caps, $cap, $user_id, $args) use ($capability_type) {
    $is_edit = $cap == 'edit_' . $capability_type;
    $is_delete = $cap == 'delete_' . $capability_type;
    $is_read = $cap == 'read_' . $capability_type;
  	/* If editing, deleting, or reading, get the post and post type object. */
  	if ( $is_edit || $is_delete || $is_read ) {
  		$post = get_post( $args[0] );
  		$post_type = get_post_type_object( $post->post_type );
  		/* Set an empty array for the caps. */
  		$caps = array();
  	}

  	/* If editing, assign the required capability. */
  	if ( $is_edit ) {
  		if ( $user_id == $post->post_author ) {
  			$caps[] = $post_type->cap->edit_posts;
  		} else {
  			$caps[] = $post_type->cap->edit_others_posts;
      }
  	} elseif ( $is_delete ) {
      /* If deleting, assign the required capability. */
  		if ( $user_id == $post->post_author ) {
  			$caps[] = $post_type->cap->delete_posts;
  		} else {
  			$caps[] = $post_type->cap->delete_others_posts;
      }
  	} elseif ( $is_read ) {
      /* If reading a private, assign the required capability. */
  		if ( 'private' != $post->post_status ) {
  			$caps[] = 'read';
  		} elseif ( $user_id == $post->post_author ) {
  			$caps[] = 'read';
  		} else {
  			$caps[] = $post_type->cap->read_private_posts;
      }
  	}

  	/* Return the capabilities required by the user. */
  	return $caps;
  };
}

add_filter( 'map_meta_cap', map_meta_cap_callback('udstiller'), 10, 4 );
add_filter( 'map_meta_cap', map_meta_cap_callback('activity'), 10, 4 );
