<?php

/*

	Template Name: Contact

*/


get_header();
?>
<div class="container">

  <div class="content">

      <div class="hero">

        <p class="title">Let's talk</p>
        <h2>I'm always happy to hear from you.</h2>

      </div><!-- hero -->

      <div class="contact-form">
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
