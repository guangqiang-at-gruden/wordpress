<?php
/**
 *  ffTwitterFeeder
 *
 *  @author freshface
 */

class ffTwitterFeeder {

    const TWITTER_ACTUALIZATION_MINUTES_COUNT = 10;
    const TWITTER_CACHE_MAX_MINUTES_COUNT     = 60;
    const TWITTER_NAMESPACE_PREFIX            = 'cmp_twt_';

    private $_twitterName;
    private $_tweetsCount;

    private $_userHash;
    private $_nameSpace;

    private $_last_actualization;
    private $_last_check;
    
    private $_auth = array();

    function __construct( $twitterName = '_freshface', $tweetsCount = 5, $consumerKey, $consumerSecret, $accessToken, $accessTokenSecret ){
        $this->_twitterName = $twitterName;
        $this->_tweetsCount = $tweetsCount;
        $this->_userHash    = base64_encode( $twitterName );
        $this->_nameSpace   = self::TWITTER_NAMESPACE_PREFIX . $this->_userHash;
        
        $this->_last_actualization = fOpt::Get( $this->_nameSpace, 'last_actualization' );
        $this->_last_check         = fOpt::Get( $this->_nameSpace, 'last_check' );
        
        $this->setAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
    }
	
    public function setAuth( $consumerKey, $consumerSecret, $accessToken, $accessTokenSecret ) {
    	$this->_auth['consumerKey'] = $consumerKey;
    	$this->_auth['consumerSecret'] = $consumerSecret;
    	$this->_auth['accessToken'] = $accessToken;
    	$this->_auth['accessTokenSecret'] = $accessTokenSecret;
    	
    	
    	
    }
    
    public function getTwitterFeed() {
        // Can we read time of last cached tweet?
        if( null == $this->_last_actualization ){
            return $this->actualizeTwitterFeed();
        }

        // 60 = TWITTER_CACHE_MAX_MINUTES_COUNT
        // Is last cached tweet older than 60 minutes?
        if( $this->_last_actualization + ( 60 * self::TWITTER_CACHE_MAX_MINUTES_COUNT ) < time() ) {

            // Can we read time of last time-checking twitter?
            if( null == $this->_last_check ){
                return $this->actualizeTwitterFeed();
            }

            // 10 = TWITTER_ACTUALIZATION_MINUTES_COUNT
            // Did we check twitter more than 10 minutes ago?
            if( $this->_last_check + ( 60 * self::TWITTER_ACTUALIZATION_MINUTES_COUNT ) < time() ) {
                return $this->actualizeTwitterFeed();
            }

        }

        // Is not possible to load cached tweets?
        if( null == ( $twitter_feed = $this->_forceLoadCachedTwitterFeed() ) ) {
            return $this->actualizeTwitterFeed();
        }

        return $twitter_feed;
    }
    
    private function _forceLoadCachedTwitterFeed(){
        $twitter_feed = fOpt::Get( $this->_nameSpace, 'rss_feed');
        
        if( null == $twitter_feed ){
            return null;
        }else{
            return unserialize($twitter_feed);
        }
        
    }

    private function _getConnectionWithAccessToken() {
    
    		$connection = new TwitterOAuth($this->_auth['consumerKey'], $this->_auth['consumerSecret'], $this->_auth['accessToken'], $this->_auth['accessTokenSecret']);
    		return $connection;
    }
    
    public function actualizeTwitterFeed() {
    	// We save this open-twitter-page attempt
    	fOpt::Set($this->_nameSpace, 'last_check', time());
    	 
    	$connection = $this->_getConnectionWithAccessToken();
    	$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=$this->_twitterName&count=$this->_tweetsCount");
    	
    	if( is_object( $tweets ) && isset( $tweets->errors ) ) {
    		fOpt::Delete( $this->_nameSpace ,'rss_feed');
    		fOpt::Delete( $this->_nameSpace ,'last_actualization');
    		return array();
    	}
    	
    	
    	$twitter_parsed_data = serialize($tweets);
    	
    	fOpt::Set($this->_nameSpace, 'rss_feed', $twitter_parsed_data);
    	fOpt::Set($this->_nameSpace, 'last_actualization', time());
    	
    	return $tweets;
    }
}
