<?php
fEnv::registerComponent( 'Twitter', 'componentTwitter');
class componentTwitter extends  componentBasic {
     protected $options = array(
     
     	'modulename' => array(  'id' =>'html_name',
     			'description' => 'Twitter',
     			'type' => 'html_name'),
     			
        'title' => array(  'id' => 'title',
                'description' => 'Title',
                'type' => 'text',
                'default' => 'Twitter'),
                

        'username' => array(  'id' => 'username',
                'description' => 'Your Twitter username',
                'type' => 'text',
                'default' => 'nytimes'),
     		
		'consumerkey' => array(  'id' => 'consumerkey',
     				'description' => 'Consumer Key',
     				'type' => 'text',
     				'default' => ''),
     		
		'consumersecret' => array(  'id' => 'consumersecret',
					'description' => 'Consumer Secret',
     				'type' => 'text',
     				'default' => ''),
     		
		'accesstoken' => array(  'id' => 'accesstoken',
     			'description' => 'Access Token',
     			'type' => 'text',
     			'default' => ''),
     		
		'accesstokensecret' => array(  'id' => 'accesstokensecret',
     			'description' => 'Access Token Secret',
     			'type' => 'text',
     			'default' => ''),     		
                

        'number' => array(  'id' => 'number',
                'description' => 'How many Tweets do you want to show?',
                'type' => 'text',
                'default' => 3),
                

        'caching' => array(  'id' => 'caching_interval',
                'description' => 'Actualizate every X minutes :',
                'type' => 'text',
                'default' => 60),
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
     
	private function timeToString($seconds){
		//echo $seconds;
		$sec_new = substr($seconds, 5);
		//echo $sec_new;
		$sec_new =  strtotime( $sec_new );
		return fEnv::time_elapsed_string( $sec_new );
		//echo date('Y-m-d', $sec_new);
	}	 
	 
	 public function printComponent( $options ) {
	 /*	$username_hash = base64_encode( $options['username'] );
		$namespace = 'cmp_twt_'.$username_hash;
		
		
		$twitter_feed = fOpt::Get( $namespace, 'rss_feed');
		if($twitter_feed != null) $twitter_feed = unserialize($twitter_feed);
		
		$cache_time = fOpt::Get( $namespace, 'last_actualization' );
		if( $cache_time == null || ( $cache_time + ( 60 * $options['caching_interval'] ) ) < time() || $twitter_feed == null ) {
			//https://api.twitter.com/1/statuses/user_timeline.rss?screen_name=wcjc993
			$html_file = fEnv::openUrl('https://api.twitter.com/1/statuses/user_timeline.rss?screen_name='.$options['username'].'');
			
			$domParser = new DOMDocument();
			@$domParser->loadHTML( $html_file );
			
			$twitter_parsed_data = array();
			
			$i = 0;
			foreach( $domParser->getElementsByTagName('description') as $one_item ) {
				if($i > $options['number']) break; 
				else if( $i == 0 ) {$i++; continue;}
				$twitter_parsed_data[$i]['description'] = $one_item->nodeValue;
				$i++;
			}
	
			$i = 0;
			foreach( $domParser->getElementsByTagName('pubdate') as $one_item ) {
				if($i > $options['number']) break;
				else if( $i == 0 ) {$i++; continue;}
				$twitter_parsed_data[$i]['date'] = $one_item->nodeValue;
				$i++;
			}		
			$twitter_feed = $twitter_parsed_data;
			$twitter_parsed_data = serialize($twitter_parsed_data);
			fOpt::Set($namespace, 'rss_feed', $twitter_parsed_data);
			fOpt::Set($namespace, 'last_actualization', time());
		} else {
		}*/
	 	if( $this->_checkAuth( $options ) ) {
	 		$twitterFeed = new ffTwitterFeeder( $options['username'], $options['number'], $options['consumerkey'], $options['consumersecret'], $options['accesstoken'], $options['accesstokensecret'] );
	 	}
	 	//var_dump( $this->_checkAuth( $options ) );
	 	//var_dump( $twitterFeed->getTwitterFeed() );
	 	//die();
	
		echo'
		<div class="tb_module">
			<div class="tb_twitter">';
			
			if( $options['title'] != '') echo '<h3 class="tb_module_name">' . $options['title'] . '</h3>';
			
				echo '<div class="twitter_content">';
				
				foreach($twitterFeed->getTwitterFeed()  as $key => $feed ) {
					$content = $feed->text;
					$content = str_replace( $options['username'].':', '', $content);
					$content = preg_replace('!((?:www|http://)[^ ]+)!', '<a href="\1">\1</a>', $content);
					echo '<div class="one_tweet">
						<div class="tweet_content">';
						
					echo $content;// $one_tweet['description'];
					echo '</div>
						
						<div class="tweet_time">';
					 echo human_time_diff( strtotime( $feed->created_at ) ) .' ago';
					echo '</div></div>';
					
				}
				
echo '
					<div class="twitter_follow">
						<a href="https://twitter.com/#!/'.$options['username'].'">Follow us on Twitter</a>
					</div>	
				</div>
			</div>
		</div>';
		
		
	 }
}
?>