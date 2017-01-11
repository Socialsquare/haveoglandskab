<?php
/**
 * Template Name: Side med columns
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <div class="row">
    <?php get_template_part('templates/content', 'page'); ?>
  </div>
<?php endwhile; ?>
