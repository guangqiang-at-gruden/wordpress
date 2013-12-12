var ffGFonts_loaded_list = new Array();
var ffURLFonts_loaded_list = new Array();

jQuery(document).ready(function($) {

    function ffURLFonts_load_font( url ){
        if( url ){

            font_name = url;
            font_name = font_name.split('/');
            font_name = font_name[ font_name.length -1 ];

            if( ffURLFonts_loaded_list[ font_name ] ) {
                return;
            }

            ffURLFonts_loaded_list[ font_name ] = 1;
            
            font_ext = font_name;
            font_ext = font_ext.split(".");
            font_ext = font_ext[ font_ext.length - 1 ];

            // INCLUDE STYLE
            style  = "<style type='text/css'>@font-face {";
            style += "font-family: '"+font_name+"';";
            style += "src: url('"+url+"')";

            switch(font_ext) {
                case 'eot':  style += " format('embedded-opentype');\n"; break;
                case 'woff': style += " format('woff');\n"; break;
                case 'ttf':  style += " format('truetype');\n"; break;
                case 'svg':  style += " format('svg');\n"; break;
                default:     style += ";\n";/* Unknown font format */ break;
            }

            style += ";";
            style += "font-weight: normal;";
            style += "font-style: normal;";
            style += "}";
            style += "</style>";

            $('body').append( style );
        }
    }

    function ffGFonts_load_font( name ){
        if( name ){
            name = name.replace(' ','+');

            if( ffGFonts_loaded_list[ name ] ) {
                return;
            }

            ffGFonts_loaded_list[ name ] = 1;

            // INCLUDE GOOGLE FONT LINK

            link = '//fonts.googleapis.com/css?family=';
            subsets = ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';

            $('body').append("<link href='" + link + name + subsets + "' rel='stylesheet' type='text/css'>'");
        }
    }

    $('.fontPickerType').change( function (){
        _id = $(this).attr('data-font-field-id');
        _val = $(this).val();
        if( ! _val ) _val = '';
        $('#'+_id+'_fontPickerWrapper .fontPickerGoogleSelect').parent().css('display', ( 'google-alpha' == _val )?'block':'none' );
        $('#'+_id+'_fontPickerWrapper .fontPickerGoogleSelectPopularity').parent().css('display', ( 'google-popularity' == _val )?'block':'none' );
        $('#'+_id+'_fontPickerWrapper .fontPickerURL').parent().css('display', ( 'url' == _val )?'block':'none' );

        $('#'+_id+'_fontPickerWrapper .fontPicker').parent().css('display', 'none' );

        if( 'url' == _val ){
            url = $('#'+_id+'_fontPickerWrapper .fontPickerURL').val();
            new_font_name = url;
            new_font_name = new_font_name.split('/');
            new_font_name = new_font_name[ new_font_name.length -1 ];
            $('#'+_id+'_fontPickerWrapper .fontPicker').val( new_font_name );
            ffURLFonts_load_font( url );
        }else if( '' == _val ){
            $('#'+_id+'_fontPickerWrapper .fontPicker').val('');
        }else{ // google
            ffGFonts_load_font( $('#' + _id).val() );
        }
        $('.fontPickerShowCaseActivate').click();
    }).change();

    $('.fontPickerGoogleSelectPopularity').change( function (){
        _id = $(this).attr('data-font-field-id');
        $('#' + _id + '_fontPickerGoogleSelect').val( $(this).val() );
        $('#' + _id + '_fontPickerGoogleSelect').change();
    });

    $('.fontPickerGoogleSelect').change( function (){
        _id = $(this).attr('data-font-field-id');
        _val = $(this).val();
        if( ! _val ){
            return;
        }
        $('#'+_id).val( _val );
        $('#'+_id+'_fontPickerWrapper .fontPickerShowCase p').css( 'font-family', _val );

        $('#'+_id+'_fontPickerGoogleSelectPopularity').val( $(this).val() );
    });

    $('.fontPickerURL').change(  function (){ $('.fontPickerType').change(); });
    $('.fontPickerURL').keypress( function (){
        setTimeout(function (){ $('.fontPickerType').change(); },50);
    });

    $('.fontPickerGoogleSelect').click(  function (){ $('.fontPickerType').change(); });
    $('.fontPickerGoogleSelect').change( function (){ $('.fontPickerType').change(); });

    $('.fontPickerCursive').click(  function (){ $('.fontPickerShowCaseActivate').click(); });
    $('.fontPickerCursive').change( function (){ $('.fontPickerShowCaseActivate').click(); });

    $('.fontPickerWeight').click(  function (){ $('.fontPickerShowCaseActivate').click(); });
    $('.fontPickerWeight').change( function (){ $('.fontPickerShowCaseActivate').click(); });

    $('.fontPickerFallBack').change( function (){ $('.fontPickerShowCaseActivate').click(); });
    $('.fontPickerFallBack').keypress( function (){
        setTimeout(function (){ $('.fontPickerShowCaseActivate').click(); },50);
    });

    $('.fontPickerShowCaseActivate').click( function (){

        _id = $(this).attr('data-font-field-id');

        _fontType    = $('#' + _id + '_fontPickerType').val();
        _fontFamily  = $('#' + _id).val();
        _fontFallBack= $('#' + _id + '_fontPickerFallBack').val();
        _fontWeight  = $('#' + _id + '_fontPickerWeight').val();
        _fontCursive = 1 * $('#' + _id + '_fontPickerCursive').val();

        if( ! _fontFamily ){ _fontFamily = ''; }
        if( ! _fontFallBack ){ _fontFallBack = 'Helvetica, Sans-Serif'; }
        if( ! _fontWeight ){ _fontWeight = 400; }

        if( '' == _fontFamily ){
            _fontFamily = _fontFallBack;
        }else{
            _fontFamily = "'" + _fontFamily + "' , " + _fontFallBack;
        }

        $('#'+_id+'_fontPickerWrapper .fontPickerShowCode p').html( 'font-family: ' + _fontFamily );

        $('#'+_id+'_fontPickerWrapper .fontPickerShowCase p')
            .css( 'font-family', _fontFamily  )
            .css( 'font-style', 1==_fontCursive ? 'italic' : 'normal' )
            .css( 'font-weight', _fontWeight );
        return false;
    }).click();

    $('#foptions-fontfamily-use-defined-fonts').change( function (){
        _use_defined_fonts = $('#foptions-fontfamily-use-defined-fonts').is(':checked') ? false : true;
        if( _use_defined_fonts ){
            $('.fontPickerWrapper').each(function( index ) {
                $(this).parents('tr:first').hide();
            });
        }else{
            $('.fontPickerWrapper').each(function( index ) {
                $(this).parents('tr:first').show();
            });
        }
    }).change();
});
