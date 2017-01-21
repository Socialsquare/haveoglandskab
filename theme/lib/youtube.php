<?php

namespace Roots\Sage\Youtube;
use Roots\Sage\Assets;

function enqueue_youtube_scripts() {
  $youtube_script = Assets\asset_path('scripts/youtube.js');
  wp_register_script('youtube', $youtube_script, array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_youtube_scripts');

function youtube( $atts, $content = null ) {
  wp_enqueue_script('youtube');

  $src = "https://www.youtube.com/embed/";
  if(!is_array($atts)) {
    $video_id = null;
    $playlist_id = null;
  } else {
    $video_id = @$atts['id'];
    $playlist_id = @$atts['playlist-id'];
  }
  $ratio = @$atts['ratio'];

  if(empty($video_id) && empty($playlist_id)) {
    ob_start();
    ?>
    <div class="alert alert-warning" role="alert">
      [youtube] shortcode mangler et id="..." eller et playlist-id="..."
    </div>
    <?php
    return ob_get_clean();
  } else {
    $src = "https://www.youtube.com/embed/";
    if(isset($video_id)) {
      $src .= $video_id;
    }
    if(isset($playlist_id)) {
      $src .= '?list=' . $playlist_id;
    }
    $attributes = array(
      "class" => "youtube-video",
      "width" => "100%",
      "src" => $src,
      "frameborder" => "0"
    );
    if($ratio) {
      $attributes['data-ratio'] = $ratio;
    }
    $attributes_strings = array();
    foreach($attributes as $name => $value) {
      array_push($attributes_strings, $name . '="' . $value . '"');
    }

    return '<iframe ' . implode($attributes_strings, ' ') . ' allowfullscreen></iframe>';
  }
}

// Youtube playlist
add_shortcode( 'youtube', __NAMESPACE__ . '\\youtube' );
