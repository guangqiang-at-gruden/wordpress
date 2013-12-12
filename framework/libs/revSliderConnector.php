<?php
class ffRevSliderConnector {
	const NO_REV_SLIDER = 'norevslider';
	private static $_instance = null;
	
	const TABLE_NAME = 'revslider_sliders';
	private $_tableName = '';
	public function __construct() {
		global $wpdb;
		$this->_tableName = $wpdb->prefix . self::TABLE_NAME;
	}
	
	public static function getInstance() {
		if( self::$_instance == null ) {
			self::$_instance = new ffRevSliderConnector();
		}
		return self::$_instance;
	}
	
	public function getRevSliderClass() {
		if( is_home() ) {
			$sliderName = fOpt::Get('homepage', 'homepage-slider');
			
		} else if ( is_page() && metaboxManager::getMeta('slider_show') == metaboxManager::CHECKED_FIELD ) {
			$sliderName = metaboxManager::getMeta('slider_type');
		}
		
		
		$sql = 'SELECT params FROM '.$this->_tableName.' WHERE alias="'.$sliderName.'"';
		$result = mysql_query( $sql );
		
		if( ($row = mysql_fetch_array($result)) ) {
			$params = json_decode( $row['params'] );
		} else {
			$params = new stdClass();
			$params->slider_type= 'nothing';
		}

		if( $params->slider_type == 'fullwidth' )
			return 'fullwidthslider';
		else
			return 'slider';
	}
	
	public function putSlider() {
		if( !function_exists('putRevSlider') ) {
			echo 'You need to install Revolution Slider plugin. Please click "Begin Installation" in Wordpress Admin Dashboard, in yellow notification';
			return;
		}
		if( is_home() ) { 
			$sliderName = fOpt::Get('homepage', 'homepage-slider');
			putRevSlider($sliderName);
		} else if ( is_page() && metaboxManager::getMeta('slider_show') == metaboxManager::CHECKED_FIELD ) {
			putRevSlider(metaboxManager::getMeta('slider_type'));
		}
	}
	
	public function getSliders() {
		$result = $this->_selectDifferentSliders();
		$pairs = $this->_getPairedArray($result);
		return $pairs;
	}
	private function _getPairedArray( $result ) {
		
		$toReturn = array();
		if( false == $result ) {
			$newSlider['name'] = 'INSTALL REVOLUTION SLIDER PLUGIN';
			$newSlider['value'] = ffRevSliderConnector::NO_REV_SLIDER;
			$toReturn[] = $newSlider;
		} else {
			while( $row = mysql_fetch_array( $result) ) {
				$newSlider = array();
				$newSlider['name'] = $row['title'];
				$newSlider['value'] = $row['alias'];
				$toReturn[] = $newSlider;
			}
		}
		
		return $toReturn;
	}
	private function _selectDifferentSliders() {
		$sql = 'SELECT title, alias FROM '.$this->_tableName;
		return mysql_query($sql);
	}
}