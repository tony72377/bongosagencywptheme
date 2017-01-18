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

  wp_deregister_script( 'jquery' );
  wp_register_script( 'jquery', get_template_directory_uri() .'/assets/js/jquery-2.1.1.min.js', false, NULL, true );
  wp_enqueue_script( 'jquery' );
  // Materialize CSS -  http://materializecss.com/
  wp_enqueue_style( 'materialize', Get_template_directory_uri() .'/materialize/css/materialize.css');
  wp_enqueue_script( 'materialize_js', Get_template_directory_uri() .'/materialize/js/materialize.js','','',true);
  // NodeGarden JS - http://nodegardenjs.org
  wp_enqueue_style('nodegarden', Get_template_directory_uri() .'/nodegarden/css/main.css');
  wp_enqueue_script('nodegardenjs', Get_template_directory_uri() .'/nodegarden/js/main.js','','',true);
}
add_action( 'wp_enqueue_scripts', 'includeLibraries' );

// Enqueue any extra custom JS or CSS files here
function themeScripts(){
  // Navigation
  wp_enqueue_script( 'Navigation_scripts', Get_template_directory_uri() .'/assets/js/navigation.js','','',true);

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
    'name' => ('Case Studies'),
    'singular_name' => ('Case Study'),
  );

  $caseStudy_fields = array(
      'title',
      'thumbnail',
      'editor'
  );

  register_post_type( 'Case',
    array(
      'labels' => $caseStudy_labels,
      'supports' => $caseStudy_fields,
      'public' => true,
      'description' => 'Case studies are meant for creating a record of new and previous client work done by Bongos.',
      'has_archive' => 'cases',
      'rewrite' => array('slug' => 'cases'),
      'show_in_nav_menus' => true,
      'show_in_menu' => true,
      'show_ui' => true,
      'register_meta_box_cb' => 'casestudy_meta_location'
    )
  );
}
add_action('init', 'postType_caseStudy');



// Register Casestudy custom meta fields
function casestudy_metabox(){
  add_meta_box(
    'casestudy_description',
    'Case Study Description',
    'casestudy_meta_location',
    'Case',
    'normal'
  );
}
add_action( 'add_meta_boxes', 'casestudy_metabox' );

// Create HTML for casestudy custom meta fields
function casestudy_meta_location(){
  global $post;

  // Noncename needed to verify where the data originated
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	// Get the location data if its already been entered
  $location = get_post_meta($post->ID, '_location', true);
  echo '<label>Case study description</label><br />';
  echo '<input type="text" name="_location" id="casestudy_description" value="' . $location .'" />';
}



function materialize_pagination() {

global $wp_query;

$big = 999999999; // need an unlikely integer

$pages = paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'next_text' => __('>'),
        'prev_text' => __('<'),
        'type'  => 'array',
    ) );
    if( is_array( $pages ) ) {
        $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
        echo '<ul class="pagination">';
        foreach ( $pages as $page ) {
                echo "<li class='waves-effect'>$page</li>";
        }
       echo '</ul>';
        }
}

?>
