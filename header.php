<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package monitor-pacienta-theme
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
  <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'monitor-pacienta-theme' ); ?></a>
  <header id="masthead" class="site-header">
    <div class="container">
      <nav id="site-navigation" class="main-navigation">
        <button class="btn btn-link btn-menu-toggle" aria-controls="primary-menu" aria-expanded="false">
          <svg class="icon-burger" width="20" height="14"><use xlink:href="#icon-burger"></use></svg>
          <svg class="icon-close" width="14" height="14"><use xlink:href="#icon-close"></use></svg>
        </button>

        <?php
        if ( is_front_page() && is_home() ) : ?>
          <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><h1 class="site-title"><?php bloginfo( 'name' ); ?></h1></a>
        <?php else : ?>
          <a class="navbar-brand site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
        <?php
        endif; ?>

        <?php
          wp_nav_menu( array(
            'theme_location' => 'menu-1',
            'menu_id'        => 'primary-menu',
            'container'      => false
          ) );
        ?>

        <div class="header-right">
          <div class="header-region">
            <?php
            global $region;
            if (isset($_COOKIE['region'])) : ?>
              <button class="btn btn-link btn-region" type="button" data-toggle="modal" data-target="#changeRegionModal">
                <svg width="23" height="23"><use xlink:href="#icon-send"></use></svg>
                <span><?php echo $_COOKIE['region']; ?></span>
              </button>
            <?php
            else: ?>
              <button class="btn btn-link btn-region" type="button" data-toggle="modal" data-target="#changeRegionModal">
                <svg width="23" height="23"><use xlink:href="#icon-send"></use></svg>
                <span><?php echo $region; ?></span>
              </button>

              <div class="region-dropdown">
                <h5 class='region-dropdown-title'>Ваш регион - <?php echo $region; ?>?</h5>
                <div class="text-nowrap">
                  <button class="btn btn-primary btn-sm btn-region-confirm mr-3" id="regionComfirmBtn" type="button" data-region="<?php echo $region ?>">Да, верно</button>
                  <button class="btn btn-link btn-sm" type="button" data-toggle="modal" data-target="#changeRegionModal">Выбрать другой</button>
                </div>
              </div>
            <?php
            endif; ?>
          </div>
          <a class="btn btn-primary btn-help" href="#donate-section">Помочь<span> проекту</span></a>
        </div>
      </nav><!-- #site-navigation -->
    </div>



  </header><!-- #masthead -->
