 <!-- buttons
                   ================================================== -->
                   <section class="buttons">
                
                     <ul class="customButtons">

                       <li class="button comment"><a href="#respond"><?php $fprinter->buttonComment(); ?></a></li>
                       <li class="separator"></li>
                       <?php 
                       	if( has_tag() ) {
                       ?>
                       <li class="button tags" data-sliderContent="#tags"><a><?php $fprinter->buttonTags(); ?></a></li>
                       <li class="separator"></li>
                       <?php 
                       	}
                       	if( $fprinter->shouldPrintAuthorInfo() ) {
                       ?>
                       <li class="button author" data-sliderContent="#author"><a><?php $fprinter->buttonAuthor(); ?></a></li>
                       <li class="separator"></li>
                       <?php
						}
                       //conopt
                       	echo '<li class="button back"><a class="highlight" href="'.get_category_link( fEnv::getActualCat() ) . '">';
                       		$fprinter->buttonBack();
                       	echo '</a></li>';
                       ?>
                         <li class="separator"></li>
                         <li>
                             <div class="bdsharebuttonbox"><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a hrf="#" class="bds_t163" data-cmd="t163" title="分享到网易微博"></a><a href="#" class="bds_more" data-cmd="more"></a></div>
                             <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=86326610.js?cdnversion='+~(-new Date()/36e5)];</script>
                         </li>
                     </ul>
                     
                      <!-- slider
                      ================================================== -->
                      <section class="buttonsSlider">
                     
                         <div class="buttonSliderShadow"></div>
                     
                         <article class="socialShare">
                             <p><?php echo fOpt::Get('translation', 'post-description-share'); ?></p>
                             <div class="addthis_toolbox_share">
                             	 <?php 
                             	 	$fprinter->printShareButtons();
                             	 ?>
                              </div>
                         </article>
                         
                         <article id="appreciate">
							<div class="addthis_toolbox addthis_counter_style">
								<?php  
									if( 1 == (int)fOpt::Get('social','post-like-facebook-show') ) {
										echo '<a class="addthis_button_facebook_like" fb:like:layout="box_count"></a>';
									}
									
									if( 1 == (int)fOpt::Get('social','post-like-google-show') ) {
										echo '<a class="addthis_button_google_plusone" g:plusone:size="tall"></a>';
									}
								?>
                           </div>
                           <div class="appreciateTxt">
                              <?php echo fOpt::Get('translation', 'post-description-appreciate'); ?>
                           </div>
                         </article>
                         
                         <article id="tags">
                             	<?php $fprinter->printTags(); ?>
                         </article>
                         
                         <article id="author">
							<?php $fprinter->printAuthorInfo(); ?>
                         </article>
       
                   <div class="buttonSliderShadowBottom"></div>
                         <div class="buttonSliderClose"></div>
                         
                     </section><!-- End slider-->
                  
                  </section><!-- End buttons-->