<?php
class fSLiderManagerDataImporter { 
	public function importSlides( $slides ) {
		$slides_collection = array();
		foreach( $slides as $one_slide ) {
			$one_slide = get_object_vars( $one_slide );
			
			// one slide new
			$osn = new fSliderManagerSlide();		
			$osn->imageUrl = $one_slide['image_url'];
			$osn->title = $one_slide['alt'];
			$osn->imageLink = $one_slide['link_url'];
			$osn->description = $one_slide['description'];
			$osn->clickAction = $one_slide['lightbox'];
			$osn->transition = $one_slide['transition'];
			
			$slides_collection[] = $osn;
		}
		return $slides_collection;
	}
}

class fSliderManagerPageManager {
	public $actualSliderName;
	public $actualSliderDataObject;
	public $actualSliderObject;
	public function __construct(){
		$this->checkActualSlider();
		$this->checkAction();
	}
	private function checkActualSlider() {
		$slider_last_visited = fOpt::Get('admin_menu_last_visited', 'slidermanager');
		//var_dump(!isset($_POST['fslidermanager_actual_slider_id']));
		//var_dump(IFRAME_REQUEST);
		
		if( $slider_last_visited != null && !isset($_POST['fslidermanager_actual_slider_id']) && !defined('IFRAME_REQUEST')  ){
			//var_dump(IFRAME_REQUEST === true);
			//var_dump( (IFRAME_REQUEST) );
			//$_POST['fslidermanager_actual_slider_id'] = $slider_last_visited;
		}
		//	
		
		
		if( isset( $_POST['fslidermanager_actual_slider_id'] ) ) {
			$this->actualSliderName = $_POST['fslidermanager_actual_slider_id'];
			$this->loadSlider();
		} else {
			$sdm = new fSliderManagerDataManager();
			$slider_objects = $sdm->getSliders();
			if( $slider_objects == null ) {
				$new_default_slider = new fSLiderManagerSliderDataObject( 'default', 'Accordeon' );
				$sdm->addSlider( $new_default_slider );
				$this->actualSliderName = 'default';
				$this->loadSlider();
			} else {
				foreach( $slider_objects as $slider_name => $value ) {
					$this->actualSliderName = $slider_name;
					$this->loadSlider();	
					break;
				}
			}
		}
		
		fOpt::Set('admin_menu_last_visited', 'slidermanager', $this->actualSliderName );
	}
	
	private function checkAction() {

		
		if( isset( $_POST['fslidermanager_action'] ) ) {
			switch ($_POST['fslidermanager_action']) {
				case 'add':
					$this->addSlider();
					break;
				
				case 'save':
					$this->saveSlider();
					$this->checkActualSlider();					
					break;
			}
		}
	}
	private function loadSlider() {
		$smdo = new fSliderManagerDataManager();
		$this->actualSliderDataObject = $smdo->getSlider( $this->actualSliderName );
		
		$className = $this->actualSliderDataObject->typeName;

		$new_class_name =  'fSLiderManagerSlider'. $className . 'Object';
		
		$this->actualSliderObject = new $new_class_name( $this->actualSliderName );
		
		
		$this->actualSliderObject->setSliderDataObject( $this->actualSliderName );
		
		
		//var_dump($this);
		
		//var_dump( $this->actualSliderDataObject );
	}
	private function addSlider() {
		$slider_name = $_POST['new_slider_name'];
		$slider_type = $_POST['new_slider_type'];
	
		// slider data object
		$sdo = new fSLiderManagerSliderDataObject($slider_name, $slider_type);
		
		$sopt = new fSliderManagerSliderBasicObject();
		$options = $sopt->getOptions();
		$opt2 = $options->extractAllParameters();
		
		//var_export($opt2);
		
		//$sopt->options = $options;
		$sdo->options = get_slider_default_data_2();
		$first_slide = new fSliderManagerSlide();
		$sdo->addSlide( $first_slide );
		// slider manager data manager
		$smdm = new fSliderManagerDataManager();
		$smdm->addSlider( $sdo );
	}
	
	private function saveSlider() {

		if( empty($this->actualSliderName) ) return false;
		
		
		
		
		$slider_data = $_POST['slider_data'];
		
		//var_dump($slider_data);
		$slider_data = stripslashes($slider_data);
		$slider_data = json_decode($slider_data);
		$slider_data = get_object_vars( $slider_data);
		
		$smdm = new fSliderManagerDataManager();
		$smi = new fSLiderManagerDataImporter();
		
		$sdo = new fSLiderManagerSliderDataObject( $this->actualSliderName, 'Accordeon');
		$slides = $smi->importSlides( $slider_data['slides'] );
		$slider_type = $slider_data['settings']->slider_type;
		$sdo->typeName = $slider_type;
		$sdo->slides = $slides;
		$sdo->options = $slider_data['settings'];
	
		// adding default params
		$slider_new_object = 'fSliderManagerSlider'.$slider_type.'Object';
		$slider_new_object = new $slider_new_object();
		$default_opt = $slider_new_object->getOptions();
		$all_parameters = $default_opt->extractAllParameters();
		foreach( $all_parameters as $one_def_param) {
			$name = $one_def_param['name'];
			$std = $one_def_param['std'];
			
			if( !isset( $sdo->options->$name  )) {
				$sdo->options->$name = $std;
			}
			
		}
		
		
		$smdm->addSlider( $sdo );		
	
	}
}

$smpm = new fSliderManagerPageManager();

class fSliderManagerPagePrinter {
	public function printTemplateList() {
		$smdm = new fSliderManagerDataManager();
		$smpm = new fSliderManagerPageManager();
		$slider_objects = $smdm->getSliders(); //$smdm->getTypes();
		foreach( $slider_objects as $one_slider_object ) {
			$selected = '';
			if( $one_slider_object->name == $smpm->actualSliderName)
				$selected = ' selected="selected" ';
			
			echo '<option '.$selected.' value="'. $one_slider_object->name.'">'. $one_slider_object->name.'</option>';
		}
	}
	
	public function printSliderOptions() {
		$smpm = new fSliderManagerPageManager();
		$slider_object = $smpm->actualSliderObject;
		$options = $slider_object->getOptions();
		$options_data = $smpm->actualSliderDataObject->options;
		if( is_object($options_data ))
			$options_data = get_object_vars( $options_data); 
 
		
		foptions_print_array_with_settings($options, $options_data);
	}
	
	
	public function printSlides() {
		$smpm = new fSliderManagerPageManager();
		$sdo = $smpm->actualSliderDataObject;
		$slider_object = $smpm->actualSliderObject;
		$transitions = ($slider_object->transitions);
		$slides = $sdo->slides;
 
/****************************************************************************************************************************************************************************
 * SLIDES START
 ****************************************************************************************************************************************************************************/
		foreach( $slides as $one_slide ) {
?>
					<div class="table_holder">
	                   	<table cellspacing="0" class="widefat tag fixed fs_slide_box table_id_">
	                        <thead>
	                            <tr>
	                                <th style="" class="manage-column" id="fs_head_order" scope="col">Order</th>
	                                <th style="" class="manage-column column-description" id="fs_head_settings" scope="col">Slide Settings</th>
	                                <th style="" class="manage-column column-posts num" id="fs_head_remove" scope="col">Remove</th>
	                            </tr>
	                        </thead>
	                        <tbody class="list:tag" id="the-list">
	                            <tr class="alternate" id="tag-22">
	                                <td class="name column-name">
	                   
	                                    <div class="move_up" style="float:left;" title=""><img src="<?php echo get_template_directory_uri(); ?>/framework/backend/slidermanager/images/arrow_up.png" style="cursor:pointer; margin-right:10px;"></div>
	                                    <div class="move_down" style="float:left;" title=""><img src="<?php echo get_template_directory_uri(); ?>/framework/backend/slidermanager/images/arrow_down.png" style="cursor:pointer;"></div>
	                                    <img class="fs_slide_preview" src="<?php echo $one_slide->imageUrl; ?>">
	                                </td>
	                                <td class="name column-name">
	                                        <div class="input_img_wrapper">
	                                        	<input type="text" class="image_url" value="<?php echo $one_slide->imageUrl; ?>" id="fs_image_url" name="image_url" onblur="if (this.value == '') {this.value = 'Image URL';}" onfocus="if (this.value == 'Image URL') {this.value = '';}">
	                                        </div>
	                                        <select name="link_type" class="lightbox" id="fs_link_type">
	                                        	<?php
	                                        		if( $one_slide->clickAction == 'url' ) {
														echo '<option selected="selected" value="url">Go to URL</option>';
	                                              		echo '<option value="lightbox">Open Lightbox</option>';
														echo '<option value="do_nothing">Do Nothing</option>';
	                                        		} else if ($one_slide->clickAction == 'lightbox') {
	                                        			echo '<option value="url">Go to URL</option>';
	                                              		echo '<option selected="selected" value="lightbox">Open Lightbox</option>';
														echo '<option value="do_nothing">Do Nothing</option>';
	                                        		} else {
	                                        			echo '<option value="url">Go to URL</option>';
	                                              		echo '<option value="lightbox">Open Lightbox</option>';
														echo '<option selected="selected" value="do_nothing">Do Nothing</option>';
	                                        		}

	                                        	?>
	                                        </select>
	                                        <input class="link_url" type="text" value="<?php echo $one_slide->imageLink; ?>" id="fs_link_url" name="link_url"  onfocus="if (this.value == 'Link URL') {this.value = '';}">
	                                        <select name="transition" class="transition" id="fs_transition">
	                                        	<?php
	                                        		if( !empty( $transitions ) ) {
		                                        		foreach( $transitions as $trans_name => $trans_value ) {
		                                        			$selected = '';	
		                                        			if( $trans_value == $one_slide->transition ) 
																$selected = 'selected="selected"';
															
															echo '<option '. $selected . ' value="'. $trans_value.'">'.$trans_name .'</option>';
		                                        		}
													}
	                                        	?>
	                                                                                     
	                                        </select>
	                                        <input type="text" class="alt" value="<?php echo $one_slide->title; ?>" id="fs_title" name="alt">
	                                        <label class="description_label" for="fs_description">Description</label>
	                                        <textarea rows="10" class="description" id="fs_description" name="description"><?php echo $one_slide->description; ?></textarea>
	                                        <input type="hidden" name="object_id_" value="">
	                                </td>
	                                
	                                <td class="name column-name" style="text-align:center;">
	                                    <a href="#" class="img_remove_holder"><img class="img_remove" src="<?php echo get_template_directory_uri(); ?>/framework/backend/slidermanager/images/remove.png"></a>
	                                </td>
	                            </tr> 
	
	                        </tbody>
	                    </table>
                    </div>
<?php	
		}
/****************************************************************************************************************************************************************************
 * SLIDES END
 ****************************************************************************************************************************************************************************/

	}
}

function foptions_print_array_with_settings( $tos, $options_data ) {
	
	$output ='';	
		
	$data = $tos->getData();
	$namespace_order = $tos->getNamespaceOrder();
	
	
	$actual_namespace = null;
	if( isset( $_POST['actual_namespace'] ) )
		$actual_namespace = $_POST['actual_namespace'];
	
	foreach( $namespace_order as $key=>$actual_namespace_id ) {
		$namespace = $data[$actual_namespace_id['namespace']];
		$css = $actual_namespace_id['css'];
		$namespace_name = $actual_namespace_id['namespace'];
			
		$display ='style="display:none"';
		if( ($key == 0 && empty($actual_namespace) ) || ( $actual_namespace == $namespace_name ) )
			$display = '';
		
		$output .= '<table class="options_table form-table foptions_all_tables foptions_'.$namespace_name.'" '.$display.'>';
		
		foreach( $namespace as $one_option ) {
 
			$output .= '<tr>';
			$output .= '<th>';
			$output .= '<label>' . $one_option['name'] .'</label>';
			$output .= '</ht>';
			$output .= '<td>';
			foreach( $one_option['lines'] as $one_line ) {
				foreach( $one_line as $param ) {
					$param_value = $options_data[ $param['name'] ];	
					//$param_value = fOpt::Get($namespace_name, $param['name']);
					//$param_value = htmlspecialchars($param_value);
					//echo var_dump($param['name']);
					if( $param_value != null) { $param['std'] = $param_value; }
					
					
					$param['name'] = 'foptions-'. $namespace_name . '-' . $param['name'];
					
					switch( $param['type'] ) {
						case "text":
							$output .= '<input type="text" class="small-text" value="'. $param['std']. '" id="'. $param['name'].'" name="'. $param['name'].'">' . $param['text'];
							break;
						case "text-area":
							$output .= '<textarea style="width:300px; height:200px;"  id="'. $param['name'].'" name="'. $param['name'].'">' . $param['std'] . '</textarea>' . $param['text'];
							break;							
						case "text-regular":
							$output .= '<input type="text" class="regular-text" value="'. $param['std']. '" id="'. $param['name'].'" name="'. $param['name'].'">' . $param['text'];
							break;
						case "check":
							$checked = '';
							if( $param_value === 0 || $param_value === '0')
								$param['std'] = 0;
							//echo $param['std'] .'xxx';
						//	echo $param['std'] === '1' ;
							if( $param['std'] === 1 || $param['std'] === '1' ) $checked = 'checked="checked"';
							$output .= '<label for="'. $param['name'].'">';
							$output .= '	<input type="checkbox" '.$checked.' id="'. $param['name'].'" name="'. $param['name'].'">';
							$output .=  $param['text'];
							$output .= '</label>'; 
							break;
							
						case "radio":
							foreach( $param['options'] as $one_radio_option ) {
								$checked = '';
								if( $param['std'] === $one_radio_option['value'] ) $checked = 'checked="checked"';
								$output .= '<label><input type="radio" '.$checked.' value="'.$one_radio_option['value'].'" name="'. $param['name'].'">'.$one_radio_option['name'].'</label><br>';
							}
							break;
							
						case "select":
							//  <option selected="selected" value="newest">last</option><option value="oldest">first</option></select> page displayed by default</label>
							$output .= '<label for="'. $param['name'].'">';
							$output .= '<select id="'. $param['name'].'" name="'. $param['name'].'">';
							
							foreach( $param['options'] as $one_select ) {
								$selected = '';
								if( $param['std'] === $one_select['value'] ) $selected = 'selected="selected"';
								$output .= '<option '.$selected.' value="'.$one_select['value'].'">'.$one_select['name'].'</option>';
							}
							$output .= '</select>';
							$output .= $param['text'];
							$output .= '</label>';
						break;
						case "description":
							
						break;
					}
					
				}
				$output .= '<br>';
			}
			if( !empty($one_option['notification'] ))
				$output .= '<br><br><div class="description">' .$one_option['notification'] . '</div>';
			$output .= '</td>';
			
			//var_dump($one_option);
			
		}
		
		$output .= '</table>';
		//var_dump ($namespace_name);
	}
	echo $output;
}


function get_slider_default_data_2() {
	return 
array (
  0 => 
  array (
    'type' => 'select',
    'name' => 'slider_type',
    'std' => 'fSliderManagerSliderAccordeon',
    'text' => ' Slider Type',
    'options' => 
    array (
      0 => 
      array (
        'name' => 'accordeon',
        'value' => 'Accordeon',
      ),
      1 => 
      array (
        'name' => '3d',
        'value' => '3D',
      ),
      2 => 
      array (
        'name' => 'Cubes',
        'value' => 'Cubes',
      ),
      3 => 
      array (
        'name' => 'Tabbed',
        'value' => 'Tabbed',
      ),
      4 => 
      array (
        'name' => 'Logo Slider',
        'value' => 'Logo',
      ),
    ),
  ),
  1 => 
  array (
    'type' => 'text',
    'name' => 'slider-width',
    'std' => '960',
    'text' => ' Slider Width in pixels',
  ),
  2 => 
  array (
    'type' => 'text',
    'name' => 'slider-height',
    'std' => '400',
    'text' => ' Slider Height in pixels',
  ),
  3 => 
  array (
    'type' => 'check',
    'name' => 'slider-autoslide-enable',
    'std' => 1,
    'text' => ' enable Auto-Sliding with delay of ',
  ),
  4 => 
  array (
    'type' => 'text',
    'name' => 'slider-autoslide-interval',
    'std' => '5000',
    'text' => ' milliseconds between each slide ',
  ),
);
}
?>