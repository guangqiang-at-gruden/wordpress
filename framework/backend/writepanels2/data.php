<?php
add_action('ff_framework_loaded', 'create_metabox_data');

function create_metabox_data() {
	$sidebarCollection = new fSidebarCollection();
	
	$ms = metaboxDataStore::getInstance();
	// addOption( $type, $id, $title, $description, $std, $values = null )	
/******************************************************************************/
/*----------------------------------------------------------------------------*/
/* Post Type ALL ( slider, video, etc )
/*----------------------------------------------------------------------------*/
/******************************************************************************/			
	$ms->startMetabox(__('Post Featured Image Type', ffgtd()), metaboxDataStore::METABOX_POST_TYPE_POST, metaboxDataStore::METABOX_CONTEXT_SIDE );
		$ms->addOption('select', 'featured_image_type', '', '', 'hovno', array(
			array('name'=> __('Standard Image', ffgtd()), 'value'=>'std'),
			array('name'=> __('Image Slider', ffgtd()), 'value'=>'slider'),
			array('name'=> __('Open in Lightbox', ffgtd()), 'value'=>'lightbox'),
			array('name'=> __('Video', ffgtd()), 'value'=>'video'),
		));
		$ms->addOption('text', 'featured_image_height', '', __('fixed image height ?', ffgtd()), 0);
		$ms->addOption('text', 'featured_image_video_link','', __('Video Link', 'please paste video link from youtube / vimeo', ffgtd()), '');
	$ms->endMetabox();
	
	$ms->startMetabox(__('Post Featured Image Type', ffgtd()), metaboxDataStore::METABOX_POST_TYPE_PAGE, metaboxDataStore::METABOX_CONTEXT_SIDE );
	$ms->addOption('select', 'featured_image_type', '', '', 'std', array(
			array('name'=> __('Standard Image', ffgtd()), 'value'=>'std'),
			array('name'=> __('Image Slider', ffgtd()), 'value'=>'slider'),
			array('name'=> __('Open in Lightbox', ffgtd()), 'value'=>'lightbox'),
			array('name'=> __('Video', ffgtd()), 'value'=>'video'),
	));
	$ms->addOption('text', 'featured_image_height', '', __('fixed image height ?', ffgtd()), 0);
	$ms->addOption('text', 'featured_image_video_link', 'Video Link', __('please paste video link from youtube / vimeo', ffgtd()), '');
	$ms->endMetabox();

	$ms->startMetabox(__('Sidebar Settings', ffgtd()), metaboxDataStore::METABOX_POST_TYPE_POST, metaboxDataStore::METABOX_CONTEXT_ADVANCED );
	$ms->addOption('sidebar', 'fw_sidebar', __('Custom Sidebar Name', ffgtd()), __('Custom Sidebar Name', ffgtd()), 'default', $sidebarCollection->getSidebarsValueListCorrect() );
	$ms->addOption('select', 'fw_sidebar_position', __('Custom Sidebar Position', ffgtd()), __('Custom Sidebar Position', ffgtd()), 'default',
			array(
					array('name'=> 'Default', 'value'=>'default'),
					array('name'=> 'Left', 'value'=>'left'),
					array('name'=> 'Right', 'value'=>'right'),
			));
	$ms->endMetabox();	
/******************************************************************************/
/*----------------------------------------------------------------------------*/
/* Page
/*----------------------------------------------------------------------------*/
/******************************************************************************/
	$ms->startMetabox(__('Slider Page Settings', ffgtd()), metaboxDataStore::METABOX_POST_TYPE_PAGE, metaboxDataStore::METABOX_CONTEXT_ADVANCED );
		$ms->addOption('check', 'slider_show', 'Enable Slider', __('Show slider at this page ?', ffgtd()), metaBoxManager::UNCHECKED_FIELD );
		$ms->addOption('select', 'slider_type', 'Slider type', __('Select wished slider here', ffgtd()), '', ffRevSliderConnector::getInstance()->getSliders()
		);
	$ms->endMetabox();
	
	$ms->startMetabox(__('Description Bar', ffgtd()), metaboxDataStore::METABOX_POST_TYPE_PAGE, metaboxDataStore::METABOX_CONTEXT_ADVANCED );
		//$ms->addOption('check', 'description_show', 'Show Description', 'Show description panel', 1);
		$ms->addOption('check', 'description_bc_show', __('Show Description Breadcrumbs', ffgtd()), __('Show breadcrumbs', ffgtd()), 1);
		//$ms->addOption('text', 'description_upper', 'Upper description', __('The big description bar UPPER', '');
		$ms->addOption('text', 'description_lower', __('Lower description', ffgtd()), __('The big description bar lower', ffgtd()), '');
	$ms->endMetabox();
	
	$ms->startMetabox(__('Background Settings', ffgtd()), metaboxDataStore::METABOX_POST_TYPE_PAGE, metaboxDataStore::METABOX_CONTEXT_ADVANCED );
		$ms->addOption('select', 'description_bg_type', 'Background type', '', 'std', array(
				array('name'=> __('Default', ffgtd()), 'value'=>'default'),
				array('name'=> __('Image', ffgtd()), 'value'=>'image'),
				array('name'=> __('Pattern', ffgtd()), 'value'=>'pattern'),
				array('name'=> __('Color', ffgtd()), 'value'=>'color'),
		));
	//$ms->addOption('text', 'description_upper', 'Upper description', 'The big description bar UPPER', '');
		$ms->addOption('text-img', 'description_bg_image', 'Background Image', '', '');
		$ms->addOption('text-color', 'description_bg_color', 'Background Color', '', '');
	$ms->endMetabox();
	
	
	
	$ms->startMetabox(__('Gallery Settings', ffgtd()), metaboxDataStore::METABOX_POST_TYPE_PAGE, metaboxDataStore::METABOX_CONTEXT_ADVANCED, array('page_template'=>array('page-gallery')) );
		$ms->addOption('select', 'gallery_columns', __('Number of Columns', ffgtd()), '', '3', array(
				array('name'=> '3', 'value'=>'3'),
				array('name'=> '4', 'value'=>'4'),
				array('name'=> '5', 'value'=>'5'),
		));
	$ms->endMetabox();

	$ms->startMetabox(__('Sidebar Settings', ffgtd()), metaboxDataStore::METABOX_POST_TYPE_PAGE, metaboxDataStore::METABOX_CONTEXT_ADVANCED, array('page_template'=>array('page-gallery', 'page-sidebar', 'page-contact')) );
		$ms->addOption('sidebar', 'fw_sidebar', __('Custom Sidebar Name', ffgtd()), __('Custom Sidebar Name', ffgtd()), 'default', $sidebarCollection->getSidebarsValueListCorrect() );
		$ms->addOption('select', 'fw_sidebar_position', __('Custom Sidebar Position', ffgtd()), __('Custom Sidebar Position', ffgtd()), 'right', 
				array(
				array('name'=> 'Left', 'value'=>'left'),
				array('name'=> 'Right', 'value'=>'right'),
						));
	$ms->endMetabox();
	
	//var_dump(  $sidebarCollection->getSidebarsValueList() );
	$ms->startMetabox(__('Contact Page Settings', ffgtd()), metaboxDataStore::METABOX_POST_TYPE_PAGE, metaboxDataStore::METABOX_CONTEXT_ADVANCED, array('page_template'=>array('page-contact')) );
		$ms->addOption('select', 'contact_form_name', __('Contact Form Name', ffgtd()), '', 'std', components_cf_callback() );
		$ms->addOption('check', 'map_show', __('Show Map', ffgtd()), __('Show the google map ?', ffgtd()), 1);
		$ms->addOption('text', 'map_ll', __('Longtitude and Lattitude', ffgtd()), '', '34.052234,-118.243685' );
		$ms->addOption('text', 'map_hnear', __('Near', ffgtd()), __('please respect this marking', ffgtd()), 'Santa+Monica,+California,+United+States' );
		$ms->addOption('text-area-big', 'social_icons', __('Social Links', ffgtd()), __('Add a links to your social pages. Will be proceeded automatically', ffgtd()),'');
	$ms->endMetabox();	
	
/******************************************************************************/
/*----------------------------------------------------------------------------*/
/* Portfolio
/*----------------------------------------------------------------------------*/
/******************************************************************************/
	$ms->startMetabox(__('Post Featured Image Type', ffgtd()), metaboxDataStore::METABOX_POST_TYPE_PORTFOLIO, metaboxDataStore::METABOX_CONTEXT_SIDE );
		$ms->addOption('text', 'featured_image_video_link', __('Video Link', ffgtd()), __('please paste video link from youtube / vimeo', ffgtd()), '');
	$ms->endMetabox();	
	
	$ms->startMetabox(__('Project details', ffgtd()), metaboxDataStore::METABOX_POST_TYPE_PORTFOLIO, metaboxDataStore::METABOX_CONTEXT_ADVANCED);
		$ms->addOption('text', 'portfolio_image_description', __('Description', ffgtd()), __('Text under the main image', ffgtd()),'');
		$ms->addOption('text', 'project_details_title', __('Title of the infobox', ffgtd()), '','Project Details');
		$ms->addOption('text-area-big', 'project_details_text', __('Content of the infobox', ffgtd()), __('Divide with !:! and enter the lines', ffgtd()),'');
	$ms->endMetabox();
	
	$ms->startMetabox(__('Sidebar Settings', ffgtd()), metaboxDataStore::METABOX_POST_TYPE_PORTFOLIO, metaboxDataStore::METABOX_CONTEXT_ADVANCED );
	$ms->addOption('sidebar', 'fw_sidebar', __('Custom Sidebar Name', ffgtd()), __('Custom Sidebar Name', ffgtd()), 'default', $sidebarCollection->getSidebarsValueListCorrect() );
	$ms->addOption('select', 'fw_sidebar_position', __('Custom Sidebar Position', ffgtd()), __('Custom Sidebar Position', ffgtd()), 'default',
			array(
					array('name'=> 'Default', 'value'=>'default'),
					array('name'=> 'Left', 'value'=>'left'),
					array('name'=> 'Right', 'value'=>'right'),
					array('name'=> 'Fullwidth', 'value'=>'fullwidth'),
			));
	$ms->endMetabox();	
	
/******************************************************************************/	
/******************************************************************************/
/*----------------------------------------------------------------------------*/
/* Gallery
/*----------------------------------------------------------------------------*/
/******************************************************************************/	
	$ms->startMetabox(__('Gallery', ffgtd()), metaboxDataStore::METABOX_POST_TYPE_ALL, metaboxDataStore::METABOX_CONTEXT_ADVANCED );
		$ms->addOption('gallery', 'gallery_slider', '', '', '');
	$ms->endMetabox();
	
/*	$ms->startMetabox('title pico', 'page');
	$ms->addOption('text', 'ide_pico4', 'titulek', 'popisek', 'hovno');
	$ms->addOption('text', 'ide_pico5', 'titulek', 'popisek', 'hovno');
	$ms->addOption('text', 'ide_pico6', 'titulek', 'popisek', 'hovno');
	$ms->endMetabox();*/
	
	$mm = new metaBoxManager();
}