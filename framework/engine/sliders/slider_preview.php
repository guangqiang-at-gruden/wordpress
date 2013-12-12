<?php
add_action('init', 'slider_preview_function');

function slider_preview_function() {

	if( isset( $_GET['show_slider_preview']) &&  $_GET['show_slider_preview'] == 'yes') {
		
		echo '<style> body { background-color: #eeeeee; padding:40px;} </style>';
		$slider_name = $_GET['slider_preview_name'];
		$slider_object =  fSliderFactory::getSlider( $slider_name );
		$dimensions = $slider_object->getDimensions();
		echo '<div class="slider_preview_holder" style="margin:0 auto; width:'. $dimensions['width'].'px;">';
		$slider_object->printSlider();
		
		$slider_object->printScript( true );
		echo '</div>';
		fEnv::printFooterContent();
		die();
	} 
}

class fSliderFactory {
	private static function getSliderFinalClass( $slider_data_name ) {
		// fc = Final Class
		$fc = str_replace('SliderManager', '', $slider_data_name);
		return $fc;
	}
	
	public static function getSlider( $slider_name ) {
		$sdc = new fSliderManagerDataManager();
		$sdo = $sdc->getSlider( $slider_name );
		
		$slider_type = 'fSlider' . $sdo->options->slider_type;
		if( is_object($sdo->options) ) {
			$options = get_object_vars( $sdo->options );
		} else {
			$options = array();
			foreach( $sdo->options as $one_opt ) {
				
				if( $one_opt['name'] == 'slider_type' ) {
					$slider_type= 'fSliderAccordeon';
					$one_opt['std'] = 'Accordeon';
				}
				$options[ $one_opt['name'] ] = $one_opt['std'];
			}
		}
		
		if( $slider_type == 'fSlider' ) $slider_type = 'fSliderAccordeon';
		
		$slider_object = new  $slider_type();	
		$slider_object->setDimensions( $options['slider-width'], $options['slider-height']);
		$slider_object->setOptions( $options );
		foreach( $sdo->slides as $one_slide ) {
			if( $one_slide->transition == '')
				$one_slide->transition = 'fly_right_top';
			$slider_object->addNewSlide( $one_slide->imageUrl, $one_slide->imageLink, $one_slide->title, $one_slide->description, $one_slide->clickAction, $one_slide->transition);
		}
		$slider_object->setName($slider_name);
		return $slider_object;
	}
}
?>