<?php

get_header();

$attachment_id = get_field('image');
$size = get_field('image_size'); // (thumbnail, medium, large, full or custom size)
$image = wp_get_attachment_image_src( $attachment_id, $size );

$attachment_id_details = get_field('image_details');
$size_details = 'inner-image'; // (thumbnail, medium, large, full or custom size)
$image_detail = wp_get_attachment_image_src( $attachment_id_details, $size_details );

?>

          <div class="hero">

            <p class="title"><?php the_field('title');?></p>
            <h2><?php the_field('subtitle');?></h2>

            <div class="top-image" style="background:<?php the_field('bg_color'); ?>">
              <img src="<?php the_field('top_image'); ?>" alt="<?php the_field('alt'); ?>">
            </div><!-- top-image -->

          </div><!-- end of hero -->


        <div class="container">
          <div class="content">

            <div class="description">

              <div class="about">
                <h3>About <?php the_field('title');?></h3>
                
                <p>
                  <?php the_field('description_big');?>
                </p>
              </div>


                <dl class="sidebar">
    							<dd>Client</dd>
    							<dt><?php the_field('client');?></dt>
    							<dd>Role</dd>
    							<dt><?php the_field('role');?></dt>
    							<dd>Included</dd>
    							<dt><?php the_field('included');?></dt>
    						</dl>

            </div><!-- description -->

            <?php if( have_rows('image_details') ):
               while ( have_rows('image_details') ) : the_row(); ?>
            <div class="image">

              <img src="<?php the_sub_field('image');?>" alt="<?php the_sub_field('alt');?>">
              <p><?php the_sub_field('image_description');?></p>

            </div><!-- image -->
<?php
            endwhile;

            else :
              echo '<p>No result was found.</p>';
            endif;
            ?>

          </div><!-- content -->
        </div><!-- end of container -->

<?php get_footer(); ?>
