<?php use Roots\Sage\Titles; ?>

<div class="jumbo m-b-3" style="background-image: url('<?php
  if ( has_post_thumbnail() ) {
    echo the_post_thumbnail_url();
  } else {
    echo get_template_directory_uri() . '/dist/images/default.jpg';
  }?>')">
  <div class="jumbo__content container-fluid">
    <div class="row">
      <div class="col-md-9 col-lg-9">
        <h1 class="jumbo__heading"><?= Titles\title(); ?></h1>
        <?php if(get_field('sub_title')) {
          echo '<p class="jumbo__text">' . get_field('sub_title') . '</p>';
        } ?>
      </div>
    </div>
    <?php if(get_field('buttons')) {
      echo '<div class="jumbo__buttons">' . get_field('buttons') . '</div>';
    }?>
  </div>
  <svg class="jumbo__separator" viewBox="0 0 1440 45"
      xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
      <path d="M782 1C633 2 494 26 384 27 225 28 109 0 0 0v45h1440V11c-153 1-204
      30-346 30C977 41 931 1 782 1z"/>
  </svg>
</div>
