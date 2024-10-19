<?php

/*

	Template Name: About

*/


get_header();

  $args_sp = array (
      'post_type' => 'sideprojects',
      'showposts' => '4',
      'order' => 'DSC',
      'paged' => $paged
  );


  $wp_query_sp = new WP_Query( $args_sp );

?>

<div class="hero">

  <p class="title">About Me</p>
  <h2>Passionate Design with Purpose.</h2>
  <!--<img class="avatar" src="<?php //echo THEME_IMAGES; ?>/about-avatar.png" alt="Bruno Felicio Avatar">-->
  <div class="designer-avatar"><img src="<?php echo THEME_IMAGES; ?>/bruno-avatar.png" alt="Bruno Felicio Avatar"></div>

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
      </div><!-- end of description -->

  <!-- Sideprojects -->


    <!--<div class="related">

    <h3>Side Projects</h3>

    <ul class="related-items">
    <?php //while ($wp_query_sp->have_posts()) : $wp_query_sp->the_post(); ?>
      <a href="<?php //the_field('url'); ?>">
        <li>
          <div class="img-wrapper">
            <img src="<?php //the_field('thumb'); ?>" alt="<?php //the_field('name'); ?>">
          </div>

          <div class="thumb-details">
            <h4>
              <?php //the_field('name'); ?>
            </h4>
            <span>

              <p></p>

              <p class="text"><?php //the_field('description'); ?>
              <p class="link"><?php //the_field('url_label'); ?>
            </span>
          </div>

        </li>
      </a>
      <?php //endwhile; ?>
    </ul>
  </div> end of related -->

  </div><!-- end of content -->
</div><!-- end of container -->
<?php
get_footer();
?>
