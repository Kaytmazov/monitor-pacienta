<?php
/*
Template Name: Шаблон для страницы Наша работа
*/

get_header(); ?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) : the_post(); ?>

			<section class="ourwork-section main-section">

        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <h1><?php the_title(); ?></h1>
              <?php the_content(); ?>
            </div>
          </div>
        </div>

        <div class="container">
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

    <?php
		endwhile; ?>

	</main><!-- #primary -->

<?php
get_footer();
