<?php

$footerWidgetsCount = fOpt::Get('footer', 'footer-widget-count'); 
switch( $footerWidgetsCount ) {
	case 1: $footerWidgetsName = 'one'; break;
	case 2: $footerWidgetsName = 'onehalf'; break;
	case 3: $footerWidgetsName = 'onethird'; break;
	case 4: $footerWidgetsName = 'onefourth'; break;
	case 5: $footerWidgetsName = 'onefifth'; break;
	case 6: $footerWidgetsName = 'onesixth'; break;
}
//$footerWidgetsName = "onefourth";
?>

<!-- Top footer
================================================== -->
<section class="footerTop sixteen columns">


<div class="footerTopWrapper">

  <?php
    for( $columnIndex = 1; $columnIndex <= $footerWidgetsCount ;$columnIndex ++ ){
      echo "<div class='$footerWidgetsName aboutFooter'>";
      if( !is_active_sidebar(THEMENAMELOW . '-footer-'.$columnIndex) ) {
      echo '<div style="color: darkorange; background: rgba(255,255,255,0.05); font-size: 15px; line-height: 24px; padding: 5px 10px; font-style: italic; margin: 20px 0 0 0;">Hello world! Please add at least one Widget in "Appearance &rarr; Widgets to Footer Sidebar #'.$columnIndex."</div>";
    }
      if( ! dynamic_sidebar( "Footer Widget Area #" . $columnIndex ) ){
          echo "\n\n<!-- empty Footer Widget Area #" . $columnIndex ." -->\n\n";
      }
      echo "</div>";
  } /* For - columns count */ ?>
</div>


</section><!-- End // Footer top -->
