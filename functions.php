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

// Removes formating from WSWIG Editor
function wswigFormat(){
  // Stops the formating when HTML is added in the editor
  remove_filter( 'the_content', 'wpautop' );
  remove_filter( 'the_excerpt', 'wpautop' );
}
wswigFormat();

// Adds necessary NodeGarden.js dependencies
function nodeGarden(){
  // wp_enqueue_style( 'nodeGarden', Get_template_directory_uri() .'/nodegarden/css/nodeGarden.css');
}
nodeGarden();

function materialize(){
   wp_enqueue_style( 'materialize', Get_template_directory_uri() .'/materialize/css/materialize.css');
   wp_enqueue_script( 'materialize_js', Get_template_directory_uri() .'/materialize/js/materialize.js');
}
add_action( 'wp_enqueue_scripts', 'materialize' );

 // navigation menus
 register_nav_menus(array(
   'primary' => __('Primary Menu')
 ));

 register_nav_menus(array(
   'footer-menu' =>__('Footer Menu')
 ));
?>
