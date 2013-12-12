<?php

// Jmeno vlevo
// notifikace
// lines[][] (2d array)

/*
 * option
 * type = input, option, checkbox, radio box
 * name = unikatni name
 * std = true, false, value
 * text
 */

class fThemeOptionsStore {
	
	private $data = array();
	private $actual_namespace = null;
	private $namespace_order = array();
	private $actual_option = null;
	
	public function extractAllParameters() {
		$options = array();
		foreach( $this->data as $one_namespace) {
			foreach( $one_namespace as $one_option ) {
				foreach ( $one_option['lines'] as $one_line ) {
					foreach( $one_line as $one_param) {
						$options[] = $one_param;
					}
				}
			}
			
		}
		return $options;
	}

	private function getActualOption() {
		$actual_namespace_options = $this->data[ $this->actual_namespace ];
		$number_of_options = count($actual_namespace_options);
		if( $number_of_options > 0) $number_of_options --;
		
		return $actual_namespace_options[ $number_of_options ];
		
	}
	private function setActualOption( $option ) {
		$actual_namespace_options = $this->data[ $this->actual_namespace ];
		$number_of_options = count($actual_namespace_options);
		if( $number_of_options > 0) $number_of_options --;
		
		$actual_namespace_options[ $number_of_options ] = $option;
		$this->data[ $this->actual_namespace ] = $actual_namespace_options;
	}
	
	public function startNamespace( $namespace, $css, $name ) {
		$this->actual_namespace = $namespace;
		$this->namespace_order[] = array( 'namespace' => $namespace, 'css' => $css, 'name'=>$name);
	}
	
	public function startOption($name, $notification) {
		
		$this->actual_option = $name;
		
		$option['name'] = $name;
		$option['notification'] = $notification;
		$option['lines_count'] = 0;
		
		$this->data[ $this->actual_namespace ][] = $option;
	}
	
	public function addParameter( $type, $name, $std, $text, $options = null ) {
		$param['type'] = $type;
		$param['name'] = $name;
		$param['std'] = $std;
		$param['text'] = $text;
		if( $options !== null ) $param['options'] = $options;
		
		$option = $this->getActualOption();
		
		$option['lines'][ $option['lines_count'] ][] = $param;
		
		//var_dump($option);
		$this->setActualOption($option);
		
	}
	
	public function addParameterNL( $type, $name, $std, $text, $options = null) {
		$this->addParameter($type, $name, $std, $text, $options );
		$this->nextLine();
	}
	public function addSelect($name, $value ) {
		$option = $this->getActualOption();
		//var_dump($option);
		$option_to_insert = array('name'=>$name, 'value'=>$value);
		$last_inserted_id = count($option['lines'][ $option['lines_count'] ]) -1;
		
		$option['lines'][ $option['lines_count'] ][$last_inserted_id]['options'][] = $option_to_insert;
		
		//var_dump($option);
		$this->setActualOption($option);
	}
	
	public function nextLine() {
		$actual_namespace_options = $this->data[ $this->actual_namespace ];
		$number_of_options = count($actual_namespace_options);
		if( $number_of_options > 0) $number_of_options --;
		//var_dump($actual_namespace_options);
		
		$option = $actual_namespace_options[ $number_of_options ];
		
		
		
		$option['lines_count']++;
		
		$actual_namespace_options[ $number_of_options ] = $option;
		$this->data[ $this->actual_namespace ] = $actual_namespace_options;
		
	}
	public function endNamespace( $namesapce) { $this->actual_namespace = null; }
	
	
	public function getNamespaceList() {
		return $this->namespace_order;
	}
	
	public function dump() {
		var_dump( $this->data);
	}
	
	public function getData() { return $this->data;}
	public function getNamespaceOrder(){ return $this->namespace_order; }

}

function foptions_print_menu( fThemeOptionsStore $tos ) {
	$namespaces = $tos->getNamespaceList();
	
	$actual_namespace = null;
	if( isset( $_POST['actual_namespace'] ) )
		$actual_namespace = $_POST['actual_namespace'];
	
	
	foreach( $namespaces as $key=>$one_namespace) {
	
		$active = '';
		if( ($key == 0 && empty($actual_namespace) ) || ( $actual_namespace == $one_namespace['namespace'] )) $active = 'theme_options_content_menu_item_active'; 
		echo '<div class="theme_options_content_menu_item '.$active.'"><a href="javascript:void(0);" class="theme_options_menu_'.$one_namespace['css'].' namespace_switcher" rel="'. $one_namespace['namespace']. '">' . $one_namespace['name']. '</a></div>';
	}
}

function foptions_print_array( $tos ) {
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
				$output .= '<p class="one_option_wrapper">';
				foreach( $one_line as $param ) {
					$param_value = fOpt::Get($namespace_name, $param['name']);
					$param_value = stripslashes( $param_value );
					//$param_value = htmlspecialchars($param_value);
					//echo var_dump($param['name']);
					if( $param_value != null) { $param['std'] = $param_value; }
					$param['std'] = htmlspecialchars( $param['std'] );
					$param_name_old = $param['name'];
					$param['name'] = 'foptions-'. $namespace_name . '-' . $param['name'];
					
					switch( $param['type'] ) {
						case "button":
							$output .= '<a href="'. $param['std']. '" class="button" id="'. $param['name'].'">' . $param['text'] . '</a>';
							break;
						case "info":
							$output .= $param['text'];
							break;
						case "text":
							$output .= '<label for="'. $param['name'].'">';
							$output .= '<input class="text" type="text" class="small-text" value="'. $param['std']. '" id="'. $param['name'].'" name="'. $param['name'].'">' . $param['text'];
							$output .= '</label>';
							break;
						case "font":
              $ffGF = ffGFonts::getInstance();
              list( $ns, $n ) = explode('-', str_replace('foptions-', '', $param['name']), 2);
              $output .= $ffGF->getComponent(
                              $param['name'], // id
                              $param['std'],  // font family
                              fOpt::Get($ns,$n.'_fontFallback'),
                              fOpt::Get($ns,$n.'_fontPickerType'),
                              fOpt::Get($ns,$n.'_fontPickerURL'),
                              fOpt::Get($ns,$n.'_fontPickerCursive'),
                              fOpt::Get($ns,$n.'_fontPickerWeight')
                        );
							break;
						case "text-area":
							$output .= '<label for="'. $param['name'].'">';
							$output .= '<textarea class="textarea" style="width:300px; height:200px;"  id="'. $param['name'].'" name="'. $param['name'].'">' . $param['std'] . '</textarea>' . $param['text'];
							$output .= '</label>';
							break;							
						case "text-regular":
							$output .= '<label for="'. $param['name'].'">';
							$output .= '<input class="text" type="text" class="regular-text" value="'. $param['std']. '" id="'. $param['name'].'" name="'. $param['name'].'">' . $param['text'];
							$output .= '</label>';
							break;
							
						case "color":
							$output .= '<label for="'. $param['name'].'">';
							$output .= '<input class="text regular-text color-input" style="width:50px; background-color:#'.$param['std'].'" type="text" value="'. $param['std']. '" id="'. $param['name'].'" name="'. $param['name'].'">' . $param['text'];
							$output .= '</label>';
							break;							
							
						case "text-img":
							$output .= '<label for="'. $param['name'].'">'; 
							$output .= '<input class="text" type="text" class="regular-text" value="'. $param['std']. '" id="'. $param['name'].'" name="'. $param['name'].'">';
							$output .= '<a href="'.site_url().'/wp-admin/media-upload.php?TB_iframe=1" media-upload-link="'. $param['name'].'" class="thickbox add_media button " id="" title="Add Media" onclick="return false;">Upload / Insert</a>';
							$output .= $param['text'];
							$output .= '</label>';
							break;	
						case "check":
							$checked = '';
							//echo $param['std'] .'xxx';
						//	echo $param['std'] === '1' ;
							if( $param['std'] === 1 || $param['std'] === '1' ) $checked = 'checked="checked"';
							$output .= '<label for="'. $param['name'].'">';
							$output .= '	<input class="checkbox" type="checkbox" '.$checked.' id="'. $param['name'].'" name="'. $param['name'].'">';
							$output .=  $param['text'];
							$output .= '</label>'; 
							break;
							
						case "radio":
							foreach( $param['options'] as $one_radio_option ) {
								$checked = '';
								if( $param['std'] === $one_radio_option['value'] ) $checked = 'checked="checked"';
								$output .= '<label for="'. $param['name'].'">';
								$output .= '<input class="radio" type="radio" '.$checked.' value="'.$one_radio_option['value'].'" name="'. $param['name'].'">'.$one_radio_option['name'].'</label><br>';
							}
							break;

						case "select":
							//  <option selected="selected" value="newest">last</option><option value="oldest">first</option></select> page displayed by default</label>
							$output .= '<label for="'. $param['name'].'">';
							
							
							$value_specific = fOpt::Get($namespace_name,  $param_name_old);
							if( $value_specific != null ) $param['std'] = $value_specific;
							
							$output .= '<select class="select" id="'. $param['name'].'" name="'. $param['name'].'">';
							
							
							foreach( $param['options'] as $one_select ) {
								$selected = '';
								
								if( $param['std'] == $one_select['value'] ) $selected = 'selected="selected"';
								$output .= '<option '.$selected.' value="'.$one_select['value'].'">'.$one_select['name'].'</option>';
							}
							$output .= '</select>';
							$output .= $param['text'];
							$output .= '</label>';
						break;
						
						
					}
					
				}
				$output .= '</p>';
			}
			if( !empty($one_option['notification'] ))
				$output .= '<div class="description">' .$one_option['notification'] . '</div>';
			$output .= '</td>';

		}
		
		$output .= '</table>';

	}
	echo $output;
}


function foptions_view() {

	$tos = foptions_get_data_object();
			
?>
		<div id="theme_options" class="wrap">
			<div class="icon32" id="icon-options-general"><br></div>
			<h2>Theme Options</h2>
			
			<div class="options_header theme_options_header">
				<?php 
				/*
				<!--<select id="options_select" name="options_select">
					<?php fpagebuilder_get_templates_list(); ?>
				</select>
				<a target="_blank" class="btn_add button button_secondary" href="">Add New</a>
				<a target="_blank" class="btn_rename button button_secondary" href="">Rename</a>
				<a target="_blank" class="btn_duplicate button button_secondary" href="">Duplicate</a>
				<a target="_blank" class="btn_import button button_secondary" href="">Import</a>
				<a target="_blank" class="btn_export button button_secondary" href="">Export</a>
				<a target="_blank"  class="btn_delete button button_secondary" href="">Delete</a>
				-->
				 * */?>
				<input type="submit" name="publish" id="publish" class="theme_options_save button button_primary" value="Save Changes" tabindex="5" accesskey="p">
				<div class="clear"></div>
			</div>
			
			<div id="theme_options_content_wrapper">
				<div id="theme_options_content">
					<div id="theme_options_content_left_wrapper">
						<div id="theme_options_content_left">
							<?php foptions_print_menu($tos); ?>
						</div><!-- end theme_options_content_left -->
					</div><!-- end theme_options_content_left_wrapper -->
					<div id="theme_options_content_right_wrapper">
						<form method="post">
						<div id="theme_options_content_right">
							<?php foptions_print_array( $tos ); ?>
							<table class="form-table">
								
							</table><!-- end form-table -->
							
							<div class="clear"></div>
						</div><!-- end theme_options_content_right -->
						</form>
						
					</div><!-- end theme_options_content_right_wrapper -->
					<div class="clear"></div>
				</div><!-- end theme_options_content -->
			</div><!-- end theme_options_content_wrapper -->
		</div><!-- end theme_options -->
<?php

    $ffGF = ffGFonts::getInstance();
    $ffGF->printFontPickerJavascript();

}
