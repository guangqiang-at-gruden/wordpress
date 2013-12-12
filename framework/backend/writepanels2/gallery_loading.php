<?php
add_action('wp_ajax_ff_gallery_load', 'ff_gallery_load');
function ff_gallery_load() {
	if( !isset( $_POST['image_id'] ) || empty( $_POST['image_id'] ) ) die();
	
	$imagesId = $_POST['image_id'];
	
	$imagesIdArray = getImageIdInArray( $imagesId );
	
	$metaboxPrinter = new metaBoxPrinter();
	$metaboxPrinter->printGalleryInside( $imagesIdArray);
	
	die();
}


function getImageIdInArray( $idOfImages ) {
	$arrayOfId = array();
	if( strpos( $idOfImages, ',') === false ) {
		$arrayOfId[] = (int)$idOfImages;
	} else {
		$arrayOfId = explode(',', $idOfImages);
	}
	return $arrayOfId;
}