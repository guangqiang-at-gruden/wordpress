<?php

function showThemeSwitcher(){

?>
<!-- Style switcher
================================================== -->
<div class="styleSwitcherWrapper">
  <div class="styleSwitcherPanel">

    <h4>STYLE SWITCHER</h4>

    <div class="lineSeparator"></div>

    <p>SKIN COLORS</p>
    <ul class="styleSwitcherColors clearfix">
      <li><a class="switcherGrey"            data-value="grey"        href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/grey.png" alt=""        /></a></li>
      <li><a class="switcherGreen last"      data-value="green"       href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/green.png" alt=""       /></a></li>
      <li><a class="switcherBlue"            data-value="blue"        href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/blue.png" alt=""        /></a></li>
      <li><a class="switcherBrown"           data-value="brown"       href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/brown.png" alt=""       /></a></li>
      <li><a class="switcherDarkred last"    data-value="darkred"     href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/darkred.png" alt=""     /></a></li>
      <li><a class="switcherOrange"          data-value="orange"      href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/orange.png" alt=""      /></a></li>
      <li><a class="switcherTurquoise"       data-value="turquoise"   href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/turquoise.png" alt=""   /></a></li>
      <li><a class="switcherRed"             data-value="red"         href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/red.png" alt=""         /></a></li>
      <li><a class="switcherStrongGreen"     data-value="stronggreen" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/stronggreen.png" alt="" /></a></li>
      <li><a class="switcherStrongBlue last" data-value="strongblue"  href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/strongblue.png" alt=""  /></a></li>
    </ul>

    <div class="lineSeparator last"></div>

    <p>BACKGROUND PATTERNS</p>
    <ul class="styleSwitcherPatterns clearfix">
      <li><a class="switcherPattern1"       data-value="pattern1"  href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/pattern1.png"  alt="" /></a></li>
      <li><a class="switcherPattern2"       data-value="pattern2"  href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/pattern2.png"  alt="" /></a></li>
      <li><a class="switcherPattern3"       data-value="pattern3"  href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/pattern3.png"  alt="" /></a></li>
      <li><a class="switcherPattern4"       data-value="pattern4"  href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/pattern4.png"  alt="" /></a></li>
      <li><a class="switcherPattern5 last"  data-value="pattern5"  href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/pattern5.png"  alt="" /></a></li>
      <li><a class="switcherPattern6"       data-value="pattern6"  href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/pattern6.png"  alt="" /></a></li>
      <li><a class="switcherPattern7"       data-value="pattern7"  href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/pattern7.png"  alt="" /></a></li>
      <li><a class="switcherPattern8"       data-value="pattern8"  href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/pattern8.png"  alt="" /></a></li>
      <li><a class="switcherPattern9"       data-value="pattern9"  href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/pattern9.png"  alt="" /></a></li>
      <li><a class="switcherPattern10 last" data-value="pattern10" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/pattern10.png" alt="" /></a></li>
    </ul>
    
    <div class="lineSeparator last"></div>

    <p>SOLID BACKGROUND COLORS</p>
    <ul class="styleSwitcherSolidBg clearfix">
      <li><a class="switcherE1E0D6" data-value="E1E0D6" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/solid_e1e0d6.png" alt="" /></a></li>
      <li><a class="switcherB4AFA0" data-value="B4AFA0" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/solid_B4AFA0.png" alt="" /></a></li>
      <li><a class="switcherA5A49A" data-value="A5A49A" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/solid_A5A49A.png" alt="" /></a></li>
      <li><a class="switcherBDBAB7" data-value="BDBAB7" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/solid_BDBAB7.png" alt="" /></a></li>
      <li><a class="switcherdddddd" data-value="DDDDDD" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/solid_dddddd.png" alt="" /></a></li>
    </ul>

    <div class="lineSeparator last"></div>

    <p>BACKGROUND IMAGE</p>
    <a class="switcherBgImg" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/bgImg.png" alt="" /></a>

    <div class="lineSeparator last"></div>

    <ul class="styleSwitcherLayout clearfix">
      <li><a class="switcherFull"  data-value="full"  href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/full.png" alt="" /></a><p>WIDE LAYOUT</p></li>
      <li><a class="switcherBoxed" data-value="boxed" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/demo/images/boxed.png" alt="" /></a><p>BOXED LAYOUT</p></li>
    </ul>

    <div class="lineSeparator last"></div>

    <p>RESET ALL</p>
    <a class="resetCookies" href="#"></a>
    <div class="clear"></div>
  </div>
  <a href="#" class="styleSwitcherToggle"></a>
</div>

<script type="text/javascript">
var template_directory_uri;
template_directory_uri = '<?php echo get_template_directory_uri(); ?>';
</script>
<script src="<?php echo get_template_directory_uri().'/framework/demo/'; ?>switcher.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri().'/framework/demo/'; ?>cookie.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri().'/framework/demo/'; ?>switcher.css" type="text/css">
<?php

}

add_action('wp_footer', 'showThemeSwitcher');