<?php  
/*  
Template Name: Page Fullwidth
*/  

get_header();


?>
        <section class="mainContent">        
<?php
ffPartLoader::getInst()->loadLowerDescription(); 	
require get_template_directory().'/templates/page/page-1.php';
?>
		<div class="clearfix"></div>
		</section><!-- End // main content -->
<?php 
get_footer();
?>