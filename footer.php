<?php

$showFooterA = fOpt::Get('footer', 'footer-a-show');
$showFooterB = fOpt::Get('footer', 'footer-b-show');

if( !empty( $showFooterA ) || !empty( $showFooterB ) ) {

?>

<!-- Start footer -->

<footer>

	<div class="footerBgFull"></div>
	<div class="subFooterBgFull"></div>
	<div class="arrow-down"></div>

  <?php
  	if( $showFooterA == (int)1 )
    	require get_template_directory().'/templates/footer/footer_a-1.php';
  	if( $showFooterB == (int)1 )
    	require get_template_directory().'/templates/footer/footer_b-1.php';
  ?>

</footer><!-- /End footer -->

<?php

} // End if
  
?>

</div><!-- /End container -->


<!-- End Document
================================================== -->
<?php disqus_comment_count_script(); ?>
<?php wp_footer(); ?>
</body>
</html>