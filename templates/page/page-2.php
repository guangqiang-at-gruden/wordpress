<?php 
if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
?>                   
        <section class="twelve columns offset-by-one <?php $fprinter->printSidebarPositionClass(); ?>">
        <?php 
        	the_content();
        	require get_template_directory().'/templates/page/comments.php';
        ?>
         </section><!-- End // main content -->
<?php 
	endwhile;
endif;
?>