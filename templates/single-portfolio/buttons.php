<section class="buttons">
	<ul class="customButtons">
		<li class="button share" data-sliderContent=".socialShare"><a><?php $fprinter->buttonShare(); ?></a></li>
		<li class="separator"></li>
		<li class="button like" data-sliderContent="#appreciate"><a><?php $fprinter->buttonAppreciate(); ?></a></li>
		<li class="separator"></li>
		<li class="button back"><a class="highlight" href="<?php echo get_category_link(fEnv::getActualCat() );?>"><?php $fprinter->buttonBack(true); ?></a></li>
	</ul>
	<section class="buttonsSlider">
		<div class="buttonSliderShadow"></div>
		<article class="socialShare">
			<p><?php echo fOpt::Get('translation', 'post-description-share'); ?></p>
			<div class="addthis_toolbox_share">
				<?php 
                	$fprinter->printShareButtons();
                ?>
			</div>
			<!-- <div class="tooltip hidden"><p>Pin it on Pinterest</p></div> -->
		</article>
		<article id="appreciate">
			<div class="addthis_toolbox addthis_counter_style">
				<a class="addthis_button_facebook_like" fb:like:layout="box_count"></a>
				<a class="addthis_button_google_plusone" g:plusone:size="tall"></a>
			</div>
			<div class="appreciateTxt">
				 <?php echo fOpt::Get('translation', 'post-description-appreciate'); ?>
			</div>
		</article>
		<div class="buttonSliderShadowBottom"></div>
		<div class="buttonSliderClose"></div>
	</section>
</section>