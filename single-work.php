<?php

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

            if( have_rows('image_details') ):

              while ( have_rows('image_details') ) : the_row();?>

            <div class="image">

              <a class="screenshot" href="<?php the_sub_field('image');?>">
                <img class="lazy" src="<?php echo THEMEROOT; ?>/img/blank-slate.png" data-src="<?php the_sub_field('image');?>" alt="<?php the_sub_field('alt');?>">
              </a>

              <div class="text-description">
                <h4><?phpthe_sub_field('title'); ?></h4>
                <p><?php the_sub_field('image_description');?></p>
              </div>

            </div><!-- end of image -->

            <?php

            endwhile;

            else :
              //echo '<p>No result was found.</p>';
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
