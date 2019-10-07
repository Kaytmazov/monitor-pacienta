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
  <section id="donate-section" class="donate-section section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <h2><?php the_field('donate_title', 5); ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
          <?php
          $donate_texts = get_field('donate_texts', 5);
          foreach( $donate_texts as $donate_text ): ?>
            <div class="donate-text-item">
              <h4 class="donate-text-title"><?php echo $donate_text['title']; ?></h4>
              <p class="donate-text-desc"><?php echo $donate_text['desc']; ?></p>
            </div>
          <?php
          endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <footer id="footer" class="site-footer section">
    <?php
    $contacts_page = get_page_by_path( 'contacts' );
    $contacts_page_id = 8;
    ?>

    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-xl-7">
          <div class="footer-contacts">
            <h2><?php echo $contacts_page->post_title; ?></h2>
            <?php
            global $region;

            $regions_map = [
              'Дагестан'  => '',
              'Ингушетия' => 'ingushetia_',
              'КБР'       => 'kbr_'
            ];

            $contacts_id = 8;
            $contacts_field = $regions_map[$region] . 'contacts';

            if( have_rows($contacts_field, $contacts_id) ):
              while( have_rows($contacts_field, $contacts_id) ): the_row();

                $socials = get_sub_field('socials');
                $messengers = get_sub_field('messengers');
                $address = get_sub_field('address');
                $phone = get_sub_field('phone');

                if ( $socials ) : ?>
                  <div class="socials-wrapper">
                    <h4 class="socials-title">Следите за нами в социальных сетях</h4>
                    <div class="socials-list">
                      <?php
                      foreach( $socials as $social ):
                        $item = $social['item']; ?>

                        <a class="social-item item-<?php echo $item['value']; ?>" href="<?php echo $social['url']; ?>" target="_blank">
                          <svg width="48" height="48"><use xlink:href="#icon-<?php echo $item['value']; ?>"></use></svg>
                          <span><?php echo $item['label']; ?></span>
                        </a>
                      <?php
                      endforeach; ?>
                    </div>
                  </div>
                <?php
                endif; ?>

                <div class="contacts-item">
                  <span class="contacts-item-key">Написать нам:</span>
                  <div class="contacts-item-value">
                    <?php
                    if ( $messengers ) :
                      foreach( $messengers as $messenger ):
                        $item = $messenger['item']; ?>

                        <a class="messenger-item item-<?php echo $item; ?>" href="<?php echo $messenger['url']; ?>" target="_blank">
                          <svg width="48" height="48"><use xlink:href="#icon-<?php echo $item; ?>"></use></svg>
                        </a>
                      <?php
                      endforeach; ?>
                    <?php
                    endif; ?>

                    <a class="contacts-item-phone" href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
                  </div>
                </div>
                <div class="contacts-item">
                  <span class="contacts-item-key">Наш адрес:</span>
                  <div class="contacts-item-value"><?php echo $address; ?></div>
                </div>

              <?php endwhile; ?>

            <?php endif; ?>
          </div>
          <div class="site-info">
            <h3 class="footer-brand"><a class="link-primary site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h3>
            <?php
            $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : ?>
              <h5 class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></h5>
            <?php
            endif; ?>
          </div><!-- .site-info -->
        </div>
        <div class="col">
          <div class="footer-bg">
            <img class="img-fluid" src="<?php echo bloginfo('template_url'); ?>/img/svg/footer-bg.svg" alt="">
          </div>
        </div>
      </div>
    </div>
  </footer><!-- #footer -->
</div><!-- #page -->

<!-- Модальное окно "Выбор региона" -->
<div class="regions-modal modal fade" id="changeRegionModal" tabindex="-1" role="dialog" aria-labelledby="changeRegionModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg class="icon-close" width="14" height="14"><use xlink:href="#icon-close"></use></svg>
        </button>
      </div>
      <div class="modal-body">
        <img class="mb-5" src="<?php echo bloginfo('template_url'); ?>/img/svg/region-modal.svg" width="161" height="161" alt="">
        <p class="text-primary">Выберите ваш регион</p>
        <div class="regions-btns">
          <button type="button" class="btn btn-link btn-region-confirm" data-region="Дагестан">Дагестан</button>
          <button type="button" class="btn btn-link btn-region-confirm" data-region="Ингушетия">Ингушетия</button>
          <button type="button" class="btn btn-link btn-region-confirm" data-region="КБР">КБР</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Модальное окно "Видео" -->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header pb-0">
        <h5 class="modal-title" id="videoModalTitle"><?php the_field('video_title'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg class="icon-close" width="14" height="14"><use xlink:href="#icon-close"></use></svg>
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

<!-- Svg Sprite -->
<div class="sr-only">
  <?php echo file_get_contents( get_stylesheet_directory_uri() . '/img/sprite.svg' ); ?>
</div>

<?php wp_footer(); ?>

</body>
</html>
