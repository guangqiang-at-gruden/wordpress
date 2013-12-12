<?php
class metaBoxPrinter {
	public function printMetaBox( oneMetabox $metaBox ) {
		foreach( $metaBox->options as $oneOption ) {
			$oneOption->currentValue = metaBoxManager::getMetaAdmin( $oneOption->id );
			//var_dump( $oneOption->currentValue );
			if( empty( $oneOption->currentValue )  ) $oneOption->currentValue = $oneOption->std;
			else if( $oneOption->currentValue == metaBoxManager::EMPTY_FIELD ) $oneOption->currentValue = '';
			$oneOption->currentValue = htmlspecialchars( $oneOption->currentValue );
			switch( $oneOption->type ) {
				case 'text' : $this->_printText( $oneOption ); break;
				case 'text-color' : $this->_printTextColor( $oneOption ); break;
				case 'text-img' : $this->_printTextImg( $oneOption ); break;
				case 'select' : $this->_printSelect( $oneOption ); break;
				case 'gallery': $this->_printGallery( $oneOption ); break;
				case 'text-area': $this->_printTextArea( $oneOption ); break;
				case 'text-area-big': $this->_printTextAreaBig( $oneOption ); break;
				case 'check' : $this->_printCheck( $oneOption ); break;
				case 'sidebar' : $this->_printSidebar( $oneOption ); break;
			}
		}
	}
	
	
	
	private function _printText( oneMetaboxOption $oneOpt ) {
		
		echo '<div class="post_settings_item">';
		echo '<h4 class="post_settings_name">'. $oneOpt->title. '</h4>';
		echo '<div class="post_settings_description">'.$oneOpt->description.'</div>';
		echo '<input type="text" name="'.$oneOpt->id.'" id="'.$oneOpt->id.'" value="'.$oneOpt->currentValue.'">';
		echo '</div>';
	}
	
	private function _printTextColor( oneMetaboxOption $oneOpt ) {
		echo '<div class="post_settings_item">';
		echo '<h4 class="post_settings_name">'. $oneOpt->title. '</h4>';
		echo '<div class="post_settings_description">'.$oneOpt->description.'</div>';
		echo '<input class="color-input" type="text" name="'.$oneOpt->id.'" id="'.$oneOpt->id.'" value="'.$oneOpt->currentValue.'" style="width:50px; background-color:#'.$oneOpt->currentValue.', color:#'.$oneOpt->currentValue.';">';
		echo '</div>';
	}
	
	private function _printTextImg( oneMetaboxOption $oneOpt ) {
		echo '<div class="post_settings_item">';
		echo '<h4 class="post_settings_name">'. $oneOpt->title. '</h4>';
		echo '<div class="post_settings_description">'.$oneOpt->description.'</div>';
		echo '<input type="text" name="'.$oneOpt->id.'" id="'.$oneOpt->id.'" value="'.$oneOpt->currentValue.'">';
		echo '<a href="'.site_url().'/wp-admin/media-upload.php?TB_iframe=1" media-upload-link="'. $oneOpt->id .'" class="thickbox add_media button " id="" title="Add Media" onclick="return false;">Upload / Insert</a>';
		echo '</div>';
	}
	
	private function _printCheck( oneMetaboxOption $oneOpt ) {
		$selected = ' ';
		//var_dump($oneOpt->currentValue );
		if( $oneOpt->currentValue === metaBoxManager::CHECKED_FIELD ) {
			$selected = ' checked="checked" ';
		}
		else {
			$selected = ' ';
		}
		
		echo '<div class="post_settings_item">';
		echo '<h4 class="post_settings_name">'. $oneOpt->title. '</h4>';
		echo '<div class="post_settings_description">'.$oneOpt->description.'</div>';
		echo '<input type="checkbox" name="'.$oneOpt->id.'" id="'.$oneOpt->id.'" autocomplete="off" '.$selected.'>';
		echo '</div>';
	}	
	
	private function _printTextAreaBig( oneMetaboxOption $oneOpt ) {
	
		echo '<div class="post_settings_item">';
		echo '<h4 class="post_settings_name">'. $oneOpt->title. '</h4>';
		echo '<div class="post_settings_description">'.$oneOpt->description.'</div>';
		echo '<textarea rows="15" style="width:100%;" name="'.$oneOpt->id.'" id="'.$oneOpt->id.'">'.$oneOpt->currentValue.'</textarea>';
		echo '</div>';
	}
	
	private function _printTextArea( oneMetaboxOption $oneOpt ) {
	
		echo '<div class="post_settings_item">';
		echo '<h4 class="post_settings_name">'. $oneOpt->title. '</h4>';
		echo '<div class="post_settings_description">'.$oneOpt->description.'</div>';
		echo '<textarea name="'.$oneOpt->id.'" id="'.$oneOpt->id.'">'.$oneOpt->currentValue.'</textarea>';
		echo '</div>';
	}	
	
	private function _printSelect( oneMetaboxOption $oneOpt ) {
		echo '<div class="post_settings_item">';
		echo '<h4 class="post_settings_name">'.$oneOpt->title.'</h4>';
		echo '<div class="post_settings_description">'.$oneOpt->description.'</div>';
		echo '<select name="'.$oneOpt->id.'" id="'.$oneOpt->id.'" value="'.$oneOpt->currentValue.'">';
			
				foreach( $oneOpt->values as $oneVal ) {
					$selected = '';
					if( $oneVal['value'] == $oneOpt->currentValue )
						$selected = 'selected="selected"';
					echo '<option '.$selected.' value="'.$oneVal['value'].'">' . $oneVal['name'] . '</value>';
				}
			
		echo '</select>';
		echo '</div>';
	}
	
	
	private function _printSidebar( oneMetaboxOption $oneOpt ) {
		echo '<div class="post_settings_item select_sidebar">';
		echo '<h4 class="post_settings_name">'.$oneOpt->title.'</h4>';
		echo '<select id="'.$oneOpt->id.'" name="'.$oneOpt->id.'" value="'.$oneOpt->currentValue.'">';
			foreach( $oneOpt->values as $oneVal ) {
				$selected = '';
				if( $oneVal['value'] == $oneOpt->currentValue )
					$selected = 'selected="selected"';
				echo '<option '.$selected.' value="'.$oneVal['value'].'">' . $oneVal['name'] . '</value>';
			}
		echo '</select>';
		echo '<a href="'.get_template_directory_uri().'/framework/backend/sidebars/view.php?sidebar_manager_lightbox=1&TB_iframe=1" media-upload-link="slide-1" class="thickbox btn_add_sidebar button button_secondary">Add / Edit</a>';
		echo '</div>';
	}	
	
	private function _printGallery( oneMetaboxOption $oneOpt ) {
		//echo '<div class="thickbox gallery">GALL</div>';
		
		echo '<a href="#" class="custom_media_upload button" data-input-selector="#'.$oneOpt->id.'">Upload / Edit</a>';
		echo '<input type="hidden" id="'.$oneOpt->id.'" name="'.$oneOpt->id.'" class="gallery_input_source" value="'.$oneOpt->currentValue.'">';
		echo '<div class="gallery-image-holder">';
			
			
			if( !empty($oneOpt->currentValue) ) {
				
				$allId = explode( ',',$oneOpt->currentValue );
				$this->printGalleryInside( $allId );
				
			}
		echo '</div>';
		
	}
	
	public function printGalleryInside( $id ) {
		foreach( $id as $oneId ) {
			if( empty( $oneId ) ) continue;
		
			$img = ffGalleryCollection::getImage( $oneId );
			if( empty( $img ) ) continue;
			$url = $img->image->resize(70,70,true);
			echo '<div class="image" data-id="'.$oneId.'">';
			echo '<img width="70" src="'.$url.'">';
			echo '</div>';
		}
		
		echo '<div class="clear"></div>';
	}
	/*
	 * 	$('.thickbox').attachMediaUploader('media-upload-link', function( url, attr) {
		
		$('#' + attr ).val( url );
	 });
	 */
}

