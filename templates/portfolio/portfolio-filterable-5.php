<?php 
/**
 Name: Portfolio Filterable 5
 Type: Portfolio
 Sidebar: Fullwidth
 Img: portfolio-filterable-5.png
 */
?>       
<?php
$portfolioBuffer = '';
$tagBuffer = array();
if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
	$gallery = ffGalleryCollection::getGallery();
	$tags =  get_the_tags();
	$tagList = '';
	if( !empty( $tags ) ) {
		foreach( $tags as $id => $tag ) {
			if( !isset( $tagBuffer[ $id ] ) ) 
				$tagBuffer[ $id ] = $tag;
			
			$tagList .= $tag->slug . ' ';
		} 
	}
	ob_start();
?>
	<div class="element onefifth <?php echo $tagList; ?>">
		<?php 
			$fprinter->filterableFeaturedImage( 176, 133);
		?>
		
		
      <div class="portfolioText" data-targetURL="<?php $fprinter->permalink(); ?>">
         <span class="portfolioTextOver transparent"></span>
         <p><?php $fprinter->title(); ?></p>
         <span><?php $fprinter->smallDescription(); ?></span>
      </div>
      <span class="portfolioArrow"></span>
      <!-- Sample div used as an item's description, will only appear inside JackBox -->
      <div class="jackbox-description" id="description_2">
         <h3><?php $fprinter->jackboxTitle(); ?></h3>
         <?php $fprinter->jackboxDescription(); ?> 
      </div>
   </div>	
<?php
	$currentPortItem = ob_get_contents();
	ob_clean();
	$portfolioBuffer .= $currentPortItem;
	endwhile;
else :
	
endif;
?>  


<section class="isotopeFilters clearfix">
   <ul class="option-set clearfix" data-option-key="filter">
      <?php 
      	foreach( $tagBuffer as $oneTag) {
			echo '<li><a href="#" data-filter=".'.$oneTag->slug.'">'.$oneTag->name.'</a></li>';
		}
      ?>
      <li><a href="#" data-filter="*"><?php echo fOpt::Get('translation', 'sortable-all'); ?></a></li>
   </ul>
   <!-- Responsive Filters
      ================================================== -->
   <form action="#" method="post" class="hidden">
      <select>
         <option value=""><?php echo fOpt::Get('translation', 'portfolio-responsive-title'); ?></option>
      </select>
   </form>
</section>
<!-- end isotope filters -->
<!-- Isotope container
   ================================================== -->
<section class="isotopeContainer portfolio left-twenty">
	<?php 
		echo $portfolioBuffer;
	?>
</section>
<!-- end isotope container -->
<?php 
        	require get_template_directory().'/templates/pagination/pagination.php';
?>    