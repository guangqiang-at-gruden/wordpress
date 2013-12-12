jQuery(document).ready(function($) {
	
	
		//$(parent.document).find('body').css('opacity', 0.5);
		
	function close() {
		var items = $('.sidebar_manager_item');
		var output = '<option value="default">Default</option>';
		items.each(function() {
			var name = $(this).find('.sidebar_name').val();
			if( name == 'fw_sid_manager_delete') 
				name = $(this).find('.sidebar_name').attr('origin_val');
			var id = $(this).find('.sidebar_id').val();
			output = output + '<option value="' + id +'">' + name + '</option>';
		});
		
		$(parent.document).find('.select_sidebar').each(function () {
			var val = $(this).find('select').val();
			//alert(output.indexOf(val) == -1);
			if( output.indexOf(val) == -1 ){
				val = 'default';
				//$(this).find('select').val('default');
				//alert('xxx');
			}
				
				
			$(this).find('select').html(output);
			$(this).find('select').val(val);
			$(parent.document).find('#TB_overlay, #TB_window').remove();
		});
	}
		
		
	$('body').animate({opacity:1}, 500);
	$('.sm_add_new_sidebar').click(function() {
		var new_sb_name = $('.new_sidebar_name').val();
		if( new_sb_name != '' ) {
			
			var sb_mng_it = $('.sidebar_manager_item_blank').eq(0);
			
			if( sb_mng_it.length > 0 ) {
				
				var new_item = $('<div class="sidebar_manager_item"></div>');
					
				new_item.html(sb_mng_it.html());
				new_item.css('opacity',0);
				
				new_item.find('.sidebar_name').attr('value', new_sb_name);
				new_item.find('.sidebar_id').attr('value', 'none');
				sb_mng_it.before(new_item);
				new_item.animate({opacity:1}, 200);
				$('.new_sidebar_name').val('');
			
			}
			
		}
		return false;
	});
	
	$('.sm_close_sidebars').click(function() {
		close();
		return false;
	} );
	$('.sm_save_sidebars').click(function() {
		normalize_form_before_sending();
		$('body').animate({opacity:0}, 300);
		//return false;
	});
	
	$('.sidebar_manager_item_button_rename').live('click',function() {
		$(this).parent().find('.sidebar_name').select();
	});
	
	$('.sidebar_manager_item_button_delete').live('click',function() {
		
		$(this).parent().animate({opacity:0},300,function() {
			if( $(this).find('.sidebar_id').val() == 'none')
				$(this).remove();
			else {
				var origin_val = $(this).find('.sidebar_name').val();
				$(this).find('.sidebar_name').attr('value','fw_sid_manager_delete');
				$(this).find('.sidebar_name').attr('origin_val', origin_val);
				$(this).css('display','none');
			} 
				
		});
	});	
	
	function normalize_form_before_sending() {
		var items = $('.sidebar_manager_item');
		
		var counter = 0;
		var number_of_items = items.length;
		$('.sidebars_count').val( number_of_items );
		items.each(function() {
			var sid_name = $(this).find('.sidebar_name').attr('name');
			var sid_id = $(this).find('.sidebar_id').attr('name');
			$(this).find('.sidebar_name').attr('name', sid_name + '_' + counter);
			$(this).find('.sidebar_id').attr('name', sid_id + '_' + counter);
			counter++;
		});
	}
});
