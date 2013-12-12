<?php
get_header();

?>
        <section class="mainContent">        
<?php
ffPartLoader::getInst()->loadLowerDescription();

	
	ffTemplater::requireCategory();
	ffPartLoader::getInst()->loadSidebar();
?>
<div class="clearfix"></div>
</section><!-- End // main content -->
<?php
get_footer();
