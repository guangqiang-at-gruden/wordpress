<?php

$s = '';
if( isSet($_GET) and isSet($_GET['s']) ){
    $s = esc_html( trim( $_GET['s'] ) );
}

?>
<form method="get" class="searchform" action="<?php echo home_url(); ?>">
  <input class="searchfield" type="text" name="s" value="<?php echo $s;?>" placeholder="<?php echo __("Search Blog...", ffgtd()); ?>" />
  <input class="searchbutton" type="button" name="Submit"  value=" " />
  <div class="clear"></div>
</form>