<?php 
if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
	
?>   
<section class="sixteen columns offset-by-one">
   <article class="one row">
      <?php $fprinter->content(); ?>
   </article>
</section>   
   <?php 
   	$fprinter->gallery( metaboxManager::getMeta('gallery_columns'));
   	//require get_template_directory().'/templates/page/comments.php';
   ?>

<?php 
	endwhile;
	endif;
?>