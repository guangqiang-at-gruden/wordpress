<?php
/**
 * Templater class is loading all custom made templates
 */


class ffTemplater {
	public static function requirePortfolioSingle() {
		global $fprinter;
		if( metaBoxManager::getMeta('fw_sidebar_position') == 'fullwidth' ) {
			require get_template_directory().'/templates/single-portfolio/single-fullwidth.php';
		} else {
			require get_template_directory().'/templates/single-portfolio/single.php';
			require get_template_directory().'/templates/sidebars/sidebar.php';
		}
	}
	
	public static function requireHomepage() {
		echo '<section class="mainContent">';
		ffTemplater::requireLowerDescription();
		if ( fOpt::get('homepage', 'show-page') == 1) {
			
			
					
					echo '<section class="sixteen columns offset-by-one">';
					ffTemplater::requireHomepagePage(); 
					echo '</section>';
			
		}
		self::requireHomepageCategory();
		
		
		echo '<div class="clearfix"></div>';
		echo '</section><!-- End // main content -->';
		
	}
	public static function requireHomepagePage() {
		$content_page_id = fOpt::Get('homepage', 'content-page');
		$page = get_page( $content_page_id );
		
		if( $page == null ) {
			$pages = get_pages();
			$content_page_id = $pages[0]->ID;
		}
		
		$page = get_page( $content_page_id );
		// category-actionbar-show
		setup_postdata( $page );
		the_content();
	}
	public static function requireHomepageCategory() {
		
			if( fOpt::Get('homepage', 'category-feed-show') == 1 ) {
				
				ffTemplater::requireCategory();
				ffPartLoader::getInst()->loadSidebar();
			}
	}
	public static function requireLowerDescription() {
		$showSlider = fOpt::Get('homepage','slider-show');
		if( (int)$showSlider === 1 )
			ffPartLoader::getInst()->loadLowerDescription();
	}
	public static function requireHomepageSlider() {
		
		if( is_home() ) {
			$showSlider = fOpt::Get('homepage','slider-show');
			if( (int)$showSlider === 1 ) 
				require get_template_directory() .'/templates/slider/slider.php';
		} else if ( is_page() && metaboxManager::getMeta('slider_show') == metaboxManager::CHECKED_FIELD ) {
			require get_template_directory() .'/templates/slider/slider.php';
		}
	}
	public static function requireCategory() {
		
		//self::requireSortable();
		$actual_cat_template = fEnv::getActualTemplate();
		//if( ( is_home() || is_front_page() ) && fOpt::Get('homepage' , 'category-display') != true  && fOpt::Get('homepage', 'category-display') != null)
			//return;
		
		global $fprinter;
		if( $actual_cat_template == null) return;
			//
			
		
		require get_template_directory().'/templates/'.$actual_cat_template;
		
	}
	
	public static function requireCategoryDescriptionBig() {
		
		if( fEnv::getCategoryOption( 'description_show' ) == 1  )
			require get_template_directory().'/templates/description/description-upper.php';
	}
	
	public static function requireCategoryDescriptionSmall() {
		$descText = fEnv::getCategoryOption('description_text_small');
		if( fEnv::getCategoryOption( 'description_show' ) == 1  &&  !empty( $descText ) )
			require get_template_directory().'/templates/description/description-lower.php';
	}
	//require get_template_directory().'/templates/description/description-upper.php';
//require get_template_directory().'/templates/description/description-lower.php';
/*
 * 	ffTemplater::requireCategoryDescriptionBig();
?>
<section class="mainContent">        
<?php
	ffTemplater::requireCategoryDescriptionSmall();
 */
}

/*
class Templater {
	
	private static function requireTemplate( $url ) {
		require get_template_dir(). $url;
	}
	public static function requireSearch( $sidebar ) {
		if( $sidebar == 'Right' )
			self::requireTemplate( '/templates/search/search_404-1.php');
		else 
			self::requireTemplate( '/templates/search/search_404-2.php');
	}
	public static function requireHeader() {
		$header_a_show = fOpt::Get('templates', 'header-a-show');
		$header_b_show = fOpt::Get('templates', 'header-b-show');
		
		$header_a_template = fOpt::Get('templates', 'header-a-template');
		$header_b_template = fOpt::Get('templates', 'header-b-template');
		
		if( $header_a_show == 1 )
			self::requireTemplate( '/templates/header/'. $header_a_template . '.php');
		if( $header_b_show == 1 )
			self::requireTemplate( '/templates/header/'. $header_b_template . '.php');

	}
	

	public static function requireContentTemplate( $show_action_bar = true) {
		$content_page_id = fOpt::Get('homepage', 'content-page');
		$page = get_page( $content_page_id );
		
		if( $page == null ) {
			$pages = get_pages();
			$content_page_id = $pages[0]->ID;
		}
		
		$page = get_page( $content_page_id );
		// category-actionbar-show
		if( $show_action_bar === true) {
			
			self::requireActionPanel( $content_page_id);
		}
		
	echo '<div class="content_container">';
	echo '<div class="content_wrapper">';
 	echo '<div class="content type_page">';
 	echo '<div class="post_content">';
	
	
	
	setup_postdata( $page );
	the_content();

	echo '</div>';
	echo '</div>';
	echo '<div class="clear"></div>';
	echo '</div>';
	echo '</div>';
	}
	
	public static function requireNavigation() {
		$template = fOpt::Get('templates', 'header-navigation');
		if( $template == null ) $template = 'navigation-1';
		require get_template_dir().'/templates/navigation/'. $template . '.php';
	}
	
	public static function requireSlider() {
		if( fOpt::Get('homepage', 'slider-show') != 1 ) return false;
		
		$slider_name = fOpt::Get('homepage', 'homepage-slider');
		if( $slider_name == '' ) return false;
		$slider = fSliderFactory::getSlider( $slider_name);
		$slider_dimensions = $slider->getDimensions();
		

		echo '<div id="slider_container"><div id="slider_container_background_light"><div id="slider_container_shadow_top"><div id="slider_container_shadow_bottom"><div id="slider_container_borders">';
			echo '<div id="slider_wrapper">';
				
				$slider->printSlider();
				$slider->printScript();

			echo '</div>';
		echo '</div></div></div></div></div>';
			
	}
	
	public static function requireColorStripe() {
		if( is_home() || is_front_page() )
			self::requireSlider();
		else {
			
			$title = false;
			$title_show = true;
			if( is_category() || is_archive() || is_author() || is_tag() || is_date()) {
				
				$cat_desc = category_description();
				$show_description_catman = fEnv::getCategoryOption('description_show');
				
				if( $show_description_catman != 1 )
					return false;
				if( $cat_desc != '' || $show_description_catman == 1  ) {
					self::requireTitle();
					
					$title = true;
				}
				
				
			}
			else if( is_single() ) {
				
				global $post;
				$show = get_post_meta( $post->ID, 'fw_post_description_show', true);
				$show = (int)$show;
				
				//if( $show == 0 && fEnv::getSingleOption('description_show') != 1  )
//					return;
				
			//	if(  )
				//	return false;
			 	
				//$show = category_description( fEnv::getActualCat() );
				//$show_description_cat = fEnv::getCategoryOption('description_show');
				$show_description_catman = (int)fEnv::getSingleOption('description_show');
				
				if( $show != 0 || ($show_description_catman == 1)) {
					
				
					self::requireTitle();
					$title = true;
				} else {
					$title_show = false;
				}
			}
			else if( is_page() ) {
				global $post;
				$show = get_post_meta( $post->ID, 'fw_page_description_show', true);
				 $content = get_post_meta( $post->ID, 'fw_page_description', true);
				if( $show == 1 ) {
					self::requireTitle();
					$title = true;
				}
			}
			
			if( $title == false && $title_show == true && fOpt::Get('templates', 'descriptionbar-show') == 1) {
				self::requireTitle();
			}
		}
	}
	
	public static function requireActionPanel( $page_id = null) {
		global $post;
		
		$take_global = false;
		if( $page_id != null ) {
			
			//var_dump((get_post_meta( $page_id, 'fw_page_actionpanel_show', true ) === ''));
			if( (int)get_post_meta( $page_id, 'fw_page_actionpanel_show', true ) !== 1 && (get_post_meta( $page_id, 'fw_page_actionpanel_show', true ) !== '') )
				return false;
			$a_left = get_post_meta($page_id, 'fw_page_actionpanel_left', true);
			$a_right = get_post_meta($page_id, 'fw_page_actionpanel_right', true);
			$a_button = get_post_meta($page_id, 'fw_page_actionpanel_button', true);
			$a_button_link = get_post_meta($page_id, 'fw_page_actionpanel_button_link', true);
			
		}
		else {
			if ( is_page()  ) {
				
				if( get_post_meta( $post->ID, 'fw_page_actionpanel_show', true ) != 1 )
					return false;
				$a_left = get_post_meta($post->ID, 'fw_page_actionpanel_left', true);
				$a_right = get_post_meta($post->ID, 'fw_page_actionpanel_right', true);
				$a_button = get_post_meta($post->ID, 'fw_page_actionpanel_button', true);
				$a_button_link = get_post_meta($post->ID, 'fw_page_actionpanel_button_link', true);
			
			
			} else if( ( is_category() && !is_single() ) || is_home() || is_front_page() || is_archive() || is_date() || is_author() || is_tag() ) {
				
					if( fEnv::getCategoryOption('action_show') != 1 )
						return false;
					
					$a_left = fEnv::getCategoryOption('action_left');
					$a_right = fEnv::getCategoryOption('action_right');
					$a_button = fEnv::getCategoryOption('action_button');
					$a_button_link = fEnv::getCategoryOption('action_button_link');
			} else if ( is_single() ) {
				
				if( fEnv::getSingleOption('action_show') != 1 && get_post_meta( $post->ID, 'fw_post_actionpanel_show', true ) != 1)
					return false;
				

					
				
					$a_left = get_post_meta($post->ID, 'fw_post_actionpanel_left', true);
					$a_right = get_post_meta($post->ID, 'fw_post_actionpanel_right', true);
					$a_button = get_post_meta($post->ID, 'fw_post_actionpanel_button', true);
					$a_button_link = get_post_meta($post->ID, 'fw_post_actionpanel_button_link', true);
					
					if( ( empty( $a_left ) && empty( $a_right ) && empty( $a_button ) ) ) {
						
						$a_left = fEnv::getSingleOption('action_left');
						$a_right = fEnv::getSingleOption('action_right');
						$a_button = fEnv::getSingleOption('action_button');
						$a_button_link = fEnv::getSingleOption('action_button_link');
					}
			}
		}
		
		if( ( empty( $a_left ) && empty( $a_right ) && empty( $a_button ) ) )
			$take_global = true;
		if( $a_left == ' ' && $a_right == ' ' && $a_button == ' ')
			$take_global = true;

		if( $take_global === true  && fOpt::Get('templates', 'actionbar-show') == 1) {
			
			$a_left = fOpt::Get('templates', 'actionbar-left');
			$a_right = fOpt::Get('templates', 'actionbar-right');
			$a_button = fOpt::Get('templates', 'actionbar-button');
			$a_button_link = fOpt::Get('templates', 'actionbar-buttonlink');
		}
		else if( $take_global === true) {
			return false;
		}
		
		require get_template_dir().'/templates/action/action-1.php';
	}
	
	public static function requireTitle() {
		require get_template_dir() . '/templates/title/title-1.php';
	}
	
	public static function requireSingleSlider() {
		require get_template_dir() . '/templates/slider/slider-1.php';
	}
	
	public static function requireMessage() {
		if( fOpt::IsTrue('homepage', 'messagebox-display'))
		require get_template_dir().'/templates/home/message-1.php';
	}
	
	public static function requireHome() {
		require get_template_dir().'/templates/home/home-1.php';
	}
	
	public static function requireHomeCategoryFeed() {
		require get_template_dir().'/templates/blog/blog-cat-1.php';
	}
	
	public static function requireSidebar( $name ) {
		require get_template_dir().'/templates/sidebar/'. $name . '.php';
	}
	public static function requireCategory( $show_category_actionbar = true ) {
		
		if( $show_category_actionbar === true )
			self::requireActionPanel();
		
		self::requireSortable();
		$actual_cat_template = fEnv::getActualTemplate();
		if( ( is_home() || is_front_page() ) && fOpt::Get('homepage' , 'category-display') != true  && fOpt::Get('homepage', 'category-display') != null)
			return;
		
		global $fprinter;
		//if( $actual_cat_template == null) 
		require get_template_dir().'/templates/'.$actual_cat_template;
		
	}
	
	public static function requireHomepageTemplate() {
		
		if( (int)fOpt::Get('homepage', 'show-page') == 1 ) {
			
			//category-actionbar-show 
			$show_page_actionbar = fOpt::Get('homepage', 'page-actionbar-show');
		 	if( $show_page_actionbar == 1) $show_page_actionbar = true;
		 	else $show_page_actionbar = false;
		 	
		 	
			Templater::requireContentTemplate($show_page_actionbar);
		}
		if( fOpt::Get('homepage', 'category-feed-show') == 1 ) {
		
			$show_category_actionbar = fOpt::Get('homepage', 'category-actionbar-show');
			if( $show_category_actionbar == 1) $show_category_actionbar = true;
			else $show_category_actionbar = false;
			Templater::requireCategory($show_category_actionbar);
		}
 		
	}
	
	public static function requireSortable() {
		if( fEnv::getCategoryOption('sortable_show') == 1 ) { 
			require get_template_directory() . '/templates/sortable/sortable-1.php';
		}
	}
	
	public static function requireComments() {
		if( is_single() && !is_page() && comments_open() == 1 && fEnv::getSingleOption('enable_comments') == 1 )	comments_template();
		else if( is_page() && comments_open() == 1 ) comments_template();
		
	}
	
	public static function requireSingle() {
			
		self::requireActionPanel();
		$actual_single_template = fEnv::getActualTemplate();
		
		global $fprinter;
		require get_template_dir().'/templates/'.$actual_single_template;		
	}
	
	public static function getCategoryType() {
		return 'blog';
	}
	
	public static function requireFooter_social() {
		if( fOpt::Get('footer', 'footer-social-show') != false )
			require get_template_dir(). '/templates/footer/footer_s-1.php';
	}
	
	public static function requireFooter_1() {
		if( fOpt::Get('footer', 'footer-a-show') != false )
			require get_template_dir(). '/templates/footer/footer_a-1.php';
	}

	public static function requireFooter_2() {
		if( fOpt::Get('footer', 'footer-b-show') != false )
			require get_template_dir(). '/templates/footer/footer_b-1.php';
	}
}*/
?>