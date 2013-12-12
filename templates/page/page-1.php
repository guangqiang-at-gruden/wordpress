<?php 
if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
?>                   
        <section class="sixteen columns offset-by-one">
        <?php 
        	the_content();
        	require get_template_directory().'/templates/page/comments.php';
        ?>
        
         </section><!-- End // main content -->
<?php 
	endwhile;
endif;
?>