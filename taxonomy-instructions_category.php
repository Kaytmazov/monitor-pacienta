<?php
/**
 * The template for displaying Instructions Category pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package monitor-pacienta-theme
 */

get_header(); ?>

<main id="primary" class="site-main">

  <header class="page-banner">
    <div class="container">
      <h1 class="page-title mb-0"><?php echo single_term_title( '', true ); ?></h1>
      <?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
    </div>
  </header><!-- .page-bannerr -->

  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <?php
        if ( have_posts() ) : ?>

          <?php
          /* Start the Loop */
          while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <header class="entry-header">
                <?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
              </header><!-- .entry-header -->

              <div class="entry-content">
                <?php
                $full_title = get_field('full_title');

                if ( $full_title ) : ?>
                  <p><?php echo $full_title; ?></p>
                <?php
                else :
                  the_excerpt();
                endif; ?>
              </div><!-- .entry-content -->

              <footer class="entry-footer">
                <a class="link-primary" href="<?php the_permalink(); ?>">
                  <span>Читать полностью</span>
                  <svg width="9" height="13"><use xlink:href="#icon-link-arrows"></use></svg>
                </a>
              </footer><!-- .entry-footer -->
            </article><!-- #post-<?php the_ID(); ?> -->

          <?php
          endwhile;

          the_posts_navigation();

        else :

          get_template_part( 'template-parts/content', 'none' );

        endif; ?>
      </div>
    </div>
  </header>

</main><!-- #primary -->

<?php
get_footer();
