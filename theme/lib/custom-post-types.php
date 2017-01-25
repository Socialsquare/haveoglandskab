<?php

/**
 * @see https://support.advancedcustomfields.com/forums/topic/get-field-key-by-field-name/
 * This is needed when saving the first value to a field,
 * see the "Basic (field key)" section on
 * https://www.advancedcustomfields.com/resources/update_field/
 */
 function get_acf_field_keys( $custom_field_slug = '' ) {
 		$result = array();
 		$meta_key_start = 'field_';
 		$acf_args = array(
 			'post_type'		=> 'acf'
 		);
 		if ( $custom_field_slug !== '' ) {
 			$acf_args[ 'name' ] = $custom_field_slug;
 		}
 		$acf_query = new WP_Query( $acf_args );
 		if ( $acf_query->have_posts() ) {
 			while ( $acf_query->have_posts() ) {
 				$acf_query->the_post();
 				$meta_values = get_post_meta( get_the_id() );
 				foreach ( $meta_values as $meta_key => $meta_value ) {

 					if ( substr( $meta_key, 0, strlen( $meta_key_start ) ) === $meta_key_start ) {
 						$meta_value_array = unserialize( $meta_value[0] );
 						$result[ $meta_value_array['name'] ] = $meta_key;
 					}
 				}
 			}
 		}
 		wp_reset_postdata();
 		if ( empty( $result ) ) {
 			$result = false;
 		}
 		return $result;
 	}

/**
 * @see http://php.net/manual/en/function.parse-url.php
 */
function unparse_url($parsed_url) {
  $scheme = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
  $host = isset($parsed_url['host']) ? $parsed_url['host'] : '';
  $port = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
  $user = isset($parsed_url['user']) ? $parsed_url['user'] : '';
  $pass = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : '';
  $pass = ($user || $pass) ? "$pass@" : '';
  $path = isset($parsed_url['path']) ? $parsed_url['path'] : '';
  $query = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
  $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
  return "$scheme$user$pass$host$port$path$query$fragment";
}

function update_url($location, $querystring_changes) {
	$url = parse_url($location);
	parse_str($url['query'], $querystring);
	$updated_querystring = array_merge($querystring, $querystring_changes);
	$url['query'] = http_build_query($updated_querystring);
	$updated_location = unparse_url($url);
	return $updated_location;
}

const CUSTOM_MESSAGE_QUERYPARAM = 'custom-message';
$custom_messages = array(
	'unexpected' => _( 'Der skete en ukendt fejl' ),
	'missing-udstiller' => _( 'Du skal være tilknyttet en udstiller' )
);

add_action( 'admin_notices', function() {
	global $custom_messages;
	if(array_key_exists(CUSTOM_MESSAGE_QUERYPARAM, $_GET)) {
		$custom_message_key = $_GET[CUSTOM_MESSAGE_QUERYPARAM];
		if(array_key_exists($custom_message_key, $custom_messages)) {
			$custom_message = $custom_messages[$custom_message_key];
		} else {
			$custom_message = $custom_messages['unexpected'];
		}

		if($custom_message):
			?>
			<div class="error">
					<p><?= $custom_message ?></p>
			</div>
			<?php
		endif;
	}
});

// Our custom post type function
function create_post_type_udstillere() {

	register_post_type( 'udstillere',
	// CPT Options
		array(
			'public' => true,
			'capability_type' => array('udstiller', 'udstillere'),
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
			'capability_type' => array('activity', 'activities'),
			'description' => '',
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
			'menu_icon' => 'dashicons-calendar-alt',
			'supports' => array( // declare what we want it to support
				'title',
				'editor',
				'thumbnail'
			)
		)
	);
}
add_action( 'init', 'create_post_type_activity' );

const SAVE_ACTIVITY_PRIORITY = 99;

function save_activity( $post_id, $post ) {
	$post_update = array();

	// If this is not just a revision
	if(!wp_is_post_revision( $post_id )) {
		$user = wp_get_current_user();
		// Look up any "udstiller" with this user as author
		$udstiller_query = new WP_Query(array(
			'author' => $user->ID,
			'post_type' => 'udstillere'
		));
		$is_not_administrator = !in_array('administrator', (array) $user->roles);
		// If the author of this new activity is an author of an "udstiller"
		if($udstiller_query->have_posts()) {
			$udstiller_query->the_post();
			$udstiller = $udstiller_query->post;
      $field_keys = get_acf_field_keys();
      $udstiller_field_key = $field_keys['udstiller'];
      update_field($udstiller_field_key, $udstiller->ID, $post_id);
		} elseif($is_not_administrator && $post->post_status == 'publish') {
			add_filter('redirect_post_location', function($location, $post_id) {
				return update_url($location, array(
					'message' => null,
					CUSTOM_MESSAGE_QUERYPARAM => 'missing-udstiller'
				));
			}, 99, 2);
			// Move this to drafts
			$post_update['post_status'] = 'draft';
		}
	}

	if(!empty($post_update)) {
		$post_update['ID'] = $post_id;
		remove_action( 'save_post_activity', 'save_activity', SAVE_ACTIVITY_PRIORITY, 2);
    wp_update_post($post_update);
		add_action( 'save_post_activity', 'save_activity', SAVE_ACTIVITY_PRIORITY, 2);
	}
}
add_action( 'save_post_activity', 'save_activity', SAVE_ACTIVITY_PRIORITY, 2);
