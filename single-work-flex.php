<?php

/*
 * Template Name: Flex Portfolio Work
 * Template Post Type: post, work
 */

get_header();

?>

          <div class="hero">

            <p class="title"><?php the_field('title');?></p>
            <h2><?php the_field('subtitle');?></h2>

            <div class="top-image" style="background:<?php the_field('bg_color'); ?>">
              <img class="lazy" src="<?php echo THEMEROOT; ?>/img/blank-slate.png" data-src="<?php the_field('top_image'); ?>" alt="<?php the_field('alt'); ?>">
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
                  
    							
                  <dt><a href="<?php the_field('url'); ?>"><?php the_field('url_label'); ?></a></dt>
    						</dl>

            </div><!-- description -->

            <?php

            // check if the flexible content field has rows of data
            if( have_rows('flex_details') ):

                 // loop through the rows of data
                while ( have_rows('flex_details') ) : the_row();

                    if( get_row_layout() == 'flex_image' ): ?>

                      <div class="image-flex">
                        <a class="screenshot" href="<?php the_sub_field('image_url');?>">
                          <img class="lazy" src="<?php echo THEMEROOT; ?>/img/blank-slate.png" data-src="<?php the_sub_field('image_url');?>" alt="<?php the_sub_field('alt');?>">
                        </a>
                        <span class="caption"><?php the_sub_field('caption'); ?></span>
                      </div>
                      
                      <?php

                    elseif ( get_row_layout() == 'flex_text' ):
                        echo "<div class='text-block'><h4>" . get_sub_field('text_block_title') . '</h4>';
                        echo '<p>' . get_sub_field('text_block_description') . '</p></div>';

                    elseif ( get_row_layout() == 'flex_video' ):
                        echo "<div class='text-block'><h4>" . get_sub_field('video_block_title') . '</h4>';
                        echo '<div style="position: relative; padding-bottom: 62.7177700348432%; height: 0;"><iframe src="'. get_sub_field('video_block') .'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe></div>';

                    endif;

                
                   

                endwhile;

            else :

                // no layouts found

            endif;

          ?>

          </div><!-- content -->

        <div class="related">

          <h3>More Projects</h3>

          <?php

            $posttags = wp_get_post_tags($post->ID);
            $first_tag = $posttags[0]->term_id;
            $original_query = $wp_query;
            $wp_query = null;
            $args = array('posts_per_page'=>3,
                        'tag__in' => array($first_tag),
                        'post__not_in' => array($post->ID),
                        'post_type' => 'work'
                      );

            $wp_query = new WP_Query( $args );

            if ( have_posts() ) :
              echo '<ul class="related-items">';

                while (have_posts()) : the_post(); ?>
                      <a href="<?php the_permalink();?>">
                      <?php echo '<li>'; ?>

                      <div class="img-wrapper">
                        <?php the_post_thumbnail('medium'); ?>
                      </div>

                      <div class="thumb-details">
                        <h4>
                          <?php the_title();?>
                        </h4>
                        <span>
                        <?php $post_tags = get_the_tags();

                          if ( $post_tags ) {
                              foreach( $post_tags as $tag ) {

                              echo '<p class="left">'. $tag->name . '</p>';

                              echo '<p class="right">'. get_field('year') . '</p>';
                              }
                          } ?>
                        </span>
                      </div>

                    <?php

                    echo '</li>';
                    echo '</a>';
                endwhile;
                    echo '</ul>';
            endif;

            $wp_query = null;
            $wp_query = $original_query;
            wp_reset_postdata();

          ?>


        </div><!-- end of related -->
    </div><!-- end of container -->
<?php get_footer(); ?>
