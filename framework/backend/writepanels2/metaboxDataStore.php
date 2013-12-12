<?php

class oneMetaboxOption {
	public $type = null;
	public $id = null;
	public $title = null;
	public $description = null;
	public $std = null;
	public $values = null;
	public $currentValue = null;
	
	public function __construct( $type = null, $id = null, $title = null, $description = null, $std = null, $values = null ) {
		$this->type = $type;
		$this->id = $id;
		$this->title = $title;
		$this->description = $description;
		$this->std = $std;
		$this->values = $values;	
	}
}

class oneMetabox {
	public $title = null;
	public $postType = null;
	public $context = null;
	public $conditions = null;
	
	public $options = null;
	
	public function __construct( $title, $postType, $context, $conditions ) {
		$this->title = $title;
		$this->postType = $postType;
		$this->context = $context;
		$this->conditions = $conditions;
		
		$this->options = array();
	}
	
	public function addOption( $type, $id, $title, $description, $std, $values ) {
		$newOption = new oneMetaboxOption( $type, $id, $title, $description, $std, $values);
		$this->options[] = $newOption;
	}
}



class metaboxDataStore {
	const METADATA_PREFIX = 'fw_';
	const METABOX_POST_TYPE_ALL = 'all';
	const METABOX_POST_TYPE_PORTFOLIO = 'portfolio';
	const METABOX_POST_TYPE_PAGE = 'page';
	const METABOX_POST_TYPE_POST = 'post';
	const METABOX_CONTEXT_SIDE = 'side';
	const METABOX_CONTEXT_ADVANCED = 'advanced';
	
	private $_allFields = array();
	
	
	
	/**
	 * @var metaboxDataStore
	 */
	private static $_instance = null;
	
	/**
	 * @var oneMetabox
	 */
	private $_currentMetabox = null;
	
	private $_metaboxData = array();
	
	public function getAllFields() {
		return $this->_allFields;
	}
	
	public function startMetabox( $metaboxTitle, $postType = metaboxDataStore::METABOX_POST_TYPE_ALL, $context = 'advanced', $conditions = null ) {
		$this->_currentMetabox = new oneMetabox( $metaboxTitle, $postType, $context, $conditions);
	}

	public function addOption( $type, $id, $title, $description, $std, $values = null ) {
		$this->_currentMetabox->addOption($type, $id, $title, $description, $std, $values);
		
		$newField = new stdClass();
		$newField->id = $id;
		$newField->type = $type;
		
		$this->_allFields[] = $newField;
	}
	public function endMetabox() {
		$newMetabox = clone $this->_currentMetabox;
		$this->_metaboxData[ $newMetabox->postType ][] = $newMetabox;
		$this->_currentMetabox = null;

	}
	
	public function getMetaboxData() {
		return $this->_metaboxData;
	}
	
	/**
	 * @return metaboxDataStore
	 */
	public static function getInstance() {
		if( self::$_instance == null ) {
			self::$_instance = new metaboxDataStore();
		}
		return self::$_instance;
	}
}