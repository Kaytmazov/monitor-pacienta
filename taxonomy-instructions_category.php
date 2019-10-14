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

  <div class="container">
    <?php
    if ( have_posts() ) : ?>

      <header class="page-header">
        <h1 class="page-title"><?php echo single_term_title( '', true ); ?></h1>
        <?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
      </header><!-- .page-header -->

      <?php
      /* Start the Loop */
      while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <header class="entry-header">
            <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
          </header><!-- .entry-header -->

          <div class="entry-content">
            <?php
              the_excerpt();

              wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'monitor-pacienta-theme' ),
                'after'  => '</div>',
              ) );
            ?>
          </div><!-- .entry-content -->

          <footer class="entry-footer">
            <?php monitor_pacienta_theme_entry_footer(); ?>
          </footer><!-- .entry-footer -->
        </article><!-- #post-<?php the_ID(); ?> -->

      <?php
      endwhile;

      the_posts_navigation();

    else :

      get_template_part( 'template-parts/content', 'none' );

    endif; ?>
  </div>

</main><!-- #primary -->

<?php
get_footer();
