<?php
/**
Name: Blog Large
Type: Blog
Sidebar: Right
Img: blog-large.png
*/
?>

		<!-- Blog items
        ================================================== -->
        <section class="twelve columns row left-twenty <?php $fprinter->printSidebarPositionClass(); ?>">
<?php 
if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
	$gallery = ffGalleryCollection::getGallery();
?>
           <!-- Start Blog item with image
           ================================================== -->
           <article class="blog large row">
           
              <?php 
              	$fprinter->printBlogLargeFeaturedImage();
              ?>
              <!-- Excerpt
              ================================================== -->
              <section class="excerpt">
                  
                 
                     <?php $fprinter->printBlogDate(); ?>
                      
                  
                  <div class="excerptText">
                  	<?php $fprinter->printBlogTitle(); ?>
                    <?php $fprinter->printBlogMeta(); ?>
                    <?php $fprinter->printBlogContent(); ?>
                  </div>
                  
                   <!-- buttons
                   ================================================== -->
                   <section class="buttons">
                
                     <ul class="customButtons">
                       <?php $fprinter->printBlogReadMore(); ?>
                       <li class="separator"></li>
                       <li class="share">
                           <div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_t163" data-cmd="t163" title="分享到网易微博"></a><a href="#" class="bds_douban" data-cmd="douban" title="分享到豆瓣网"></a><a href="#" class="bds_kaixin001" data-cmd="kaixin001" title="分享到开心网"></a><a href="#" class="bds_tqf" data-cmd="tqf" title="分享到腾讯朋友"></a><a href="#" class="bds_tsohu" data-cmd="tsohu" title="分享到搜狐微博"></a></div>
                           <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"24"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=86326610.js?cdnversion='+~(-new Date()/36e5)];</script>
                       </li>
                     </ul>
                     
                      <!-- slider
                      ================================================== -->
                      <section class="buttonsSlider">
                     
                         <div class="buttonSliderShadow"></div>
                     
                         <article class="socialShare">
                             <p><?php echo fOpt::Get('translation', 'post-description-share'); ?></p>
                             <div class="addthis_toolbox_share">
                                 facebook-mask                      	 <?php
                             	 	$fprinter->printShareButtons();
                             	 ?>
                              </div>
                         </article>
       
                     <div class="buttonSliderShadowBottom"></div>
                         <div class="buttonSliderClose"></div>
                         
                     </section><!-- End slider-->
                  
                  </section><!-- End buttons-->
              
              </section><!-- End excerpt-->
           
           </article><!-- End Blog item -->
<?php
	endwhile;
else :
	echo '<h1>'. fOpt::Get('translation', 'search-heading').'</h1>';
	echo fOpt::Get('translation', 'search-content');
endif;
?>  
        
        <?php 
        	require get_template_directory().'/templates/pagination/pagination.php';
        ?>           


        </section><!-- End twelve columns -->
