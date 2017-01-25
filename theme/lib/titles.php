<?php

namespace Roots\Sage\Titles;

use DateTime;

function get_week_day($date) {
  switch ($date->format('N')) {
    case '1':
      return 'Mandag';
    case '2':
      return 'Tirsdag';
    case '3':
      return 'Onsdag';
    case '4':
      return 'Torsdag';
    case '5':
      return 'Fredag';
    case '6':
      return 'Lørdag';
    case '7':
      return 'Søndag';
    default:
      return '';
  }
}

function format_date($date, $include_day = false, $split = "") {
  $result = "";
  if($include_day) {
    $result .= get_week_day($date) . ' d. ' . $date->format('d/m \'y');
  }
  if($split) {
    $result .= $split;
  }
  $result .= $date->format('H:i');
  return $result;
}

function format_date_interval($start, $end) {
  $start_day = $start->format('d/m \'y');
  $end_day = $end->format('d/m \'y');
  if($start_day == $end_day) {
    // Same date
    return format_date($start, true, ' kl. ') . ' — ' . format_date($end);
  } else {
    return format_date($start, true, ' kl. ') . ' — ' . format_date($end, true, ' kl. ');
  }
}

/**
 * Page titles
 */
function title() {
  if (is_home()) {
    if (get_option('page_for_posts', true)) {
      return get_the_title(get_option('page_for_posts', true));
    } else {
      return __('Latest Posts', 'sage');
    }
  } elseif (is_archive()) {
    return get_the_archive_title();
  } elseif (is_search()) {
    return sprintf(__('Search Results for %s', 'sage'), get_search_query());
  } elseif (is_404()) {
    return __('Not Found', 'sage');
  } else {
    return get_the_title();
  }
}

function sub_title() {
  if(is_archive()) {
    // The sub title of the first post
    // is fetched if we don't do this.
    return;
  } else if(is_singular( 'activity' )) {
    $start_timestamp = get_field('start');
    $end_timestamp = get_field('end');
    if($start_timestamp && $end_timestamp) {
      $start = new DateTime();
      $start->setTimestamp($start_timestamp);
      $end = new DateTime();
      $end->setTimestamp($end_timestamp);
      return format_date_interval($start, $end);
    } else {
      return '<p>Mangler en tidsangivelse<p>';
    }
  } else {
    return '<p>' . get_field('sub_title') . '</p>';
  }
}

function header_image() {
  $default = get_template_directory_uri() . '/dist/images/default.jpg';

  if(is_archive() ){
    return $default;
  } elseif ( has_post_thumbnail() ) {
    return the_post_thumbnail_url($size = 'large');
  } else {
    return $default;
  }
}
