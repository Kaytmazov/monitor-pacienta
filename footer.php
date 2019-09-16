<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package monitor-pacienta-theme
 */

?>

  <footer id="colophon" class="site-footer">
    <div class="site-info">
      <a class="navbar-brand site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
      <?php
      $description = get_bloginfo( 'description', 'display' );
      if ( $description || is_customize_preview() ) : ?>
        <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
      <?php
      endif; ?>
    </div><!-- .site-info -->
  </footer><!-- #colophon -->
</div><!-- #page -->

<!-- Модальное окно "Выбор региона" -->
<div class="modal fade" id="changeRegionModal" tabindex="-1" role="dialog" aria-labelledby="changeRegionModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changeRegionModalTitle">Выбор региона</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <button type="button" class="btn btn-link btn-region-confirm" data-region="Дагестан">Дагестан</button>
        <button type="button" class="btn btn-link btn-region-confirm" data-region="Ингушетия">Ингушетия</button>
        <button type="button" class="btn btn-link btn-region-confirm" data-region="КБР">КБР</button>
      </div>
    </div>
  </div>
</div>

<!-- Модальное окно "Видео" -->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="videoModalTitle">Видео</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="embed-responsive embed-responsive-16by9">
          <?php the_field('video_iframe'); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php wp_footer(); ?>

</body>
</html>
