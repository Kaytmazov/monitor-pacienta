<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package monitor-pacienta-theme
 */

get_header(); ?>

	<main id="primary" class="site-main">
    <div class="container">

      <section class="error-404 not-found hentry">
        <header class="page-header">
          <h1 class="page-title">Страница не найдена (404)</h1>
        </header><!-- .page-header -->

        <div class="page-content">
          <p>Страница, на которую вы хотели перейти, не найдена. Возможно, введен некорректный адрес или страница была удалена.</p>
          <a class="link-primary" href="/">Перейти на главную страницу</a>

        </div><!-- .page-content -->
      </section><!-- .error-404 -->

    </div><!-- .container -->
	</main><!-- #primary -->

<?php
get_footer();
