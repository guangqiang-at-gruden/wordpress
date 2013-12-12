<?php
/**
 *  ffComponent
 *
 *  @author freshface
 */

class ffComponent {

    private $data;
    
    function __construct( $data = null ){
        $this->data = $data;
    }

    public function getComponent( $data = null ){
        return "* UNDEFINED FUNCTION getComponent in COMPONENT ".get_class($this)." *" ;
    }
    
    public function printComponent( $data = null ){
        if( empty($data) ){
            if( empty($this->data) ){
                echo "* NO DATA DEFINED IN FUNCTION printComponent in COMPONENT ".get_class($this)." *" ;
            }else{
                echo $this->getComponent($this->data);
            }
        }else{
            echo $this->getComponent($data);
        }
    }
    
    public function getWidgetClass() {
    	return 'widget';
    }
}
