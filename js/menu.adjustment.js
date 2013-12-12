(function($){
	// get URL cleaned of the shit #(sharps)
	var getCleanUrl = function() {
		var cleanUrl = '';
		var uncleanedUrl = window.location.href;
		var indexOfID = uncleanedUrl.indexOf('#');
		if( indexOfID != -1 ) {
			cleanUrl = uncleanedUrl.substring(0, indexOfID);
		} else {
			cleanUrl = uncleanedUrl;
		}
		return cleanUrl;
	}
	
	// is this wished pagination url ?
	var compareUrl = function( cleanUrl, menuUrl ) {
		if( cleanUrl.indexOf( menuUrl ) != -1 ) {
			var differentPart = cleanUrl.replace(menuUrl, '');
			if( differentPart.indexOf('page/') == 0 ) return true;
		} 
		
		return false;
	}
	
	// add selected to all parent classes
	var selectLiAndAllParents = function( item ) {
		item.addClass('current-menu-item');
		item.parents('li').addClass('current-menu-item');
	}
	
	// main script content
	$(document).ready(function() {
		var cleanUrl = getCleanUrl();
		if( $('#menu-navigation').size() > 0 && $('#menu-navigation').find('li').size() > 0 ) {
			$('#menu-navigation').find('li').each(function() {
				var menuUrl = $(this).children('a').attr('href');
				if( compareUrl( cleanUrl, menuUrl ) ) {
					selectLiAndAllParents( $(this) );
				}
			});
		}
	});
})(jQuery);
