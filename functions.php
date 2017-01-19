<?php

// Cleans wp_head of extra trash

function headOptimize()
{

	// Removes extra stuff that wordpress adds into head

	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_shortlink_wp_head');
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);

	// Adds admin filters

	add_filter('the_generator', '__return_false');

	// Removes DNS link in header

	remove_action('wp_head', 'wp_resource_hints', 2);

	// Removes Emojis

	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');

	// Removes API link in headCleanup

	remove_action('wp_head', 'rest_output_link_wp_head');
}

add_action('after_setup_theme', 'headOptimize');

// Stops the formating when HTML is added in the WYSIWYG editor

function WYSIWYGFormat()
{
	add_theme_support('post-thumbnails');
}

WYSIWYGFormat();

// Add any libraries or JS and CSS dependencies here

function includeLibraries()
{

	// Jquery 2.1.1

	wp_deregister_script('jquery');
	wp_register_script('jquery', get_template_directory_uri() . '/assets/js/jquery-2.1.1.min.js', false, NULL, true);
	wp_enqueue_script('jquery');

	// Materialize CSS -  http://materializecss.com/

	wp_enqueue_style('materialize', Get_template_directory_uri() . '/materialize/css/materialize.css');
	wp_enqueue_script('materialize_js', Get_template_directory_uri() . '/materialize/js/materialize.js', '', '', true);

	// NodeGarden JS - http://nodegardenjs.org

	wp_enqueue_style('nodegarden', Get_template_directory_uri() . '/nodegarden/css/main.css');
	wp_enqueue_script('nodegardenjs', Get_template_directory_uri() . '/nodegarden/js/main.js', '', '', true);
}

add_action('wp_enqueue_scripts', 'includeLibraries');

// Enqueue any extra custom JS or CSS files here

function themeScripts()
{
  // Full Height Containers
  wp_enqueue_script('fullheight_scripts', Get_template_directory_uri() . '/assets/js/fullHeight.js', '', '', true);
	// Navigation
	wp_enqueue_script('Navigation_scripts', Get_template_directory_uri() . '/assets/js/navigation.js', '', '', true);
}

add_action('wp_enqueue_scripts', 'themeScripts');

// Register navigation menu locations

register_nav_menus(array(
	'primary' => __('Primary Menu')
));
register_nav_menus(array(
	'footer-menu' => __('Footer Menu')
));

// Register footer widgets

function sidebars()
{

	// Footer Section 1

	register_sidebar(array(
		'name' => ('Footer Area 1') ,
		'id' => 'footer1',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgetTitle">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => ('Footer Area 2') ,
		'id' => 'footer2',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgetTitle">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => ('Footer Area 3') ,
		'id' => 'footer3',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgetTitle">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => ('Footer Area 4') ,
		'id' => 'footer4',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgetTitle">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => ('Blog') ,
		'id' => 'blogarchive',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgetTitle">',
		'after_title' => '</h3>'
	));
}

add_action('widgets_init', 'sidebars');

function display_posts()
{
	global $post;
	$tonyShortcode = "";
	$tonyShortcode.= "<div class='row'>";
	$my_query = new WP_Query(array(
		'post_type' => 'post',
		'posts_per_page' => 2
	));
	if ($my_query->have_posts()):
		while ($my_query->have_posts()):
			$my_query->the_post();
			$tonyShortcode.= "<div class='col s12 m4'>";
			$tonyShortcode.= "<div class='card '>";
			$tonyShortcode.= "<div class='card-image waves-effect waves-block waves-light'>";
			$tonyShortcode.= "<a href='" . get_permalink() . "'>";
			$tonyShortcode.= "<img src='" . get_the_post_thumbnail_url() . "' />";
			$tonyShortcode.= "</a>";
			$tonyShortcode.= "</div>";
			$tonyShortcode.= "<div class='card-content'>";
			$tonyShortcode.= "<div class='card-title'>";
			$tonyShortcode.= "<h2>" . get_the_title() . " </h2>";
			$tonyShortcode.= "</div>";
			$tonyShortcode.= "<p>" . get_the_excerpt() . "</p>";
			$tonyShortcode.= "<a href='" . get_permalink() . "' class= 'waves-effect waves-light btn blogBtn '>Read more</a>";
			$tonyShortcode.= "</div>";
			$tonyShortcode.= "</div>";
			$tonyShortcode.= "</div>";
		endwhile;
		wp_reset_postdata();
	endif;
	$tonyShortcode.= "</div>";
	return $tonyShortcode;
}

add_shortcode('displayposts', 'display_posts');

// Adding Case Study post_type

function postType_caseStudy()
{
	$caseStudy_labels = array(
		'name' => ('Case Studies') ,
		'singular_name' => ('Case Study')
	);
	$caseStudy_fields = array(
		'title',
		'thumbnail'
	);
	register_post_type('case', array(
		'labels' => $caseStudy_labels,
		'supports' => $caseStudy_fields,
		'public' => true,
		'description' => 'Case studies are meant for creating a record of new and previous client work done by Bongos.',
		'has_archive' => 'cases',
		'rewrite' => array(
			'slug' => 'cases'
		) ,
		'show_in_nav_menus' => true,
		'show_in_menu' => true,
		'show_ui' => true
	));
}

add_action('init', 'postType_caseStudy');

// Register Casestudy custom meta fields

function casestudy_metabox()
{
	add_meta_box('casestudy_description', 'Case Study Information', 'casestudy_meta_location', 'case');
}

add_action('add_meta_boxes', 'casestudy_metabox');

// Create HTML for casestudy custom meta fields

function casestudy_meta_location()
{
	global $post;

	// Noncename needed to verify where the data originated

	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';

	// Get the value if its already been entered

	$clientName = get_post_meta($post->ID, '_client_name', true);
	$description = get_post_meta($post->ID, '_description', true);
	$problem = get_post_meta($post->ID, '_problem', true);
	$solution = get_post_meta($post->ID, '_solution', true);
	echo '<style>.wp-editor-tabs{display:none;}.groupForm{padding:50px 20px;}.groupForm:nth-child(odd){background-color:#f6f6f6;}.groupForm h3{margin:0px 0px 15px;}</style>';
	echo '<div class="groupForm"><h3>Client Name</h3>';
	echo '<input type="text" name="_client_name" style="width:100%;" value="' . $clientName . '"/></div>';

	// Adds description text

	echo '<div class="groupForm"><h3>Description</h3>';
	wp_editor($description, '_description', array(
		'wpautop' => false,
		'media_buttons' => false,
		'textarea_name' => '_description',
		'editor_height' => '200',
		'teeny' => true,
	));
	echo '</div>';

	// Adds problems text

	echo '<div class="groupForm"><h3>Problems Faced</strong></h3>';
	wp_editor($problem, '_problem', array(
		'wpautop' => false,
		'media_buttons' => false,
		'textarea_name' => '_problem',
		'editor_height' => '200'
	));
	echo '</div>';

	// Adds solutions text

	echo '<div class="groupForm"><h3>Our Solution</h3>';
	wp_editor($solution, '_solution', array(
		'wpautop' => false,
		'media_buttons' => false,
		'textarea_name' => '_solution',
		'editor_height' => '200'
	));
	echo '</div>';
}

// Save the Metabox Data

function caseStudy_saveCustomMeta($post_id, $post)
{

	// Check for nonce

	$checkNonce = !wp_verify_nonce($_POST['eventmeta_noncename'], plugin_basename(__FILE__));

	// User can edit

	$userEdit = !current_user_can('edit_post', $post->ID);

	// Validate user

	if ($checkNonce and $userEdit) {
		return $post->ID;
	}

	// We'll put it into an array to make it easier to loop though.

	$caseStudy_Meta['_client_name'] = $_POST['_client_name'];
	$caseStudy_Meta['_problem'] = $_POST['_problem'];
	$caseStudy_Meta['_description'] = $_POST['_description'];
	$caseStudy_Meta['_solution'] = $_POST['_solution'];

	// Add values of $events_meta as custom fields

	foreach($caseStudy_Meta as $key => $value) {
		if ($post->post_type == 'revision') {
		}

		if (get_post_meta($post->ID, $key, FALSE)) {
			update_post_meta($post->ID, $key, $value);
		}
		else {
			add_post_meta($post->ID, $key, $value);
		}

		if (!$value) {
			delete_post_meta($post->ID, $key);
		}
	}
}

add_action('save_post', 'caseStudy_saveCustomMeta', 1, 2); // save the custom fields

// Add transparent header box options

function init_themeOption()
{
	$screens = array(
		'post',
		'page',
		'case'
	);
	foreach($screens as $screen) {
		add_meta_box('create_themeOption', __('Transparent Header', 'layerswp') , 'create_themeOption', $screen, 'side', 'low');
	}
}

add_action('add_meta_boxes', 'init_themeOption');

// Create HTML for casestudy custom meta fields

function create_themeOption()
{
	global $post;

	// Noncename needed to verify where the data originated

	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';

	// Get the value if its already been entered

	$_headerColor = get_post_meta($post->ID, '_headerColor', true);
	if ($_headerColor == 'dark') {
		$isDark = 'selected';
		$isLight = '';
	}
	else {
		$isDark = '';
		$isLight = 'selected';
	}

	echo '<div class=""><h3>Light or Dark Header</h3>';
	echo '<select style="width:100%;" name="_headerColor">';
	echo '<option value="dark" ' . $isDark . '>Dark</option>';
	echo '<option value="light" ' . $isLight . '>Light</option>';
	echo '</select></div>';
}

function save_themeOption($post_id, $post)
{

	// Check for nonce

	$checkNonce = !wp_verify_nonce($_POST['eventmeta_noncename'], plugin_basename(__FILE__));

	// User can edit

	$userEdit = !current_user_can('edit_post', $post->ID);

	// Validate user

	if ($checkNonce and $userEdit) {
		return $post->ID;
	}

	// We'll put it into an array to make it easier to loop though.

	$caseStudy_Meta['_headerColor'] = $_POST['_headerColor'];

	// Add values of $events_meta as custom fields

	foreach($caseStudy_Meta as $key => $value) {
		if ($post->post_type == 'revision') {
		}

		if (get_post_meta($post->ID, $key, FALSE)) {
			update_post_meta($post->ID, $key, $value);
		}
		else {
			add_post_meta($post->ID, $key, $value);
		}

		if (!$value) {
			delete_post_meta($post->ID, $key);
		}
	}
}

add_action('save_post', 'save_themeOption', 1, 2); // save the custom fields

// Archive page pagination

function materialize_pagination()
{
	global $wp_query;
	$big = 999999999; // need an unlikely integer
	$pages = paginate_links(array(
		'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))) ,
		'format' => '?paged=%#%',
		'current' => max(1, get_query_var('paged')) ,
		'total' => $wp_query->max_num_pages,
		'next_text' => __('>') ,
		'prev_text' => __('<') ,
		'type' => 'array'
	));
	if (is_array($pages)) {
		$paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
		echo '<ul class="pagination">';
		foreach($pages as $page) {
			echo "<li class='waves-effect'>$page</li>";
		}

		echo '</ul>';
	}
}

?>
