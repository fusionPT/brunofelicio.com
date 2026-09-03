<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php // <title> comes from add_theme_support('title-tag') via wp_head(). ?>

    <?php $bf_seo = brunofelicio_seo_meta(); ?>
    <meta name="description" content="<?php echo esc_attr($bf_seo['description']); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="<?php echo esc_attr($bf_seo['title']); ?>" />
    <meta property="og:type" content="<?php echo is_singular() ? 'article' : 'website'; ?>" />
    <meta property="og:url" content="<?php echo esc_url($bf_seo['url']); ?>" />
    <meta property="og:image" content="<?php echo esc_url($bf_seo['image']); ?>" />
    <meta property="og:description" content="<?php echo esc_attr($bf_seo['description']); ?>" />
    <meta property="og:locale" content="<?php echo esc_attr(get_locale()); ?>" />
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo esc_attr($bf_seo['title']); ?>" />
    <meta name="twitter:description" content="<?php echo esc_attr($bf_seo['description']); ?>" />
    <meta name="twitter:image" content="<?php echo esc_url($bf_seo['image']); ?>" />

    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.png" sizes="32x32" />
    
    <link rel="stylesheet" href="<?php echo esc_url(bf_asset('css/normalize.css')); ?>">
    <link rel="stylesheet" href="<?php echo esc_url(bf_asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo esc_url(bf_asset('css/jquery.fancybox.css')); ?>">
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.4.min.js"><\/script>')</script>
    <script src="<?php echo THEME_JS; ?>/vendor/typekit-cache.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script>

  (function(d) {
    var config = {
      kitId: 'mdc7oxx',
      scriptTimeout: 3000,
      async: true
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
</script>
    <script src="<?php echo THEME_JS; ?>/vendor/modernizr-2.6.2.min.js"></script>
    <script src="<?php echo THEME_JS; ?>/vendor/jquery.fancybox.js"></script>
    <!--<script src="<?php echo THEME_JS; ?>/vendor/jquery.lazyload.min.js"></script>-->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>
    <script src="<?php echo esc_url(bf_asset('js/main.js')); ?>"></script>
    <script type="text/javascript">
      (function(c,l,a,r,i,t,y){
          c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
          t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
          y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
      })(window, document, "clarity", "script", "q94a5f4wfy");
    </script>
    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="menu-overlay">
          <a class="logo" href="<?php bloginfo('url'); ?>"><span class="logo-mark">Bruno Felicio</span></a>
          <a href="#" class="close-btn">close</a>
          <ul class="mobile-menu-overlay">
            <li><a class="works" href="<?php bloginfo('url'); ?>"><?php echo pll__('works_menu');?></a></li>
            <?php
              $about_page = get_page_by_path('about', OBJECT, 'page');
              $about_link = $about_page ? get_permalink(pll_get_post($about_page->ID)) : '#';
            ?>
            <li class="about"><a href="<?php echo esc_url($about_link); ?>"><?php echo pll__('about_menu'); ?></a></li>
            <?php
              $contact_page = get_page_by_path('contact', OBJECT, 'page');
              $translated_contact_id = pll_get_post($contact_page->ID, pll_current_language());
              $contact_url = get_permalink($translated_contact_id);
            ?>
            <li><a class="contact" href="<?php echo esc_url($contact_url); ?>"><?php echo pll__('lets_talk_menu'); ?></a></li>
            <?php
              $hireme_page = get_page_by_path('hire-me', OBJECT, 'page');
              $translated_hireme_id = $hireme_page ? pll_get_post($hireme_page->ID, pll_current_language()) : null;

              if ($translated_hireme_id) {
                $hireme_link = get_permalink($translated_hireme_id);
                echo '<li><a class="cta hireme" href="' . esc_url($hireme_link) . '">' . pll__('hire_me') . '</a></li>';
              }
            ?>
            <li class="lang-switcher dropdown">
              <a href="#"><?php echo strtoupper(pll_current_language()); ?> <i class="fa fa-caret-down"></i></a>
              <ul class="submenu">
                <?php
                $languages = pll_the_languages(array('raw' => 1));
                foreach ($languages as $lang) {
                  echo '<li><a href="' . esc_url($lang['url']) . '">' . esc_html(strtoupper($lang['slug'])) . '</a></li>';
                }
                ?>
              </ul>
            </li>
          </ul>

        </div><!-- Mobile menu -->
        <div class="main-container">

              <div class="full-width">



                  <header>
                    <a class="logo" href="<?php bloginfo('url'); ?>"><span class="logo-mark">Bruno Felicio</span></a>

                    <!-- Burguer menu -->
                    <a href="#" class="mobile-menu-toggle">
                      <div class="burger" href="#">Menu</div>
                    </a>

                    <ul class="menu">
                      <li><a class="works" href="<?php bloginfo('url'); ?>"><?php echo pll__('works_menu');?></a></a></li>
                      <?php
                        $about_page = get_page_by_path('about', OBJECT, 'page');
                        $about_link = $about_page ? get_permalink(pll_get_post($about_page->ID)) : '#';
                      ?>
                      <li class="about"><a href="<?php echo esc_url($about_link); ?>"><?php echo pll__('about_menu'); ?></a></li>
                      <?php
                        $contact_page = get_page_by_path('contact', OBJECT, 'page');
                        $translated_contact_id = pll_get_post($contact_page->ID, pll_current_language());
                        $contact_url = get_permalink($translated_contact_id);
                      ?>
                      <li><a class="contact" href="<?php echo esc_url($contact_url); ?>"><?php echo pll__('lets_talk_menu'); ?></a></li>
                      <?php
                        $hireme_page = get_page_by_path('hire-me', OBJECT, 'page');
                        $translated_hireme_id = $hireme_page ? pll_get_post($hireme_page->ID, pll_current_language()) : null;

                        if ($translated_hireme_id) {
                          $hireme_link = get_permalink($translated_hireme_id);
                          echo '<li><a class="cta hireme" href="' . esc_url($hireme_link) . '">' . pll__('hire_me') . '</a></li>';
                        }
                      ?>
                      <li class="lang-switcher dropdown">
                        <a href="#"><?php echo strtoupper(pll_current_language()); ?> <i class="fa fa-caret-down"></i></a>
                        <ul class="submenu">
                          <?php
                          $languages = pll_the_languages(array('raw' => 1));
                          foreach ($languages as $lang) {
                            echo '<li><a href="' . esc_url($lang['url']) . '">' . esc_html(strtoupper($lang['slug'])) . '</a></li>';
                          }
                          ?>
                        </ul>
                      </li>
                    </ul>

                  </header><!-- end of header -->

                </div><!-- full-width -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const dropdownToggles = document.querySelectorAll(".lang-switcher.dropdown > a");

    dropdownToggles.forEach(function(toggle) {
      toggle.addEventListener("click", function(e) {
        e.preventDefault();
        const parent = toggle.closest(".dropdown");
        parent.classList.toggle("open");
      });
    });

    // Optional: close dropdown when clicking outside
    document.addEventListener("click", function(e) {
      dropdownToggles.forEach(function(toggle) {
        const parent = toggle.closest(".dropdown");
        if (!parent.contains(e.target)) {
          parent.classList.remove("open");
        }
      });
    });
  });
</script>
