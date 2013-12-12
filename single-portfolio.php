<?php
get_header();

?>
        <section class="mainContent">        
<?php
ffPartLoader::getInst()->loadLowerDescription();

ffTemplater::requirePortfolioSingle();
?>
		<div class="clearfix"></div>
		</section><!-- End // main content -->
<?php 
         
get_footer();

//$gi = new ffGalleryCollection( $post->ID );
//var_dump( $gi->getFeaturedImage() );