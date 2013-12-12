<?php
fEnv::registerComponent( 'Tabs', 'componentTabs');
class componentTabs extends  componentBasic {
    protected $options = array(

        'modulename' => array(  'id' =>'html_name',
            'description' => 'Tabs',
            'type' => 'html_name'),

        'title' => array(  'id' => 'title',
            'description' => 'Title',
            'type' => 'text',
            'default' => 'Tabs'),

    		'type' => array(  'id' => 'heading_type',
    				'description' => 'Heading Type',
    				'type' => 'select',
    				'value' => 'section-heading',
    				'select_values'=> array(
    						array('name'=>'H1', 'value'=>'h1'),
    						array('name'=>'H2', 'value'=>'h2'),
    						array('name'=>'H3', 'value'=>'h3'),
    						array('name'=>'H4', 'value'=>'h4')
    				),
    		),    		
    		
        'data-autoPlay' => array(  'id' => 'data-autoPlay',
                'description' => 'Autoplay',
                'type' => 'select',
                'value' => 'On',
                'select_values'=> array(
                    array('name'=>'On', 'value'=>'true'),
                    array('name'=>'Off', 'value'=>'false')
                )
        ),

        'data-autoDelay' => array(  'id' => 'data-autoDelay',
                'description' => 'Autodelay',
                'type' => 'text',
                'default' => '3000'),

        'title1' => array(  'id' => 'title1',
            'description' => 'Title 1',
            'type' => 'text',
            'default' => 'Order Online'),


        'text1' => array(  'id' => 'text1',
            'description' => 'Content of Tab 1',
            'type' => 'textarea',
            'default' => '<p>Lorem ipsum dolor sit amet metus. Etiam urna. Sed eu ante. Maecenas ligula eget odio nonummy sodales nibh malesuada id, adipiscing felis mollis eros quis venenatis tristique, mauris tincidunt mattis feugiat dui, non nisl ac turpis egestas. Integer id odio consequat ligula at ipsum. Nunc semper, nisl pellentesque erat volutpat.</p>'),


        'title2' => array(  'id' => 'title2',
            'description' => 'Title 2',
            'type' => 'text',
            'default' => 'Management'),


        'text2' => array(  'id' => 'text2',
            'description' => 'Content of Tab 2',
            'type' => 'textarea',
            'default' => '<p>Mauris tincidunt mattis feugiat dui, non nisl ac turpis egestas. Integer id odio consequat ligula at ipsum. Nunc semper, nisl pellentesque erat volutpat. Lorem ipsum dolor sit amet metus. Etiam urna. Sed eu ante. Maecenas ligula eget odio nonummy sodales nibh malesuada id, adipiscing felis mollis eros quis venenatis tristique.</p>'),


        'title3' => array(  'id' => 'title3',
            'description' => 'Title 3',
            'type' => 'text',
            'default' => 'Help Desk'),


        'text3' => array(  'id' => 'text3',
            'description' => 'Content of Tab 3',
            'type' => 'textarea',
            'default' => '<p>Nunc semper, nisl pellentesque erat volutpat. Lorem ipsum dolor sit amet metus. Etiam urna. Sed eu ante. Mauris tincidunt mattis feugiat dui, non nisl ac turpis egestas. Integer id odio consequat ligula at ipsum. Maecenas ligula eget odio nonummy sodales nibh malesuada id, adipiscing felis mollis eros quis venenatis tristique.</p>'),


        'title4' => array(  'id' => 'title4',
            'description' => 'Title 4',
            'type' => 'text',
            'default' => ''),


        'text4' => array(  'id' => 'text4',
            'description' => 'Content of Tab 4',
            'type' => 'textarea',
            'default' => ''),


        'title5' => array(  'id' => 'title5',
            'description' => 'Title 5',
            'type' => 'text',
            'default' => ''),


        'text5' => array(  'id' => 'text5',
            'description' => 'Content of Tab 5',
            'type' => 'textarea',
            'default' => ''),


    );
	 
    public function printComponent( $options ) {
        $items = $this->_getItems($options);
        $data = array(
              'wrapperclass' => '',
              'title' => $options['title'],
              'data-autoPlay' => $options['data-autoPlay'],
              'data-autoDelay' => $options['data-autoDelay'],
              'items' => $items,
        	  'title' => $options['title'],
        	  'heading_type' => $options['heading_type'],
        );

        $instance = new ffComponentTabs();
        $instance->printComponent( $data );
    }

    private function _getItems( $options ) {
        $items = array();
        for( $i = 1; $i <= 5; $i++ ) {
            if( !empty( $options['title'.$i] ) ) {
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