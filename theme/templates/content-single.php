<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <?php
    if ( is_singular( 'udstillere' ) ):
      get_template_part('templates/content-single-udstillere');
    elseif ( is_singular( 'activity' ) ):
      get_template_part('templates/content-single-activity');
    else: ?>
      <header>
        <?php get_template_part('templates/entry-meta'); ?>
      </header>
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
      <footer>
        <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
      </footer>
    <?php endif ?>
  </article>
<?php endwhile; ?>
