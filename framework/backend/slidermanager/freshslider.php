<?php

	/*fEnv::addAdminMenu('Slider Manager', 'Slider Manager', 'fslidermanager', 2);
	fEnv::addAdminScript('fslidermanager', get_template_directory_uri(). '/framework/extern/colorbox/jquery.colorbox-min.js');
	fEnv::addAdminScript('fslidermanager', get_template_directory_uri(). '/framework/backend/slidermanager/script.js');
	fEnv::addAdminScript('fslidermanager', get_template_directory_uri(). '/framework/backend/slidermanager/dummy_slide_content.js');
	
	fEnv::addAdminStyle('fslidermanager', get_template_directory_uri(). '/framework/backend/slidermanager/freshslider.css');
	fEnv::addAdminStyle('fslidermanager', get_template_directory_uri(). '/framework/backend/includes/options_table/options_table.css');
	fEnv::addAdminStyle('fslidermanager', get_template_directory_uri(). '/framework/backend/includes/options_header/options_header.css');
	fEnv::addAdminStyle('fslidermanager', get_template_directory_uri(). '/framework/backend/includes/modal_window/modal_window.css');
	fEnv::addAdminStyle('fslidermanager', get_template_directory_uri(). '/framework/extern/colorbox/colorbox.css');*/
	
 
  function fslidermanager_view()
  {
  		$smprinter = new fSliderManagerPagePrinter();
		

	
  	?>

<div id="freshslider" class="wrap">
	<div class="show_settings_at_start" style="display:none;"><?php if( isset( $_POST['fslidermanager_show_settings_page'] ) ) echo $_POST['fslidermanager_show_settings_page']; ?></div>
	<div class="wp_template_url_holder" style="display:none;"><?php echo get_template_directory_uri(); ?></div>
	<?php echo  '<div class="wp_upload_media_holder"><a href="'.site_url().'/wp-admin/media-upload.php?TB_iframe=1&amp;width=640&amp;height=359" media-upload-link="slide" class="button thickbox add_media add_media_slidermanager" id="" title="Add Media" onclick="return false;">Upload / Insert</a></div>';?>
	<div class="icon32" id="icon-edit"><br></div>
    <h2>Slider Manager</h2>
    <div class="slide_dummy_content" style="display:none">
    	<div class="slide_dummy_Accordeon">{p}We aren’t trying to completely replace the board meetings as there are still things you need to do no matter what.{/p}
{p}
    {a href="http://www.google.com" class="btn_component tb_btn_small tb_btn_yellow tb_btn_small_yellow"}
        {span class="tb_btn_left"}{/span}
        {span class="tb_btn_center"}Read More{/span}
        {span class="tb_btn_right"}{/span}
        {span class="clear"}{/span}
    {/a}
{/p}</div>
    	<div class="slide_dummy_Fly">{div class="fly fly_left desc" style="width: 400px; height: 200px; left: 50px; top: 100px;"}
    {h2}Hello Title{/h2}
    {p}We aren’t trying to completely replace the board meetings as there are still things you need to do no matter what.{/p}
    {p}
        {a href="http://www.google.com" class="btn_component tb_btn_small tb_btn_yellow tb_btn_small_yellow"}
            {span class="tb_btn_left"}{/span}
            {span class="tb_btn_center"}Read More{/span}
            {span class="tb_btn_right"}{/span}
            {span class="clear"}{/span}
        {/a}
    {/p}
{/div}</div>
        <div class="slide_dummy_3D"></div>
    	<div class="slide_dummy_Cubes">{p}We aren’t trying to completely replace the board meetings as there are still things you need to do no matter what.{/p}
{p}
    {a href="http://www.google.com" class="btn_component tb_btn_small tb_btn_yellow tb_btn_small_yellow"}
        {span class="tb_btn_left"}{/span}
        {span class="tb_btn_center"}Read More{/span}
        {span class="tb_btn_right"}{/span}
        {span class="clear"}{/span}
    {/a}
{/p}</div>
        <div class="slide_dummy_Tabbed">{p}We aren’t trying to completely replace the board meetings as there are still things you need to do no matter what.{/p}
{p}
    {a href="http://www.google.com" class="btn_component tb_btn_small tb_btn_yellow tb_btn_small_yellow"}
        {span class="tb_btn_left"}{/span}
        {span class="tb_btn_center"}Read More{/span}
        {span class="tb_btn_right"}{/span}
        {span class="clear"}{/span}
    {/a}
{/p}</div>
    	<div class="slide_dummy_Logo"></div>
    </div>
    <div class="options_header slider_manager_header">
    	<select id="template_select" name="template_select">
    		<?php $smprinter->printTemplateList(); ?>
    	</select>
    	<a target="_blank" class="btn_add button button_secondary" href="">Add New</a>
    	<a target="_blank" class="btn_rename button button_secondary" href="">Rename</a>
    	<a target="_blank" class="btn_duplicate button button_secondary" href="">Duplicate</a>
    	<a target="_blank" class="btn_import button button_secondary" href="">Import</a>
    	<a target="_blank" class="btn_export button button_secondary" href="">Export</a>
    	<a target="_blank"  class="btn_delete button button_secondary" href="">Delete</a>
    	
    	
		<div>
			<input type="submit" name="publish" id="publish" class="theme_options_save button button_primary" value="Save Changes" tabindex="5" accesskey="p">
			<img class="loading_spin" src="<?php echo site_url();?>/wp-admin/images/wpspin_light.gif" style="position:relative; right:7px; top:5px;display:none; float:right;">
		</div>    	
    	<div class="clear"></div>
    </div>    
    
    <h2 class="nav-tab-wrapper">
    	<a id="tab_slides" linking-to="slides" class="nav-tab nav-tab-active" href="themes.php">Slides</a>
    	<a id="tab_settings" linking-to="settings" class="nav-tab" href="">Settings</a>
    	<a id="tab_preview" linking-to="preview" class="nav-tab" href="">Preview</a>
    	
    </h2>
    
    <form id="post" method="post" action="?page=fslidermanager&fresh_slider=1" name="post">
       
   
        <div class="metabox-holder" id="slides">
        	<div id="post-body">
            	<div>
	                <input type="submit" value="Add Slide" accesskey="p" tabindex="5"  class="button button-secondary add_slide_btn add_slide_up" name="fs_add_slide">
	                <div id="table_content_holder">


                    <?php
                    $smprinter->printSlides();
              
                    ?>

                    </div>
                    <input type="hidden" value="save" name='action_what' id='action_what'>
                    <input type="hidden" value="<?php //echo $id-1; ?>" name='last_slide' id='last_slide'>
                    <input type="hidden" value="<?php //echo $id; ?>" name='object_count'>
                </div><!-- "END div#freshslider" -->         
        	</div>                                
        </div>
        <div class="metabox-holder" id="settings">
        	<div id="post-body">
        		<?php 
        	 		$smprinter->printSliderOptions();
        		?>      
        	</div>                                
        </div>
        
        <div class="metabox-holder" id="preview">
        	<div id="post-body">
        		<div id="slider_preview_url"><?php echo site_url(); ?>/</div>
        		<iframe id="slider_preview">
        			
        		</iframe>      
        	</div>                                
        </div>        
    </form>                                    
</div>








   <?php
  }
     
 
?>
