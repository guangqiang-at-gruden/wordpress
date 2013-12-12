<?php
fEnv::registerComponent( 'Accordeon', 'componentAccordeon');
class componentAccordeon extends  componentBasic {
    protected $options = array(

        'modulename' => array(  'id' =>'html_name',
                'description' => 'Accordeon',
                'type' => 'html_name'),

        'title' => array(  'id' => 'title',
                'description' => 'Component Title',
                'type' => 'text',
                'default' => 'Accordeon'),

        'title1' => array(  'id' => 'title1',
                'description' => 'Title 1',
                'type' => 'text',
                'default' => 'Powerful Request Management'),
        'text1' => array(  'id' => 'text1',
                'description' => 'Text Content',
                'type' => 'textarea',
                'default' => '<p>Lorem ipsum dolor sit amet metus. Etiam urna. Sed eu ante. Maecenas ligula eget odio nonummy sodales nibh malesuada id, adipiscing felis mollis eros quis venenatis tristique, mauris tincidunt mattis feugiat dui, non nisl ac turpis egestas. Integer id odio consequat ligula at ipsum. Nunc semper, nisl pellentesque erat volutpat.</p>'),

        'title2' => array(  'id' => 'title2',
                'description' => 'Title 2',
                'type' => 'text',
                'default' => 'Real Time Help Desk Reporting'),
        'text2' => array(  'id' => 'text2',
                'description' => 'Text Content',
                'type' => 'textarea',
                'default' => '<p>Lorem ipsum dolor sit amet metus. Etiam urna. Sed eu ante. Maecenas ligula eget odio nonummy sodales nibh malesuada id, adipiscing felis mollis eros quis venenatis tristique, mauris tincidunt mattis feugiat dui, non nisl ac turpis egestas. Integer id odio consequat ligula at ipsum. Nunc semper, nisl pellentesque erat volutpat.</p>'),

                
        'title3' => array(  'id' => 'title3',
                'description' => 'Title 3',
                'type' => 'text',
                'default' => 'Easily Order Online'),
        'text3' => array(  'id' => 'text3',
                'description' => 'Text Content',
                'type' => 'textarea',
                'default' => '<p>Lorem ipsum dolor sit amet metus. Etiam urna. Sed eu ante. Maecenas ligula eget odio nonummy sodales nibh malesuada id, adipiscing felis mollis eros quis venenatis tristique, mauris tincidunt mattis feugiat dui, non nisl ac turpis egestas. Integer id odio consequat ligula at ipsum. Nunc semper, nisl pellentesque erat volutpat.</p>'),

                
        'title4' => array(  'id' => 'title4',
                'description' => 'Title 4',
                'type' => 'text',
                'default' => ''),
        'text4' => array(  'id' => 'text4',
                'description' => 'Text Content',
                'type' => 'textarea',
                'default' => '<p></p>'),

                
        'title5' => array(  'id' => 'title5',
                'description' => 'Title 5',
                'type' => 'text',
                'default' => ''),
        'text5' => array(  'id' => 'text5',
                'description' => 'Text Content',
                'type' => 'textarea',
                'default' => '<p></p>'),

                
        'title6' => array(  'id' => 'title6',
                'description' => 'Title 6',
                'type' => 'text',
                'default' => ''),
        'text6' => array(  'id' => 'text6',
                'description' => 'Text Content',
                'type' => 'textarea',
                'default' => '<p></p>'),

     );
	 
	 public function printComponent( $options ) {
	 	$items = $this->_createItems( $options );
	 	
	 	
	 	$data = array(
	 			'wrapperclass' => '',
	 			'title' => $options['title'],
	 			'items' => $items,
	 			
	 	);
	 	
	 	$instance = new ffComponentAccordeon();
	 	$instance->printComponent( $data );
	 }
	 
	 private function _createItems( $options ) {
	 	$items = array();
	 	for( $i = 1; $i <= 6; $i++ ) {
	 		if( !empty($options['title'.$i] ) ) {
	 			$newItem = array();
	 			$newItem['title'] = $options['title'.$i];
	 			$newItem['description'] = $options['text'.$i];
	 			$items[] = $newItem;
	 		}
	 	}
	 	return $items;
	 }
}
?>