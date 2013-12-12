jQuery(document).ready( function($) {
	var actual_namespace = $('.theme_options_content_menu_item_active').find('a').attr('rel');
	
		
	$('.namespace_switcher').click(function() {
		var namespace_name = $(this).attr('rel');
		actual_namespace = namespace_name;

		$('.foptions_all_tables').css('display','none');
		$('.foptions_' + namespace_name).css('display','table');
		
		$('.theme_options_content_menu_item').removeClass('theme_options_content_menu_item_active');
		$(this).parent().addClass('theme_options_content_menu_item_active');
	});
	
	$('.theme_options_save').click(function() {
		
		var all_checkboxes = $('#theme_options_content_right_wrapper').find('form').find('input[type=checkbox]');
		$(all_checkboxes).each(function(){
			//alert($(this).attr('value'));
			if( $(this).attr('checked') != 'checked' ) {
				//alert($(this).attr('value'));
				$('#theme_options_content_right_wrapper').find('form').append('<input type="hidden" name="'+$(this).attr('name')+'" value="0">');
			} else {
				$('#theme_options_content_right_wrapper').find('form').append('<input type="hidden" name="'+$(this).attr('name')+'" value="1">');
			}
			$(this).attr('name', 'nothing');
		});
		
		$('#theme_options_content_right_wrapper').find('form').append('<input type="hidden" name="actual_namespace" value="'+ actual_namespace +'">');
		$('#theme_options_content_right_wrapper').find('form').submit();
		
	});
	
	
	$('.thickbox').attachMediaUploader('media-upload-link', function( url, attr) {
		$('#' + attr ).val( url );
	 });
//	});
	
	
	 /*$('.color-input').ColorPicker({
		 //onShow:function(colpkr ) {
			//console.log( this );
		 //}
		 onChange: function(hsb, hex, rgb, el) {
			 
			 $(this).css('opacity','0.5');
			//$(el).val(hex);
			//$(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		}});*/
	$('.color-input').each(function() { 
		__colorInputHolder__ = $(this);
		var bgColor = '#'+$(this).val();
		if( bgColor == '#' ) bgColor = '#ffffff';
		$(this).css('background-color', bgColor);
		$(this).css('color', bgColor);
		$(this).ColorPicker({ flat:false,
			onChange: function(hsb, hex, rgb) {
				 __colorInputHolder__.val(hex);
				 __colorInputHolder__.css('background-color', '#'+hex);
				 __colorInputHolder__.css('color', '#'+hex);
			},
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
		});
	});
});
