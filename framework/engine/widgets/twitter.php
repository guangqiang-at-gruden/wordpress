<?php
/**
 *  twitter
 * 
 *  @author freshface
 */

// private register this widget for framework 
fEnv::addWidget('ffTwitter');

class ffTwitter extends frameworkWidget {
    /**
     *  Defining the widget options
     */

     protected $_widgetAdminTitle =       "Twitter - Custom Widget";
     protected $_widgetAdminDescription = "Display your latest Tweets";
     protected $_widgetWrapperClasses =   "";
     protected $_widgetFormSize =         frameworkWidget::WIDGET_FORM_SIZE_THIN;



     protected $options = array(
        array(  'id' => 'title',
                'description' => 'Title',
                'type' => 'text',
                'default' => 'LATEST TWEETS'),
                

        array(  'id' => 'username',
                'description' => 'Your twitter username',
                'type' => 'text',
                'default' => ''),
     		
     		array(  'id' => 'consumerkey',
     				'description' => 'Consumer Key',
     				'type' => 'text',
     				'default' => ''),

     		array(  'id' => 'consumersecret',
     				'description' => 'Consumer Secret',
     				'type' => 'text',
     				'default' => ''),

     		array(  'id' => 'accesstoken',
     				'description' => 'Access Token',
     				'type' => 'text',
     				'default' => ''),

     		array(  'id' => 'accesstokensecret',
     				'description' => 'Access Token Secret',
     				'type' => 'text',
     				'default' => ''),
                

        array(  'id' => 'number',
                'description' => 'Number of tweets to show',
                'type' => 'text',
                'default' => 5),

     );

     private function _checkAuth( $i ) {
     	$auth = true;
     	
     	if( !isset($i['consumerkey']) || empty($i['consumerkey']) )
     		$auth = false;
     	if( !isset($i['consumersecret']) || empty($i['consumersecret']) )
     		$auth = false;
     	if( !isset($i['accesstoken']) || empty($i['accesstoken']) )
     		$auth = false;
     	if( !isset($i['accesstokensecret']) || empty($i['accesstokensecret']) )
     		$auth = false;
     	
     	return $auth;
     	
     }
    /**
     * Printing widget, called by wordpress
     */
    function _widget($args, $instance) {

        extract( $args );

        echo $before_widget;

        if( !empty( $instance['title'] ) ) {
            $instance['title'] = apply_filters('widget_title', $instance['title'] );
        }

  			echo $before_title . $instance['title'] . $after_title;
		
    
		if( $this->_checkAuth( $instance ) ) {
			$twitterFeed = new ffTwitterFeeder( $instance['username'], $instance['number'], $instance['consumerkey'], $instance['consumersecret'], $instance['accesstoken'], $instance['accesstokensecret'] );
        echo '<div class="tweets">';
        echo '<ul class="tweet_list">';
        foreach ( $twitterFeed->getTwitterFeed() as $key=>$feed) {
            echo '<li>';
            echo '<span class="tweet_avatar" style="visibility: visible; background-position: 0px 3px;"></span>';

            echo '<span class="tweet_time">';
            echo '<a href="http://twitter.com/' . $feed->user->screen_name . '/status/' . $feed->id_str . '" title="view tweet on twitter">';
            echo human_time_diff( strtotime( $feed->created_at ) );
            echo ' ago</a>';
            echo '</span>';

            echo '<span class="tweet_join"></span>';

            echo '<span class="tweet_text">';
            echo preg_replace('!((?:www|http://|https://)[^ ]+)!', '<a href="\1">\1</a>', $feed->text);
            echo '</span>';

            echo '</li>';
        }
        echo '</ul>';
        echo '</div>'; 
		} else {
			echo '<span style="color:orange;"> Please insert your Twitter API key in "Appearance -> Widgets"</span>';
		}
       

        echo $after_widget;        
    }
    
    protected function doAdditionalUpdates( $new_instance ){
        $twitterFeed = new ffTwitterFeeder( $new_instance['username'], $new_instance['number'] );
        $twitterFeed->actualizeTwitterFeed();
    }
}
?>
