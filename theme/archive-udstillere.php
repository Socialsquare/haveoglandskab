<?php // get_search_form(); ?>

<div class="filter-bar">
  <h2>Filtrér efter branche</h2>
  <?php
  $terms = get_terms( array('taxonomy' => 'sector') );
  foreach ($terms as $term) {
    echo '<a class="btn btn-white-flat filter-bar__btn" href="/branche/' . $term->slug . '">' .$term->name. '</a>';
  }
  ?>
</div>

<h2>Alle udstillere</h2>
<?php
  echo '<ul class="udstiller__list row">';
  while (have_posts()) : the_post();
    get_template_part('templates/content-udstiller', get_post_type());
  endwhile;
  echo '</ul>';
?>

<?php the_posts_navigation(); ?>
