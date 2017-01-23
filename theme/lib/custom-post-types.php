<?php

// Our custom post type function
function create_post_type_udstillere() {

	register_post_type( 'udstillere',
	// CPT Options
		array(
			'public' => true,
			'capability_type' => 'udstiller',
			'description' => '',
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
			'public' => true,
			'rewrite' => array('slug' => 'udstillere' ),
			'show_in_rest' => true,
			'supports' => array( // declare what we want it to support
				'thumbnail',
				'title',
				'author'
			)
		)
	);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_post_type_udstillere' );

function create_post_type_activity() {
	register_post_type( 'activity',
		array(
			'public' => true,
			'publicly_queryable' => true,
			'capability_type' => 'activity',
			'capabilities' => array(
				'publish_posts' => 'publish_activities',
				'edit_posts' => 'edit_activities',
				'edit_others_posts' => 'edit_others_activities',
				'delete_posts' => 'delete_activities',
				'delete_others_posts' => 'delete_others_activities',
				'read_private_posts' => 'read_private_activities',
				'edit_post' => 'edit_activity',
				'delete_post' => 'delete_activity',
				'read_post' => 'read_activity',
			),
			'labels' => array(
				'add_new_item' => __( 'Tilføj ny aktivitet' ),
				'add_new' => __( 'Tilføj ny' ),
				'all_items' => __( 'Alle aktiviteter' ),
				'edit_item' => __( 'Rediger aktivitet' ),
				'name' => __( 'Aktiviteter' ),
				'new_item' => __( 'Ny aktivitet' ),
				'not_found' => __( 'Ingen aktiviteter fundet' ),
				'search_items' => __( 'Søg aktiviteter' ),
				'singular_name' => __( 'Aktivitet' ),
				'view_item' => __( 'Se aktivitet' )
			),
			'has_archive' => true,
			'rewrite' => array('slug' => 'aktiviteter' ),
			'show_in_rest' => true,
			'menu_icon' => 'dashicons-calendar-alt'
		)
	);
}
add_action( 'init', 'create_post_type_activity' );
