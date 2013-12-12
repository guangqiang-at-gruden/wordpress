jQuery(document).ready(function($) {
	var ff_has_been_clicked = false;
	
	
	function bindColorPicker() {
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
	}
	
	$('.thickbox').attachMediaUploader('media-upload-link', function( url, attr) {
		$('#' + attr ).val( url );
	 });
	
	var site_default_content = new Array(  'archive', 'author', 'search', 'tag', 'date');

	$('#right-column').css({opacity:0});
	
	$('.nav-menu-header').click(function(){
		$(this).parent().find('.inside').toggle(250);
	});
	
	var data_to_save = {};
	var data_to_save_holder = {};
	var actual_category_selected = '';
	var actual_category_template = '';
	var actual_category_subtemplate = '';

	
	function blick() {
		
		$('#right-column').css({'display':'block'}).animate({opacity:0}, 100).animate({opacity:1},100);
	}
	
	$('input[name=category-template]').click(function() {
		$('#category-options').find('li').removeClass('template_active');
		
		$(this).parents('li').addClass('template_active');
	});
	
	$('input[name=single-template]').click(function() {
		
		$('#single-blog').find('li').removeClass('template_active');
		
		$(this).parents('li').addClass('template_active');
	});
	
	
	
	function catman_save_data() {
		
		
		var category_data = {};
	 	
		$('#category-options-additional').find('input[type=text]').each( function() {
			category_data[ $(this).attr('name') ] = $(this).attr('value');
			
		});
		
		$('#category-options-additional').find('input[type=checkbox]').each( function() {
			if( $(this).attr('checked') == 'checked' )
				category_data[ $(this).attr('name') ] = 1;
			else
				category_data[ $(this).attr('name') ] = 0;
		});		
		
		$('#category-options-additional').find('select').each( function() {
			category_data[ $(this).attr('name') ] = $(this).attr('value');
		});
		
		var single_data = {};
		
		$('#single-options-additional').find('input[type=text]').each( function() {
			single_data[ $(this).attr('name') ] = $(this).attr('value');
			
		});
		
		$('#single-options-additional').find('input[type=checkbox]').each( function() {
			if( $(this).attr('checked') == 'checked' )
				single_data[ $(this).attr('name') ] = 1;
			else
				single_data[ $(this).attr('name') ] = 0;
		});		
		
		$('#single-options-additional').find('select').each( function() {
			single_data[ $(this).attr('name') ] = $(this).attr('value');
		});
		
		var category_template = $('input[name=category-template]:checked').attr('value');
		var single_template = $('input[name=single-template]:checked').attr('value');
		
		var data = {
			action: 'catman',
			subaction:'save',
			category_selected: actual_category_selected,
			category_data: category_data,
			single_data: single_data,
			category_template: category_template,
			single_template: single_template
		};
		
		
		if( data_to_save['counter'] == undefined )
			data_to_save['counter'] = 0;
			
		data_to_save[data_to_save['counter']]=data;
		data_to_save['counter'] = data_to_save['counter'] + 1;
		data_to_save_holder[actual_category_selected] = data;
		
	}
	
	function catman_send_data() {
		
		var num_elements = data_to_save['counter'];
		
		data_to_save['action'] = 'catman';
		data_to_save['subaction'] = 'save';
			jQuery.post(ajaxurl, data_to_save, function(response) {
			});
			
//		}
		
		data_to_save = null;
		data_to_save = {};
		data_to_save['counter'] = 0;
	}
	
	function catman_load_data() {
		
		if(data_to_save_holder[actual_category_selected]  == undefined ) {
			
		
		 
			var data = { 
				action: 'catman',
				subaction: 'load',
				category_selected: actual_category_selected,
			}
			/*
			 * 
			   index
				archive
				author
				search
				tag
				date 
			 */
			$('#right-column').css({'display':'block'}).animate({opacity:0}, 200);
			jQuery.post(ajaxurl, data, function(response) {
				console.log(response);
				$('#right-column').animate({opacity:1}, 200);
				console.log(actual_category_selected);
				console.log(response);
				var data = jQuery.parseJSON( response );
				var cat_template = data['category_template'];
				var sin_template = data['single_template'];
				//alert( cat_template );
				if( sin_template == '' ||  sin_template == null)
					sin_template = 'post/post-1.php';
				if( cat_template == null && jQuery.inArray( actual_category_selected, site_default_content ) != -1 )
					cat_template = 'blog/blog-cat-10.php'
						
				if( cat_template == null ) {
					cat_template = 'blog/blog-cat-1.php';
				}
				
				
				
				
				$('input[value="'+sin_template+'"]').attr('checked', 'checked');
				
				$('#category-options').find('li').removeClass('template_active');
				$('#single-blog').find('li').removeClass('template_active');
								
				$('input[value="'+sin_template+'"]').parents('li').addClass('template_active');
				$('input[value="'+cat_template+'"]').parents('li').addClass('template_active');
				if( cat_template != null ) {
					var cat_template_parent = $('input[value="'+cat_template+'"]').parent().parent().parent().parent().attr('rel');
				
					$('input[value="'+cat_template+'"]').attr('checked', 'checked');
					switch(cat_template_parent) {
						case 'blog-subnav-right':
						 	switch_blog();
						 	switch_subnav('right');
							break;
							
						case 'blog-subnav-left':
							switch_blog();
							switch_subnav('left');
							break;
						
						case 'blog-subnav-no':
							switch_blog();
							switch_subnav('no');
							break;
						case 'portfolio-subnav-no':
							switch_portfolio();
							break;
					}
					
				}
			
					
				
				if( sin_template != null ) {
 
					var sin_template_parent = $('input[value="'+sin_template+'"]').parent().parent().parent().parent().attr('rel');
					
					switch( sin_template_parent ) {
						case 'single-blog-subnav-right':
							switch_single_subnav('right');
							break;
						case 'single-blog-subnav-no':
							switch_single_subnav('no');
							break;							
					}
				}
				
			//	alert(cat_template_parent);
				
				$('input[type=text]').attr('value','');
				for( var name in data['cat_data']) {
					
					if( $('input[name='+name+']').attr('type') != 'checkbox' )
					{
						$('input[name='+name+']').attr('value', data['cat_data'][name] );
						$('select[name='+name+']').attr('value', data['cat_data'][name] );
					} else {
					
	
					//alert(data['cat_data'][name] );
					if( data['cat_data'][name] == 1)
						$('input[name='+name+']').attr('checked', 'checked' );
					else 
						$('input[name='+name+']').attr('checked', false );
					}
				}
				 
				for( var name in data['sin_data']) {

					if( $('input[name='+name+']').attr('type') != 'checkbox' )
					{
						$('input[name='+name+']').attr('value', data['sin_data'][name] );
						$('select[name='+name+']').attr('value', data['sin_data'][name] );
					} else {
					
	
					//alert(data['cat_data'][name] );
					if( data['sin_data'][name] == 1)
						$('input[name='+name+']').attr('checked', 'checked' );
					else 
						$('input[name='+name+']').attr('checked', false );
					}
				}				
				//alert('LOAD' + response);
				
					bindColorPicker();
				
			});
		}
		else {
			blick();
		 	var cat_data = data_to_save_holder[actual_category_selected]['category_data'];
		 	var sin_data = data_to_save_holder[actual_category_selected]['single_data'];
		 	
		 	var cat_template = data_to_save_holder[actual_category_selected]['category_template'];
			var sin_template = 	data_to_save_holder[actual_category_selected]['single_template'];
				if( sin_template == '' || sin_template == null)
					sin_template = 'post/post-1.php';
				
				if( cat_template == null ) {
					cat_template = 'blog/blog-cat-1.php';
				}				
			
		$('input[value="'+sin_template+'"]').attr('checked', 'checked');
				$('#category-options').find('li').removeClass('template_active');
				$('#single-blog').find('li').removeClass('template_active');				
				$('input[value="'+sin_template+'"]').parents('li').addClass('template_active');
				$('input[value="'+cat_template+'"]').parents('li').addClass('template_active');
				
				if( cat_template == null && jQuery.inArray( actual_category_selected, site_default_content ) != -1 )
					cat_template = 'blog/blog-cat-10.php'
				
				if( cat_template != null ) {
					var cat_template_parent = $('input[value="'+cat_template+'"]').parent().parent().parent().parent().attr('rel');
				
					$('input[value="'+cat_template+'"]').attr('checked', 'checked');
					switch(cat_template_parent) {
						case 'blog-subnav-right':
						 	switch_blog();
						 	switch_subnav('right');
							break;
							
						case 'blog-subnav-left':
							switch_blog();
							switch_subnav('left');
							break;
						
						case 'blog-subnav-no':
							switch_blog();
							switch_subnav('no');
							break;
							
						case 'portfolio-subnav-no':
							switch_portfolio();
							break;
					}
				}
				
				
				if( sin_template == null)
					sin_template = 'post/post-1.php';				
				if( sin_template != null ) {
 
					var sin_template_parent = $('input[value="'+sin_template+'"]').parent().parent().parent().parent().attr('rel');
					switch( sin_template_parent ) {
						case 'single-blog-subnav-right':
							switch_single_subnav('right');
							break;
						case 'single-blog-subnav-no':
							switch_single_subnav('no');
							break;							
					}
				}
								
				
		 	$('input[type=text]').attr('value','');
		 	for( var name in cat_data) {
					if( $('input[name='+name+']').attr('type') != 'checkbox' )
					{
						$('input[name='+name+']').attr('value', cat_data[name] );
						$('select[name='+name+']').attr('value', cat_data[name] );
					} else {
					
	
					//alert(data['cat_data'][name] );
					if( cat_data[name] == 1)
						$('input[name='+name+']').attr('checked', 'checked' );
					else 
						$('input[name='+name+']').attr('checked', false );
					}
				}
				
		 	for( var name in sin_data) {
					if( $('input[name='+name+']').attr('type') != 'checkbox' )
					{
						$('input[name='+name+']').attr('value', sin_data[name] );
						$('select[name='+name+']').attr('value', sin_data[name] );
					} else {
					
	
					//alert(data['cat_data'][name] );
					if( sin_data[name] == 1)
						$('input[name='+name+']').attr('checked', 'checked' );
					else 
						$('input[name='+name+']').attr('checked', false );
					}
				}				
			bindColorPicker();
		}
	}
	
	
	$('#cat-list').children('li').click(function(){
		ff_has_been_clicked = true;
	//	alert('ss');
		catman_save_data();
		actual_category_selected = $(this).attr('rel');
		catman_load_data();

		$('#cat-list').children('li').find('div').removeClass('cat_name_active');
		$('#cat-list').find('.cat_apply').css('display','none');
		$(this).find('.cat_name').addClass('cat_name_active');
		if( $(this).index() > 5 )
			$(this).find('.cat_apply').css('display','block');
		
	
		if( $.inArray( actual_category_selected, site_default_content) != -1 || actual_category_selected == 'index' ) {
			$('.single-view-options-class').css('display','none');
		} else {
			$('.single-view-options-class').css('display','block');
		}
	});
	$('.cat_apply').css('display','none');
	
	$('#publish').click(function() {
		if( ff_has_been_clicked == false ) return false;
		catman_save_data();
		catman_send_data();
		blick();
		return false;
	});
	
	
	
	function switch_single_subnav( subnav_name ) {
		$('#single-blog').find('.templates_wrapper').css('display','none');
		$('#single-blog-'+ subnav_name).css('display','block');		
		
		actual_category_subtemplate = subnav_name;
		if( subnav_name == 'no' )
			actual_category_subtemplate = 'fullwidth';
			
		$('#single-blog').find('.select_button').removeClass('nav-tab-active');
		$('#single-blog-subnav-'+ subnav_name).addClass( 'nav-tab-active' );		
	}
	
	
	function switch_blog() {
		
		$('.sidebar_option_wrapper, #category-blog').css('display', 'block');
		$('#category-portfolio').css('display','none');
		
		$('#nav-tab-blog').addClass('nav-tab-active');
		$('#nav-tab-portfolio').removeClass('nav-tab-active');		
		
		actual_category_template = 'blog';
		$('#category-blog').find('.sidebar_option_wrapper').css('display','none');
	}
	
	function switch_portfolio() {
		$('.sidebar_option_wrapper, #category-blog').css('display', 'none');
		$('#category-portfolio, .sidebar_option_wrapper, #category-portfolio-no').css('display', 'block');
		
		$('#nav-tab-blog').removeClass('nav-tab-active');
		$('#nav-tab-portfolio').addClass('nav-tab-active');
		
		actual_category_template = 'portfolio';
		
	}
	
	
	$('.cat_apply').hover(function() {
		console.log('hover');
		var offset = ( $(this).offset());
		$('#cat_apply_icon_tooltip').css( 'z-index',5);
		$('#cat_apply_icon_tooltip').css( 'top',offset.top );
		$('#cat_apply_icon_tooltip').css( 'left',160);
		$('#cat_apply_icon_tooltip').css( {'display': 'block', 'opacity':'0' }).stop().animate({'opacity':1}, 100);
	
	}, function() {
		$('#cat_apply_icon_tooltip').stop().css('display','none');
	} );
	
	
	$('#nav-tab-blog').click(function() {
		switch_blog();
	});
	
	$('#nav-tab-portfolio').click(function() {
		switch_portfolio();
	});
	
	function switch_subnav( subnav_name ) {
		$('#category-blog').find('.templates_wrapper').css('display','none');
		$('#category-blog-'+ subnav_name).css('display','block');		
		
		actual_category_subtemplate = subnav_name;
		if( subnav_name == 'no' )
			actual_category_subtemplate = 'fullwidth';
			
		$('#category-blog').find('.select_button').removeClass('nav-tab-active');
		$('#blog-subnav-'+ subnav_name).addClass( 'nav-tab-active' );
	}
	
	$('#blog-subnav-left').click(function() {
		switch_subnav('left');
	});
	
	
	$('#blog-subnav-right').click(function() {
		switch_subnav('right');
	});
	
	
	$('#blog-subnav-no').click(function() {
		switch_subnav('no');
	});
	
	$('#single-blog-subnav-right').click(function() {
		switch_single_subnav('right');
	});
	
	
	$('#single-blog-subnav-no').click(function() {
		switch_single_subnav('no');
	});
	
	
/**
 * MAGIC WAND
 */	

$('.cat_apply').click(function() {


	var depth = $(this).parent().attr('pos');
	depth = parseInt(depth);
	
	var cat_id = $(this).parent().attr('rel');
	
	
	var start = false;
	var end = false;
	
	$('#cat-list').find('li').each(function() {		
		if( parseInt($(this).attr('pos')) <= depth && start == true)
			end = true;
			
		if( start == true && end == false ) {
			var new_cat_id = $(this).attr('rel');
			var temp_id_store = actual_category_selected;
			actual_category_selected = new_cat_id;
			catman_save_data();
			actual_category_selected = temp_id_store;
			
			var cat_data = data_to_save_holder[cat_id]['category_data'];
		 	var sin_data = data_to_save_holder[cat_id]['single_data'];
		 	
		 	var cat_template = data_to_save_holder[cat_id]['category_template'];
			var sin_template = 	data_to_save_holder[cat_id]['single_template'];
			
			if( data_to_save_holder[new_cat_id] != undefined ) {
				data_to_save_holder[new_cat_id]['category_data'] = cat_data;
				data_to_save_holder[new_cat_id]['single_data'] = sin_data;
				data_to_save_holder[new_cat_id]['category_template'] = cat_template;
				data_to_save_holder[new_cat_id]['single_template'] = sin_template;
			} else {
				
				var data = {
					action: 'catman',
					subaction:'save',
					category_selected: new_cat_id,
					category_data: cat_data,
					single_data: sin_data,
					category_template: cat_template,
					single_template: sin_template
				};
				//console.log('xxx');
				data_to_save_holder[new_cat_id] = data;
			}
			var actual_margin = parseInt( $(this).css('margin-top'));
			
			$(this).css('position', 'relative').animate({'top':actual_margin + 10}, 100).animate({'top':actual_margin - 10}, 100).animate({'top':actual_margin}, 100, function() { $(this).css('position', 'static');} );			
		
				
		}
		
		if( $(this).attr('rel') == cat_id )
			start = true;		
		
	});
	
	

		
});


});




/*
json2.js
2011-10-19

Public Domain.

NO WARRANTY EXPRESSED OR IMPLIED. USE AT YOUR OWN RISK.

See http://www.JSON.org/js.html


This code should be minified before deployment.
See http://javascript.crockford.com/jsmin.html

USE YOUR OWN COPY. IT IS EXTREMELY UNWISE TO LOAD CODE FROM SERVERS YOU DO
NOT CONTROL.


This file creates a global JSON object containing two methods: stringify
and parse.

    JSON.stringify(value, replacer, space)
        value       any JavaScript value, usually an object or array.

        replacer    an optional parameter that determines how object
                    values are stringified for objects. It can be a
                    function or an array of strings.

        space       an optional parameter that specifies the indentation
                    of nested structures. If it is omitted, the text will
                    be packed without extra whitespace. If it is a number,
                    it will specify the number of spaces to indent at each
                    level. If it is a string (such as '\t' or '&nbsp;'),
                    it contains the characters used to indent at each level.

        This method produces a JSON text from a JavaScript value.

        When an object value is found, if the object contains a toJSON
        method, its toJSON method will be called and the result will be
        stringified. A toJSON method does not serialize: it returns the
        value represented by the name/value pair that should be serialized,
        or undefined if nothing should be serialized. The toJSON method
        will be passed the key associated with the value, and this will be
        bound to the value

        For example, this would serialize Dates as ISO strings.

            Date.prototype.toJSON = function (key) {
                function f(n) {
                    // Format integers to have at least two digits.
                    return n < 10 ? '0' + n : n;
                }

                return this.getUTCFullYear()   + '-' +
                     f(this.getUTCMonth() + 1) + '-' +
                     f(this.getUTCDate())      + 'T' +
                     f(this.getUTCHours())     + ':' +
                     f(this.getUTCMinutes())   + ':' +
                     f(this.getUTCSeconds())   + 'Z';
            };

        You can provide an optional replacer method. It will be passed the
        key and value of each member, with this bound to the containing
        object. The value that is returned from your method will be
        serialized. If your method returns undefined, then the member will
        be excluded from the serialization.

        If the replacer parameter is an array of strings, then it will be
        used to select the members to be serialized. It filters the results
        such that only members with keys listed in the replacer array are
        stringified.

        Values that do not have JSON representations, such as undefined or
        functions, will not be serialized. Such values in objects will be
        dropped; in arrays they will be replaced with null. You can use
        a replacer function to replace those with JSON values.
        JSON.stringify(undefined) returns undefined.

        The optional space parameter produces a stringification of the
        value that is filled with line breaks and indentation to make it
        easier to read.

        If the space parameter is a non-empty string, then that string will
        be used for indentation. If the space parameter is a number, then
        the indentation will be that many spaces.

        Example:

        text = JSON.stringify(['e', {pluribus: 'unum'}]);
        // text is '["e",{"pluribus":"unum"}]'


        text = JSON.stringify(['e', {pluribus: 'unum'}], null, '\t');
        // text is '[\n\t"e",\n\t{\n\t\t"pluribus": "unum"\n\t}\n]'

        text = JSON.stringify([new Date()], function (key, value) {
            return this[key] instanceof Date ?
                'Date(' + this[key] + ')' : value;
        });
        // text is '["Date(---current time---)"]'


    JSON.parse(text, reviver)
        This method parses a JSON text to produce an object or array.
        It can throw a SyntaxError exception.

        The optional reviver parameter is a function that can filter and
        transform the results. It receives each of the keys and values,
        and its return value is used instead of the original value.
        If it returns what it received, then the structure is not modified.
        If it returns undefined then the member is deleted.

        Example:

        // Parse the text. Values that look like ISO date strings will
        // be converted to Date objects.

        myData = JSON.parse(text, function (key, value) {
            var a;
            if (typeof value === 'string') {
                a =
/^(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2}):(\d{2}(?:\.\d*)?)Z$/.exec(value);
                if (a) {
                    return new Date(Date.UTC(+a[1], +a[2] - 1, +a[3], +a[4],
                        +a[5], +a[6]));
                }
            }
            return value;
        });

        myData = JSON.parse('["Date(09/09/2001)"]', function (key, value) {
            var d;
            if (typeof value === 'string' &&
                    value.slice(0, 5) === 'Date(' &&
                    value.slice(-1) === ')') {
                d = new Date(value.slice(5, -1));
                if (d) {
                    return d;
                }
            }
            return value;
        });


This is a reference implementation. You are free to copy, modify, or
redistribute.
*/

/*jslint evil: true, regexp: true */

/*members "", "\b", "\t", "\n", "\f", "\r", "\"", JSON, "\\", apply,
call, charCodeAt, getUTCDate, getUTCFullYear, getUTCHours,
getUTCMinutes, getUTCMonth, getUTCSeconds, hasOwnProperty, join,
lastIndex, length, parse, prototype, push, replace, slice, stringify,
test, toJSON, toString, valueOf
*/


//Create a JSON object only if one does not already exist. We create the
//methods in a closure to avoid creating global variables.

var JSON;
if (!JSON) {
JSON = {};
}

(function () {
'use strict';

function f(n) {
    // Format integers to have at least two digits.
    return n < 10 ? '0' + n : n;
}

if (typeof Date.prototype.toJSON !== 'function') {

    Date.prototype.toJSON = function (key) {

        return isFinite(this.valueOf())
            ? this.getUTCFullYear()     + '-' +
                f(this.getUTCMonth() + 1) + '-' +
                f(this.getUTCDate())      + 'T' +
                f(this.getUTCHours())     + ':' +
                f(this.getUTCMinutes())   + ':' +
                f(this.getUTCSeconds())   + 'Z'
            : null;
    };

    String.prototype.toJSON      =
        Number.prototype.toJSON  =
        Boolean.prototype.toJSON = function (key) {
            return this.valueOf();
        };
}

var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
    escapable = /[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
    gap,
    indent,
    meta = {    // table of character substitutions
        '\b': '\\b',
        '\t': '\\t',
        '\n': '\\n',
        '\f': '\\f',
        '\r': '\\r',
        '"' : '\\"',
        '\\': '\\\\'
    },
    rep;


function quote(string) {

//If the string contains no control characters, no quote characters, and no
//backslash characters, then we can safely slap some quotes around it.
//Otherwise we must also replace the offending characters with safe escape
//sequences.

    escapable.lastIndex = 0;
    return escapable.test(string) ? '"' + string.replace(escapable, function (a) {
        var c = meta[a];
        return typeof c === 'string'
            ? c
            : '\\u' + ('0000' + a.charCodeAt(0).toString(16)).slice(-4);
    }) + '"' : '"' + string + '"';
}


function str(key, holder) {

//Produce a string from holder[key].

    var i,          // The loop counter.
        k,          // The member key.
        v,          // The member value.
        length,
        mind = gap,
        partial,
        value = holder[key];

//If the value has a toJSON method, call it to obtain a replacement value.

    if (value && typeof value === 'object' &&
            typeof value.toJSON === 'function') {
        value = value.toJSON(key);
    }

//If we were called with a replacer function, then call the replacer to
//obtain a replacement value.

    if (typeof rep === 'function') {
        value = rep.call(holder, key, value);
    }

//What happens next depends on the value's type.

    switch (typeof value) {
    case 'string':
        return quote(value);

    case 'number':

//JSON numbers must be finite. Encode non-finite numbers as null.

        return isFinite(value) ? String(value) : 'null';

    case 'boolean':
    case 'null':

//If the value is a boolean or null, convert it to a string. Note:
//typeof null does not produce 'null'. The case is included here in
//the remote chance that this gets fixed someday.

        return String(value);

//If the type is 'object', we might be dealing with an object or an array or
//null.

    case 'object':

//Due to a specification blunder in ECMAScript, typeof null is 'object',
//so watch out for that case.

        if (!value) {
            return 'null';
        }

//Make an array to hold the partial results of stringifying this object value.

        gap += indent;
        partial = [];

//Is the value an array?

        if (Object.prototype.toString.apply(value) === '[object Array]') {

//The value is an array. Stringify every element. Use null as a placeholder
//for non-JSON values.

            length = value.length;
            for (i = 0; i < length; i += 1) {
                partial[i] = str(i, value) || 'null';
            }

//Join all of the elements together, separated with commas, and wrap them in
//brackets.

            v = partial.length === 0
                ? '[]'
                : gap
                ? '[\n' + gap + partial.join(',\n' + gap) + '\n' + mind + ']'
                : '[' + partial.join(',') + ']';
            gap = mind;
            return v;
        }

//If the replacer is an array, use it to select the members to be stringified.

        if (rep && typeof rep === 'object') {
            length = rep.length;
            for (i = 0; i < length; i += 1) {
                if (typeof rep[i] === 'string') {
                    k = rep[i];
                    v = str(k, value);
                    if (v) {
                        partial.push(quote(k) + (gap ? ': ' : ':') + v);
                    }
                }
            }
        } else {

//Otherwise, iterate through all of the keys in the object.

            for (k in value) {
                if (Object.prototype.hasOwnProperty.call(value, k)) {
                    v = str(k, value);
                    if (v) {
                        partial.push(quote(k) + (gap ? ': ' : ':') + v);
                    }
                }
            }
        }

//Join all of the member texts together, separated with commas,
//and wrap them in braces.

        v = partial.length === 0
            ? '{}'
            : gap
            ? '{\n' + gap + partial.join(',\n' + gap) + '\n' + mind + '}'
            : '{' + partial.join(',') + '}';
        gap = mind;
        return v;
    }
}

//If the JSON object does not yet have a stringify method, give it one.

if (typeof JSON.stringify !== 'function') {
    JSON.stringify = function (value, replacer, space) {

//The stringify method takes a value and an optional replacer, and an optional
//space parameter, and returns a JSON text. The replacer can be a function
//that can replace values, or an array of strings that will select the keys.
//A default replacer method can be provided. Use of the space parameter can
//produce text that is more easily readable.

        var i;
        gap = '';
        indent = '';

//If the space parameter is a number, make an indent string containing that
//many spaces.

        if (typeof space === 'number') {
            for (i = 0; i < space; i += 1) {
                indent += ' ';
            }

//If the space parameter is a string, it will be used as the indent string.

        } else if (typeof space === 'string') {
            indent = space;
        }

//If there is a replacer, it must be a function or an array.
//Otherwise, throw an error.

        rep = replacer;
        if (replacer && typeof replacer !== 'function' &&
                (typeof replacer !== 'object' ||
                typeof replacer.length !== 'number')) {
            throw new Error('JSON.stringify');
        }

//Make a fake root object containing our value under the key of ''.
//Return the result of stringifying the value.

        return str('', {'': value});
    };
}


//If the JSON object does not yet have a parse method, give it one.

if (typeof JSON.parse !== 'function') {
    JSON.parse = function (text, reviver) {

//The parse method takes a text and an optional reviver function, and returns
//a JavaScript value if the text is a valid JSON text.

        var j;

        function walk(holder, key) {

//The walk method is used to recursively walk the resulting structure so
//that modifications can be made.

            var k, v, value = holder[key];
            if (value && typeof value === 'object') {
                for (k in value) {
                    if (Object.prototype.hasOwnProperty.call(value, k)) {
                        v = walk(value, k);
                        if (v !== undefined) {
                            value[k] = v;
                        } else {
                            delete value[k];
                        }
                    }
                }
            }
            return reviver.call(holder, key, value);
        }


//Parsing happens in four stages. In the first stage, we replace certain
//Unicode characters with escape sequences. JavaScript handles many characters
//incorrectly, either silently deleting them, or treating them as line endings.

        text = String(text);
        cx.lastIndex = 0;
        if (cx.test(text)) {
            text = text.replace(cx, function (a) {
                return '\\u' +
                    ('0000' + a.charCodeAt(0).toString(16)).slice(-4);
            });
        }

//In the second stage, we run the text against regular expressions that look
//for non-JSON patterns. We are especially concerned with '()' and 'new'
//because they can cause invocation, and '=' because it can cause mutation.
//But just to be safe, we want to reject all unexpected forms.

//We split the second stage into 4 regexp operations in order to work around
//crippling inefficiencies in IE's and Safari's regexp engines. First we
//replace the JSON backslash pairs with '@' (a non-JSON character). Second, we
//replace all simple value tokens with ']' characters. Third, we delete all
//open brackets that follow a colon or comma or that begin the text. Finally,
//we look to see that the remaining characters are only whitespace or ']' or
//',' or ':' or '{' or '}'. If that is so, then the text is safe for eval.

        if (/^[\],:{}\s]*$/
                .test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, '@')
                    .replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']')
                    .replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {

//In the third stage we use the eval function to compile the text into a
//JavaScript structure. The '{' operator is subject to a syntactic ambiguity
//in JavaScript: it can begin a block or an object literal. We wrap the text
//in parens to eliminate the ambiguity.

            j = eval('(' + text + ')');

//In the optional fourth stage, we recursively walk the new structure, passing
//each name/value pair to a reviver function for possible transformation.

            return typeof reviver === 'function'
                ? walk({'': j}, '')
                : j;
        }

//If the text is not JSON parseable, then a SyntaxError is thrown.

        throw new SyntaxError('JSON.parse');
    };
}
}());
