<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo ('name');?></title>
    <meta name="description" content="<?php bloginfo ('description');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.4.min.js"><\/script>')</script>
    <script src="<?php echo THEME_JS; ?>/vendor/modernizr-2.6.2.min.js"></script>
    <link rel="stylesheet" href="<?php echo THEMEROOT; ?>/css/normalize.css">
    <link rel="stylesheet" href="<?php echo THEMEROOT; ?>/css/style.css">
    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="main-container">

              <div class="full-width">

                  <header>
                    <a href="<?php bloginfo('home'); ?>"><h1>Bruno Felicio</h1></a>
                    <ul>
                      <li><a href="<?php bloginfo('home'); ?>">Works</a></li>
                      <li><a href="<?php bloginfo('home'); ?>/about">About</a></li>
                      <li><a class="cta" href="<?php bloginfo('home'); ?>/contact">Let's Talk</a></li>
                    </ul>
                  </header><!-- end of header -->

                </div><!-- full-width -->
