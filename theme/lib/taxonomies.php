<?php

function sector_init() {
	register_taxonomy(
		'sector',
		'udstillere',
		array(
			'hierarchical' => true,
			'label' => __( 'Branche' ),
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
			'label' => __( 'Område' ),
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

