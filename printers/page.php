<?php
class htmlPagePrinter extends htmlBasePrinter {
//****************************************************************************//
//----------------------------------------------------------------------------//
// GALLERY PAGE
//----------------------------------------------------------------------------//
//****************************************************************************//	
	public function title() {
		$title = get_the_title();
		$permalink = get_permalink();		
		
		$title_print = '<a href="'.$permalink.'">'. $title . '</a>';
		echo  '<h2>'.$title_print.'</h2>';		
	}
	private function _getClassFromNumberOfColumns( $numberOfColumns ) {
		$class = '';
		switch( $numberOfColumns ) { 
			case 3 : $class = 'onethird'; break;
			case 4 : $class = 'onefourth'; break;
			case 5 : $class = 'onefifth'; break;
		}
		return $class;
	}
	public function gallery( $numberOfColumns = 3 ) {
		$gallery = ffGalleryCollection::getGallery();
		$gallery->loadGalleryFromMeta('gallery_slider');
		if( $gallery->getNumberOfImages() != 0 ) {
			$itemClass = $this->_getClassFromNumberOfColumns( $numberOfColumns );
			$itemSize = $this->_getSizeFromNumberOfColumns( $numberOfColumns );
			echo '<section class="isotopeContainer gallery left-twenty">';
				foreach( $gallery as $oneImg ) {
					echo '<div class="element '.$itemClass.'">';
					 	echo '<div class="portfolioImage">';
					 		echo '<a class="jackbox" data-group="gallery_group" data-thumbTooltip="'.$oneImg->altText.'" data-title="'.$oneImg->title.'" href="'.$oneImg->image->url.'">';
						 		echo '<div class="jackbox-hover jackbox-hover-blur jackbox-hover-magnify"></div>';
						 		echo '<img width="'.$itemSize['width'].'" height="'.$itemSize['height'].'" src="'.$oneImg->image->resize($itemSize['width'],$itemSize['height'],true).'" alt="" />';
						 		echo '<span class="portfolioImageOver transparent"></span>';
							echo '</a>';
						echo '</div>';
					echo '</div>';
	
				}

			echo '</section>';
		}
	}
	
	private function _getSizeFromNumberOfColumns( $noc ) {
		if( $noc == 3 ) {
			return array('width'=>306, 'height'=>170);
		} else if( $noc == 4 ) {
			return array('width'=>225, 'height'=>170);
		} else if( $noc == 5 ) {
			return array('width'=>176, 'height'=>133);
		}  
	}
	
	private function getImagesCount( $page_id ) {
		$attachment_args = array(
	         'post_type' => 'attachment',
	         'numberposts' => -1,          // one attachement image per post
	         'post_status' => null,
	         'post_parent' =>$page_id,
	         'orderby' => 'menu_order ID'
	    );
		
	    $attachments = get_posts($attachment_args);
		
		return count($attachments);
	}
	public function album( $type= 'album-1') {
		global $post;
		
		$width = get_post_meta($post->ID, 'fw_'.$type.'_img_width',true);
		$height = get_post_meta($post->ID, 'fw_'.$type.'_img_height',true);
		$image_per_line = get_post_meta($post->ID, 'fw_'.$type.'_img_per_line',true);
		
		$show_caption = get_post_meta($post->ID,'fw_'.$type.'_show_caption', true);
		$show_number = get_post_meta($post->ID,'fw_'.$type.'_show_number', true);
		
		if( empty( $width )) $width = 211;
		if( empty( $height )) $height = 211;
		if( empty( $image_per_line )) $image_per_line = 4;
		
		echo '<div class="album_template">';	
		echo '<div class="row">';
		
				
		
		$childrens = get_pages( array('child_of'=>$post->ID) );
		$post_count = count( $childrens ); 
		foreach( $childrens as $key => $one_page ) {
			$permalink = get_permalink( $one_page->ID);
			$img = fEnv::getPostMainImage( $one_page->ID );
			$img_resized = fImg::ResizeC( $img['url'], $width, $height, true);
			
			$photos_count = $this->getImagesCount( $one_page->ID );
			$photos_count_text = '';
			if( $photos_count == 1)
				$photos_count_text = fOpt::Get('translation', 'album-photos-1');
			else
				$photos_count_text = str_replace( '%', $photos_count, fOpt::Get('translation', 'album-photos-x'));
			
			 echo '<a href="'.$permalink.'"  title="'.$one_page->post_title.'" class="album_template_album_wrapper" style="width:'.($width + 12).'px;"><div class="album_template_image_wrapper_inner_1"><div class="album_template_image_wrapper_inner_2"><div class="album_template_image_wrapper_inner_3"><div class="featured_image_container album_template_image_container"><div class="album_template_image_wrapper featured_image_wrapper">'; 
			 echo '<img src="'. $img_resized.'" class="album_template_image featured_image" style="width:'.$width.'px; height:'.$height.'px;" alt="" />'; 
			 echo '<img src="'.get_template_directory_uri().'/images/featured_image_hover.png" class="featured_image_hover" alt="" />';
			 echo '</div></div></div></div></div>';
			 
			 if( $show_caption || $show_number ) {
				 echo 	'<div class="album_template_description">';
				 if( $show_caption )
				 	echo 		'<span class="album_template_title">'.$one_page->post_title.'</span>';
				 if( $show_number )
				 	echo 		'<span class="album_template_count">'.$photos_count_text.'</span>';
				 echo	'</div>';
			 }
			 echo '</a>';
			 $key2 = $key+1;
			 if( $key2 == $post_count ) continue;
			 if($key2%$image_per_line == 0) echo '<div class="clear"></div></div><div class="row">';
		}
		echo '<div class="clear"></div>';
		echo '</div>';
		echo '</div>';
	}
	
}