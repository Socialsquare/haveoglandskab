<?php
$start_timestamp = get_field('start');
if($start_timestamp) {
  $start = new DateTime();
  $start->setTimestamp($start_timestamp);
}
$end_timestamp = get_field('end');
if($end_timestamp) {
  $end = new DateTime();
  $end->setTimestamp($end_timestamp);
}

function get_term_name($term) {
  return $term->name;
}
?>
<header>

</header>
<div class="entry-content row">
  <div class="col-md-8">
    <?php the_content(); ?>
  </div>
  <div class="col-md-4">
    <?php
    $udstiller = get_field('udstiller');
    if($udstiller):
      $description = get_field('udstiller_beskrivelse', $udstiller->ID);
      $stand_nummer = get_field('udstiller_stand', $udstiller->ID);
      $areas = get_the_terms($udstiller->ID, 'area');

      if(!empty($areas)) {
        $first_area = $areas[0];
        $area_letter = get_field('letter', 'area_' . $first_area->term_id);
        $standplads = $area_letter . $stand_nummer;
      } else {
        $standplads = $stand_nummer;
      }
      ?>
      <div class="card udstiller-card">
        <div class="card-header">
          Her sker det
        </div>
        <div class="udstiller-card__images">
          <?php
          // Display the featured image, if any
          $thumbnail_id = get_post_thumbnail_id($udstiller->ID);
          if($thumbnail_id):
            $thumbnail_url = wp_get_attachment_image_url($thumbnail_id);
            ?>
            <img class="udstiller-card__featured-image" src="<?= $thumbnail_url ?>">
            <?php
          endif;
          // Display the logo image, if any
          $logo = get_field('udstiller_logo', $udstiller->ID);
          if($logo):
            $logo_url = $logo['sizes']['thumbnail'];
            ?>
            <img class="udstiller-card__logo-image" src="<?= $logo_url ?>">
            <?php
          endif;
          ?>
        </div>
        <div class="card-block">
          <h4 class="card-title"><?= $udstiller->post_title ?></h4>
          <p>
            <dt>Stand</dt>
            <dd>
              <?php
              echo $standplads;
              if (!empty($areas)) {
                $area_names = array_map('get_term_name', $areas);
                echo ' (' . implode($area_names, ', ') . ')';
              }
              ?>
            </dd>
          </p>
          <a href="<?= get_permalink($udstiller) ?>" class="btn btn-primary">Læs mere om udstilleren</a>
        </div>
      </div>
      <?php
    endif;
    ?>
  </div>
</div>
<footer>
  <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
</footer>
