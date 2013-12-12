<?php

class fCustomPanelChanger {
	/**
	 * fCustomPanelChanger
	 */
	private static $_instance = null;

	private $_changedVars = array();

	public function __construct() {

	}

	/**
	 *
	 * @return fCustomPanelChanger
	 */
	public static function getInstance() {
		if( self::$_instance == null ) {
			self::$_instance = new fCustomPanelChanger();
		}

		return self::$_instance;
 	}

 	public function setVar( $namespace, $name, $value ) {
 		$this->_changedVars[ $namespace ][ $name ] = $value;
 	}

 	public function hookOption( $namespace, $name ) {
 		if( $this->_checkChangedVar( $namespace , $name) == false )
 			return null;
 		else
 			return $this->_changedVars[ $namespace ] [$name ];
 	}



 	private function _checkChangedVar( $namespace, $name ) {
 		if ( isset( $this->_changedVars[ $namespace] [ $name ]) ) {
 			return true;
 		} else {
 			return false;
 		}

 	}

 	private function _addChangedVar( $namespace, $name ) {
 		$this->_changedVars[ $namespace ][ $name ] = true;
 	}
}