<?php
get_header(); ?>

  <main id="primary" class="site-main">
    <?php
    if (!isset($_COOKIE['region'])) {
      $region_name = 'Дагестан';
    } else {
      $region_name = $_COOKIE['region'];
    }

    $region_cat = get_term_by('name', $region_name, 'instructions_category');

    $region_child_cats = get_terms(
      array(
        'taxonomy'   => 'instructions_category',
        'hide_empty' => false,
        'parent' 		 => $region_cat->term_id
      )
    ); ?>
    <section class="intro">
      <div class="intro-slider">
        <?php
        foreach( $region_child_cats as $region_child_cat ) : ?>
          <div>
            <div class="intro-slide container">
              <div class="intro-slide-info">
                <h2 class="intro-slide-title"><?php the_field('slider_title', $region_child_cat); ?></h2>
                <?php
                $loop = new WP_Query( array(
                  'tax_query' => array(
                    array(
                      'taxonomy' => 'instructions_category',
                      'field'    => 'slug',
                      'terms'    => $region_child_cat
                    )
                  ),
                  'posts_per_page' => 5,
                  'orderby' => 'date',
                  'order' => 'ASC'
                ) );
                if ( $loop->have_posts() ) : ?>
                  <h4 class="intro-slide-subtitle">Что делать если..</h4>
                  <ul class="intro-slide-list list-unstyled">
                    <?php
                    while ( $loop->have_posts() ) : $loop->the_post(); ?>
                      <li>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                      </li>
                    <?php endwhile; ?>
                  </ul>
                  <a class="btn btn-default" href="<?php echo esc_url( get_term_link( $region_child_cat ) ) ?>">Узнать больше</a>
                <?php endif; wp_reset_postdata(); ?>
              </div>
              <div class="intro-slide-image">
                <img src="<?php the_field('cat_image', $region_child_cat); ?>" alt="">
              </div>
            </div><!-- .intro-slide -->
          </div>
        <?php
        endforeach; ?>
      </div><!-- .intro-slider -->
    </section><!-- .intro -->

    <section class="problems-section container">
      <div class="problems-list">
        <?php
        foreach( array_slice($region_child_cats, 0, 3) as $region_child_cat ) : ?>
          <div class="problems-list-item-wrapper">
            <div class="problems-list-item">
              Проблемы
              <h5 class="problems-item-title">
                <a class="link-arrow" href="<?php echo esc_url( get_term_link( $region_child_cat ) ) ?>">
                  <span><?php echo $region_child_cat->name; ?></span>
                  <svg width="9" height="13"><use xlink:href="<?php echo bloginfo('template_url'); ?>/img/sprite.svg#icon-link-arrows"></use></svg>
                </a>
              </h5>
            </div>
          </div>
        <?php
        endforeach; ?>
      </div><!-- .container -->
    </section>

    <section class="video-section section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <h2><?php the_field('video_title'); ?></h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-7 mb-4">
            <div class="video-container">
              <img class="img-fluid" src="<?php the_field('video_preview'); ?>" alt="">
              <div class="video-play-block">
                <button class="btn btn-play" type="button" data-toggle="modal" data-target="#videoModal">
                  <svg width="12" height="13"><use xlink:href="<?php echo bloginfo('template_url'); ?>/img/sprite.svg#icon-play"></use></svg>
                </button>
                <span>Смотрите видео</span>
              </div>
            </div>
          </div>
          <div class="col-lg-5 mb-4">
            <div class="memo-block">
              <?php
              $memos = get_field('memos');
              foreach( $memos as $memo ): ?>
                <div class="memo-item">
                  <h5 class="memo-item-title"><?php echo $memo['title']; ?></h5>
                  <a class="memo-item-link link-arrow" href="<?php echo $memo['url']; ?>">
                    <span><?php echo $memo['url_name']; ?></span>
                    <svg width="9" height="13"><use xlink:href="<?php echo bloginfo('template_url'); ?>/img/sprite.svg#icon-link-arrows"></use></svg>
                  </a>
                </div>
              <?php
              endforeach; ?>
              <img class="memos-dots-bg" src="<?php echo bloginfo('template_url'); ?>/img/svg/memos-dots-bg.svg" width="108" height="118" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>


  </main><!-- #primary -->

<?php
get_footer();
