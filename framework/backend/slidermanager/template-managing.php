<?php
if( isset($_POST['fslidermanager_action']) && $_POST['fslidermanager_action'] == 'delete' ) 
	fslidermanager_delete_slider();
else if( isset($_POST['fslidermanager_action']) && $_POST['fslidermanager_action'] == 'add' ) 
	$_POST['fslidermanager_actual_slider_id'] = $_POST['new_slider_name'];

else if( isset($_POST['fslidermanager_action']) && $_POST['fslidermanager_action'] == 'rename' ) 
	fslidermanager_rename_slider();


else if( isset($_POST['fslidermanager_action']) && $_POST['fslidermanager_action'] == 'duplicate' ) 
	fslidermanager_duplicate_slider();

function fslidermanager_delete_slider() {
	if( !isset($_POST['fslidermanager_actual_template']) || $_POST['fslidermanager_actual_template'] == '' )
		return;
	
	$templ_name = $_POST['fslidermanager_actual_template'];
	//fslidermanager_actual_slider_id
	
	fOpt::Delete('slidermanager_sliders', $templ_name);
	
	$nspace = fOpt::GetNamespace( 'slidermanager_sliders' );
	$nspace_keys = array_keys( $nspace );
	$_POST['fslidermanager_actual_slider_id'] = $nspace_keys[0];
}

function fslidermanager_rename_slider() {
	if( !isset($_POST['fslidermanager_actual_template']) || $_POST['fslidermanager_actual_template'] == '' )
		return;

	if( !isset($_POST['new_slider_name']) || $_POST['new_slider_name'] == '' )
		return;
	
	$old_name = $_POST['fslidermanager_actual_template'];
	$new_name = $_POST['new_slider_name'];
	
	 
	$smdm = new fSliderManagerDataManager();
	$smdm->renameSlider($old_name, $new_name);
	fOpt::Delete('slidermanager_sliders', $old_name);
	 
	fOpt::Init();
	$_POST['fslidermanager_actual_slider_id'] = $new_name;
	 
}

function fslidermanager_duplicate_slider() {
	if( !isset($_POST['fslidermanager_actual_template']) || $_POST['fslidermanager_actual_template'] == '' )
	return;

	if( !isset($_POST['new_slider_name']) || $_POST['new_slider_name'] == '' )
		return;
	
	$old_name = $_POST['fslidermanager_actual_template'];
	$new_name = $_POST['new_slider_name'];
	
	 
	$smdm = new fSliderManagerDataManager();
	$smdm->duplicateSlider($old_name, $new_name);
	 
	//mysql_query( $sql );
	fOpt::Init();
	$_POST['fslidermanager_actual_slider_id'] = $new_name;
}
?>