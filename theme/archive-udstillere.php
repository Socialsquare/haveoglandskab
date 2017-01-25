<?php // get_search_form(); ?>

<?php
$taxonomies = get_object_taxonomies('udstillere', 'objects');

foreach ($taxonomies as $taxonomy) {
  echo '<div class="filter-bar">';
  $terms = get_terms( array('taxonomy' => $taxonomy->name) );
  if(count($terms) > 0) echo '<h3 class="filter-bar__header">Filtrér efter '.strtolower($taxonomy->label).'</h3>';
  foreach ($terms as $term) {
    echo
    "<a class='btn btn-white-flat filter-bar__btn' href='/{$taxonomy->rewrite['slug']}/{$term->slug}'>
      {$term->name}
    </a>";
  }
  echo '</div>';
}
?>

<h3>Alle udstillere</h3>
<?php
  echo '<ul class="udstiller__list row">';
  while (have_posts()) : the_post();
    get_template_part('templates/content-udstiller', get_post_type());
  endwhile;
  echo '</ul>';
?>

<?php the_posts_navigation(); ?>
