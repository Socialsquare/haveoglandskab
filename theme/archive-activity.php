<?php // get_search_form(); ?>
<?php
wp_enqueue_style('fullcalendar');
wp_enqueue_script('activities');
?>

<div class="activity-calendar"></div>
<?php the_posts_navigation(); ?>
