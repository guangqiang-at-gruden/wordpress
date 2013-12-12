<?php

class ffOneBreadcrumb {
	public function __construct( $title, $url, $selected = false ) {
		$this->title = $title;
		$this->url = $url;
		$this->selected = $selected;
	}
	public $title = null;
	public $url = null;
	public $selected = false;
}

class ffBreadcrumbs {
	/**
	 * @var ffBreadcrumbs
	 */
	private static $_instance = null;
	
	
	/**
	 * @return array[ffOneBreadcrumb]
	 */
	public function getBreadcrumbs() {
		if( is_category() ) {
			$breadcrumbs = $this->_getCategoryBreadcrumbs();
		} else if ( is_page() ) {
			$breadcrumbs = $this->_getPageBreadcrumbs();
		} else if ( is_singular() ) {
			$breadcrumbs = $this->_getCategoryBreadcrumbs();
		} 
		
		return $breadcrumbs;
	}
	
	private function _getPageBreadcrumbs() {
		global $post;
		$breadcrumbs = array();
		$breadcrumbs[] = $this->_getHomeBreadcrumb();
		$pageAndParents = $this->_getPageParents($post->ID );
		$breadcrumbs = array_merge( $breadcrumbs, $pageAndParents );
		return $breadcrumbs;
	}
	
	private function _getPageParents( $pageId, $selectedPageId = null, $arrayOfParents = null ) {
		$selectedPage = false;
		if( $selectedPageId == null )  {
			$selectedPageId = $pageId;
			$selectedPage = true;
		}
		
		$currentPage = get_page( $pageId );
		if ( is_wp_error( $currentPage ) )
			return $pageId;
		
		if( $arrayOfParents === null ) {
			$arrayOfParents = array();
		}

		$arrayOfParents[] = $this->_createOneBreadcrumb( $currentPage->post_title, get_permalink( $currentPage->ID ), $selectedPage );
		
		if( $currentPage->post_parent != '0' ) {
			$arrayOfParents = $this->_getPageParents( $currentPage->post_parent, $selectedPageId, $arrayOfParents );
		} else {
			$arrayOfParents = array_reverse( $arrayOfParents );
		}
		return $arrayOfParents;
	}
	
	private function _getCategoryBreadcrumbs() {
		$breadcrumbs = array();
		
		$breadcrumbs[] = $this->_getHomeBreadcrumb();
		$catAndParents =  $this->_getCategoryParents( $this->_getActualCategory() );
		$breadcrumbs = array_merge( $breadcrumbs, $catAndParents );
		
		return $breadcrumbs;
	}
	
	private function _getCategoryParents( $catId, $arrayOfParents = null ) {
		( $this->_getActualCategory() == $catId ) ? $selectedCat = true : $selectedCat = false;
		
		$currentCat = get_category( $catId );
		if ( is_wp_error( $currentCat ) )
        	return $catId;
		 
		if( $arrayOfParents === null ) {
			$arrayOfParents = array();
		}
		$arrayOfParents[] = $this->_createOneBreadcrumb( $currentCat->name, get_category_link($currentCat->cat_ID), $selectedCat );
		
		if( $currentCat->parent != '0' ) {
			$arrayOfParents = $this->_getCategoryParents( $currentCat->parent, $arrayOfParents );
		}  else {
			$arrayOfParents = array_reverse( $arrayOfParents );
		}
		return $arrayOfParents;
	}
	
	private function _getHomeBreadcrumb() {
		return $this->_createOneBreadcrumb( fOpt::Get('translation', 'breadcrumbs-home'), get_home_url() );
	}
	
	private function _createOneBreadcrumb( $title, $url, $selected = false ) {
		return new ffOneBreadcrumb($title, $url, $selected);
	}
	
	
	private function _getActualCategory() {
		return fEnv::getActualCat();
	}
	
	/**
	 * @return ffBreadcrumbs
	 */
	public static function getInstance() {
		
		if( self::$_instance == null ) {
			self::$_instance = new ffBreadcrumbs();
		}
		return self::$_instance;
	}
}