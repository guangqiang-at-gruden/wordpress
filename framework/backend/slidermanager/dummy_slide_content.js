String.prototype.replaceAll = function(token, newToken, ignoreCase) {
    var str, i = -1, _token;
    if((str = this.toString()) && typeof token === "string") {
        _token = ignoreCase === true? token.toLowerCase() : undefined;
        while((i = (
            _token !== undefined? 
                str.toLowerCase().indexOf(
                            _token, 
                            i >= 0? i + newToken.length : 0
                ) : str.indexOf(
                            token,
                            i >= 0? i + newToken.length : 0
                )
        )) !== -1 ) {
            str = str.substring(0, i)
                    .concat(newToken)
                    .concat(str.substring(i + token.length));
        }
    }
return str;
};

jQuery(document).ready(function($) {
	var slider_type = $('#foptions-slider_options-slider_type').val();
	var dummy_content = $('.slide_dummy_content').find('.slide_dummy_'+ slider_type).html();

	dummy_content = dummy_content.replaceAll('{','<').replaceAll('}','>');
	console.log(dummy_content + 'xxx');
	function check_empty_slides() {
		$('#slides').find('.description').eq(0).each(function() {
			
			if( $(this).val() == '' ) {
				$(this).val( dummy_content );
			}
		});
	}
	
	//check_empty_slides();
	$('.add_slide_btn').click(function(){ check_empty_slides();} );
});
