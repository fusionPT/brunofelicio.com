<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo ('name');?></title>

    <meta name="description" content="<?php bloginfo ('description');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo THEMEROOT; ?>/css/normalize.css">
    <link rel="stylesheet" href="<?php echo THEMEROOT; ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo THEMEROOT; ?>/css/jquery.fancybox.css">
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.4.min.js"><\/script>')</script>
    <script src="<?php echo THEME_JS; ?>/vendor/typekit-cache.min.js"></script>
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
    <script src="<?php echo THEME_JS; ?>/main.js"></script>
    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="menu-overlay">
          <a class="logo" href="<?php bloginfo('url'); ?>"><h1>Bruno Felicio</h1></a>
          <a href="#" class="close-btn">close</a>
          <ul class="mobile-menu-overlay">
            <li><a class="works" href="<?php bloginfo('url'); ?>">Works</a></li>
            <li><a class="about" href="<?php bloginfo('url'); ?>/about">About</a></li>
            <li><a class="contact" href="<?php bloginfo('url'); ?>/contact">Let's Talk</a></li>
          </ul>

        </div><!-- Mobile menu -->
        <div class="main-container">

              <div class="full-width">



                  <header>
                    <a class="logo" href="<?php bloginfo('url'); ?>"><h1>Bruno Felicio</h1></a>

                    <!-- Burguer menu -->
                    <a href="#" class="mobile-menu-toggle">
                      <div class="burger" href="#">Menu</div>
                    </a>

                    <ul class="menu">
                      <li><a class="works" href="<?php bloginfo('url'); ?>">Works</a></li>
                      <li><a class="about" href="<?php bloginfo('url'); ?>/about">About</a></li>
                      <li><a class="cta contact" href="<?php bloginfo('url'); ?>/contact">Let's Talk</a></li>
                    </ul>

                  </header><!-- end of header -->

                </div><!-- full-width -->
