<?php
class ffSimilarPosts {
	private static $_instance = null;
	private $_posts = null;
	private $_ignorePostId = null;
	
	public function __construct() {
		global $post;
		if( isset( $post ) ) {
			$this->_ignorePostId = $post->ID;
		}
	}
	
	public function ignoreCurrentPost( $ignore = true ) {
		if( $ignore == false ) {
			$this->_ignorePostId = null;
		}
	}
	
	public function hasSimilarPosts() {
		$this->_loadSimilarPosts();
		return !empty($this->_posts);
	}
	
	public function getSimilarPosts() {
		return $this->_posts;
	}
	
	public function renderStrippedContent() {
		$content = get_the_content();
		$contentWithoutHtml = strip_tags( $content );
		$contentSubstr = substr($contentWithoutHtml, 0, 85);
		echo $contentSubstr . '...';
		//var_dump( $content );
		//die();
	}
	
	private function _loadSimilarPosts() {
		$actualCatId = $this->_getActualCategory();
		
		$posts = $this->_getPosts( $actualCatId );
		$this->_posts = $posts;
		
	}
	
	private function _getPosts( $catID ) {
		$args = array('category'=>$catID,'numberposts'=>-1, 'post_type'=>array('post', 'portfolio'), 'orderby' => 'post_date',);
		
		if( $this->_ignorePostId != null ) {
			//var_dump( $args );
			//echo 'ddd';
			//$args = array_merge( $args, array('post__not_in'=> $this->_ignorePostId ) );
			$args['post__not_in']=array($this->_ignorePostId);
		}
		
		//die();
		$posts = get_posts( $args );
		//var_dump( $posts );
		
		return $posts;
	}
	
	private function _getActualCategory() {
		return fEnv::getActualCat();
	}
	
	public static function getInstance() {
		if( self::$_instance == null ) {
			self::$_instance = new ffSimilarPosts();
		}
		return self::$_instance;
	}
}