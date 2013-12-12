<?php


function foptions_get_data_object() {
	
	$tos = new fThemeOptionsStore();
 
/************************************************************************************************
 * TRANSLATION
 */ 
	

	$tos->startNamespace('homepage', 'homepage', __('Home Page', ffgtd()));
		$tos->startOption(__('Slider Area', ffgtd()), '');
			$tos->addParameterNL('check', 'slider-show', 1, __('Show Slider on the Home Page', ffgtd()));
			
			
			
			$tos->addParameterNL('select', 'homepage-slider', '', __(' Select your Slider', ffgtd()), ffRevSliderConnector::getInstance()->getSliders() );

		
		$tos->startOption(__('Content Area', ffgtd()), __('Content Area settings work only with "Settings -&gt; Reading -&gt; Front Page Displays -&gt; Your latest posts"', ffgtd()));
			$pages = get_pages();
			$templates_to_select = array();
			foreach( $pages as $one_page ) {
				
				$templates_to_select[] = array('name'=>$one_page->post_title, 'value'=> $one_page->ID );
			}
			$tos->addParameterNL('check', 'show-page', 1, __('Show Page (e.g., About) on the Home Page ', ffgtd()));
			
			
			$val = $templates_to_select[0]['name'];
			
			
			$tos->addParameterNL('select', 'content-page', $val, __(' Select your Page', ffgtd()), $templates_to_select );

			$tos->addParameterNL('check', 'category-feed-show', 0 , __('Show Category (e.g., Blog) on the Home Page', ffgtd()));
			$tos->addParameter('text-regular','category-feed-id', '', __(' are the categories you want to show. Insert only category IDs, separated with comma. Leave blank to show all categories. Example: 15,25,35', ffgtd())); $tos->nextLine();
			

			
///////// START HERE //////////////////////////////////////////////////////
			
	$tos->startNamespace('header', 'header',__('Header', ffgtd()));			
		$tos->startOption(__('Header', ffgtd()), '');
			$tos->addParameterNL('check', 'logo-show', 1, __('Show Logo', ffgtd()));			
			$tos->addParameter('text-img','logo-url', '', __(' Logo Image URL', ffgtd())); $tos->nextLine();	

	$tos->startNamespace('footer', 'footer',__('Footer', ffgtd()));			
		$tos->startOption(__('Footer A', ffgtd()), '');
			$tos->addParameter('check','footer-a-show', 1, __('Show Footer A', ffgtd())); $tos->nextLine();
			
			$footerWidgetCount = array( array('name' => 3, 'value' =>3), array( 'name'=>4, 'value'=>4) );
			
			$tos->addParameter('select','footer-widget-count', 4, __(' Number of widget-ready Columns', ffgtd()), $footerWidgetCount); $tos->nextLine();
			
		$tos->startOption(__('Footer B', ffgtd()), '');
			$tos->addParameter('check','footer-b-show', 1, __('Show Footer B', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-area','footer-b-left-text', __('Copyright &copy; Wise Guys 2012', ffgtd()), __(' Text content of the Left Side in Footer B. HTML is supported.', ffgtd())); $tos->nextLine();

			
	$tos->startNamespace('translation', 'translation',__('Translation', ffgtd()));
		$tos->startOption(__('Responsive Mode', ffgtd()), '');
			$tos->addParameter('text-regular','navigation-responsive-title', __('Navigation', ffgtd()), __(' Title of navigation when responsive mode is active', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-regular','portfolio-responsive-title', __('Categories', ffgtd()), __(' Title of portfolio filterable when responsive mode is active', ffgtd())); $tos->nextLine();
		//	$tos->addParameter('text-regular','navigation-responsive-title', 'Navigation', ' Title of navigation when responsive mode is active'); $tos->nextLine();
		
			$tos->startOption(__('Breadcrumbs', ffgtd()), '');
				$tos->addParameter('text-regular','breadcrumbs-home', __('Home', ffgtd()), __(' Home button on breadcrumbs', ffgtd())); $tos->nextLine();
			
				
			$tos->startOption(__('Social Icons Tooltip', ffgtd()), '');
				$tos->addParameter('text-regular','social-icons-home', __('Home', ffgtd()), __(' Home social buttons', ffgtd())); $tos->nextLine();
				$tos->addParameter('text-regular','social-icons-phone', __('Phone', ffgtd()), __(' Phone social buttons', ffgtd())); $tos->nextLine();
				$tos->addParameter('text-regular','social-icons-email', __('Email', ffgtd()), __(' Phone social buttons', ffgtd())); $tos->nextLine();
			
			
		$tos->startOption('Post Meta', '');
			$tos->addParameter('text-regular','post-posted-by', __('Posted by ', ffgtd()), __(' Posted by', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-regular','post-posted-in', __(' in ', ffgtd()), __(' in (e.g., Posted <b><u>in</u></b> Blog)', ffgtd())); $tos->nextLine();
			
			$tos->addParameter('text-regular','post-comment-count-zero', __('No comments yet', ffgtd()), __(' No comments yet', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-regular','post-comment-count-one', __('1 comment', ffgtd()), __(' 1 comment', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-regular','post-comment-count-more', __('% comments', ffgtd()), __(' %(=number of comments) comments', ffgtd())); $tos->nextLine();
			
		$tos->startOption(__('Post Buttons', ffgtd()), '');
			$tos->addParameter('text-regular','post-button-readmore', __('Read more', ffgtd()), __(' Read more button', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-regular','post-button-share', __('Share', ffgtd()), __(' Share button', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-regular','post-description-share', __('Please select the social network you want to share this page with:', ffgtd()), __(' Description before the share buttons', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-regular','post-button-appreciate', __('Appreciate', ffgtd()), __(' Appreciate button', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-area','post-description-appreciate', __('<h6>We like you too :)</h6> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tincidunt dapibus dui, necimas condimentum ante auctor vitae. Praesent id magna eget libero consequat mollis.</p>', ffgtd()), __(' Description before the appreciate button', ffgtd())); $tos->nextLine();

			$tos->addParameter('text-regular','post-button-comment', __('Comment', ffgtd()), __(' Comment Button', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-regular','post-button-tags', __('Tags', ffgtd()), __(' Tags Button', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-regular','post-button-author', __('About the author', ffgtd()), __(' Author Button', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-regular','post-button-back', __('Back to blog', ffgtd()), __(' Back to blog', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-regular','post-button-back-portfolio', __('Back to portfolio', ffgtd()), __(' Back to portfolio', ffgtd())); $tos->nextLine();

		$tos->startOption(__('Similar posts', ffgtd()), '');
			$tos->addParameter('text-regular','post-similar-blog', __('SIMILAR POSTS', ffgtd()), __(' Similar Posts', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-regular','post-similar-portfolio', __('SIMILAR WORKS', ffgtd()), __(' Similar Works', ffgtd())); $tos->nextLine();
			
		$tos->startOption(__('Search', ffgtd()), '');
			$tos->addParameter('text-regular','search-description-upper', __('Search', ffgtd()), __(' Search upper description', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-regular','search-description-lower', __('Results', ffgtd()), __(' Search lower description', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-regular','search-nothingfound', __('Nothing Found', ffgtd()), __(' Nothing Found', ffgtd())); $tos->nextLine();
			//$tos->addParameter('text-regular','post-comment-count-more', '% comments', ' %(=number of comments) comments'); $tos->nextLine();
				
			
			
			//$tos->addParameter('text-regular','post-read-more', 'Read More', ' Read More'); $tos->nextLine();
			//$tos->addParameter('text-regular','post-posted-by', 'Written by', ' Written by'); $tos->nextLine();
			//
			//$tos->addParameter('text-regular','post-tags', 'tagged by', ' Tagged By'); $tos->nextLine();
			//$tos->addParameter('text-regular','post-date', 'M j', ' Post Date Format'); $tos->nextLine();
			
		$tos->startOption(__('Comments', ffgtd()), '');
			
			
			$tos->addParameter('text-regular','comment-enter-discussion', __('Leave a Reply', ffgtd()), __(' Comment Form Title', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-regular','comment-name', __('Name', ffgtd()), ' Author Name'); $tos->nextLine();
			$tos->addParameter('text-regular','comment-email', __('Email', ffgtd()), ' Author Email'); $tos->nextLine();
			$tos->addParameter('text-regular','comment-website', __('Website', ffgtd()), ' Author Website'); $tos->nextLine();
			$tos->addParameter('text-regular','comment-content', __('Comment...', ffgtd()), ' Form Content (textarea)'); $tos->nextLine();
			$tos->addParameter('text-regular','comment-notify', __('Notify me of followup comments via e-mail', ffgtd()), ' New Comment Notification'); $tos->nextLine();
			$tos->addParameter('text-regular','comment-submit', __('Submit Comment', ffgtd()), ' Submit Comment Button'); $tos->nextLine();
			$tos->addParameter('text-regular','comment-reply', __('Reply', ffgtd()), ' Reply Button'); $tos->nextLine();
			$tos->addParameter('text-regular','comment-log-in', __('Logged in as ', ffgtd()), ' Appears when someone logged in wordpress check the comment form'); $tos->nextLine();
			$tos->addParameter('text-regular','comment-log-out', __('Log out &raquo; ', ffgtd()), ' Appears when someone logged in wordpress check the comment form'); $tos->nextLine();
			$tos->addParameter('text-regular','comment-cancel', __('Click here to cancel reply', ffgtd()), ' Cancel Comment Reply link'); $tos->nextLine();
			$tos->addParameter('text-regular','comment-approval', __(' Comment is awaiting for approval', ffgtd()), ' Comment awaiting for approval text'); $tos->nextLine();
			$tos->addParameter('text-regular','comment-log-in-to-reply', __(' Log in to reply', ffgtd()), __(' Log in to reply', ffgtd())); $tos->nextLine();
			
			
			$tos->addParameter('text-regular','comment-time-format', 'F j, Y, \a\t g:i A', __(' Time format of comments', ffgtd())); $tos->nextLine();
			
			$tos->addParameter('text-regular','comment-login-before', __('You must be ', ffgtd()), __(' You must be', ffgtd())); 
			$tos->addParameter('text-regular','comment-login-middle', __('Logged In ', ffgtd()), __(' Logged In', ffgtd()));
			$tos->addParameter('text-regular','comment-login-after', __('to post a comment', ffgtd()), __(' to post a comment', ffgtd())); 
					
		$tos->startOption('Search 404 Page', '');
			$tos->addParameter('text-regular','search-heading', __('Not Found', ffgtd()), __(' Search Not Found Title', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-area','search-content', __('Sorry, but you are looking for something that isn\'t here. Try searching again', ffgtd()), __(' Search Not Found Message', ffgtd())); $tos->nextLine();
			
		$tos->startOption('Widgets', '');
			$tos->addParameter('text-regular','widget-search', __('Search', ffgtd()), __(' Search Widget Button', ffgtd())); $tos->nextLine();	
			
			
			$pagesWp = get_pages();
			$pages = array();
			foreach( $pagesWp as $onePage ) {
				$newPage = array();
				$newPage['name'] = $onePage->post_title;
				$newPage['value'] = $onePage->ID;
				$pages[] = $newPage;
			}
			
		$tos->startOption('404 Page', '');
			$tos->addParameter('text-regular','page-404-description-upper', __('404 Nothing found', ffgtd()), __(' Upper description', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-regular','page-404-description-lower', __('Lower Description', ffgtd()), __(' Lower Description', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-area','page-404-content', 'Page Content', ' Page Content'); $tos->nextLine();
				
			
		$tos->startOption('Pagination', '');
			$tos->addParameter('text-regular','pagination-next', __('next', ffgtd()), __(' Next button', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-regular','pagination-prev', __('previous', ffgtd()), __(' Previous button', ffgtd())); $tos->nextLine();
			$tos->addParameter('text-regular','pagination-dots', '...', __(' 3 Dots', ffgtd())); $tos->nextLine();	
				
		$tos->startOption('Sortable Panel', '');
			$tos->addParameter('text-regular','sortable-all', __('All', ffgtd()), __(' After clicking this button, it will show all tags', ffgtd())); $tos->nextLine();
			
			
		$tos->startNamespace('disqus', 'disqus','Disqus');
			$tos->startOption('Disqus', '');
				$tos->addParameter('check','show-comments', 0, __(' Show Disqus comments instead of WordPress comments', ffgtd())); $tos->nextLine();
				$tos->addParameter('text-regular','username', '', __(' Disqus Shortname', ffgtd())); $tos->nextLine();			
				$tos->addParameter('text-regular','javascript-off', __('Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.', ffgtd()), ' Message appears when disabled javascript');

				
		$tos->startNamespace('lightbox', 'lightbox','Lightbox');
				$tos->startOption('Disqus', '');
				$tos->addParameter('check','disable-global', 0, __(' Disable lightbox across whole theme', ffgtd())); $tos->nextLine();
				$tos->addParameter('check','disable-portfolio', 0, __(' Disable lightbox only at portfolio', ffgtd())); $tos->nextLine();
				$tos->addParameter('check','disable-featured-works', 0, __(' Disable lightbox only at Featured Works', ffgtd())); $tos->nextLine();				
				
				
	$tos->startNamespace('social', 'social',__('Social', ffgtd()));
		$tos->startOption(__('Post Sharing', ffgtd()), '');
		//
		// facebook linkedin twitter pinterest digg yahoomail reddit stumbleupon delicious email
			$tos->addParameter('check','post-facebook-show', 1, __('Show Facebook with tooltip ', ffgtd()));
			$tos->addParameter('text-regular','post-facebook-tooltip', __('Share it on Facebook', ffgtd()), ''); 
			$tos->nextLine();
			
			$tos->addParameter('check','post-linkedin-show', 1, __('Show Linked In with tooltip ', ffgtd())); 
			$tos->addParameter('text-regular','post-linkedin-tooltip', __('Connect on LinkedIn', ffgtd()), ''); 
			$tos->nextLine();
			
			$tos->addParameter('check','post-twitter-show', 1, __('Show Twitter with tooltip ', ffgtd())); 
			$tos->addParameter('text-regular','post-twitter-tooltip', __('Share it on Twitter', ffgtd()), ''); 
			$tos->nextLine();
			
			$tos->addParameter('check','post-pinterest-show', 1, __('Show Pinterest with tooltip ', ffgtd())); 
			$tos->addParameter('text-regular','post-pinterest-tooltip', __('Pin it on Pinterest', ffgtd()), ''); 
			$tos->nextLine();			
			
			$tos->addParameter('check','post-digg-show', 1, __('Show Digg It with tooltip ', ffgtd())); 
			$tos->addParameter('text-regular','post-digg-tooltip', __('Digg it', ffgtd()), ''); 
			$tos->nextLine();
			
			$tos->addParameter('check','post-yahoomail-show', 1, __('Show Yahoo with tooltip ', ffgtd())); 
			$tos->addParameter('text-regular','post-yahoomail-tooltip', __('Mail it with Yahoo', ffgtd()), ''); 
			$tos->nextLine();
			
			$tos->addParameter('check','post-reddit-show', 1, __('Show Reddit with tooltip ', ffgtd())); 
			$tos->addParameter('text-regular','post-reddit-tooltip', __('Share it on Reddit', ffgtd()), ''); 
			$tos->nextLine();
			
			$tos->addParameter('check','post-stumbleupon-show', 1, __('Show Stumbleupon with tooltip ', ffgtd())); 
			$tos->addParameter('text-regular','post-stumbleupon-tooltip', __('Share it on Stumbleupon', ffgtd()), ''); 
			$tos->nextLine();
			
			$tos->addParameter('check','post-delicious-show', 1, __('Show Delicious with tooltip ', ffgtd())); 
			$tos->addParameter('text-regular','post-delicious-tooltip', __('Share it on Delicious', ffgtd()), ''); 
			$tos->nextLine();
			
			$tos->addParameter('check','post-email-show', 1, __('Show Email with tooltip ', ffgtd())); 
			$tos->addParameter('text-regular','post-email-tooltip', __('Share via Email', ffgtd()), ''); 
			$tos->nextLine();
			
		$tos->startOption('Add This service ',' Allows users to click on the social buttons and share your posts');
			$tos->addParameter('text', 'custom-addthis', '', __('Pub Id', ffgtd())); $tos->nextLine();
			$tos->addParameter('check', 'custom-addthis-addressbar', 0, __(' Track Address Bar', ffgtd()));			
			
		$tos->startOption('Post Liking', '');
			$tos->addParameter('check','post-like-facebook-show', 1, __('Show Facebook Like It button ', ffgtd()));$tos->nextLine();
			$tos->addParameter('check','post-like-google-show', 1, __('Show Google+ Like It button ', ffgtd()));
			
			$themeColorSkins = array(
						array('name'=> __('Blue', ffgtd()), 'value'=> 'blue'),
						array('name'=> __('Brown', ffgtd()), 'value'=> 'Brown'),
						array('name'=> __('Dark Red', ffgtd()), 'value'=> 'darkred'),
						array('name'=> __('Green', ffgtd()), 'value'=> 'green'),
						array('name'=> __('Grey', ffgtd()), 'value'=> 'grey'),
						array('name'=> __('Orange', ffgtd()), 'value'=> 'orange'),
						array('name'=> __('Red', ffgtd()), 'value'=> 'red'),
						array('name'=> __('Strong Blue', ffgtd()), 'value'=> 'strongblue'),
						array('name'=> __('Strong Green', ffgtd()), 'value'=> 'stronggreen'),
						array('name'=> __('Turquoise', ffgtd()), 'value'=> 'turquoise'),
						
					  );
			
			
			$themeLayoutSkins = array(
					array('name'=> __('Fullwidth', ffgtd()), 'value'=> 'fullwidth'),
					array('name'=> __('Boxed', ffgtd()), 'value'=> 'boxed'),
			);
			
			$themeBackgroundType = array(
					array('name'=> __('Image', ffgtd()), 'value'=> 'image'),
					array('name'=> __('Pattern', ffgtd()), 'value'=> 'pattern'),
					array('name'=> __('Color', ffgtd()), 'value'=> 'color'),
			);
							
	$tos->startNamespace('skins', 'skins',__('Skins', ffgtd()));			
		$tos->startOption(__('Skins & Colors', ffgtd()), '');			
			$tos->addParameterNL('select', 'theme-color-skin', 'orange', __(' Theme Skin', ffgtd()), $themeColorSkins );	
			$tos->addParameterNL('select', 'theme-layout-skin', 'orange', __(' Theme Layout', ffgtd()), $themeLayoutSkins );
			
		$tos->startOption(__('Background Image / Color', ffgtd()), '');
			$tos->addParameter('text-img','theme-background-image', '', __(' Theme Background Image', ffgtd())); $tos->nextLine();
			$tos->addParameter('color','theme-background-color', '', __(' Theme Background Color', ffgtd())); $tos->nextLine();
			$tos->addParameterNL('select', 'theme-background-type', 'image', __(' Theme Background Type', ffgtd()), $themeBackgroundType ); $tos->nextLine();
			$tos->addParameterNL('check', 'theme-background-blur', 1, __(' Enable blur', ffgtd()) ); $tos->nextLine();

	$tos->startNamespace('fontfamily', 'fontfamily', 'Fonts');
		$tos->startOption(__('Fonts settings', ffgtd()), '');
			$tos->addParameter('check','use-defined-fonts', 0, __('Define own fonts by Googe Fonts (do not use theme default fonts.)', ffgtd()));
		$tos->startOption(__('Menu Font', ffgtd()), '');
			$tos->addParameter('font','menu', '', ''); $tos->nextLine();
		$tos->startOption(__('Page Title Font', ffgtd()), '');
			$tos->addParameter('font','pagetitle', '', ''); $tos->nextLine();
		$tos->startOption(__('Headings Font', ffgtd()), '');
			$tos->addParameter('font','headings', '', ''); $tos->nextLine();
		$tos->startOption(__('Text Font', ffgtd()), '');
			$tos->addParameter('font','text', '', ''); $tos->nextLine();
		$tos->startOption(__('Buttons Font', ffgtd()), '');
			$tos->addParameter('font','button', '', ''); $tos->nextLine();
		$tos->startOption(__('Shortcode [dropcap] Font', ffgtd()), '');
			$tos->addParameter('font','dropcap', '', ''); $tos->nextLine();
		$tos->startOption(__('FAQ Font', ffgtd()), '');
			$tos->addParameter('font','faq', '', ''); $tos->nextLine();
		$tos->startOption(__('Pricing / Price Font', ffgtd()), '');
			$tos->addParameter('font','pricing', '', ''); $tos->nextLine();
		$tos->startOption(__('Blog Previous & Next Link Font', ffgtd()), '');
			$tos->addParameter('font','blogpreviousnext', '', ''); $tos->nextLine();
		$tos->startOption(__('Side Menu Font', ffgtd()), '');
			$tos->addParameter('font','sidemenu', '', ''); $tos->nextLine();

			
	$tos->startNamespace('customcode', 'customcode',__('Custom Code', ffgtd()));
			
		$tos->startOption(__('Custom CSS', ffgtd()), '');				
			$tos->addParameter('text-area','custom-css', '', '');$tos->nextLine();
			
		$tos->startOption(__('Custom JavaScript', ffgtd()), '');				
			$tos->addParameter('text-area','custom-javascript', '', '');$tos->nextLine();
			
		$tos->startOption(__('Custom Tracking/Analytics', ffgtd()), '');				
			$tos->addParameter('text-area','custom-tracking', '', '');$tos->nextLine();									

  // THERE IS A LOT OF CUSTOM stuff

	$tos->startNamespace('install', 'install',__('Installation', ffgtd()));

		$tos->startOption(__('Basic Installation', ffgtd()), '');

    	$tos->addParameter('info','x1', '', '
          <style type="text/css">
              .not_ready{ background: url(./images/marker.png) no-repeat left center; color: #AAA; }
              .ready{ background: url(./images/yes.png) no-repeat left center; }
              p.not_ready, p.ready{ padding: 0 0 0 30px; margin: 0 0 12px 0;}
              #foptions-install-basic-install { margin: 0 0 8px 0;}
          </style>');

      $plugin_is_active = array(
          'Revolution Slider and default sliders' =>
                                      1*is_plugin_active('revslider/revslider.php'),
          'Contact Form 7' =>         1*is_plugin_active('contact-form-7/wp-contact-form-7.php'),
          'MailChimp' =>              1*is_plugin_active('mailchimp/mailchimp.php'),
          'Really Simple CAPTCHA' =>  1*is_plugin_active('really-simple-captcha/really-simple-captcha.php'),
      );

      $all_plugins_active = 1;
      foreach ($plugin_is_active as $name=>$active) {
        	$all_plugins_active = $all_plugins_active * $active;
      }

      if( 'aborted' == fOpt::Get('basicinstall', 'plugins' ) ){
          if($all_plugins_active){
              fOpt::Set('basicinstall', 'plugins', 'finished' );
          }
      }

      if( 'finished' == fOpt::Get('basicinstall', 'plugins' ) ){
          if( ! $all_plugins_active){
              fOpt::Set('basicinstall', 'plugins', 'aborted' );
          }
      }

      if( 'aborted' == fOpt::Get('basicinstall', 'plugins' ) ){
          $tos->addParameter('button','basic-install', './admin.php?page=foptions&run_basic_install=1&install_action=1', 'Run the basic installation'); $tos->nextLine();
      }else{
          $tos->addParameter('button','basic-install', './admin.php?page=foptions&run_basic_install=1&install_action=1', 'Re-install the Basic Installation'); $tos->nextLine();
      }

    	$tos->addParameter('info','x2', '', '<p class="'.( $all_plugins_active?'ready':'not_ready' ).'">All plugins installed</p>');

      foreach ($plugin_is_active as $name=>$active) {
        	$tos->addParameter('info','x'.MD5($name), '', '<p class="'.( $active?'ready':'not_ready' ).'">Plugin '.$name.'</p>');
      }

    	$tos->addParameter('info','x3', '', '<p class="ready">Template settings</p>');
    	$tos->addParameter('info','x4', '', '<p class="ready">Default template builder items - "default", "about us"</p>');

      if( $all_plugins_active ){
      		$tos->startOption(__('Full Demo Installation', ffgtd()),'');
    			$tos->addParameter('info','demo-install', 'x', '<iframe src="'.get_template_directory_uri().'/install/to/themeInstall.php" style="height:790px;width:100%"></iframe>'); $tos->nextLine();

      }

	return $tos;
}

?>