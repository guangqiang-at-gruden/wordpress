<?php
	fEnv::addAdminStyle('foptions', get_template_directory_uri(). '/framework/backend/options/style.css');
	fEnv::addAdminScript('foptions', get_template_directory_uri(). '/framework/backend/options/controls.js');
	fEnv::addAdminStyle('foptions', get_template_directory_uri(). '/framework/backend/includes/options_table/options_table.css');
	fEnv::addAdminStyle('foptions', get_template_directory_uri(). '/framework/backend/includes/options_header/options_header.css');
 
 
	// saving
	function foptions_save() {
		$all_post_variables = $_POST;
		foreach( $all_post_variables as $one_var => $one_value ) {
			$is_theme_option = strpos($one_var , 'foptions');
			if( $is_theme_option === false ) continue;
			
			
			$one_option = str_replace('foptions-', '', $one_var);
			$one_option_exploded = explode('-', $one_option,2);
			
			$namespace = $one_option_exploded[0];
			$name = $one_option_exploded[1];
			//var_dump( $one_value );
			fOpt::SetInput($namespace, $name, $one_value);
		}
		
		
		$logo_url = fOpt::Get('templates', 'header-logo');
		if( empty($logo_url) ) {
			$color_skin = fOpt::Get('skins', 'theme-color-skin');
			$navigation_skin = fOpt::Get('skins', 'theme-header-skin');
			if( empty( $color_skin) ) $color_skin = 'black';
			$logo_url = get_template_directory_uri() . '/skins/'.$color_skin.'/images/logo_'.$navigation_skin.'.png';
		}
		 
		/*$imgData = fImg::getImgSize( $logo_url );
		
		$img_size = getimagesize( $imgData->old->path );
			if( $img_size !== false )
				fOpt::Set('templates', 'header-logo-size', $img_size[3]);
		*/
		
	}
 
?>