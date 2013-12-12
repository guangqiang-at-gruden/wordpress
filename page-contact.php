<?php
/*
Template Name: Page Contact
*/

get_header();

?>
        <section class="mainContent">        
<?php
ffPartLoader::getInst()->loadLowerDescription();

require get_template_directory().'/templates/page/page-contact.php';
require get_template_directory().'/templates/sidebars/sidebar.php';
?>
		<div class="clearfix"></div>
		</section><!-- End // main content -->
<?php 
         
get_footer();
