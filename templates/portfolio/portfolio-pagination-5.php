<?php 
/**
 Name: Portfolio Pagination 5
 Type: Portfolio
 Sidebar: Fullwidth
 Img: portfolio-pagination-5.png
 */
?>

<!-- Isotope container
        ================================================== -->

        <section class="isotopeContainer portfolio left-twenty">

<?php

if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
	$gallery = ffGalleryCollection::getGallery();
?>

                     <div class="element onefifth illustration">

                     <?php
                        $fprinter->filterableFeaturedImage(176,133);
                        $fprinter->printPortfolioTitle();
                        $fprinter->printPortfolioExcerpt();
                     ?>
                     
                    </div>

<?php
	endwhile;
else :
	
endif;
?>  
        <div class="clearfix"></div>

        </section><!-- End twelve columns -->

        <?php 
        	require get_template_directory().'/templates/pagination/pagination.php';
        ?>           
