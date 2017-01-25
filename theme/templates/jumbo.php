<?php use Roots\Sage\Titles; ?>

<div class="jumbo m-b-3" style="background-image: url('<?= Titles\header_image() ?>')">
  <div class="jumbo__content container-fluid">
    <div class="row">
      <div class="col-md-9 col-lg-9">
        <h1 class="jumbo__heading"><?= Titles\title(); ?></h1>
        <div class="jumbo__text"><?= Titles\sub_title(); ?> </div>
      </div>
    </div>
    <?= Titles\buttons(); ?>
  </div>
  <svg class="jumbo__separator" viewBox="0 0 1440 45"
      xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
      <path d="M782 1C633 2 494 26 384 27 225 28 109 0 0 0v45h1440V11c-153 1-204
      30-346 30C977 41 931 1 782 1z"/>
  </svg>
</div>
