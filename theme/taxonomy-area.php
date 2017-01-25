<?php
  $term = get_term(get_queried_object_id());

  echo '<h3>Om området</h3>';
  echo '<p class="udstiller__area-description">'.$term->description.'</p>';

  echo '<h3>Udstillere i området</h3>';
  echo '<ul class="udstiller__list row">';
  while (have_posts()) : the_post();
    get_template_part('templates/content-udstiller', get_post_type());
  endwhile;
  echo '</ul>';
?>

<?php the_posts_navigation(); ?>
