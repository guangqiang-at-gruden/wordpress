jQuery(document).ready(function($) {
	

	
/********************************************************************************
 * ADDING NEW TEMPLATE
 ********************************************************************************/

function create_ntd( action ) {
	var ntd = ''; // New Template Dialog
	
	var action_text = 'Add New';
	if( action == 'rename') action_text = 'Rename';
	else if( action == 'duplicate' ) action_text = 'Duplicate';
	
	ntd += '<form method="POST">';
	ntd += '<div class="extra_wrapper"><div class="modal_header"><h2>'+ action_text + ' Content Template</h2></div>';
	ntd += '<div class="one_option_wrapper"><p>';
	ntd += '<label for="new_template_name">Content Template Name</label>';
	ntd += '<input type="text" name="new_template_name">';
	ntd += '<input type="hidden" name="pagebuilder_action" value="' + action + '">';
	if( action != 'add' ) ntd += '<input type="hidden" name="pagebuilder_actual_template" value="' + $('#template_select').val() + '">';
	ntd += '<span style="display:block;" class="clear"></span></p></div>';
	ntd += '<div class="modal_footer"><input type="submit" class="modal_button_close" value="Cancel"><input type="submit" class="modal_button_save" value="' + action_text + '"></div></div>';
	ntd += '</form>';
		
	return ntd;
}





	$('.btn_add').click(function() {
		ntd = create_ntd('add');
		$.colorbox({html:ntd,width:700,height:700}); return false; 
	});
	
	$('#template_select').change(function() {
	//	alert('aaa');
		var form = '<form method="POST"><input type="hidden" name="pagebuilder_page_template_to_select" value="' + $(this).val() + '"></form>"';
		$(form).appendTo('body').submit();
	});
	
	
	$('.btn_rename').click( function() {
		ntd = create_ntd('rename');
		$.colorbox({html:ntd,width:700,height:700}); return false; 
	});
	
	$('.btn_delete').click( function() {
		 
		var answer = confirm ("Are you sure you want to delete this template?");
		if( !(answer) )
				return false;			
		ntd = create_ntd('delete');
	 	$(ntd).appendTo('body').submit();
	 	return false;
		//$.colorbox({html:ntd}); return false; 
	});	
	
	$('.btn_duplicate').click( function() {
		ntd = create_ntd('duplicate');
	 	//$(ntd).appendTo('body').submit();
	 	$.colorbox({html:ntd,width:700,height:700}); return false; 
	});		
	
	
	$('.thickbox').attachMediaUploader('media-upload-link', function(url, attr){
		$('#'+attr).val(url);
	});
});
