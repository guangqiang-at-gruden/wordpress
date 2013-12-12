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
	$('.slider_arrow, .slider_cubes_down_shadow').disableSelection();
	
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

	function sliderCubes( __slider_cubes__ ) {
		
		// selector store
		__this__ = this;
		this.slider_cubes = __slider_cubes__;
		this.cube_one = __slider_cubes__.find('.cubes_holder').find('.one_cube');
		this.cubes_holder = __slider_cubes__.find('.cubes_holder');
		this.cube_bottom = __slider_cubes__.find('.cubes_holder').find('.cube_bottom');
		this.cube_top =  __slider_cubes__.find('.cubes_holder').find('.cube_top');
		
		this.cubes_x = __slider_cubes__.find('.cubes_holder').attr('cubes-x');
		this.cubes_y = __slider_cubes__.find('.cubes_holder').attr('cubes-y');
			
		this.cube_width = this.cubes_holder.find('.cube_top').eq(0).width();
		this.cube_height = this.cubes_holder.find('.cube_top').eq(0).height();
		this.slides_data = __slider_cubes__.find('.slides_data');
		this.one_slide_settings = this.slides_data.find('.one_slide_settings');

		this.slides_count = this.one_slide_settings.size();
		this.actual_slide_id = 0;
		this.actual_slide_settings = get_one_slide_settings( this.one_slide_settings.eq(0) );
		
		/**
		 * reset grid - you have to call this function after all transitions 
		 */
		this.reset_grid = function() {
			this.cube_one.each(function() {
				//console.log( __this__.cube_width + 'xx');
				$(this).find('.cube_bottom, .cube_top').css({ 'left': 0, 'top':0,opacity:1});//, 'width': __this__.cube_width, 'height':__this__.cube_height, opacity:1});
			});
		}
		/**
		 * switch slides - new to the bottom, old to the top;
		 */
		this.switch_slides = function() {
			this.cube_top.css('background-image', this.cube_bottom.css('background-image') );
			
			var oss = this.actual_slide_settings
			this.cube_bottom.css('background-image',"url('" + oss.imageUrl + "')");
		}
		
		/**
		 * move slider pointer - move the pointer across the slides
		 */
		this.move_slider_pointer = function( direction ) {
			
			if( direction == 'up' ) {
				this.actual_slide_id++;
				if( ( this.actual_slide_id  ) >= this.slides_count )
					this.actual_slide_id = 0;
			} else if( direction == 'down' ) {
				this.actual_slide_id--;
				if( (this.actual_slide_id ) == -1 )
					this.actual_slide_id = this.slides_count-1 ;
			}
			
			this.actual_slide_settings = get_one_slide_settings( this.one_slide_settings.eq( this.actual_slide_id ) );
		}
		
		/**
		 * move right - move slider right with transitions
		 */
		this.move_right = function() {
			//if( this.slider_cubes.data('animating') == true)
			//	return;
				
			//this.slider_cubes.data('animating',true);
			if( this.check_animating() == false) return;
			this.move_slider_pointer('up');
			this.reset_grid();
			this.switch_slides();
			this.proceed_transition();
			this.change_text();
		}
		
		this.move_left = function() {
			if( this.check_animating() == false) return;
			this.move_slider_pointer('down');
			this.reset_grid();
			this.switch_slides();
			this.proceed_transition();
			this.change_text();
		}
		
		this.change_text = function() {
			var slider_holder = this;
			var slide_title_filled = true;
			var slide_desc_filled = true;
			
			if( slider_holder.actual_slide_settings.title == '' || slider_holder.actual_slide_settings.title == ' ' ) {
				slide_title_filled = false;
			}	
			if( slider_holder.actual_slide_settings.description == '' ||  slider_holder.actual_slide_settings.description == '<h3></h3>' ) {
				slide_desc_filled = false;
			}
			
			
			if( slide_title_filled || slide_desc_filled ) {
				
				
				this.slider_cubes.find('.slider_description_content').css('display','block').animate({opacity:0}, 150, function() {
					$(this).parent().animate({opacity:1},0);
					$(this).html( slider_holder.actual_slide_settings.description );
				 	
					$(this).animate({opacity:1}, 150);
				});
			}
			else {
			
				this.slider_cubes.find('.slider_description_content').parent().animate({opacity:0}, 150);
			}

		}
		
		this.check_animating = function() {
			var animated_divs = this.cube_one.find(':animated');
			//console.log(animated_divs);
			 
			if( animated_divs.size() != 0 ) return false;
			else return true;
		}
		
		this.proceed_transition = function() {
			var transition_name = "transition_" + this.actual_slide_settings.transition;
			this[ transition_name ]();
		}
		
		this.transition_fly_right_top = function() {
			
			var height = this.cube_height;
			var width = this.cube_width;
			
			this.cube_bottom.css({top: height, left: -width, opacity:0});
			this.cube_bottom.each(function() {
				$(this).animate({top:0, left:0, opacity:1}, 400);
			});				
						
			this.cube_top.each(function() {
				$(this).animate({ top: -height, left:width, opacity:0}, 400, 'easeInOutCirc');
			
			});
		}
		
		this.transition_runaway_right = function() {
			var height = this.cube_height;
			var width = this.cube_width;
			
			for( var x = 0; x < this.cubes_x; x++){
				for( var y=0; y< this.cubes_y; y++) {
					var one_cube = this.cubes_holder.find('.one_cube_'+x+'_'+y);
					one_cube.find('.cube_top').delay( (x) * 120).animate({left:height, opacity:0}, 280, 'easeInOutCirc');
				}
			}
		}
		
		this.transition_runaway_left = function() {
			var height = this.cube_height;
			var width = this.cube_width;
			
			for( var x = 0; x < this.cubes_x; x++){
				for( var y=0; y< this.cubes_y; y++) {
					var one_cube = this.cubes_holder.find('.one_cube_'+x+'_'+y);
					one_cube.find('.cube_top').delay( (this.cubes_x - x) * 120).animate({left:-height, opacity:0}, 280, 'easeInOutCirc');
				}
			}
		}
		
		this.transition_fly_left_bottom = function() {
			
			var height = this.cube_height;
			var width = this.cube_width;
			
			this.cube_bottom.css({top: -height, left: width, opacity:0});
			this.cube_bottom.each(function() {
				$(this).animate({top:0, left:0, opacity:1}, 400);
			});				
						
			this.cube_top.each(function() {
				$(this).animate({ top: height, left:-width, opacity:0}, 400, 'easeInOutCirc');
			
			});			
		}
		
		this.transition_fall_down = function() {
			var height = this.cube_height;
			var width = this.cube_width;
			
			this.cube_bottom.css({top: -height, left: 0} );
			
			var delay_counter = 0;
			
			this.cube_one.each(function() {
				delay_counter = Math.random() * 500;
				$(this).find('.cube_bottom').delay( delay_counter ).animate({top:0}, 300, 'easeInOutCirc');
				$(this).find('.cube_top').delay( delay_counter ).animate({top:height}, 300, 'easeInOutCirc');
				//delay_counter += 20;
			});	
		}	
		
		this.transition_sin_wave = function() {
					var height = this.cube_height;
			var width = this.cube_width;
			this.cube_bottom.css({top: height, left: -width, opacity:0});
			for( var x = 0; x < this.cubes_x; x++){
				for( var y=0; y< this.cubes_y; y++) {
					var one_cube = this.cubes_holder.find('.one_cube_'+x+'_'+y);
					one_cube.find('.cube_top').delay( x * 30).animate({ top: -height, left:width, opacity:0}, 400, 'easeInOutCirc');
					one_cube.find('.cube_bottom').delay( x * 30).animate({top:0, left:0, opacity:1}, 400);
				}
			}
		}	
		
		this.transition_disappear = function() {
			for( var x = 0; x < this.cubes_x; x++){
				for( var y=0; y< this.cubes_y; y++) {
					var one_cube = this.cubes_holder.find('.one_cube_'+x+'_'+y);
					one_cube.find('.cube_top').delay( (x+y) * 30).animate({opacity:0}, 400, 'easeInOutCirc');
				}
			}
		}
		
		/*this.transition_implode = function () {
			
			var width = this.cube_width;
			var height = this.cube_height;
			var half_width = width / 2;
			var half_height = height / 2;
			
			var new_top =( height - half_height ) / 2;
			var new_left = ( width - half_width ) / 2;
			
			
			for( var x = 0; x < this.cubes_x; x++){
				for( var y=0; y< this.cubes_y; y++) {
					var one_cube = this.cubes_holder.find('.one_cube_'+x+'_'+y);
					one_cube.find('.cube_top').delay( (x+y) * 30).animate({top:new_top, left:new_left, width:half_width, height:half_height, opacity:0}, 400, 'easeInBack');
				}
			}
		}*/
		
		this.transition_column_fall = function() {
			var height = this.cube_height;
			var time_to_one_cube = 500 / parseInt(this.cubes_y);
			var time_to_one_column = 500 / this.cubes_x;
			//alert( parseInt(this.cubes_y));
			for( var x = 0; x < this.cubes_x; x++){
				for( var y=0; y< this.cubes_y; y++) {
					var one_cube = this.cubes_holder.find('.one_cube_'+x+'_'+y);
					one_cube.find('.cube_top').delay( (y * time_to_one_cube) + ( x * time_to_one_column ) ).animate({ top: +height}, time_to_one_cube, 'easeInOutCirc');
				//	one_cube.find('.cube_bottom').delay( x * 30).animate({top:0, left:0, opacity:1}, 400);
				}
			}
			
		}
		
		this.transition_random = function() {
			this.cube_top.each(function() {
				$(this).delay( Math.random() * 500).animate({opacity:0}, 500);
			});
		}
		
		this.clickAction = function() {
			var oss = this.actual_slide_settings;
			
			if( oss.lightbox == 'lightbox' ) {
			$.prettyPhoto.open(oss.imageLink,oss.title,'');
			} else  if ( oss.lightbox == 'url' ) {
 				window.location= oss.imageLink ;
			}	
		}
	}
	
	$('.slider_cubes').click(function() {
		var sc = $(this).data('sc');
		sc.clickAction();	
	});
	
	$('.slider_cubes').each(function() {
		
		var sc = new sliderCubes( $(this) );
		sc.reset_grid();
		$(this).data('sc', sc);
	});
	
	//var sc = new sliderCubes();
	//sc.reset_grid();
	
	/*$('.slider_cubes').click( function() {
		var sc = $(this).data('sc');
		sc.move_right();
		clearInterval( $(this).data('current_sliding_interval') );
		//sc.move_right();
	});*/
	
	$('.slider_cubes_wrapper').find('.slider_left_arrow').click(function() {
		
		var sc = $(this).parent().find('.slider_cubes').data('sc');
		
		
		sc.move_left();
		clearInterval( $(this).parent().find('.slider_cubes').data('current_sliding_interval') );
	});
	
	$('.slider_cubes_wrapper').find('.slider_right_arrow').click(function() {
		var sc = $(this).parent().find('.slider_cubes').data('sc');
		sc.move_right();
		clearInterval( $(this).parent().find('.slider_cubes').data('current_sliding_interval') );
	});
	
	
	$('.slider_cubes').each(function() {
		var __this__ = $(this);
		var auto_slide_interval = $(this).find('.auto_slide_settings').find('.auto_slide_interval').html();
		
		auto_slide_interval = parseInt( auto_slide_interval );
		//console.log(auto_slide_interval);
		if( auto_slide_interval == 0 || auto_slide_interval == null ) return;
		if( $(this).data('actual_pos') == undefined )
		$(this).data('actual_pos', 0);		
		
		//console.log('xxx');
		var current_sliding_interval = setInterval( function() { 
			
			var sc = __this__.data('sc');
			sc.move_right();
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
	
	
	
	$('.slider_arrow_holder').css({opacity:0, 'display':'block'})
	$('.slider_cubes').hover( function() {
		$('.slider_arrow_holder').stop().animate({opacity:1}, 200);
	}, function () {
		$('.slider_arrow_holder').stop().animate({opacity:0}, 200);
	});
	
//	var cube_bottom = $('.slider_cubes').find('.cubes_holder').find('.cube_bottom');
//	var cube_top =  $('.slider_cubes').find('.cubes_holder').find('.cube_top');
	
	//cube_top.animate({top:-500}, 2000 );
});