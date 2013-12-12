jQuery(document).ready(function($){
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
	
	
	(function ()  {
		pageTemplateSwitcherObject = this;
		
		this.switchMetaboxes = function( newTemplateName, fast ) {
			if( fast == undefined || fast == false ) {
				$('.page_template_specific_postbox').animate({opacity:0}, 300, function(){
					$(this).css('display','none');
					$('.page_template_'+newTemplateName).css('display','block').animate({opacity:1},300);
				});
			} else {
				$('.page_template_specific_postbox').css({'opacity':0,'display':'none'});
				$('.page_template_'+newTemplateName).css({'opacity':1,'display':'block'}).animate({opacity:1},300);
			}
		}
		
		
		$pageTemplateMetaboxesInnerDiv = $('.page_template_specific');
		$pageTemplateSwitcher = $('#page_template');
		
		if( $pageTemplateMetaboxesInnerDiv.length > 0 ) {
			$pageTemplateMetaboxesInnerDiv.each(function() {
				$(this).find('span').each(function() {
					
					var pageTemplateName = $(this).html();
					$postbox = $(this).parents('.postbox');
					$postbox.addClass('page_template_'+pageTemplateName);
					$postbox.addClass('page_template_specific_postbox');
				});
			});
		}
		
		if( $pageTemplateSwitcher.length > 0 ) {
			newVal = $pageTemplateSwitcher.val().replace('.php','');
			pageTemplateSwitcherObject.switchMetaboxes( newVal, true );
			
			$pageTemplateSwitcher.change(function() {
				newVal = $(this).val().replace('.php','');
				pageTemplateSwitcherObject.switchMetaboxes( newVal );
			});
		}
	})();
});


(function( $ ) {
//##############################################################################
//##############################################################################
//##############################################################################
// WP GALLERY ATTACHER
// ===================
// bounded button must have attr data-input-selector=#input / .input;
//##############################################################################
//##############################################################################
//##############################################################################
$.fn.ffAttachGallery = function( callback ) {
	_this_ = this;
	// selectors & attributes
	_this_.attrInputSelector = 'data-input-selector';
	
	_this_.deliveryId = function( $input, newVal ) {
		clickedObject = _this_.clickedObjectHolder;
		_this_.clickedObjectHolder =  null;
		
		$input.val( newVal );
		if( callback )
			callback( newVal, clickedObject );
	}
	
	_this_.clickedObjectHolder = null;
	
	
	$(_this_.selector).click(function() {
		_this_.clickedObjectHolder = $(this);
		
		
		var send_attachment_bkp = wp.media.editor.send.attachment;
	    var insert_bkp = wp.media.editor.insert;
		// we have to re-create these variables every click,
		// because we wanna allow multiple galleries in one page
		// .input / #input
		inputSelector = $(this).attr( _this_.attrInputSelector );
		$input = $(inputSelector);
		id = $input.val();
		
		if( id ){
	          frame = wp.media.gallery.edit('[gallery ids="' + id + '"]');	
	          frame.state('gallery-edit').on( 'update', function( selection ) {
	
	                //console.log( '--------------------------------');
	                //console.log( 'FUNCTION wp.media.gallery.edit(\'[gallery ids="' + $('#'+ffActiveEditor).val() + '"]');
	                //console.log( '--------------------------------');
	                //console.log( '- Parameter "selection.models"');
	
	                new_val = '';
	
	                //console.log( selection );
	                if( selection ){
	                    if( selection.models ){
	                        for (var i in selection.models){
	
	                            //console.log( selection.models[ i ].id );
	                            
	                            if( '' == new_val ){
	                                new_val = selection.models[ i ].id;
	                            }else{
	                                new_val = new_val + ',' + selection.models[ i ].id;
	                            }
	                            
	                        }
	                        
	                        _this_.deliveryId( $input, new_val );
	                        //alert( new_val );
	                    }
	                }
	                //console.log( '--------------------------------');
	                ////console.log('xxx');
	                //break;
	                //var shortcode = gallery.shortcode( selection ).string().slice( 1, -1 );
	
	                //ed.dom.setAttrib( el, 'title', shortcode );
	          });
	    }else{
	          // this stuff insert galery into post text
	          wp.media.editor.insert = function( a ) {
	                  wp.media.editor.insert = insert_bkp;
	
	                  //console.log( '--------------------------------');
	                  //console.log( 'FUNCTION wp.media.editor.insert');
	                  //console.log( '--------------------------------');
	                  //console.log( '- Parameter "a"');
	                  //console.log( a );
	                  //console.log( '--------------------------------');
	                  //console.log( '');
	                  if( a ){
	                      if( '[' == a.substr(0,1) ) {
	                          a = a.replace('[gallery ids="','');
	                          a = a.replace('"]','');
	                          _this_.deliveryId( $input, a );
	                      }
	                  }
	          }
	
	          // this stuff insert one image
	          ////console.log( wp.media.editor.send );
	          wp.media.editor.send.attachment = function(props, attachment) {
	                  wp.media.editor.send.attachment = send_attachment_bkp;
	
	                  //console.log( '--------------------------------');
	                  //console.log( 'FUNCTION wp.media.editor.send.attachment');
	                  //console.log( '--------------------------------');
	                  //console.log( '- Parameter "attachment"');
	                  //console.log( attachment.id );
	                  //console.log( '--------------------------------');
	                  //console.log( '');
	
	                  if( attachment ){
	                	  _this_.deliveryId( $input, attachment.id );
	                  }
	
	                  //$('.custom_media_image').attr('src', attachment.url);
	                  //$('.custom_media_url').val(attachment.url);
	                  //$('.custom_media_id').val(attachment.id);
	
	          }
	          wp.media.editor.open();
	    }
	
	    return false;		
		
	});
}	
})( jQuery );
jQuery(document).ready(function($){
	$('.custom_media_upload').ffAttachGallery(function( id, clickedObject ) {
		clickedObject.parent().find('.gallery-image-holder').animate({opacity:0},400 );
			
			var data = {
				action: 'ff_gallery_load',
				image_id: id,
			};
			jQuery.post(ajaxurl, data, function(response) {
				clickedObject.parent().find('.gallery-image-holder').html( response ).stop().animate({opacity:1},400);
			});
			
	});
	
	$('.thickbox').attachMediaUploader('media-upload-link', function( url, attr) {
		$('#' + attr ).val( url );
	 });
});

/*jQuery(document).ready(function($){

 
 

$.fn.attachGallery = function( callback ) {
	
	__this__ = this;
	
	__this__.deliveryId = function( id ) {
		//$(__this__.selector).data('selected-id', id);
		input.val(id);
		callback(id);
	}
	$(this.selector).click(function() {
	    var send_attachment_bkp = wp.media.editor.send.attachment;
	    var insert_bkp = wp.media.editor.insert;
	    id = input.val();
	
	    if( id ){
	
	          frame = wp.media.gallery.edit('[gallery ids="' + id + '"]');
	
	          //blue_button.css('background-color','#FFFFFF');
	          //alert( wp.media.editor.id() );
	
	          frame.state('gallery-edit').on( 'update', function( selection ) {
	
	                //console.log( '--------------------------------');
	                //console.log( 'FUNCTION wp.media.gallery.edit(\'[gallery ids="' + $('#'+ffActiveEditor).val() + '"]');
	                //console.log( '--------------------------------');
	                //console.log( '- Parameter "selection.models"');
	
	                new_val = '';
	
	                //console.log( selection );
	                if( selection ){
	                    if( selection.models ){
	                        for (var i in selection.models){
	
	                            //console.log( selection.models[ i ].id );
	                            
	                            if( '' == new_val ){
	                                new_val = selection.models[ i ].id;
	                            }else{
	                                new_val = new_val + ',' + selection.models[ i ].id;
	                            }
	                            
	                        }
	                        
	                        __this__.deliveryId( new_val );
	                        //alert( new_val );
	                    }
	                }
	                //console.log( '--------------------------------');
	                ////console.log('xxx');
	                //break;
	                //var shortcode = gallery.shortcode( selection ).string().slice( 1, -1 );
	
	                //ed.dom.setAttrib( el, 'title', shortcode );
	          });
	    }else{
	          // this stuff insert galery into post text
	          wp.media.editor.insert = function( a ) {
	                  wp.media.editor.insert = insert_bkp;
	
	                  //console.log( '--------------------------------');
	                  //console.log( 'FUNCTION wp.media.editor.insert');
	                  //console.log( '--------------------------------');
	                  //console.log( '- Parameter "a"');
	                  //console.log( a );
	                  //console.log( '--------------------------------');
	                  //console.log( '');
	                  if( a ){
	                      if( '[' == a.substr(0,1) ) {
	                          a = a.replace('[gallery ids="','');
	                          a = a.replace('"]','');
	                          __this__.deliveryId( a );
	                      }
	                  }
	          }
	
	          // this stuff insert one image
	          ////console.log( wp.media.editor.send );
	          wp.media.editor.send.attachment = function(props, attachment) {
	                  wp.media.editor.send.attachment = send_attachment_bkp;
	
	                  //console.log( '--------------------------------');
	                  //console.log( 'FUNCTION wp.media.editor.send.attachment');
	                  //console.log( '--------------------------------');
	                  //console.log( '- Parameter "attachment"');
	                  //console.log( attachment.id );
	                  //console.log( '--------------------------------');
	                  //console.log( '');
	
	                  if( attachment ){
	                	  __this__.deliveryId( attachment.id );
	                  }
	
	                  //$('.custom_media_image').attr('src', attachment.url);
	                  //$('.custom_media_url').val(attachment.url);
	                  //$('.custom_media_id').val(attachment.id);
	
	          }
	          wp.media.editor.open();
	    }
	
	    return false;
	    
		});
}


$('.custom_media_upload').attachGallery(function( id ) {
	  console.log(id);
});

});*/



