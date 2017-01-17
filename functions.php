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
function WYSIWYGFormat(){
  remove_filter( 'the_content', 'wpautop' );
  remove_filter( 'the_excerpt', 'wpautop' );
  add_theme_support( 'post-thumbnails' );
}
WYSIWYGFormat();


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
 function sidebars() {
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
  register_sidebar(array(
    'name' => ('Blog'),
    'id' => 'blogarchive',
    'before_widget' => '<div>',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widgetTitle">',
    'after_title' => '</h3>',
  ));
 }
 add_action( 'widgets_init', 'sidebars' );

function display_posts() {
  global $post;
  $tonyShortcode = "";
  $tonyShortcode .= "<div class='row'>";
  $my_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 2 ));
  if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();

 $tonyShortcode .= "<div class='col s12 m4'>";
  $tonyShortcode .= "<div class='card '>";
    $tonyShortcode .= "<div class='card-image waves-effect waves-block waves-light'>";
      $tonyShortcode .= "<a href='" . get_permalink() . "'>";
        $tonyShortcode .= "<img src='" . get_the_post_thumbnail_url() . "' />";
      $tonyShortcode .= "</a>";
    $tonyShortcode .= "</div>";
    $tonyShortcode .= "<div class='card-content'>";
    $tonyShortcode .= "<div class='card-title'>";
      $tonyShortcode .= "<h2>" . get_the_title() . " </h2>";
    $tonyShortcode .= "</div>";
      $tonyShortcode .= "<p>" . get_the_excerpt() . "</p>";
    $tonyShortcode .= "<a href='" . get_permalink() . "' class= 'waves-effect waves-light btn blogBtn '>Read more</a>";
    $tonyShortcode .= "</div>";
    $tonyShortcode .= "</div>";
 $tonyShortcode .= "</div>";

               endwhile;
                wp_reset_postdata();
              endif;
$tonyShortcode .= "</div>";
              return $tonyShortcode;
             }
add_shortcode( 'displayposts', 'display_posts' );

// Adding Case Study post_type
function postType_caseStudy(){

  $caseStudy_labels = array(
    'name' => ('Case Study'),
    'singular_name' => ('Movie'),
  );
  register_post_type( 'Case',
    array(
      'labels' => $caseStudy_labels,
      'public' => true,
      'description' => 'test',
      'has_archive' => 'cases',
      'rewrite' => array('slug' => 'cases'),
      'show_in_nav_menus' => true,
      'show_in_menu' => true,
      'show_ui' => true,
    )
  );
}
add_action('init', 'postType_caseStudy');
?>
