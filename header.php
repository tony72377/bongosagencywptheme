<!DOCTYPE html>
<html>
  <head>
    <title><?php wp_title(); ?><?php bloginfo('name'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" type="text/css" />
    <!-- Importing Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">
    <!-- Wordpress extra header goodies -->
    <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->

    <?php wp_head(); ?>
  </head>
  <body>

    <nav>
        <div class="nav-wrapper">

          <a href="#" class="brand-logo">Logo</a>
          <div id="nav-mobile" class="right hide-on-med-and-down">
            <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
          </div>
        </div>
      </nav>
