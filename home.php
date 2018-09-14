<?php get_header(); ?>
<?php
  $args = array (
      'post_type' => 'work',
      'showposts' => '16',
      'order' => 'DSC',
      'paged' => $paged
  );


  $wp_query = new WP_Query( $args );

?>
    <div class="container">
      <div class="hero">

        <h2>Hello! I'm Bruno and I design and code digital stuff.</h2>
        <p class="subheader">Go ahead, scroll down. Don't be shy <i class="em em-satisfied"></i>.</p>
      </div><!-- end of hero -->

    <?php

      while ($wp_query->have_posts()) : $wp_query->the_post();
?>

      <div class="pf-item">

        <div class="image">
          <a href="<?php the_permalink(); ?>"><img class="lazy" src="<?php echo THEMEROOT; ?>/img/blank-slate.png" data-src="<?php the_field('image'); ?>" alt="<?php the_field('alt'); ?>"></a>
        </div>

        <div class="info">
          <ul>
            <li><?php the_field('title'); ?></li>
            <li><a href="<?php the_field('url'); ?>"><?php the_field('url_label'); ?></a></li>
          </ul>
          <p><?php the_field('description'); ?></p>
        </div>

      </div><!-- end of pf-item -->
    <?php endwhile; ?>

      <!-- End of the MAIN LOOP -->
    </div>
<?php get_footer(); ?>
