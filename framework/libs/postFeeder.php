<?php
class ffPostFeeder {
    protected static $_instance = null;

    protected $_posts = null;
    protected $_ignorePostId = null;
    protected $_category = 0;
    protected $_numberpost = -1;
    
    public function __construct() {
        global $post;
        if( isset( $post ) && is_singular() ) {
            $this->_ignorePostId = $post->ID;
        }
    }

    public static function getInstance() {
        if( self::$_instance == null ) {
            self::$_instance = new ffPostFeeder();
        }
        return self::$_instance;
    }

    public function getCategoryPosts($category = 0, $numberpost = -1) {
        $this->setCategory( $category );
        $this->setNumberPost( $numberpost );
        return $this->getPosts();
    }
    
    public function setCategory($category = 0){
        if( empty( $category ) ){
            $actCat = fEnv::getActualCat();
            if( !empty( $actCat ) ){
                $category = $actCat;
            }
        }
        $this->_category = $category;
    }

    public function setNumberPost($numberpost){
        if( 0 >= 1 * $numberpost ){
            $numberpost = -1;
        }
        $this->_numberpost = $numberpost;
    }

    public function getPosts() {
        $this->_loadPosts();
        return $this->_posts;
    }
    
    protected function _loadPosts( ) {
        $args = array(
            'category'   => $this->_category,
            'numberposts' => $this->_numberpost,
            'post_type'  => array('post', 'portfolio'),
            'orderby'    => 'post_date',
        );

        if( !empty( $this->_ignorePostId ) ) {
            $args['post__not_in'] = array( $this->_ignorePostId );
        }

        $posts = get_posts( $args );
        
        $this->_posts = $posts;
    }

}