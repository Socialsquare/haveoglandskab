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
				'assign_terms' => 'publish_udstillere',
				'edit_terms' => 'edit_udstillere'
			)
		)
	);
}
add_action( 'init', 'sector_init' );