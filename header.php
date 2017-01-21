<!DOCTYPE html>
<html>
  <head>
    <title><?php wp_title(); ?><?php bloginfo('name'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" />
    <!-- Importing Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Wordpress Script Enqueue Location -->
    <?php wp_head(); ?>

    <!-- Theme Main Stylesheet -->
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" type="text/css" />

  </head>
  <body>
    <?php
    $postid = get_the_ID();
    $headerTransparency = get_post_meta( $postid ,'_trans', true);
    $headerColor = get_post_meta( $postid ,'_headerColor', true);
    if (is_archive() || is_home()){
      $headerTransparency = 'off';
      $headerColor = 'dark';
    }
    if($headerTransparency != 'on'){
      $showme = 'off';
      $solid = 'solid';
      $headerColor = 'dark';
    }
    elseif($headerTransparency == 'on'){
      $showme = 'on';
      $headerColor = get_post_meta( $postid ,'_headerColor', true);
    }
    ?>
    <!-- Navigation -->
    <div class="navbar-fixed transparency <?php echo $headerColor; ?> <?php echo $solid; ?>">
      <nav>
        <div class="nav-wrapper">
          <a href="<?php echo site_url(); ?> " class="brand-logo"><img id="lightLogo" src="http://bongosagency.com/wp-content/uploads/2016/12/white-logo.svg" /><img id="darkLogo" src="http://bongosagency.com/wp-content/uploads/2016/09/blockLogo-1.svg" /></a>
          <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
          <!-- Gets Main Navigation -->
          <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'right hide-on-med-and-down')); ?>
          <!-- Gets Mobile Navigation -->
          <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'side-nav', 'menu_id' => 'mobile-demo')); ?>
        </div>
      </nav>
    </div>
    <div class="<?php echo $showme; ?>"></div>
