<?php
/**
 * fSliderTabbed class
 *
 * @package default
 * @author  
 */
class fSliderTabbed extends fSliderObject{
	protected $js_url = '/framework/engine/sliders/js/tabbed.js';
	protected $slider_img_width = null;
	protected $slider_img_height = null;
	protected $slider_type_name = 'tabbed';
	private $slider_prefix = null;
	/**
	 * printSlider
	 *
	 * @return void
	 * @author  
	 */
	function printSlider() {
		$this->slider_prefix = 'slider_tabbed_'.  rand(0,time() );
		$this->calculateAllDimensions();
		
		echo '<div class="slider_tabbed_wrapper">';
		echo '<div class="slider_tabbed '. $this->slider_prefix .'">';
			$this->printAutoslideSettings();
			$this->printImageArea();
			$this->printGreyStripe();
			
		echo '</div>';
		$this->printStyles();	
	}
	private function calculateAllDimensions() {
		$this->slider_img_width = $this->slider_width;
		$this->slider_img_height = $this->slider_height - 65;
	}
	
	private function printDescriptionBox() {
		
	}
	
	private function printImageArea() {
		$first_slide = $this->slides[0];
		echo '<div class="image_area">';
			echo '<div class="big_image_holder">';
			
				$style= '';
				if( $first_slide['description'] == '' || $first_slide['description'] == ' ')
					$style = ' style="display:none;" ';
				echo '<div class="one_slide_text_holder" ' . $style . '>';
					echo '<div class="one_slide_text_content">';
						echo $first_slide['description'];
					echo '</div>';
				echo '</div>';				
			
				echo '<div class="primary_image_holder">';
					if( empty( $first_slide['imageUrl']) ) $first_slide['imageUrl'] = get_template_directory_uri().'/images/placeholder.png';
					echo '<img src="'. fImg::ResizeC($first_slide['imageUrl'], $this->slider_img_width, $this->slider_img_height, true) . '">';
				echo '</div>';
				echo '<div class="secondary_image_holder">';
					echo '<img>';
				echo '</div>';
				

			echo '</div>';
		echo '</div>';
		echo '<div class="slider_tabbed_inner_shadow"></div>';
	}
	
	private function printGreyStripe() {
		echo '<div class="grey_stripe">';
		echo '<div class="grey_stripe_left"></div>';
		echo '<div class="one_slide_tab_container">';
		
		foreach( $this->slides as $index=>$one_slide ) {
			$grey_shadow_button = 'grey_shadow_button';
			if( $index == ( count( $this->slides ) - 1 ) )
				$grey_shadow_button = '';
			if( $index == 0 ) {
				$grey_shadow_button .= ' one_slide_tab_active tab_selected';
				//echo 'debil';
			}
			
			echo '<div class="one_slide_tab_wrapper">';
			echo '<div class="one_slide_tab '.$grey_shadow_button.'">';
				echo '<div class="tab_arrow"></div>';
				echo $one_slide['title'];
				$this->printOneSlideSettings( $one_slide );
			echo '</div>';
			echo '</div>';
		}
		
		
		echo '</div>';
		echo '<div class="grey_stripe_right"></div>';
		echo '</div>';
		echo '</div>';
		echo '<img src="' . get_template_directory_uri() . '/framework/engine/sliders/img/slider_tabbed_down_shadow.png" class="slider_tabbed_down_shadow" style="width:' . $this->slider_width . 'px; position: absolute; top:'.$this->slider_height.';">';

	}
	
	public function printStylesInhered() {
		$background_image = get_template_directory_uri(). '/framework/engine/sliders/img/slider_tabbed_bg.png';
		$background_image = "url('" . $background_image . "')";
		
		$background_image_dark = get_template_directory_uri(). '/framework/engine/sliders/img/slider_tabbed_transparent_background.png';
		$background_image_dark = "url('" . $background_image_dark . "')";
		
		
		$css1 = new fCssHelper( '.'.$this->slider_prefix );
		$css1->addStyle('width', $this->slider_width,'px');
		$css1->addStyle('height', $this->slider_height,'px');
		
		$css1->addStyle('position', 'relative');
		

		
		$css = new fCssHelperContainer('.grey_stripe');
		$css->setPrefix( '.'.$this->slider_prefix );
		$css->addStyle('position', 'absolute');
		//$css->addStyle('border', '1px solid black');
		$css->addStyle('width', ($this->slider_width) + 100,'px');
		$css->addStyle('height', 65,'px');
		$css->addStyle('background-position', 'center bottom');
		$css->addStyle('top', $this->slider_height - 65,'px');
		$css->addStyle('margin-left', -50,'px');
		//$css->addStyle('padding-left', 50,'px');
		//$css->addStyle('padding-right', 50,'px');
		
		
		$css->setSelector('.one_slide_tab_wrapper');
		$css->addStyle('width', (100 / count($this->slides)), '%');
		$css->addStyle('float', 'left');
		
		$css->setSelector('.one_slide_tab');
		//$css->addStyle('width', ($this->slider_width / count($this->slides)) - 2, 'px');
		//$css->addStyle('height', 40,'px');
		//$sth->addStyle('color', '#ffffff');
		$css->addStyle('font-size', 18, 'px');
		$css->addStyle('line-height', 22, 'px');
		$css->addStyle('padding-top', 23, 'px');
		$css->addStyle('padding-bottom', 20, 'px');
		//$css->addStyle('padding-right', 4, 'px');
		$css->addStyle('text-align', 'center');
		$css->addStyle('position', 'relative');
		$css->addStyle('cursor', 'pointer');
		$css->addStyle('border-right', '1px solid rgba(0,0,0,0.06)');
		$css->addStyle('border-left', '1px solid rgba(255,255,255,0.9)');
		$css->addStyle('color', '#9a9a9a');
		$css->addStyle('text-shadow', '0 1px 0 #ffffff');
			
		$css5 = new fCssHelper('.one_slide_tab_wrapper:last-child .one_slide_tab');
		$css5->addStyle('border-right', 'none !important');
		
		$css6 = new fCssHelper('.one_slide_tab_wrapper:first-child .one_slide_tab');
		$css6->addStyle('border-left', 'none !important');
		
		$css->setSelector('.one_slide_text_holder');
		$css->addStyle('position', 'absolute');
		$css->addStyle('z-index', '4');
		//$css->addStyle('height', ( $this->slider_height - 65 ) * 0.7, 'px' );
		//$css->addStyle('top', ( $this->slider_height - 65 ) * 0.3, 'px');
		//$css->addStyle('height', ( $this->slider_height - 65 - 40 ), 'px' );
		$css->addStyle('bottom', 30,'px');
		//$css->addStyle('width', ($this->slider_width / count($this->slides)), 'px' );
		$css->addStyle('width', ($this->slider_width / 2 ), 'px' );
		$css->addStyle('left', 25,'px');
		$css->addStyle('background-image', $background_image_dark);
		$css->addStyle('border-radius', '4px');
		$css->addStyle('-webkit-border-radius', '4px');
		$css->addStyle('-moz-border-radius', '4px');
		
		$slider_tabbed_inner_shadow_image = get_template_directory_uri(). '/framework/engine/sliders/img/slider_tabbed_inner_shadow.png';
		$slider_tabbed_inner_shadow_image = "url('" . $slider_tabbed_inner_shadow_image . "')";
		
		$css->setSelector('.slider_tabbed_inner_shadow');
		$css->addStyle('background-image', $slider_tabbed_inner_shadow_image);
		$css->addStyle('background-repeat', 'repeat-x');
		$css->addStyle('background-position', 'center bottom');
		$css->addStyle('width',($this->slider_width), 'px');
		$css->addStyle('height','30px');
		$css->addStyle('position','absolute');
		$css->addStyle('top', ( $this->slider_height - 30 - 65), 'px');
		
		$css->setSelector('.one_slide_text_content');
		$css->addStyle('padding', '21px 25px 3px 25px');
		
		
		$background_image_arrow = get_template_directory_uri(). '/framework/engine/sliders/img/slider_tabbed_active_arrow.png';
		$background_image_arrow = "url('" . $background_image_arrow . "')";
		
		$css->setSelector('.tab_arrow');
		$css->addStyle('position', 'absolute');
		$css->addStyle('background-image', $background_image_arrow);
		$css->addStyle('width', 14,'px');
		$css->addStyle('height', 7,'px');
		$css->addStyle('top', -7,'px');
		$css->addStyle('left', (($this->slider_width / count($this->slides)) - 14 ) / 2, 'px' );
		$css->addStyle('display','none');
		$css->addStyle('z-index', '5');
		
		
		$css->setSelector('.one_slide_tab_active');
		//$css->addStyle('border-bottom', '3px solid #808080');
		//$css->addStyle('padding-bottom', '17px');
		$css->addStyle('color', '#555555');
		
		$css->setSelector('.one_slide_tab_active .tab_arrow');
		$css->addStyle('display','block');
		
		$css->setSelector('.big_image_holder');
		$css->addStyle('position', 'relative');
		$css->addStyle('overflow', 'hidden');
		$css->addStyle('width', $this->slider_width,'px');
		$css->addStyle('height', $this->slider_height - 65,'px');		
		
		$css->setSelector('.one_slide_tab_container');
		$css->addStyle('float', 'left');
		$css->addStyle('width', ($this->slider_width),'px');
		$css->addStyle('background-image', $background_image);
		$css->addStyle('background-repeat', 'none');
		$css->addStyle('background-position', 'center bottom');
		
		$css->setSelector('.primary_image_holder'); 
		$css->addStyle('position', 'absolute');
		$css->addStyle('top', 0,'px');
		$css->addStyle('left', 0,'px');

		
		
		$css->setSelector('.secondary_image_holder'); 
		$css->addStyle('position', 'absolute');		
		$css->addStyle('top', 0,'px');
		$css->addStyle('left', $this->slider_width,'px');
		
		$css->setSelector('.grey_stripe_left'); 
		$css->addStyle('width', '50px');
		$css->addStyle('height', '65px');
		$css->addStyle('float', 'left');
		$css->addStyle('background-image', $background_image);
		$css->addStyle('background-repeat', 'none');
		$css->addStyle('background-position', 'left bottom');
		
		$css->setSelector('.grey_stripe_right'); 
		$css->addStyle('width', '50px');
		$css->addStyle('height', '65px');
		$css->addStyle('float', 'left');
		$css->addStyle('background-image', $background_image);
		$css->addStyle('background-repeat', 'none');
		$css->addStyle('background-position', 'right bottom');
		
		
		//
		// HOMEPAGE SLIDER
		//
		
		$css3 = new fCssHelper('#slider_container .grey_stripe');
		$css3->addStyle('background-image', 'none');
		
		
		
		$css4 = new fCssHelper('#slider_container .one_slide_tab_container');
		$css4->addStyle('background', 'rgb(248,248,248); /* Old browsers */');
		$css4->addStyle('background', '-moz-linear-gradient(top,  rgba(248,248,248,1) 0%, rgba(226,226,226,1) 100%); /* FF3.6+ */');
		$css4->addStyle('background', '-webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(248,248,248,1)), color-stop(100%,rgba(226,226,226,1))); /* Chrome,Safari4+ */');
		$css4->addStyle('background', '-webkit-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(226,226,226,1) 100%); /* Chrome10+,Safari5.1+ */');
		$css4->addStyle('background', '-o-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(226,226,226,1) 100%); /* Opera 11.10+ */');
		$css4->addStyle('background', '-ms-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(226,226,226,1) 100%); /* IE10+ */');
		$css4->addStyle('background', 'linear-gradient(to bottom,  rgba(248,248,248,1) 0%,rgba(226,226,226,1) 100%); /* W3C */');
		$css4->addStyle('filter', 'progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#f8f8f8\', endColorstr=\'#e2e2e2\',GradientType=0 ); /* IE6-9 */');



		$css4->addStyle('border-radius', '0 0 3px 3px');
		$css4->addStyle('-webkit-border-radius', '0 0 3px 3px');
		$css4->addStyle('-moz-border-radius', '0 0 3px 3px');	
		
		$css7 = new fCssHelper('#slider_container .grey_stripe_left');
		$css7->addStyle('background-image', 'none');
		
		$css8 = new fCssHelper('#slider_container .grey_stripe_right');
		$css8->addStyle('background-image', 'none');
		
		$css9 = new fCssHelper('#slider_container .slider_tabbed_down_shadow');
		$css9->addStyle('display', 'block');
		$css9->addStyle('width',($this->slider_width), 'px');
		
		echo '<style>';
			$css1->printStyle();
			$css->printStyle();
			$css3->printStyle();
			$css4->printStyle();
			$css5->printStyle();
			$css6->printStyle();
			$css7->printStyle();
			$css8->printStyle();
			$css9->printStyle();
			//echo '.grey_shadow_button {-webkit-box-shadow: inset -3px 0px 1px -2px rgba(205, 205, 205, 1);
			//-moz-box-shadow: inset -3px 0px 1px -2px rgba(205, 205, 205, 1);
			//box-shadow: inset -3px 0px 1px -2px rgba(205, 205, 205, 1);}';
		echo '</style>';
	}

} // END
?>