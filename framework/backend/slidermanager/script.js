jQuery(document).ready(function($){
	
var media_upload_url = $('.wp_upload_media_holder').html();
add_media_upload_url();

function add_media_upload_url() {
	$('.add_media_slidermanager').remove();
	$('.input_img_wrapper').before(media_upload_url);
	reset_media_upload_url();
	
}	

reset_media_upload_url();

function reset_media_upload_url () {
	$('.table_holder').each( function() {
		var index = $(this).index();
		$(this).find('.thickbox').attr('media-upload-link', index);	
	});
}
	
$('.thickbox').attachMediaUploader('media-upload-link', function(url, attr) {
	$('.table_holder').eq(attr).find('.image_url').val(url);
	$('.table_holder').eq(attr).find('.fs_slide_preview').attr('src', url);
});
	
var template_url = $('.wp_template_url_holder').html();
/******************************************************************************************************************************
 * UI SETTINGS
 ******************************************************************************************************************************/
$('h2.nav-tab-wrapper').find('.nav-tab').click(function() {
	var linking_to = '#' + $(this).attr('linking-to');
	
	$('h2.nav-tab-wrapper').find('.nav-tab').removeClass('nav-tab-active');
	$(this).addClass('nav-tab-active');
	
	$('#post').find('.metabox-holder').css('display','none');
	$('#post').find(linking_to).css('display','block');
	//alert( $(this).attr('linking-to') );
	
	if( linking_to == '#preview') show_slider_preview();
	return false;
});

if( $('.show_settings_at_start').html() == 1 ) {
	var linking_to = '#' + 'settings';
	
	$('h2.nav-tab-wrapper').find('.nav-tab').removeClass('nav-tab-active');
	$(this).addClass('nav-tab-active');
	
	$('#post').find('.metabox-holder').css('display','none');
	$('#post').find(linking_to).css('display','block');
	//alert( $(this).attr('linking-to') );
	
	if( linking_to == '#preview') show_slider_preview();
	 
	
}


function show_slider_preview() {
	var iframe_src=  $('#slider_preview_url').html();
	var slider_name = $('#template_select').val();
	var src = iframe_src+'?show_slider_preview=yes&slider_preview_name='+slider_name;
	
	$('#slider_preview').load(function() {
		$('#slider_preview').contents().find('.slider_preview_holder').css('margin-top', 50);
		var slider_height = parseInt( $('#slider_preview').contents().find('.slider_preview_holder').height()) + 100;
	
		$('#slider_preview').height(slider_height);
	});
	
	$('#slider_preview').attr('src', iframe_src+'?show_slider_preview=yes&slider_preview_name='+slider_name);
	
}

/******************************************************************************************************************************
 * SLIDER ADD
 ******************************************************************************************************************************/
function create_ntd( action ) {
	action_text = 'Add New';
	if( action == 'rename' ) action_text = 'Rename';
	else if( action == 'duplicate' ) action_text = 'Duplicate';
	
	var ntd = ''; // New Template Dialog
	
	ntd += '<form method="POST">';
	ntd += '<div class="extra_wrapper"><div class="modal_header"><h2>' + action_text + ' Slider</h2></div>';
	
	ntd += '<div class="one_option_wrapper"><p><label for="new_slider_name">New Slider Name</label>';
	ntd += '<input type="text" name="new_slider_name">';
	ntd += '<span class="clear" style="display:block;"></span></p><div class="clear"></div></div>';
	
	
	//<div class="one_option_wrapper"><p><label for="title">Title</label><input id="title" name="title" type="text" value="Basic"><span class="clear" style="display:block;"></span></p><div class="clear"></div></div>
	if( action == 'add'){
		// 
		ntd += '<input type="hidden" name="new_slider_type" value="Accordeon">';
		//ntd += '<option value="Accordeon"> Slider Accordeon </option>';
		//ntd += '</select>';
	}
	
	
	
	//ntd += '<input type="submit" value="submit">';
	ntd += '<input type="hidden" name="fslidermanager_action" value="' + action + '">';
	
	if( action != 'add' ) ntd += '<input type="hidden" name="fslidermanager_actual_template" value="' + $('#template_select').val() + '">';
	
	ntd += '<span style="display:block;" class="clear"></span></p></div>';
	ntd += '<div class="modal_footer"><input type="submit" class="modal_button_close" value="Cancel"><input type="submit" class="modal_button_save" value="' + action_text + '"></div></div>';
	ntd += '</form>';
	return ntd;
}

function create_ntd_delete() {
	var ntd = ''; // New Template Dialog
	ntd += '<form method="POST">';
	ntd += '<div class="extra_wrapper"><div class="modal_header"><h2>Do you really want to delete it?</h2></div>';
 
	//ntd += '<input type="submit" value="Delete">';
	ntd += '<input type="hidden" name="fslidermanager_action" value="delete">';
	ntd += '<input type="hidden" name="fslidermanager_actual_template" value="' + $('#template_select').val() + '">';
	ntd += '<span style="display:block;" class="clear"></span></p></div>';
	ntd += '<div class="modal_footer"><input type="submit" class="modal_button_close" value="Cancel"><input type="submit" class="modal_button_save" value="Delete"></div></div>';
	ntd += '</form>';
	return ntd;	
}


	$('.btn_add').click(function() {
		ntd = create_ntd('add');
		//console.log(ntd);
		$.colorbox({html:ntd,width:700,height:700}); return false; 
	});
	
	$('.btn_delete').click(function() {
		//alert('xxx');
		var slider_name = $("#template_select").val();
		var answer = confirm ("Do you really want to delete the \"" + slider_name + "\" slider?");
		if( !(answer) )
				return false;		
					
		ntd = create_ntd_delete();
		
		$(ntd).appendTo('body').submit();
		//$.colorbox({html:ntd,width:700,height:700}); return false; 
		return false;
	 /*
	 	number_of_slides = $('#template_select').find('option').size();
	 	if( number_of_slides == 1)
	 		return false;
	 	ntd = create_ntd_delete();
		$.colorbox({html:ntd}); return false;*/ 
	});
	
	
	$('.btn_rename').click(function() {
	 	ntd = create_ntd('rename');
		$.colorbox({html:ntd,width:700,height:700}); return false; 
	});	
	
	$('.btn_duplicate').click(function() {
	 	ntd = create_ntd('duplicate');
		$.colorbox({html:ntd,width:700,height:700}); return false; 
	});		
	
	$('#template_select').change(function() {
	//	alert('aaa');
		var form = '<form method="POST"><input type="hidden" name="fslidermanager_actual_slider_id" value="' + $(this).val() + '"></form>"';
		$(form).appendTo('body').submit();
	});
	
/******************************************************************************************************************************
 * SLIDE ADD & REMOVE
 ******************************************************************************************************************************/	
$('.add_slide_btn').click(function() {
	var new_slide_2 = '<div class="table_holder">' + $('.table_holder').html() + '</div>';
	//alert(new_slide_2);
	$('#table_content_holder').prepend(new_slide);
	find_proper_transition();
	hide_last_arrows();
	add_media_upload_url();
	return false;
});

function find_proper_transition() {
	var transitions = $('#table_content_holder').find('.table_holder').last().find('.transition').html();
	var transition_selected = $('#table_content_holder').find('.table_holder').last().find('.transition').val();
	
	$('#table_content_holder').find('.table_holder').first().find('.transition').html( transitions );
	$('#table_content_holder').find('.table_holder').first().find('.transition').val( transition_selected );
	
	
}

$('.img_remove_holder').live('click',function() {
	$(this).parents().eq(4).animate({opacity:0},150, function() { $(this).remove(); hide_last_arrows();} );
	
	return false;
});

/******************************************************************************************************************************
 * SLIDE UP AND DOWN
 ******************************************************************************************************************************/	
function hide_last_arrows() { 
	$('.move_up, .move_down').css('display','block');
	$('.move_up').eq(0).css('display','none');
	$('.move_down').last().css('display','none');
}

hide_last_arrows();

$('.move_up').live('click', function() {
	
	var table_holder_old = $(this).parents().eq(4);
	//alert( table_holder_old.index() );
	//alert(table_holder_old.attr('class'));
	var table_holder_new = table_holder_old.prev();

	table_holder_old.animate({opacity:0}, 450, function() {
		table_holder_old.css('display','none').css('opacity',0);
		table_holder_old.after(table_holder_new);
		table_holder_old.css('display', 'block');
		table_holder_old.animate({opacity:1}, 700);	
		hide_last_arrows();
		reset_media_upload_url();
	});
	//table_holder_new.css('opacity', 0.5);
});

$('.move_down').live('click', function() {
	var table_holder_old = $(this).parents().eq(4);
	//alert( table_holder_old.index() );
	//alert(table_holder_old.attr('class'));
	var table_holder_new = table_holder_old.next();


	table_holder_old.animate({opacity:0}, 450, function() {
		table_holder_old.css('display','none').css('opacity',0);
		table_holder_old.before(table_holder_new);
		table_holder_old.css('display', 'block');
		table_holder_old.animate({opacity:1}, 700);	
		hide_last_arrows();
		reset_media_upload_url();
	});
	
	//table_holder_new.css('opacity', 0.5);
});

/******************************************************************************************************************************
 * SLIDE IMAGE DYNAMIC LOADING
 ******************************************************************************************************************************/	
function load_slide_preview_image( slide_input ) {
	var src = slide_input.val();
	slide_input.parent().parent().find('.fs_slide_preview').attr('src', src);
}
$('.image_url').live('change', function() {
	var url_value = $(this).val();
	//$(this).delay(1000).queue(function(nxt) {

			load_slide_preview_image( $(this) );
//	});
});
/******************************************************************************************************************************
 * SLIDER SERIALIZE
 ******************************************************************************************************************************/	
$('.theme_options_save').click(function() {
	$('#freshslider').children('form').animate({opacity:0.5},50);
	$('.options_header').find('.loading_spin').css('display','block');
	serialize_slider();
	return false;
});

$('#foptions-slider_options-slider_type').change(function() {
	serialize_slider(1);
	return false;
});
function serialize_slider( settings_page) {
	var slider = {};
	slider['slides'] = {};
	slider['settings'] = {};
	
	// serialize all slides
	$('#table_content_holder').find('.table_holder').each(function(index){
		var slide = {};
		$(this).find(':input').each(function() {
			//console.log($(this).attr('class'));
			slide[ $(this).attr('class') ] = $(this).val();
		});
		slider['slides'][index] = slide;
	});
	
	
	// serialize slider settings
	
	var setting = {};
	//alert(index);
	$('#settings').find('.options_table').find(':input').each(function() {
		//console.log($(this).attr('class'));
		var name = $(this).attr('name');
		name = name.replace('foptions-slider_options-', '');
		if( $(this).attr('type') == 'checkbox' ) {
			//alert( $(this).attr('checked') );
			if( $(this).attr('checked') == 'checked' )
				setting[ name] = 1;
			else 
				setting[ name] = 0;
		} else {
			setting[ name] = $(this).val();
		}
	});
	slider['settings'] = setting;		
	
	slider =JSON.stringify( slider); //$(slider).toJSON();
	var frm = '';
	frm = frm + '<form method="POST" class="slider_data_sender">';
	frm = frm + '<input type="hidden" name="fslidermanager_action" value="save">';
	frm = frm + '<input type="hidden" name="slider_data">';
	frm = frm + '<input type="hidden" name="fslidermanager_actual_slider_id">';
	frm = frm + '<input type="hidden" name="fslidermanager_show_settings_page">';
	frm = frm + '</form>';
	//foptions-slider_options-slider_type
	//var frm2 = $('body').append(frm);
	frm2 = $(frm).appendTo('body');
	frm2.find('input[name=slider_data]').val(slider);
	frm2.find('input[name=fslidermanager_actual_slider_id]').val( $('#template_select').val() );
	frm2.find('input[name=fslidermanager_show_settings_page]').val( settings_page );
	frm2.appendTo('body').submit();
	
//	console.log(slider);
	
}
	

/******************************************************************************************************************************
 * SLIDER DATA
 ******************************************************************************************************************************/	
var new_slide = '<div class="table_holder"><table cellspacing="0" class="widefat tag fixed fs_slide_box table_id_"><thead><tr><th style="" class="manage-column" id="fs_head_order" scope="col">Order</th><th style="" class="manage-column column-description" id="fs_head_settings" scope="col">Slide Settings</th><th style="" class="manage-column column-posts num" id="fs_head_remove" scope="col">Remove</th></tr></thead><tbody class="list:tag" id="the-list"><tr class="alternate" id="tag-22"><td class="name column-name"><div class="move_up" style="float:left;" title=""><img src="' + template_url + '/framework/backend/slidermanager/images/arrow_up.png" style="cursor:pointer; margin-right:10px;"></div><div class="move_down" style="float:left;" title=""><img src="' + template_url + '/framework/backend/slidermanager/images/arrow_down.png" style="cursor:pointer;"></div><img class="fs_slide_preview" src=""></td><td class="name column-name"><div class="input_img_wrapper"><input type="text" class="image_url" value="" id="fs_image_url" name="image_url" onblur="if (this.value == "") {this.value = "Image URL";}" onfocus="if (this.value == "Image URL") {this.value = "";}"></div><select name="link_type" class="lightbox" id="fs_link_type"><option value="url">Go to URL</option><option value="lightbox">Open Lightbox</option><option value="do_nothing">Do Nothing</option></select><input class="link_url" type="text" value="Link URL" id="fs_link_url" name="link_url" onfocus="if (this.value == \'Link URL\') {this.value = \'\';}"><select name="transition" class="transition" id="fs_transition"><option value="random">Transition Random</option></select><input type="text" class="alt" value="Title" id="fs_title" name="alt"><label class="description_label" for="fs_description">Description</label> <textarea rows="10" class="description" id="fs_description" name="description"></textarea><input type="hidden" name="object_id_" value=""></td><td class="name column-name" style="text-align:center;"><a href="" class="img_remove_holder"><img class="img_remove" src="' + template_url + '/framework/backend/slidermanager/images/remove.png"></a></td></tr></tbody></table></div>';
});




/*
jQuery.fn.toJSON = function( )
{
	var json_to_retun = '';
	var o = jQuery(this);
	json_to_retun = JSON.stringify( o );
	return json_to_retun;
/*	for( var key in o ) {
		
	}
	console.log( jQuery(this) );
	return 'xxx';
/*    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;*/
//};

/*
    http://www.JSON.org/json2.js
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


// Create a JSON object only if one does not already exist. We create the
// methods in a closure to avoid creating global variables.

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

// If the string contains no control characters, no quote characters, and no
// backslash characters, then we can safely slap some quotes around it.
// Otherwise we must also replace the offending characters with safe escape
// sequences.

        escapable.lastIndex = 0;
        return escapable.test(string) ? '"' + string.replace(escapable, function (a) {
            var c = meta[a];
            return typeof c === 'string'
                ? c
                : '\\u' + ('0000' + a.charCodeAt(0).toString(16)).slice(-4);
        }) + '"' : '"' + string + '"';
    }


    function str(key, holder) {

// Produce a string from holder[key].

        var i,          // The loop counter.
            k,          // The member key.
            v,          // The member value.
            length,
            mind = gap,
            partial,
            value = holder[key];

// If the value has a toJSON method, call it to obtain a replacement value.

        if (value && typeof value === 'object' &&
                typeof value.toJSON === 'function') {
            value = value.toJSON(key);
        }

// If we were called with a replacer function, then call the replacer to
// obtain a replacement value.

        if (typeof rep === 'function') {
            value = rep.call(holder, key, value);
        }

// What happens next depends on the value's type.

        switch (typeof value) {
        case 'string':
            return quote(value);

        case 'number':

// JSON numbers must be finite. Encode non-finite numbers as null.

            return isFinite(value) ? String(value) : 'null';

        case 'boolean':
        case 'null':

// If the value is a boolean or null, convert it to a string. Note:
// typeof null does not produce 'null'. The case is included here in
// the remote chance that this gets fixed someday.

            return String(value);

// If the type is 'object', we might be dealing with an object or an array or
// null.

        case 'object':

// Due to a specification blunder in ECMAScript, typeof null is 'object',
// so watch out for that case.

            if (!value) {
                return 'null';
            }

// Make an array to hold the partial results of stringifying this object value.

            gap += indent;
            partial = [];

// Is the value an array?

            if (Object.prototype.toString.apply(value) === '[object Array]') {

// The value is an array. Stringify every element. Use null as a placeholder
// for non-JSON values.

                length = value.length;
                for (i = 0; i < length; i += 1) {
                    partial[i] = str(i, value) || 'null';
                }

// Join all of the elements together, separated with commas, and wrap them in
// brackets.

                v = partial.length === 0
                    ? '[]'
                    : gap
                    ? '[\n' + gap + partial.join(',\n' + gap) + '\n' + mind + ']'
                    : '[' + partial.join(',') + ']';
                gap = mind;
                return v;
            }

// If the replacer is an array, use it to select the members to be stringified.

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

// Otherwise, iterate through all of the keys in the object.

                for (k in value) {
                    if (Object.prototype.hasOwnProperty.call(value, k)) {
                        v = str(k, value);
                        if (v) {
                            partial.push(quote(k) + (gap ? ': ' : ':') + v);
                        }
                    }
                }
            }

// Join all of the member texts together, separated with commas,
// and wrap them in braces.

            v = partial.length === 0
                ? '{}'
                : gap
                ? '{\n' + gap + partial.join(',\n' + gap) + '\n' + mind + '}'
                : '{' + partial.join(',') + '}';
            gap = mind;
            return v;
        }
    }

// If the JSON object does not yet have a stringify method, give it one.

    if (typeof JSON.stringify !== 'function') {
        JSON.stringify = function (value, replacer, space) {

// The stringify method takes a value and an optional replacer, and an optional
// space parameter, and returns a JSON text. The replacer can be a function
// that can replace values, or an array of strings that will select the keys.
// A default replacer method can be provided. Use of the space parameter can
// produce text that is more easily readable.

            var i;
            gap = '';
            indent = '';

// If the space parameter is a number, make an indent string containing that
// many spaces.

            if (typeof space === 'number') {
                for (i = 0; i < space; i += 1) {
                    indent += ' ';
                }

// If the space parameter is a string, it will be used as the indent string.

            } else if (typeof space === 'string') {
                indent = space;
            }

// If there is a replacer, it must be a function or an array.
// Otherwise, throw an error.

            rep = replacer;
            if (replacer && typeof replacer !== 'function' &&
                    (typeof replacer !== 'object' ||
                    typeof replacer.length !== 'number')) {
                throw new Error('JSON.stringify');
            }

// Make a fake root object containing our value under the key of ''.
// Return the result of stringifying the value.

            return str('', {'': value});
        };
    }


// If the JSON object does not yet have a parse method, give it one.

    if (typeof JSON.parse !== 'function') {
        JSON.parse = function (text, reviver) {

// The parse method takes a text and an optional reviver function, and returns
// a JavaScript value if the text is a valid JSON text.

            var j;

            function walk(holder, key) {

// The walk method is used to recursively walk the resulting structure so
// that modifications can be made.

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


// Parsing happens in four stages. In the first stage, we replace certain
// Unicode characters with escape sequences. JavaScript handles many characters
// incorrectly, either silently deleting them, or treating them as line endings.

            text = String(text);
            cx.lastIndex = 0;
            if (cx.test(text)) {
                text = text.replace(cx, function (a) {
                    return '\\u' +
                        ('0000' + a.charCodeAt(0).toString(16)).slice(-4);
                });
            }

// In the second stage, we run the text against regular expressions that look
// for non-JSON patterns. We are especially concerned with '()' and 'new'
// because they can cause invocation, and '=' because it can cause mutation.
// But just to be safe, we want to reject all unexpected forms.

// We split the second stage into 4 regexp operations in order to work around
// crippling inefficiencies in IE's and Safari's regexp engines. First we
// replace the JSON backslash pairs with '@' (a non-JSON character). Second, we
// replace all simple value tokens with ']' characters. Third, we delete all
// open brackets that follow a colon or comma or that begin the text. Finally,
// we look to see that the remaining characters are only whitespace or ']' or
// ',' or ':' or '{' or '}'. If that is so, then the text is safe for eval.

            if (/^[\],:{}\s]*$/
                    .test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, '@')
                        .replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']')
                        .replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {

// In the third stage we use the eval function to compile the text into a
// JavaScript structure. The '{' operator is subject to a syntactic ambiguity
// in JavaScript: it can begin a block or an object literal. We wrap the text
// in parens to eliminate the ambiguity.

                j = eval('(' + text + ')');

// In the optional fourth stage, we recursively walk the new structure, passing
// each name/value pair to a reviver function for possible transformation.

                return typeof reviver === 'function'
                    ? walk({'': j}, '')
                    : j;
            }

// If the text is not JSON parseable, then a SyntaxError is thrown.

            throw new SyntaxError('JSON.parse');
        };
    }
}());