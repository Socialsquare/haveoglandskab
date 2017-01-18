<?php // get_search_form(); ?>

<div class="filter-bar">
  <?php 
  $taxonomies = get_object_taxonomies('udstillere', 'objects');
  
  foreach ($taxonomies as $taxonomy) {
    $terms = get_terms( array('taxonomy' => $taxonomy->name) );
    if(count($terms) > 0) echo '<h2 class="filter-bar__header">Filtrér efter '.strtolower($taxonomy->label).'</h2>';
    foreach ($terms as $term) {
      echo 
      "<a class='btn btn-white-flat filter-bar__btn' href='/{$taxonomy->rewrite['slug']}/{$term->slug}'>
        {$term->name} 
      </a>";
    }
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
