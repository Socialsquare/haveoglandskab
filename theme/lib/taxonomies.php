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
				'manage_terms' => 'manage_udstiller',
				'edit_terms' => 'edit_udstiller',
				'delete_terms' => 'delete_udstiller',
				'assign_terms' => 'assign_udstiller',
			)
		)
	);
}
add_action( 'init', 'sector_init' );