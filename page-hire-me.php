<?php
/* Template Name: Hire Me Page */
get_header();
?>

<div class="hero">
  <p class="title">Hire Me</p>
  <h2><?php echo get_the_title(); ?></h2>
</div><!-- hero -->

<div class="container">
  <div class="content">

    <section class="pricing-tiers single">
      <div class="plan">
        <h2>Starter</h2>
        <p class="price">€990<span>/month</span></p>
        <ul>
          <li>Unlimited design requests</li>
          <li>1 active request at a time</li>
          <li>Next-day turnaround</li>
          <li>Pause or cancel anytime</li>
        </ul>
        <a class="btn" href="https://buy.stripe.com/test_8x200kc3bdqKelP14m4AU00" target="_blank" rel="noopener">Start with Starter</a>
      </div>
    </section>

  </div><!-- end of content -->
</div><!-- end of container -->

<?php get_footer(); ?>