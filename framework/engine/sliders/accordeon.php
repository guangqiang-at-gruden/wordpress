<?php
class fSliderAccordeon extends fSliderObject {
	protected $js_url = '/framework/engine/sliders/js/accordeon.js';
	protected $slider_type_namme = 'accordeon';
	private $slide_min_width = null;
	private $slide_max_width = null;
	private $slide_average_width = null;

	public function printSlider() {
		$template_url = get_template_directory_uri();
		$this->calculateDimensions();
		$style = "width:$this->slider_width"."px; height:" . ($this->slider_height) . "px;";
		$style .= " position:relative; overflow:hidden;";
		$scount = count($this->slides);
		echo '<div class="slider_accordeon_wrapper" style="border: none;">';
		echo '<div style="' . $style . '" class="slider slider_accordeon">';
			$slides_counter = 0;
			foreach( $this->slides as $key=>$one_slide ) {
				$slides_counter++;
				$last_slide = '';
				if( empty( $one_slide['imageUrl']) ) $one_slide['imageUrl'] = get_template_directory_uri().'/images/placeholder.png';
				
				if( $slides_counter == count($this->slides) ) 
					$last_slide = ' one_slide_last';
				$left = $key * $this->slide_average_width;
				echo '<div class="one_slide'.$last_slide.'" style="position:absolute; left:'.$left.'px; width:'.($this->slide_average_width + 5) .'px; overflow:hidden; height:' . $this->slider_height . 'px;" >';
				//var_dump($one_slide['url']);
					echo '<div class="one_slide_hover" style="">';
						
						echo '<img class="slide_image" src="'. fImg::ResizeC($one_slide['imageUrl'], $this->slide_max_width, $this->slider_height, true). '" />';
												
						$height = $this->slider_height - 90;
						$description_width = $this->slide_max_width * 0.5;
						echo '<div style="display:none; opacity:1; background: url(\''.$template_url.'/framework/engine/sliders/img/slider_accordeon_transparent_background.png\') repeat; padding:25px 25px 3px 25px; width:'.($description_width) .'px;  position:absolute; bottom: 40px; left:25px;" class="big_title">';
						if( !empty($one_slide['title']) )
							echo '<h3>'. $one_slide['title']. '</h3>';
						echo $one_slide['description'];
						echo '</div>';
					echo '</div>';
					echo '<div class="shadow_stripe" style="background: url(\''.$template_url.'/images/slider_accordeon_shadow.png\') left repeat-y; width: 50px; position: absolute; right: 0px; top: 0px; height:' . $this->slider_height . 'px; " ></div>';
					$this->printOneSlideSettings($one_slide);
				echo '</div>';
			}
			echo '<div class="clear"></div>';
			echo '<div class="settings" style="display:none">';
				echo '<span class="slide_min_width">'. $this->slide_min_width . '</span>';
				echo '<span class="slide_average_width">'. $this->slide_average_width . '</span>';
				echo '<span class="slide_max_width">'. $this->slide_max_width . '</span>';
				echo '<span class="slider_width">'. $this->slider_width . '</span>';
			echo '</div>';
			$this->printAutoslideSettings();
		echo '</div>';	echo '<img class="slider_accordeon_down_shadow" style="width:' . $this->slider_width . 'px; position: absolute; top:'.$this->slider_height.';" src="'. fImg::ResizeC(get_template_directory_uri() .'/framework/engine/sliders/img/slider_accordeon_down_shadow.png' , $this->slider_width) .'" />';
		echo '</div>';
	}
	
	private function calculateDimensions() {
		$scount = count( $this->slides);	
		$this->slide_min_width = round( ( $this->slider_width * 0.25 ) / $scount - 1 );
		$this->slide_average_width = $this->slider_width / ( $scount );
		$this->slide_max_width = $this->slider_width - ( ($scount -1) * $this->slide_min_width );
	}
	 
	
	public function getSlider() {
		ob_start();
		$this->printSlider();
		$to_return = ob_get_contents();
		ob_end_clean();
		return $to_return;
	}
}

?>