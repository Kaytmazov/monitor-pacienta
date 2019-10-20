<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package monitor-pacienta-theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="container">
    <div class="mobile-categories">
      <?php
      foreach((get_the_terms($post->ID, 'instructions_category')) as $term) {
        $currrent_term_name = $term->name;
      }

      global $region;

      $region_cat = get_term_by('name', $region, 'instructions_category');

      $region_child_cats = get_terms(
        array(
          'taxonomy'   => 'instructions_category',
          'hide_empty' => false,
          'parent' 		 => $region_cat->term_id
        )
      ); ?>

      <?php
      foreach( $region_child_cats as $region_child_cat ) : ?>
        <a class="btn btn-sm <?php echo ($region_child_cat->name == $currrent_term_name) ? 'btn-default' : ''; ?>" href="<?php echo esc_url( get_term_link( $region_child_cat ) ) ?>">
          <?php echo $region_child_cat->name; ?>
        </a>
      <?php
      endforeach; ?>
    </div>

    <div class="row">
      <header class="entry-header col-lg-8">
        <?php
        $full_title = get_field('full_title');

        if ( $full_title ) : ?>
          <h1 class="screen-reader-text"><?php echo $full_title; ?></h1>
          <h2 class="instruction-page-title"><?php echo $full_title; ?></h2>
        <?php
        else : ?>
          <h1 class="instruction-page-title"><?php the_title(); ?></h1>
        <?php
        endif; ?>
      </header><!-- .entry-header -->
    </div>
  </div><!-- .container -->

  <div class="instruction-page-subtitle-wrapper">
    <div class="container">
      <p>Пошаговая инструкция как надо дейсвовать в подобной ситуации</p>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-7">
        <div class="entry-content">
          <?php the_content(); ?>
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
      </div>

      <aside class="col-lg-4 offset-lg-1">
        <?php get_sidebar(); ?>
      </aside>
    </div>
  </div><!-- .container -->
</article><!-- #post-<?php the_ID(); ?> -->
