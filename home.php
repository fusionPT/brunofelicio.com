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

        <h2>Hello! I’m Bruno and I design and build beautiful and clean user interfaces.</h2>

      </div><!-- end of hero -->

    <?php

      while ($wp_query->have_posts()) : $wp_query->the_post();

      $attachment_id = get_field('image');
    	$size = get_field('image_size'); // (thumbnail, medium, large, full or custom size)
    	$image = wp_get_attachment_image_src( $attachment_id, $size );
    	// url = $image[0];
    	// width = $image[1];
    	// height = $image[2]; ?>

      <div class="pf-item">

        <div class="image">
          <a href="<?php the_permalink(); ?>"><img class="<?php the_field('image_class'); ?>" src="<?php echo $image[0]; ?>"></a>
        </div>

        <div class="info">
          <ul>
            <li><?php the_field('title'); ?></li>
            <li><a href="<?php the_field('url'); ?>"><?php the_field('url'); ?></a></li>
          </ul>
          <p><?php the_field('description'); ?></p>
        </div>

      </div><!-- end of pf-item -->
    <?php endwhile; ?>

      <!-- End of the MAIN LOOP -->
    </div>  
<?php get_footer(); ?>
