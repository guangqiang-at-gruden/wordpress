	<div class="headerBg"></div>
	<!-- Primary Page Layout
		================================================== -->
	<section class="headerWrapper">
		<header class="sixteen columns">
			<?php		
				//var_dump( (int)fOpt::Get('header','logo-show') );
					if( (int)fOpt::Get('header','logo-show') == 1 ) 
						echo '<a href="'.home_url().'"><div class="logo"><img src="'.ff_get_logo_url().'" /></div></a>';
				?>
			<nav class="mainmenu">
				<div id="smoothmenu" class="ddsmoothmenu">
					<?php 
						wp_nav_menu( array( 'menu'=>'Navigation', 'container'=>false, 'walker'=>new WiseguysMenu() ) );
						?>
					<br style="clear: left" />
				</div>
				<!-- end ddsmoothmenu -->
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
	</section>