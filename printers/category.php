<?php
class htmlCategoryPrinter extends htmlBasePrinter {
	// [$postId] = true / false
	private $_postHasReadMore = array();

/******************************************************************************/
/*----------------------------------------------------------------------------*/
/* MENU
/*----------------------------------------------------------------------------*/
/******************************************************************************/	
	
	
	
	public function mainPortfolioImage( $width, $height, $portfolio_template_number, $fixed_height = true ) {
		$fixed_height_to = fEnv::getCategoryOption('main_image_height');
		if( $fixed_height_to != 0 && $fixed_height_to != '0' && $fixed_height_to != '') {
			$height = $fixed_height_to;
			$fixed_height = true;
		} else {
			$height = false;
		}
		
		
		$main_image = fEnv::getPostMainImage();
		$clickable_image =fEnv::getCategoryOption( 'clickable_image' );
		$lightbox = fEnv::getCategoryOption( 'open_image_in_lightbox' );
		
		$imgInfo = fImg::ResizeC( $main_image['url'], $width, $height, true,true);
		
		
		if( empty($main_image) ) return;
		
		
		echo '<div class="featured_image_container">';
		if( $clickable_image == true ) {
			$lightbox_html_code = 'rel="prettyPhoto" ';
			$url = $main_image['url'];
			if( $lightbox == 0 ) {
				$lightbox_html_code = '';
				$url = get_permalink();
			}
			
			
			echo '<a '.$lightbox_html_code.' href="'.$url.'" class="featured_image_wrapper" title="'.$main_image['title'].'">';
			echo '  <img src="'.$imgInfo['url'].'" width="'.$imgInfo['width'].'" height="'.$imgInfo['height'].'" alt="'.$main_image['title'].'" class="featured_image" />';
			echo '<img src="'.get_template_directory_uri().'/images/featured_image_hover.png" class="featured_image_hover" alt="" />';

			if( fEnv::getCategoryOption('portfolio_shadow_under_image') == 1 )
				echo '<img class="portfolio_shadow" src="'.get_template_directory_uri() . '/images/portfolio_shadow.png" style="width:' . $imgInfo['width'] . 'px; top:' . $imgInfo['height'] . 'px;">';
			echo '</a>';
		}
		else {	
			echo '<div class="featured_image_wrapper">';
			echo '<img src="'.$imgInfo['url'].'" width="'.$imgInfo['width'].'" height="'.$imgInfo['height'].'" alt="" class="featured_image" />';
			echo '<img src="'.get_template_directory_uri().'/images/featured_image_hover.png" class="featured_image_hover" alt="" />';
			if( fEnv::getCategoryOption('portfolio_shadow_under_image') == 1 )
				echo '<img class="portfolio_shadow" src="'.get_template_directory_uri() . '/images/portfolio_shadow.png" style="width:' . $imgInfo['width'] . 'px; top:' . $imgInfo['height'] . 'px;">';
			echo '</div>';
		}
		echo '</div>';
		
		
	}

	public function content() {
		
		$detector = '!!readmore_detector!!';
		$content = get_the_content($detector);
		$has_readmore = strpos( $content, $detector);
		
		the_content('', FALSE,'' );
		
		$color_skin = fOpt::Get('skins', 'theme-readmore-skin');
		
		if( $has_readmore !== false && fEnv::getCategoryOption('show_readmore_button') == 1 )
			echo '<a class="btn_component tb_btn_small tb_btn_'.$color_skin.' tb_btn_small_'.$color_skin.'" href="'.get_permalink().'"><span class="tb_btn_left"></span><span class="tb_btn_center">'. fOpt::Get('translation', 'post-read-more').'</span><span class="tb_btn_right"></span><span class="clear"></span></a>';
	}
	
	public function commentCount() {
		if( fEnv::getCategoryOption('enable_comments') != 1)	return;
		
		$comments_number = get_comments_number();
		$permalink = get_permalink();
		echo '<a class="comments_count shadow" href="'.$permalink.'#comments"><span>' .  $comments_number . '</span></a>';
	}	
	
	public function formatedDate() {
		if( fEnv::getCategoryOption('enable_date') != 1 )	return false;
		$permalingk = get_permalink();
		$date = fOpt::Get('translation', 'post-date');
		the_time( $date ); 
	}
}