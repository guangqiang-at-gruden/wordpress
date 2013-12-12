<?php
class fSlider3D extends fSliderObject {
	private $l2, $l1, $c, $r1, $r2;
 protected $js_url = '/framework/engine/sliders/js/3d.js';
 protected $slider_type_name = '3d';
	private $unicate_class = null;
	public function printSlider() {
		$this->unicate_class = 'slider_3d_'.rand(0,time());
		$slider_height_old = $this->slider_height;
		$this->slider_height = $this->slider_height * 1.265;
		$this->calculateDimensions();
		$this->printStyles();
		
		
		
		$style = "width: {$this->slider_width}px; ";
		$style .= "height: ". ($slider_height_old)."px; position:relative;"; 
		echo '<div class="slider slider_3d '.$this->unicate_class.' " style="'.$style.'">';
			
		
			$slides_count = count($this->slides);
			foreach( $this->slides as $key=>$one_slide ) {
				$class = 'none';
				
				if( $key == 0 )
					$class = 'c';
				else if( $key == 1)
					$class = 'r1';
				else if( $key == 2)
					$class = 'r2';
				else if( $key == ( $slides_count - 1 ) )
					$class= 'l1';
				else if( $key == ( $slides_count - 2) )
					$class = 'l2';
				
				echo '<div class="' . $class . '" rel="'.$class.'">';
					if( empty( $one_slide['imageUrl']) ) $one_slide['imageUrl'] = get_template_directory_uri().'/images/placeholder.png';
					$img_url = fImg::ResizeC( $one_slide['imageUrl'] , $this->c['w'], $this->c['h'], true);
					 
					
					
					echo '<img class="img_content" src="' . $img_url .'" />';
					echo '<img class="img_shadow" src="'.get_template_directory_uri().'/framework/engine/sliders/img/slider_3d_down_shadow.png">';
					$this->printOneSlideSettings($one_slide);
				echo '</div>';
				
				
			}

		/*	echo '<div class="l2" style="">';
			
			echo '</div>';
		
		// L1

			echo '<div class="l1" style="">';
			
			echo '</div>';			
			

			echo '<div class="c" style="">';
			
			echo '</div>';			
			

			echo '<div class="r1" style="">';
			
			echo '</div>';			
			
			

			echo '<div class="r2" style="">';
			
			echo '</div>';			*/
			echo '<span class="info_holder" style="display:none">';
				$size_info = array( 'l2' => $this->l2,'l1' => $this->l1,'c' => $this->c, 'r1' => $this->r1,'r2'=> $this->r2);
				$size_info2 = json_encode( $size_info );
				//var_dump($size_info2[ count_chars($size_info2) -1]);
				//var_dump( utf8_encode($size_info2) );
				//var_dump($size_info2[186]);
				if( $size_info2[ strlen($size_info2) -1] == ']') {
					$size_info2[strlen($size_info2) -1] = '}';
					$size_info2 .= '}';
				}
				echo $size_info2;
			echo '</span>';
			$this->printAutoslideSettings();			
		echo '</div>';
	}
	
	public function getSlider() {
		ob_start();
		$this->printSlider();
		$to_return = ob_get_contents();
		ob_end_clean();
		return $to_return;
	}
	
	public function printStylesInhered() {
		$uc = '.'.$this->unicate_class;
		echo '<style>';
			// L2
			if( $this->options['slider-3d-shadow'] != 1)
				echo $uc.' .img_shadow {display:none}';
				
			$style = "width:" .$this->l2['w']."px;";
			$style .= "height:". $this->l2['h']."px;";
			$style2 = $style;
			$style .= "top:". $this->l2['t']."px;";
			$style .= "left:". $this->l2['l']."px;";
			$style .= "  position:absolute; z-index:1;";
			
			echo $uc.' .l2 { ' . $style . ' } ';
			echo $uc.' .l2 .img_content { ' .$style2 . ' } ';
			echo $uc.' .l2 .img_shadow { ' ."width:" .$this->l2['w']."px;" . ' } ';
			
			$style = "width:" .$this->l1['w']."px;";
			$style .= "height:". $this->l1['h']."px;";
			$style2 = $style;
			$style .= "top:". $this->l1['t']."px;";
			$style .= "left:". $this->l1['l']."px;";
			$style .= "  position:absolute; z-index:2;";
			
			echo $uc.' .l1 { ' . $style . ' } ';
			echo $uc.' .l1 .img_content { ' .$style2 . ' } ';
			echo $uc.' .l1 .img_shadow { ' ."width:" .$this->l1['w']."px;" . ' } ';
			
					// LC
			$style = "width:" .$this->c['w']."px;";
			$style .= "height:". $this->c['h']."px;";
			$style2 = $style;
			$style .= "top:". $this->c['t']."px;";
			$style .= "left:". $this->c['l']."px;";
			$style .= "  position:absolute; z-index:3;";
			
			echo $uc.' .c { ' . $style . ' } ';
			echo $uc.' .c .img_content { ' .$style2 . ' } ';
			echo $uc.' .c .img_shadow { ' ."width:" .$this->c['w']."px;" . ' } ';
			
		// L1
			$style = "width:" .$this->r1['w']."px;";
			$style .= "height:". $this->r1['h']."px;";
			$style2 = $style;
			$style .= "top:". $this->r1['t']."px;";
			$style .= "left:". $this->r1['l']."px;";
			$style .= "  position:absolute; z-index:2;";			
			
			echo $uc.' .r1 { ' . $style . ' } ';
			echo $uc.' .r1 .img_content { ' .$style2 . ' } ';
			echo $uc.' .r1 .img_shadow { ' ."width:" .$this->r1['w']."px;" . ' } ';
			
											// L1
			$style = "width:" .$this->r2['w']."px;";
			$style .= "height:". $this->r2['h']."px;";
			$style2 = $style;
			$style .= "top:". $this->r2['t']."px;";
			$style .= "left:". $this->r2['l']."px;";
			$style .= "  position:absolute; z-index:1;";			
			
			echo $uc.' .r2 { ' . $style . ' } ';
			echo $uc. ' .r2 .img_content { ' .$style2 . ' } ';
			echo $uc.' .r2 .img_shadow { ' ."width:" .$this->r2['w']."px;" . ' } ';
			
			
			echo '.slider_3d .none { display:none; position:absolute;}';
			echo '.slider_3d .img_shadow { width:300px; }';
		
		
		echo '</style>';
	}
	
	private function calculateDimensions() {
		  $l2_w = 0.213541666666667;
		  $l2_h = 0.442105263157895;
		  $l2_t = 0.140350877192982;
		  $l2_l = 0.020833333333333;
		  
		  $l1_w = 0.290625;
		  $l1_h = 0.592982456140351;
		  $l1_t = 0.080701754385965;
		  $l1_l = 0.11875;
		  
		  $c_w = 0.38125;
		  $c_h = 0.792982456140351;
		  $c_t = 0;
		  $c_l = 0.309375;
		  
		  $r1_w = 0.290625;
		  $r1_h = 0.592982456140351;
		  $r1_t = 0.080701754385965;
		  $r1_l = 0.590625;
		  
		  $r2_w = 0.213541666666667;
		  $r2_h = 0.442105263157895;
		  $r2_t = 0.140350877192982;
		  $r2_l = 0.765625;
		  
		  
		  $this->l2['w'] = round( $this->slider_width * $l2_w);
		  $this->l2['h'] = round( $this->slider_height * $l2_h);
		  $this->l2['t'] = round( $this->slider_height * $l2_t);
		  $this->l2['l'] = round( $this->slider_width * $l2_l);
		  
		  $this->l1['w'] = round( $this->slider_width * $l1_w);
		  $this->l1['h'] = round( $this->slider_height * $l1_h);
		  $this->l1['t'] = round( $this->slider_height * $l1_t);
		  $this->l1['l'] = round( $this->slider_width * $l1_l);	
		  
		  $this->c['w'] = round( $this->slider_width * $c_w);
		  $this->c['h'] = round( $this->slider_height * $c_h);
		  $this->c['t'] = round( $this->slider_height * $c_t);
		  $this->c['l'] = round( $this->slider_width * $c_l);		  
		  
		  
		  $this->r1['w'] = round( $this->slider_width * $r1_w);
		  $this->r1['h'] = round( $this->slider_height * $r1_h);
		  $this->r1['t'] = round( $this->slider_height * $r1_t);
		  $this->r1['l'] = round( $this->slider_width * $r1_l);	
		  
		  $this->r2['w'] = round( $this->slider_width * $r2_w);
		  $this->r2['h'] = round( $this->slider_height * $r2_h);
		  $this->r2['t'] = round( $this->slider_height * $r2_t);
		  $this->r2['l'] = round( $this->slider_width * $r2_l);		  
	}
}
?>