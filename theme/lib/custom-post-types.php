<?php

// Our custom post type function
function create_posttype() {

	register_post_type( 'udstillere',
	// CPT Options
		array(
			'public' => true,
			'capability_type' => 'udstiller',
			'description' => 'test',
			'capabilities' => array(
				'publish_posts' => 'publish_udstillere',
				'edit_posts' => 'edit_udstillere',
				'edit_others_posts' => 'edit_others_udstillere',
				'delete_posts' => 'delete_udstillere',
				'delete_others_posts' => 'delete_others_udstillere',
				'read_private_posts' => 'read_private_udstillere',
				'edit_post' => 'edit_udstiller',
				'delete_post' => 'delete_udstiller',
				'read_post' => 'read_udstiller',
			),
			'has_archive' => true,
			'labels' => array(
				'add_new_item' => __( 'Tilføj ny udstiller' ),
				'add_new' => __( 'Tilføj ny' ),
				'all_items' => __( 'Alle udstillere' ),
				'edit_item' => __( 'Rediger udstiller' ),
				'name' => __( 'Udstillere' ),
				'new_item' => __( 'Ny udstiller' ),
				'not_found' => __( 'Ingen udstiller fundet' ),
				'search_items' => __( 'Søg udstillere' ),
				'singular_name' => __( 'Udstiller' ),
				'view_item' => __( 'Se udstiller' ),
			),
			'menu_icon' => 'dashicons-welcome-widgets-menus',
			'public' => true,
			'rewrite' => array('slug' => 'udstillere' ),
			'supports' => array( // declare what we want it to support
				'thumbnail',
				'title',
				'author'
			),
		)
	);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );
