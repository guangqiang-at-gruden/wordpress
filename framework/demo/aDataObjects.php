<?php
class fLiveDataHolder {
	public static $skins = null;
	public static $headerSkins = null;
	public static $sliders = null;
	public static $tb = null;
	public static $blog = null;
	public static $portfolio = null;
	public static $single = null;
	public static $page = null;

	public static function init() {
		self::$skins = array(
				array('name'=>'Washed Turqoise','value'=>'washed_turquoise'),
				array('name'=>'Washed Blue','value'=>'washed_blue'),
				array('name'=>'Washed Coffee','value'=>'washed_coffee'),
				array('name'=>'Blue','value'=>'blue'),
				array('name'=>'Purple','value'=>'purple'),
				array('name'=>'Green','value'=>'green'),
				array('name'=>'Gold','value'=>'gold'),
				array('name'=>'Orange','value'=>'orange'),
				array('name'=>'Grey','value'=>'grey'),
				array('name'=>'Burgundy','value'=>'burgundy'),
				array('name'=>'Dark Green','value'=>'dark_green'));
		self::$headerSkins = array( array('name'=>'Black','value'=>'black'),
				array('name'=>'Dark Grey','value'=>'dark_grey'),
				array('name'=>'Light Grey','value'=>'light_grey'),
				array('name'=>'White','value'=>'white'));

		self::$sliders = array(
				array('name'=>'Tabbed', 'value'=>'tabbed_demo'),
				array('name'=>'Accordeon', 'value'=>'accordeon_demo'),
				array('name'=>'Cubes', 'value'=>'cubes_demo'),
				array('name'=>'3D', 'value'=>'3d_demo') );

		self::$tb = array( array('name'=>'Templ 1', 'value'=>'http://demo.freshface.net/file/ed/wp/category/uncategorized/'),
				array('name'=>'Templ ', 'value'=>'http://demo.freshface.net/file/ed/wp/'),);

		self::$blog = array(
				array('name'=>'Blog', 'value'=>'http://demo.freshface.net/file/ed/wp/category/blog'),
				array('name'=>'Blog 1', 'value'=>'http://demo.freshface.net/file/ed/wp/category/blog/blog-1'),
				array('name'=>'Blog 2', 'value'=>'http://demo.freshface.net/file/ed/wp/category/blog/blog-2'),
				array('name'=>'Blog 3', 'value'=>'http://demo.freshface.net/file/ed/wp/category/blog/blog-3'),
				array('name'=>'Blog 4', 'value'=>'http://demo.freshface.net/file/ed/wp/category/blog/blog-4'),
				array('name'=>'Blog 5', 'value'=>'http://demo.freshface.net/file/ed/wp/category/blog/blog-5'),
				array('name'=>'Blog 6', 'value'=>'http://demo.freshface.net/file/ed/wp/category/blog/blog-6'),
				array('name'=>'Blog 7', 'value'=>'http://demo.freshface.net/file/ed/wp/category/blog/blog-7'),
				array('name'=>'Blog 8', 'value'=>'http://demo.freshface.net/file/ed/wp/category/blog/blog-8'),
				array('name'=>'Blog 9', 'value'=>'http://demo.freshface.net/file/ed/wp/category/blog/blog-9'),
				array('name'=>'Blog 10', 'value'=>'http://demo.freshface.net/file/ed/wp/category/blog/blog-10'),
				);

		self::$portfolio = array( array('name'=>'Portfolio', 'value'=>'http://demo.freshface.net/file/ed/wp/category/portfolio'),
				array('name'=>'Sortable', 'value'=>'http://demo.freshface.net/file/ed/wp/category/portfolio/sortable'),
				array('name'=>'Portfolio 1', 'value'=>'http://demo.freshface.net/file/ed/wp/category/portfolio/portfolio-1'),
				array('name'=>'Portfolio 2', 'value'=>'http://demo.freshface.net/file/ed/wp/category/portfolio/portfolio-2'),
				array('name'=>'Portfolio 3', 'value'=>'http://demo.freshface.net/file/ed/wp/category/portfolio/portfolio-3'),
				array('name'=>'Portfolio 4', 'value'=>'http://demo.freshface.net/file/ed/wp/category/portfolio/portfolio-4'),
				array('name'=>'Portfolio 5', 'value'=>'http://demo.freshface.net/file/ed/wp/category/portfolio/portfolio-5'),
				array('name'=>'Portfolio 6', 'value'=>'http://demo.freshface.net/file/ed/wp/category/portfolio/portfolio-6'),
				array('name'=>'Portfolio 7', 'value'=>'http://demo.freshface.net/file/ed/wp/category/portfolio/portfolio-7'),
				array('name'=>'Portfolio 8', 'value'=>'http://demo.freshface.net/file/ed/wp/category/portfolio/portfolio-8'),
				array('name'=>'Portfolio 9', 'value'=>'http://demo.freshface.net/file/ed/wp/category/portfolio/portfolio-9'),
				);
		self::$single =  array(
				array('name'=>'Single', 'value'=>4),
				array('name'=>'Single 1', 'value'=>4),
				array('name'=>'Single 2', 'value'=>80),
				array('name'=>'Single 3', 'value'=>42),
				array('name'=>'Single 4', 'value'=>86),
				array('name'=>'Single 5', 'value'=>83),
				array('name'=>'Single 6', 'value'=>76),
				array('name'=>'Single 7', 'value'=>35),
				array('name'=>'Single 8', 'value'=>30),
				array('name'=>'Single 9', 'value'=>67),


				);

		self::$page = array( array('name'=>'Templ 1', 'value'=>'http://demo.freshface.net/file/ed/wp/category/uncategorized/'),
				array('name'=>'Templ ', 'value'=>'http://demo.freshface.net/file/ed/wp/'),);


		foreach( self::$single as $key=> $val ) {
			$val['value'] = get_permalink( $val['value'] );
			self::$single[ $key ] = $val;
		}

	}


}
fLiveDataHolder::init();

class fCustomPanelManager {
	/**
	 *
	 * @var fCustomPanelManager
	 */
	private static $_instance = null;

	/**
	 * @return fCustomPanelManager
	 */

	public $themeSkin = null;
	public $headerSkin = null;
	public $slider = null;
	public $blogTemplate = null;
	public $portfolioTemplate = null;
	public $singleTemplate = null;
	public $url = null;

	private function _searchForId($id, $array) {
		foreach ($array as $key => $val) {

			if ( $val['value'] == $id) {
				return $key;
			}
		}
		return null;
	}

	private function _searchForIdSignle($id, $array) {
		foreach ($array as $key => $val) {

 			if ( $val['value'] == $id) {
				return $key;
			}
		}
		return null;
	}

	public static function getInstance() {
		if( self::$_instance == null ) {
			self::$_instance = new fCustomPanelManager();
		}
		return self::$_instance;
	}


	public function __construct() {
		$this->_fillOptions();
	}

	private function _fillOptions() {
		$this->url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$this->_fillSkin();
		$this->_fillHeaderSkin();
		$this->_fillSlider();
		$this->_fillBlogTemplate();
		$this->_fillPortfolioTemplate();
		$this->_fillSingleTemplatE();
	}

	private function _fillBlogTemplate() {
		$blogArr = fLiveDataHolder::$blog;
		$searched = ($this->_searchForId($this->url, $blogArr));

		if( $searched !== null ) {

			$this->blogTemplate = $blogArr[ $searched ]['value'];
		}
	}

	private function _fillSingleTemplatE() {
		$singleArr = fLiveDataHolder::$single;
		$searched = ($this->_searchForId( $this->url, $singleArr));

		if( $searched !== null ) {
			$this->singleTemplate = $singleArr[ $searched ]['value'];
		}

	}

	private function _fillPortfolioTemplate() {
		$portArr = fLiveDataHolder::$portfolio;
		$searched = ($this->_searchForId( $this->url, $portArr));

		if( $searched !== null ) {
			$this->portfolioTemplate = $portArr[ $searched ]['value'];
		}
	}

	private function _fillHeaderSkin() {
		if( isset( $_COOKIE['livepanel_header_skin'] ) ) {
			// skins theme-header-skin
			$headerSkin = $_COOKIE['livepanel_header_skin'];
			fCustomPanelChanger::getInstance()->setVar( 'skins', 'theme-header-skin', $headerSkin);
			$this->headerSkin = $headerSkin;
		}
	}

	private function _fillSkin() {
		// skins  theme-color-skin
		if( isset( $_COOKIE['livepanel_theme_skin'] ) ) {
			$themeSkin = $_COOKIE['livepanel_theme_skin'];
			fCustomPanelChanger::getInstance()->setVar( 'skins','theme-color-skin', $themeSkin);
			$this->themeSkin = $themeSkin;
		}
	}

	private function _fillSlider() {
		if( isset( $_COOKIE['livepanel_slider'] ) ) {

			$slider = $_COOKIE['livepanel_slider'];
			fCustomPanelChanger::getInstance()->setVar( 'homepage', 'homepage-slider', $slider);

			$this->slider = $slider;
		}
	}


	public function getSkinType() {

	}
}


class blSessionStore {
/*----------------------------------------------------------------------------*/
/* CONSTANTS
/*----------------------------------------------------------------------------*/
	const DEF_DEFAULT_NAMESPACE = 'blDefaultNS';

/*----------------------------------------------------------------------------*/
/* VARIABLES
/*----------------------------------------------------------------------------*/
	/**
	 *
	 * @var blSessionStore
	 */
	private static $_instance = null;
	private $_actualNamespace = null;
	private $_defaultNamespace = null;

/*----------------------------------------------------------------------------*/
/* PUBLIC FUNCTIONS
/*----------------------------------------------------------------------------*/
	public function __construct() {
		$this->_setDefaultNamespace( self::DEF_DEFAULT_NAMESPACE );
		session_start();
	}

	/**
	 * @return blSessionStore
	 */
	public static function getInstance( $namespace = null ) {
		if( self::$_instance == null ) {
			self::$_instance = new blSessionStore();
		}
		if( $namespace != null ) {
			self::$_instance->setNamespace( $namespace );
		}
		return self::$_instance;
	}

	public function setNamespace( $namespace ) {
		$this->_setActualNamesapce( $namespace );
	}

	public function setValue( $name, $value ) {
		$_SESSION[ $this->_getActualNamespace() ] [ $name ] = $value;
	}

	public function getValue( $name ) {
		if( isset( $_SESSION[ $this->_getActualNamespace() ] [ $name ] ) )
			return $_SESSION[ $this->_getActualNamespace() ] [ $name ];
		else
			return null;
	}
/*----------------------------------------------------------------------------*/
/* SETTERS AND GETTERS
/*----------------------------------------------------------------------------*/
	private function _setDefaultNamespace( $defaultNamespace ) {
		$this->_defaultNamespace = $defaultNamespace;
	}

	private function _getDefaultNamespace() {
		return $this->_defaultNamespace;
	}


	private function _setActualNamesapce( $actualNamespace ) {
		$this->_actualNamespace = $actualNamespace;
	}

	private function _getActualNamespace() {
		if( $this->_actualNamespace == null ) {
			$this->_actualNamespace = $this->_getDefaultNamespace();
		}
		return $this->_actualNamespace;
	}

}