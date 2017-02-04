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

            <p class="title">TRAINERPLAN</p>
            <h2>Manage Your Athletes and Workout Plans.</h2>

            <div class="top-image">
              <img src="<?php the_field('top_image'); ?>" alt="trainerplan.co">
            </div><!-- top-image -->

          </div><!-- end of hero -->


        <div class="container">
          <div class="content">

            <div class="description">

              <div class="about">
                <h3>Marketing/Product Design</h3>
                <p>
                  The editor must enable the user to quickly and simply edit their portfolio.
                  The UI is very minimal — it gets out of the way and allows you to focus on the design of your website.
                  All changes you make happen live in the editor. I was going for simple, clean and beautiful.
                  It empowers the user to: Easily edit anything they can see, manage and add content,
                  responsively preview their website, and publish/update a live website.
                </p>
              </div>


                <dl class="sidebar">
    							<dd>Client</dd>
    							<dt>Bruno Felicio</dt>
    							<dd>Role</dd>
    							<dt>Lead Designer, Front-end development</dt>
    							<dd>Included</dd>
    							<dt>Responsive site</dt>
    						</dl>

            </div><!-- description -->

            <?php if( have_rows('image_details') ):
               while ( have_rows('image_details') ) : the_row(); ?>
            <div class="image">

              <img src="<?php the_sub_field('image');?>" alt="screenshot">
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
