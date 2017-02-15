<?php

/*

	Template Name: About

*/


get_header();
?>

<div class="hero">

  <p class="title">About Me</p>
  <h2>Product Designer</h2>
  <img src="<?php echo THEME_IMAGES; ?>/about-illustration@2x.png" alt="Bruno Felicio Avatar">

</div><!-- hero -->

<div class="container">

  <div class="content">

      <div class="description">

        <?php
        if( $wp_query->have_posts()):
          while ($wp_query->have_posts()) : $wp_query->the_post();
            the_content();
          endwhile;

          else :
            echo '<p>Could\'t find anything. Don\'t worry, this probably isn\'t your fault.</p>';
          endif;
        ?>
      </div>
  </div>
</div>
<?php
get_footer();
?>
