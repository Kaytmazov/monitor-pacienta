<?php
get_header(); ?>

  <main id="primary" class="site-main">
    <?php
    global $region;

    $region_cat = get_term_by('name', $region, 'instructions_category');

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
                <img class="img-fluid" src="<?php the_field('cat_image', $region_child_cat); ?>" alt="">
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
                <a class="link-primary" href="<?php echo esc_url( get_term_link( $region_child_cat ) ) ?>">
                  <span><?php echo $region_child_cat->name; ?></span>
                  <svg width="9" height="13"><use xlink:href="#icon-link-arrows"></use></svg>
                </a>
              </h5>
            </div>
          </div>
        <?php
        endforeach; ?>
      </div><!-- .problems-list -->
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
                  <svg width="12" height="13"><use xlink:href="#icon-play"></use></svg>
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
                  <a class="memo-item-link link-primary" href="<?php echo $memo['url']; ?>">
                    <span><?php echo $memo['url_name']; ?></span>
                    <svg width="9" height="13"><use xlink:href="#icon-link-arrows"></use></svg>
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

    <section class="instructions-section section">
      <?php $instructions_page = get_page_by_path( 'instructions' ); ?>

      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <h2><?php echo $instructions_page->post_title; ?></h2>
            <?php echo $instructions_page->post_content; ?>
          </div>
        </div>
      </div>

      <div class="container container-lg">
        <div class="card-deck">
          <?php
          foreach( array_slice($region_child_cats, 0, 3) as $region_child_cat ) : ?>
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">
                  <a class="link-primary" href="<?php echo esc_url( get_term_link( $region_child_cat ) ) ?>"><?php echo $region_child_cat->name; ?></a>
                </h3>
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
                  <ul class="list-unstyled">
                    <?php
                    while ( $loop->have_posts() ) : $loop->the_post(); ?>
                      <li>
                        <a class="link-arrow" href="<?php the_permalink(); ?>">
                          <span><?php the_title(); ?></span>
                          <svg width="24" height="16"><use xlink:href="#icon-link-single-arrow"></use></svg>
                        </a>
                      </li>
                    <?php endwhile; ?>
                  </ul>
                <?php endif; wp_reset_postdata(); ?>
              </div>
            </div><!-- .card -->
          <?php
          endforeach; ?>
        </div><!-- .card-deck -->
      </div>
    </section>

    <section class="ourwork-section section">
      <?php $ourwork_page = get_page_by_path( 'our-work' ); ?>

      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <h2><?php echo $ourwork_page->post_title; ?></h2>
            <?php echo $ourwork_page->post_content; ?>
          </div>
        </div>

        <?php
        $ourwork_cat_id = get_cat_ID( 'Наша работа' );
        $ourwork_args = array(
          'cat' => $ourwork_cat_id,
          'posts_per_page' => 4,
        );
        $ourwork_posts = new WP_Query($ourwork_args);

        if ($ourwork_posts->have_posts()) : ?>
          <div class="ourwork-desktop row">
            <div class="ourwork-tabs col-12 col-md-5">
              <div class="nav flex-column" id="cards-tab" role="tablist" aria-orientation="vertical">
                <?php
                $i = 0;
                while($ourwork_posts->have_posts()) : $ourwork_posts->the_post(); ?>
                  <a class="card <?php if ($i == 0) echo 'active' ?>" id="cards-tab-<?php echo $i ?>" href="#cards-<?php echo $i ?>" data-toggle="tab" role="tab" aria-controls="cards-<?php echo $i ?>" aria-selected="<?php echo ($i == 0) ? 'true' : 'false'; ?>">
                    <div class="card-body">
                      <h6 class="card-title"><?php the_title(); ?></h6>
                      <?php the_excerpt(); ?>
                    </div>
                  </a>
                <?php
                $i++;
                endwhile; ?>
              </div>
            </div>
            <div class="ourwork-content col">
              <div class="tab-content" id="cards-tabContent">
                <?php
                $i = 0;
                while($ourwork_posts->have_posts()) : $ourwork_posts->the_post(); ?>
                  <div class="tab-pane fade <?php if ($i == 0) echo 'show active' ?>" id="cards-<?php echo $i ?>" role="tabpanel" aria-labelledby="cards-tab-<?php echo $i ?>">
                    <?php the_content(); ?>
                  </div>
                <?php
                $i++;
                endwhile; ?>
              </div>
            </div>
          </div>

          <div class="ourwork-mobile">
            <?php
            $i = 0;
            while($ourwork_posts->have_posts()) : $ourwork_posts->the_post(); ?>
              <div class="card card-body">
                <h6 class="card-title"><?php the_title(); ?></h6>
                <?php the_excerpt(); ?>
                <div class="text-center">
                  <button class="btn btn-link link-primary" type="button" data-toggle="collapse" data-target="#collapse-<?php echo $i ?>" aria-expanded="false" aria-controls="collapse-<?php echo $i ?>">Посмотреть полностью</button>
                </div>
                <div class="collapse" id="collapse-<?php echo $i ?>">
                  <div class="mt-4">
                    <?php the_content(); ?>
                  </div>
                </div>
              </div>
            <?php
            $i++;
            endwhile; ?>
          </div>
        <?php
        wp_reset_postdata();
        endif;?>
      </div>
    </section>

    <section class="about-section section">
      <div class="container container-lg">
        <div class="about-section-row row">
          <div class="col-lg-7">
            <h2 class="about-section-title"><?php the_field('about_title'); ?></h2>
            <h4 class="about-section-subtitle"><?php the_field('about_subtitle'); ?></h4>
            <?php the_field('about_text'); ?>
            <div class="mt-4 mt-lg-5">
              <a href="<?php the_field('about_btn_url'); ?>" class="btn btn-default btn-lg">Подробнее о нас</a>
            </div>
          </div>
          <div class="col-lg-5 col-xl-4 offset-xl-1">
            <div class="statistic-card card">
              <div class="card-body">
                <?php
                $about_statistics = get_field('about_statistics');
                foreach( $about_statistics as $about_statistic ): ?>
                  <div class="statistic-item">
                    <h2 class="statistic-item-title"><?php echo $about_statistic['title']; ?></h2>
                    <p class="statistic-item-subtitle"><?php echo $about_statistic['subtitle']; ?></p>
                  </div>
                <?php
                endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- #primary -->

<?php
get_footer();
