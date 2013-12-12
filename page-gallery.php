<?php  
/*  
Template Name: Page Gallery
*/  

get_header();


?>
        <section class="mainContent">        
<?php
ffPartLoader::getInst()->loadLowerDescription(); 	
require get_template_directory().'/templates/page/page-gallery.php';
?>
		<div class="clearfix"></div>
		</section><!-- End // main content -->
<?php 
get_footer();
?>