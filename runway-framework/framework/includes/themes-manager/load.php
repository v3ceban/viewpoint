<?php
/*
	Extension Name: Themes manager
	Extension URI:
	Version: 0.1
	Description: Themes manager module
	Author:
	Author URI:
	Text Domain:
	Domain Path:
	Network:
	Site Wide Only:
*/

// Settings
$fields = array(
	'var' => array(),
	'array' => array()
);

$default = array();

global $settingshortname;

$settings = array(
	'name' => __('Runway Themes', 'framework'),
	'alias' => 'themes',
	'option_key' => $settingshortname.'developer-tools',
	'fields' => $fields,
	'default' => $default,
	'parent_menu' => 'hidden', // managed by framework
	'menu_permissions' => 'administrator',
	'file' => __FILE__,
	'js' => array(
		//'theme',
		FRAMEWORK_URL.'framework/js/jquery-ui.min.js',
		FRAMEWORK_URL.'framework/js/jquery.tmpl.min.js',
	),
	'css' => array(
		FRAMEWORK_URL.'framework/includes/themes-manager/css/style.css',
	),
);

global $developer_tools, $Themes_Manager;

// Required components
include_once 'object.php';

$Themes_Manager = new Themes_Manager_Settings_Object( $settings );

// Load admin components
if ( is_admin() ) {
	include_once 'settings-object.php';
	$developer_tools = new Themes_Manager_Admin( $settings );
}

do_action( 'themes_manager_is_load' );

// Setup a custom button in the title
function title_button_themes( $title ) {

    if(get_bloginfo('version') >= 4){
        $install_url = 'theme-install.php?upload';
    }else{
        $install_url = 'theme-install.php?tab=upload';
    }

	if ( $_GET['page'] == 'themes' ) {
		$title .= ' <a href="'.admin_url('admin.php?page=themes&navigation=new-theme').'" class="add-new-h2">'. __( 'New Theme', 'framework' ) .'</a> <a href="'. admin_url($install_url).'" class="add-new-h2">'. __( 'Install', 'framework' ) .'</a>';
	}
	return $title;
}
add_filter( 'framework_admin_title', 'title_button_themes' );

?>
