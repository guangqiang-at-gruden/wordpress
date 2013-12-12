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

jQuery(document).ready(function($){
	$('.big_image_holder').find('.primary_image_holder').disableSelection();
	$('.big_image_holder').find('.secondary').disableSelection();
	$('.slider_tabbed').find('.grey_stripe').disableSelection();
	$('.slider_tabbed').find('.slider_tabbed_down_shadow').disableSelection();
	//slider_tabbed_down_shadow
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
	
	
	 $('.one_slide_tab').hover(function() {
	 	$(this).addClass('one_slide_tab_active');
	 }, function() {
	 	if( !$(this).hasClass('tab_selected') )
	 		$(this).removeClass('one_slide_tab_active');
	 });
	 
	 function one_slide_tab_click( one_slide_tab ) {
	 	__this__ = one_slide_tab;
	 	var slider = __this__.parent().parent().parent().parent();
	 	if( slider.find(':animated').size() != 0)
	 		return;
	 	
	 	var direction = get_direction( __this__ );
	 	if( direction == 'none' )
	 		return false;
		select_tab( __this__ );
		
		
	 
	 	//oss = one slide settings
	 	var oss = get_one_slide_settings( __this__.find('.one_slide_settings') );
	 	slider.find('.secondary_image_holder').find('img').attr('src', oss.imageUrl);
	 	var speed = 500;
	 	
	 	var text_holder = slider.find('.one_slide_text_holder');
	 	
	 		text_holder.animate({opacity:0}, speed / 2, function() {
	 			if( oss.description != '' && oss.description != ' ' ) {
		 			var left_pos = __this__.index() * __this__.outerWidth();
		 			//text_holder.css('left', left_pos);
		 			text_holder.css('display', 'block');
		 			text_holder.animate({opacity:1}, speed / 2);
		 			text_holder.find('.one_slide_text_content').html( oss.description );
	 			} 
	 		});
	 	
	 	
	 	if( direction == 'left') {
	 		slider.find('.primary_image_holder').animate({left:slider.width()}, speed);
	 		slider.find('.secondary_image_holder').css({left:-slider.width()});
	 		slider.find('.secondary_image_holder').animate({left:0}, speed, function() {
	 			switch_images( slider );
	 		});
	 	} else {

	 		slider.find('.primary_image_holder').animate({left:-slider.width()}, speed);
	 		slider.find('.secondary_image_holder').css({left:slider.width()});
	 		slider.find('.secondary_image_holder').animate({left:0}, speed, function() {
	 			switch_images( slider );
	 		});	 		
	 		
	 	}	 	
	 }
	 
	 
	 	$('.slider_tabbed').each(function() {
		var __this__ = $(this);
		var auto_slide_interval = $(this).find('.auto_slide_settings').find('.auto_slide_interval').html();
		
		auto_slide_interval = parseInt( auto_slide_interval );
		//console.log(auto_slide_interval);
		if( auto_slide_interval == 0 || auto_slide_interval == null ) return;
		if( $(this).data('actual_pos') == undefined )
		$(this).data('actual_pos', 0);		
		
		//console.log('xxx');
		var current_sliding_interval = setInterval( function() { 
			
		//	var sc = __this__.data('sc');
		//	sc.move_right();
			var current_active_slide = __this__.find('.current_active_slide').html();
			current_active_slide = parseInt(current_active_slide);
			
			current_active_slide++;
			
			if( __this__.find('.one_slide_tab').size() == current_active_slide )
				current_active_slide = 0;
			//alert(current_active_slide);
			__this__.find('.current_active_slide').html(current_active_slide);
			
			//console.log(__this__.find('.one_slide').eq(current_active_slide));
			
			one_slide_tab_click( __this__.find('.one_slide_tab').eq(current_active_slide) );
			
			
		}, auto_slide_interval );
		$(this).data('current_sliding_interval', current_sliding_interval );
	});	
	$('.some_shit').prettyPhoto();
	 $('.slider_tabbed').find('.image_area').click(function() {
	 	var oss = get_one_slide_settings( $(this).parents('.slider_tabbed').find('.one_slide_tab_active').find('.one_slide_settings') );
	 	if( oss.lightbox == 'lightbox' ) {
			$.prettyPhoto.open(oss.imageLink,oss.title,'');
			} else  if ( oss.lightbox == 'url' ) {
 				window.location= oss.imageLink ;
			}
	 });
	 
	 $('.one_slide_tab_wrapper').click(function() {
		one_slide_tab_click( $(this).find('.one_slide_tab') );
		clearInterval ($(this).parents('.slider_tabbed').data('current_sliding_interval' ) );
	 });
	 
	 function get_direction( tab_clicked ) {
	 	var new_index = tab_clicked.parent().index();
	 	var old_index = tab_clicked.parent().parent().find('.one_slide_tab').filter('.tab_selected').parent().index();
	 	//alert(old_index);
	 	
	 	if( new_index > old_index)
	 		return 'right';
	 	else if ( new_index == old_index )
	 		return 'none';
	 	else
	 		return 'left';
	 }
	 
	 function select_tab( tab ) {
	 	tab.parent().parent().parent().find('.one_slide_tab').removeClass('tab_selected');
	 	tab.parent().parent().parent().find('.one_slide_tab').removeClass('one_slide_tab_active');
	 	
	 	tab.addClass('tab_selected');
	 	tab.addClass('one_slide_tab_active');	 	
	 }
	 
	 
	 function switch_images( slider ) {
	 	var prim_img = slider.find('.primary_image_holder').find('img');
	 	var sec_img = slider.find('.secondary_image_holder').find('img');
	 	
	 	prim_img.attr('src', sec_img.attr('src') );
	 	prim_img.parent().css({top:0, left:0});
	 }
});
