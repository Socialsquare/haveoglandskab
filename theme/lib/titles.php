<?php

namespace Roots\Sage\Titles;

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
    return get_the_archive_description();
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
