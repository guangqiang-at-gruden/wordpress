<?php
/**
 * Hi, thank you for purchasing our template. From this file (functions.php) is included and started the whole framework,
 * and I will do my best to comment all the files. Below are included few useful notices, please read them:
 *
 * Notices
 * =======
 * 
 * - some important notice here
 *
 */


/**
 * Constant Definition
 * ===================
 * - theses constants are important for proper framework set-up
 * !!!!! DO NOT CHANGE WHEN CUSTOMIZING !!!!!!
 */ 
 include_once('functions/themeadmin.php');
add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
	load_theme_textdomain('wgenglish', get_template_directory() . '/languages');
}

add_action('wp_head', 'ff_print_custom_fonts');

function ff_print_custom_fonts() {
	ffGFonts::getInstance()->printFontCSS();
}


function ffgtd() {
	return 'wgenglish';
}

if ( ! isset( $content_width ) ) $content_width = 960;

add_theme_support( 'automatic-feed-links' );
define('THEMENAME', 'Wiseguys'); //!!!!! DO NOT CHANGE !!!!!!
define('THEMENAMELOW','wiseguys'); //!!!!! DO NOT CHANGE !!!!!!

// it's demo server ?
if( isset( $_SERVER['SCRIPT_URI'] ) && strpos($_SERVER['SCRIPT_URI'],'http://demo.freshface.net/file/') !== false )
	define('IS_DEMO_CONTENT', true); //!!!!! DO NOT CHANGE !!!!!!
else
	define('IS_DEMO_CONTENT', false);

define ('IS_USER_VERSION', false);

/**
 * !!!!AUTHOR DEFINITION!!!!
 * if you want to change the themename and author for your client, do it here NOT in "Constant Definition" above :)
 */
define('CUSTOM_THEMENAME', 'Wiseguys');
define('CUSTOM_AUTHORNAME', 'freshface');
//define('CUSTOM_VERSION', '1.0');
  
/**
 * Framework Initation
 * ===================
 * - just including the framework which is doing all the important stuff
 */ 
 require get_template_directory().'/framework/init.php';
 global $fprinter;		// printer is class common to all templates ( printing titles, time, comments and other stuff )
 fEnv::addNavigationMenu( __('Navigation',ffgtd()), 'navigation');
 fEnv::addNavigationMenu(__('Footer Menu',ffgtd()), 'footermenu');
 
$portfolio = new ffCustomPost('portfolio');
$portfolio->getArgs()
				->isPublic(true)
				->publiclyQueryable(true)
				->showUI(true)
				->showInMenu(true)
				->queryVar(true)
				->capabilityType('post')
				->taxonomyAdd('category')
				->taxonomyAdd('post_tag')
				->labels()
					->name( __('Portfolio', ffgtd()) )
					->singularName(__('Portfolio', ffgtd()) )
					->addNew(__('Add New', ffgtd()) )
					->addNewItem(__('Add New Portfolio', ffgtd()) )
					->editItem(__('Edit Portfolio', ffgtd()) )
					->newItem(__('New Portfolio', ffgtd()) )
					->allItems(__('All Portfolio', ffgtd()) )
					->viewItems(__('View Portfolio', ffgtd()) )
					->searchItems(__('Search Portfolio', ffgtd()) )
					->notFound(__('No Portfolio found', ffgtd()) )
					->notFoundInThrash(__('No Portfolio found in Trash', ffgtd()) )
					->parent_item_colon('')
					->menuName(__('Portfolio', ffgtd()) );

$portfolio->getArgs()->supports()
						->author()
						->comments()
						->customFields()
						->editor()
						->excerpt()
						->pageAttributes()
						->revisions()
						->thumbnail()
						->title()
						->trckbacks();
				
 
 
 
 
 
 $footerWidgetsCount = fOpt::Get('footer', 'footer-widget-count');
 
 register_sidebar( array(
	 'name' => __( 'Global Sidebar' , ffgtd()),
	 'id' => THEMENAMELOW . '-global',
	 'before_widget' => '<div id="%1$s" class="onefourth %2$s '.frameworkWidget::ADD_CLASS.'">',
	 'after_widget' => '</div>',
	 'before_title' => '<h4>',
	 'after_title' => '</h4>',) );
 
 register_sidebar( array(
	 'name' => __( 'Home'  , ffgtd()),
	 'id' => THEMENAMELOW . '-home',
	 'before_widget' => '<div id="%1$s" class="onefourth %2$s '.frameworkWidget::ADD_CLASS.'">',
	 'after_widget' => '</div>',
	 'before_title' => '<h4>',
	 'after_title' => '</h4>',) );
 
 
 register_sidebar( array(
 		'name' => __( 'Blog Sidebar'  , ffgtd()),
    	'id' => THEMENAMELOW . '-blog',
    	'before_widget' => '<div id="%1$s" class="onefourth %2$s '.frameworkWidget::ADD_CLASS.'">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4>',
    	'after_title' => '</h4>',) );
 
 register_sidebar( array(
	 'name' => __( 'Blog Single Sidebar'  , ffgtd()),
	 'id' => THEMENAMELOW . '-blog-single',
	 'before_widget' => '<div id="%1$s" class="onefourth %2$s '.frameworkWidget::ADD_CLASS.'">',
	 'after_widget' => '</div>',
	 'before_title' => '<h4>',
	 'after_title' => '</h4>',) );
 
 register_sidebar( array(
	 'name' => __( 'Portfolio Single Sidebar'  , ffgtd()),
	 'id' => THEMENAMELOW . '-portfolio-single',
	 'before_widget' => '<div id="%1$s" class="onefourth %2$s '.frameworkWidget::ADD_CLASS.'">',
	 'after_widget' => '</div>',
	 'before_title' => '<h4>',
	 'after_title' => '</h4>',) );

 register_sidebar( array(
	 'name' => __( 'Page'  , ffgtd()),
	 'id' => THEMENAMELOW . '-page',
	 'before_widget' => '<div id="%1$s" class="onefourth %2$s '.frameworkWidget::ADD_CLASS.'">',
	 'after_widget' => '</div>',
	 'before_title' => '<h4>',
	 'after_title' => '</h4>',) ); 

 register_sidebar( array(
 'name' => __('Contact Page' , ffgtd()),
 'id' => THEMENAMELOW . '-page-contact',
 'before_widget' => '<div id="%1$s" class="onefourth %2$s '.frameworkWidget::ADD_CLASS.'">',
 'after_widget' => '</div>',
 'before_title' => '<h4>',
 'after_title' => '</h4>',) );
 
 
 register_sidebar( array(
 'name' => __('Search' , ffgtd()),
 'id' => THEMENAMELOW . '-search', 
 'before_widget' => '<div id="%1$s" class="onefourth %2$s '.frameworkWidget::ADD_CLASS.'">',
 'after_widget' => '</div>',
 'before_title' => '<h4>',
 'after_title' => '</h4>',) );
 

 for ($i = 1; $i <= $footerWidgetsCount ; $i ++ ) {
    register_sidebar( array(
    	'name' => sprintf(__('Footer Widget Area #%s', ffgtd()), $i),
    	'id' => THEMENAMELOW . '-footer-' . $i,
      'before_widget' => '<div id="%1$s" class="widget %2$s '.frameworkWidget::ADD_CLASS.'">',
      'after_widget'  => '</div>',
    	'before_title' => '<h4>',
    	'after_title' => '</h4>',
    ) );
 }

 add_theme_support( 'post-thumbnails' );
 

function remove_categories_widget() { unregister_widget('WP_Widget_Categories'); }
add_action( 'widgets_init', 'remove_categories_widget' );


/**
 * SIDEBARS
 * ========
 */

add_filter('widget_text', 'do_shortcode'); // Adds the ability to use shortcodes in Widgets

$custom_sidebar_collection = new fSidebarCollection();
foreach( $custom_sidebar_collection->getSidebars() as $id => $name ) {
	register_sidebar(array(
	'name' => $name,
	'id' => THEMENAMELOW.'custom'.$id,
	'description' => 'This is a custom sidebar',
	'before_widget' => '<div id="%1$s" class="onefourth %2$s '.frameworkWidget::ADD_CLASS.'">',
	 'after_widget' => '</div>',
	 'before_title' => '<h4>',
	 'after_title' => '</h4>',
	));
}

function printAddThisScript() {
	$pubId = fOpt::Get('social', 'custom-addthis');
	$trackAddressBar = fOpt::Get( 'social', 'custom-addthis-addressbar');
	echo '<script type="text/javascript">var addthis_config = {"data_track_addressbar":'.$trackAddressBar.'};</script>';
	echo '<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid='.$pubId.'"></script>';
}



$is_main_loop = true;

function change_posts_per_page( $query ) {
	//return;
	
	global $is_main_loop;
	

	if( !$is_main_loop ) return;
	$is_main_loop = false;
	
	
	
	
	if( $query->is_home || $query->is_category || $query->is_search ||$query->is_author || $query->is_archive ) {
		$ppp = fEnv::getCategoryOption( 'posts_per_page' );
		if( $ppp != 0 && $ppp != '0' && $ppp != '')
			$query->set('posts_per_page', fEnv::getCategoryOption( 'posts_per_page' ) );
		
			$currentPostTypes = $query->get('post_type');
			if( empty( $currentPostTypes ) ) {
				$query->set('post_type', array('post', 'portfolio'));
			}
			else {
				if( is_string($currentPostTypes) ) $currentPostTypes = array($currentPostTypes);  
				$currentPostTypes = array_merge( $currentPostTypes, array( 'portfolio' ) );
			}
	
	}

	
/*	if( $query->is_home ) {
		$cat_id = fOpt::Get('homepage', 'category-feed-id');
		if( !empty($cat_id ) )
			$query->set('cat',$cat_id);
	}*/
	/*if( $query->is_home || $query->is_category || $query->is_search ||$query->is_author || $query->is_archive ) {
		$ppp = fEnv::getCategoryOption( 'posts_per_page' );
		if( $ppp != 0 && $ppp != '0' && $ppp != '')
			$query->set('posts_per_page', fEnv::getCategoryOption( 'posts_per_page' ) );

		$order = fEnv::getCategoryOption('order');
		$order_by = fEnv::getCategoryOption('order_by');

		if($order != 'default' || $order != '')
			$query->set('order',$order);

		if($order_by != 'default' || $order_by != '')
			$query->set('orderby',$order_by);

	}*/

/*	if( ($query->is_home || $query->is_category) && isset( $_GET['tag_gfw'] ) )
	{

		$tag = $_GET['tag_gfw'];
		$query->set('tag', $tag);
		$q2 = $query;
		$q2->post_count = 0;
		$custom_query = new WP_Query($q2);

		$post_count = 0;
		while ( $custom_query->have_posts() ) : $custom_query->the_post();
		$tags = get_the_tags();
		if( !empty($tags) ) {
			foreach( $tags as $one_tag) {
				if( $one_tag->slug == $tag ) {
					$post_count ++;
					break;
				}
			}
		}
		endwhile;

		$qvars = $custom_query->query_vars['query_vars'];
		$paged = $qvars['paged'];
		$ppp = $qvars['posts_per_page'];

		if( $ppp == 0)
			$ppp = get_option('posts_per_page');

		$max_paged = $post_count / $ppp;

		if( ( $max_paged * $ppp ) < $post_count )
			$max_paged ++;


		if( $paged > $max_paged ) {
			$query->set('paged',$max_paged);
		}

	}*/
}
add_filter( 'pre_get_posts', 'change_posts_per_page' );

function getOtherBodyClass() {
	$layout = fOpt::Get('skins', 'theme-layout-skin');
	if( empty( $layout ) ) $layout = 'fullwidth';
	return $layout;
}

function printCustomJavascript() {
	$js = fOpt::Get('customcode', 'custom-javascript');
	if( !empty( $js ) ) {
		echo '<script type="text/javascript">';
			echo $js;
		echo '</script>';
	}
}
function printCustomTracking() {
	$tracking = fOpt::Get('customcode', 'custom-tracking');
	if( !empty( $tracking ) ) {
		echo $tracking;
	}
}
function printCustomCss() {
	$css = fOpt::Get('customcode', 'custom-css');
	if( !empty( $css ) ) {
		echo '<style type="text/css">';
			echo $css;
		echo '</style>';
	}
}

function ff_get_home_class() {
	if( is_home() || ( is_page() && metaboxManager::getMeta('slider_show') == metaboxManager::CHECKED_FIELD ) ) 
		return 'home';
	else 
		return '';
}

function ff_get_logo_url() {
	
	$logoUrlCustom = fOpt::Get('header','logo-url');//'.get_template_directory_uri().'/images/icons/'.fOpt::Get('skins','theme-color-skin').'/logo.png';
	
	if( !empty( $logoUrlCustom ) ) {
		$logoUrl = $logoUrlCustom;
	} else {
		$logoUrl = get_template_directory_uri().'/images/icons/'.fOpt::Get('skins','theme-color-skin').'/logo.png';
	}
	
	return $logoUrl;
}

ffRevSliderConnector::getInstance()->getSliders();


function ff_get_container_image_attributes_from_themeopt() {
	$bgImageType = fOpt::Get('skins', 'theme-background-type');
	
	if( $bgImageType == 'color')
		$bgImageUrl = '#'.fOpt::Get('skins', 'theme-background-color');
	else
		$bgImageUrl = fOpt::Get('skins', 'theme-background-image');
	
	
	if( empty( $bgImageUrl ) || $bgImageUrl == '#' ) {
		$bgImageType = 'color';
		$bgImageUrl = '#dddddd';
	}
	
	return ' data-backgroundType="'.$bgImageType.'" data-backgroundImage="'.$bgImageUrl.'" ';
}
function ff_get_container_image_attributes() {
	$bgImageType = null;
	$bgImageUrl = null;
	
	
	// is category, single post or single portfolio, but not page
	if( (is_category() || is_singular() || is_tag()  || is_author() || is_date() || is_archive() || is_search() ) && !is_page() ) {
		
		$bgImageType = fEnv::getCategoryOption('description_bg_type');
		if( $bgImageType == 'default' ) 
			return ff_get_container_image_attributes_from_themeopt();
		else if( $bgImageType == 'color') {
			$bgImageUrl = fEnv::getCategoryOption('description_bg_color');
			if( empty($bgImageUrl) )
				$bgImageUrl = 'dddddd';
			$bgImageUrl = '#'.$bgImageUrl;
		} else {
			$bgImageUrl = fEnv::getCategoryOption('description_img');
			if( empty( $bgImageUrl ) ) {
				$bgImageType = 'color';
				$bgImageUrl = '#dddddd';
			}
		}
		
	}	else if( is_page() ) {
		$bgImageType = metaBoxManager::getMeta('description_bg_type');
		if( $bgImageType == 'default' )
			return ff_get_container_image_attributes_from_themeopt();
		else if( $bgImageType == 'color') {
			$bgImageUrl = metaBoxManager::getMeta('description_bg_color');
			if( empty($bgImageUrl) )
				$bgImageUrl = 'dddddd';
			$bgImageUrl = '#'.$bgImageUrl;
		} else {
			$bgImageUrl = metaBoxManager::getMeta('description_bg_image');
			if( empty( $bgImageUrl ) ) {
				$bgImageType = 'color';
				$bgImageUrl = '#dddddd';
			}
		}
		
	}
	else {
		return ff_get_container_image_attributes_from_themeopt();
	}
	
	return ' data-backgroundType="'.$bgImageType.'" data-backgroundImage="'.$bgImageUrl.'" '; 
	
}

function post_pagination() {
	wp_link_pages(array('before' => '<p>','after' => '</p>') );
}


function print_disqus_comments() {
	
	$shortname = fOpt::Get('disqus', 'username' );
	?>
	<div id="disqus_thread"></div>
	<script type="text/javascript">
		/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
		var disqus_shortname = '<?php echo $shortname; ?>'; // required: replace example with your forum shortname
		 
		/* * * DON'T EDIT BELOW THIS LINE * * */
		(function() {
			var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
			dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
			(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		})();
	</script>
	<noscript><?php echo fOpt::Get('disqus', 'javscript-off');?></a></noscript>
	<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
	<?php 
}

function printCommentsNavInside() {
	echo '<a href="';
	paginate_links();
	paginate_comments_links();
	echo '">Pagination</a>';
}

function printDisqusScript() {
	if( fOpt::Get('disqus', 'show-comments') == 1 ) {
		$shortname = fOpt::Get('disqus', 'username' );
		print_disqus_comment_script( $shortname );
	}
}

function disqus_comment_count() {
	echo '<a href="'. get_permalink() .'#disqus_thread">Link</a>';
	
}

function ff_comments_popup_link( $zero, $one, $more, $css_class = null, $none = 'Comments Off') {
	if( fOpt::Get('disqus', 'show-comments') == 1 ) {
		disqus_comment_count();
	} else {
		comments_popup_link( $zero, $one, $more, $css_class, $none );
	}
}

function disqus_comment_count_script() {

if( fOpt::Get('disqus', 'show-comments') != 1 ) return;
	$disqus_shortname = fOpt::Get('disqus', 'username' );
?>
	<script type="text/javascript">
/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
	var disqus_shortname = '<?php echo $disqus_shortname; ?>'; // required: replace example with your forum shortname

/* * * DON'T EDIT BELOW THIS LINE * * */
	(function () {
	var s = document.createElement('script'); s.async = true;
	s.type = 'text/javascript';
	s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
	(document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
	}());
	</script>
<?php 
}

require_once dirname( __FILE__ ) . '/install/install.php';

function ff_nav_menu_does_not_exists() {
	wp_deregister_script('ddSmoothMenu');
	echo '<div style="position: relative; font-style: italic; color: darkorange; margin: 35px 0 0 0;">Hello world! Please create a Top Navigation Menu and assign it in "Appereance &rarr; Menus &rarr; Theme Locations"</div>';
}
	

function ff_nav_menu_footer_does_not_exists() {
	echo '<div style="position: relative; font-style: italic; color: darkorange; margin: 17px 0 0 0; float: right;">Hello world! Please create a Footer Navigation Menu and assign it in "Appereance &rarr; Menus &rarr; Theme Locations"</div>';
}

function ff_tiny_mce( $teeny = false, $settings = false ) {
	static $num = 1;

	if ( ! class_exists('_WP_Editors' ) )
		require_once( ABSPATH . WPINC . '/class-wp-editor.php' );

	$editor_id = 'content' . $num++;

	$set = array(
		'teeny' => $teeny,
		'tinymce' => $settings ? $settings : true,
		'quicktags' => false
	);

  // http://wordpress.org/support/topic/tinymce-error-missing-js-files-breaks-on-every-upgrade
  // Idiots from WP
  global $locale;
  $tmp_locale = $locale;
  $locale = 'en';

	$set = _WP_Editors::parse_settings($editor_id, $set);
	_WP_Editors::editor_settings($editor_id, $set);

  // Idiots from WP
  $locale = $tmp_locale;
}


function ff_editor($content, $id = 'content', $prev_id = 'title', $media_buttons = true, $tab_index = 2, $extended = true) {

	wp_editor( $content, $id, array( 'media_buttons' => $media_buttons ) );
	return;
}

function printDisablingLightbox() {
	$selector = '';
	//var_dump( (int)fOpt::Get('lightbox', 'disable-global')  );
	if( (int)fOpt::Get('lightbox', 'disable-global') == 1 ) {
		$selector = 'a.jackbox';
	} else {
		if( (int)fOpt::Get('lightbox', 'disable-portfolio') == 1 ) {
			$selector = ' .portfolioImage a.jackbox'; 
		} 
		if( (int)fOpt::Get('lightbox', 'disable-featured-works' ) == 1 ) {
			if( !empty( $selector ) ) $selector .= ', ';
			$selector .= ' .carousel a.jackbox';
		}
	}
	
	if( empty( $selector) ) return;
	
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
		
			$('<?php echo $selector; ?>').each(function() {
		
				var a = $(this);
				var url = a.parent().parent().find('[data-targetURL]').attr('data-targetURL');
		
				a.removeClass('jackbox');
				a.attr('data-group','');
				a.attr('data-thumbTooltip','');
				a.attr('data-autoplay','');
				a.attr('data-title','');
				a.attr('href',url);
		
			});
		});
	</script>
	<?php 
}


add_action('wp_footer', 'wg_print_custom_footer_codes', 9999);
function wg_print_custom_footer_codes() {
	printDisablingLightbox();
	printCustomJavascript();
}





add_action('wp_head', 'wg_print_custom_header_codes', 9999);
function wg_print_custom_header_codes() {
	printAddThisScript();
	printCustomCss();
	
	printCustomTracking();
}

add_filter('upload_mimes',array('ffGFonts', 'addFontMimes'));

function ff_pagebuilder_sortables(){
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-droppable');
	wp_enqueue_script('jquery-ui-draggable');
}
add_action( 'admin_init', 'ff_pagebuilder_sortables' );
