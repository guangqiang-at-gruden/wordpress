<?php

class htmlPostPrinter extends htmlBasePrinter {
	public function meta() {
 		$posted_by = fOpt::Get('translation', 'post-posted-by');
		$posted_in = fOpt::Get('translation', 'post-posted-in');
		
		if( fEnv::getSingleOption('postmeta_author') == true ) {
			echo $posted_by. ' '; the_author_posts_link(); 
		}
		
		if( fEnv::getSingleOption('postmeta_category') == true) {
			if( IS_DEMO_CONTENT ) {
				ob_start();
				the_category(', ');
				$content = ob_get_contents();
				ob_clean();
				if( strpos($content, 'Blog') !== false || strpos($content, 'Portfolio') !== false  ) {
					$contentExploded = explode(',', $content);
					echo ' ' . $posted_in . ' ' . $contentExploded[0];
				}
			} else {
				echo ' ' . $posted_in . ' '; the_category(', ');
			}
		}
		
		
		if( has_tag() && fEnv::getSingleOption('postmeta_tags') == true ) {
			$tags=  fOpt::Get('translation', 'post-tags');
			the_tags(' <span class="post_meta_tags">', ', ','</span>');
		}
	}
	
	public function title() {
		$title = get_the_title();
		$permalink = get_permalink();
		
		
		$clickable_title = fEnv::getSingleOption('clickable_title');
		
		$title_print = $title;
		if( $clickable_title == 1)
			$title_print = '<a href="'.$permalink.'">'. $title . '</a>';
		
		echo  '<h2>'.$title_print.'</h2>';
	}	
	
	public function commentCount() {
		if( fEnv::getSingleOption('enable_comments') != 1)	return;
		
		$comments_number = get_comments_number();
		$permalink = get_permalink();
		echo '<a class="comments_count shadow" href="'.$permalink.'#comments"><span>' .  $comments_number . '</span></a>';
	}	
	
	public function formatedDate() {
		if( fEnv::getSingleOption('enable_date') != 1 )	return false;
		$permalingk = get_permalink();
		$date = fOpt::Get('translation', 'post-date');
		the_time( $date ); //fOpt::Get('translation', 'category-date') );
	}	
	
	public function mainImage( $width, $height, $fixed_height = false ) { 
		$fixed_height_to = fEnv::getSingleOption('main_image_height');
		
		if( $fixed_height_to != 0 && $fixed_height_to != '0' && $fixed_height_to != '') {
			$height = $fixed_height_to;
			$fixed_height = true;
		} else {
			$height = false;
		}
		
		
		$main_image = fEnv::getPostMainImage();
		$clickable_image = fEnv::getSingleOption( 'clickable_image' );
		$lightbox = fEnv::getSingleOption( 'open_image_in_lightbox' );

		if( empty($main_image) ) return;
		
		$imgInfo = fImg::ResizeC( $main_image['url'], $width, $height, $fixed_height,true);		
		
		echo '<div class="featured_image_container">';
		echo '<div class="featured_image_wrapper">';
			if( $clickable_image == true ) {
				$lightbox_html_code = 'rel="prettyPhoto" ';
				$url = $main_image['url'];
				
				if( $lightbox != true) {
					$lightbox_html_code = '';
					$url = get_permalink();
				}
					
				echo '<a '.$lightbox_html_code.' href="'.$url.'" title="'.$main_image['title'].'">';
				echo '  <img src="'.$imgInfo['url'].'" width="'.$imgInfo['width'].'" height="'.$imgInfo['height'].'" alt="'.$main_image['title'].'" class="featured_image" />';
				echo '<img src="'.get_template_directory_uri().'/images/featured_image_hover.png" class="featured_image_hover" alt="" />';
				echo '</a>';			
			}
	
			else {
				echo '<img src="'.$imgInfo['url'].'" width="'.$imgInfo['width'].'" height="'.$imgInfo['height'].'" alt="" class="featured_image" />';
				echo '<img src="'.get_template_directory_uri().'/images/featured_image_hover.png" class="featured_image_hover" alt="" />';
			}
		echo '</div>';
		echo '</div>';
					
					
	}	
	public function shouldPrintAuthorInfo() {
		$user_id = get_the_author_meta('ID');
		
		$description = ( get_the_author_meta('description') );
		$socialLinks = get_user_meta($user_id, 'social_links', true);
		if( !empty( $description ) || !empty( $socialLinks ) ) return true;
		else return false;
	}
	
	public function printAuthorInfo() {
		global $authordata;
		$user_id = get_the_author_meta('ID');
		$authorUrl =  get_author_posts_url( $authordata->ID, $authordata->user_nicename );
		echo '<a href="'.$authorUrl.'">';
			echo get_avatar( get_comment_author_email(), '60', get_template_directory_uri().'/images/img60.jpg');
		echo '</a>';
		$description =  get_the_author_meta('description');
		if( !empty( $description ) ) echo '<p>'.$description.'</p>';
		$socialLinks = get_user_meta($user_id, 'social_links', true);
		$socialLinkFeeder = new ffSocialFeeder( $socialLinks );
		
		if( !empty($socialLinkFeeder->items) ) {
			echo '<ul class="socialIcons row">';
				foreach( $socialLinkFeeder->items as $oneItem ) {
					echo '<li class="' .$oneItem->type .' normal">';
						echo '<a class="tooltip" data-tooltipText="'.$oneItem->title.'" href="'.$oneItem->link.'">';
							echo $oneItem->title;
						echo '</a>';
					echo '</li>';
				}
			echo '</ul>';
		}
	}
	

	
	public function buttonShare() {
		echo fOpt::Get('translation', 'post-button-share');
	}
	
	public function buttonAppreciate() {
		echo fOpt::Get('translation', 'post-button-appreciate');
	}
	
	public function buttonComment() {
		echo fOpt::Get('translation', 'post-button-comment');
	}
	
	public function buttonTags() {
		echo fOpt::Get('translation', 'post-button-tags');
	}
	
	public function buttonAuthor() {
		echo fOpt::Get('translation', 'post-button-author');
	}
	
	public function buttonBack( $portfolio = false ) {
		if( $portfolio ) {
			$back = fOpt::Get('translation', 'post-button-back-portfolio');
		} else {
			$back = fOpt::Get('translation', 'post-button-back');
		}
		echo $back;
		//$catName = get_cat_name( fEnv::getActualCat() );
		//$backNew = str_replace('%',$catName, $back);
		//echo $backNew;
	}
	

	// share appreciate comment tags author back
}