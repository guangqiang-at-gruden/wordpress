<?php
fEnv::registerComponent( 'Comparison Column', 'componentComparsionColumn');
class componentComparsionColumn extends  componentBasic {
    protected $options = array(

        'modulename' => array(  'id' =>'html_name',
            'description' => 'ComparsionColumn',
            'type' => 'html_name'),

        'title' => array(  'id' => 'title',
            'description' => 'Title',
            'type' => 'text',
            'default' => ''),

        'highlighted' => array(  'id' => 'highlighted',
                'description' => 'Highlight',
                'type' => 'select',
                'default' => 0,
                'value' => 0,
                'select_values'=> array(
                    array('name'=>'On', 'value'=>1),
                    array('name'=>'Off', 'value'=>0)
                ),
        ),

        'align' => array(  'id' => 'align',
                'description' => 'Align',
                'type' => 'select',
                'default' => 'Center',
                'value' => 'Center',
                'select_values'=> array(
                    array('name'=>'Left',   'value'=>'left'),
                    array('name'=>'Center', 'value'=>'center'),
                    array('name'=>'Right',  'value'=>'right'),
                ),
        ),

        'text' => array(  'id' => 'text',
                'description' => 'Text (separated by newline)',
                'type' => 'textarea-exact',
                'default' => ''),

    );
	 
    public function printComponent( $options ) {
    	 	$items = $this->_createItems( $options );

        $data = array(
              'wrapperclass' => '',
              'title' => $options['title'],
              'highlighted' => $options['highlighted'],
              'align' => $options['align'],
              'items' => $items,
        );

        $instance = new ffComponentComparsionColumn();
        $instance->printComponent( $data );
    }

	 private function _createItems( $options ) {
	 	$items = explode("\n",$options['text']);
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