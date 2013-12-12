<?php

///////////////////////////////////////////////////////////////////////////////
// Section header
////////////////////////////////////////////////////////////////////////////////

function shortcode_sectionheader( $atts, $content = null ) {
   return '<div class="sectionHeader row"><div class="sectionHeadingWrap"><span class="sectionHeading">' .
          do_shortcode($content) .
          '</span></div></div>';
}
add_shortcode('sectionheader',  'shortcode_sectionheader');
add_shortcode('section_header', 'shortcode_sectionheader');
add_shortcode('section-header', 'shortcode_sectionheader');

////////////////////////////////////////////////////////////////////////////////
// Halves
////////////////////////////////////////////////////////////////////////////////

function shortcode_one_half( $atts, $content = null ) {
   return '<article class="onehalf row">' . do_shortcode($content) . '</article>';
}
add_shortcode('one_half', 'shortcode_one_half');

function shortcode_one_half_last( $atts, $content = null ) {
   return '<article class="onehalf row last">' . do_shortcode($content) . '</article>';
}
add_shortcode('one_half_last', 'shortcode_one_half_last');

////////////////////////////////////////////////////////////////////////////////
// Thirds
////////////////////////////////////////////////////////////////////////////////

function shortcode_one_third( $atts, $content = null ) {
   return '<article class="onethird row">' . do_shortcode($content) . '</article>';
}
add_shortcode('one_third', 'shortcode_one_third');

function shortcode_two_thirds( $atts, $content = null ) {
   return '<article class="twothirds row">' . do_shortcode($content) . '</article>';
}
add_shortcode('two_thirds', 'shortcode_two_thirds');
add_shortcode('two_third',  'shortcode_two_thirds');

// Last

function shortcode_one_third_last( $atts, $content = null ) {
   return '<article class="onethird row last">' . do_shortcode($content) . '</article>';
}
add_shortcode('one_third_last', 'shortcode_one_third_last');

function shortcode_two_thirds_last( $atts, $content = null ) {
   return '<article class="twothirds row last">' . do_shortcode($content) . '</article>';
}
add_shortcode('two_thirds_last', 'shortcode_two_thirds_last');
add_shortcode('two_third_last',  'shortcode_two_thirds_last');

////////////////////////////////////////////////////////////////////////////////
// Fourth
////////////////////////////////////////////////////////////////////////////////

function shortcode_one_fourth( $atts, $content = null ) {
   return '<article class="onefourth row">' . do_shortcode($content) . '</article>';
}
add_shortcode('one_fourth', 'shortcode_one_fourth');

// 2/4 = 1/2
add_shortcode('two_fourth', 'shortcode_one_half');

function shortcode_three_fourth( $atts, $content = null ) {
   return '<article class="threefourth row">' . do_shortcode($content) . '</article>';
}
add_shortcode('three_fourth', 'shortcode_three_fourth');
add_shortcode('three_fourths', 'shortcode_three_fourth');

// Last

function shortcode_one_fourth_last( $atts, $content = null ) {
   return '<article class="onefourth row last">' . do_shortcode($content) . '</article>';
}
add_shortcode('one_fourth_last', 'shortcode_one_fourth_last');

// 2/4 = 1/2
add_shortcode('two_fourth_last', 'shortcode_one_half_last');

function shortcode_three_fourth_last( $atts, $content = null ) {
   return '<article class="threefourth row last">' . do_shortcode($content) . '</article>';
}
add_shortcode('three_fourth_last',  'shortcode_three_fourth_last');
add_shortcode('three_fourths_last', 'shortcode_three_fourth_last');

////////////////////////////////////////////////////////////////////////////////
// Fifth
////////////////////////////////////////////////////////////////////////////////

function shortcode_one_fifth( $atts, $content = null ) {
   return '<article class="onefifth row">' . do_shortcode($content) . '</article>';
}
add_shortcode('one_fifth', 'shortcode_one_fifth');

// Last

function shortcode_one_fifth_last( $atts, $content = null ) {
   return '<article class="onefifth row last">' . do_shortcode($content) . '</article>';
}
add_shortcode('one_fifth_last', 'shortcode_one_fifth_last');

///////////////////////////////////////////////////////////////////////////////
// Checklist
///////////////////////////////////////////////////////////////////////////////

function shortcode_checklist( $atts, $content = null ) {
   return '<div class="checklist">' . do_shortcode($content) . '</div>';
}
add_shortcode('checklist', 'shortcode_checklist');

///////////////////////////////////////////////////////////////////////////////
// pullquote
///////////////////////////////////////////////////////////////////////////////

function shortcode_pullquote_left( $atts, $content = null ) {
   return '<blockquote class="alignLeft">' . do_shortcode($content) . '</blockquote>';
}

add_shortcode('pullquote_left', 'shortcode_pullquote_left');

function shortcode_pullquote_right( $atts, $content = null ) {
   return '<blockquote class="alignRight">' . do_shortcode($content) . '</blockquote>';
}

add_shortcode('pullquote_right', 'shortcode_pullquote_right');

function shortcode_blockquote( $atts, $content = null ) {
	return '<blockquote>' . do_shortcode($content) . '</blockquote>';
}

add_shortcode('blockquote', 'shortcode_blockquote');

///////////////////////////////////////////////////////////////////////////////
// Drop cap
///////////////////////////////////////////////////////////////////////////////

function shortcode_dropcap( $atts, $content = null ) {
    extract(shortcode_atts(array('type' => '1'), $atts));
    $type = 1 * ceil( $type );
    switch($type) {
        case 1:  $class="dropCap1";
          break;
        case 2:  $class="dropCap2 highlight";
          break;
        case 3:  $class="dropCap3";
          break;
        case 4:
        default: $class="dropCap4 highlight";
          break;
    }
    return '<span class="'.$class.'">' . do_shortcode( trim($content) ) . '</span>';
}
add_shortcode('dropcap',   'shortcode_dropcap');
add_shortcode('dropcaps',  'shortcode_dropcap');
add_shortcode('drop-cap',  'shortcode_dropcap');
add_shortcode('drop-caps', 'shortcode_dropcap');
add_shortcode('drop_cap',  'shortcode_dropcap');
add_shortcode('drop_caps', 'shortcode_dropcap');

///////////////////////////////////////////////////////////////////////////////
// highlight
///////////////////////////////////////////////////////////////////////////////

function shortcode_highlight( $atts, $content = null ) {
   return '<span class="highlighted">' . do_shortcode($content) . '</span>';
}

add_shortcode('highlight', 'shortcode_highlight');

function shortcode_lightbox( $atts, $content = null ) {
	$href = $atts['href'];
	$title = $atts['title'];
	( $atts['highlight'] == '1' ) ? $highlight = 'highlight' : $highlight = '';
	$sc = '<a class="jackbox '.$highlight.'" data-group="images" data-title="'.$title.'" href="'.$href.'">';
	$sc .= $content;
	$sc .= '</a>';
	
	return $sc;
	
	
	//<a class="jackbox highlight" data-group="images" data-thumbnail="images/portfolio/thumbs5/11.jpg" data-thumbtooltip="Image Title" data-title="Image Title with &lt;a href='http://www.google.com' target=_blank'&gt;link&lt;/a&gt;" href="images/portfolio/11.jpg">click here</a>
}
add_shortcode('lightbox', 'shortcode_lightbox');


function shortcode_tooltip( $atts, $content = null ) {
	$text = $atts['text'];
	( $atts['highlight'] == '1' ) ? $highlight = 'highlight' : $highlight = '';
	$sc = '<span class="tooltip '.$highlight.'" data-tooltiptext="'.$text.'" original-title="">';
	$sc .= $content;
	$sc .= '</span>';

	return $sc;


	//<a class="jackbox highlight" data-group="images" data-thumbnail="images/portfolio/thumbs5/11.jpg" data-thumbtooltip="Image Title" data-title="Image Title with &lt;a href='http://www.google.com' target=_blank'&gt;link&lt;/a&gt;" href="images/portfolio/11.jpg">click here</a>
}
add_shortcode('tooltip', 'shortcode_tooltip');


//<span class="highlight tooltip" data-tooltiptext="This is a tooltip" style="cursor: pointer;" original-title="">hover here</span>
///////////////////////////////////////////////////////////////////////////////
// divider
///////////////////////////////////////////////////////////////////////////////

function shortcode_divider( $options ) {
     extract(shortcode_atts(array(
	      'margin' => 0,
	      'padding' => 0,
	      'line' => false
     ), $options));

    $margin  = ceil( 1 * $margin );
    $padding = ceil( 1 * $padding );

    $style = '';
    if( !empty($margin) )  $style .= 'margin:'.$margin.'px;';
    if( !empty($padding) ) $style .= 'margin:'.$padding.'px;';
    if( !empty($style) )   $style = ' style="' . $style . '" ';

    $class = empty($options['line']) ?
             '' :
             ' blank';

    echo '<div class="divider large'.$class.'"'.$style .'></div>';
}

add_shortcode('divider', 'shortcode_divider');

/*
function shortcode_box_download( $atts, $content = null ) {
	$sc = '';
	$sc .= '<div class="sc_box">';
	$sc .= '<div class="tb_alert_box tb_alert_box_download">';
	$sc .= '	<h3 class="tb_module_name">';
	$sc .=			$atts['title'];
	$sc .= '	</h3>';
	$sc .= '	<div class="tb_alert_box_text">';
	$sc .= 			do_shortcode( $content );
	$sc .= '	</div>';
	$sc .= '</div></div>';
	//$sc = str_replace("\r\n", '', $sc);
  return $sc;
}
add_shortcode('box_download', 'shortcode_box_download');

function shortcode_box_info( $atts, $content = null ) {
	$sc = '';
	$sc .= '<div class="sc_box">';
	$sc .= '<div class="tb_alert_box tb_alert_box_info">';
	$sc .= '	<h3 class="tb_module_name">';
	$sc .=			$atts['title'];
	$sc .= '	</h3>';
	$sc .= '	<div class="tb_alert_box_text">';
	$sc .= 			do_shortcode( $content );
	$sc .= '	</div>';
	$sc .= '</div></div>';
	
	return $sc;
}
add_shortcode('box_info', 'shortcode_box_info');

function shortcode_box_error( $atts, $content = null ) {
	$sc = '';
  $sc .= '<div class="sc_box">';
	$sc .= '<div class="tb_alert_box tb_alert_box_error">';
	$sc .= '	<h3 class="tb_module_name">';
	$sc .=			$atts['title'];
	$sc .= '	</h3>';
	$sc .= '	<div class="tb_alert_box_text">';
	$sc .= 			do_shortcode( $content );
	$sc .= '	</div>';
	$sc .= '</div></div>';
		
  return $sc;
}
add_shortcode('box_warning', 'shortcode_box_error');
add_shortcode('box_error', 'shortcode_box_error');

function shortcode_box_note( $atts, $content = null ) {
	$sc = '';
  $sc .= '<div class="sc_box">';
	$sc .= '<div class="tb_alert_box tb_alert_box_note">';
	$sc .= '	<h3 class="tb_module_name">';
	$sc .=			$atts['title'];
	$sc .= '	</h3>';
	$sc .= '	<div class="tb_alert_box_text">';
	$sc .= 			do_shortcode( $content );
	$sc .= '	</div>';
	$sc .= '</div></div>';
		
  return $sc;
}
add_shortcode('box_note', 'shortcode_box_note');

function shortcode_dropcap( $atts, $content = null ) {
   return '<span class="dropcap">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap', 'shortcode_dropcap');

function shortcode_pullquote_left( $atts, $content = null ) {
   return '<span class="sc_pullquote_left">' . do_shortcode($content) . '</span>';
}
add_shortcode('pullquote_left', 'shortcode_pullquote_left');

function shortcode_pullquote_right( $atts, $content = null ) {
   return '<span class="sc_pullquote_right">' . do_shortcode($content) . '</span>';
}
add_shortcode('pullquote_right', 'shortcode_pullquote_right');
function shortcode_toggle( $atts, $content = null)
{
 extract(shortcode_atts(array(
        'title'      => '',
        ), $atts));
   return '<div class="sc_toggle_wrapper"><h4 class="sc_toggle"><a href="#">'.$title.'</a></h4><div class="sc_toggle_body"><div class="block">'. do_shortcode($content) . '</div></div></div>';
}
add_shortcode('toggle', 'shortcode_toggle');

function shortcode_highlight1( $atts, $content = null)
{

   return '<span class="sc_highlight1">'. do_shortcode($content) . '</span>';
}
add_shortcode('highlight1', 'shortcode_highlight1');

function shortcode_highlight2( $atts, $content = null)
{

   return '<span class="sc_highlight2">'. do_shortcode($content) . '</span>';
}
add_shortcode('highlight2', 'shortcode_highlight2');

function shortcode_frame_left( $atts, $content = null)
{

   return '<span class="frame alignleft">'. do_shortcode($content) . '</span>';
}
add_shortcode('frame_left', 'shortcode_frame_left');

function shortcode_frame_right( $atts, $content = null)
{

   return '<span class="frame alignright">'. do_shortcode($content) . '</span>';
}
add_shortcode('frame_right', 'shortcode_frame_right');

function shortcode_frame_center( $atts, $content = null)
{

   return '<span class="frame aligncenter">'. do_shortcode($content) . '</span>';
}
add_shortcode('frame_center', 'shortcode_frame_center');

function shortcode_divider_top( $atts, $content = null)
{

   return '<div class="sc_divider_top"><a href="#" class="back_to_top">Back to Top</a></div>';
}
add_shortcode('divider_top', 'shortcode_divider_top');


function shortcode_no( $atts, $content = null)
{
  $url = get_template_directory_uri();
   return '<img src="'.$url.'/gfx/icons/cross.png" class="sc_no">';
}
add_shortcode('no', 'shortcode_no');

function shortcode_yes( $atts, $content = null)
{
  $url = get_template_directory_uri();
   return '<img src="'.$url.'/gfx/icons/tick.png" class="sc_yes">';
}
add_shortcode('yes', 'shortcode_yes');
if( IS_DEMO_CONTENT && false ) {
	function shortcode_demo_present_left( $atts, $content = null)
	{
		return '[';
	}
	add_shortcode('{{', 'shortcode_demo_present_left');
	
	function shortcode_demo_present_right( $atts, $content = null)
	{
		return ']';
	}
	add_shortcode('}}', 'shortcode_demo_present_right');	
}

add_filter( "the_content", "the_content_p_remover", 999);
function the_content_p_remover($post_content)
{

	$post_content2 = str_replace(array('<div class="sc_col_one_third"></p>',
			'<div class="sc_col_one_third sc_col_last"></p>',
			'<div class="sc_col_one_half"></p>',
			'<div class="sc_col_one_half sc_col_last"></p>',
			'<div class="sc_col_one_fourth"></p>',
			'<div class="sc_col_one_fourth sc_col_last"></p>',
			'<div class="sc_col_two_third"></p>',
			'<div class="sc_col_two_third sc_col_last"></p>',
			'<div class="sc_col_three_fourth"></p>',
			'<div class="sc_col_three_fourth sc_col_last"></p>',
			'<beforecheck></p>',
			'<p><aftercheck>',
			'<p><div class="sc_col_divider"></div>',
			'<div class="sc_col_tabs_box"><br />',
			'{[-{',
			'}-]}',
			'<!-- st_tab --><br />'
	),

			array('<div class="sc_col_one_third">',
					'<div class="sc_col_one_third sc_col_last">',
					'<div class="sc_col_one_half">',
					'<div class="sc_col_one_half sc_col_last">',
					'<div class="sc_col_one_fourth">',
					'<div class="sc_col_one_fourth sc_col_last">',
					'<div class="sc_col_two_third">',
					'<div class="sc_col_two_third sc_col_last">',
					'<div class="sc_col_three_fourth">',
					'<div class="sc_col_three_fourth sc_col_last">',
					'',
					'',
					'',
					'<div class="sc_col_tabs_box">',
					'[',
					']',
					''
			), $post_content);
	return str_replace('<p></div>', '</div>', $post_content2);
}


// clean up shortcode

    add_filter('the_content', 'shortcode_empty_paragraph_fix');
    function shortcode_empty_paragraph_fix($content)
    {   
        $array = array (
            '<p>[' => '[', 
            ']</p>' => ']', 
            ']<br />' => ']'
        );

        $content = strtr($content, $array);

		return $content;
    }
    
*/
?>