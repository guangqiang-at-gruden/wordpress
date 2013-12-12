<?php
 /**
  * fLoader
  * 
  * Browse directories and automatically load the files. Good 
  */
  

 
class fLoader {
	public static $loadedFiles = array();
	
	public static function loadTemplates( $dir ) {
		if (is_dir($dir)) {
		    if ($dh = opendir($dir)) {
		        while (($file = readdir($dh)) !== false) {
		        	$filetype = filetype( $dir . $file );
					if( $filetype == 'file' && strpos( $file, '.php') != false ) {
						//require_once $dir . $file;
						self::parseTemplate( $dir , $file );						
					}
				}
		        closedir($dh);
		    }
		}	
	}
	
	private static function parseTemplate( $dir, $file ) {
		$template_data_names = fSettings::$template_data_names;
		$template_data = get_file_data( $dir. $file, $template_data_names );
		$template_data['Filename'] = basename( $dir ).'/' . $file;
 		fEnv::addTemplate( $template_data );
	}
	
	/**
	 * loadFolder
	 * 
	 * load all .php files located directly in the folder ( no sub folders )
	 */
	public static function loadFolder( $dir ) {
		if (is_dir($dir)) {
		    if ($dh = opendir($dir)) {
		        while (($file = readdir($dh)) !== false) {
		        	$filetype = filetype( $dir . $file );
					
					if( $filetype == 'file' && strpos( $file, '.php') != false ) {
						
						require_once $dir . $file;						
					}
				}
		        closedir($dh);
		    }
		}	
	}
	
	/**
	 * Require Once all files and subfiles in the folder
	 * @param string Absolute path to the folder
	 * @return void
	 */	
	public static function loadFolderRecursive( $path ) {
		// read all elements in current folder
		$elements_in_current_folder = self::readFolder( $path );

		// go through all elements in folder. If its file, then require. If its folder, then load
		foreach( $elements_in_current_folder as $one_el ) {
			if( $one_el['type'] == 'file'  && strpos( $one_el['path'],'.php') !== false) {
				//echo $one_el['path'] . "\n";
				self::$loadedFiles[] = $one_el['path'];
				require_once $one_el['path'];
			} else if ( $one_el['type'] == 'dir' ) {
				self::loadFolderRecursive( $one_el['path'].'/' );
			}
		}
	}
	
	/**
	 * Find all files / dirs in the first level of the folder
	 * 
	 * @param string Absolute path to the folder
	 * @return array of files / dirs
	 */
	public static function readFolder( $path ) {
		$list_of_elements = array();				// we will be returning this
		
		// go through all elements in the folder and store them in the array
		if ( is_dir( $path ) ) {		
		    if ( $dh = opendir( $path ) ) {
		        while ( ( $file = readdir($dh) ) !== false) {
		        	
		        	$filetype = filetype( $path . $file );
					if( ( $filetype == 'file' || $filetype == 'dir' ) && $file != '.' && $file != '..' ) {
						// store info about element into array, so we dont need to call filetype function again
						$one_element = array( 'path' => $path.$file, 'type' => $filetype );
						$list_of_elements[] = $one_element;
					}
					
		        		
				}
		        closedir($dh);
		    }
		}
		// sort the array A-Z
		sort($list_of_elements);
		// return sorted array
		return $list_of_elements;
	}
	public static function getLoadedFiles() {
		foreach( self::$loadedFiles as $key => $oneFile ) {
			self::$loadedFiles[ $key ] = str_replace( ABSPATH, '', $oneFile);
		}
		
		return self::$loadedFiles;
	}
	public static function loadForEndUser() {
		
		( is_admin() ) ? $pathes = fLoaderData::$pathesAdmin : $pathes = fLoaderData::$pathesUser;
		foreach( $pathes as $onePath ) {
			require_once ABSPATH . $onePath;
		}
	}
} 
class fLoaderData {
	public static $pathesAdmin = 

array (
  0 => 'wp-content/themes/edison/framework/deploy/themeOptions.php',
  1 => 'wp-content/themes/edison/framework/loadfirst/aaCategoryOptionsStore.php',
  2 => 'wp-content/themes/edison/framework/loadfirst/baseclasses.php',
  3 => 'wp-content/themes/edison/framework/loadfirst/csshelper.php',
  4 => 'wp-content/themes/edison/framework/loadfirst/environment.php',
  5 => 'wp-content/themes/edison/framework/loadfirst/loader.php',
  6 => 'wp-content/themes/edison/framework/loadfirst/ndebugger.php',
  7 => 'wp-content/themes/edison/framework/loadfirst/necessary.php',
  8 => 'wp-content/themes/edison/framework/loadfirst/zhooks.php',
  9 => 'wp-content/themes/edison/framework/loadfirst/zsidebar.php',
  10 => 'wp-content/themes/edison/framework/engine/functions/autoupdate.php',
  11 => 'wp-content/themes/edison/framework/engine/functions/bautoupdate-test.php',
  12 => 'wp-content/themes/edison/framework/engine/functions/breadcrumbs.php',
  13 => 'wp-content/themes/edison/framework/engine/functions/freshizer.php',
  16 => 'wp-content/themes/edison/framework/engine/functions/javascriptcss.php',
  17 => 'wp-content/themes/edison/framework/engine/functions/pagination.php',
  18 => 'wp-content/themes/edison/framework/engine/functions/shortcodes-pagebuilder.php',
  19 => 'wp-content/themes/edison/framework/engine/functions/shortcodes.php',
  20 => 'wp-content/themes/edison/framework/engine/functions/templater.php',
  21 => 'wp-content/themes/edison/framework/engine/functions/urlrewriter.php',
  22 => 'wp-content/themes/edison/framework/engine/sliders/aadefaultobject.php',
  23 => 'wp-content/themes/edison/framework/engine/sliders/accordeon.php',
  24 => 'wp-content/themes/edison/framework/engine/sliders/cubes.php',
  25 => 'wp-content/themes/edison/framework/engine/sliders/fly.php',
  26 => 'wp-content/themes/edison/framework/engine/sliders/logo.php',
  27 => 'wp-content/themes/edison/framework/engine/sliders/slider3d.php',
  28 => 'wp-content/themes/edison/framework/engine/sliders/slider_preview.php',
  29 => 'wp-content/themes/edison/framework/engine/sliders/tabbed.php',
  30 => 'wp-content/themes/edison/framework/engine/widgets/recentPosts.php',
  31 => 'wp-content/themes/edison/framework/engine/widgets/testimonial.php',
  32 => 'wp-content/themes/edison/framework/engine/widgets/twitter.php',
  33 => 'wp-content/themes/edison/printers/adef.php',
  34 => 'wp-content/themes/edison/printers/category.php',
  35 => 'wp-content/themes/edison/printers/components/accordeon.php',
  36 => 'wp-content/themes/edison/printers/components/alert_box.php',
  37 => 'wp-content/themes/edison/printers/components/box_with_image.php',
  38 => 'wp-content/themes/edison/printers/components/button.php',
  39 => 'wp-content/themes/edison/printers/components/category_preview.php',
  40 => 'wp-content/themes/edison/printers/components/contact_form.php',
  41 => 'wp-content/themes/edison/printers/components/divider.php',
  42 => 'wp-content/themes/edison/printers/components/features_list.php',
  43 => 'wp-content/themes/edison/printers/components/heading.php',
  44 => 'wp-content/themes/edison/printers/components/image.php',
  45 => 'wp-content/themes/edison/printers/components/pricing.php',
  46 => 'wp-content/themes/edison/printers/components/slider.php',
  47 => 'wp-content/themes/edison/printers/components/slogan.php',
  48 => 'wp-content/themes/edison/printers/components/social_button.php',
  49 => 'wp-content/themes/edison/printers/components/success_stories.php',
  50 => 'wp-content/themes/edison/printers/components/tabs.php',
  51 => 'wp-content/themes/edison/printers/components/testimonial.php',
  52 => 'wp-content/themes/edison/printers/components/text.php',
  53 => 'wp-content/themes/edison/printers/components/text_shadow_box.php',
  54 => 'wp-content/themes/edison/printers/components/twitter.php',
  55 => 'wp-content/themes/edison/printers/components/video.php',
  56 => 'wp-content/themes/edison/printers/page.php',
  57 => 'wp-content/themes/edison/printers/pagination.php',
  58 => 'wp-content/themes/edison/printers/post.php',
  59 => 'wp-content/themes/edison/framework/backend/catman/data.php',
  60 => 'wp-content/themes/edison/framework/backend/catman/index.php',
  61 => 'wp-content/themes/edison/framework/backend/catman/view.php',
  62 => 'wp-content/themes/edison/framework/backend/help/index.php',
  63 => 'wp-content/themes/edison/framework/backend/options/data.php',
  64 => 'wp-content/themes/edison/framework/backend/options/index.php',
  65 => 'wp-content/themes/edison/framework/backend/options/view.php',
  66 => 'wp-content/themes/edison/framework/backend/pagebuilder/atemplate_managing.php',
  67 => 'wp-content/themes/edison/framework/backend/pagebuilder/index.php',
  68 => 'wp-content/themes/edison/framework/backend/pagebuilder/view.php',
  69 => 'wp-content/themes/edison/framework/backend/sidebars/view.php',
  70 => 'wp-content/themes/edison/framework/backend/slidermanager/data-admin.php',
  71 => 'wp-content/themes/edison/framework/backend/slidermanager/data-sliders.php',
  72 => 'wp-content/themes/edison/framework/backend/slidermanager/data-view.php',
  73 => 'wp-content/themes/edison/framework/backend/slidermanager/freshslider.php',
  74 => 'wp-content/themes/edison/framework/backend/slidermanager/template-managing.php',
  75 => 'wp-content/themes/edison/framework/backend/writepanels/aclasses.php',
  76 => 'wp-content/themes/edison/framework/backend/writepanels/editor_custom_script.php',
  77 => 'wp-content/themes/edison/framework/backend/writepanels/post_writepanels.php',
);
	
	public static $pathesUser = 

array (
  0 => 'wp-content/themes/edison/framework/deploy/themeOptions.php',
  1 => 'wp-content/themes/edison/framework/loadfirst/aaCategoryOptionsStore.php',
  2 => 'wp-content/themes/edison/framework/loadfirst/baseclasses.php',
  3 => 'wp-content/themes/edison/framework/loadfirst/csshelper.php',
  4 => 'wp-content/themes/edison/framework/loadfirst/environment.php',
  5 => 'wp-content/themes/edison/framework/loadfirst/loader.php',
  6 => 'wp-content/themes/edison/framework/loadfirst/ndebugger.php',
  7 => 'wp-content/themes/edison/framework/loadfirst/necessary.php',
  8 => 'wp-content/themes/edison/framework/loadfirst/zhooks.php',
  9 => 'wp-content/themes/edison/framework/loadfirst/zsidebar.php',
  10 => 'wp-content/themes/edison/framework/engine/functions/autoupdate.php',
  11 => 'wp-content/themes/edison/framework/engine/functions/bautoupdate-test.php',
  12 => 'wp-content/themes/edison/framework/engine/functions/breadcrumbs.php',
  13 => 'wp-content/themes/edison/framework/engine/functions/freshizer.php',
  16 => 'wp-content/themes/edison/framework/engine/functions/javascriptcss.php',
  17 => 'wp-content/themes/edison/framework/engine/functions/pagination.php',
  18 => 'wp-content/themes/edison/framework/engine/functions/shortcodes-pagebuilder.php',
  19 => 'wp-content/themes/edison/framework/engine/functions/shortcodes.php',
  20 => 'wp-content/themes/edison/framework/engine/functions/templater.php',
  21 => 'wp-content/themes/edison/framework/engine/functions/urlrewriter.php',
  22 => 'wp-content/themes/edison/framework/engine/sliders/aadefaultobject.php',
  23 => 'wp-content/themes/edison/framework/engine/sliders/accordeon.php',
  24 => 'wp-content/themes/edison/framework/engine/sliders/cubes.php',
  25 => 'wp-content/themes/edison/framework/engine/sliders/fly.php',
  26 => 'wp-content/themes/edison/framework/engine/sliders/logo.php',
  27 => 'wp-content/themes/edison/framework/engine/sliders/slider3d.php',
  28 => 'wp-content/themes/edison/framework/engine/sliders/slider_preview.php',
  29 => 'wp-content/themes/edison/framework/engine/sliders/tabbed.php',
  30 => 'wp-content/themes/edison/framework/engine/widgets/recentPosts.php',
  31 => 'wp-content/themes/edison/framework/engine/widgets/testimonial.php',
  32 => 'wp-content/themes/edison/framework/engine/widgets/twitter.php',
  33 => 'wp-content/themes/edison/printers/adef.php',
  34 => 'wp-content/themes/edison/printers/category.php',
  35 => 'wp-content/themes/edison/printers/components/accordeon.php',
  36 => 'wp-content/themes/edison/printers/components/alert_box.php',
  37 => 'wp-content/themes/edison/printers/components/box_with_image.php',
  38 => 'wp-content/themes/edison/printers/components/button.php',
  39 => 'wp-content/themes/edison/printers/components/category_preview.php',
  40 => 'wp-content/themes/edison/printers/components/contact_form.php',
  41 => 'wp-content/themes/edison/printers/components/divider.php',
  42 => 'wp-content/themes/edison/printers/components/features_list.php',
  43 => 'wp-content/themes/edison/printers/components/heading.php',
  44 => 'wp-content/themes/edison/printers/components/image.php',
  45 => 'wp-content/themes/edison/printers/components/pricing.php',
  46 => 'wp-content/themes/edison/printers/components/slider.php',
  47 => 'wp-content/themes/edison/printers/components/slogan.php',
  48 => 'wp-content/themes/edison/printers/components/social_button.php',
  49 => 'wp-content/themes/edison/printers/components/success_stories.php',
  50 => 'wp-content/themes/edison/printers/components/tabs.php',
  51 => 'wp-content/themes/edison/printers/components/testimonial.php',
  52 => 'wp-content/themes/edison/printers/components/text.php',
  53 => 'wp-content/themes/edison/printers/components/text_shadow_box.php',
  54 => 'wp-content/themes/edison/printers/components/twitter.php',
  55 => 'wp-content/themes/edison/printers/components/video.php',
  56 => 'wp-content/themes/edison/printers/page.php',
  57 => 'wp-content/themes/edison/printers/pagination.php',
  58 => 'wp-content/themes/edison/printers/post.php',
  59 => 'wp-content/themes/edison/framework/frontend/breadcrumbs.php',
);
}
?>