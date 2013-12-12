
<!-- Footer bottom
================================================== -->
<section class="subFooter">

  <?php
    wp_nav_menu( array('theme_location' => 'footermenu', 'walker' => new FooterWiseguysMenu(), 'container'=>false, 'menu_class' => 'footerMenu','fallback_cb'=>'ff_nav_menu_footer_does_not_exists' ) );
  ?>

  <span class="copyright"><?php echo fOpt::Get('footer', 'footer-b-left-text'); ?></span>

</section><!-- End // Footer bottom -->
