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
    <h2><?php echo get_theme_mod('hero_heading', 'Let\'s Create Something Awesome Together!'); ?></h2>
    <p class="subheader">Curious? Scroll down and see for yourself.</p>
  </div><!-- end of hero -->

  <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
      <div class="pf-item <?php echo post_password_required() ? 'blurred' : ''; ?>">
          <div class="image">
              <?php if (post_password_required()): ?>
                  <div class="blurred-image">
                      <img class="lazy" src="<?php echo THEMEROOT; ?>/img/blank-slate.png" 
                           data-src="<?php the_field('image'); ?>" 
                           alt="<?php the_field('alt'); ?>">
                      <div class="overlay">
                          
                          <?php echo get_the_password_form(); ?>
                      </div>
                  </div>
              <?php else: ?>
                  <a href="<?php the_permalink(); ?>">
                      <img class="lazy" src="<?php echo THEMEROOT; ?>/img/blank-slate.png" 
                           data-src="<?php the_field('image'); ?>" 
                           alt="<?php the_field('alt'); ?>">
                  </a>
              <?php endif; ?>
          </div>

          <div class="info">
              <?php if (!post_password_required()): ?>
                  <ul>
                      <li><a href="<?php the_permalink(); ?>"><?php the_field('title'); ?></a></li>
                      <li><a class="url" href="<?php the_field('url'); ?>"><?php the_field('url_label'); ?></a></li>
                  </ul>
                  <p><?php the_field('description'); ?></p>
              <?php endif; ?>
          </div>
      </div><!-- end of pf-item -->
  <?php endwhile; ?>

  <!-- End of the MAIN LOOP -->
   <!-- Error modal -->
  <div id="error-modal" class="error-modal">
    <div class="error-modal-content">
        <span class="error-modal-close">&times;</span>
        <p class="error-modal-message">Error message here</p>
    </div>
</div>

</div>
<?php get_footer(); ?>