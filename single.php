<?php
get_header();

?>
        <section class="mainContent">        
<?php
ffPartLoader::getInst()->loadLowerDescription();
 	
require get_template_directory().'/templates/single-blog/single.php';
require get_template_directory().'/templates/sidebars/sidebar.php';
?>
		<div class="clearfix"></div>
		</section><!-- End // main content -->
<?php 
         
get_footer();

//$gi = new ffGalleryCollection( $post->ID );
//var_dump( $gi->getFeaturedImage() );