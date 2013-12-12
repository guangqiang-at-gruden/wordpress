<?php 
if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
	$gallery = ffGalleryCollection::getGallery();
?>
<section class="portfolioSingle twelve columns clearfix">
	<?php 
	
		$fprinter->printPortfolioSingleMainImage();
		?>
	<section class="portfolioContent row">
		<div class="portfolioDesc eight columns">
			<?php 
				$fprinter->printPortfolioSingleTitle();
				?>
			<?php $fprinter->content(); ?>
		</div>
		<?php 
			$fprinter->printProjectDetails();
			?>
	</section>
	<?php 
		require get_template_directory().'/templates/single-portfolio/buttons.php';
		?>
	<!-- separator
		================================================== -->
	<div class="lineSeparator  twelve columns row"></div>
	<?php 
		require get_template_directory() .'/templates/single-portfolio/prevnext.php';
		?>
	<?php 
		require get_template_directory() . '/templates/single-portfolio/similar.php';
		?>
</section>
<!-- End // portfolio single content -->
<?php
	endwhile;
else :
	
endif;
?>