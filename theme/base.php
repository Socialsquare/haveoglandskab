<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <div class="wrap container-fluid" role="document">
      <div class="content row">
        <main class="main">
          <?php
            global $wp_query;
            global $post;
            $original_wp_query = $wp_query;
            $original_post = $post;
            $is_archive = is_archive();
            $queried_object = get_queried_object();
            if($is_archive && get_class($queried_object) === 'WP_Post_Type') {
              // Try fetching a page with the same name as the archive
              // This is used as a way for the administrator to manage the
              // content on the archives frontpage
              $args = array(
	              'post_type' => 'page',
                'name' => $queried_object->rewrite['slug']
              );
              $wp_query = new WP_Query( $args );
              if($wp_query->have_posts()) {
                $wp_query->the_post();
                $post = get_post();
              }
            }
            // Getting the jumbo template part to render the title
            get_template_part('templates/jumbo');
            if($is_archive) {
              // Print the content of the current page as well
              get_template_part('templates/content-page');
            }

            // Restore the original WP_Query object
            $wp_query = $original_wp_query;
            $post = $original_post;
            include Wrapper\template_path();
          ?>
        </main><!-- /.main -->
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
