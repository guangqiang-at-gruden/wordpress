<section class="buttons">
	<ul class="customButtons">
        <li>
            <div class="bdsharebuttonbox"><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a hrf="#" class="bds_t163" data-cmd="t163" title="分享到网易微博"></a><a href="#" class="bds_more" data-cmd="more"></a></div>
            <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=86326610.js?cdnversion='+~(-new Date()/36e5)];</script>
        </li>
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