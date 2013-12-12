<?php
	fEnv::addAdminMenu('Help', 'Help', 'fhelp', 5);
	fEnv::addAdminStyle('fhelp',  get_template_directory_uri(). '/framework/backend/help/style.css');
	
	function fhelp_save() {
		
	}
	
	function fhelp_view() {
		echo '<div style="font-family: Arial; color: #909090; font-size: 18px; margin: 30px 0 0 0;">View the Wise Guys documentation <a href="http://docs.freshface.net/m/9519">here</a></div>';
	}
?>