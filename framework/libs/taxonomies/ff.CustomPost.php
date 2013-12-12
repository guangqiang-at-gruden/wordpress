<?php
/**
 * 
 * @author twotick
 *USAGE
 *
$portfolio = new ffCustomPost('Portfolio');
$portfolio->getArgs()
				->isPublic(true)
				->publiclyQueryable(true)
				->showUI(true)
				->showInMenu(true)
				->queryVar(true)
				->capabilityType('post')
				->taxonomyAdd('category')
				->labels()
					->name('Portfolio')
					->singularName('Portfolio')
					->addNew('Add New')
					->addNewItem('Add New Portfolio')
					->editItem('Edit Portfolio')
					->newItem('New Portfolio')
					->allItems('All Portfolio')
					->viewItems('View Portfolio')
					->searchItems('Search Portfolio')
					->notFound('No Portfolio found')
					->notFoundInThrash('No Portfolio found in Trash')
					->parent_item_colon('')
					->menuName('Portfolio');

$portfolio->getArgs()->supports()
						->author()
						->comments()
						->customFields()
						->editor()
						->excerpt()
						->pageAttributes()
						->revisions()
						->thumbnail()
						->title()
						->trckbacks();

 */


class ffCustomPostLabels {
	private $_name = null; //=> 'Books',
	private $_singular_name = null; //=> 'Book',
	private $_add_new = null; //=> 'Add New',
	private $_add_new_item = null; //=> 'Add New Book',
	private $_edit_item = null; //=> 'Edit Book',
	private $_new_item = null; //=> 'New Book',
	private $_all_items = null; //=> 'All Books',
	private $_view_item = null; //=> 'View Book = null;,
	private $_search_items = null; //=> 'Search Books',
	private $_not_found = null; //=>  'No books found',
	private $_not_found_in_trash = null; //=> 'No books found in Trash',
	private $_parent_item_colon = null; //=> '',
	private $_menu_name = null; //=> 'Books'
	
	public function name( $name ) { $this->_name = $name; return $this; }
	public function singularName( $singularName ) { $this->_name = $singularName; return $this; }
	public function addNew( $addNew ) { $this->_add_new = $addNew; return $this; }
	public function addNewItem( $addNewItem ) {$this->_add_new_item = $addNewItem; return $this; }
	public function editItem( $editItem ) { $this->_edit_item = $editItem; return $this; }
	public function newItem( $newItem ) { $this->_new_item = $newItem; return $this; }
	public function allItems( $allItems ) { $this->_all_items = $allItems; return $this; }
	public function viewItems( $viewItem ) { $this->_view_item = $viewItem; return $this; }
	public function searchItems( $searchItems ) { $this->_search_items = $searchItems; return $this; }
	public function notFound( $notFound ) { $this->_not_found = $notFound; return $this; }
	public function notFoundInThrash( $notFoundInThrash ) { $this->_not_found_in_trash = $notFoundInThrash; return $this; }
	public function parent_item_colon( $parentItemColon ) { $this->_parent_item_colon = $parentItemColon; return $this; }
	public function menuName( $menuName ) { $this->_menu_name = $menuName; return $this; }
	
	private function _adjustKey( $key ) {
		return substr($key, 1 );
	}
	public function getArray() {
		$arguments = array();
		foreach( $this as $key => $value ) {
			$keyNew =  $this->_adjustKey($key);
			
			$arguments[ $keyNew ] = $value;
		}
		return $arguments;
	}
}

class ffCustomPostSupports {
	private $_title = false;
	private $_author = false;
	private $_thumbnail = false;
	private $_editor = false;
	private $_excerpt = false;
	private $_trackbacks = false;
	private $_custom_fields = false;
	private $_comments = false;
	private $_revisions = false;
	private $_page_attributes = false;
	private $_post_formats = false;
	
	
	public function title() { $this->_title = true; return $this; }
	public function author() { $this->_author = true; return $this; }
	public function thumbnail() { $this->_thumbnail = true; return $this; }
	public function excerpt() { $this->_excerpt = true; return $this; }
	public function trckbacks() { $this->_trackbacks = true; return $this; }
	public function customFields() { $this->_custom_fields = true; return $this; }
	public function comments() { $this->_comments = true; return $this; }
	public function revisions() { $this->_revisions = true; return $this; }
	public function pageAttributes() { $this->_page_attributes = true; return $this; }
	public function postFormats() { $this->_post_formats = true; return $this; }
	public function editor() { $this->_editor = true; return $this; }
	
	private function _adjustKey( $key ) {
		$keySub = substr($key, 1 );
		$keyReplaced = str_replace('_','-', $keySub);
		return $keySub;
	}
	
	public function getArray() {
		$supports = array();
		foreach( $this as $key => $value ) {
			$keyNew = $this->_adjustKey($key);
			if( $value ) {
				$supports[] = $keyNew;
			}
		}
		
		return $supports;
	}
}

class ffCustomPostArguments {
	/**
	 * @var ffCustomPostLabels
	 */
	private $_labels = null;
	
	/**
	 * @var ffCustomPostSupports
	 */
	private $_supports = null;
	
	private $_label = null;
	private $_public = null;
	private $_publicly_queryable = null;
	private $_show_ui = null;
	private $_show_in_menu = null;
	private $_query_var = null;
	private $_rewrite = null;
	private $_capability_type = null;
	private $_has_archive = null;
	private $_hierarchical = null;
	private $_menu_position = null;
	private $_taxonomies = array();
	
	
	public function __construct() {
		$this->_labels = new ffCustomPostLabels();
		$this->_supports = new ffCustomPostSupports();
	}
	
	public function label( $label ) { $this->_label = $label; return $this; }
	public function labels() { return $this->_labels; }
	public function isPublic( $public ) { $this->_public = $public; return $this; }
	public function publiclyQueryable( $publiclyQueryable ) { $this->_publicly_queriable = $publiclyQueryable; return $this; }
	public function showUI( $showUI ) { $this->_show_ui = $showUI; return $this; }
	public function showInMenu( $showInMenu ) { $this->_show_in_menu = $showInMenu; return $this; }
	public function queryVar( $queryVar ) { $this->_query_var = $queryVar; return $this; }
	public function rewrite( $rewrite ) { $this->_rewrite = $rewrite; return $this; }
	public function capabilityType( $capabilityType ) { $this->_capability_type = $capabilityType; return $this; }
	public function hasArchive( $hasArchive ) { $this->_has_archive = $hasArchive; return $this; }
	public function hierarchical( $hierarchical ) { $this->_hierarchical = $hierarchical; return $this; }
	public function menuPosition( $menuPosition ) { $this->_menu_position = $menuPosition; return $this; }
	public function supports() { return $this->_supports; }
	public function taxonomyAdd( $taxonomyName ) { $this->_taxonomies[] = $taxonomyName; return $this; }

	private function _adjustKey( $key ) {
		return substr( $key, 1 );
	} 
	
	public function getArray() {
		$arguments  = array();
		foreach( $this as $key => $value ) { 
			$keyNew = $this->_adjustKey( $key );
			if( $key == '_labels' || $key == '_supports' ) {
				$arguments[ $keyNew ] =  $value->getArray();
			} else {
				$arguments[ $keyNew ] = $value;
			}
		}
		return $arguments;
	}
}

class ffCustomPost {
	
	/**
	 * @var ffCustomPostArguments
	 */
	private $_args = null;
	private $_label = null;
	
	public function __construct( $label ) {
		$this->_args = new ffCustomPostArguments();
		$this->_label = $label;
		$this->_args->label($label);
		add_action('init', array($this, 'register' ) );
	}
	
	/** 
	 * @return ffCustomPostArguments
	 */
	public function getArgs() {
		return $this->_args;
	}
	
	public function register() {
		register_post_type( $this->_label, $this->_args->getArray() );
	}
	
}