<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <?php if ( is_singular( 'udstillere' ) ):
      $logo = get_field('udstiller_logo');
      $stand = get_field('udstiller_stand');
      $categori = get_field('udstiller_kategori');
      $categories = get_field_object('udstiller_kategori');
      $homepage = get_field('udstiller_hjemmeside');
      $description = get_field('udstiller_beskrivelse');
      $events = get_field('udstiller_events');
      $youtube = get_field('udstiller_youtube');
      $billede1 = get_field('udstiller_eksempel_billede_1');
      $billede2 = get_field('udstiller_eksempel_billede_2');
      $billede3 = get_field('udstiller_eksempel_billede_3');
      $billede4 = get_field('udstiller_eksempel_billede_4');
      $billeder = array($billede1, $billede2, $billede3, $billede4);
    ?>
      <div class="entry-content">
        <?php if (!empty($logo)){
          $logoUrl = $logo['sizes'][ 'thumbnail' ];
          $src = 'src="' . $logoUrl . '"';
          $alt = 'alt="' . $logo['alt'] . '"';
          $class = 'class="udstiller__logo m-t-0 m-r-2"';
          echo '<img ' . $class . $src . $alt . ' />';
        }?>
        <dl class="udstiller__table">
          <?php
            if ($stand){
              echo '<dt>Stand</dt><dd>' . $stand . '</dd>';
            }
            if ($categori){
              $label = $categories['choices'][$categori];
              echo '<dt>Kategori</dt><dd>' . $label . '</dd>';
            }
            if ($homepage){
              $homepage = trim($homepage, '/');
              if (!preg_match('#^http(s)?://#', $homepage)) {
                  $homepage = 'http://' . $homepage;
              }
              $urlParts = parse_url($homepage);
              $domain = preg_replace('/^www\./', '', $urlParts['host']);
              $homepageHref = '<a href="' . $homepage . '">' . $domain . '</a>';
              echo '<dt>Hjemmeside</dt><dd>' . $homepageHref . '</dd>';
            }
          ?>
        </dl>
        <h2 class="entry-title m-t-3"><?php the_title(); ?> udstiller på HL'17</h2>
        <?php if ($description) {
          echo '<p>' . $description . '</p>';
        }?>
        <div class="row">
          <?php foreach ($billeder as $billede): ?>
            <?php if (!empty($billede)):
              $src = 'src="' . $billede['sizes'][ 'thumbnail' ] . '"';
              $alt = 'alt="' . $billede['alt'] . '"';
              $class = 'class="udstiller__eksempel m-t-2"';
              $description = $billede['description'];
            ?>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <img <?php echo $class . $src . $alt ?> />
                <p> <?php echo $description ?> </p>
              </div>
            <?php endif ?>
          <?php endforeach ?>
        </div>
        <?php if ($events): ?>
          <h2 class="entry-title m-t-3">Kom og oplev</h2>
          <p><?php echo $events ?></p>
        <?php endif ?>
        <?php if ($youtube):
          $youtubeUrl = '//www.youtube.com/embed/' . $youtube . '?rel=0&modestbranding=1&hd=1&autohide=1';
        ?>
          <div class="embed-responsive embed-responsive-16by9 m-t-3">
            <iframe class="embed-responsive-item"
              src="<?php echo $youtubeUrl ?>"
              allowfullscreen>
            </iframe>
          </div>
        <?php endif ?>
      </div>
    <?php else: ?>
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
