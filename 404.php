<?php  
get_header();

ffPartLoader::getInst()->loadUpperDescription404();
?>
        <section class="mainContent">        
<?php
ffPartLoader::getInst()->loadLowerDescription404(); 	
require get_template_directory().'/templates/page/404.php';
//require get_template_directory().'/templates/sidebars/sidebar.php';
?>
		<div class="clearfix"></div>
		</section><!-- End // main content -->
<?php 
get_footer();
?>