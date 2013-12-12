(function( $ ) {
/******************************************************************************************************************************************************
 * WP MEDIA INVOKER
 * ====================
 * This script allows you to invoke the wordpress media upload manager and select wanted image. It can be used for selecting images to sliders, theme options
 * and other custom wordpress scripts.
 *
 * @author Freshface
 ******************************************************************************************************************************************************/
var tb_remove_hijacker = null;	
	
function wp_media_invoker( callback, type )  {
//####################################################################################################################################################
// TRANSLATIONS - you can edit this stuff;
//####################################################################################################################################################
	this.tr_use_image = 'Use this Image'; 	// the caption of the button
	this.tr_use_link = 'Use';				// this link appears at the top of the each image in media library

//####################################################################################################################################################
//	CSS selectors - you should not edit this :)
//####################################################################################################################################################
	this.tb_iframe = '#TB_iframeContent';			// ID of the thickbox iframe
	this.tb_link_class = '.thickbox';				// hyperlink class which invokes the thickbox
	this.tb_media_items_class = '#media-items';		// ID of the media items holder in the wordpress media item uploader
	this.tb_send_button = '.savesend'				// selector which contains the Use this button
	this.tb_tab_type_url = '#tab-type_url';			// Tab URL at the top menu
	this.tb_sidemenu = '#sidemenu';					// Top menu
	this.tb_savesend = '.savesend';					// Holder of the use this image button
//####################################################################################################################################################
//	Internal variables - do not edit this n00bs :D
//####################################################################################################################################################
	this.type = type;								// type - multiple selection x single selection
	this.callback = callback;						// callback function, when image has been selected
	this.link_clicked = null;						// internal store, which identify the link from the dialogue has been called
	this.attr_name = 'media-upload-link';			// name of the attribute which identify the media upload links :)
	
	this.selected_images = new Array();

	__media_invoker__ = this;								// just a copy of the object itself, because "this" is sometimes reserved to something special

	this.iframe_interval = null;					// DIRTY -> using the time interval detection to bound with the iframe
	this.upload_content_interval = null;			// DIRTY -> using the time interval detection to bound with the upload script
	
	this.tb_uploaded_items_count = 0;				// number of items which has been totally uploaded through the upload manager
	
	
	this.set_attr_name = function( attr_name ) {
		//__media_invoker__.attr_name = attr_name;	
	}
	this.set_attr_selector = function( attr_selector) {
		__media_invoker__.tb_link_class = attr_selector;
	}
	
	/**
	 * When user click the media upload link, this script automatically detects the creation of the iframe and then create .load javascript event
	 */
	$(__media_invoker__.tb_link_class).live('click', function() {
		
		__media_invoker__.link_clicked = $(this).attr(__media_invoker__.attr_name);
		__media_invoker__.iframe_interval = setInterval( function() {
			if( $(__media_invoker__.tb_iframe).length > 0 ) {
				__media_invoker__.bind_methods();
				clearInterval( __media_invoker__.iframe_interval );
			}
		}, 30 );
	});
	
	/*
	 * This function bind the load method to the new loaded iframe. It's called every time after clicking the upload link :)
	 */
	this.bind_methods = function () {
		// bind the load function :)
		$(__media_invoker__.tb_iframe).load(function() {
			// disallow the URL user input
			$(__media_invoker__.tb_iframe).contents().find( __media_invoker__.tb_tab_type_url).css('display','none');
			if( $(__media_invoker__.tb_iframe).contents().find(__media_invoker__.tb_sidemenu).find('a').size > 0 ) {
			// monitoring the switching between gallery and media upload
				$(__media_invoker__.tb_iframe).contents().find(__media_invoker__.tb_sidemenu).find('a').live('click', function() {
					__media_invoker__.null_values();		// null all important values
				});
			}
			__media_invoker__.null_values();			// null them anyway :)
			
			// recognize which tab has been selected now 
			var sel_tab = __media_invoker__.get_selected_tab();
			if( sel_tab == 'upload') {
				__media_invoker__.bind_upload();
			}
			else if( sel_tab == 'library' ) {
				__media_invoker__.bind_functions_to_media_items();
			}
			
		});
	}
	
	/*
	 * This function cleans the interval for checking if some new images has been uploaded
	 */
	this.null_values = function() {
		clearInterval(__media_invoker__.upload_content_interval);
		__media_invoker__.tb_uploaded_items_count = 0;
	}
	
	/*
	 * This function is checking every 200 milliseconds, if there is new image upload, and then it bind's all the important functions to it
	 */
	this.bind_upload = function() {
		__media_invoker__.upload_content_interval = setInterval( function() {
			// run this function only when upload is selected
			if( __media_invoker__.get_selected_tab() == 'upload') {
				// number of currently uploaded items
				var media_items_count =  $(__media_invoker__.tb_iframe).contents().find(__media_invoker__.tb_media_items_class).find('.media-item').length;
				// if there is new item created, then re-bind all the functons
				if( media_items_count > 0 &&  media_items_count > __media_invoker__.tb_uploaded_items_count) {
					__media_invoker__.tb_uploaded_items_count++;
					__media_invoker__.bind_functions_to_upload();
				}
			} else {
				__media_invoker__.null_values();
			} 
		}, 200 ); 
	}
	
	/*
	 * User can upload big files, so we have to detect when the upload ends. With the interval ofcourse :)
	 */
	this.bind_functions_to_upload = function() {
		var save_button_interval = setInterval(function() {
			// after the upload ends, the form is generated automatically with the wordpress. So we check it :)
			if( $(__media_invoker__.tb_iframe).contents().find( __media_invoker__.tb_savesend ).length == __media_invoker__.tb_uploaded_items_count ) {
				__media_invoker__.bind_functions_to_media_items();
				clearInterval(save_button_interval);
			}
		},200);
		
	}
	/**
	 * This function renames the button values and add a quick button called std. "Use"
	 */
	this.bind_functions_to_media_items = function() {
		$(__media_invoker__.tb_iframe).contents().find('.savebutton').css('display','none');
		// re-name the buttons
		var send_buttons = $(__media_invoker__.tb_iframe).contents().find( __media_invoker__.tb_savesend ).find('input');
		send_buttons.attr('value', __media_invoker__.tr_use_image);
		
		// create new and only one click event to the use buttons
		send_buttons.unbind('click').click(function() {
			// send the image name
			__media_invoker__.send_button_click( $(this) );
		});
		// add quick use button
		var quick_use_css = {'float':'right', 'line-height': '36px', 'margin-right':'15px'};//{ 'display':'block', 'line-height': 36, 'float':'right', 'margin-left':15};
		
		
		$(__media_invoker__.tb_iframe).contents().find('.describe-toggle-on').after('<a class="toggle button-use-image" href="#">' + __media_invoker__.tr_use_link+ '</a>');
		$(__media_invoker__.tb_iframe).contents().find('.button-use-image').css(quick_use_css);
		$(__media_invoker__.tb_iframe).contents().find('.button-use-image').unbind('click').click( function() {
			// send the image name
			__media_invoker__.send_button_click( $(this) );
		});
	}
	
	/* 
	 * Call the callback function and end the thickbox
	 */
	this.send_button_click = function( send_button ) {
		var url = send_button.parents('.media-item').find('.url').find('input').val();
		if( __media_invoker__.type == 'multiple' ) {
			send_button.unbind('click').click(function() {
				__media_invoker__.send_button_click( $(this) );
			})			
			
			send_button.css('color','red').html('Used');
			
			
			var id = send_button.parents('.media-item').attr('id');
			id = id.replace('media-item-', '');
			
			var galleryItem = new Array( url, id);
			__media_invoker__.selected_images.push( galleryItem );
			
			
			//var neco = array('url':url, 'id':1);
			//this.selected_images[] = neco;
			
			//tb_remove = this.remove_frame();
			return false;
		} else {
			// find the url of the image
			
			// call the callback function
			__media_invoker__.callback(url, __media_invoker__.link_clicked);
			// remove thickbox and null all important values
			__media_invoker__.remove_thickbox();
			return false;
		}
	}
	
	if( this.type == 'multiple' && tb_remove_hijacker == null ) {
		tb_remove_hijacker = tb_remove;
		this.remove_frame = function () {
			if( __media_invoker__.selected_images.length > 0 ) {
				__media_invoker__.callback(__media_invoker__.selected_images);
				__media_invoker__.selected_images = Array();
			}			
			tb_remove_hijacker();
		}
		tb_remove = this.remove_frame;
	}
	
	
	
	/**
	 * Manually remove thickbox, because wordpress does not allow you to call tb_close();
	 */
	this.remove_thickbox = function() {
		$('#TB_window, #TB_overlay').remove();
		__media_invoker__.link_clicked = null;
	}
	
	/**
	 * get the name of the selected tab
	 */
	this.get_selected_tab = function() {
		var sel_id = $(__media_invoker__.tb_iframe).contents().find( __media_invoker__.tb_sidemenu).find('.current').parent().attr('id');
		if( sel_id == 'tab-type')
			return 'upload';
		else if( sel_id == 'tab-type_url')
			return 'url';
		else if( sel_id == 'tab-library')
			return 'library';
	}
	
};	
  $.fn.attachMediaUploader = function( attr_name, callback, type) {
	 
  	var selector = this.selector;
    this.mum = new wp_media_invoker( function( url, att_value) {
    	callback( url, att_value);
    }, type);
    this.mum.set_attr_name( attr_name );
    this.mum.set_attr_selector(selector);
  };
})( jQuery );

