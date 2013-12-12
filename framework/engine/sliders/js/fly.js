(function($){

$.fn.disableSelection = function() {
    return this.each(function() {           
        $(this).attr('unselectable', 'on')
               .css({
                   '-moz-user-select':'none',
                   '-webkit-user-select':'none',
                   'user-select':'none',
                   '-ms-user-select':'none'
               })
               .each(function() {
                   this.onselectstart = function() { return false; };
               });
    });
};

})(jQuery);

jQuery(document).ready(function($) {
	$('.slider_fly_slide_image').disableSelection();
$("some_init_shit").prettyPhoto(); 	
		function oneSlideSettings() {
		this.imageUrl = null;
		this.imageLink = null;
		this.lightbox = null;
		this.transition = null;
		this.title = null;
		this.description = null;
	}

	function get_one_slide_settings( div ) {
		var oss = new oneSlideSettings();
		oss.imageUrl = div.find('.imageUrl').attr('src');
		oss.imageLink = div.find('.imageLink').html();
		oss.lightbox = div.find('.lightbox').html();
		oss.transition = div.find('.transition').html();
		oss.title = div.find('.title').html();
		oss.description = div.find('.description').html();
	
		return oss;
	//	console.log( oss );
	}
	
	function sliderFly( __slider_fly__ ) {
/******************************************************************************************************
 * 
 * VARIABLES
 * 
 ******************************************************************************************************/		
		var __this__ = this;
		this.slider_fly = __slider_fly__;
		
		this.actual_slide_id = 0;
		this.actual_slide = this.slider_fly.find('.slider_fly_slide').eq( 0 );
		this.auto_slide_interval = parseInt(this.slider_fly.find('.slider_fly_settings').find('.autoslide_interval').html());
		this.auto_slide_interval_object = null;
/******************************************************************************************************
 * 
 * SLIDE FUNCTIONS
 * 
 ******************************************************************************************************/	
 		
 		this.set_slide = function ( slide_id ) {
 			var new_slide_id = 0;
 			if(  this.slider_fly.find('.slider_fly_slide').eq( slide_id ).length > 0 ) new_slide_id = slide_id;
 			else slide_id = 0;
 			
 			this.actual_slide_id = slide_id;
 			this.actual_slide = this.slider_fly.find('.slider_fly_slide').eq( slide_id );
 		}
 	
 		
 		this.prepare_slide = function () {
 			this.actual_slide.find('.fly').each(function() {
 				var __this_temporary__ = $(this);
 				var pos = new function() {
 					this.left = parseInt( $(__this_temporary__).css('left'));
 					this.top = parseInt( $(__this_temporary__).css('top')); 
 				}
 				//console.log(pos);
 				$(this).data('pos', pos);
 			});
 			//console.log(this.actual_slide.find('.fly'));
 			//return;
			this.actual_slide.find('.fly_left').css({'left':-1999, });
			this.actual_slide.find('.fly_right').css({'left':1999, });
			this.actual_slide.find('.fly_top').css({'top':-1999, });
			this.actual_slide.find('.fly_bottom').css({'top':1999, });			
			this.actual_slide.css('display', 'block');
 		}
 		
 		this.move_slide_away = function() {
 			
 			this.actual_slide.animate({opacity:0}, 500, function() {
 				$(this).css({'display':'none', 'opacity':1});
 			});
 		}
 		
 		this.animate_slide = function() {
 			if( this.actual_slide.find('.slider_fly_slide_image').hasClass('none'))
 				this.actual_slide.find('.slider_fly_slide_image').css('opacity','0').animate({opacity:1},500);
 			else
 				this.actual_slide.find('.slider_fly_slide_image').animate({top:0,left:0},500);
 			
 			this.actual_slide.find('.fly').each(function() {
 				var pos = $(this).data('pos');
 				$(this).animate({top:pos.top, left:pos.left}, 500);
 			});
 		}
 		 
 			this.prepare_slide();
 			this.animate_slide();
 			
 		if(this.auto_slide_interval != 0) {
 			this.auto_slide_interval_object = setInterval(function(){
 				__this__.move_slide_away();
 				__this__.set_slide( __this__.actual_slide_id + 1);
 				setTimeout(function() {
					__this__.prepare_slide();
					__this__.animate_slide();
				}, 500);
 				__this__.slider_fly.find('.slider_fly_nav_item').removeClass('slider_fly_nav_item_active');
 				__this__.slider_fly.find('.slider_fly_nav_item').eq(__this__.actual_slide_id).addClass('slider_fly_nav_item_active');
 			}, this.auto_slide_interval);
 		}
 		
 		
 		//this.move_slide_away();

		
/******************************************************************************************************
 * 
 * CONTROLS
 * 
 ******************************************************************************************************/		
		this.slider_fly.find('.slider_fly_inner').click(function() {
			var oss = get_one_slide_settings( $(this).find('.slider_fly_slide').eq(__this__.actual_slide_id) );
			if( oss.lightbox == 'lightbox' ) {
			$.prettyPhoto.open(oss.imageLink,oss.title,'');
			} else  if ( oss.lightbox == 'url' ) {
 				window.location= oss.imageLink ;
			}
		});
		this.slider_fly.find('.slider_fly_nav_item').click(function() {
			clearInterval(__this__.auto_slide_interval_object);
			if( $(this).hasClass('slider_fly_nav_item_active') ) return false;
			if( __this__.slider_fly.find(':animated').length > 0 ) return false;
			
			$(this).siblings().removeClass('slider_fly_nav_item_active');
			$(this).addClass('slider_fly_nav_item_active');
			var slide_index = $(this).index();
			__this__.move_slide_away();
			__this__.set_slide(slide_index);
			setTimeout(function() {
				__this__.prepare_slide();
			__this__.animate_slide();
			}, 500);
			
			//alert( $(this).index());
		});
		


	}
	
	$('.slider_fly').each(function() {
		var sf = new sliderFly( $(this) );
		$(this).data('slider', sf);
	});
	
	
	
	
	/*$('.fly_left').css({'left':-9999, });
	$('.fly_right').css({'left':9999, });
	$('.fly_top').css({'top':-9999, });
	$('.fly_bottom').css({'top':9999, });

	$('.fly').animate({top:0, left:0}, 1000);
	$('.slider_fly_slide_image').animate({top:0, left:0}, 1000);*/	
});
