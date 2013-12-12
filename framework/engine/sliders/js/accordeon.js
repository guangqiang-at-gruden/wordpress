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

jQuery(document).ready( function($){
	// EDIT HERE
	var opacity_to_darking = 0.6;
	
	$('.slide_image').disableSelection();
	
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
		oss.imageUrl = div.find('.one_slide_settings').find('.imageUrl').html();
		oss.imageLink = div.find('.one_slide_settings').find('.imageLink').html();
		oss.lightbox = div.find('.one_slide_settings').find('.lightbox').html();
		oss.transition = div.find('.one_slide_settings').find('.transition').html();
		oss.title = div.find('.one_slide_settings').find('.title').html();
		oss.description = div.find('.one_slide_settings').find('.description').html();
		
		return oss;
	//	consol__this__log( oss );
	}
	
	
$("some_init_shit").prettyPhoto(); 
	$('.slider_accordeon').find('.one_slide').click(function() {
		var ost = $(this).find('.one_slide_settings');
		var lightbox = ost.find('.lightbox').html();
		var image_link = ost.find('.imageLink').html();
		var title = ost.find('.title').html();
		var description = ost.find('.description').html();
		
		if( lightbox == 'lightbox' ) {
			$.prettyPhoto.open(image_link,title,'');
		} else  if ( lightbox == 'url' ) {
 
			window.location= image_link ;
		}
	});
 
 
 	function slider_accordeon_hover( __this__ ) {
 		var slides_count = __this__.parent().find('.one_slide').size();	
		var slide_average_width = __this__.parent().find('.slide_average_width').html();
		var slide_min_width = __this__.parent().find('.slide_min_width').html();
		var slide_max_width = __this__.parent().find('.slide_max_width').html();
		var slider_width = __this__.parent().find('.slider_width').html();
		
		__this__.data('selected', true);
		var has_been_true = false;
		
		
		__this__.find('.small_title').stop().animate({opacity:0}, 400);
		if( __this__.find('.big_title').html() != '') {
		if( __this__.find('.big_title').css('display') == 'none' )
			__this__.find('.big_title').css('opacity', 0).css('display', 'block').stop().animate({opacity:1}, 400);
		else
			__this__.find('.big_title').stop().animate({opacity:1}, 400);
		}
		
		__this__.parent().find('.one_slide').each( function(index){
			if( has_been_true == false ) {
				
				$(this).find('img').stop().animate({opacity:opacity_to_darking}, 400);
				$(this).stop().animate( {left: (index * slide_min_width), width: parseInt(slide_min_width)}, 400 );
			//	$(this).find('.shadow_stripe').stop().animate({left: 0 },380);
			
			} else {
				var new_left_pos = slides_count - index;
				new_left_pos = new_left_pos * slide_min_width;
				new_left_pos = slider_width - new_left_pos;
				
				$(this).stop().animate( {left: new_left_pos, width: parseInt(slide_min_width)  }, 400 );
				$(this).find('img').stop().animate({opacity:opacity_to_darking},400);
			//	$(this).find('.shadow_stripe').stop().animate({left: 0 },400);
			}
			
			if( $(this).data('selected') == true ) {
			
			$(this).stop().animate( {left: (index * slide_min_width), width:parseInt(slide_max_width) }, 400 );
				has_been_true = true;
				$(this).data('selected', false);
				$(this).find('img').stop().animate({opacity:1},400);
			} else {
				$(this).find('.small_title').stop().animate({opacity:1}, 400);
				$(this).find('.big_title').stop().animate({opacity:0}, 400);
			}
		});
 	}
	
	$('.slider_accordeon').find('.one_slide').hover(function(e) {
		slider_accordeon_hover( $(this) );
		var __slider__ = $(this).parents('.slider_accordeon');
		clearInterval( __slider__.data('current_sliding_interval') ); 
		var cas = $(this).index();
		$(this).parents('.slider_accordeon').find('.current_active_slide').html(cas);
	}, function() {
		
		//$(this).parent().find('.one_slide').find('img').stop().animate({opacity:1}, 400);
	});
	
	$('.slider_accordeon').hover( function(){}, function() {
		
	//	slider_accoredon_leave( $(this) );
		var auto_slide_interval = $(this).find('.auto_slide_settings').find('.auto_slide_interval').html();
		auto_slide_interval = parseInt( auto_slide_interval );
		if( auto_slide_interval == 0 ) return;
		var auto_slide_interval = $(this).find('.auto_slide_settings').find('.auto_slide_interval').html();
		var __this__ = $(this);
	//	setTimeout(function(){
	//		autoslide_accordeon( __this__ );
	//	}, 500);
		var current_sliding_interval = setInterval( function() { 
			autoslide_accordeon( __this__ );
			
			
		}, auto_slide_interval );
		$(this).data('current_sliding_interval', current_sliding_interval );
	} );
	
	function slider_accoredon_leave( __this__ ) {
		__this__.find('.one_slide').each( function(index){
			$(this).data('selected', false);
			var slide_average_width = $(this).parent().parent().find('.slide_average_width').html();
			$(this).stop().animate( {left: (index * slide_average_width) , width: parseInt(slide_average_width) + 5}, 400 );
			$(this).find('.small_title').stop().animate({opacity:1}, 400);
			$(this).find('.big_title').stop().animate({opacity:0}, 400);
		//	$(this).find('.shadow_stripe').stop().animate({left: slide_average_width - 50 },380);
		});
	}
	
	
	$('.slider_accordeon').each(function() {
		var __this__ = $(this);
		var auto_slide_interval = $(this).find('.auto_slide_settings').find('.auto_slide_interval').html();
		auto_slide_interval = parseInt( auto_slide_interval );
		if( auto_slide_interval == 0 ) return;
		var first_time = true;
		autoslide_accordeon(__this__);
		var current_sliding_interval = setInterval( function() { 
			autoslide_accordeon( __this__ );
			
			
		}, auto_slide_interval );
		$(this).data('current_sliding_interval', current_sliding_interval );
	});
	
	function autoslide_accordeon( __this__ ) {
		
		
		var first_time = __this__.data('first_time');
		
		
		if( first_time == undefined)  {
			first_time = true;
			__this__.data('first_time','true');
		} else {
			first_time = false;
		}// */
		var current_active_slide = __this__.find('.current_active_slide').html();
		current_active_slide = parseInt(current_active_slide);
		
		
		
		current_active_slide++;
		
		if( first_time ) {
			current_active_slide = 0;
			first_time = false;
		}
		
		if( __this__.find('.one_slide').size() == current_active_slide )
			current_active_slide = 0;
		//alert(current_active_slide);
		__this__.find('.current_active_slide').html(current_active_slide);
		
		//console.log(__this__.find('.one_slide').eq(current_active_slide));
		
		slider_accordeon_hover( __this__.find('.one_slide').eq(current_active_slide) );
	}
	
	
	
	
	
	
	
	
	
	
	
});
