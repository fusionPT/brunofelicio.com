<?php get_header(); ?>

<div class="container">
  <div class="hero">
  <!--<h2><?php //echo pll__('hero_heading');?></h2>-->
  <h2><?php echo decode_unicode_escape(pll__('hero_heading')); ?></h2>
  </div><!-- end of hero -->

  <?php if (have_posts()) : ?>
      <?php $count = 0; ?>

      <?php while (have_posts()) : the_post(); ?>
          <?php if ($count == 0) : ?>
              <!-- FEATURED ITEM -->
              <div class="pf-featured">
                  <div class="image">
                      <a href="<?php the_permalink(); ?>">
                          <img class="lazy" src="<?php echo THEMEROOT; ?>/img/blank-slate.png" 
                               data-src="<?php the_field('image'); ?>" 
                               alt="<?php the_field('alt'); ?>">
                      </a>
                  </div>
                  <div class="info">
                      <h3><a href="<?php the_permalink(); ?>"><?php the_field('title'); ?></a></h3>
                      <p><?php the_field('description'); ?></p>
                      
                  </div>
              </div>
              <div class="pf-grid"> <!-- Start of grid -->
          <?php else : ?>
              <div class="pf-item">
                  <div class="image">
                      <a href="<?php the_permalink(); ?>">
                          <img class="lazy" src="<?php echo THEMEROOT; ?>/img/blank-slate.png" 
                               data-src="<?php the_field('image'); ?>" 
                               alt="<?php the_field('alt'); ?>">
                      </a>
                  </div>
                  <div class="info">
                      <h3><a href="<?php the_permalink(); ?>"><?php the_field('title'); ?></a></h3>
                      <p><?php the_field('description'); ?></p>
                      
                  </div>
              </div>
              <?php if ($count % 2 == 0) : ?>
                  </div><div class="pf-grid">
              <?php endif; ?>
          <?php endif; ?>
          <?php $count++; ?>
      <?php endwhile; ?>

      <?php if ($count > 1) : ?>
          </div><!-- Close pf-grid -->
      <?php endif; ?>

  <?php else: ?>
      <p>No posts found.</p>
  <?php endif; ?>
</div>

<?php get_footer(); ?>