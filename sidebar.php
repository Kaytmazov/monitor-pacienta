<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package monitor-pacienta-theme
 */

?>

<div id="secondary" class="widget-area">
  <?php
  global $region;

  $region_cat = get_term_by('name', $region, 'instructions_category');

  $region_child_cats = get_terms(
    array(
      'taxonomy'   => 'instructions_category',
      'hide_empty' => false,
      'parent' 		 => $region_cat->term_id
    )
  ); ?>

  <div class="accordion" id="accordionCategories">
    <h5 class="accordion-title">Инструкции</h5>

    <?php
    $current_post_ID = get_the_ID();

    foreach((get_the_terms($current_post_ID, 'instructions_category')) as $term) {
      $currrent_term_name = $term->name;
    }

    $i = 0;
    foreach( $region_child_cats as $region_child_cat ) :
      $isCurrentTerm = $region_child_cat->name == $currrent_term_name; ?>

      <div class="card">
        <button class="btn link-arrow card-header <?php echo ($isCurrentTerm) ? 'current-term' : 'collapsed'; ?>" id="heading-<?php echo $i; ?>" type="button" data-toggle="collapse" data-target="#collapse-<?php echo $i; ?>" aria-expanded="<?php echo ($i == 0) ? 'true' : 'false'; ?>" aria-controls="collapse-<?php echo $i; ?>">
          <span><?php echo $region_child_cat->name; ?></span>
          <svg width="20" height="10"><use xlink:href="#icon-accordion-arrow"></use></svg>
        </button>
        <div id="collapse-<?php echo $i; ?>" class="collapse <?php if ($isCurrentTerm) echo 'show' ?>" aria-labelledby="heading-<?php echo $i; ?>" data-parent="#accordionCategories">
          <div class="card-body">
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
                while ( $loop->have_posts() ) : $loop->the_post();
                  $isCurrentPost = $current_post_ID == get_the_ID(); ?>

                  <li>
                    <a <?php if ($isCurrentPost) echo 'class="link-primary"' ?> href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                  </li>
                <?php endwhile; ?>
              </ul>
            <?php endif; wp_reset_postdata(); ?>
          </div>
        </div>
      </div>
    <?php
    $i++;
    endforeach; ?>

  </div>

	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
