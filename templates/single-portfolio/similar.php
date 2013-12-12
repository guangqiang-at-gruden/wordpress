<?php 
   if( ffSimilarPosts::getInstance()->hasSimilarPosts() ) {
?>
<!-- Featured works
   ================================================== -->
<section class="twelve columns remove-left">
   <div class="sectionHeader row clearfix">
      <div class="sectionHeadingWrap">
         <span class="sectionHeading"><?php echo fOpt::Get('translation', 'post-similar-portfolio'); ?></span>
      </div>
      <div class="carouselNav">
         <div class="carouselPrevious"></div>
         <div class="carouselNext"></div>
      </div>
   </div>
   <div class="carouselWrapper small">
      <ul class="carousel portfolio" data-autoPlay="false">
         <!-- Start carousel item portfolio -->
			<?php
				global $post; 
				$currentPost = $post;
				foreach( ffSimilarPosts::getInstance()->getSimilarPosts() as $post ) {
					
					$simGall = ffGalleryCollection::getGallery( $post->ID );
					setup_postdata( $post );
					
					if( null == $simGall->getFeaturedImage() ) continue;
					
					
					$hoverClass = 'magnify';
					$imageLink = $simGall->getFeaturedImage()->image->url;
					
					$videoLink = metaBoxManager::getMeta('featured_image_video_link', null, $post->ID);
					if( !empty( $videoLink ) ) {
						$hoverClass = 'play';
						$imageLink = $videoLink;
					}
					
					echo '<li>'; 
					
					echo '<figure>';
               			echo '<a class="jackbox" data-group="featured_works" data-thumbTooltip="'.get_the_title($post->ID).'" data-title=">'.$simGall->getFeaturedImage()->title.'" href="'.$imageLink.'">';
                  		echo '<div class="jackbox-hover jackbox-hover-blur jackbox-hover-'.$hoverClass.'"></div>';
                  		echo '<img width="161" height="122" src="'.$simGall->getFeaturedImage()->image->resize(161,120, true).'" alt="" />';
                  		echo '<span class="portfolioImageOver transparent"></span>';
               			echo '</a>';
            		echo '</figure>';
            		
            		echo '<article data-targetURL="'.get_permalink($post->ID).'">';
               		echo '<p>';
               			echo get_the_title($post->ID);
               		echo '</p>';
               		echo '<span>'.metaBoxManager::getMeta('portfolio_image_description', null, $post->ID).'</span>';
            		echo '</article>';
            		echo '<!-- Sample div used as an items description, will only appear inside JackBox -->';
            		echo '<div class="jackbox-description" id="description_1">';
               		echo '<h3>'.$simGall->getFeaturedImage()->title.'</h3>'; 
            		echo '</div>';
            		echo '<span class="carouselArrow"></span>';
							
					echo '</li>';
					//break;
					//var_dump( $onePost );
				}
				$post = $currentPost;
				setup_postdata( $post );			
			?>         
        
      </ul>
      <div class="clearfix"></div>
   </div>
</section>
<!-- End // Featured works -->
<?php 
   }

  ?>