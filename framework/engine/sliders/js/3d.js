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
	$('.slider_3d').find('div').disableSelection();
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
	
			function oneSlideSettings() {
		this.imageUrl = null;
		this.imageLink = null;
		this.lightbox = null;
		this.transition = null;
		this.title = null;
		this.description = null;
	}
	
	
	
	var slider_3d_speed = 500;
	$('.slider_3d').children('div').click(function() {
		
		clearInterval( $(this).parents('.slider_3d').data('current_sliding_interval') );
		
		if( $(this).parent().data('actual_pos') == undefined )
			$(this).parent().data('actual_pos', 0);
		var clicked_class =  $(this).attr('rel');
		
		if( $(this).parent().data('animating') == true ) return false;
		
		if( clicked_class == 'l1' )
			slider_3d_move_right( $(this).parent() );
		else if( clicked_class == 'l2' )  {
			slider_3d_move_right_twice(  $(this).parent() );	
			//alert('xx');
		}
		else if ( clicked_class == 'r1' ) {
			
			slider_3d_move_left( $(this).parent() );
		}
		
		else if ( clicked_class == 'r2' ) {
			slider_3d_move_left_twice( $(this).parent() );
		}	
		else if ( clicked_class == 'c' ) {
			var oss = get_one_slide_settings( $(this) );
			if( oss.lightbox == 'lightbox' ) {
				$.prettyPhoto.open( oss.imageLink, oss.title, oss.description );
			} else if ( oss.lightbox == 'url' ){
				document.location = oss.imageLink;
			}
		}
		
		
		
	});
	
	$('.slider_3d').each(function() {
		var __this__ = $(this);
		var auto_slide_interval = $(this).find('.auto_slide_settings').find('.auto_slide_interval').html();
		auto_slide_interval = parseInt( auto_slide_interval );
		if( auto_slide_interval == 0 ) return;
		if( $(this).data('actual_pos') == undefined )
		$(this).data('actual_pos', 0);		
		
		//console.log('xxx');
		var current_sliding_interval = setInterval( function() { 
			
			slider_3d_move_left( __this__ );
			//console.log('spin');
		/*	var current_active_slide = __this__.find('.current_active_slide').html();
			current_active_slide = parseInt(current_active_slide);
			
			current_active_slide++;
			
			if( __this__.find('.one_slide').size() == current_active_slide )
				current_active_slide = 0;
			//alert(current_active_slide);
			__this__.find('.current_active_slide').html(current_active_slide);
			
			console.log(__this__.find('.one_slide').eq(current_active_slide));
			
			slider_accordeon_hover( __this__.find('.one_slide').eq(current_active_slide) );*/
			
			
		}, auto_slide_interval );
		$(this).data('current_sliding_interval', current_sliding_interval );
	});
	
	function slider_3d_move_left( slider ) {
		//alert(slider.find('.info_holder').html());
		
			var dim = jQuery.parseJSON( slider.find('.info_holder').html() );
			
		speed = slider_3d_speed;
				slider.data('animating', true);
				
				
				if( slider.find('div[rel=r2]').index() == slider.children('div').size() - 1 ) {
					slider.children('div').eq(0).animate({ width: dim.r2.w, height: dim.r2.h+30, top: dim.r2.t, left: dim.r2.l - 100 },-1);
					slider.children('div').eq(0).find('.img_content').animate({ width: dim.r2.w, height: dim.r2.h },-1 );
					
					slider.children('div').eq(0).css('display','block');		
					slider.children('div').eq(0).animate({ width: dim.r2.w, height: dim.r2.h+30, top: dim.r2.t, left: dim.r2.l },speed);
					slider.children('div').eq(0).find('.img_content').animate({ width: dim.r2.w, height: dim.r2.h },1);
					slider.children('div').eq(0).find('.img_shadow').animate({ width: dim.r2.w },1);
				} else {
				
					slider.find('div[rel=r2]').next().animate({ width: dim.r2.w, height: dim.r2.h+30, top: dim.r2.t, left: dim.r2.l - 100 },-1);
					slider.find('div[rel=r2]').next('div').find('.img_content').animate({ width: dim.r2.w, height: dim.r2.h },-1 );
					
					slider.find('div[rel=r2]').next('div').css('display','block');		
					slider.find('div[rel=r2]').next('div').animate({ width: dim.r2.w, height: dim.r2.h+30, top: dim.r2.t, left: dim.r2.l },speed);
					slider.find('div[rel=r2]').next('div').find('.img_content').animate({ width: dim.r2.w, height: dim.r2.h },1);
					slider.find('div[rel=r2]').next('div').find('.img_shadow').animate({ width: dim.r2.w },1);
				}
						
						//alert ('xxx');
			/*if( slider.find('div[rel=r2]').index() == slider.children('div').size() - 1 ) {
					slider.children('div').last().css('display','block');
				
				slider.children('div').last().animate({ width: dim.l2.w, height: dim.l2.h, top: dim.l2.t, left: dim.l2.l+100 },0  );
				slider.children('div').last().find('.img_content').animate({ width: dim.l2.w, height: dim.l2.h },0  );
				
				slider.children('div').last().animate({ width: dim.l2.w, height: dim.l2.h, top: dim.l2.t, left: dim.l2.l },speed  );
				slider.children('div').last().find('.img_content').animate({ width: dim.l2.w, height: dim.l2.h },speed  );
				
			}	else  {
			
				
			}*/

	//	slider.find('div[rel=l2]').prev().css('display','block');
		
	//	slider.find('div[rel=l2]').prev().animate({ width: dim.l2.w, height: dim.l2.h, top: dim.l2.t, left: dim.l2.l+100 },0  );
		//slider.find('div[rel=l2]').prev().find('.img_content').animate({ width: dim.l2.w, height: dim.l2.h },0  );
		
		//slider.find('div[rel=l1]').prev().animate({ width: dim.l1.w, height: dim.l1.h, top: dim.l1.t, left: dim.l1.l },speed  );
		//slider.find('div[rel=l1]').prev().find('.img_content').animate({ width: dim.l1.w, height: dim.l1.h },speed  );
			
//	slider.find('div[rel=r2]').next().css('border', '5px solid red');
		slider.find('div[rel=l2]').animate({ width: dim.l2.w, height: dim.l2.h+30, top: dim.l2.t, left: dim.l2.l + 100 },speed  , function(){ $(this).css('display', 'none'); } );
		slider.find('div[rel=l2] .img_content').animate({ width: dim.l2.w, height: dim.l2.h },speed  );
		slider.find('div[rel=l2] .img_shadow').animate({ width: dim.l2.w },speed  );


		slider.find('div[rel=l1]').animate({ width: dim.l2.w, height: dim.l2.h+30, top: dim.l2.t, left: dim.l2.l },speed  );
		slider.find('div[rel=l1] .img_content').animate({ width: dim.l2.w, height: dim.l2.h },speed  );
		slider.find('div[rel=l1] .img_shadow').animate({ width: dim.l2.w },speed  );
	
	
		slider.find('div[rel=c]').animate({ width: dim.l1.w, height: dim.l1.h+30, top: dim.l1.t, left: dim.l1.l },speed  );
		slider.find('div[rel=c] .img_content').animate({ width: dim.l1.w, height: dim.l1.h },speed  );
		slider.find('div[rel=c] .img_shadow').animate({ width: dim.l1.w },speed  );
		
		
		slider.find('div[rel=r1]').animate({ width: dim.c.w, height: dim.c.h+30, top: dim.c.t, left: dim.c.l },speed, function(){ switch_all_left(slider)} );
		slider.find('div[rel=r1] .img_content').animate({ width: dim.c.w, height: dim.c.h },speed  );
		slider.find('div[rel=r1] .img_shadow').animate({ width: dim.c.w },speed  );
		
		slider.find('div[rel=r2]').animate({ width: dim.r1.w, height: dim.r1.h+30, top: dim.r1.t, left: dim.r1.l },speed );
		slider.find('div[rel=r2] .img_content').animate({ width: dim.r1.w, height: dim.r1.h },speed, function() { slider.data('animating', false)} );
		slider.find('div[rel=r2] .img_shadow').animate({ width: dim.r1.w },speed  );
	/*		
			
		//slider.find('div[rel=r2]').next().animate({ width: dim.r2.w, height: dim.r2.h, top: dim.r2.t, left: dim.r2.l - 100 },-1);
		//slider.find('div[rel=r2]').next().find('.img_content').animate({ width: dim.r2.w, height: dim.r2.h },-1 ); */
		
	
		
		
		in_half_all_left( slider );
	}
	
		function in_half_all_left( slider ) {
		
		setTimeout( function(){
    		 slider.find('div[rel=r1]').css('z-index', 3);
    		 slider.find('div[rel=c]').css('z-index', 2);
    		 slider.find('div[rel=l1]').css('z-index', 1);
    		 slider.find('div[rel=l2]').css('z-index', 0);
    	},speed/4);
		
	}
	
	function switch_all_left( slider ) {
		
		var actual_pos = slider.data('actual_pos');
		actual_pos++;
		if( actual_pos == slider.children('div').size())
			actual_pos = 0;
		var r1 = actual_pos +1;
		var r2 = actual_pos + 2;
		if( (actual_pos+1) == slider.children('div').size() ) {
			r1 = 0;
			r2 = 1;
		}
		
		if( (actual_pos+2) == slider.children('div').size() ) {
			r2 = 0;
		}
		
		slider.children('div').attr('rel', '').css('z-index',0);
		slider.children('div').eq(actual_pos - 2).attr('rel','l2').css('z-index',1).css('display','block');
		slider.children('div').eq(actual_pos - 1).attr('rel','l1').css('z-index',2).css('display','block');
		slider.children('div').eq(actual_pos).attr('rel','c').css('z-index',3).css('display','block');
		slider.children('div').eq(r1).attr('rel','r1').css('z-index',2).css('display','block');
		slider.children('div').eq(r2).attr('rel','r2').css('z-index',1).css('display','block');
		slider.data('actual_pos', actual_pos);
	}
	function slider_3d_move_left_twice( slider ) {
		slider_3d_move_left(slider);
		setTimeout(function() {slider_3d_move_left(slider); }, slider_3d_speed + 20);
	}	
	
	function slider_3d_move_right_twice( slider ) {
		slider_3d_move_right(slider);
		setTimeout(function() {slider_3d_move_right(slider); }, slider_3d_speed + 20);
	}
	
	function slider_3d_move_right( slider ) {
		var dim = $.parseJSON( slider.find('.info_holder').html() );
		speed = slider_3d_speed;
		
	//	slider.find('.l2').prev()
	//alert(slider.find('div[rel=l2]').index());
	
		slider.data('animating', true);
		
	if( slider.find('div[rel=l2]').index() == 0) {
		
			slider.children('div').last().css('display','block');
		
		slider.children('div').last().animate({ width: dim.l2.w, height: dim.l2.h+30, top: dim.l2.t, left: dim.l2.l+100 },0  );
		slider.children('div').last().find('.img_content').animate({ width: dim.l2.w, height: dim.l2.h },0  );
		
		slider.children('div').last().animate({ width: dim.l2.w, height: dim.l2.h+30, top: dim.l2.t, left: dim.l2.l },speed  );
		slider.children('div').last().find('.img_content').animate({ width: dim.l2.w, height: dim.l2.h },speed  );
		slider.children('div').last().find('.img_shadow').animate({ width: dim.l2.w },speed  );
		
	}	else  {
			slider.find('div[rel=l2]').prev().css('display','block');
		
		slider.find('div[rel=l2]').prev().animate({ width: dim.l2.w, height: dim.l2.h+30, top: dim.l2.t, left: dim.l2.l+100 },0  );
		slider.find('div[rel=l2]').prev().find('.img_content').animate({ width: dim.l2.w, height: dim.l2.h },0  );
		
		slider.find('div[rel=l2]').prev().animate({ width: dim.l2.w, height: dim.l2.h+30, top: dim.l2.t, left: dim.l2.l },speed  );
		slider.find('div[rel=l2]').prev().find('.img_content').animate({ width: dim.l2.w, height: dim.l2.h },speed  );
		slider.find('div[rel=l2]').prev().find('.img_shadow').animate({ width: dim.l2.w},speed  );
	
		
	}
	
	
		slider.find('div[rel=l2]').animate({ width: dim.l1.w, height: dim.l1.h+30, top: dim.l1.t, left: dim.l1.l },speed  );
		slider.find('div[rel=l2] .img_content').animate({ width: dim.l1.w, height: dim.l1.h },speed  );
		slider.find('div[rel=l2] .img_shadow').animate({ width: dim.l1.w },speed  );


		slider.find('div[rel=l1]').animate({ width: dim.c.w, height: dim.c.h+30, top: dim.c.t, left: dim.c.l },speed  );
		slider.find('div[rel=l1] .img_content').animate({ width: dim.c.w, height: dim.c.h },speed  );
		slider.find('div[rel=l1] .img_shadow').animate({ width: dim.c.w },speed  );
		
	
		slider.find('div[rel=c]').animate({ width: dim.r1.w, height: dim.r1.h+30, top: dim.r1.t, left: dim.r1.l },speed  );
		slider.find('div[rel=c] .img_content').animate({ width: dim.r1.w, height: dim.r1.h },speed  );
		slider.find('div[rel=c] .img_shadow').animate({ width: dim.r1.w },speed  );
		
		
		
		slider.find('div[rel=r1]').animate({ width: dim.r2.w, height: dim.r2.h+30, top: dim.r2.t, left: dim.r2.l },speed, function(){ switch_all_right(slider)} );
		slider.find('div[rel=r1] .img_content').animate({ width: dim.r2.w, height: dim.r2.h },speed  );
		slider.find('div[rel=r1] .img_shadow').animate({ width: dim.r2.w },speed  );
		
	
		slider.find('div[rel=r2]').animate({ width: dim.r2.w, height: dim.r2.h+30, top: dim.r2.t, left: dim.r2.l - 100 },speed, function(){ $(this).css('display', 'none'); } );
		slider.find('div[rel=r2] .img_content').animate({ width: dim.r2.w, height: dim.r2.h },speed, function() { slider.data('animating', false)} );
		slider.find('div[rel=r2] .img_shadow').animate({ width: dim.r2.w },speed, function() { slider.data('animating', false)} );
		
		
		in_half_all_right( slider );
		
		//slider.find('.l1').delay(100).animate({width:3}, 1); //.css('z-index', 3);
		///slider.find('.c').delay( 100).animate({zindex:2}, 1);//.css('z-index', 2);
		
	//	alert('aaa');
	//	slider.css('display','none');
	}
	
	function in_half_all_right( slider ) {
		
		setTimeout( function(){
    		 slider.find('div[rel=l1]').css('z-index', 3);
    		 slider.find('div[rel=c]').css('z-index', 2);
    		 slider.find('div[rel=r1]').css('z-index', 1);
    		 slider.find('div[rel=r2]').css('z-index', 0);
    	},speed/4);
		
	}
	
	function switch_all_right( slider ) {
		var actual_pos = slider.data('actual_pos');
		actual_pos--;
		//console.log(actual_pos);
		//alert(slider.children('div').size() );
		//alert(actual_pos * -1);
		//if( (actual_pos * -1)+5 == slider.children('div').size() )
//			actual_pos = 5
		
		//console.log(actual_pos);
		//console.log(slider.children('div').size());
			//console.log('=======');
	
		if( (actual_pos * -1)  == slider.children('div').size() - 1) {
			actual_pos = 1;
		} 
		
		slider.children('div').attr('rel', '').css('z-index',0);
	
		//alert(actual_pos);
		slider.children('div').eq(actual_pos - 2).attr('rel','l2').css('z-index',1).css('display','block');
		slider.children('div').eq(actual_pos - 1).attr('rel','l1').css('z-index',2).css('display','block');
		slider.children('div').eq(actual_pos).attr('rel','c').css('z-index',3).css('display','block');
		slider.children('div').eq(actual_pos + 1).attr('rel','r1').css('z-index',2).css('display','block');
		slider.children('div').eq(actual_pos + 2).attr('rel','r2').css('z-index',1).css('display','block');
		slider.data('actual_pos', actual_pos);
	 
		
	}
	
	
/*	
	var neco = $('.slider_3d').find('.info_holder').html();
	
	var obj = $.parseJSON( neco );
	
	alert(obj.l2.h);
	
*/
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
});
