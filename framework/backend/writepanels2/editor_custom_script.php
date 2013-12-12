<?php
 

add_filter('mce_external_plugins', "tinyplugin_register");
add_filter('mce_external_languages', "tinyplugin_register_languages");
add_filter('mce_buttons', 'tinyplugin_add_button', 0);

 
 
function f_is_post_or_page_admin() {
    if( FALSE !== strpos($_SERVER['PHP_SELF'], "/wp-admin/post.php") ){
        return TRUE;
    }

    if( FALSE !== strpos($_SERVER['PHP_SELF'], "/wp-admin/post-new.php") ){
        return TRUE;
    }

    return FALSE;
}

function tinyplugin_add_button($buttons)
{
	if( !f_is_post_or_page_admin() ) return $buttons;
    array_push($buttons, "separator", "framework_shortcodes");
    return $buttons;
	
}

function tinyplugin_register($plugin_array)
{
	if( !f_is_post_or_page_admin() ) return $plugin_array;
    $url = get_template_directory_uri().'/framework/backend/writepanels2/editorscript.js';

    $plugin_array['framework_shortcodes'] = $url;
    return $plugin_array;
}

function tinyplugin_register_languages($p)
{
    if( !f_is_post_or_page_admin() ) return $p;
    $url = get_template_directory_uri().'/framework/backend/writepanels2/blank.js';

    $p['framework_shortcodes'] = $url;
    return $p;
}

add_action('admin_enqueue_scripts','show_editor_custom_script');
function show_editor_custom_script() {
	
	wp_enqueue_style('asdasd', get_template_directory_uri(). '/framework/backend/writepanels2/editorcss.css');
}



add_action('wp_ajax_framework_editor', 'framework_editor_callback');

function print_shortcode_menu_items( $shortcodes ) {
	foreach( $shortcodes as $one_shortcode ) {
		echo '<li class="shortcode_item">';
			echo '<a class="shortcode_button top-menu-item-a" href=""><span>'.$one_shortcode['name'].'</span></a>';
			echo '<div class="data_info" style="display:none;">';
				echo '<div class="type">'.$one_shortcode['type'].'</div>';
				echo '<div class="shortcode">'.$one_shortcode['shortcode'].'</div>';
				echo '<div class="attributes">';
					if( isset( $one_shortcode['attributes'] ) ) {
						foreach( $one_shortcode['attributes'] as $name => $value ) {
							echo '<div data-name="'.$name.'" data-value="'.$value.'" class = "attribute"></div>';
						}
					} else {
						echo 'empty';
					}
				echo '</div>';
			echo '</div>';
		echo '</li>';
	}
}


function framework_editor_callback() {
	$shortcodes_data = array(
	array(
		'name' => 'Columns',
		'type' => 'top-menu-item',
		'shortcodes' => array(
			array(
				'name' => 'One Half',
				'type' => 'wrapping_content',
				'shortcode' => 'one_half',
			) ,
			array(
				'name' => 'One Half Last',
				'type' => 'wrapping_content',
				'shortcode' => 'one_half_last',
			) ,
			array(
				'name' => 'One Third',
				'type' => 'wrapping_content',
				'shortcode' => 'one_third',
			) ,
			array(
				'name' => 'One Third Last',
				'type' => 'wrapping_content',
				'shortcode' => 'one_third_last',
			) ,
			array(
				'name' => 'Two Third',
				'type' => 'wrapping_content',
				'shortcode' => 'two_third',
			) ,
			array(
				'name' => 'Two Third Last',
				'type' => 'wrapping_content',
				'shortcode' => 'two_third_last',
			) ,
			array(
				'name' => 'One Fourth',
				'type' => 'wrapping_content',
				'shortcode' => 'one_fourth',
			) ,
			array(
				'name' => 'One Fourth Last',
				'type' => 'wrapping_content',
				'shortcode' => 'one_fourth_last',
			) ,
			array(
				'name' => 'Three Fourth',
				'type' => 'wrapping_content',
				'shortcode' => 'three_fourth',
			) ,
			array(
				'name' => 'Three Fourth Last',
				'type' => 'wrapping_content',
				'shortcode' => 'three_fourth_last',
			) ,
		) ,
	) ,
	array(
		'name' => 'Elements',
		'type' => 'top-menu-item',
		'shortcodes' => array(
			array(
				'name' => 'Pullquote left',
				'type' => 'wrapping_content',
				'shortcode' => 'pullquote_left',
			) ,
			array(
				'name' => 'Pullquote right',
				'type' => 'wrapping_content',
				'shortcode' => 'pullquote_right',
			) ,
			array(
				'name' => 'Blockquote',
				'type' => 'wrapping_content',
				'shortcode' => 'blockquote',
			) ,
			array(
				'name' => 'Dropcap',
				'type' => 'wrapping_content',
				'shortcode' => 'dropcap',
				'attributes' => array(
					'type' => '1'
				) ,
			) ,
			array(
				'name' => 'Highlight',
				'type' => 'wrapping_content',
				'shortcode' => 'highlight',
			) ,
			array(
				'name' => 'Lightbox',
				'type' => 'wrapping_content',
				'shortcode' => 'lightbox',
				'attributes' => array(
					'href' => '#',
					'title' => '',
					'highlight' => '1'
				) ,
			) ,
			array(
				'name' => 'Tooltip',
				'type' => 'wrapping_content',
				'shortcode' => 'tooltip',
				'attributes' => array(
					'text' => '',
					'highlight' => '1'
				) ,
			) ,
			array(
				'name' => 'Divider',
				'type' => '',
				'shortcode' => 'divider',
				'attributes' => array(
					'margin' => '0',
					'padding' => '0',
					'line' => '1'
				) ,
			) ,
		) ,
	) ,
);

	
	
?>

<div id="shortcodes_list_wrapper">
	<ul id="shortcodes_list">
		<li class="shortcode_item top-menu-item has-sub-menu">
			<a class="shortcode_button top-menu-item-a has-sub-menu-a" href=""><span>Template Builder</span></a>
			<ul class="sub-menu">
				<?php
				 	$nspace = fOpt::GetNamespace('pagebuilder_templates');
					$keys = array_keys($nspace);
					
					foreach( $keys as $one_key ) {
						echo '<li class="shortcode_item" rel="pb_template">';
							echo '<a class="shortcode_button" href=""><span>' . $one_key . '</span></a>';
						echo '</li>';
					}
				?>
		
			</ul>			
		</li>
<?php
	 	foreach( $shortcodes_data as $one_shortcode_topmenu ) {
	 		echo '<li class="shortcode_item top-menu-item">';
	 			echo '<a class="shortcode_button top-menu-item-a has-sub-menu-a href=""><span>'.$one_shortcode_topmenu['name'].'</span></a>';
	 			echo '<ul class="sub-menu">';
	 				print_shortcode_menu_items( $one_shortcode_topmenu['shortcodes'] ); 
	 			echo '</ul>';
	 		echo '</li>';	
	 	}
	 	
/*	
		<li class="shortcode_item top-menu-item">
			<a class="shortcode_button top-menu-item-a has-sub-menu-a" href=""><span>Columns</span></a>
			<ul class="sub-menu">
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>One Half</span></a>
				</li>
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>One Half Last</span></a>
				</li>
				
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>One Third</span></a>
				</li>
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>One Third Last</span></a>
				</li>
				
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>Two Third</span></a>
				</li>				
				
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>Two Third Last</span></a>
				</li>				
				
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>One Fourth</span></a>
				</li>				
				
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>One Fourth Last</span></a>
				</li>				
				
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>Three Fourth</span></a>
				</li>				
				
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>Three Fourth Last</span></a>
				</li>				
			</ul>
		</li>
		
		<li class="shortcode_item top-menu-item">
			<a class="shortcode_button top-menu-item-a has-sub-menu-a" href=""><span>Elements</span></a>
			<ul class="sub-menu">
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>Dropcap</span></a>
				</li>
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>Button</span></a>
				</li>
				
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>Download Box</span></a>
				</li>
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>Error Box</span></a>
				</li>
				
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>Info Box</span></a>
				</li>				
				
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>Note Box</span></a>
				</li>				
				
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>Pullquote Left</span></a>
				</li>				
				
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>Pullquote Right</span></a>
				</li>				
				
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>Highlighted Text 1</span></a>
				</li>				
				
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>Highlighted Text 2</span></a>
				</li>				
				
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>Image Float Left</span></a>
				</li>
				
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>Image Float Right</span></a>
				</li>				
				
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>Divider - Top Button</span></a>
				</li>				
				
				<li class="shortcode_item">
					<a class="shortcode_button top-menu-item-a" href=""><span>Toggle</span></a>
				</li>								
			</ul>
		</li>			
*/?>
	</ul>
</div>



					
												

<?php
die;
}