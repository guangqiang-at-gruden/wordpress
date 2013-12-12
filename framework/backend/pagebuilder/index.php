<?php
		fEnv::addAdminMenu('Template Builder', 'Template Builder', 'fpagebuilder', 3);
		fEnv::addAdminStyle('fpagebuilder', get_template_directory_uri(). '/framework/backend/pagebuilder/style.css');
		fEnv::addAdminStyle('fpagebuilder', get_template_directory_uri(). '/framework/backend/includes/modal_window/modal_window.css');
		fEnv::addAdminStyle('fpagebuilder', get_template_directory_uri(). '/framework/backend/includes/options_header/options_header.css');
		fEnv::addAdminScript('fpagebuilder', get_template_directory_uri(). '/framework/backend/pagebuilder/script.js');
		//fEnv::addAdminScript('fpagebuilder', get_template_directory_uri(). '/framework/extern/jquery_ui/js/jquery-ui-1.9.2.custom.min.js');
		fEnv::addAdminScript('fpagebuilder', get_template_directory_uri(). '/framework/extern/colorbox/jquery.colorbox-min.js');
		fEnv::addAdminScript('fpagebuilder', get_template_directory_uri(). '/framework/backend/pagebuilder/template_managing.js');
		fEnv::addAdminStyle('fpagebuilder', get_template_directory_uri(). '/framework/extern/colorbox/colorbox.css');


add_filter('admin_head','ShowTinyMCE');
function ShowTinyMCE() {
	// conditions here
	wp_enqueue_script( 'common' );
	wp_enqueue_script( 'jquery-color' );
	wp_print_scripts('editor');
	if (function_exists('add_thickbox')) add_thickbox();
	wp_print_scripts('media-upload');
	if (function_exists('ff_tiny_mce')) ff_tiny_mce();
	wp_admin_css();
	wp_enqueue_script('utils');
	do_action("admin_print_styles-post-php");
	do_action('admin_print_styles');
}		
	
	
		
		add_action('wp_ajax_pagebuilder', 'fpagebuilder_callback');
		function fpagebuilder_callback() {
			$component = $_POST['component'];
			//var_dump($_POST);
			$one_component = new $component();
			//echo $one_component;
			echo $one_component->form( false );
			die();
		}
		
		add_action('wp_ajax_pagebuilder_save_page', 'fpagebuilder_save_page_callback');
		function fpagebuilder_save_page_callback() {
			
			$data = $_POST['data'];
			$pb_man = new fpagebuilderManager();
			$pb_man->savePage( $_POST['template_name'],$data);
			
			
			die();
		}		
		
	
		
function fpagebuilder_check_if_templates_exists() {
	$all_pb_templates = fOpt::GetNamespace('pagebuilder_templates');
	if( $all_pb_templates == null ) {
		add_new_pagebuilder_template( 'default' );
	}
}
fpagebuilder_check_if_templates_exists();

