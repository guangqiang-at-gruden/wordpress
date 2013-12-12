<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes('html'); ?>> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>
		<?php if(is_home()) { echo bloginfo('name'); echo ' | '; echo bloginfo('description'); } else { echo wp_title(' | ', false, 'right'); echo bloginfo('name'); } ?>
	</title>
	<!--[if lt IE 9]>
	<link href="<?php echo get_template_directory_uri(); ?>/jackbox/css/jackbox-ie8.css" rel="stylesheet" type="text/css" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!--[if gt IE 8]><link href="<?php echo get_template_directory_uri(); ?>/jackbox/css/jackbox-ie9.css" rel="stylesheet" type="text/css" /><![endif]-->
	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<script type="text/javascript">
		var ffWpThemeUrl = "<?php echo get_template_directory_uri(); ?>" //"http://localhost/wiseguys/wp-content/themes/wiseguys";
	</script>

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/icons/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-114x114.png">
	<?php 
		
		
    	wp_head();
	?>
</head>
<body <?php body_class( getOtherBodyClass() ); ?>>


	<div class="headerBg"></div>
	

	<!-- Primary Page Layout
	================================================== -->

		<section class="headerWrapper">
		<header class="sixteen columns">
		<?php		
		
		
			if( fOpt::Get('header','logo-show') == 1 ) 
				echo '<a href="'.home_url().'"><div class="logo"><img src="'.ff_get_logo_url().'" alt="logo" /></div></a>';
		?>
		
				<nav class="mainmenu">
			
				<div id="smoothmenu" class="ddsmoothmenu">
					<?php 
						wp_nav_menu( array( 'theme_location'=>'navigation', 'container'=>false, 'walker'=>new WiseguysMenu(), 'fallback_cb'=>'ff_nav_menu_does_not_exists' ) );
					?>
					
					<br style="clear: left" />
				</div><!-- end ddsmoothmenu -->
				
				<!-- Responsive Menu
				================================================== -->
				
				<form action="#" method="post">
					<select>
						<option value=""><?php echo fOpt::Get('translation', 'navigation-responsive-title'); ?></option>
					</select>
				</form>
				
			</nav>
			
			<span id="menuShadow"></span>
			<span id="submenuArrow"><span class="arrow-up"></span></span>
			
		</header>
		<?php ffTemplater::requireHomepageSlider(); ?>
		<?php ffPartLoader::getInst()->loadUpperDescription();?>
		</section>
		<div class="container <?php echo ff_get_home_class(); ?>" <?php echo ff_get_container_image_attributes();?> >