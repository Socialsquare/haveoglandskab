<?php
  echo '<h3>Udstillere</h3>';
  echo '<ul class="udstiller__list row">';
  while (have_posts()) : the_post();
    get_template_part('templates/content-udstiller', get_post_type());
  endwhile;
  echo '</ul>';
?>

<?php the_posts_navigation(); ?>
