<?php
/*
Template Name: Шаблон для страницы О нас
*/

get_header(); ?>

	<main id="primary" class="site-main">

		<?php
    while ( have_posts() ) : the_post(); ?>

      <div class="about-page-banner">
        <div class="container">
          <h3><?php the_field('banner'); ?></h3>
        </div>
      </div>

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="container">
          <header class="entry-header">
            <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
          </header><!-- .entry-header -->

          <div class="entry-content">
            <?php
              the_content();

              wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'monitor-pacienta-theme' ),
                'after'  => '</div>',
              ) );
            ?>
          </div><!-- .entry-content -->

          <?php if ( get_edit_post_link() ) : ?>
            <footer class="entry-footer">
              <?php
                edit_post_link(
                  sprintf(
                    wp_kses(
                      /* translators: %s: Name of current post. Only visible to screen readers */
                      __( 'Редактировать <span class="screen-reader-text">%s</span>', 'monitor-pacienta-theme' ),
                      array(
                        'span' => array(
                          'class' => array(),
                        ),
                      )
                    ),
                    get_the_title()
                  ),
                  '<span class="badge badge-danger edit-link">',
                  '</span>'
                );
              ?>
            </footer><!-- .entry-footer -->
          <?php endif; ?>
        </div><!-- .container -->
      </article><!-- #post-<?php the_ID(); ?> -->

    <?php
		endwhile; ?>

	</main><!-- #primary -->

<?php
get_footer();
