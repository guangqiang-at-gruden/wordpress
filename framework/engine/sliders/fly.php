<?php
class fSliderFly extends fSliderObject {
	protected $js_url = '/framework/engine/sliders/js/fly.js';
	protected $slider_type_name = 'fly';
	private $slide_min_width = 50;
	private $slide_max_width = null;
	private $slide_average_width = null;
	
	private $unicate_class ='';
	private $one_logo_width = null;
	
	
	public function printSlider() {
		$width = $this->slider_width;
		$height = $this->slider_height;
		$first_slide = $this->slides[0];
		
		$autoslide_time = $this->options['slider-autoslide-enable'];
		if( $autoslide_time == 1) $autoslide_time = $this->options['slider-autoslide-interval']
?>

<div class="slider_fly" style="width:<?php echo $width;?>px; height:<?php echo $height;?>px;">
	<div class="slider_fly_settings" style="display:none;">
		<div class="autoslide_interval"><?php echo $autoslide_time;?></div>
	</div>
	
	<div class="slider_fly_inner" style="width:<?php echo $width;?>px; height:<?php echo $height;?>;">
		<?php
			$counter = 0;
			foreach( $this->slides as $one_slide ) {
				$style = "";
				if( true )  $style='style="display:none;"';
				echo '<div class="slider_fly_slide" '.$style.'>';
					echo '<div class="slider_fly_slide_image '.$one_slide['transition'].'" >';
					if( empty( $one_slide['imageUrl']) ) $one_slide['imageUrl'] = get_template_directory_uri().'/images/placeholder.png';
						echo '<img src="'.fImg::resize($one_slide['imageUrl'], $width, $height, true).'" />';
					echo '</div>';
					echo $one_slide['description'];
					
					$this->printOneSlideSettings($one_slide);
				echo '</div>';
				$counter ++;
			}
		?>	
	</div>
	<div class="slider_fly_nav_wrapper" style="width: 960px;">
		<div class="slider_fly_nav">
			<?php
				for( $i = 0; $i < count( $this->slides); $i++) {
					$class = '';
					if( $i == 0 ) $class = 'slider_fly_nav_item_active';
					echo '<div class="slider_fly_nav_item '.$class.'"></div>';
				}
			?>
			<div class="clear"></div>
		</div>
	</div>
</div>

<?php
	$this->printStyles();
	}
	
	public function printStylesInhered() {

 		$css = new fCssHelperContainer('');

 		$css->setSelector('.slider_fly');
		$css->addStyle('position', 'relative');

 		$css->setSelector('.slider_fly_inner');
		$css->addStyle('position', 'relative');

		$css->setSelector('.slider_fly_slide_image');
		$css->addStyle('position', 'absolute');
		

		$css->setSelector('.fly');
		$css->addStyle('position', 'absolute');

		$css->setSelector('.slider_fly_nav_wrapper');
		$css->addStyle('position', 'absolute');
		$css->addStyle('bottom', '-22px');
		$css->addStyle('text-align', 'center');
		$css->addStyle('cursor', 'default');

		$slider_fly_nav_item_white_image = get_template_directory_uri(). '/framework/engine/sliders/img/slider_fly_nav_item_white.png';
		$slider_fly_nav_item_white_image = "url('" . $slider_fly_nav_item_white_image . "')";

		$css->setSelector('.slider_fly_nav_item');
		$css->addStyle('background-image', $slider_fly_nav_item_white_image);
		$css->addStyle('background-position', 'center top');
		$css->addStyle('background-repeat', 'no-repeat');
		$css->addStyle('width', '10px');
		$css->addStyle('height', '16px');
		$css->addStyle('display', 'inline-block');
		$css->addStyle('margin', '0 3px');

		$css->setSelector('.slider_fly_nav_item:hover, .slider_fly_nav_item_active');
		$css->addStyle('background-position', 'center bottom');
		$css->addStyle('cursor', 'pointer');

		$background_image_dark = get_template_directory_uri(). '/framework/engine/sliders/img/slider_fly_transparent_background.png';
		$background_image_dark = "url('" . $background_image_dark . "')";

		$css->setSelector('.desc');
		$css->addStyle('background-image', $background_image_dark);
		$css->addStyle('border-radius', '4px');
		$css->addStyle('-webkit-border-radius', '4px');
		$css->addStyle('-moz-border-radius', '4px');
		$css->addStyle('padding', '21px 25px 3px 25px');


		echo '<style>';
			$css->printStyle();
		echo '</style>';
	}
}
?>