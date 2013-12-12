<?php
fEnv::registerComponent( 'Pricing Table Column', 'componentPricing');
class componentPricing extends  componentBasic {
    protected $options = array(

        'modulename' => array(  'id' =>'html_name',
            'description' => 'Pricing',
            'type' => 'html_name'),

        'title' => array(  'id' => 'title',
            'description' => 'Title',
            'type' => 'text',
            'default' => 'Great offer'),

        'price' => array(  'id' => 'price',
            'description' => 'Price',
            'type' => 'text',
            'default' => '$ 24.99 monthly'),

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



        'text' => array(  'id' => 'text',
                'description' => 'Text (separated by newline)',
                'type' => 'textarea-exact',
                'default' => 'Way too many members
                              Much space and cosmic space
                              Foldable time machine
                              Real life undo button
                              Telepathic support
                              T-shirt and toaster'),

        'buttontext' => array(  'id' => 'buttontext',
            'description' => 'Button text',
            'type' => 'text',
            'default' => 'SIGN UP NOW'),

        'buttonlink' => array(  'id' => 'buttonlink',
            'description' => 'Button link',
            'type' => 'text',
            'default' => 'http://www.google.com/'),

    );
	 
    public function printComponent( $options ) {
    	 	$items = $this->_createItems( $options );

        $data = array(
              'wrapperclass' => '',
              'title' => $options['title'],
              'fullPricingTable' => 0,
              'highlighted' => $options['highlighted'],
              'price' => $options['price'],
              'buttontext' => $options['buttontext'],
              'buttonlink' => $options['buttonlink'],
              'items' => $items,
        );

        $instance = new ffComponentPricing();
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