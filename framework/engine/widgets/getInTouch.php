<?php
/**
 *  ffGetInTouch
 *
 *  @author freshface
 */

// private register this widget for framework
fEnv::addWidget('ffGetInTouch');

class ffGetInTouch extends frameworkWidget {
	/**
	 *  Defining the widget options
	 */

     protected $_widgetAdminTitle =       "Get In Touch - Custom Widget";
     protected $_widgetAdminDescription = "Footer Widget with Contact Details";
     protected $_widgetWrapperClasses =   "";
     protected $_widgetFormSize =         frameworkWidget::WIDGET_FORM_SIZE_WIDE;

     protected $socialIconTypes = array( 'vimeo', 'facebook', 'linkedin', 'twitter', 'pinterest', 'flickr', );

     protected $options = array(
        array(  'id' => 'title',
                'description' => 'Title',
                'type' => 'text',
                'default' => 'GET IN TOUCH'),

        array(  'id' => 'address',
                'description' => 'Address',
                'type' => 'text',
                'default' => ''),

        array(  'id' => 'phone',
                'description' => 'Phone number',
                'type' => 'text',
                'default' => ''),
                
        array(  'id' => 'mail',
                'description' => 'Email',
                'type' => 'text',
                'default' => ''),

        array(  'id' => 'social',
                'description' => 'Social Links',
                'type' => 'textarea',
                'default' => '',
                /*'tooltip' => array(
                    //'img'  => '/images/footerLogo.png',
                    'text' => 'This widget support social media: vimeo, facebook, linkedin, twitter, pinterest, flickr, digg, yahoo, reddit, googleplus, stumbleupon, skype, deviantart',
                    //'url'  => 'http://www.wiseguys-themes.com/wiseguys/creative/blog-medium.html#.UM7-1-R2jMg',
                    ),
                */
                ),
     );

	/**
	 * Printing widget, called by wordpress
	 */
    protected function _widget($args, $instance) {

        extract( $args );

        echo $before_widget;

        if( !empty( $instance['title'] ) ) {
            $instance['title'] = apply_filters('widget_title', $instance['title'] );
        }

  			echo $before_title . $instance['title'] . $after_title;

        echo '<ul class="footerContacts">';
        echo '<li class="footerAddress">' . $instance['address'] . '</li>';
        echo '<li class="footerPhone">' . $instance['phone'] . '</li>';
        echo '<li class="footerMail"><a href="mailto:' . $instance['mail'] . '">' . $instance['mail'] . '</a></li>';
        echo '</ul>';
        
        $socialStuff = new ffSocialFeeder( $instance['social'] );
		if( !empty( $socialStuff->items ) ) {
        echo '<ul class="socialIcons">';
        foreach ($socialStuff->items as $socialItem) {
            echo '<li class="' . $socialItem->type . '"><a href="' . $socialItem->link . '">' . $socialItem->title . '</a></li>';
        }
        echo '</ul>';
		}
        echo $after_widget;
    }
}
