<?php
/*
Template Name: Шаблон для страницы Инструкции
*/

get_header(); ?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) : the_post(); ?>

			<section class="instructions-section section">

        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <h1><?php the_title(); ?></h1>
              <?php the_content(); ?>
            </div>
          </div>
        </div>

        <div class="container container-lg">
          <div class="card-deck">
            <?php
            global $region;

            $region_cat = get_term_by('name', $region, 'instructions_category');

            $region_child_cats = get_terms(
              array(
                'taxonomy'   => 'instructions_category',
                'hide_empty' => false,
                'parent' 		 => $region_cat->term_id
              )
            );

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

    <?php
		endwhile; ?>

	</main><!-- #primary -->

<?php
get_footer();
