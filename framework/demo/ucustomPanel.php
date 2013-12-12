<?php
fCustomPanelManager::getInstance();


function my_scripts_method2() {
if( !is_admin() ) {
	//wp_enqueue_script(rand(time(), 50),  get_template_directory_uri().'/framework/demo/customPanel.js');
	//wp_enqueue_style(rand(time(), 50),  get_template_directory_uri().'/framework/demo/customPanel.css');
}
	//echo 'aaaxxx';

}
add_action('wp_enqueue_scripts', 'my_scripts_method2'); // For use on the Front end (ie. Theme)

add_action('fw_body_start', 'print_livepanel');



function print_portfolio_options($default, $selected = null) {
	$portfolio = fLiveDataHolder::$portfolio;
	print_select_options( $portfolio, $default, fCustomPanelManager::getInstance()->portfolioTemplate );
}

function print_blog_options($default, $selected = null) {
	$blog = fLiveDataHolder::$blog;
	print_select_options( $blog, $default, fCustomPanelManager::getInstance()->blogTemplate );
}

function print_single_options( $default, $selected = null ) {
	$single = fLiveDataHolder::$single;
	$singleTemplate = fCustomPanelManager::getInstance()->singleTemplate;
	//var_dump($singleTemplate);
	if( $singleTemplate !== null ) {
		unset( $single[0] );
	}
	print_select_options( $single, $default, fCustomPanelManager::getInstance()->singleTemplate );
}

function print_headerskin_options( $default, $class ) {
	$skins = fLiveDataHolder::$headerSkins;
	$default = fOpt::Get('skins', 'theme-header-skin');
	$selected = fCustomPanelManager::getInstance()->headerSkin;
	print_select_options( $skins, $default, $selected, $class );
}

function print_skin_options( $default, $class) {
	$skins = fLiveDataHolder::$skins;
	$default = fOpt::Get('skins', 'theme-color-skin');
	$selected = fCustomPanelManager::getInstance()->themeSkin;
	print_select_options( $skins, $default, $selected, $class );

}

function print_slider_options( $default,$class ) {
	$sliders = fLiveDataHolder::$sliders;
	$default = fOpt::Get('homepage', 'homepage-slider');
	$selected = fCustomPanelManager::getInstance()->slider;
	print_select_options( $sliders, $default, $selected, $class );
}


function print_logo_preloading() {
	echo '<div style="display:none;">';
		foreach( fLiveDataHolder::$skins as $oneSkin ) {
			foreach( fLiveDataHolder::$headerSkins as $oneHeaderSkin ) {
				$src = get_template_directory_uri() . '/skins/' . $oneSkin['value'] . '/images/logo_'. $oneHeaderSkin['value'] .'.png';
				echo '<img src="'.$src.'" />';
			}
		}
	echo '</div>';
}

function print_skin_preloading() {
	$skins = fLiveDataHolder::$skins;
	echo '<div class="skin_preloader" style="display:none">';
	foreach( $skins as $oneSkinHolder ) {
		$skinName = $oneSkinHolder['value'];
		echo '<img src="' . get_template_directory_uri() . '/skins/' .$skinName .'/' . $skinName.'.css" />';
	}
	echo '</div>';
}

function print_img_preloading() {
	$skins =  array( array('name'=>'Blue', 'value'=>'blue'), array('name'=>'Green', 'value'=>'green'), array('name'=>'Orange', 'value'=>'orange'), array('name'=>'Purple', 'value'=>'purple'), array('name'=>'Gold', 'value'=>'gold'), array('name'=>'Grey', 'value'=>'grey'), array('name'=>'Metal Turquoise', 'value'=>'metal_turquoise') );

	echo '<div class="img_preloader" style="display:none";>';

	foreach( $skins as $one_skin ) {
		$val = $one_skin['value'];
		echo '<span>';
		echo get_template_directory_uri().'/skins/' .$val . '/images/title_light_circle.png';
		echo '</span>';
	}
	//http://demo.freshface.net/file/ed/wp/wp-content/themes/edison/skins/purple/images/title_light_circle.png
	echo '</div>';
}
//var_dump($_COOKIE);


function print_select_options( $options, $default = null, $selectedValue = null, $class = null ) {
	//( isset( $selectedValue ) ) ? $selected = ' selected="selected" ' : $selected = '';
	$innerSelectedValue = $selectedValue;
	if ( isset( $default ) && !isset( $selectedValue ) ) $innerSelectedValue = $default;

	echo '<select autocomplete="off" class="livepanel_select '.$class.'" value="'.$innerSelectedValue.'">';
	foreach ( $options as $oneOption ) {
		( $innerSelectedValue == $oneOption['value']) ? $selected = ' selected="selected" ' : $selected = '';
		echo '<option value="'.$oneOption['value'].'" '.$selected.' id="'.$oneOption['value'].'">'. $oneOption['name'].'</option>';
	}
	echo '</select>';
}

function print_livepanel() {
	$livepanel_wrapper_class = " livepanel_wrapper_active ";
	$livepanel_is_open = '';
	if( isset($_COOKIE['livepanel_is_open']) && $_COOKIE['livepanel_is_open'] == 'false' ) {
		$livepanel_is_open = ' style="left:-187px;" ';
		$livepanel_wrapper_class = '';
	}
?>
<div class="livepanel_wrapper  <?php echo $livepanel_wrapper_class; ?>" <?php echo $livepanel_is_open; ?>>

	<div class="style_wrapper">
		<div class="style_holder">

	<!--  ++++++++++ SKIN ++++++++++ -->
			<div class="one_area skin_area">
				<h4>Theme Skin</h4>

				<?php print_skin_options( 'black', 'skin_select'); ?>

				<div class="live_button_left btn_grey"><div class="live_button_left_arrow"></div></div>
		    	<div class="live_button_right btn_grey"><div class="live_button_right_arrow"></div></div>
		    	<div class="clear"></div>
	    	</div>

	<!--  ++++++++++ SKIN ++++++++++ -->
			<div class="one_area headerskin_area">
				<h4>Header Skin</h4>

				<?php print_headerskin_options( 'black' ,'headerskin_select'); ?>

				<div class="live_button_left btn_grey"><div class="live_button_left_arrow"></div></div>
		    	<div class="live_button_right btn_grey"><div class="live_button_right_arrow"></div></div>
		    	<div class="clear"></div>
	    	</div>

	<!--  ++++++++++ SLIDER ++++++++++ -->
			<div class="one_area slider_area">
				<h4>Slider</h4>

				<?php print_slider_options( 'accordeon','slider_select' ); ?>

				<div class="live_button_left btn_grey"><div class="live_button_left_arrow"></div></div>
		    	<div class="live_button_right btn_grey"><div class="live_button_right_arrow"></div></div>
		    	<div class="clear"></div>
	    	</div>

	<!--  ++++++++++ TEMPLATE BUILDER ++++++++++ -->
	<!--		<div class="one_area tb_area">
				<h4>Template Builder</h4>
				<select class="tb_select livepanel_select">
				</select>
				<div class="live_button_left btn_grey"><div class="live_button_left_arrow"></div></div>
		    	<div class="live_button_right btn_grey"><div class="live_button_right_arrow"></div></div>
		    	<div class="clear"></div>
	    	</div>-->

	<!--  ++++++++++ BLOG ++++++++++ -->
	<!--		<div class="one_area blog_area">
				<h4>Blog</h4>
				<select class="blog_select livepanel_select">
					<?php print_blog_options( 'http://demo.freshface.net/file/ed/wp/category/portfolio/blog'); ?>
				</select>
				<div class="live_button_left btn_grey"><div class="live_button_left_arrow"></div></div>
		    	<div class="live_button_right btn_grey"><div class="live_button_right_arrow"></div></div>
		    	<div class="clear"></div>
	    	</div>-->

	<!--  ++++++++++ PORTFOLIO ++++++++++ -->
	<!--    	<div class="one_area portfolio_area">
				<h4>Portfolio</h4>
				<select class="portfolio_select livepanel_select">
					<?php print_portfolio_options( 'http://demo.freshface.net/file/ed/wp/category/portfolio'); ?>
				</select>
				<div class="live_button_left btn_grey"><div class="live_button_left_arrow"></div></div>
		    	<div class="live_button_right btn_grey"><div class="live_button_right_arrow"></div></div>
		    	<div class="clear"></div>
	    	</div>-->

	<!--  ++++++++++ SINGLE ++++++++++ -->
	<!--    	<div class="one_area single_area">
				<h4>Single</h4>
				<select class="single_select livepanel_select">
					<?php print_single_options( ''); ?>
				</select>
				<div class="live_button_left btn_grey"><div class="live_button_left_arrow"></div></div>
		    	<div class="live_button_right btn_grey"><div class="live_button_right_arrow"></div></div>
		    	<div class="clear"></div>
	    	</div>-->

	<!--  ++++++++++ PAGE ++++++++++ -->
	<!--    	<div class="one_area page_area">
				<h4>Page</h4>
				<select class="page_select livepanel_select">
				</select>
				<div class="live_button_left btn_grey"><div class="live_button_left_arrow"></div></div>
		    	<div class="live_button_right btn_grey"><div class="live_button_right_arrow"></div></div>
		    	<div class="clear"></div>
	    	</div>-->

	<!--  ++++++++++ RESET ++++++++++ -->
	    	<div id="live_reset_wrapper">
		        <div id="live_reset" class="btn_grey">Reset all</div>
			</div>

		</div>
	</div>

	<div class="livepanel_button_wrapper">
		<div class="livepanel_button"></div>
	</div>
</div>

<?php
print_logo_preloading();
print_img_preloading();
print_skin_preloading();
/*
 * <div class="one_area skin_area">
			<h4>Skin</h4>
			<select class="skin_select livepanel_select">
			</select>
			<div class="live_button_left btn_grey"><div class="live_button_left_arrow"></div></div>
	    	<div class="live_button_right btn_grey"><div class="live_button_right_arrow"></div></div>
	    	<div class="clear"></div>
	    	<input type="checkbox" class="live_check" checked="checked" name="aa" id="live_stencil_fixed">
	    	<label for="live_stencil_fixed">
	    		Fixed Stencil Position
	    	</label>
    	</div>
 */

}
?>