<?php
get_header();
?>
<div class="container">
  <div class="content">
    <?php
    if( $wp_query->have_posts()):
    while ($wp_query->have_posts()) : $wp_query->the_post();
    the_content();
    endwhile;

    else :
      echo '<p>No result was found.</p>';
    endif;
    ?>
    </div>
</div>
<?php
get_footer();
?>
