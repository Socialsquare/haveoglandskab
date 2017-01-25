<?php
add_action( 'rest_api_init', function() {

  register_rest_field( 'activity', 'start', array(
    'get_callback' => function( $activity ) {
      return (int) get_field('start', $activity['id'] );
    },
    'update_callback' => function( $start, $activity ) {
      return new WP_Error('rest_activity_start_failed',
                          __( 'Not yet implemented' ),
                          array( 'status' => 500 ) );
    },
    'schema' => array(
        'description' => __( 'Activity start timestamp' ),
        'type'        => 'integer'
    ),
  ));

  register_rest_field( 'activity', 'end', array(
    'get_callback' => function( $activity ) {
      return (int) get_field('end', $activity['id'] );
    },
    'update_callback' => function( $end, $activity ) {
      return new WP_Error('rest_activity_end_failed',
                          __( 'Not yet implemented' ),
                          array( 'status' => 500 ) );
    },
    'schema' => array(
        'description' => __( 'Activity end timestamp' ),
        'type'        => 'integer'
    ),
  ));

  register_rest_field( 'activity', 'udstiller_title', array(
    'get_callback' => function( $activity ) {
      $udstiller = get_field('udstiller', $activity['id'] );
      return $udstiller ? $udstiller->post_title : null;
    },
    'update_callback' => function( $udstiller, $activity ) {
      return new WP_Error('rest_activity_udstiller_failed',
                          __( 'Not yet implemented' ),
                          array( 'status' => 500 ) );
    },
    'schema' => array(
        'description' => __( 'Activity udstiller' ),
        'type'        => 'integer'
    ),
  ));

  add_filter( 'rest_activity_query', function($args, $request) {
    $args['meta_key'] = 'start';
    $args['orderby'] = 'meta_value_num';
    $args['posts_per_page'] = -1;

    $meta_query = array(
      'relation' => 'AND'
    );

    $from = $request->get_param('from');
    if($from) {
      $meta_query[] = array (
        'key' => 'start',
        'value' => (int) $from,
        'type' => 'NUMERIC',
        'compare' => '>='
      );
    }
    $until = $request->get_param('until');
    if($until) {
      $meta_query[] = array (
        'key' => 'end',
        'value' => (int) $until,
        'type' => 'NUMERIC',
        'compare' => '<='
      );
    }
    $udstillerId = $request->get_param('udstillerId');
    if($udstillerId) {
      $meta_query[] = array (
        'key' => 'udstiller',
        'value' => $udstillerId,
        'compare' => '='
      );
    }

    $args['meta_query'] = $meta_query;
    return $args;
  }, 10, 3);
});
