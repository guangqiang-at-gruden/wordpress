<?php

//require_once 'themeOptions.php';

/**
 * Auto Updating Framework Class
 * @author: freshface
 * @info: this class open our website and if there are some new instructions, it will proceed it automatically.
 * 		  IT WILL UPDATE ONLY the framework folder, nothing more :)
 */

class fFrameworkAutoUpdate {
	private $update_url = 'http://update.freshface.net/update.php';
	private $update_status_url = 'http://update.freshface.net/update_status.php';
	
	
	/**
	 * Open remote url, send them framework and theme versions and check for updates
	 */
	public function getUpdateStatus() {
		if( fOpt::Get('versions', 'next_update_framework_version' ) != null &&  fOpt::Get('versions', 'next_update_theme_version' ) != null ) {
			return fOpt::Get('versions', 'next_update');
		}
		$framework_version = FRAMEWORKVERSION;//fOpt::Get('versions', 'framework_version');
		$theme_version = THEMEVERSION;//fOpt::Get('versions', 'theme_version');
		
		$query = '?framework_version=' . $framework_version . '&theme_version=' . $theme_version . '&theme_name=' . THEMENAME;
		$url = $this->update_status_url . $query;

		$content_of_page = fEnv::openUrl( $url );
		$content_of_page = stripslashes( $content_of_page );
		$content_of_page = unserialize( $content_of_page );
		
		if( isset( $content_of_page['update_avaible']) &&  $content_of_page['update_avaible'] == 'yes' ) {
			fOpt::DeleteNamespace('versions');
			fOpt::Set('versions', 'next_update', $content_of_page['update_text'] );
			fOpt::Set('versions', 'next_update_framework_version', $content_of_page['new_framework_version'] );
			fOpt::Set('versions', 'next_update_theme_version', $content_of_page['new_theme_version']);
			fOpt::Set('versions', 'next_update_theme_text', $content_of_page['update_theme_text']);
			return $content_of_page['update_text'];
		}
		return false;
		
	}
	
	public function update() {
		$framework_version = FRAMEWORKVERSION;//fOpt::Get('versions', 'framework_version');
		$theme_version = THEMEVERSION;//fOpt::Get('versions', 'theme_version');
		
		if( $framework_version == null ) $framework_version = 0;
		if( !$this->permissionTest() ) return false; 
		
		$instructions = $this->getUpdateInstructions();
		
		$this->doUpdate( $instructions );
	}
	
	/**
	 * Clean all the saved values after the update
	 */
	private function cleanAfterUpdate() {
		
	}
	
	/**
	 * Make the final push -> go through the array and update each file
	 */
	private function doUpdate( $instructions ) {
		foreach( $instructions as $path => $file_content ) {
			$new_path = get_template_directory() . $path;
			$file_handle = fopen( $new_path, 'r+');
			if( $file_handle === false ) {
				echo 'Error-> unable to open file: ' . $new_path . "<br>";
				continue;
			}
			
			// save the old content of file, if something goes wrong
			$old_content = fread( $file_handle, filesize( $new_path) );
			if( $old_content === false ) {
				echo 'Error-> unable to read file: ' . $new_path . "<br>";
				fclose( $file_handle );
				continue;
			}
			
			ftruncate($file_handle, 0);
			rewind( $file_handle );
			
			
			// try to save the new content of the file
			$result = fwrite( $file_handle, $file_content );
			if( $result === false ) {
				echo 'Error-> unable to save new file: ' . $new_path . "<br>";
				$result = fwrite( $file_handle, $old_content );
				fclose( $file_handle );
			}
			
			fclose( $file_handle );
			echo 'OK -> file was updated succesfull : ' . $new_path . "<br>";
			
			
		}
	}
	
	/**
	 * Test if we are able to edit / create / delete framework files
	 */
	private function permissionTest() {
		$src_this = get_template_directory() . '/framework/engine/functions/autoupdate.php';
		
		$src = get_template_directory() . '/framework/engine/functions/autoupdatetest/';
		$filename = md5(microtime()) .'.php';
		$src = $src . $filename;
		
		// this file is not writable -> return false;
		if( !is_writable($src_this) ) {
			echo 'Error -> Permission Test -> File is not writable'. "<br>";
			return false;
		}
		echo 'OK -> Permission Test -> File is writable'. "<br>"; 
		
		
		// open file to read & write. If the file does not exists (thats we assume) create it
		$file_handle = fopen( $src, 'w+' );
		if( $file_handle === false ) {
			echo 'Error -> Permission Test -> Unable to open file'. "<br>"; 
			return false;
		}
		echo 'OK -> Permission Test -> File has been openned successful'. "<br>"; 
		
		
		$result = fwrite( $file_handle, md5( time() * 10 ) );
		if( $result === false ) {
			echo 'Error -> Permission Test -> Unable to write into file'. "<br>";  
			return false; 
		}
		echo 'OK -> Permission Test -> File has been changed successful'. "<br>"; 
		
		
		$result = fclose( $file_handle );
		if( $result === false ) {
			echo 'Error -> Permission Test -> Unable to close file'. "<br>"; 
			 return false; 
		}
		echo 'OK -> Permission Test -> File has been closed successful'. "<br>"; 
		
		
		$result = unlink( $src );
		if( $result === false ) {
			echo 'Error -> Permission Test -> Unable to delete file'. "<br>"; 
			return false;
		}
		echo 'OK -> Permission Test -> File has been deleted successfuly'. "<br><br>"; 
		
		
		return true;
	}
	
	private function getUpdateInstructions() {
		$update_content = fEnv::openUrl( $this->update_url );
		$update_content = stripslashes( $update_content );
		$update_content = unserialize( $update_content );
		
		foreach( $update_content as $key=>$value ) {
			$update_content[ $key ] = base64_decode( $value );
		}
	
	//	var_dump($update_content);
		
		if( $update_content['zz'] == 'correct') {
			unset($update_content['zz']);	
			return $update_content;
		}
		else 
			return false;
	}

	/**
	 * Only For Theme Developers. You will send a list of files to this function and it will return the final update file.
	 */
	public function createArrayForUpdate( $arr_files ) {
		// final store for the data	
		$array_to_print = array();
		
		// go through the array of files, open them and compress them
		foreach( $arr_files as $one_file ) {
			$handle = fopen( get_template_directory() . $one_file , 'r');
			$one_file_text = fread( $handle, filesize(get_template_directory() . $one_file) );
			$one_file_text = base64_encode( $one_file_text );
			$array_to_print[ $one_file ] = $one_file_text;
		}
		
		// this string will be checked at the client isde
		$array_to_print['zz'] = base64_encode('correct');
		$array_to_print = addslashes( serialize($array_to_print ));
		
		// return the update file
		//return $array_to_print;
		echo $array_to_print;
		die();
	}
}

$fupdate = new fFrameworkAutoUpdate();

$files = array(
	'/framework/versions.php',
	
);

$upd = new fFrameworkAutoUpdate();

?>