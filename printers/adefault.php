<?php
class htmlBasePrinter implements htmlPrinterInterface {
	
	public function printSidebarPositionClass() {
		if( is_singular() || is_page() ) {
			
			
			$sidebarPos = metaBoxManager::getMeta('fw_sidebar_position');
		}
		else if( is_category() ) {
			$sidebarPos = fEnv::getCategoryOption('sidebar_position');
		}
		

		if( !isset( $sidebarPos ) ) $sidebarPos = 'Left';
		if( $sidebarPos == 'left')
			echo 'left-sidebar';
		
	}
	
	
/******************************************************************************/
/*----------------------------------------------------------------------------*/
/* BLOG LARGE - FEATURED IMAGE
/*----------------------------------------------------------------------------*/
/******************************************************************************/
	public function printBlogMediumFeaturedImage() {
		$gallery = ffGalleryCollection::getGallery();
		$featuredImage = $gallery->getFeaturedImage();
		if( $featuredImage != null ) {
			echo '<img width="225" height="165" src="'.$featuredImage->image->resize(225, 165, 1).'" alt="" />';
		}
	}
	
	public function printBlogLargeFeaturedImage() {
		global $post;
		$imageType = metaBoxManager::getMeta('featured_image_type', 'std');
		$gallery = ffGalleryCollection::getGallery( $post->ID );
		$fixedHeight = metaBoxManager::getMeta('featured_image_height');
		( $fixedHeight > 0 ) ? $height = $fixedHeight : $height = null;
		
		switch( $imageType ) {
			case ('std') : $this->_printBlogLargeFeaturedImageStd($gallery, $height); break;
			case ('slider') : $this->_printBlogLargeFeaturedImageSlider($gallery, $height); break;
			case ('lightbox') : $this->_printBlogLargeFeaturedImageLightbox($gallery, $height); break;
			case ('video') : $this->_printBlogLargeFeaturedImageVideo(); break;
		}
	}
	
	private function _printBlogLargeFeaturedImageVideo() {
		$videoLink = metaBoxManager::getMeta('featured_image_video_link');
		$mediaInserter = new ffMediaInserter();
		$videoIframeSrc = $mediaInserter->getIframeSource( $videoLink );
		
		echo '<section class="blogIframe row-ten">';
		echo '<div class="fluid-width-video-wrapper" style="padding-top: 56.11510791366906%;">';
		echo '<iframe src="'.$videoIframeSrc.'">';
		echo '</iframe>';
		echo '</div>';
		echo '</section>';
		//http://www.youtube.com/embed/e2rWG0DCrpI
	}

/*----------------------------------------------------------------------------*/
/* BLOG LARGE - JUST ONE IMAGE
/*----------------------------------------------------------------------------*/
	private function _printBlogLargeFeaturedImageStd($gallery, $height = null) {
		global $post;
	
	
	
		if( null != ($featuredImage = $gallery->getFeaturedImage() ) ) {
			echo '<img class="scale-with-grid" src="'.$featuredImage->image->resize( 695, $height ).'" alt="" />';
		}
	}
/*----------------------------------------------------------------------------*/
/* BLOG LARGE - LIGHTBOX
/*----------------------------------------------------------------------------*/
	private function _printBlogLargeFeaturedImageLightbox($gallery, $height = null) {
	
		if( null != ($featuredImage = $gallery->getFeaturedImage() ) ) {
			echo '<figure>';
			echo '<a class="jackbox" data-group="images"  data-thumbTooltip = "'.$featuredImage->altText.'" data-title="'.$featuredImage->title.'" href="'.$featuredImage->image.'">';
			echo '<div class="jackbox-hover jackbox-hover-blur jackbox-hover-magnify"></div>';
			echo '<img class="scale-with-grid" width="695" height="350" src="'.$featuredImage->image->resize( 695, $height ).'" alt="" />';
			echo '</a>';
			echo '</figure>';
		}
	}
	
/*----------------------------------------------------------------------------*/
/* BLOG LARGE - SLIDER
/*----------------------------------------------------------------------------*/
	private function _printBlogLargeFeaturedImageSlider( ffGalleryCollection $gallery, $height = null) {
		
		global $post;
		
		$gallery->loadGalleryFromMeta('gallery_slider');
		
		$featuredImg = $gallery->getFeaturedImage();
		$galleryCount = $gallery->getNumberOfImages();
		
		if( $featuredImg == null && $galleryCount == 0) return;
		echo '<section class="slider">';
		echo '<div class="flexslider" data-arrows="true" data-thumbnail="false">';
		echo '<ul class="slides">';
		foreach( $gallery as $oneImg ) {
	
			echo '<li>';
			echo '<img src="'. $oneImg->image->resize( 695, 350, true ).'" alt="" />';
			echo '</li>';
		}
		echo '</ul>';
		echo '</div>';
		echo '</section>';
		return;
	}
	
	
	public function printTags() {
		the_tags('<ul><li>','</li><li>','</li></ul>');
	}
/******************************************************************************/
/*----------------------------------------------------------------------------*/
/* BLOG - READ MORE
/*----------------------------------------------------------------------------*/
/******************************************************************************/	
	public function printBlogReadMore() {
		global $post;
		$readmoreText = fOpt::Get('translation', 'post-button-readmore');
	
		$detector = '!!readmore_detector!!';
		$content = get_the_content($detector);
		$has_readmore = strpos( $content, $detector);
	
	
		if( $has_readmore || !empty( $post->post_excerpt ) ) {
			echo '<li class="button readmore"><a class="highlight" href="'.get_permalink().'">'.$readmoreText.'</a></li>';
		}
	}
/******************************************************************************/
/*----------------------------------------------------------------------------*/
/* BLOG - CONTENT
/*----------------------------------------------------------------------------*/
/******************************************************************************/	
	public function printBlogContent() {
		global $post;
		if( empty( $post->post_excerpt ) || is_singular() ) { 
			the_content('', FALSE,'' );
		}
		else {
			the_excerpt();
		}
	}

/******************************************************************************/
/*----------------------------------------------------------------------------*/
/* BLOG - DATE
/*----------------------------------------------------------------------------*/
/******************************************************************************/
	public function printBlogDate() {
		
		if( fEnv::getCategoryOption('postmeta_date') == 0 ) return;
		$day = get_the_date('d');
		$monthAndYear = get_the_date('M Y');
		echo '<div class="blogDate">';
		echo '<p>'.$day.'</p>';
		echo '<span>'.$monthAndYear.'</span>';
		echo '<div class="arrow-down"></div>';
		echo '</div>';
	}
/******************************************************************************/
/*----------------------------------------------------------------------------*/
/* BLOG - TITLE
/*----------------------------------------------------------------------------*/
/******************************************************************************/	
	public function printBlogTitle() {
		// <a href="single-post-right-image.html"><h2>Hello there, I am a single image post example</h2></a>
		$clickable = true;
	
		if( $clickable and !is_single() ) echo '<a href="'.get_permalink().'">';
		echo '<h2>' . get_the_title(). '</h2>';
		if( $clickable and !is_single() ) echo '</a>';
	}
	
	
/******************************************************************************/
/*----------------------------------------------------------------------------*/
/* BLOG - META
/*----------------------------------------------------------------------------*/
/******************************************************************************/	
	public function printBlogMeta() {
		//<p class="blogMeta">Posted by <a href="#">Admin</a> / in <a href="#">Photography</a> / 285 <a href="#">Comments</a></p>
		$divider = ' / ';
	
		$postedByShow = fEnv::getCategoryOption('postmeta_author');
		$postedByTr = fOpt::Get('translation', 'post-posted-by');
	
		$catShow = fEnv::getCategoryOption('postmeta_category');
		$catTr = fOpt::Get('translation', 'post-posted-in');
	
		$commShow = fEnv::getCategoryOption('postmeta_comments');
		//$commTr = 'xx comments';
		$commZero = fOpt::Get('translation', 'post-comment-count-zero');
		$commOne = fOpt::Get('translation', 'post-comment-count-one');
		$commMore = fOpt::Get('translation', 'post-comment-count-more');
	
		$printDivider = false;
	
		ob_start();
		if( $postedByShow ) {
			echo  $postedByTr.' ';
			the_author_posts_link();
			$printDivider = true;
		}
	
		if( $catShow ) {
			if( $printDivider ) { echo $divider; $printDivider = false; }
				
			echo $catTr.' ';
			the_category(', ');
			$printDivider = true;
		}
	
		if ( $commShow ) {
			if( $printDivider ) { echo $divider; $printDivider = false; }
			ff_comments_popup_link( $commZero, $commOne, $commMore, 'comments-link', '');
		}
	
		$content = ob_get_clean();
	
		if( !empty( $content ) )
			echo '<p class="blogMeta">'.$content.'</p>';
	}	
	
/******************************************************************************/
/*----------------------------------------------------------------------------*/
/* PORTFOLIO - IMAGE
/*----------------------------------------------------------------------------*/
/******************************************************************************/
	public function printPortfolioFeaturedImage($width, $height){
    global $post;
    $gallery = ffGalleryCollection::getGallery( $post->ID );
    
    $img_nonresized = $gallery->getFeaturedImage()->image->url;
    
    $img = fImg::resize( $img_nonresized, $width, $height, true);
    $link             = '';
    $dataGroup        = 'portfolio';
    $dataThumbTooltip = $oneImg->altText;
    $dataTitle        = $gallery->getFeaturedImage()->title;
    $dataDescription  = '';

    echo '<div class="portfolioImage">';
  		echo '<a class="jackbox"
                data-group="'.$dataGroup.'"
                data-thumbTooltip="'.$dataThumbTooltip.'"
                data-title="'.$dataTitle.'"
                data-description="'.$dataDescription.'"
                href="'.$img.'">';
    		echo '<div class="jackbox-hover jackbox-hover-blur jackbox-hover-magnify"></div>';
    		echo '<img width="'.$width.'" height="'.$height.'" src="'.$img.'" alt="" />';
    		echo '<span class="portfolioImageOver transparent"></span>';
  		echo '</a>';
		echo '</div>';
  }

/******************************************************************************/
/*----------------------------------------------------------------------------*/
/* PORTFOLIO - TITLE
/*----------------------------------------------------------------------------*/
/******************************************************************************/
	public function printPortfolioTitle(){
	$showTitle = true;
	
	if( $showTitle == false ) return;
		
    $link = get_permalink();//'portfolio-single.html';
    $tags = metaBoxManager::getMeta('portfolio_image_description');//'- illustration -';

    echo '<div class="portfolioText" data-targetURL="'.$link.'">';
  		echo '<span class="portfolioTextOver transparent"></span>';
  		echo '<p>';
  		the_title();
  		echo '</p>';
  		echo '<span>'.$tags.'</span>';
		echo '</div>';
		echo '<span class="portfolioArrow"></span>';
  }

/******************************************************************************/
/*----------------------------------------------------------------------------*/
/* PORTFOLIO - DESCRIPTION (OR EXCERPT - hidden)
/*----------------------------------------------------------------------------*/
/******************************************************************************/
	public function printPortfolioExcerpt(){

    global $post;

    echo '<div class="jackbox-description" id="description_'.$post->ID.'">';
  		echo '<h3>';
      the_title();
      echo '</h3>';
      the_excerpt();
      //echo '<a href="#">Link</a> ipsum dolor sit amet, consectetur adipiscing elit. In est metus, tincidunt vitae eleifend sit amet, porta a sapien. Fusce in dolor nec purus facilisis dictum. tincidunt sed quam.';
		echo '</div>';
  }

  public function printPortfolioSingleMainImage() {
  	global $post;
  	$video = metaboxManager::getMeta('featured_image_video_link');
  	if( !empty( $video ) ) {
  		$this->_printBlogLargeFeaturedImageVideo();
  		return;
  	}
  	$gallery = ffGalleryCollection::getGallery($post->ID);
  	$gallery->loadGalleryFromMeta('gallery_slider');
  	if( 1 == $gallery->getNumberOfImages() ) {
  		if( null != ($featuredImage = $gallery->getFeaturedImage() ) ) {
  			echo '<img class="scale-with-grid" src="'.$featuredImage->image->resize( 695, $height ).'" alt="" />';
  		} else {
  			echo '<img class="scale-with-grid" src="'.$gallery->getImage(0)->image->resize( 695, $height ).'" alt="" />';
  		}
  		return;
  	}
  	echo '
	  <section class="slider">
	  <div class="flexslider" data-arrows="false" data-thumbnail="true">
	  <ul class="slides">';
	  foreach( $gallery as $oneImg ) {
	  	
	  	echo '<li>';
	  	echo '<img src="'.$oneImg->image->resize(695,560, true).'">';
	  	echo '</li>';
	  }
	echo '	  
	  </ul>
	  </div>
  	</section>';
  }
  
  
  public function printPortfolioSingleTitle() {
  	$printTitle = (int)fEnv::getCategoryOption('show_title');
	$clickableTitle = (int)fEnv::getCategoryOption('clickable_title');
	
  	if( $printTitle != 0 ) {
  		if( $clickableTitle ) echo '<a href="'.get_permalink().'">';
  		echo '<h2>'. get_the_title().'</h2>';
  		if( $clickableTitle) echo '</a>';
  	}
  }
  
  public function printProjectDetails() {
  	$detailsTextUnsplitted = metaBoxManager::getMeta('project_details_text');
  	$detailsTitle = metaBoxManager::getMeta('project_details_title');
  	if( empty( $detailsTextUnsplitted) ) return;
  	
  	$detailsText = explode("\n", $detailsTextUnsplitted);
  	
  	echo '<div class="portfolioDetails four columns">';
  	echo '<h4>' . $detailsTitle . '</h4>';
  	echo '<ul>';
  		foreach( $detailsText as $oneLine ) {
  			$oneLineSplit = explode('!:!', $oneLine);
  			echo '<li>';
  				echo '<span class="black">';
  					echo $oneLineSplit[0];
  				echo '</span>';
  				if( isset( $oneLineSplit[1] ) ) echo $oneLineSplit[1];
  			echo '</li>';
  		}
  	
  	echo '</ul>';
  	echo '</div>';
  }

	public function title() {
		$title = get_the_title();
		$permalink = get_permalink();
		
		$clickable_title = fEnv::getCategoryOption('clickable_title');
		 
		
		$title_print = $title;
		if( $clickable_title == 1)
			$title_print = '<a href="'.$permalink.'">'. $title . '</a>';
		
		echo  '<h2>'.$title_print.'</h2>';
	}
	
	public function meta() {
 		$posted_by = fOpt::Get('translation', 'post-posted-by');
		$posted_in = fOpt::Get('translation', 'post-posted-in');
		
		if( fEnv::getCategoryOption('postmeta_author') == true ) {
			echo $posted_by. ' '; the_author_posts_link(); 
		}
		
		if( fEnv::getCategoryOption('postmeta_category') == true) {
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
		
		
		if( has_tag() && fEnv::getCategoryOption('postmeta_tags') == true ) {
			$tags=  fOpt::Get('translation', 'post-tags');
			the_tags(' <span class="post_meta_tags">', ', ','</span>');
		}
	}

	public function content() {
		
		the_content('', FALSE,'' );
	}
	public function additionalPostClasses() {
		global $wp_query;
		
		if(($wp_query->current_post + 1) == ($wp_query->post_count) )
			echo ' post_last';
		
		$wp_std_classes = get_post_class();
		$wp_std_classes_imploded = implode(' ', $wp_std_classes);
		
		echo ' '.$wp_std_classes_imploded;
	}
	public function formatedDate() {
		
		$permalingk = get_permalink();
		$date = fOpt::Get('translation', 'post-date');
		the_time( $date ); //fOpt::Get('translation', 'category-date') );
	}
	
	public function mainImage( $width, $height, $fixed_height = false ) { 
		$main_image = fEnv::getPostMainImage();
		if( empty($main_image) ) return;
		$fixed_height_to = fEnv::getCategoryOption('main_image_height');
		
		if( $fixed_height_to != 0 && $fixed_height_to != '0' && $fixed_height_to != '') {
			$height = $fixed_height_to;
			$fixed_height = true;
		} else {
			$height = false;
		}
		
		
		
		$clickable_image = fEnv::getCategoryOption( 'clickable_image' );
		$lightbox = fEnv::getCategoryOption( 'open_image_in_lightbox' );
		$imgInfo = fImg::ResizeC( $main_image['url'], $width, $height, $fixed_height, true);
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
				echo ' <img src="'.$imgInfo['url'].'" width="'.$imgInfo['width'].'" height="'.$imgInfo['height'].'" alt="'.$main_image['title'].'" class="featured_image" />';
				echo '<img src="'.get_template_directory_uri().'/images/featured_image_hover.png" class="featured_image_hover" alt="" />';
				echo '</a>';			
			}
	
			else {
				
				echo ' <img src="'.$imgInfo['url'].'" width="'.$imgInfo['width'].'" height="'.$imgInfo['height'].'" alt="'.$main_image['title'].'" class="featured_image" />';
				echo '<img src="'.get_template_directory_uri().'/images/featured_image_hover.png" class="featured_image_hover" alt="" />';
			}
		echo '</div>';
		echo '</div>';
					
					
	}

	public function commentCount() {
		$comments_number = get_comments_number();
		$permalink = get_permalink();
		echo '<a class="comments_count shadow" href="'.$permalink.'#comments"><span>' .  $comments_number . '</span></a>';
	}
	
	public function printShareButtons() {
		global $post;
		
		$buttonList = array('facebook', 'linkedin', 'twitter', 'pinterest', 'digg', 'yahoomail', 'reddit', 'stumbleupon', 'delicious', 'email');
		foreach( $buttonList as $oneButton ) {
			$show = fOpt::Get('social', 'post-'.$oneButton.'-show');
			if( 1 != (int)$show ) continue;
				
			$tooltip = fOpt::Get('social', 'post-'.$oneButton.'-tooltip');
			
			$atInfo = '';
			$atInfo .= 'addthis:url="'.get_permalink( $post ).'" '; 
			$atInfo .= 'addthis:title="'.$post->post_title.'" ';
			$atInfo .= 'addthis:description="'.addslashes(substr($post->post_content,0, 60)).'" ';
			/*
			 * 	addthis:url="http://example.com"
       			addthis:title="An Example Title"
       			addthis:description="An Example Description"
			 */
			echo '<a class="addthis_button_'.$oneButton.' tooltip" '.$atInfo.' data-tooltipText="'.$tooltip.'"></a>';
		}
	}
	
	public function printCommentsNumber() {
		$commZero = fOpt::Get('translation', 'post-comment-count-zero');
		$commOne = fOpt::Get('translation', 'post-comment-count-one');
		$commMore = fOpt::Get('translation', 'post-comment-count-more');
	
		comments_number( $commZero, $commOne, $commMore );
	}	
		
}
