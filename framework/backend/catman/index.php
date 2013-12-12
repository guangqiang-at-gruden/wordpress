<?php


	fEnv::addAdminStyle('fcatman', get_template_directory_uri(). '/framework/backend/catman/style.css');
	fEnv::addAdminScript('fcatman', get_template_directory_uri(). '/framework/backend/catman/controls.js');
	fEnv::addAdminScript('fcatman', get_template_directory_uri(). '/framework/backend/catman/sidebar_manager.js');
	fEnv::addAdminStyle('fcatman', get_template_directory_uri(). '/framework/backend/includes/options_header/options_header.css');
	fEnv::addAdminMenu('Site Preferences', 'Site Preferences', 'fcatman', 1);
	
	
	
	
	// Ajax Function for handeling the requests
	add_action('wp_ajax_catman', 'catman_callback');

	function catman_callback() {
		
		switch( $_POST['subaction'] ) {
			case 'save':
				catman_save();
				break;
			case 'load':
				catman_load();
				break;
			case 'duplicate':
				catman_duplicate();
		}
		 
		die(); // this is required to return a proper result
	}
	
	function catman_duplicate() {
		$parent_cat = $_POST['category_selected'];
		
		// if its not category id, let JS know something goes wrong
		if( !is_numeric($parent_cat) ) {
			echo 'false';
			return false;
		}
		
		// get all childs of current category
		$all_categories = get_categories( array('child_of'=>$parent_cat, 'hide_empty' => false ) );
		
		// check if we have some categories to edit
		if( empty( $all_categories ) ) {
			echo 'false';
			return false;
		}
	}
	
	function catman_save() {
		//var_dump($_POST['counter']);
		var_dump ( isset($_POST[0]['category_selected'] ) );
		//var_dump ( isset($_POST[1] ) );
		//var_dump ( isset($_POST[2] ) );
		for( $i = 0; $i < $_POST['counter']; $i++ ) {
			$actual_cat_data = $_POST[$i];
			
			$cat_sel = $actual_cat_data['category_selected'];
			if( empty($cat_sel) ) continue;
			
			$cat_data = $actual_cat_data['category_data'];
			
			foreach( $cat_data as $key=> $value ){
				fOpt::Set('cm-cat-opt-' . $cat_sel, $key, $value);
				echo $key . '->' . $value ."\n\n";
			}
			$sin_data = $actual_cat_data['single_data'];
			foreach( $sin_data as $key=> $value ){
				fOpt::Set('cm-sin-opt-' . $cat_sel, $key, $value);
			}
			
			$category_template = $actual_cat_data['category_template'];
			$single_template = $actual_cat_data['single_template'];
			
			fOpt::Set('cm-cat-opt-' . $cat_sel , 'category_template', $category_template);
			fOpt::Set('cm-sin-opt-' . $cat_sel , 'single_template', $single_template);
		}
		
	}

	function catman_load() {
		
		$to_print = array();
		
		
		$cat_sel = $_POST['category_selected'];
		if( empty($cat_sel) ) die();
		
		
		
		$cat_data = fOpt::GetNamespace( 'cm-cat-opt-'.$cat_sel );
		
		if( $cat_data == null || count($cat_data) < 5 ) {
			
			$default_data = catman_default_data();
			$cat_default_data = $default_data['cat_opt'];
			
			foreach( $cat_default_data as $one_cat_default_data ) {
				$cat_data[ $one_cat_default_data['id'] ] = $one_cat_default_data['std'];
				
			}
			
		} 
		$to_print['cat_data'] = $cat_data;
				
		$sin_data = fOpt::GetNamespace( 'cm-sin-opt-'.$cat_sel );
		
		if( $sin_data == null ) {
			
			$default_data = catman_default_data();
			$sin_default_data = $default_data['sin_opt'];
			
			foreach( $sin_default_data as $one_sin_default_data ) {
				$sin_data[ $one_sin_default_data['id'] ] = $one_sin_default_data['std'];
			}
			
		} 
			
		$to_print['sin_data'] = $sin_data;
		
		$to_print['category_template'] = fOpt::Get( 'cm-cat-opt-'.$cat_sel, 'category_template' );
		$to_print['single_template'] = fOpt::Get( 'cm-sin-opt-'.$cat_sel, 'single_template' );	
			


		
		
		$to_print = json_encode( $to_print );
		
		echo $to_print;
	}
	
	function catman_default_data() {
		$catman = fcreate_category_options_store();
		
		$category_options = $catman->getCategoryOptions();
		$single_options = $catman->getSingleOptions();
		
		$to_return['cat_opt'] = $category_options;
		$to_return['sin_opt'] = $single_options;
		
		return $to_return;
	}
?>