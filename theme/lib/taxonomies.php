<?php

function sector_init() {
	register_taxonomy(
		'sector',
		'udstillere',
		array(
			'hierarchical' => true,
			'labels' => array(
				'add_new_item' => __( 'Tilføj ny branche' ),
				'add_new' => __( 'Tilføj ny' ),
				'all_items' => __( 'Alle brancher' ),
				'edit_item' => __( 'Rediger branche' ),
				'name' => __( 'Brancher' ),
				'new_item' => __( 'Ny branche' ),
				'not_found' => __( 'Ingen branche fundet' ),
				'search_items' => __( 'Søg i brancher' ),
				'singular_name' => __( 'Branche' ),
				'view_item' => __( 'Se branche' ),
			),
			'rewrite' => array(
				'slug' => 'branche',
				'hierarchical' => true, ),
			'capabilities' => array(
				'assign_terms' => 'edit_udstillere',
				'edit_terms'   => 'publish_udstillere',
			)
		)
	);
}
add_action( 'init', 'sector_init' );

function area_init() {
	register_taxonomy(
		'area',
		'udstillere',
		array(
			'hierarchical' => true,
			'labels' => array(
				'add_new_item' => __( 'Tilføj nyt område' ),
				'add_new' => __( 'Tilføj ny' ),
				'all_items' => __( 'Alle områder' ),
				'edit_item' => __( 'Rediger område' ),
				'name' => __( 'Områder' ),
				'new_item' => __( 'Nyt område' ),
				'not_found' => __( 'Ingen områder fundet' ),
				'search_items' => __( 'Søg i områder' ),
				'singular_name' => __( 'Område' ),
				'view_item' => __( 'Se område' ),
			),
			'meta_box_cb' => false,
			'rewrite' => array(
				'slug' => 'area',
				'hierarchical' => true, ),
			'capabilities' => array(
				'assign_terms' => 'edit_udstillere',
				'edit_terms'   => 'edit_udstillere',
			)
		)
	);
}
add_action( 'init', 'area_init' );

$taxonomies_without_pagination = array('sector', 'area');

function no_nopaging($query) {
	global $taxonomies_without_pagination;
	if (is_tax($taxonomies_without_pagination)) {
		$query->set('nopaging', 1);
	}
}

add_action('parse_query', 'no_nopaging');
