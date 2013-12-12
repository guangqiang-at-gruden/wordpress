<?php
/**
 * undocumented class
 *
 * @package default
 * @author  freshface
 */
class fSLiderCubes extends  fSliderObject {
	protected $js_url = '/framework/engine/sliders/js/cubes.js';
	protected $unicate_class = null;
	protected $slider_type_name = 'cubes';
	public function printSlider() {
		//var_dump( $this->options );
		$this->unicate_class = 'slider_cubes_'.rand(0,time());
		
		$width = $this->slider_width;
		$height = $this->slider_height;
		$cube_x = $this->options['slider_cubes_x_count'];
		$cube_y = $this->options['slider_cubes_y_count'];
		$grid = $this->options['slider_show_grid'];
		//echo $cube_y;
		
		$cube_width = round( $width / $cube_x);
		$cube_height = round( $height / $cube_y);
		
		
		$this->slider_width = ($cube_width * $cube_x) -1;
		$this->slider_height = ($cube_height * $cube_y) -1;
		$width = $this->slider_width;
		$height = $this->slider_height;
		
		if( $grid == 1) {
			$cube_grid_width = $cube_width - 1;
			$cube_grid_height = $cube_height - 1;
		} else {
			$cube_grid_width = $cube_width;
			$cube_grid_height = $cube_height;
			
		}
		$cube_grid_width = ($cube_grid_width);
		$cube_grid_height = ($cube_grid_height
		);
		$first_slide = $this->slides[0];
		$second_slide = $this->slides[1];

		$arrow_outside = $this->options['slider_show_arrows_outside'];
			if( $arrow_outside == 1 ) $arrow_class = ' slider_cubes_arrow_outside';
			else $arrow_class = ' slider_cubes_arrow_inside';

		echo '<div class="slider_cubes_container '. $this->unicate_class.'" style="width:' . $width . 'px; height:' .($height) . 'px">';
		echo '<div class="slider_cubes_wrapper '. $arrow_class .'" style="width:' . $width . 'px; height:' .($height) . 'px">';
		echo '<div class="slider_cubes" id="'. $this->name .'" style="width:' . $width . 'px; height:' .($height) . 'px">';
		?>
		<div class="slider_cubes_nav_wrapper" style="width: 960px;">
			<div class="slider_cubes_nav">
				<?php
					for( $i = 0; $i < count( $this->slides); $i++) {
						$class = '';
						if( $i == 0 ) $class = 'slider_cubes_nav_item_active';
						echo '<div class="slider_cubes_nav_item '.$class.'"></div>';
					}
				?>
				<div class="clear"></div>
			</div>
		</div>
		<?php
			$this->printAutoslideSettings();
			echo '<div class="cubes_holder" style="width:' . $width . 'px; height:' .($height) . 'px" cubes-x="'.$cube_x.'" cubes-y="'.$cube_y.'">';
			for( $y = 0; $y < $cube_y; $y++) {
				for( $x = 0; $x < $cube_x; $x++) {
					$left = $x * $cube_width;
					$top = $y * $cube_height;
					$cube_height_new = $cube_height;
					$cube_grid_height_new = $cube_grid_height;
					if( ( $y == ($cube_y - 1) ) && $grid == 1) {
						echo 'aaaa';
							$cube_height_new++;
							$cube_grid_height_new ++;
					}
					$style = "style=\" left:".$left."px; top:".$top."px; width:".$cube_width."px; height:".$cube_height_new."px;\" ";// "//'style="width:"';
					echo '<div '. $style . 'class="one_cube one_cube_'. $x . '_' . $y . '">';
						if( empty( $first_slide['imageUrl']) ) $first_slide['imageUrl'] = get_template_directory_uri().'/images/placeholder.png';
					
						$bottom_image_url = fImg::ResizeC( $first_slide['imageUrl'], $width, $height, true);
					//	$top_image_url = fImg::ResizeC( $first_slide['imageUrl'], $width, $height);
					
						$style = "background-position: -".$left."px -".$top."px; ";
						$style .= "width:".$cube_grid_width."px; height:".$cube_grid_height_new."px;";
					
						$bottom_style = "background-image: url('". $bottom_image_url ."');" . $style;

						
						$top_style = $style;
						
						//$bottom_style .= 
						echo '<div style="'.$bottom_style .'" class="cube_bottom"></div>';
						echo '<div style="'.$top_style .'" class="cube_top"></div>';
				//		echo '<div class="cube_top"></div>';
//						echo 'xx';	
					echo '</div>';

				}
			}
			
			echo '</div>';
			
			//$slider_post_title_wrapper_style = '';
			//if( $first_slide['title'] == '' || $first_slide['title'] == ' ')
			//	$slider_post_title_wrapper_style = ' style="opacity:0; " ';
			//echo '<div class="slider_post_title_wrapper" '. $slider_post_title_wrapper_style . '>';
			//	echo '<div class="slider_title_content">';
			//	echo $first_slide['title'];
			//	echo '</div>';
			//echo '</div>';
			
			
			$slider_description_holder_style = '';
			if( $first_slide['description'] == '' || $first_slide['description'] == ' ')
				$slider_description_holder_style = ' style="opacity:0; " ';
			echo '<div class="slider_description_holder" '. $slider_description_holder_style . '>';
				echo '<div class="slider_description_content">';
					if( !empty($first_slide['title']) )
						echo '<h3>' . $first_slide['title'] . '</h3>';
					echo $first_slide['description'];
				echo '</div>';
			echo '</div>';
			
			$template_url = get_template_directory_uri();
			
			
			
			echo '<div class="slides_data" style="display:none">';
				foreach( $this->slides as $one_slide ) {
					$this->printOneSlideSettings($one_slide, true);
				}
			echo '</div>';
		echo '</div>';
		echo '<div class="slider_arrow slider_right_arrow"></div>';
		echo '<div class="slider_arrow slider_left_arrow"></div>';
		echo '<img style="position: absolute; top:'.$this->slider_height.';" src="' .fImg::ResizeC(get_template_directory_uri() . '/framework/engine/sliders/img/slider_cubes_down_shadow.png', $width ).'" class="slider_cubes_down_shadow" />';
		echo '</div>';
		echo '</div>';
		$this->printStyles();
	}
	public function printStylesInhered() {
		$width = $this->slider_width;
		$height = $this->slider_height;
		$arrow_outside = $this->options['slider_show_arrows_outside'];
		$background_image = get_template_directory_uri(). '/framework/engine/sliders/img/slider_cubes_transparent_background.png';
		$background_image = "url('" . $background_image . "')";
	
		$css = new fCssHelperContainer( '.slider_left_arrow');
		$css->addStyle('position', 'absolute');
		$css->addStyle('z-index', '3');

		$slider_cubes_arrows = get_template_directory_uri(). '/framework/engine/sliders/img/slider_cubes_arrows.png';
		$slider_cubes_arrows = "url('" . $slider_cubes_arrows . "')";

		$sdg = new fCssHelper('.slider_arrow');
		$sdg->addStyle('background-image', $slider_cubes_arrows);

		

		$sdt = new fCssHelper('.slider_cubes_arrow_outside .slider_arrow'); /* HOMEPAGE */
		$arrow_top_outside_home = ($height - 31 )/ 2;
		$sdt->addStyle('top', $arrow_top_outside_home,'px');
		
		$sdu = new fCssHelper('.slider_cubes_arrow_inside .slider_arrow'); /* HOMEPAGE */
		$arrow_top_inside_home = ($height - 46 )/ 2;
		$sdu->addStyle('top', $arrow_top_inside_home,'px');

		$sdv = new fCssHelper('.slider_cubes_arrow_outside .slider_arrow'); /* TEMPLATE BUILDER */
		$arrow_top_outside = ($height - 20 )/ 2;
		$sdv->addStyle('top', $arrow_top_outside,'px');
		
		$sdw = new fCssHelper('.slider_cubes_arrow_inside .slider_arrow'); /* TEMPLATE BUILDER */
		$arrow_top_inside = ($height - 28 )/ 2;
		$sdw->addStyle('top', $arrow_top_inside,'px');


		
		$font_size = ( $height * 0.114  - 20);
		if( $font_size < 19) $font_size = 17;

		$stc = new fCssHelper('.slider_title_content');
		$stc->addStyle('padding', ($height * 0.114 - $font_size ) / 2 , 'px'  );
		


		//$sth = new fCssHelper('.slider_post_title_wrapper');
		//$sth->addStyle('z-index', 3);
		//$sth->addStyle('color', '#ffffff');
		//$sth->addStyle('font-size', $font_size, 'px');
		//$sth->addStyle('line-height', $font_size*1.5, 'px');
		//$sth->addStyle('font-weight', 'bold');
		//$sth->addStyle('position', 'absolute');
		//$sth->addStyle('left', $width * 0.415, 'px');
		//$sth->addStyle('top', $height * 0.6, 'px');
		//$sth->addStyle('width', $width * 0.585,'px');
		//$sth->addStyle('height',  $height * 0.114,'px');
		//$sth->addStyle('background-image', $background_image);
		
		
		$sdh = new fCssHelper('.slider_description_holder');
		$sdh->addStyle('z-index', 3);
		$sdh->addStyle('position', 'absolute');
		$sdh->addStyle('left', 25, 'px');
		$sdh->addStyle('bottom', 40, 'px');
		$sdh->addStyle('width', $width * 0.5,'px');
		//$sdh->addStyle('height',  $height * 0.21,'px');
		$sdh->addStyle('background-image', $background_image);
		//$sdh->addStyle('font-size', 16, 'px');
		$sdh->addStyle('color', '#686868');
		$sdh->addStyle('overflow', 'hidden');
		$sdh->addStyle('border-radius', '4px');
		$sdh->addStyle('-webkit-border-radius', '4px');
		$sdh->addStyle('-moz-border-radius', '4px');
		
		$sdc = new fCssHelper('.slider_description_content');
		$sdc->addStyle('padding', '21px 25px 3px 25px');

	
		
		$sdf = new fCssHelper('.slider_cubes_down_shadow');
		$sdf->addStyle('width', $width,'px');
?>
<style type="text/css">
	.slider_cubes { position:relative;}
	.cubes_holder	{ position: relative; overflow: hidden; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px;}
	.one_cube { position: absolute; overflow: hidden;}
	.one_cube .cube_bottom { position:absolute; top:0px; left:0px; z-index:1;}
	.one_cube .cube_top { position:absolute; top:0px; left:0px; z-index:2;}
	
	<?php //echo  $slider_description_holder; 
		
		//$sth->printStyle();
		$sdh->printStyle('.'.$this->unicate_class);
		$stc->printStyle('.'.$this->unicate_class);
		$sdc->printStyle('.'.$this->unicate_class);
		$sdg->printStyle('.'.$this->unicate_class);
		$sdf->printStyle('.'.$this->unicate_class);
		$sdt->printStyle('#slider_container .'.$this->unicate_class);
		$sdu->printStyle('#slider_container .'.$this->unicate_class);
		$sdv->printStyle('.'.$this->unicate_class);
		$sdw->printStyle('.'.$this->unicate_class);	
		$css->printStyle('.'.$this->unicate_class);
	?> 
</style>
<?php
	}
} // END
?>