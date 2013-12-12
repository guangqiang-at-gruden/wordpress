<?php

function shortcode_pagebuilder( $atts, $content = null)
{
	ob_start();
	$pb = new fpagebuilderManager();
	$pbo = $pb->loadPage( $atts['name'] );
	$pbo->printPage();
	$pb_content = ob_get_contents();
	ob_end_clean();
	//echo($pb_content);
	//die();
	return $pb_content;	
}
add_shortcode('templatebuilder', 'shortcode_pagebuilder');

function framework_print_component_shortcode( $component, $atts ) {
	ob_start();
	$component->printComponent( $atts );
	$content = ob_get_contents();
	ob_end_clean();
	
	return $content;
}

function shortcode_button( $atts, $content = null )
{
	$atts['title'] = $content;
	$atts['is_shortcode'] = true;
	$btn = new componentButton();
	$toReturn = '<div class="sc_button">' . framework_print_component_shortcode( $btn, $atts) . '</div>';
	return str_replace("\r\n", '', $toReturn);
	//return '<div class="sc_button">' . framework_print_component_shortcode( $btn, $atts) . '</div>';

}
add_shortcode('button', 'shortcode_button');

function shortcode_image( $atts, $content = null ) {
	$image = new componentImage();
	return framework_print_component_shortcode( $image, $atts);
}
add_shortcode('image', 'shortcode_button');