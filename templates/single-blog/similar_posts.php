<!-- blog carousel small
	================================================== -->
<?php 
	if( ffSimilarPosts::getInstance()->hasSimilarPosts() ) {
?>
<section class="twelve columns remove-left">
	<div class="sectionHeader row">
		<div class="sectionHeadingWrap">
			
			<span class="sectionHeading"><?php echo fOpt::Get('translation', 'post-similar-blog'); ?></span>
		</div>
		<div class="carouselNav">
			<div class="carouselPrevious"></div>
			<div class="carouselNext"></div>
		</div>
	</div>
	<div class="carouselWrapper small" data-autoPlay="false" data-autoDelay="3000">
		<ul class="carousel blog">
			<?php 
				$currentPost = $post;
				foreach( ffSimilarPosts::getInstance()->getSimilarPosts() as $post ) {
					$simGall = ffGalleryCollection::getGallery( $post->ID );
					setup_postdata( $post );
					$featuredImage = $simGall->getFeaturedImage();
					if( $featuredImage == null ) continue;
					echo '<li>'; 
						// FEATURED IMAGE
						echo '<img width="161" height="122" src="'.$simGall->getFeaturedImage()->image->resize(161, 122, true).'">';
						
						// DATE SECTION
						echo '<div class="blogDate">';
							echo '<p>';
								echo get_the_date('j');
							echo '</p>';
							echo '<span>';
								echo get_the_date('M Y');
							echo '</span>';
							echo '<div class="arrow-down"></div>';
						echo '</div>';
						
						// article section
						echo '<article>';
							echo '<a href="'.get_permalink().'">';
								echo '<h4>';
									echo $post->post_title;
								echo '</h4>';
							echo '</a>';
							$cats  = get_the_category();
							if( !empty( $cats ) ) {
								$cat = $cats[0];
								$commZero = fOpt::Get('translation', 'post-comment-count-zero');
								$commOne = fOpt::Get('translation', 'post-comment-count-one');
								$commMore = fOpt::Get('translation', 'post-comment-count-more');
								echo '<p class="blogMeta"><a href="'.get_category_link( $cat->term_id ).'">'.$cat->name.'</a>,';
									ff_comments_popup_link( $commZero, $commOne, $commMore, 'comments-link', '');
								echo'</p>';
							}
							
							ffSimilarPosts::getInstance()->renderStrippedContent();
						echo '</article>';
							
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
<!-- End // Latest Blog Posts -->
<?php 
}
?>

