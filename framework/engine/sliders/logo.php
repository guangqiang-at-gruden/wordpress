<?php
class fSliderLogo extends fSliderObject {
	protected $js_url = '/framework/engine/sliders/js/logo.js';
	protected $slider_type_name = 'logo';
	private $slide_min_width = 50;
	private $slide_max_width = null;
	private $slide_average_width = null;
	
	private $unicate_class ='';
	private $one_logo_width = null;
	
	
	public function printSlider() {
	$this->unicate_class = 'logo_slider_'.rand(0,time());
	
	$viewport_logo_count =  $this->options['slider_logo_elements_count'];
	$viewport_width = $this->slider_width - 28;
	$total_padding_width = $viewport_logo_count * $this->options['slider_logo_elements_spacing'];
	$this->one_logo_width = round( ( $viewport_width - $total_padding_width ) / $viewport_logo_count);
	
?>
	<div class="<?php echo $this->unicate_class; ?> logo_slider">
		<div class="logo_slider_arrow_wrapper">
			<div class="logo_slider_arrow logo_slider_arrow_left"></div>
		</div>
		<div class="logo_slider_content_wrapper">
			<div class="logo_slider_content">
				<?php
					foreach( $this->slides as $one_slide ) {
						$rel = '';
						if( $one_slide['lightbox'] == 'lightbox') $rel = ' rel="prettyPhoto" ';
						if( empty( $one_slide['imageUrl']) ) $one_slide['imageUrl'] = get_template_directory_uri().'/images/placeholder.png';
						if( empty( $one_slide['imageLink']) ) $one_slide['imageLink'] = $one_slide['imageUrl'];
						
						echo '<div class="one_logo">';
						$before_slide = $after_slide = null;
						
						if( $one_slide['lightbox'] != 'do_nothing') {
									
							$before_slide = '<a href="' . $one_slide['imageLink'] . '" '. $rel . ' >';
							$after_slide = '</a>';
						}
						//var_dump($before_slide);
							//echo '<a href="' . $one_slide['imageLink'] . '" '. $rel . ' >';
							echo $before_slide;
								echo '<div class="one_logo_image" style="background-repeat: no-repeat; background-position: center center; background-image: url(\'' . fImg::ResizeC( $one_slide['imageUrl'], $this->one_logo_width, $this->slider_height, false ) . '\');" title="'.$one_slide['title'].'"></div>';
							echo $after_slide;
							//echo '</a>';	
						echo '</div>';
					}
				?>

				<div class="clear"></div>		
			</div>
		</div>
		<div class="logo_slider_arrow_wrapper">
			<div class="logo_slider_arrow logo_slider_arrow_right"></div>
		</div>
		<div class="clear"></div>
	</div>
<?php
	$this->printStyles();
	}
	
	public function printStylesInhered() {
		//if( )
		
		$css1 = new fCssHelper( '.'. $this->unicate_class );
		$css1->addStyle('width', $this->slider_width , 'px');
		//$css1->addStyle('height', $this->slider_height,'px');
		
		$css = new fCssHelperContainer('.logo_slider_arrow_wrapper');
		$css->setPrefix( '.' . $this->unicate_class );
		$css->addStyle('float', 'left');
		$css->addStyle('width', 14,'px');
		$css->addStyle('position', 'relative');
		$css->addStyle('height', $this->slider_height,'px');
		
		$background_image_arrows = get_template_directory_uri(). '/framework/engine/sliders/img/slider_logo_arrows.png';
		$background_image_arrows = "url('" . $background_image_arrows . "')";

		$css->setSelector('.logo_slider_arrow');
		$css->addStyle('width', 14,'px');
		$css->addStyle('height', 20,'px');
		$css->addStyle('position', 'absolute');
		$css->addStyle('top', $this->slider_height / 2 - 10,'px');
		$css->addStyle('background', $background_image_arrows);
		$css->addStyle('background-repeat', 'no-repeat');
		$css->addStyle('cursor', 'pointer');

		$css->setSelector('.logo_slider_arrow_left');
		$css->addStyle('background-position', '-60px center');

		$css->setSelector('.logo_slider_arrow_left:hover');
		$css->addStyle('background-position', '-90px center');

		$css->setSelector('.logo_slider_arrow_right');
		$css->addStyle('background-position', '0px center');

		$css->setSelector('.logo_slider_arrow_right:hover');
		$css->addStyle('background-position', '-30px center');
		

		$css->setSelector('.logo_slider_content_wrapper');
		$css->addStyle('float', 'left');
		$css->addStyle('width', $this->slider_width - 28,'px');
		$css->addStyle('height', $this->slider_height,'px');	
		$css->addStyle('position', 'relative');
		$css->addStyle('overflow', 'hidden');
		
		$css->setSelector('.logo_slider_content');
		$css->addStyle('position', 'absolute');
		
		$css->setSelector('.one_logo');
		$css->addStyle('float', 'left');
		$css->addStyle('padding-left', round($this->options['slider_logo_elements_spacing'] / 2),'px' );
		$css->addStyle('padding-right', round($this->options['slider_logo_elements_spacing'] / 2),'px' );
		$css->addStyle('width', round($this->one_logo_width),'px');
		//$css->addStyle('height', $this->slider_height,'px');

		$css->setSelector('.one_logo_image');
		$css->addStyle('width', round($this->one_logo_width),'px');
		$css->addStyle('height', round($this->slider_height),'px');	
		
		//$css->addStyle('position', 'absolute');
			
		
		echo '<style>';
		$css1->printStyle();
		$css->printStyle();
		echo '</style>';
		//$css = new fCssHelperContainer('')
	}
}
?>