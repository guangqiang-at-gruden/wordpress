<?php


if( isset($_POST['pagebuilder_action']) && $_POST['pagebuilder_action'] == 'add' ) 
	add_new_pagebuilder_template();
else if ( isset($_POST['pagebuilder_action']) && $_POST['pagebuilder_action'] == 'rename' )
	fpagebuilder_rename_template();
else if ( isset($_POST['pagebuilder_action']) && $_POST['pagebuilder_action'] == 'delete' )
	fpagebuilder_delete_template(); 
else if ( isset($_POST['pagebuilder_action']) && $_POST['pagebuilder_action'] == 'duplicate' )
	fpagebuilder_duplicate_template(); 

function fpagebuilder_duplicate_template() {
	
	if( fOpt::GetCurrent('pagebuilder_rename', 'has_been_duplicated') == 'true'  || $_POST['pagebuilder_action'] != 'duplicate')
		return;	
	
	if( isset( $_POST['pagebuilder_actual_template'] )  && $_POST['pagebuilder_actual_template'] != '') 
		$old_template_name = $_POST['pagebuilder_actual_template'];
	else 
		return false;
	
		
	if( isset( $_POST['new_template_name'] )  && $_POST['new_template_name'] != '') 
		$new_template_name = $_POST['new_template_name'];
	else 
		return false;
	
	$pbmanager = new fpagebuilderManager();
	$pbpage =  $pbmanager->loadPage( $old_template_name );
	$pbmanager->savePage( $new_template_name, $pbpage->data);
	
	$_POST['pagebuilder_page_template_to_select'] = $new_template_name;
	fOpt::Init();
	fOpt::SetCurrent('pagebuilder_rename', 'has_been_duplicated', true);	
}

function fpagebuilder_delete_template () {
	
	if( fOpt::GetCurrent('pagebuilder_rename', 'has_been_deleted') == true  || $_POST['pagebuilder_action'] != 'delete')
	 	return false;
	
	
	
	$template_to_delete = $_POST['pagebuilder_actual_template'];
	//var_dump( $template_to_delete );
	fOpt::Delete('pagebuilder_templates', $template_to_delete);
	$templates_ns = fOpt::GetNamespace('pagebuilder_templates');
	$keys = array_keys( $templates_ns  );
	$_POST['pagebuilder_page_template_to_select'] = $keys[0];
	fOpt::SetCurrent('pagebuilder_rename', 'has_been_deleted', true);
}

function fpagebuilder_rename_template() {
	if( fOpt::GetCurrent('pagebuilder_rename', 'has_been_renamed') == 'true'  || $_POST['pagebuilder_action'] != 'rename')
		return;	
	
	if( isset( $_POST['pagebuilder_actual_template'] )  && $_POST['pagebuilder_actual_template'] != '') 
		$old_template_name = $_POST['pagebuilder_actual_template'];
	else 
		return false;
	
		
	if( isset( $_POST['new_template_name'] )  && $_POST['new_template_name'] != '') 
		$new_template_name = $_POST['new_template_name'];
	else 
		return false;
	
	if( fOpt::Get('pagebuilder_templates', $new_template_name) != null )
		return;
	
	$tb_name = fOpt::$table_name;
	
	$sql = 'UPDATE '. $tb_name . ' SET name="' . $new_template_name . '" WHERE namespace="pagebuilder_templates" AND name="'.$old_template_name .'"';
	mysql_query( $sql );
	fOpt::Init();
	$_POST['pagebuilder_page_template_to_select'] = $new_template_name;
	fOpt::SetCurrent('pagebuilder_rename', 'has_been_renamed', 'true');

}

function fpagebuilder_get_templates_list(){
	
 $templates_ns = fOpt::GetNamespace('pagebuilder_templates');
 $to_print = '';
	//
	$new_name = fOpt::GetCurrent('templatebuilder', 'actual_template' );
	
	if( $new_name != null ) {
		$_POST['pagebuilder_page_template_to_select'] = $new_name;
	}
  if( $templates_ns ){
     foreach( $templates_ns as $template_name=> $value ) {
    		$selected = '';
    		if( isset( $_POST['pagebuilder_page_template_to_select'] )  && $_POST['pagebuilder_page_template_to_select'] == $template_name ) {
    			$selected= ' selected="selected" ';
    			fOpt::Set('admin_menu_last_visited', 'pagebuilder', $_POST['pagebuilder_page_template_to_select']);
    		} else if( fOpt::Get('admin_menu_last_visited', 'pagebuilder') == $template_name ) {
    			$selected= ' selected="selected" ';
    		}
    		$to_print .= '<option '.$selected .' value="' .$template_name . '">'.$template_name .'</option>';
    	}
  }else{
      echo "<option value='default'> - </option>";
  }
	echo $to_print;
}

function fpagebuilder_print_template( ) {
	fpagebuilder_check_if_templates_exists();	
	
	//fpagebuilder_rename_template();
	if( isset($_POST['pagebuilder_page_template_to_select']) )
		$template_name = $_POST['pagebuilder_page_template_to_select'];
	else if ( fOpt::Get('admin_menu_last_visited', 'pagebuilder') != null ) {
		$template_name = fOpt::Get('admin_menu_last_visited', 'pagebuilder');
	}
	else {
		
			$templates_ns = fOpt::GetNamespace('pagebuilder_templates');
		foreach( $templates_ns as $template_namess=> $value ) {
			$template_name = $template_namess;
			break;
		}
	}

	
	$pbmanager = new fpagebuilderManager();
	$pbpage = $pbmanager->loadPage( $template_name );
	//$pbpage = $neco;
	
	$data = $pbpage->data;
	 
	
	if( empty($data) ) {
		 $one_col = array();
	$one_col['width'] = '33.33';
	
	$one_row = array();
	$one_row[] = $one_col;
	$one_row[] = $one_col;
	$one_row[] = $one_col;
	$data = array();
	$data[] = $one_row;
	}
	
 
	
	foreach( $data as $one_row ) {
		echo '<div class="row_wrapper">
				<div class="add_col_button"></div>
				<div class="add_col_button_left"></div>
						<div class="add_row_button"></div>
						<div class="add_col_hover"></div>
						<div class="add_col_left_hover"></div>
						<div class="add_row_hover"></div>
						<div class="row_content">
						<div class="row_inner">';
			if( !empty($one_row))
			foreach( $one_row as $one_col ) {
					$width = $one_col['width'];
					if( strpos($width, '%') === false )
						$width = $width . '%';
					if( isset($one_col['widgets']) )
						$widgets = $one_col['widgets'];
					else $widgets = null;
					
					echo '<div class="col_wrapper" style="width:'.$width.';">
								<div class="delete_col_button"></div>
								<div class="col">
									<div class="col_content">';
						if( !empty($widgets))
						foreach( $widgets as $one_widget ) {
								$type = $one_widget['type'];
								$data = null;
								if( isset( $one_widget['data'] ) )
									$data = $one_widget['data'];
								$name = fEnv::getComponentName($type);
								echo '  <div class="module_wrapper  ui-draggable" style="display: block; ">
											<div class="module" rel="'.$type.'">
												<div class="button_drop"></div>
												<h4>'.$name.'</h4>';
			
											echo '<div class="widget_data_holder" style="display:none">';
											if( $data != null)
											foreach( $data as $name=>$value) {
												echo '<div rel="'.$name.'">';
													echo stripslashes($value);
												echo '</div>';
											}									
											echo '</div>';
								
								echo		'</div>
										</div>';
						}
									
										
					echo			'</div>
									<div class="col_size_wrapper">
											<div class="col_size">
												<div class="col_size_text_wrapper">
													<div class="col_size_text">
														<input class="column_width_input" type="text" value="'.$width.'" width="20" readonly>
													</div>													
													<div class="clear"></div>
												</div>
																									
													<div class="col_size_dropdown_content">
														    <div class="col_size_dropdown_line">
							                           <div class="col_size_dropdown_percentage">100%</div>
							                           <div class="col_size_dropdown_fraction">1/1</div>
							                           <div class="clear"></div>
							                        </div>
							                        <div class="col_size_dropdown_line">
							                           <div class="col_size_dropdown_percentage">80%</div>
							                           <div class="col_size_dropdown_fraction">1/5</div>
							                           <div class="clear"></div>
							                        </div>
							                        <div class="col_size_dropdown_line">
							                           <div class="col_size_dropdown_percentage">75%</div>
							                           <div class="col_size_dropdown_fraction">3/4</div>
							                           <div class="clear"></div>
							                        </div>
							                        <div class="col_size_dropdown_line">
							                           <div class="col_size_dropdown_percentage">66%</div>
							                           <div class="col_size_dropdown_fraction">2/3</div>
							                           <div class="clear"></div>
							                        </div>
							                        <div class="col_size_dropdown_line">
							                           <div class="col_size_dropdown_percentage">60%</div>
							                           <div class="col_size_dropdown_fraction">3/5</div>
							                           <div class="clear"></div>
							                        </div>
							                        <div class="col_size_dropdown_line">
							                           <div class="col_size_dropdown_percentage">50%</div>
							                           <div class="col_size_dropdown_fraction">1/2</div>
							                           <div class="clear"></div>
							                        </div>
							                        <div class="col_size_dropdown_line">
							                           <div class="col_size_dropdown_percentage">40%</div>
							                           <div class="col_size_dropdown_fraction">2/5</div>
							                           <div class="clear"></div>
							                        </div>
							                        <div class="col_size_dropdown_line">
							                           <div class="col_size_dropdown_percentage">33%</div>
							                           <div class="col_size_dropdown_fraction">1/3</div>
							                           <div class="clear"></div>
							                        </div>
							                        <div class="col_size_dropdown_line">
							                           <div class="col_size_dropdown_percentage">25%</div>
							                           <div class="col_size_dropdown_fraction">1/4</div>
							                           <div class="clear"></div>
							                        </div>
							                        <div class="col_size_dropdown_line">
							                           <div class="col_size_dropdown_percentage">20%</div>
							                           <div class="col_size_dropdown_fraction">1/5</div>
							                           <div class="clear"></div>
							                        </div>
														
													
												</div>
												<div class="clear"></div>
											</div>
											</div>
								</div>
							</div>';
			}						
						
						
		echo '				<div class="clear"></div>
						</div>
					<div class="clear"></div>
					</div>
				</div>';	
	} 
}

// ADD NEW PAGE
function add_new_pagebuilder_template( $new_name = null) {
	if( !isset($_POST['new_template_name'] ) ) return;
	$name = $_POST['new_template_name'];
	if( $name == '' && $new_name == null) return;
	
	if( $new_name != null )
		$name = $new_name;
	
	
	$one_col = array();
	$one_col['width'] = '33.33';
	
	$one_row = array();
	$one_row[] = $one_col;
	$one_row[] = $one_col;
	$one_row[] = $one_col;
	
	$data = array();
	$data[] = $one_row;
	$pbmanager = new fpagebuilderManager();
	$pbmanager->savePage($name, $data);
	fOpt::SetCurrent('templatebuilder', 'actual_template', $name);

	
}


?>