jQuery(document).ready(function($){
	adjust_button_position();
/****************************************************************************************************************
 * MODULE PREVIEW
 *****************************************************************************************************************/
	var module_preview_img = $('.module_preview').find('img').attr('src');
	$('.modules_list').find('.module_wrapper').hover(function(){
		__this__ = $(this);
		var rel_name = $(this).find('.module').attr('rel');
		
		var new_img_src = $('.module_preview_images').find('.' + rel_name).find('img').attr('src');
		
	 //$('.module_preview_images').find('.' + rel_name).css('display','none');
	 			$('.module_preview').find('img').attr('src', new_img_src);
				var height = $('.module_preview').outerHeight();
				var this_top = __this__.offset().top;
				//alert(this_top);
				var top =  this_top - 35;
				//$('.module_preview').offset().top = 10;
				//$('.module_preview').css({'top':top, 'display':'block'});
				$('.module_preview').css({'opacity':0, 'display':'block'});
				$('.module_preview').stop().delay(0).css({'opacity':0, 'top':top,'display': 'block'}).animate({ opacity:1 }, 0);		

		
	}
	,function() {
		$('.module_preview').stop().css({'opacity':0, 'display': 'none'});
		$('.module_preview').find('img').data('loading_img', false); 
	});
	
	$('.select-icon-for-icon').live('click',function(){ 
		var icon_val = $(this).attr('data-value');
		$(this).parents('.one_option_wrapper').find('input').val( icon_val );
	});
	

/****************************************************************************************************************
 * MODULE PREVIEW
 *****************************************************************************************************************/


	$(window).resize(function() {
		var width = $('#rows').width();
		var width_button = $('.add_row_button').width();
		
		var left_new = width/2 - width_button/2;
		$('.add_row_button').css('left', left_new);
		
		//alert(width);
	});


	function resize_column_width_and_adjust( col_changed ){
		//alert('aa');
		//col_changed.css('display','none');
		
		col_changed.data('is_eq', true);
		var new_val = col_changed.find('.column_width_input').val();
		
		new_val = parseFloat(new_val.replace('%',''));
		if( new_val < 10) {
			new_val = 10;
			col_changed.find('.column_width_input').val('10%');
		}
		var val_together = 0;
		col_changed.parent().find('.col_wrapper').each(function() {
			if( $(this).data('is_eq') != true ) {
				var this_val = $(this).find('.column_width_input').val();
				this_val = parseFloat(this_val.replace('%',''));
				val_together += this_val;
			} else {
				$(this).data('is_eq', false);
			}
		}); 
		//alert(val_together + new_val );
		if( (val_together + new_val ) > 100 ) {
			valFound = false;
			$('.col_size_dropdown_content').eq(0).find('.col_size_dropdown_percentage').each(function() { 
				newValSmaller = parseInt($(this).html().replace('%',''));
				if( val_together + newValSmaller <= 100 && valFound == false) {
					new_val = newValSmaller;
					if( new_val == 33) new_val = 33.33;
					if( new_val == 66) new_val = 66.66;
					valFound = true;
				}
			});
			//new_val = 100 - val_together;
			col_changed.find('.column_width_input').val(new_val);
		}
	//	alert(val_together);
		resize_column_width();
	}


	function resize_column_height() {
		
		var rows = $('.row_wrapper');
		
		rows.each(function() {
			var biggest_height = 0;
			$(this).find('.col').each(function() {
				$(this).css('height','100%');
				if( $(this).height()> biggest_height )
					biggest_height = $(this).height();
			});
			
			$(this).find('.col').each(function() {
				$(this).height( biggest_height);
			});			
		});
	}
	resize_column_height();
	function rebind_jquery_ui() {
		var col_content_selector = '.row_wrapper .col_content';
		$(col_content_selector).sortable({placeholder: "pagebuilder_placeholder", connectWith: col_content_selector, revert:false, cancel:'.col_size',stop:resize_column_height,
			start: function(event, ui) {
				ui.helper.css('width', 200);
			//	 ui.helper.css('margin-left', 200);
				//console.log( ui.position );
				
			},
 
			beforeStop:function(event, ui) {
				var tolerance_in_pixels = 20;
				//alert($('#rows').offset().top); 
				if( ui.offset.top < ($('#rows').offset().top - tolerance_in_pixels) )
					remove_and_alert(ui);
				else if( ui.offset.top > ($('#rows').offset().top + tolerance_in_pixels + $('#rows').height() ) )
					remove_and_alert(ui);
				else if( ui.offset.left < ($('#rows').offset().left - tolerance_in_pixels) )
					remove_and_alert(ui);
				else if( ui.offset.left > ($('#rows').offset().left + tolerance_in_pixels + $('#rows').width() ) )
					remove_and_alert(ui);
					
								
					//alert(ui.offset.top); 
			}
		}).disableSelection();
		$( ".modules_list .module_wrapper" ).draggable({connectToSortable:col_content_selector, helper:'clone' });
		resize_column_height();

		
	}
	
	function remove_and_alert( ui ) {
		//console.log(ui_helper);
		ui.helper.css('display','none');
		ui.placeholder.css('display','none');
		var answer = confirm ("Are you sure you want to delete this Module?")
		 
		if (answer)
			ui.helper.remove();
		else {
			ui.helper.css('display', 'block');
			ui.placeholder.css('display','block');
		}
			
	// */
	}
	
	rebind_jquery_ui();
	var new_line_html = $('.hidden_options').find('.row_wrapper_holder').html();//'<div class="row_wrapper"><div class="add_col_button"></div><div class="add_col_button_left"></div><div class="add_row_button"></div><div class="add_col_left_hover"></div><div class="add_col_hover"></div><div class="add_row_hover" style="display: none; "></div><div class="row_content"><div class="row_inner"><div class="col_wrapper" style="width:100%;"><div class="delete_col_button"></div><div class="col" style="height: 50px; "><div class="col_content ui-sortable"></div><div class="col_size_wrapper"><div class="col_size"><div class="col_size_text_wrapper"><div class="col_size_text"><input class="column_width_input" type="text" value="100%" width="20"></div><div class="clear"></div></div><div class="col_size_dropdown_content" style="display: none; "><div class="col_size_dropdown_line"><div class="col_size_dropdown_percentage">25%</div><div class="col_size_dropdown_fraction">1/4</div><div class="clear"></div></div><div class="col_size_dropdown_line"><div class="col_size_dropdown_percentage">33%</div><div class="col_size_dropdown_fraction">1/3</div><div class="clear"></div></div><div class="col_size_dropdown_line"><div class="col_size_dropdown_percentage">50%</div><div class="col_size_dropdown_fraction">1/2</div><div class="clear"></div></div><div class="col_size_dropdown_line"><div class="col_size_dropdown_percentage">66%</div><div class="col_size_dropdown_fraction">2/3</div><div class="clear"></div></div><div class="col_size_dropdown_line"><div class="col_size_dropdown_percentage">75%</div><div class="col_size_dropdown_fraction">3/4</div><div class="clear"></div></div><div class="col_size_dropdown_line"><div class="col_size_dropdown_percentage">100%</div><div class="col_size_dropdown_fraction">1/1</div><div class="clear"></div></div></div><div class="clear"></div></div></div></div></div><div class="clear"></div></div><div class="clear"></div></div></div>';
	var new_col_html = $('.hidden_options').find('.col_wrapper_holder').html();//'<div class="col_wrapper" style="width:33.33%;"><div class="delete_col_button"></div><div class="col" style="height: 50px; "><div class="col_content ui-sortable"></div><div class="col_size_wrapper"><div class="col_size"><div class="col_size_text_wrapper"><div class="col_size_text"><input class="column_width_input" type="text" value="33.33%" width="20"></div><div class="clear"></div></div><div class="col_size_dropdown_content" style="display: none; "><div class="col_size_dropdown_line"><div class="col_size_dropdown_percentage">25%</div><div class="col_size_dropdown_fraction">1/4</div><div class="clear"></div></div><div class="col_size_dropdown_line"><div class="col_size_dropdown_percentage">33%</div><div class="col_size_dropdown_fraction">1/3</div><div class="clear"></div></div><div class="col_size_dropdown_line"><div class="col_size_dropdown_percentage">50%</div><div class="col_size_dropdown_fraction">1/2</div><div class="clear"></div></div><div class="col_size_dropdown_line"><div class="col_size_dropdown_percentage">66%</div><div class="col_size_dropdown_fraction">2/3</div><div class="clear"></div></div><div class="col_size_dropdown_line"><div class="col_size_dropdown_percentage">75%</div><div class="col_size_dropdown_fraction">3/4</div><div class="clear"></div></div><div class="col_size_dropdown_line"><div class="col_size_dropdown_percentage">100%</div><div class="col_size_dropdown_fraction">1/1</div><div class="clear"></div></div></div><div class="clear"></div></div></div></div></div>';
	
	function adjust_button_position() {
		var width = $('#rows').width();
		var width_button = $('.add_row_button').width();
		var left_new = width/2 - width_button/2;
		$('.add_row_button').css('left', left_new);
	}
	
	$('.add_row_button_first').live('click', function() {
		$('.add_row_hover_first').after( new_line_html );
		var width = $('#rows').width();
		var width_button = $('.add_row_button').width();
		
		var left_new = width/2 - width_button/2;
		$('.add_row_button').css('left', left_new);
		rebind_jquery_ui();	
	});
	
		
	$('.add_row_button_first').live('mouseover', function() {
		$('.add_row_hover_first').css('display','block');
	} );
	
	$('.add_row_button_first').live('mouseout', function() {
		$('.add_row_hover_first').css('display','none');
	} );
	
	
	$('.row_wrapper').find('.add_row_button').live('click', function() {
		$(this).parent().after( new_line_html );
		var width = $('#rows').width();
		var width_button = $('.add_row_button').width();
		
		var left_new = width/2 - width_button/2;
		$('.add_row_button').css('left', left_new);
		rebind_jquery_ui();	
	});
	
		
	$('.row_wrapper').find('.add_row_button').live('mouseover', function() {
		$(this).parent().find('.add_row_hover').css('display','block');
	} );
	
	$('.row_wrapper').find('.add_row_button').live('mouseout', function() {
		$(this).parent().find('.add_row_hover').css('display','none');
	} );
	
	
	$('.add_col_button').live('mouseover', function() {

		$(this).parent().find('.add_col_hover').css('display','block');
	} );
	
	$('.add_col_button_left').live('mouseover', function() {

		$(this).parent().find('.add_col_left_hover').css('display','block');
	} );
	
	$('.add_col_button_left').live('mouseout', function() {
		$(this).parent().find('.add_col_left_hover').css('display','none');
			} );	
	
	$('.add_col_button').live('mouseout', function() {
		$(this).parent().find('.add_col_hover').css('display','none');
	} );
	
	
	$('.add_col_button_left').live('click', function() {
		var number_of_columns = $(this).parent().find('.col_wrapper').size();
		
		if( number_of_columns == 5) return false;
		$(this).parent().find('.col_wrapper').first().before(new_col_html);
		var number_of_el = $(this).parent().find('.col_wrapper').size();
		//alert( $(this).parent().find('.col_wrapper').size() )
		$(this).parent().find('.col_wrapper').each(function() {
			var new_width = 100 / number_of_el;
			new_width = new_width * 100;
			new_width = Math.ceil( new_width );
			new_width = new_width / 100;
			if( new_width == 33.34)
				new_width = 33.33;
			else if( new_width == 16.67 )
				new_width = 16.66;				
				
			else if( new_width == 14.29 )
				new_width = 14.28;
				
			else if( new_width == 11.12 )
				new_width = 11.11;				
			$(this).find('.column_width_input').val( new_width );
		});
		resize_column_width();
		rebind_jquery_ui();	
		
	} );
		
	$('.add_col_button').live('click', function() {
		var number_of_columns = $(this).parent().find('.col_wrapper').size();
		if( number_of_columns == 5) return false;
		$(this).parent().find('.col_wrapper').last().after(new_col_html);
		var number_of_el = $(this).parent().find('.col_wrapper').size();
		//alert( $(this).parent().find('.col_wrapper').size() )
		$(this).parent().find('.col_wrapper').each(function() {
			var new_width = 100 / number_of_el;
			new_width = new_width * 100;
			new_width = Math.ceil( new_width );
			new_width = new_width / 100;
			if( new_width == 33.34)
				new_width = 33.33;
			else if( new_width == 16.67 )
				new_width = 16.66;				
				
			else if( new_width == 14.29 )
				new_width = 14.28;
				
			else if( new_width == 11.12 )
				new_width = 11.11;				
			$(this).find('.column_width_input').val( new_width );
		});
		resize_column_width();
		rebind_jquery_ui();	
		
	} );
		
	
	
	$('.delete_col_button').live('click', function() {
		var num_of_elements = $(this).parent().find('.col_content').find('.module_wrapper').size();
		
		if( num_of_elements != 0 ) {
			var answer = confirm ("This Column is not empty. Are you sure you want to delete it?");
			if( !(answer) )
				return;
		}
		
		var number_of_columns = $(this).parent().parent().find('.delete_col_button').size();
		var number_of_rows = $('#rows').find('.row_wrapper').size();
		//alert(number_of_rows);
		if( number_of_columns == 1 && number_of_rows != 1) {
			
			var to_remove = $(this).parent().parent().parent().parent();
			to_remove.animate({opacity:0}, 300, function() {
				$(this).remove();	
			});
		
		}
		else if( number_of_columns != 1) {
			//alert('aa');
			var to_remove = $(this).parent();
			to_remove.animate({opacity:0}, 150, function() {
				$(this).remove();	
			});
			
		}
			
		
	});
	
	$('.delete_col_button').live('mouseover', function() {
		$(this).parent().css('z-index', 20);
		$(this).parent().find('.col').addClass('delete_col_hover');
	} );
	
	$('.delete_col_button').live('mouseout', function() {
		$(this).parent().css('z-index', 'auto');
		$(this).parent().find('.col').removeClass('delete_col_hover');
	} );
	
	
	
	$('.column_width_input').live('focus',function() {
		$('.col_size_dropdown_content').css('display','none');
		$(this).parent().parent().parent().parent().find('.col_size_dropdown_content').css('display','block');
	});
	
	$('.column_width_input').live('click',function(event){
		event.stopPropagation();
	} );
	$(document).click(function(){
		$('.col_size_dropdown_content').css('display','none');
		
	});
	$('.column_width_input').focusout(function() {
		//$(this).parent().parent().parent().parent().find('.col_size_dropdown_content').css('display','none');
	});	
	
	
	

	$('.col_size_dropdown_line').live('click',function() {
		var percentage = $(this).find('.col_size_dropdown_percentage').html();
		percentage = parseInt(percentage.replace('%',''));
		if( percentage == 33)
			percentage = 33.33;
		else if( percentage == 66)
			percentage = 66.66;
			
		//alert(percentage);
		$(this).parent().parent().find('.column_width_input').val(percentage);
		$(this).parent().css('display','none');
		resize_column_width_and_adjust( $(this).parent().parent().parent().parent().parent() );
		
	});
	

	/* 
	 * 		
	 */
	
/****************************************
 * COLUMN WIDTH
 */

	$('.col_size_less').live('click', function(){
		var parent_control = $(this).parent();
		var input_control = parent_control.find('input');
		var input_value = parseInt(input_control.val());
		//alert(input_value);
		var input_value_new = input_value - 5;
		if( input_value_new < 5)
			input_value_new = 5;
		
		input_control.val(input_value_new);
		resize_column_width();
	});
	
	$('.col_size_more').live('click', function(){
		var parent_control = $(this).parent();
		var input_control = parent_control.find('input');
		var input_value = parseInt(input_control.val());
		//alert(input_value);
		var input_value_new = input_value + 5;
		if( input_value_new > 95)
			input_value_new = 95;
		
		input_control.val(input_value_new);
		resize_column_width();
	});

	$('.column_width_input').live('change', function() {
		
		resize_column_width_and_adjust( $(this).parent().parent().parent().parent().parent().parent() ); 
	} );

	function resize_column_width() {
		var rows = $('.row_wrapper');
		
		rows.each(function() {
			var biggest_height = 0;
			$(this).find('.col').each(function() {
				var input_control = $(this).find('.column_width_input');
				var column_width = input_control.val();
				if( column_width.indexOf('%') != -1) {
					//alert(column_width);
					$(this).parent().css('width', column_width);
				}	else {
					input_control.val( column_width + '%');
					$(this).parent().css('width', column_width + '%');
				}
				//alert(column_width);
			});		
		});
	}
	
	function add_new_col( row ) {
	//	var columns = 
	}
/****************************************
 * DATA SAVING AND LOADING
 */
	
	var actual_module_selected = null;
	var module_options = $('#cboxLoadedContent');
	
	
	$('#rows').find('.module_wrapper').live('click', function() { 
		actual_module_selected = $(this);	
		get_form( $(this).find('.module').attr('rel') );
	//	$('#rows').find('.module_wrapper').removeClass('module_wrapper_selected');
	//	$(this).addClass('module_wrapper_selected');
		
		
		
	});
	
	function get_form( component_name ) {
	 //alert( component_name );
		var imgUrl = $('.options_header').find('.loading_spin').attr('src');
		var buttonDropHtml = '<div class="button_drop"></div>';
		var imgHtml = '<img src="'+imgUrl+'" class="loading_spin_module" />';
		actual_module_selected.find('.button_drop').after(imgHtml);
		actual_module_selected.find('.button_drop').remove();
		//$('#rows_wrapper').animate({opacity:0.3}, 200);
		//alert('xxx');
		var data = {
			action: 'pagebuilder',
			component: component_name,
		};
		
		//module_options.animate({opacity:0}, 200, function(){ $(this).animate({opacity:1}, 200);  });
		jQuery.post(ajaxurl, data, function(response) {
			actual_module_selected.find('.loading_spin_module').before(buttonDropHtml);
			actual_module_selected.find('.loading_spin_module').remove();
			//$('#rows_wrapper').animate({opacity:1}, 200);
			$.colorbox({html:response, width:700, height:700, speed:0, transition:'none'});
			$('.modal_footer').append('<input type="submit" value="Cancel" class="modal_button_close">');
			$('.modal_footer').append('<input type="submit" value="OK" class="modal_button_save">');
						
			$('.clone_start').find('.one_option_wrapper').eq(0).css('display','block');
			
			//$('.module_options_content').html(response);
			load_form();
			show_clonning_on_load();
			tinyMCE.init({ mode : "specific_textareas",editor_selector : "wp-editor-area",theme : "advanced", relative_url : false, convert_urls: false});

		});
	}
	
	
	
	
	
/******************************************************************************************************************************************************
 * CCLLOONNINNG
 *******************************************************************************************************************************************************/	
	$('.clone_more').live('click', function() {
		
		var option_wrappers = $(this).parent().find('.one_option_wrapper');
		option_wrappers.each(function() {
			
			if( $(this).css('display') == 'block' && $(this).next().css('display') == 'none'  ) {
				$(this).next().css('display', 'block');
				return false;
			}
		});
	});
	
	$('.clone_less').live('click', function() {
		
		var option_wrappers = $(this).parent().find('.one_option_wrapper');
		option_wrappers.each(function(index) {
			
		//		alert(index);
			if(  ($(this).css('display') == 'block' && $(this).next().css('display') == 'none' && index != 0 ) || ( (index+1) == option_wrappers.size() ) ) {
				/*				var namex = $(this).attr('id');
				
				value_clean = (   tinyMCE.get(namex).getContent() );*/
			//	alert($(this).find('input,textarea, .mceContentBody ').attr('value'));
				$(this).css('display', 'none');
				$(this).find('input,textarea ').attr('value','');
				var id = $(this).find('textarea').attr('id');
				//alert(id);
				 tinyMCE.get(id).setContent("");
				return false;
			}
		});
	//	option_wrappers.last().css('display','none');
	//	option_wrappers.last().find('input,textarea').attr('value','');
		option_wrappers.eq(0).css('display','block');
	});
	
	function show_clonning_on_load() {
		var clones_start = $('.clone_start');
		clones_start.each(function() {
			$(this).find('.one_option_wrapper').each(function() {
			//	alert( $(this).find('input, textarea').val() == '');
				if( !$(this).find('input, textarea').val() == '')
					$(this).css('display','block');
			});			
		});
	}
	
	
	
	
	
	
	
	function save_form() {
		
		var data_to_save = {};
	//	alert('aa');
		$('#cboxLoadedContent').find(':input').each(function() {
			var value_clean =  $(this).attr('value');
			
			if( $(this).attr('aria-hidden') == 'true' ) {
				var namex = $(this).attr('id');
				
				value_clean = (   tinyMCE.get(namex).getContent() );
			}
			
			//value_clean = value_clean.replace('"', '&#34;').replace("'", '&#39;');
			if(  $(this).attr('type') == 'checkbox' ) {
				 
				if( $(this).attr('checked') == 'checked' ) data_to_save[ $(this).attr('name') ] = 1;
				else data_to_save[ $(this).attr('name') ] = 0;
			} else {
				data_to_save[ $(this).attr('name') ] = value_clean;
			}
		});
		//alert( actual_module_selected );
		actual_module_selected.data('data_to_save', data_to_save);
	//	alert($(this).data('data_to_save').title);
	}
	
	function load_form() {
	//	alert(actual_module_selected.data('data_to_save'));
		if( actual_module_selected.data('data_to_save') == undefined)
			return;
			
		var data_to_load = actual_module_selected.data('data_to_save');
		
		for( var key in data_to_load) {
		//	alert(data_to_load[key]);
		
			var one_control = $('#cboxLoadedContent').find('[name="'+key+'"]');
			one_control.attr('value', data_to_load[key]);
			if( one_control.attr('aria-hidden') == 'true' )
				tinyMCE.get( one_control.attr('id') ).setContent( data_to_load[key] );
				
			if( one_control.attr('type') == 'checkbox' ) {
				
				if( data_to_load[key] == 1 ){ 
					one_control.attr('checked',true);
					 
				}
				else one_control.attr('checked',false);
			}
			
			//alert( data_to_load[key] ) ;
		}
		
		
	}
	
	$('.modal_button_save').live('click',function() {
	
	save_form();
	$.colorbox.close();
	});
	
	$('.modal_button_close').live('click', function () {
	$.colorbox.close();
	});
	
	
	
	function serialize_page() {
		var sp = {};
		
		rows = $('#rows');
		
		// walking through each row
		rows.find('.row_inner').each(function(row_index) {
			var row = {};
			$(this).find('.col').each(function(col_index) {
				var col = {};
				col['width'] = $(this).find('.column_width_input').val();
				col['widgets'] = {};
				var widgets = $(this).find('.col_content').find('.module_wrapper');
				
				widgets.each(function(widget_index){
					var widget = {};
					
					widget['type'] = $(this).find('.module').attr('rel');
					widget['data'] = $(this).data('data_to_save');
					//alert(widget['type'] );
					col['widgets'][widget_index] = widget;
				});
				row[col_index] = col;
			});
			sp[row_index] = row;
		});
		
		return sp;
		
	}
	
	function send_page() {

		var ser_page = serialize_page(); 
		console.log( ser_page );				
		var data = {
			action: 'pagebuilder_save_page',
			template_name: $('#template_select').val(),
			data:ser_page
		};
	//	alert('aa');
		jQuery.post(ajaxurl, data, function(response) {
			$('.options_header').find('.loading_spin').css('display','none');
			$('#rows_wrapper').animate({opacity:1}, 200);
		});
		
		
	}
	
	$('.theme_options_save').click(function() {
		$('.options_header').find('.loading_spin').css('display','block');
		$('#rows_wrapper').animate({opacity:0.3}, 200);
		send_page();
	});
	
	function kokotkokotpica() {
	alert('a');	
	}
	
	$('.widget_data_holder').each( function() {
		var module_wrapper_holder = $(this).parent().parent();
		var data_to_save = {};
		
		$(this).find('div').each(function() {
			data_to_save[ $(this).attr('rel') ] = $(this).html();
		});
		module_wrapper_holder.data('data_to_save', data_to_save);
		$(this).remove();
		
	});
	
 
});

 