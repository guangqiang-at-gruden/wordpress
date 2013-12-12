<?php 

function fcatman_get_cat_list() {
	$cat_list = Array (
      'index' => array( 0, 'Home Page' ),
      'archive' => array( 0, 'Archives' ),
      'author' => array( 0, 'Author' ),
      'search' => array( 0, 'Search' ),
      'tag' => array( 0, 'Tag' ),
      'date' => array( 0, 'Date' ),  
  );
  
  
  return  fcatman_create_cat_list_recursive(0,0,$cat_list);
}

function fcatman_create_cat_list_recursive( $child_of, $depth, $cat_list ) {
	 $cats = get_categories('hide_empty=0&parent='.$child_of);
      foreach ($cats as $one_cat)
      {
          $cat_list[ $one_cat->cat_ID ][0] = $depth;
          $cat_list[ $one_cat->cat_ID ][1] = $one_cat->name;
		  $cat_list = fcatman_create_cat_list_recursive($one_cat->cat_ID, $depth + 1, $cat_list);
      }
	  return $cat_list;
}

function fcatman_view(){
	$catopt = fcreate_category_options_store();
	
	$templates = fEnv::getTemplates();
	
?>

<div class="wrap">

	<div id="icon-themes" class="icon32"><br /></div>
	<h2>Site Preferences</h2>
	
	<div class="options_header page_builder_header">
		<?php
		/*
		<select id="template_select" name="template_select">
			<?php fpagebuilder_get_templates_list(); ?>
		</select>
		<a target="_blank" class="btn_add button button_secondary" href="">Add New</a>
		<a target="_blank" class="btn_rename button button_secondary" href="">Rename</a>
		<a target="_blank" class="btn_duplicate button button_secondary" href="">Duplicate</a>
		<a target="_blank" class="btn_import button button_secondary" href="">Import</a>
		<a target="_blank" class="btn_export button button_secondary" href="">Export</a>
		<a target="_blank"  class="btn_delete button button_secondary" href="">Delete</a>
		*/
		?>
		<input type="submit" name="publish" id="publish" class="theme_options_save button button_primary" value="Save Changes" tabindex="5" accesskey="p">
		<div class="clear"></div>
	</div>
	
	<div id="freshcategory">
	
	

		<div id="cat_apply_icon_tooltip">Apply all settings from this section to all it's sub-sections.</div>

		<!-- /////////////////////////////////////////////////////////////////////// -->
		<!-- //             Left Column                                           // -->
		<!-- /////////////////////////////////////////////////////////////////////// -->
		<div id="left-column" class="metabox-holder">

			<!-- /////////////////////////////////////////////////////////////////////// -->
			<!-- //             Box                                                   // -->
			<!-- /////////////////////////////////////////////////////////////////////// -->
			<div id="select-category" class="postbox" >
			<form method="post">
				<h3 class='postbox-title'>
					<span>Sections</span>
				</h3>
				<div class="inside">
					<p class="howto">Select a section you want to edit</p>
					<p>

					<ul id="cat-list">
                    <?php
                        $cat_list = fcatman_get_cat_list();
                        foreach ($cat_list as $key=>$one_cat) {
                            $cat_padding = '';
                            if($one_cat[1] == 'Date' || $one_cat[1] == 'Home Page') $cat_padding = 'style="padding-bottom:50px;"';
                            echo '<li class="cat-list-'.$one_cat[0].'" rel="'.$key.'" '.$cat_padding.' pos="'.$one_cat[0].'">';
                                echo '<div class="cat_name">'.$one_cat[1].'</div>';
                                echo '<div class="cat_apply"><div class="cat_apply_icon"></div></div>';
                            echo '</li>';
                        }
                    ?>
                    </ul>

                    </p>
					<!--<p class="button-controls">
						<img class="waiting" src="http://freshface.cz/work/rw/wp-admin/images/wpspin_light.gif" alt="" />
                        <input type="hidden" name="save_category_manager" value="true">
                        <input type="hidden" name="json_category" id="json_category">
                        <input type="hidden" name="json_single" id="json_single">
						<input type="submit" class="button-primary" name="nav-menu-locations" value="Save" />
					</p>-->
					<div class="clear"></div>
				</div><!-- /.inside -->
			</form>
			</div>
<?php
/*echo '<script>';
echo 'var category_data_holder = jQuery.parseJSON(\''.json_encode ($category_options_json).'\');';
echo 'var single_data_holder = jQuery.parseJSON(\''.json_encode ($single_options_json).'\');';
echo '</script>';*/
?>
		</div><!-- /#left-column -->

		<!-- /////////////////////////////////////////////////////////////////////// -->
		<!-- //             Right Column                                          // -->
		<!-- /////////////////////////////////////////////////////////////////////// -->
		<div id="right-column">

 			<div class="postbox">
				<div class="nav-menu-header">

					<div class="nav-menu-title">
						<div class="button_drop"></div>
						<span>'Category view' Options</span>
					</div><!-- END .nav-menu-title -->
				</div><!-- END .nav-menu-header -->
				<div class="inside">
					<ul id="category-options-additional">
                        <?php
                        	$category_options = $catopt->getCategoryOptions();
							foreach($category_options as $oneopt) {
								switch( $oneopt['type'] ){
									case 'text':
										echo '<li class="text">';
                                		echo '<label for="'.$oneopt['id'].'">';
                                		echo '<input id="'.$oneopt['id'].'" type="'.$oneopt['type'].'" name="'.$oneopt['id'].'" value="'.$oneopt['std'].'">'.$oneopt['text'];
                                		echo '</label>';
                                		echo '</li>';
										break;
										
									case 'color':
										echo '<li class="text">';
											echo '<label for="'.$oneopt['id'].'">';
												echo '<input id="'.$oneopt['id'].'" class="color-input" type="text" style="width:50px;" name="'.$oneopt['id'].'" value="'.$oneopt['std'].'">'.$oneopt['text'];
											echo '</label>';
										echo '</li>';
										break;										
										
									case 'text-img' :
										echo '<li class="text">';
										echo '<label for="'.$oneopt['id'].'">';
										echo '<input id="'.$oneopt['id'].'" type="text" name="'.$oneopt['id'].'" value="'.$oneopt['std'].'">'.$oneopt['text'];
										echo '<a href="'.site_url().'/wp-admin/media-upload.php?TB_iframe=1" media-upload-link="'. $oneopt['id'].'" class="thickbox add_media button " id="" title="Add Media" onclick="return false;">Upload / Insert</a>';
										echo '</label>';
										echo '</li>';
										break;
										
									case 'select':
										echo '<li class="select">';
	                                    echo '<label for="'.$oneopt['id'].'">';
	                                    echo '<select id="'.$oneopt['id'].'" name="'.$oneopt['id'].'" >';
	                                    foreach( $oneopt['options'] as $value )
	                                    {
	                                        echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
	                                    }
	                                    echo '</select>'.$oneopt['text'];
	                                    echo '</label>';
	                                    echo '</li>';
										break;
										
									case 'select-sidebar':
										echo '<li class="select select_sidebar">';
	                                    echo '<label for="'.$oneopt['id'].'">';
	                                    echo '<select id="'.$oneopt['id'].'" name="'.$oneopt['id'].'" class="select_sidebar" >';
	                                    foreach( $oneopt['options'] as $value )
	                                    {
	                                        echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
	                                    }
	                                    echo '</select>'.$oneopt['text'];
	                                    echo '<a href="'.get_template_directory_uri().'/framework/backend/sidebars/view.php?sidebar_manager_lightbox=1&TB_iframe=1" media-upload-link="slide-1" class="thickbox btn_add_sidebar button button_secondary">Add / Edit</a>';
	                                    echo '</label>';
	                                    echo '</li>';
										break;										


										
									case 'check':
										$checked = '';
										if ( $oneopt['std'] === 1 || $oneopt['std'] === '1')
											$checked = 'checked="checked"';
										
										echo '<li class="checkbox">';
                                		echo '<label for="'.$oneopt['id'].'">';
                                		echo '<input id="'.$oneopt['id'].'" type="checkbox" name="'.$oneopt['id'].'" '.$checked.'>'.$oneopt['text'];
                                		echo '</label>';
                                		echo '</li>';
										break;
									
									case 'line':
										echo '<li class="line">';
										echo '</li>';
										break;
									case 'title':
										echo '<li class="title">';
										echo '<h4>'. $oneopt['text'] .'</h4>';
										echo '</li>';
										break;
										
								}
							}
 
                        ?>
                        <div class="clear"></div>
					</ul>
					<div class="clear"></div>
				</div>
			</div><!-- /postbox -->


			<!-- /////////////////////////////////////////////////////////////////////// -->
			<!-- //             Box - with tabs on top                                // -->
			<!-- /////////////////////////////////////////////////////////////////////// -->
			<div class="postbox">
							<div class="nav-menu-header">
								<div class="nav-menu-title">
									<div class="button_drop"></div>
									<span>'Category view' Templates</span>
								</div><!-- END .nav-menu-title -->
							</div><!-- END .nav-menu-header -->
				<div class="inside">

					<!-- /////////////////////////////////////////////////////////////////////// -->
					<!-- //             CATEGORY OPTIONS - Box - with tabs on top             // -->
					<!-- /////////////////////////////////////////////////////////////////////// -->
					<div id="category-options" >

							<div class="nav-tabs-wrapper">
								<span class="select_name">Select Post Type</span>
								<div class="nav-tabs">
									<span id="nav-tab-blog" class="select_button nav-tab-active">Blog</span>
									<span id="nav-tab-portfolio" class="select_button">Portfolio</span>
								</div>
								<div class="clear"></div>
							</div><!-- /.nav-tabs-wrapper -->

							<!-- /////////////////////////////////////////////////////////////////////// -->
							<!-- //             Category Blog                                         // -->
							<!-- /////////////////////////////////////////////////////////////////////// -->
							<div id="category-blog">
								<div class="sidebar_option_wrapper" style="display:none;">
									<span class="select_name">Select Sidebar</span>
									<div id="blog-subnav-left" class="select_button">Left Sidebar</div>
									<div id="blog-subnav-right" class="select_button">Right Sidebar</div>
									<div id="blog-subnav-no" class="select_button">No Sidebar</div>
									<div class="clear"></div>
								</div>

								<ul class="templates_wrapper" id="category-blog-left" rel="blog-subnav-left">
								<?php
									if( !empty($templates['Blog']['Left']) ) {
										$current_templates = $templates['Blog']['Left'];
									
									
										foreach($current_templates as $one_template ) {
										 	echo '<li>';
										 	echo '<label>';
										 	echo '<div class="select_template_image_wrapper"><img src="'.get_template_directory_uri().'/templates/blog/'.$one_template['img'].'"></div>';
										 	echo '<span class="select_template_value">'.$one_template['name'].'</span>';
										 	echo '<span class="select_template_radio"><input type="radio" name="category-template" value="'.$one_template['Filename'].'"></span>';
										 	echo '</label>';
										 	echo '</li>';
										}
									}
                                ?>
									<div class="clear"></div>
								</ul><!-- /#category-blog-left -->

								<ul class="templates_wrapper" id="category-blog-right" rel="blog-subnav-right">
								<?php
									if( !empty($templates['Blog']['Right']) ) {
										$current_templates = $templates['Blog']['Right'];
									
									
										foreach($current_templates as $one_template ) {
										 	echo '<li>';
	                                        echo '<label>';
	                                        echo '<div class="select_template_image_wrapper"><img src="'.get_template_directory_uri().'/templates/blog/'.$one_template['img'].'"></div>';
	                                        echo '<span class="select_template_value">'.$one_template['name'].'</span>';
	                                        echo '<span class="select_template_radio"><input type="radio" name="category-template" value="'.$one_template['Filename'].'"></span>';
	                                        echo '</label>';
	                                        echo '</li>';
										}
									}
                                ?>
									<div class="clear"></div>
								</ul><!-- /#category-blog-right -->

								<ul class="templates_wrapper" id="category-blog-no" rel="blog-subnav-no">
								<?php
									if( !empty($templates['Blog']['Fullwidth']) ) {
										$current_templates = $templates['Blog']['Fullwidth'];
									
									
										foreach($current_templates as $one_template ) {
										 	echo '<li>';
										 	echo '<label>';
										 	echo '<div class="select_template_image_wrapper"><img src="'.get_template_directory_uri().'/templates/blog/'.$one_template['img'].'"></div>';
										 	echo '<span class="select_template_value">'.$one_template['name'].'</span>';
										 	echo '<span class="select_template_radio"><input type="radio" name="category-template" value="'.$one_template['Filename'].'"></span>';
										 	echo '</label>';
										 	echo '</li>';
										}
									}
                                ?>
									<div class="clear"></div>
								</ul><!-- /#category-blog-no -->

								<div class="clear"></div>
							</div><!-- /#category-blog -->

							<!-- /////////////////////////////////////////////////////////////////////// -->
							<!-- //             Category Portfolio                                    // -->
							<!-- /////////////////////////////////////////////////////////////////////// -->
							<div id="category-portfolio">
								<!--<div class="sidebar_option_wrapper">
									<span class="select_name">Select Sidebar:</span>
									<div id="portfolio-subnav-left" class="select_button">Left Sidebar</div>
									<div id="portfolio-subnav-right" class="select_button">Right Sidebar</div>
									<div id="portfolio-subnav-no" class="select_button">No Sidebar</div>
									<div class="clear"></div> 
								</div>-->

								<ul class="templates_wrapper" id="category-portfolio-no" rel="portfolio-subnav-no">
								
								<?php
									if( !empty($templates['Portfolio']['Fullwidth']) ) {
										$current_templates = $templates['Portfolio']['Fullwidth'];
									
									
										foreach($current_templates as $one_template ) {
										 	echo '<li>';
										 	echo '<label>';
										 	echo '<div class="select_template_image_wrapper"><img src="'.get_template_directory_uri().'/templates/portfolio/'.$one_template['img'].'"></div>';
										 	echo '<span class="select_template_value">'.$one_template['name'].'</span>';
										 	echo '<span class="select_template_radio"><input type="radio" name="category-template" value="'.$one_template['Filename'].'"></span>';
										 	echo '</label>';
										 	echo '</li>';
										}
									}
                                ?>
									<div class="clear"></div>
								</ul><!-- /#category-portfolio-no -->

								<div class="clear"></div>
							</div><!-- /#category-portfolio -->
					</div><!-- /#category-options -->
				</div>
			</div>
			
<div class="postbox single-view-options-class">
				<div class="nav-menu-header">

					<div class="nav-menu-title">
						<div class="button_drop"></div>
						<span>'Single Post View' Options</span>
					</div><!-- END .nav-menu-title -->
				</div><!-- END .nav-menu-header -->
				<div class="inside">
					<ul id="single-options-additional">
                        <?php
                        	$category_options = $catopt->getSingleOptions();
							foreach($category_options as $oneopt) {
								switch( $oneopt['type'] ){
									case 'text':
										echo '<li class="text">';
                                		echo '<label for="'.$oneopt['id'].'">';
                                		echo '<input id="'.$oneopt['id'].'" type="'.$oneopt['type'].'" name="'.$oneopt['id'].'" value="'.$oneopt['std'].'">'.$oneopt['text'];
                                		echo '</label>';
                                		echo '</li>';
										break;
										
									case 'select':
										echo '<li class="select">';
	                                    echo '<label for="'.$oneopt['id'].'">';
	                                    echo '<select id="'.$oneopt['id'].'" name="'.$oneopt['id'].'" >';
	                                    foreach( $oneopt['options'] as $value )
	                                    {
	                                        echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
	                                    }
	                                    echo '</select>'.$oneopt['text'];
	                                    echo '</label>';
	                                    echo '</li>';
										break;
										
								case 'select-sidebar':
										echo '<li class="select select_sidebar">';
	                                    echo '<label for="'.$oneopt['id'].'">';
	                                    echo '<select id="'.$oneopt['id'].'" name="'.$oneopt['id'].'" class="select_sidebar">';
	                                    foreach( $oneopt['options'] as $value )
	                                    {
	                                        echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
	                                    }
	                                    echo '</select>'.$oneopt['text'];
	                                    echo '<a href="'.get_template_directory_uri().'/framework/backend/sidebars/view.php?sidebar_manager_lightbox=1&TB_iframe=1" media-upload-link="slide-1" class="thickbox btn_add_sidebar button button_secondary">Add / Edit</a>';
	                                    echo '</label>';
	                                    echo '</li>';
										break;													
										
									case 'check':
										$checked = '';
										if ( $oneopt['std'] === 1 || $oneopt['std'] === '1')
											$checked = 'checked="checked"';
										
										echo '<li class="checkbox">';
                                		echo '<label for="'.$oneopt['id'].'">';
                                		echo '<input id="'.$oneopt['id'].'" type="checkbox" name="'.$oneopt['id'].'" '.$checked.'>'.$oneopt['text'];
                                		echo '</label>';
                                		echo '</li>';
										break;
									
									case 'line':
										echo '<li class="line">';
										echo '</li>';
										break;
									case 'title':
										echo '<li class="title">';
										echo '<h4>'. $oneopt['text'] .'</h4>';
										echo '</li>';
										break;
										
								}
							}
                        	
       
                        ?>
                        <div class="clear"></div>
					</ul>
					<div class="clear"></div>
				</div>
			</div><!-- /postbox -->			


			<!-- /////////////////////////////////////////////////////////////////////// -->
			<!-- //             Box - with tabs on top                                // -->
			<!-- /////////////////////////////////////////////////////////////////////// -->
			<div class="postbox single-view-options-class" style="display:none; opacity:0;">
							<div class="nav-menu-header">
								<div class="nav-menu-title">
									<div class="button_drop"></div>
									<span>'Single Post view' Templates</span>
								</div><!-- END .nav-menu-title -->
							</div><!-- END .nav-menu-header -->
				<div class="inside">

					<!-- /////////////////////////////////////////////////////////////////////// -->
					<!-- //             SINGLE OPTIONS - Box - with tabs on top               // -->
					<!-- /////////////////////////////////////////////////////////////////////// -->
					<div id="single-options">

							<!-- /////////////////////////////////////////////////////////////////////// -->
							<!-- //             single Blog                                         // -->
							<!-- /////////////////////////////////////////////////////////////////////// -->
							<div id="single-blog">
								<div class="sidebar_option_wrapper">
									<span class="select_name">Select Sidebar</span>
									<div id="single-blog-subnav-left" class="select_button">Left Sidebar</div>
									<div id="single-blog-subnav-right" class="select_button">Right Sidebar</div>
									<div id="single-blog-subnav-no" class="select_button">No Sidebar</div>
									<div class="clear"></div>
								</div>

								<ul class="templates_wrapper" id="single-blog-left" rel="single-blog-subnav-left" title="nav-tab-single-blog">
								<?php
									if( !empty($templates['Single']['Left']) ) {
										$current_templates = $templates['Single']['Left'];
									
									
										foreach($current_templates as $one_template ) {
										 	echo '<li>';
										 	echo '<label>';
										 	echo '<div class="select_template_image_wrapper"><img src="'.get_template_directory_uri().'/templates/post/'.$one_template['img'].'"></div>';
										 	echo '<span class="select_template_value">'.$one_template['name'].'</span>';
										 	echo '<span class="select_template_radio"><input type="radio" name="single-template" value="'.$one_template['Filename'].'"></span>';
										 	echo '</label>';
										 	echo '</li>';
										}
									}
                                ?>
									<div class="clear"></div>
								</ul><!-- /#single-blog-left -->

								<ul class="templates_wrapper" id="single-blog-right" rel="single-blog-subnav-right" title="nav-tab-single-blog">
								<?php
									if( !empty($templates['Post']['Right']) ) {
										$current_templates = $templates['Post']['Right'];
									
									
										foreach($current_templates as $one_template ) {
										 	echo '<li>';
										 	echo '<label>';
										 	echo '<div class="select_template_image_wrapper"><img src="'.get_template_directory_uri().'/templates/post/'.$one_template['img'].'"></div>';
										 	echo '<span class="select_template_value">'.$one_template['name'].'</span>';
										 	echo '<span class="select_template_radio"><input type="radio" name="single-template" value="'.$one_template['Filename'].'"></span>';
										 	echo '</label>';
										 	echo '</li>';
										}
									}
                                ?>
									<div class="clear"></div>
								</ul><!-- /#single-blog-right -->

								<ul class="templates_wrapper" id="single-blog-no" rel="single-blog-subnav-no" title="nav-tab-single-blog">
								<?php
							 
								if( !empty($templates['Post']['Fullwidth']) ) {
										$current_templates = $templates['Post']['Fullwidth'];
									
									
										foreach($current_templates as $one_template ) {
										 	echo '<li>';
										 	echo '<label>';
										 	echo '<div class="select_template_image_wrapper"><img src="'.get_template_directory_uri().'/templates/post/'.$one_template['img'].'"></div>';
										 	echo '<span class="select_template_value">'.$one_template['name'].'</span>';
										 	echo '<span class="select_template_radio"><input type="radio" name="single-template" value="'.$one_template['Filename'].'"></span>';
										 	echo '</label>';
										 	echo '</li>';
										}
									}
                                ?>
									<div class="clear"></div>
								</ul><!-- /#single-blog-no -->

								<div class="clear"></div>
							</div><!-- /#single-blog -->

							<!-- /////////////////////////////////////////////////////////////////////// -->
							<!-- //             single Portfolio                                    // -->
							<!-- /////////////////////////////////////////////////////////////////////// -->
							<div id="single-portfolio" style="display:none;">
								<div class="sidebar_option_wrapper">
									<span class="select_name">Select Sidebar</span>
									<div id="single-portfolio-subnav-left" class="select_button">Left Sidebar</div>
									<div id="single-portfolio-subnav-right" class="select_button">Right Sidebar</div>
									<div id="single-portfolio-subnav-no" class="select_button">No Sidebar</div>
									<div class="clear"></div>
								</div>



								<div class="clear"></div>
							</div><!-- /#category-portfolio -->
					</div><!-- /#category-options -->
				</div>
			</div>

		</div><!-- /#right-column --><!-- /RIGHT COLUMN -->
		<div class="clear"></div>
	</div><!-- /#freshcategory -->
</div><!-- /.wrap-->
<div class="clear"></div>

<?php
}