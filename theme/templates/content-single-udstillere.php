<?php
$sectors = get_the_terms($post->ID, 'sector');
$areas = get_the_terms($post->ID, 'area');

function get_term_name_and_link($term) {
  $link = get_term_link($term);
  return '<a href="' . $link . '">' . $term->name . '</a>';
}

$logo = get_field('udstiller_logo');
$stand = get_field('udstiller_stand');
$homepage = get_field('udstiller_hjemmeside');
$description = get_field('udstiller_beskrivelse');
$youtube = get_field('udstiller_youtube');
$billede1 = get_field('udstiller_eksempel_billede_1');
$billede2 = get_field('udstiller_eksempel_billede_2');
$billede3 = get_field('udstiller_eksempel_billede_3');
$billede4 = get_field('udstiller_eksempel_billede_4');
$billeder = array($billede1, $billede2, $billede3, $billede4);

// Filter out images that are not uploaded correctly
$billeder = array_filter($billeder, function($billede) {
  return !empty($billede['mime_type']);
});

$activities = get_posts(array(
	'numberposts'	=> -1,
	'post_type'		=> 'activity',
  'meta_key'		=> 'udstiller',
	'meta_value'	=> $post->ID
));

if(!empty($activities)) {
  wp_enqueue_style('fullcalendar');
  wp_enqueue_script('activities');
}
?>
<div class="entry-content">
  <?php if (!empty($logo)){
    $logoUrl = $logo['sizes'][ 'thumbnail' ];
    $src = 'src="' . $logoUrl . '"';
    $alt = 'alt="' . $logo['alt'] . '"';
    $class = 'class="udstiller__logo m-t-0 m-r-2"';
    echo '<img ' . $class . $src . $alt . ' />';
  }?>
  <dl class="udstiller__table">
    <?php
      if ($stand) {
        echo '<dt>Stand</dt><dd>';
        if (!empty($areas)){
          $area_names = array_map('get_term_name_and_link', $areas);
          echo implode($area_names, ', ') . ' ';
        }
        echo $stand;
        echo '</dd>';
      }
      if (!empty($sectors)){
        $sector_names = array_map('get_term_name_and_link', $sectors);
        echo '<dt>Branche</dt><dd>' . implode($sector_names, ', ') . '</dd>';
      }
      if ($homepage){
        $homepage = trim($homepage, '/');
        if (!preg_match('#^http(s)?://#', $homepage)) {
            $homepage = 'http://' . $homepage;
        }
        $urlParts = parse_url($homepage);
        $domain = preg_replace('/^www\./', '', $urlParts['host']);
        $homepageHref = '<a href="' . $homepage . '">' . $domain . '</a>';
        echo '<dt>Hjemmeside</dt><dd>' . $homepageHref . '</dd>';
      }
    ?>
  </dl>
  <h2 class="entry-title m-t-3"><?php the_title(); ?> udstiller på HL'17</h2>
  <?php if ($description) {
    echo '<p>' . $description . '</p>';
  }?>
  <div class="row">
    <?php
     foreach ($billeder as $billede): ?>
      <?php if (!empty($billede)):
        $src = 'src="' . $billede['sizes'][ 'thumbnail' ] . '"';
        $alt = 'alt="' . $billede['alt'] . '"';
        $class = 'class="udstiller__eksempel m-t-2"';
        $description = $billede['description'];
      ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <img <?php echo $class . $src . $alt ?> />
          <p> <?php echo $description ?> </p>
        </div>
      <?php endif ?>
    <?php endforeach ?>
  </div>
  <?php if($activities): ?>
    <h2 class="entry-title m-t-3">Kom og oplev</h2>
    <div class="activity-calendar" data-udstiller-id="<?= $post->ID ?>"></div>
  <?php endif ?>
  <?php if ($youtube):
    $youtubeUrl = '//www.youtube.com/embed/' . $youtube . '?rel=0&modestbranding=1&hd=1&autohide=1';
  ?>
    <div class="embed-responsive embed-responsive-16by9 m-t-3">
      <iframe class="embed-responsive-item"
        src="<?php echo $youtubeUrl ?>"
        allowfullscreen>
      </iframe>
    </div>
  <?php endif ?>
</div>
