<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
	die();
}


// Content width
if (!isset($content_width)) $content_width = 888; // typical width of content area
// Template size variables
if (!isset($max_content_width)) $max_content_width = 1200; // the largest likely content width
if (!defined('MAX_COLUMNS')) define('MAX_COLUMNS', 12);   // number of columns in layout


#-----------------------------------------------------------------
# Theme Features
#-----------------------------------------------------------------

function theme_features_setup()
{
	// Translation
	load_theme_textdomain('framework', get_template_directory() . '/languages');

	// WP Stuff
	add_editor_style(); // Admin editor styles
	add_theme_support('automatic-feed-links'); // RSS feeds
	add_theme_support('post-formats', array('audio', 'gallery', 'image', 'link', 'quote', 'video')); // Post formats.
	register_nav_menu('primary', __('Primary Menu', 'framework')); // Main menu

	// Post thumbnails
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(1200, 9999);

	// Additional image sizes
	add_image_size('full-width-thumb', 1200, 9999);
	add_image_size('portfolio-thumb',  600, 450, true); // 4x3 ratio, hard crop
	add_image_size('portfolio-thumb-masonry',  600, 9999, true); // unlimited height
	// add_image_size( 'half-width-thumb', 575, 9999 );

	// WooCommerce
	add_theme_support('woocommerce');
	if (function_exists('is_woocommerce')) {
		remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
		remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
		add_action('woocommerce_before_main_content', 'theme_woocommerce_wrapper_start', 10);
		add_action('woocommerce_after_main_content', 'theme_woocommerce_wrapper_end', 10);
		add_action('woocommerce_add_to_cart_message', 'theme_woocommerce_add_to_cart_message', 10);
	}
}
add_action('after_setup_theme', 'theme_features_setup');


#-----------------------------------------------------------------
# Styles and Scripts
#-----------------------------------------------------------------

function theme_styles_and_scripts()
{
	global $wp_styles;

	// JavaScript
	//...............................................

	// Register scripts
	wp_register_script('modernizr',    get_stylesheet_directory_uri() . '/assets/js/modernizr-2.7.1-respond-1.4.0.min.js', array(), '2.7.1');
	wp_register_script('jplayer',      get_stylesheet_directory_uri() . '/assets/js/jquery.jplayer.min.js', array('jquery'), '2.5.0', true);
	wp_register_script('rw_isotope',   get_stylesheet_directory_uri() . '/assets/js/jquery.isotope.min.js', array('jquery'), '1.5.25', true);
	wp_register_script('theme-js',     get_stylesheet_directory_uri() . '/assets/js/onLoad.js', array('jquery'), '1.0', true); // The theme's JS functions

	// Enqueue scripts
	wp_enqueue_script('jquery');
	wp_enqueue_script('modernizr');
	wp_enqueue_script('jplayer');
	wp_enqueue_script('rw_isotope');   // TODO: load only on filtered portfolio pages
	wp_enqueue_script('theme-js');

	// Re-enable jQuery Migrate v1.4.1 from CDN
	wp_deregister_script('jquery-migrate');
	wp_register_script('jquery-migrate', '//cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.4.1/jquery-migrate.min.js', '1.4.1');
	wp_enqueue_script('jquery-migrate');

	// Enable jQuery Migrate v1.4.1 from CDN for admin
	function rf_jquery_migrate_admin_enqueue()
	{
		wp_deregister_script('jquery-migrate');
		wp_register_script('jquery-migrate', '//cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.4.1/jquery-migrate.min.js', '1.4.1');
		wp_enqueue_script('jquery-migrate');
	}
	add_action('admin_enqueue_scripts', 'rf_jquery_migrate_admin_enqueue');

	// Scrolling scripts
	$smoothScroll = get_options_data('options-page', 'smooth-scrolling', '');
	if (isset($smoothScroll) && ($smoothScroll == 'custom-scrollbars' || $smoothScroll == 'custom-scrollbars-no-ff')) {
		wp_register_script('nicescroll',   get_stylesheet_directory_uri() . '/assets/js/jquery.nicescroll.min.js', array('jquery'), '3.5.4', true);
		wp_enqueue_script('nicescroll');
	} elseif (isset($smoothScroll) && $smoothScroll == 'smooth-chrome') {
		wp_register_script('smoothscroll', get_stylesheet_directory_uri() . '/assets/js/jquery.smoothscroll.min.js', array(), '1.2.1', true);
		wp_enqueue_script('smoothscroll');
	}

	wp_localize_script('theme-js', 'data_js', array('ajaxurl' => admin_url('admin-ajax.php')));

	// Threaded comment support
	if (is_singular() && comments_open() && get_option('thread_comments'))
		wp_enqueue_script('comment-reply');

	// Dequeue
	wp_dequeue_script('content-rotator'); // Included in onLoad.js

	// CSS
	//...............................................

	// Default
	wp_enqueue_style('theme-styles', get_stylesheet_uri());

	// Skin
	// $skin = get_theme_skin();
	$skin = apply_filters('theme_skin', 'style-skin-1.css');
	wp_enqueue_style('theme-skin', get_stylesheet_directory_uri() . '/' . $skin, array('theme-styles'));

	// Feature specific
	wp_enqueue_style('fonts', get_stylesheet_directory_uri() . '/assets/css/fonts.css');
	wp_enqueue_style('colorbox', get_stylesheet_directory_uri() . '/assets/css/colorbox.css');

	// IE only
	wp_enqueue_style('theme-ie', get_stylesheet_directory_uri() . '/assets/css/ie.css', array('theme-styles'));
	$wp_styles->add_data('theme-ie', 'conditional', 'lt IE 9');

	// Dequeue
	wp_dequeue_style('content-rotator'); // Included in style.css

	// Fonts
	//...............................................

	// Include Google Fonts
	$googleFonts   = array();
	$gFont_Heading = get_options_data('options-page', 'font-heading-google');
	$gFont_Body    = get_options_data('options-page', 'font-body-google');
	$gFont_Menu    = get_options_data('options-page', 'font-menu-google');

	if (!empty($gFont_Heading)) $googleFonts[] = $gFont_Heading;
	if (!empty($gFont_Body))    $googleFonts[] = $gFont_Body;
	if (!empty($gFont_Menu))    $googleFonts[] = $gFont_Menu;

	if (count($googleFonts)) {
		$gFontList  = str_replace(' ', '+', implode('|', $googleFonts)); // make ready for query string
		$protocol   = is_ssl() ? 'https' : 'http';
		$subsets    = 'latin,latin-ext';
		$query_args = array('family' => $gFontList, 'subset' => $subsets);
		wp_enqueue_style('google-font', add_query_arg($query_args, "$protocol://fonts.googleapis.com/css"), array(), null);
	}
}
add_action('wp_enqueue_scripts', 'theme_styles_and_scripts', 11);

function vellum_theme_menu_orientation($settings)
{

	$layoutStyle = get_options_data('options-page', 'layout-style', 'boxed');

	$settings['wpmega-orientation'] = ($layoutStyle == 'boxed-left' || $layoutStyle == 'full-width-left' || $layoutStyle == 'boxed-right' || $layoutStyle == 'full-width-right') ? 'vertical' : 'horizontal';

	return $settings;
}
add_filter('wp-mega-menu-settings_settings_filter', 'vellum_theme_menu_orientation', 2000);

function ubermenu_custom_menu_item_defaults_lite($defaults)
{
	$cdefs = get_option(UBERMENU_MENU_ITEM_DEFAULTS_OPTION_KEY);
	if ($cdefs) {
		if (is_array($cdefs)) {
			foreach ($cdefs as $key => $val) {
				$defaults[$key] = $val;
			}
		}
	}
	$defaults['item_display'] = 'auto';
	return $defaults;
}
add_filter('ubermenu_menu_item_settings_defaults', 'ubermenu_custom_menu_item_defaults_lite');

function set_theme_mod_nav_menu_locations()
{
	if (is_admin()) {
		$locations_pre = get_theme_mod('nav_menu_locations_pre');
		if (!empty($locations_pre)) {
			set_theme_mod('nav_menu_locations', $locations_pre);
			remove_theme_mod('nav_menu_locations_pre');
		}
	}
}
add_filter('admin_init', 'set_theme_mod_nav_menu_locations');

#-----------------------------------------------------------------
# More stuff...
#-----------------------------------------------------------------

// WooCommerce Helpers
// -----------------------------------------------------------------

if (function_exists('is_woocommerce')) {
	function theme_woocommerce_wrapper_start()
	{
		echo '<div id="primary" class="site-content"><div id="content" role="main">';
	}

	function theme_woocommerce_wrapper_end()
	{
		echo '</div></div>';
	}

	/* filter the &arr; string for aestetic reasons */
	function theme_woocommerce_add_to_cart_message($message)
	{
		return str_replace(' &rarr;', '', $message);
	}
}

add_filter('auto_update_plugin', '__return_false');
add_filter('auto_update_theme', '__return_false');

//widget function
function basic_widget_init()
{
	register_sidebar(array(
		//name for the widget area
		'name' => __('First Footer Area', 'basic'),
		//id for the dynamic_sidebar('primary-widget-area') snippet
		'id' => 'first-footer-area',
		//description for the widget area
		'description' => __('First Footer Area', 'basic'),
		//tag for each widget container
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		//tag for each widget title
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		//name for the widget area
		'name' => __('Second Footer Area', 'basic'),
		//id for the dynamic_sidebar('primary-widget-area') snippet
		'id' => 'second-footer-area',
		//description for the widget area
		'description' => __('Second Footer Area', 'basic'),
		//tag for each widget container
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		//tag for each widget title
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		//name for the widget area
		'name' => __('Third Footer Area', 'basic'),
		//id for the dynamic_sidebar('primary-widget-area') snippet
		'id' => 'third-footer-area',
		//description for the widget area
		'description' => __('Third Footer Area', 'basic'),
		//tag for each widget container
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		//tag for each widget title
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		//name for the widget area
		'name' => __('Fourth Footer Area', 'basic'),
		//id for the dynamic_sidebar('primary-widget-area') snippet
		'id' => 'fourth-footer-area',
		//description for the widget area
		'description' => __('Fourth Footer Area', 'basic'),
		//tag for each widget container
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		//tag for each widget title
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		//name for the widget area
		'name' => __('Categories Aside', 'basic'),
		//id for the dynamic_sidebar('primary-widget-area') snippet
		'id' => 'cat-aside-area',
		//description for the widget area
		'description' => __('Categories Aside', 'basic'),
		//tag for each widget container
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		//tag for each widget title
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
}

add_action('widgets_init', 'basic_widget_init');

// Filter except length to 40 words.
// tn custom excerpt length
function tn_custom_excerpt_length($length)
{
	return 40;
}
add_filter('excerpt_length', 'tn_custom_excerpt_length', 999);
