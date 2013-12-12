
jQuery(document).ready(function($) {
	 
		var current_ed = null;
	
		function framework_shortcodes() {
		    return "[tiny-plugin]";
		}
		
		(function() {
		
		    tinymce.create('tinymce.plugins.framework_shortcodes', {
		
		        init : function(ed, url){
		            ed.addButton('framework_shortcodes', {
		                title : 'Insert TinyPlugin',
		                onclick : function() {
 
		                    someShit( ed );
		                },
		                image: url + "/shortcode_icon.png"
		            });
		        },
		
		      
		    });
		
		    tinymce.PluginManager.add('framework_shortcodes', tinymce.plugins.framework_shortcodes);
		    
		})();


		function someShit( ed ) {
			var left = $('.mce_framework_shortcodes').offset().left;
			var top = $('.mce_framework_shortcodes').offset().top;
			
			$('#shortcodes_list_wrapper').css({'top':top, 'left':left, 'display':'block', 'visibility':'visible'}).animate({opacity:1},200);
			
			current_ed = ed;
	
		}
	
	
		var data = {
			action: 'framework_editor',
		};
		
 
		jQuery.post(ajaxurl, data, function(response) {
			$('#wpwrap').append(response);
			});	
			
		$('#shortcodes_list_wrapper').live('mouseleave', function() {
			if( $('#shortcodes_list_wrapper').css('opacity') == 1 )
				$('#shortcodes_list_wrapper').css({'display':'none', 'opacity':0});
 
		});
	
	
		$('#shortcodes_list_wrapper').find('.shortcode_button').live('click', function() {
			var name = $(this).find('span').html();
			var rel = $(this).parent().attr('rel');
			
			if( rel == 'pb_template') {
				current_ed.selection.setContent('[templatebuilder name="' + name + '"]');
			} else {
				var sc_parent = $(this).parent();
				var data_info = sc_parent.find('.data_info');
				
				var type = data_info.find('.type').html();
				var shortcode = data_info.find('.shortcode').html();
				var attributes = '';
				
				if( data_info.find('.attributes').find('div').size() > 0 ) {
					data_info.find('.attributes').children('div').each(function() {
						
						attributes += ' '+$(this).attr('data-name')+'="'+$(this).attr('data-value') + '"';
					});
				}
				
				
				var shortcode_text = '[' + shortcode + attributes + ']';
				if( 'wrapping_content' == type ) {
					shortcode_text += current_ed.selection.getContent() + '[/' + shortcode + ']';
				}
				
				current_ed.selection.setContent( shortcode_text );
			}
			
/***
 * COLUMNS
 * 
 * 
One Half Last
One Third
One Third Last
Two Third
Two Third Last
One Fourth
One Fourth Last
Three Fourth
Three Fourth Last
 */			
			/*
			else if ( name == 'One Half') {
				current_ed.selection.setContent('[one_half]' + current_ed.selection.getContent() + '[/one_half]');	
			}
			
			else if ( name == 'One Half Last') {
				current_ed.selection.setContent('[one_half_last]' + current_ed.selection.getContent() + '[/one_half_last]');	
			}
			
			else if ( name == 'One Third') {
				current_ed.selection.setContent('[one_third]' + current_ed.selection.getContent() + '[/one_third]');	
			}			
			
			else if ( name == 'One Third Last') {
				current_ed.selection.setContent('[one_third_last]' + current_ed.selection.getContent() + '[/one_third_last]');	
			}
			
			else if ( name == 'Two Third') {
				current_ed.selection.setContent('[two_third]' + current_ed.selection.getContent() + '[/two_third]');	
			}			
			
			else if ( name == 'Two Third Last') {
				current_ed.selection.setContent('[two_third_last]' + current_ed.selection.getContent() + '[/two_third_last]');	
			}						
			
			else if ( name == 'One Fourth') {
				current_ed.selection.setContent('[one_fourth]' + current_ed.selection.getContent() + '[/one_fourth]');	
			}			
			
			else if ( name == 'One Fourth Last') {
				current_ed.selection.setContent('[one_fourth_last]' + current_ed.selection.getContent() + '[/one_fourth_last]');	
			}			
			
			
			else if ( name == 'Three Fourth') {
				current_ed.selection.setContent('[three_fourth]' + current_ed.selection.getContent() + '[/three_fourth]');	
			}			
			
			else if ( name == 'Three Fourth Last') {
				current_ed.selection.setContent('[three_fourth_last]' + current_ed.selection.getContent() + '[/three_fourth_last]');	
			}						
			
			
/**** 
 * SHORTCODES - ELEMENTS
 * Dropcap				
					Button				
					Download Box				
					Error Box				
					Info Box				
					Note Box				
					Pullquotes Left				
					Pullquotes Right
					Highlighted Text 1
					Highlighted Text 2
					Image Float Left
					Image Float Right
					Divider - Top Button				
					Toggle
 */			
			
			
/*
			else if ( name == 'Dropcap') {
				current_ed.selection.setContent('[dropcap]' + current_ed.selection.getContent() + '[/dropcap]');	
			}
			
			else if ( name == 'Button') {
				current_ed.selection.setContent('[button type="Big" color="Yellow" linking_to="http://yoursite.com" ]' + current_ed.selection.getContent() + '[/button]');

			}
			
			else if ( name == 'Download Box') {
				current_ed.selection.setContent('[box_download title="Your Title"]' + current_ed.selection.getContent() + '[/box_download]');

			}			
			
			else if ( name == 'Error Box') {
				current_ed.selection.setContent('[box_error title="Your Title"]' + current_ed.selection.getContent() + '[/box_error]');
			}
			
			else if ( name == 'Info Box') {
				current_ed.selection.setContent('[box_info title="Your Title"]' + current_ed.selection.getContent() + '[/box_info]');
			}						
			
			else if ( name == 'Note Box') {
				current_ed.selection.setContent('[box_note title="Your Title"]' + current_ed.selection.getContent() + '[/box_note]');
			}						
			
			else if ( name == 'Pullquote Left') {
				current_ed.selection.setContent('[pullquote_left]' + current_ed.selection.getContent() + '[/pullquote_left]');	
			}
			
			else if ( name == 'Pullquote Right') {
				current_ed.selection.setContent('[pullquote_right]' + current_ed.selection.getContent() + '[/pullquote_right]');	
			}						
			
			else if ( name == 'Highlighted Text 1') {
				current_ed.selection.setContent('[highlight1]' + current_ed.selection.getContent() + '[/highlight1]');	
			}		 
	 
			else if ( name == 'Highlighted Text 2') {
				current_ed.selection.setContent('[highlight2]' + current_ed.selection.getContent() + '[/highlight2]');	
			}		 
			
			else if ( name == 'Image Float Left') {
				current_ed.selection.setContent('[frame_left]' + current_ed.selection.getContent() + '[/frame_left]');	
			}
			
			else if ( name == 'Image Float Right') {
				current_ed.selection.setContent('[frame_right]' + current_ed.selection.getContent() + '[/frame_right]');				
			}
			
			else if ( name == 'Divider - Top Button') {
				current_ed.selection.setContent('[divider_top]');	
			}				
			
			else if ( name == 'Toggle') {
				current_ed.selection.setContent('[toggle title="Your Title"]' + current_ed.selection.getContent() + '[/toggle]');

			}			
			*/
	 
			$('#shortcodes_list_wrapper').css('display','none').animate({opacity:0},200);
			return false;
		});
});