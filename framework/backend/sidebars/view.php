<?php
 

if ( isset( $_GET['sidebar_manager_lightbox'] ) && $_GET['sidebar_manager_lightbox'] == 1 ) {
	if ( ! isset( $_GET['inline'] ) )
	define( 'IFRAME_REQUEST' , true );

	require realpath(dirname(__FILE__).'/../../../../../../wp-load.php');
	
	$sidcol = new fSidebarCollection();
	
	if ( isset($_POST['delete_sidebar']) && $_POST['delete_sidebar'] !== 'none' ) {
	 	
	}
	else if( isset($_POST['sidebars_count'] ) ) {
		$sidebars_count = $_POST['sidebars_count'];
	
		for( $i=0; $i< $sidebars_count; $i++) {
			$name = $_POST['sidebar_name_'.$i];
			$id = $_POST['sidebar_id_'.$i];
			
			if( $id == 'none' ) {
				$sidcol->addSidebar( $name );
			} else {
				if( $name == 'fw_sid_manager_delete'){ 
					$sidcol->deleteSidebar($id);
					
				}
				
				else
					$sidcol->editSidebar($id, $name);
			}
		}
	

	}
	
	
	$sid_list = $sidcol->getSidebars();
	
	
	?>
	
	<head>
		<link rel='stylesheet' href="<?php echo  get_template_directory_uri()?>/framework/backend/sidebars/style.css" type='text/css' media='all' />
 		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
 		<script src="<?php echo  get_template_directory_uri()?>/framework/backend/sidebars/script.js"></script>
	</head>
	<body style="opacity:0;">
		<form action="<?php echo fEnv::curPageUrl(); ?>" METHOD="POST">
		<div id="sidebar_manager">
			
			<div id="sidebar_manager_add_wrapper">	
				<h3 class="sidebar_manager_title">Add New Sidebar</h3>
				<p>
					<input type="text" name="new_sidebar_name" class="new_sidebar_name"><a href="" class="btn_add button button_secondary add_sidebar sm_add_new_sidebar">Add Custom Sidebar</a>
				</p>
			</div>
			<div id="sidebar_manager_list_wrapper">
				<h3 class="sidebar_manager_title">Custom Sidebars</h3>
				<input type="hidden" name="sidebars_count" class="sidebars_count" value="<?php echo count($sid_list); ?>">
				<input type="hidden" name="delete_sidebar" class="delete_sidebar" value="none">
				<div class="sidebar_manager_list">
						
					<?php 
						echo '<div class="sidebar_manager_item_blank" style="display:none">';
							echo '<input type="text" name="sidebar_name" class="sidebar_name" value="">';
							echo '<input type="hidden" name="sidebar_id" class="sidebar_id" value="">';
							echo '<a class="sidebar_manager_item_button sidebar_manager_item_button_rename btn_add button button_secondary">Rename</a>';
							echo '<a class="sidebar_manager_item_button sidebar_manager_item_button_delete btn_add button button_secondary">Delete</a>';
							echo '<div class="clear"></div>';
						echo '</div>';
					foreach( $sid_list as $id=>$name ) {
						echo '<div class="sidebar_manager_item">';
							echo '<input type="text" name="sidebar_name" class="sidebar_name" value="'.$name.'">';
							echo '<input type="hidden" name="sidebar_id" class="sidebar_id" value="'.$id.'">';
							echo '<a class="sidebar_manager_item_button sidebar_manager_item_button_rename btn_add button button_secondary">Rename</a>';
							echo '<a class="sidebar_manager_item_button sidebar_manager_item_button_delete btn_add button button_secondary">Delete</a>';
							echo '<div class="clear"></div>';
						echo '</div>';
					}
					?>
					
				</div>
				 
			</div>
			<p class="ml-submit">
			<input type="submit" value="Save Changes" class="sm_save_sidebars button button_primary">
			<input type="submit" value="Close" class="sm_close_sidebars button button_primary">
			</p>
			
		</div>
		</form>
	</body>
	
	<?php 
	
}