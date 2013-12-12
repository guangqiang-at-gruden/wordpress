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
                       <li class="button share" data-sliderContent=".socialShare"><a><?php echo fOpt::Get('translation', 'post-button-share'); ?></a></li>
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
