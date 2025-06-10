<?php
/* Template Name: Hire Me Page */
get_header();
?>

<div class="container">
  <div class="content">
     <div class="hero">

        <p class="title"><?php echo pll__('Design Subscription'); ?></p>
        <h2><?php the_title(); ?></h2>

      </div><!-- hero -->

    <section class="how-it-works-grid">
      <div class="steps">
        <div class="step">
          <img class="how-step-img" src="<?php echo get_template_directory_uri(); ?>/img/subscribe.png" alt="<?php echo pll__('Subscribe to your team'); ?>">
          <h3><?php echo pll__('Subscribe to your team'); ?></h3>
          <p><?php echo pll__('Meet your handpicked team of experts led by your dedicated project manager.'); ?></p>
        </div>
        <div class="step">
          <img class="how-step-img" src="<?php echo get_template_directory_uri(); ?>/img/create_requests.png" alt="<?php echo pll__('Create requests'); ?>">
          <h3><?php echo pll__('Create requests'); ?></h3>
          <p><?php echo pll__('Submit design or dev requests to your board — I’ll jump right in.'); ?></p>
        </div>
        <div class="step">
          <img class="how-step-img" src="<?php echo get_template_directory_uri(); ?>/img/complete.png" alt="<?php echo pll__('Review & Complete'); ?>">
          <h3><?php echo pll__('Review & Complete'); ?></h3>
          <p><?php echo pll__('Receive your work, give feedback, and I’ll revise until you\'re happy.'); ?></p>
        </div>
      </div>
    </section>

    <section class="pricing-tiers single">
      <h2><?php echo pll__('One Simple Price'); ?></h2>
      <div class="plan">
        <h3><?php echo pll__('Monthly Subscription'); ?></h3>
        <p class="price">€1.990<span>/<?php echo pll__('month'); ?></span></p>
        <ul>
          <li><?php echo pll__('Unlimited design requests'); ?></li>
          <li><?php echo pll__('1 active request at a time'); ?></li>
          <li><?php echo pll__('Next-day turnaround'); ?></li>
          <li><?php echo pll__('Pause or cancel anytime'); ?></li>
        </ul>
        <a class="btn" href="https://buy.stripe.com/test_8x200kc3bdqKelP14m4AU00" target="_blank" rel="noopener"><?php echo pll__('Start with Starter'); ?></a>
      </div>
    </section>

  </div><!-- end of content -->
</div><!-- end of container -->

<?php get_footer(); ?>