 <!-- Blog items
        ================================================== -->
        
        <section class="twelve columns left-twenty <?php $fprinter->printSidebarPositionClass(); ?>">
        
        
<?php 
if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
	$gallery = ffGalleryCollection::getGallery();
?>           
           <!-- Start Blog item
           ================================================== -->
           <article class="blog post">
           
             <?php 
              	$fprinter->printBlogLargeFeaturedImage();
              ?>
              
              <!-- Title
              ================================================== -->
              <section class="title clearfix">
                  
                  
                     <?php $fprinter->printBlogDate(); ?>
                     
                  
                  <div class="titleText" <?php if( fEnv::getCategoryOption('postmeta_date') == 0 ) echo 'style="margin-left:0px;" '?>>
                	<?php $fprinter->printBlogTitle(); ?>
                    <?php $fprinter->printBlogMeta(); ?>
                    <div class="lineSeparator"></div>
                  </div><!-- End titleText-->
                  
               </section><!-- End title-->
               
               <!-- Blog content
              ================================================== -->
              <section class="content">
                   <?php $fprinter->printBlogContent(); ?>
              </section><!-- End Content -->
				<?php require get_template_directory().'/templates/single-blog/buttons.php'; ?>
           </article><!-- End Blog item -->
<?php
	endwhile;
else :
	
endif;

	require get_template_directory().'/templates/single-blog/prev_next_post.php';
	require get_template_directory().'/templates/single-blog/similar_posts.php';
	require get_template_directory().'/templates/single-blog/comments.php';
?>  
        </section><!-- End twelve columns -->