<?php
function ff_include_all_scripts() {
	
    $turl = get_template_directory_uri();
    
    /*
     * 
     * <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
	
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jacked.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/slackBlur.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/ddsmoothmenu.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.touchSwipe.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.tweet.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.isotope.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/jackbox/js/libs/jquery.address-1.5.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/jackbox/js/jackbox-swipe.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/jackbox/js/jackbox.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/jackbox/js/libs/StackBlur.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/tipsy/jquery.tipsy.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.flexslider.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.fitvids.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/sharing.js"></script>
	
	
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/wiseguys.min.js"></script>
	
	
	
	// before
	 * 	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/base.css"/>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/skeleton.css"/>
	
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/jackbox/css/jackbox_hovers.css"/>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/jackbox/css/jackbox.css"/>
	
	
	//after
	 * <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/layout.css"/>
	
     */
    
    wp_enqueue_style('wg-base', get_template_directory_uri().'/css/base.css' );
    wp_enqueue_style('wg-skeleton', get_template_directory_uri().'/css/skeleton.css' );
    wp_enqueue_style('wg-jakcbox_hovers', get_template_directory_uri().'/jackbox/css/jackbox_hovers.css' );
    wp_enqueue_style('wg-jackbox', get_template_directory_uri().'/jackbox/css/jackbox.css' );
    
    
    
    wp_enqueue_script("jquery");  // JQUERY including by wordpress
    if ( IS_DEMO_CONTENT || true ) {
    	wp_enqueue_script('menuAdjustment', $turl . '/js/menu.adjustment.js',  false, false, true );
    }
    /************************************
     * Javascript commont for whole template
    ***********************************/
    wp_enqueue_script('jQueryUiMin', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js' );
    
    wp_enqueue_script('jacked', $turl . '/js/jacked.min.js' , false, false, true );
    wp_enqueue_script('jqEasing', $turl . '/js/jquery.easing.1.3.min.js' ,  false, false, true);
    wp_enqueue_script('slackBlur', $turl . '/js/slackBlur.min.js' ,  false, false, true);
    wp_enqueue_script('ddSmoothMenu', $turl . '/js/ddsmoothmenu.min.js' ,  false, false, true);
    wp_enqueue_script('touchSwipe', $turl . '/js/jquery.touchSwipe.min.js' ,  false, false, true);
    //wp_enqueue_script('tweet', $turl . '/js/jquery.tweet.min.js' , false, true);
    wp_enqueue_script('isotope', $turl . '/js/jquery.isotope.min.js' ,  false, false, true);
    wp_enqueue_script('address', $turl . '/jackbox/js/libs/jquery.address-1.5.min.js' ,  false, false, true);
    wp_enqueue_script('jackboxSwipe', $turl . '/jackbox/js/jackbox-swipe.min.js' ,  false, false, true);
    wp_enqueue_script('jackbox', $turl . '/jackbox/js/jackbox.js' ,  false, false, true);
    wp_enqueue_script('stackBLur', $turl . '/jackbox/js/libs/StackBlur.min.js' ,  false, false, true);
    wp_enqueue_script('tipsy', $turl . '/js/tipsy/jquery.tipsy.js' ,  false, false, true);
    wp_enqueue_script('flexslider', $turl . '/js/jquery.flexslider.min.js' ,  false, false, true);
    wp_enqueue_script('fitvids', $turl . '/js/jquery.fitvids.min.js' ,  false, false, true);
    wp_enqueue_script('themepunchPlugins', $turl . '/rs-plugin/js/jquery.themepunch.plugins.min.js' ,  false, false, true);
    //wp_enqueue_script('revolutionsLider', $turl . '/rs-plugin/js/jquery.themepunch.revolution.min.js' );
    wp_enqueue_script('sharing', $turl . '/js/sharing.js' ,  false, false, true);
    wp_enqueue_script('wiseguys', $turl . '/js/wiseguys.min.js' ,  false, false, true);
    
    wp_enqueue_style('wg-layout', get_template_directory_uri().'/css/layout.css' );
    wp_enqueue_style('wg-colors', get_template_directory_uri().'/css/colors/'.fOpt::Get('skins', 'theme-color-skin').'Theme.css' );
}    
 
add_action('wp_enqueue_scripts', 'ff_include_all_scripts'); // For use on the Front end (ie. Theme)
?>