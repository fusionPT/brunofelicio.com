<?php
/* Template Name: Hire Me Page */
get_header();
?>

<div class="container">
  <div class="content">
     <div class="hero">

        <p class="title"><?php echo pll__('Design Subscription'); ?></p>
        <h1><?php the_title(); ?></h1>

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
        <a class="btn" href="https://buy.stripe.com/8x200kc3bdqKelP14m4AU00" target="_blank" rel="noopener"><?php echo pll__('Start with Starter'); ?></a>
        <?php
          // Secondary, lower-commitment path for visitors not ready to commit to
          // EUR 1.990/mo outright - without it the page can only convert instant
          // buyers and everyone else leaves no trace.
          $bf_contact = bf_contact_url();
          if ($bf_contact) :
        ?>
          <a class="btn-secondary" href="<?php echo esc_url($bf_contact); ?>"><?php echo pll__('Have a question? Get in touch'); ?></a>
        <?php endif; ?>
      </div>
    </section>

    <section class="faq">
      <h2><?php echo pll__('Frequently Asked Questions'); ?></h2>
      <details class="faq-item">
        <summary><?php echo pll__('When can I expect to receive my designs?'); ?></summary>
        <p><?php echo pll__('Most tasks are delivered within 48 hours. More complex work might need a bit more time.'); ?></p>
      </details>
      <details class="faq-item">
        <summary><?php echo pll__('What happens after I subscribe?'); ?></summary>
        <p><?php echo pll__('You’ll get access to a shared Notion board where you can start posting requests right away.'); ?></p>
      </details>
      <details class="faq-item">
        <summary><?php echo pll__('Who’s behind the work?'); ?></summary>
        <p><?php echo pll__('It’s just me — I handle all the design and dev work personally.'); ?></p>
      </details>
      <details class="faq-item">
        <summary><?php echo pll__('Is there a limit to how many requests I can make?'); ?></summary>
        <p><?php echo pll__('No limit! You can add as many requests as you’d like to your queue — I’ll work on one at a time.'); ?></p>
      </details>
      <details class="faq-item">
        <summary><?php echo pll__('How does the pause feature work?'); ?></summary>
        <p><?php echo pll__('You can pause your subscription anytime. This stops billing and lets you resume later without losing progress.'); ?></p>
      </details>
      <details class="faq-item">
        <summary><?php echo pll__('How do you handle large or complex projects?'); ?></summary>
        <p><?php echo pll__('For larger scopes, I break them down into manageable chunks and work through them request by request.'); ?></p>
      </details>
      <details class="faq-item">
        <summary><?php echo pll__('What tools do you use for design and development?'); ?></summary>
        <p><?php echo pll__('I mainly use Figma for design and Webflow or custom code (HTML/CSS/JS) for development tasks.'); ?></p>
      </details>
      <details class="faq-item">
        <summary><?php echo pll__('How do I send you requests?'); ?></summary>
        <p><?php echo pll__('Use the Notion board to add detailed descriptions, links, or references for each request.'); ?></p>
      </details>
      <details class="faq-item">
        <summary><?php echo pll__('What if I’m not happy with the result?'); ?></summary>
        <p><?php echo pll__('No worries — I’ll keep improving it until you’re satisfied. Unlimited revisions are included.'); ?></p>
      </details>
      <details class="faq-item">
        <summary><?php echo pll__('Are there any services you don’t offer?'); ?></summary>
        <p><?php echo pll__('Yes. I don’t offer video editing, 3D work, or long-term maintenance contracts.'); ?></p>
      </details>
      <details class="faq-item">
        <summary><?php echo pll__('Can I sign up for just one task?'); ?></summary>
        <p><?php echo pll__('Sure! Subscribe for a month, send your request, and pause or cancel anytime after.'); ?></p>
      </details>
      <details class="faq-item">
        <summary><?php echo pll__('Do you offer refunds?'); ?></summary>
        <p><?php echo pll__('Because this is a service-based model, I don’t offer refunds once work begins.'); ?></p>
      </details>
      <details class="faq-item">
        <summary><?php echo pll__('Can I try it just for a month?'); ?></summary>
        <p><?php echo pll__('Definitely. Many clients start with a single month — you’re free to pause or cancel whenever you like.'); ?></p>
      </details>
    </section>
  </div><!-- end of content -->
</div><!-- end of container -->

<?php get_footer(); ?>