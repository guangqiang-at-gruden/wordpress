<?php
class fSliderObject {
	protected $slider_width = 980;
	protected $slider_height = 450;
	protected $slider_padding = array();
	protected $options = array();
	protected $slides = array();
	protected $name = null;
	
	public function setName( $name ) {
		$this->name = $name;
	}
	
	public function setDimensions( $width, $height ) {
		$this->slider_width = $width;
		$this->slider_height = $height;
	}
	
	public function getDimensions() {
		$to_return = array( 'width' => $this->slider_width, 'height'=> $this->slider_height);
		return $to_return;
	}
	
	public function setOptions( $options ) {
		$this->options = $options;
		$this->slider_width = $options['slider-width'];
		$this->slider_height = $options['slider-height'];
	}
	
	public function setPadding( $top, $left, $bottom = false, $right = false) {
		$slider_padding['top'] = $top;
		$slider_padding['left'] = $left;
		$slider_padding['bottom'] = $bottom;
		$slider_padding['right'] = $left;
		
		if( $right )
			$slider_padding['right'] = $right;
		
		if( $bottom )
			$slider_padding['bottom'] = $bottom;		
	}
	
	public function addSlide( $url, $title, $html_code ) {
		$slide_to_add = array();
		$slide_to_add['url'] = $url;
		$slide_to_add['title'] = $title;
		$slide_to_add['html_code']  = $html_code;
		$this->slides[] = $slide_to_add;
	}
	
	public function addNewSlide( $imageUrl, $imageLink, $title, $description, $lightbox, $transition) {
		$slide_to_add = array();
		$slide_to_add['imageUrl'] = $imageUrl;
		$slide_to_add['imageLink'] = $imageLink;
		$slide_to_add['title'] = $title;
		$slide_to_add['description'] = $description;
		$slide_to_add['lightbox'] = $lightbox;
		$slide_to_add['transition'] = $transition;
		
		$this->slides[] = $slide_to_add;
	}
	
	public function printAutoslideSettings() {
		echo '<span class="auto_slide_settings" style="display:none;">';
			
			echo '<span class="auto_slide_interval">';
			// is autosliding enabled? then print the interval
			if( $this->options['slider-autoslide-enable'] == 1 )
				echo $this->options['slider-autoslide-interval'];
			// else print 0 millisecond
			else 
				echo '0';
			echo '</span>';
			
			echo '<span class="current_active_slide">0</span>';
			 
		echo '</span>';
	}
	public function printOneSlideSettings( $one_slide, $title_and_desc_together = false ) {
		echo '<div class="one_slide_settings" style=" width:1px; height:1px; overflow:hidden; ">';
			$img_width = $this->slider_width;
			if( isset( $this->slider_img_width) )
				$img_width = $this->slider_img_width;
			
			$img_height = $this->slider_height;
			if( isset( $this->slider_img_height) )
				$img_height = $this->slider_img_height;

			if( $title_and_desc_together == true && !empty($one_slide['title'])) 
				$one_slide['description'] = '<h3>'.$one_slide['title'].'</h3>' . $one_slide['description'];
			
			if( empty( $one_slide['imageUrl']) && $this->slider_type_name != 'fly' ) $one_slide['imageUrl'] = get_template_directory_uri().'/images/placeholder.png';
			$img_url = fImg::ResizeC( $one_slide['imageUrl'], $img_width, $img_height, true);
			
			
			
			if( $one_slide['lightbox'] == 'lightbox' && empty( $one_slide['imageLink'] ) )
				$one_slide['imageLink'] = $one_slide['imageUrl'];
			
			echo '<img class="imageUrl" src="' . $img_url . '" alt="" />' ;
			echo '<div class="imageLink">' .$one_slide['imageLink'] . '</div>';
			echo '<div class="title">' .$one_slide['title'] . '</div>';
			echo '<div class="description">' .$one_slide['description'] . '</div>';
			echo '<div class="lightbox">' .$one_slide['lightbox'] . '</div>';
			echo '<div class="transition">' .$one_slide['transition'] . '</div>';
			//echo '<img src="' . $img_url . '" />';
		echo '</div>';		
	}
	public function printStyles() {
		
		ob_start();
			$this->printStylesInhered();	
			$content = ob_get_contents();
			fEnv::addFooterContent( $content );
		ob_end_clean();
	}
	
	
	
	public function printScript( $is_preview = false ) {
		
		
		$url = get_template_directory() . $this->js_url;
		
		if( fOpt::GetCurrent( 'slider_script_including', $url ) == NULL ) {
		
			fOpt::SetCurrent( 'slider_script_including', $url, true);
			
			if( $is_preview == true ) {
				$template_url = get_template_directory_uri();
				$skin = fOpt::Get('skins', 'theme-color-skin');
				
				echo ' <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>';
				echo ' <script src="'. $template_url . '/framework/extern/jquery.easing.js"></script>';
				echo ' <script src="'. $template_url . '/js/prettyphoto/js/jquery.prettyPhoto.js' . '"> </script>';
				echo "<link rel='stylesheet' href='" . $template_url . '/global.css' . "' type='text/css' media='all' />";
		 
				echo "<link rel='stylesheet' href='" . $template_url . '/skins/'.$skin.'/'.$skin.'.css' . "' type='text/css' media='all' />";		
				echo "<link rel='stylesheet' href='" . $template_url . '/js/prettyphoto/css/prettyPhoto.css' . "' type='text/css' media='all' />";
			}
			
			
			$handle = fopen($url, 'r');
			$content = fread( $handle,filesize( $url ) );			
			

			
			fEnv::addFooterContent( '<script type="text/javascript">' . $content . '</script>' );
			
			fclose($handle);
		}
	}	


	
}

?>