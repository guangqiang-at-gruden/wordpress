/* --------------------------------------------- */
/* Author: http://codecanyon.net/user/CodingJack */
/* --------------------------------------------- */

;(function($) {
	
	var touchStopEvent, touchMoveEvent, touchStartEvent,
	
	methods = {
		
		touchSwipe: function($this, cb) {

			methods.touchSwipeLeft($this, cb);
			methods.touchSwipeRight($this, cb);
			
		},
		
		touchSwipeLeft: function($this, cb, prevent) {
			
			if(prevent) $this.data("stopPropagation", true);
			
			var data = $this.data();
			if(!data.swipeLeft) data.swipeLeft = cb;
			
			if(!data.swipeRight) {
				
				$this.off(".cj_swp");
				$this.on(touchStartEvent, touchStart).on(touchStopEvent, touchEnded);
				
			}
			
		},
		
		touchSwipeRight: function($this, cb, prevent) {
			
			if(prevent) $this.data("stopPropagation", true);
			
			var data = $this.data();
			if(!data.swipeRight) data.swipeRight = cb;
			
			if(!data.swipeLeft) {
				
				$this.off(".cj_swp");
				$this.on(touchStartEvent, touchStart).on(touchStopEvent, touchEnded);
					
			}
	
		},
		
		unbindSwipe: function($this, remove) {
			
			$this.off(".cj_swp").removeData("swipeLeft swipeRight stopPropagation");
			
		}
		
	};
	
	if("ontouchend" in document) {
	
		touchStopEvent = "touchend.cj_swp";
		touchMoveEvent = "touchmove.cj_swp";
		touchStartEvent = "touchstart.cj_swp";
		
	}
	else {
	
		touchStopEvent = "mouseup.cj_swp";
		touchMoveEvent = "mousemove.cj_swp";
		touchStartEvent = "mousedown.cj_swp";
		
	}
	
	$.fn.cjSwipe = function(type, a, b) {
		
		methods[type](this, a, b);	
		
	};
	
	function touchStart(event) {
		
		var $this = $(this), data = $this.data(),
		pages = event.originalEvent.touches ? event.originalEvent.touches[0] : event;
		
		if(data.stopPropagation) event.stopImmediatePropagation();
		
		data.pageX = pages.pageX;
		$this.on(touchMoveEvent, moveHandler);
		
	}
	
	function moveHandler(event) {
		
		var $this = $(this), data = $this.data(), newPageX,
		pages = event.originalEvent.touches ? event.originalEvent.touches[0] : event;
		
		data.newPageX = newPageX = pages.pageX;
		if(Math.abs(data.pageX - newPageX) > 10) event.preventDefault();
		
	}
	
	function touchEnded() {
			
		var $this = $(this).off(".cj_swp"),
		data = $this.data(),
		
		newPageX = data.newPageX,
		pageX = data.pageX;
			
		if(Math.abs(pageX - newPageX) < 30) return;
			
		if(pageX > newPageX) {
			
			if(data.swipeLeft) data.swipeLeft();
			
		}
		else {
			
			if(data.swipeRight) data.swipeRight(1);
			
		}
		
	}
	
		
})(jQuery);





