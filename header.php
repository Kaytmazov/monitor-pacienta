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

  //  ::1
  //  77.87.100.161 - Ингушетия
  //  194.28.75.138 - КБР
  //  185.147.95.255 - madrid



  // setcookie('region', $region, time()+31500000);
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
        <?php
        if ( is_front_page() && is_home() ) : ?>
          <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><h1 class="site-title"><?php bloginfo( 'name' ); ?></h1></a>
        <?php else : ?>
          <a class="navbar-brand site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
        <?php
        endif; ?>

        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'monitor-pacienta-theme' ); ?></button>
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
              Ваш регион: <?php echo $region; ?>?<br>
              <button class="btn btn-primary btn-sm btn-region-confirm" id="regionComfirmBtn" type="button" data-region="<?php echo $region ?>">Да</button>
              <button class="btn btn-secondary btn-sm" type="button" data-toggle="modal" data-target="#changeRegionModal">Выбрать другой</button>
            <?php
            endif; ?>
          </div>
          <button class="btn btn-primary btn-help" type="button">Помочь проекту</button>
        </div>
      </nav><!-- #site-navigation -->
    </div>



  </header><!-- #masthead -->
