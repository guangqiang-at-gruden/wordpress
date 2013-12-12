<?php
class metaBoxManager {
	const EMPTY_FIELD = '_!!!fieldIsEmpty!!!_';
	const CHECKED_FIELD ='_!!!fieldChecked!!!_';
	const UNCHECKED_FIELD = '_!!!fieldUnchecked!!!_';
	/**
	 * @var metaBoxManagera
	 */
	private static $_instance = null;
	/**
	 * @var metaboxDataStore
	 */
	private $_dataStore = null;
	/**
	 * @var metaBoxPrinter
	 */
	private $_metaBoxPrinter = null;
	
	public function __construct() {
		$this->_addHooks();
		
	}
	/**
	 * @return metaBoxManagera
	 */
	public static function getInstance() {
		if( self::$_instance == null ) {
			self::$_instance = new metaBoxManager();
		}
		return self::$_instance;
	}
	public static function getMeta( $id, $default = null, $postId = null ) {
		if( $default == null )
			return self::getInstance()->getPostMeta( $id, $postId );
		else {
			$meta = self::getInstance()->getPostMeta( $id, $postId );
			if( empty( $meta ) )
				return $default;
			else
				return $meta;
		}
	}
	
	public static function setMeta( $id, $value, $postId = null ) {
		return self::getInstance()->setPostMeta( $id, $value, $postID );
	}
	
	public static function getMetaAdmin( $id, $postId = null ) {
		return self::getInstance()->_getPostMeta( $id, $postId );
	}
	
	public function getPostMeta( $id, $postId = null ) {
		$metaData = $this->_getPostMeta($id, $postId );
		
		if( $metaData == metaBoxManager::EMPTY_FIELD ) $metaData = '';
		return $metaData; 
	}
	
	private function _getPostMeta( $id , $postId = null ) {
		if( $postId == null ) {
			global $post;
			$postId = $post->ID;
		}
		 
		return get_post_meta( $postId, $id, true ); 	
	}
	
	public function setPostMeta( $id, $value, $postId = null  ) {
		if( $postId == null ) {
			global $post;
			$postId = $post->ID;
		}
		
		if ( empty( $value ) ) {
			$value = metaBoxManager::EMPTY_FIELD;
		}
		
		update_post_meta( $postId, $id, $value );
	}
	
	public function registerMetaboxes() {
		if( get_post_type() == 'attachment' )return;
		wp_enqueue_script(time() + 555, get_template_directory_uri(). '/framework/backend/writepanels2/script.js');
		$currentPostType = get_post_type();
		
		$data = $this->_getDataStore()->getMetaboxData();
		
		if( isset( $data[ $currentPostType ] ) ) {
			foreach( $data[ $currentPostType ] as $oneMetaBox ) {
				
				
				if ( $oneMetaBox->postType == metaboxDataStore::METABOX_POST_TYPE_ALL ) $oneMetaBox->postType = $this->_getAllPostTypes();
				add_meta_box( 'fw_custom_metabox_'.time()+rand(), $oneMetaBox->title, array( $this, 'printMetabox'), $currentPostType, $oneMetaBox->context,'low', array('metaBox'=> $oneMetaBox));//, $context, $priority, $callback_args );
			}
		}
		
		if( isset( $data['all'] ) ) {
			foreach( $data['all'] as $oneMetaBox ) {
				if ( $oneMetaBox->postType == metaboxDataStore::METABOX_POST_TYPE_ALL ) $oneMetaBox->postType = $this->_getAllPostTypes();
				add_meta_box( 'fw_custom_metabox_'.time()+rand(), $oneMetaBox->title, array( $this, 'printMetabox'), $currentPostType, $oneMetaBox->context,'low', array('metaBox'=> $oneMetaBox));//, $context, $priority, $callback_args );
			}
		}
		
		
	}
	
	private function _getAllPostTypes() {
		return array_keys( get_post_types() );
	}
	
	
	public function printMetaBox( $postInfo, $args ) {
		$metaBox = $args['args']['metaBox'];
		if( !empty($metaBox->conditions['page_template'] ) ) {
			echo '<div class="page_template_specific" style="display:none;">';
			foreach( $metaBox->conditions['page_template'] as $ptName ) {
				echo '<span>'.$ptName.'</span>';
			} 
			echo '</div>';
		}
		$this->_getPrinter()->printMetaBox($metaBox);
	}
	
	/**
	 * @return metaboxDataStore
	 */
	private function _getDataStore() {
		if ( $this->_dataStore == null ) {
			$this->_dataStore = metaboxDataStore::getInstance();
		}
		return $this->_dataStore;
	}
	
	public function saveMetaboxes() {
		if( get_post_type() == false ) return;
		$allFields = $this->_getDataStore()->getAllFields();
		if( !empty($allFields) ) {
			foreach( $this->_getDataStore()->getAllFields() as $oneField ) {
				
				
				if( isset( $_POST[ $oneField->id ] ) && $oneField->type != 'check' ) {
					
					$this->setPostMeta( $oneField->id, $_POST[ $oneField->id ] );
				} else if ( $oneField->type == 'check' ) {
					if( isset( $_POST[ $oneField->id ] ) )
						$this->setPostMeta( $oneField->id, metaBoxManager::CHECKED_FIELD );
					else 
						$this->setPostMeta( $oneField->id, metaBoxManager::UNCHECKED_FIELD );
				}
			}
		}
	}
	
	public function addScripts() {
		wp_enqueue_style( 'writepanels_scripts', get_template_directory_uri().'/framework/backend/writepanels2/writepanels.css' );
	}
	
	private function _addHooks() {
		add_action( 'admin_init', array($this, 'addScripts' ) );
		add_action( 'add_meta_boxes', array( $this, 'registerMetaboxes') );
		add_action('save_post', array( $this, 'saveMetaboxes') );
	}
	
	private function _getPrinter() {
		if( $this->_metaBoxPrinter == null ) {
			$this->_metaBoxPrinter = new metaBoxPrinter();
		}
		
		return $this->_metaBoxPrinter;
	}
}


