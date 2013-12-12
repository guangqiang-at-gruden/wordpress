<?php
fEnv::registerComponent( 'Slider', 'componentSlider');
class componentSlider extends  componentBasic {
    protected $options = array(

        'modulename' => array(  'id' =>'html_name',
            'description' => 'Slider',
            'type' => 'html_name'),

        'title' => array(  'id' => 'title',
                'description' => 'Title',
                'type' => 'text',
                'default' => 'Slider'),

    	'arrows' => array(  'id' => 'arrows',
    			'description' => 'Show Arrows',
    			'type' => 'select',
    			'default' => 'true',
    			'select_values'=>array(array('name'=>'On', 'value'=>'true'), array('name'=>'Off','value'=>'false'))),
    		
   		'navigation' => array(  'id' => 'navigation',
   				'description' => 'Show Navigation',
    			'type' => 'select',
    			'default' => 'true',
   				'select_values'=>array(array('name'=>'On', 'value'=>'true'), array('name'=>'Off','value'=>'false'))),
    		

        'items' => array(  'id' => 'items',
                'description' => 'Images (separated by newline)',
                'type' => 'textarea-exact',
                'default' => "fwdefloc/images/about/slider/1.jpg \n fwdefloc/images/about/slider/2.jpg \n fwdefloc/images/about/slider/3.jpg" ,
        )

    );
	 
    public function printComponent( $options ) {
    	 	$items = $this->_createItems( $options );

        $data = array(
              'wrapperclass' => '',
              'title' => $options['title'],
              //'width' => $options['width'],
              //'height' => $options['height'],
              'data-arrows' => $options['arrows'],
              'data-thumbnail' => $options['navigation'],
              'items' => $items,
        );

        $instance = new ffComponentSlider();
        $instance->printComponent( $data );
    }

    private function _createItems( $options ) {
        $items = explode("\n",$options['items']);
        if(empty($items)){
            return array();
        }
        foreach ($items as $key=>$value) {
            $items[$key] = trim($value);
        }
        return $items;
    }
}


?>