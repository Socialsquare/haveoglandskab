<?php // get_search_form(); ?>
<?php wp_enqueue_script('activities', Assets\asset_path('scripts/activities.js'),[], null, true); ?>

<div id="calendar"></div>
<?php the_posts_navigation(); ?>
