
<!-- Slider
		================================================== -->
		<section id="<?php echo ffRevSliderConnector::getInstance()->getRevSliderClass(); ?>" class="sixteen columns headerContent">
		
			<div id="blurMask">
				<canvas id="blurCanvas"></canvas>
			</div>
			
			<?php  ffRevSliderConnector::getInstance()->putSlider(); ?>
		</section>
		
		