<?php
class htmlPortfolioPrinter extends htmlBasePrinter {
//****************************************************************************//
//----------------------------------------------------------------------------//
// PORTFOLIO COMMON FOR ALL
//----------------------------------------------------------------------------//
//****************************************************************************//
public function title() {
	the_title();
}	

public function smallDescription() {
	$desc = metaBoxManager::getMeta('portfolio_image_description');
	echo $desc;
}

public function permalink() {
	echo get_permalink();
}
	
public function jackboxTitle() {
	echo 'title';
}

public function jackboxDescription() {
	echo 'some shit desc here ';
}

	
//****************************************************************************//
//----------------------------------------------------------------------------//
// PORTFOLIO FILTERABLE
//----------------------------------------------------------------------------//
//****************************************************************************//
public function filterableFeaturedImage( $width, $height ) {
	global $post;
	$gallery = ffGalleryCollection::getGallery();
	$featured = $gallery->getFeaturedImage();
	if( null == $featured ) return;
	
	$featuredImg = $gallery->getFeaturedImage();
	if( $featuredImg == null ) return;
	$img_nonresized = $gallery->getFeaturedImage()->image->url;
	
	$img = fImg::resize( $img_nonresized, $width, $height, true);
	
    $link             = '';
    $dataGroup        = 'portfolio';
    $dataThumbTooltip = $featured->altText;
    $dataTitle        = $featured->title;
    $dataDescription  = '';;
	
	echo '<div class="portfolioImage">';
		echo '<a 
				class="jackbox"
                data-group="'.$dataGroup.'"
                data-thumbTooltip="'.$dataThumbTooltip.'"
                data-title="'.$dataTitle.'"
                
				href="'.$this->_mainImageLink().'">';
		
			echo '<div class="jackbox-hover jackbox-hover-blur '.$this->_mainImageClass().'"></div>';
			echo '<img width="306" height="170" src="'.ffGalleryCollection::getGallery()->getFeaturedImage()->image->resize($width, $height,1 ).'" alt="" />';
			echo '<span class="portfolioImageOver transparent"></span>';
		echo '</a>';
	echo '</div>';
	 
}
private function _mainImageClass() {
	//jackbox-hover-magnify / play
	$videoLink = metaBoxManager::getMeta('featured_image_video_link');
	$class = 'jackbox-hover-play';
	if( empty( $videoLink ) ) 
		$class = 'jackbox-hover-magnify';
	return $class;
}

private function _mainImageLink() {
	$link = metaBoxManager::getMeta('featured_image_video_link');
	if( empty( $link ) ) 
		$link = ffGalleryCollection::getGallery()->getFeaturedImage()->image->url;
	return $link;
}

}