<?php get_header(); ?>

<div class="container">
  <div class="hero">
    <h2><?php echo get_theme_mod('hero_heading', 'Let\'s Create Something Awesome Together!'); ?></h2>
  </div><!-- end of hero -->

  <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
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
  <?php else: ?>
      <p>No posts found.</p>
  <?php endif; ?>
</div>

<?php get_footer(); ?>