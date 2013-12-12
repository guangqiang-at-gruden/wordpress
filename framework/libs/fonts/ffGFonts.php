<?php

// It throws some errors - so this will fix it
if( ! class_exists('ffGFonts') ) {

class ffGFonts{
    static $instance;
    protected $gFontsAlpha;
    protected $gFontsPopularity;

    static function getInstance(){
        return self::$instance = ( empty(self::$instance) ? new ffGFonts() : self::$instance );
    }
    
    function addFontMimes($mimes) {
        $mimes[ 'ttf' ] = 'application/octet-stream';
        $mimes[ 'eot' ] = 'application/vnd.ms-fontobject';
        $mimes[ 'svg' ] = 'image/svg+xml';
        $mimes[ 'woff' ] = 'application/x-font-woff';
        return $mimes;
    }
    
    function __construct(){

        $list = file_get_contents( dirname(__FILE__).'/fontsAlpha.txt' );
        $list = json_decode($list);

        $this->gFontsAlpha = array();
        foreach ($list->items as $key=>$value) {
            $this->gFontsAlpha[ $value->family ] = array(
                'type' => 'sans-serif',
                'variants' => $value->variants,
                'subsets'  => $value->subsets,
            );
        }

        $list = file_get_contents( dirname(__FILE__).'/fontsPopularity.txt' );
        $list = json_decode($list);

        $this->gFontsPopularity = array();
        foreach ($list->items as $key=>$value) {
            $this->gFontsPopularity[ $value->family ] = array(
                'type' => 'sans-serif',
                'variants' => $value->variants,
                'subsets'  => $value->subsets,
            );
        }
    }
    
    function printFontCSS(){
        if( fOpt::Get('fontfamily', 'use-defined-fonts') ){
            $this->printGoogleCSSOnFonts(
                array('menu','pagetitle','headings','text','button','blogpreviousnext','dropcap','sidemenu','faq','pricing'),
                get_template_directory().'/css/fonts_template.css'
            );
        }else{
            echo "<link href='".get_template_directory_uri()."/css/fonts_template.css' rel='stylesheet' type='text/css'>";
        }
    }

    protected $gFontsTypes = array(
                  'sans-serif' => 'Sans-serif',
                  'serif' => 'Serif',
                  'cursive' => 'Cursive',
    );
    
    function printGoogleCSSLink($fonts){
        if( empty($fonts) ){
            return;
        }
        echo "<link rel='stylesheet' href='";
        echo "http://fonts.googleapis.com/css?family=";
        if( ! is_array($fonts) ){
            $fonts = array( $fonts );
        }
        foreach ($fonts as $key=>$font) {
            echo str_replace(' ','+',$font);
            //echo ":";
            echo "|";
        }
        //echo "&subset=";
        //echo implode(",",$this->gFontsPopularity[$font]['subsets']);
        echo "' type='text/css' media='all' />";
    }
    
    function printGoogleCSSOnFonts( $items, $css_template ){
        //$items = array('menu','headings','text','dropcap');
        //fOpt::Get($ns,$n.'_fontPickerIsGoogleFontChecker')

        $fonts_to_include = array();

        $fonts_URL = array();

        foreach ($items as $key=>$item) {

            $fpt = fOpt::Get( 'fontfamily', $item . '_fontPickerType' );
            if( ( 'google-alpha' == $fpt ) or ( 'google-popularity' == $fpt ) ) {
                $font = fOpt::Get('fontfamily', $item);

                $font_key = $font;

                if( FALSE !== strpos($font_key, ',') ){
                    $font_key = explode(',',$font_key);
                    $font_key = trim($font_key[0]);
                }
                $fonts_to_include[ $font_key ] = $font_key;
            }else if( 'url' == $fpt ){
                if( ! empty( $fonts_URL[$fontUrl] ) ){
                    continue;
                }
                
                echo "<style type='text/css'>";

                $fontUrl = fOpt::Get( 'fontfamily', $item . '_fontPickerURL' );
                $fontName = explode("/",$fontUrl);
                $fontName = $fontName[ count($fontName) - 1 ];

                echo "@font-face {\n";
                echo "  font-family: '$fontName';\n";

                $fontExt = explode(".",$fontName);
                $fontExt = $fontExt[ count($fontExt) - 1 ];
                
                echo "  ";
                switch ($fontExt) {
                    case 'eot':  echo "src: url('$fontUrl') format('embedded-opentype');\n"; break;
                    case 'woff': echo "src: url('$fontUrl') format('woff');\n"; break;
                    case 'ttf':  echo "src: url('$fontUrl') format('truetype');\n"; break;
                    case 'svg':  echo "src: url('$fontUrl') format('svg');\n"; break;
                    default:     echo "src: url('$fontUrl'); /* Unknown font format */\n"; break;
                }

                echo "  font-weight: normal;\n";
                echo "  font-style: normal;\n";
                echo "}\n";
                echo "</style>\n";
                $fonts_URL[$fontUrl] = 1;
            }
        }
        
        $this->printGoogleCSSLink($fonts_to_include);

        $css = file_get_contents($css_template);
        foreach ($items as $key=>$item) {
            $fontfamily = "'".fOpt::Get('fontfamily', $item)."', "
                          .fOpt::Get('fontfamily', $item . '_fontPickerFallBack');

            $css = str_replace("/*font-family: $item;*/", "font-family: $fontfamily;", $css);

            $fontweight = fOpt::Get('fontfamily', $item . '_fontPickerWeight');
            $css = str_replace("/*font-weight: $item;*/", "font-weight: $fontweight;", $css);

            $fontstyle = fOpt::Get('fontfamily', $item . '_fontPickerCursive') * 1 ? 'italic' : 'normal';
            $css = str_replace("/*font-style: $item;*/", "font-style: $fontstyle;", $css);
        }

        echo "<style type='text/css'>";
        echo $css;
        echo "</style>";

        //echo '<pre>'; echo $css; echo '</pre>';

    }

    function printComponent($id, $fontFamily, $pickerType, $fontURL, $cursive, $fontWeight){
        echo $this->getComponent($id, $fontFamily, $pickerType, $fontURL, $cursive, $fontWeight);
    }

    function getComponent($id, $fontFamily, $fontFallBack, $pickerType, $fontURL, $cursive, $fontWeight){
        if( empty($fontWeight) ) {
            $fontWeight = 400;
        }
        
        if( empty($fontFallBack) ){
            $fontFallBack = "Helvetica, Sans-Serif";
        }
        
        $cursive = 1 * $cursive;


        $ret = '';

        // WRAPPER START

        $ret .= '<div ';
        $ret .= ' class="fontPickerWrapper" id="'.$id.'_fontPickerWrapper" data-font-field-id="'.$id.'" ';
        $ret .= ' style="overflow:hidden;clear:both">';

        $ret .= '<div style="overflow:hidden; padding-right:20px; float: left">';

        // FONT SOURCE

        $ret .= '<p class="one_option_wrapper">';
        $ret .= '<label for="'.$id.'_fontPickerType" style="width:100px;display:inline-block">Main font: </label>';

        $ret .= '<select ';
        $ret .= ' class="fontPickerType" id="'.$id.'_fontPickerType" name="'.$id.'_fontPickerType" data-font-field-id="'.$id.'" ';
        $ret .= ' style="width:200px">';
        $ret .= '<option value=""' . ( ( '' == $pickerType ) ? ' selected="selected"' : '' ) . '>None</option>';
        $ret .= '<option value="google-alpha"' . ( ( 'google-alpha' == $pickerType ) ? ' selected="selected"' : '' ) . '>Google Fonts - by alphabet</option>';
        $ret .= '<option value="google-popularity"' . ( ( 'google-popularity' == $pickerType ) ? ' selected="selected"' : '' ) . '>Google Fonts - by popularity</option>';
        $ret .= '<option value="url"' . ( ( 'url' == $pickerType ) ? ' selected="selected"' : '' ) . '>From URL / Upload font</option>';
        $ret .= '</select>';

        $ret .= '</p><p class="one_option_wrapper">';

        // GOOGLE FONTS - ALPHABET

        $ret .= '<label for="'.$id.'_fontPickerGoogleSelect" style="width:100px;display:inline-block">Google font: </label>';
        $ret .= '<select class="fontPickerGoogleSelect" id="'.$id.'_fontPickerGoogleSelect" data-font-field-id="'.$id.'" style="width:200px" >';
        $ret .= '<option style="color:Silver" value="">- Choose Google Font -</option>';
        foreach ($this->gFontsAlpha as $fontName=>$fontData) {
            $ret .= '<option value="'.$fontName.'"' . ( ( $fontName == $fontFamily ) ? ' selected="selected"' : '' ) . '>' . $fontName . '</option>';
        }
        $ret .= '<select>';

        $ret .= '</p><p class="one_option_wrapper">';

        // GOOGLE FONTS - POPULARITY

        $ret .= '<label for="'.$id.'_fontPickerGoogleSelectPopularity" style="width:100px;display:inline-block">Google font: </label>';
        $ret .= '<select class="fontPickerGoogleSelectPopularity" id="'.$id.'_fontPickerGoogleSelectPopularity" data-font-field-id="'.$id.'" style="width:200px" >';
        $ret .= '<option style="color:Silver" value="">- Choose Google Font -</option>';
        foreach ($this->gFontsPopularity as $fontName=>$fontData) {
            $ret .= '<option value="'.$fontName.'"' . ( ( $fontName == $fontFamily ) ? ' selected="selected"' : '' ) . '>' . $fontName . '</option>';
        }
        $ret .= '<select>';

        $ret .= '</p><p class="one_option_wrapper">';

        // FONT URL

        $ret .= '<label for="'.$id.'_fontPickerURL" style="width:100px;display:inline-block">Font URL:</label>';
        $ret .= '<input ';
        $ret .= ' class="fontPickerURL" id="'.$id.'_fontPickerURL" name="'.$id.'_fontPickerURL" ';
        $ret .= 'type="text" value="'.$fontURL.'" ';
        $ret .= ' style="width:165px" />';
        
        $ret .= '<span style="display:inline-block;width:35px;">';
        $ret .= '<a href="'.site_url().'/wp-admin/media-upload.php?TB_iframe=1&amp;width=640&amp;height=389" ';
        $ret .= 'media-upload-link="'.$id.'_fontPickerURL" ';
        $ret .= 'class="thickbox add_media button " style="width:100%;" ';
        $ret .= 'onclick="return false;">...</a>';
        $ret .= '</span>';

        $ret .= '</p><p class="one_option_wrapper">';

        // FONT FAMILY

        $ret .= '<label for="'.$id.'" style="width:100px;display:inline-block">Font family: </label>';
        $ret .= '<input ';
        $ret .= ' class="fontPicker" id="'.$id.'" name="'.$id.'" ';
        $ret .= 'type="text" value="'.$fontFamily.'" ';
        $ret .= ' style="width:200px" />';

        $ret .= '</p><p class="one_option_wrapper">';
        
        // FONT FALLBACK

        $ret .= '<label for="'.$id.'_fontPickerFallBack" style="width:100px;display:inline-block">Font Fallback: </label>';

        $ret .= '<input ';
        $ret .= ' class="fontPickerFallBack" id="'.$id.'_fontPickerFallBack" name="'.$id.'_fontPickerFallBack" ';
        $ret .= 'type="text" value="'.$fontFallBack.'" ';
        $ret .= ' style="width:200px" />';


        $ret .= '<span style="display:inline-block;width:30px;display:none;">';
        $ret .= '<a href="#" class="fontPickerShowCaseActivate button" data-font-field-id="'.$id.'" style="background: url(./images/yes.png) no-repeat center center;width:100%">';
        $ret .= ' &nbsp; ';
        $ret .= '</a>';
        $ret .= '</span>';


        $ret .= '</p><p class="one_option_wrapper">';

        // FONT CURSIVE OR NOT

        $ret .= '<label for="'.$id.'_fontPickerCursive" style="width:100px;display:inline-block">Font style: </label>';
        $ret .= '<select ';
        $ret .= ' class="fontPickerCursive" id="'.$id.'_fontPickerCursive" name="'.$id.'_fontPickerCursive" ';
        $ret .= ' style="width:200px">';
        $ret .= '<option value="0"' . (  empty($cursive) ? ' selected="selected"' : '' ) . '>Normal</option>';
        $ret .= '<option value="1"' . ( !empty($cursive) ? ' selected="selected"' : '' ) . '>Cursive</option>';
        $ret .= '</select>';

        $ret .= '</p><p class="one_option_wrapper">';

        $ret .= '<label for="'.$id.'_fontPickerWeight" style="width:100px;display:inline-block">Font weight: </label>';

        $fontWeights = array(
            100 => '100',
            200 => '200',
            300 => '300',
            400 => '400 - normal',
            500 => '500',
            600 => '600',
            700 => '700 - bold',
            800 => '800',
            900 => '900',
        );
        
        $ret .= '<select ';
        $ret .= ' class="fontPickerWeight" id="'.$id.'_fontPickerWeight" name="'.$id.'_fontPickerWeight" ';
        $ret .= ' style="width:200px">';
        foreach ($fontWeights as $fontWeightValue=>$fontWeightDescription) {
            $ret .= '<option value="'.$fontWeightValue.'"';
            if( $fontWeightValue == $fontWeight ) $ret .= ' selected="selected"';
            $ret .= '>'.$fontWeightDescription.'</option>';
        }
        $ret .= '<select>';

        $ret .= '</p>';

        $ret .= '</div>';

        // FONT EXAMPLE

        $ret .= '<div style="float:left">';
        $ret .= '<div class="fontPickerShowCase description" style="padding:15px 20px;font-size:15px;margin:0 0 20px 0;line-height:20px;width:270px">';
        $ret .= '<p style="margin:0;padding:0">Grumpy wizards make toxic brew for the evil Queen and Jack.';
        $ret .= '</div>';
        $ret .= '<div class="fontPickerShowCode description" style="padding:15px 20px;font-family:Monospace;width:270px">';
        $ret .= '<p></p>';
        $ret .= '</div>';
        $ret .= '</div>';

        // WRAPPER END
        $ret .= '</div>';

        return $ret;
    }
    
    static function printFontPickerJavascript(){
        echo '<script type="text/javascript">';
        readfile( dirname(__FILE__).'/wpAdmin.js' );
        echo '</script>';
    }
}

// end of ugly hack
}