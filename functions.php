<?php

// Cleans wp_head of extra trash
function headOptimize(){
      // Removes extra stuff that wordpress adds into head
      remove_action('wp_head', 'wp_generator');
      remove_action('wp_head', 'wlwmanifest_link');
      remove_action('wp_head', 'rsd_link');
      remove_action('wp_head', 'wp_shortlink_wp_head');
      remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
      // Adds admin filters
      add_filter('the_generator', '__return_false');
      add_filter('show_admin_bar','__return_false');
      // Removes DNS link in header
      remove_action( 'wp_head', 'wp_resource_hints', 2 );
      // Removes Emojis
      remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
      remove_action( 'wp_print_styles', 'print_emoji_styles' );
      // Removes API link in headCleanup
      remove_action( 'wp_head', 'rest_output_link_wp_head');
}
add_action('after_setup_theme', 'headOptimize');

// Stops the formating when HTML is added in the WYSIWYG editor
function removeWYSIWYGFormat(){
  remove_filter( 'the_content', 'wpautop' );
  remove_filter( 'the_excerpt', 'wpautop' );
}
removeWYSIWYGFormat();


// Add any libraries or JS and CSS dependencies here
function includeLibraries(){
  // Jquery 2.1.1
  wp_enqueue_script( 'jQuery', Get_template_directory_uri() .'/assets/js/jquery-2.1.1.min.js');
  // Materialize CSS -  http://materializecss.com/
  wp_enqueue_style( 'materialize', Get_template_directory_uri() .'/materialize/css/materialize.css');
  wp_enqueue_script( 'materialize_js', Get_template_directory_uri() .'/materialize/js/materialize.js');
  // NodeGarden JS - http://nodegardenjs.org
}
add_action( 'wp_enqueue_scripts', 'includeLibraries' );

// Enqueue any extra custom JS or CSS files here
function themeScripts(){
  // Navigation
  wp_enqueue_script( 'Navigation_scripts', Get_template_directory_uri() .'/assets/js/navigation.js');

}
add_action('wp_enqueue_scripts', 'themeScripts');


 // Register navigation menu locations
 register_nav_menus(array(
   'primary' => __('Primary Menu')
 ));

 register_nav_menus(array(
   'footer-menu' =>__('Footer Menu')
 ));

// Register footer widgets
 function footerSidebars() {
  // Footer Section 1
  register_sidebar(array(
    'name' => ('Footer Area 1'),
    'id' => 'footer1',
    'before_widget' => '<div>',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widgetTitle">',
    'after_title' => '</h3>',
  ));
  register_sidebar(array(
    'name' => ('Footer Area 2'),
    'id' => 'footer2',
    'before_widget' => '<div>',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widgetTitle">',
    'after_title' => '</h3>',
  ));
  register_sidebar(array(
    'name' => ('Footer Area 3'),
    'id' => 'footer3',
    'before_widget' => '<div>',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widgetTitle">',
    'after_title' => '</h3>',
  ));
  register_sidebar(array(
    'name' => ('Footer Area 4'),
    'id' => 'footer4',
    'before_widget' => '<div>',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widgetTitle">',
    'after_title' => '</h3>',
  ));
 }
 add_action( 'widgets_init', 'footerSidebars' );


?>
