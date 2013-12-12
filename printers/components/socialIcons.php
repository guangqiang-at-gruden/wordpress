<?php
fEnv::registerComponent( 'Social Icons', 'componentSocialIcons');
class componentSocialIcons extends  componentBasic {
    protected $options = array(

        'modulename' => array(  'id' =>'html_name',
            'description' => 'Social icons',
            'type' => 'html_name'),

        

        'color' => array(  'id' => 'color',
            'description' => 'Color',
            'type' => 'select',
            'value' => '1',
            'default' => '1',
            'select_values'=> array(
                array('name' => 'Gray', 'value' => ''),
                array('name' => 'Light',  'value' => '1'),
            ),
        ),

        'tooltip' => array(  'id' => 'tooltip',
            'description' => 'Tooltip',
            'type' => 'select',
            'value' => '',
            'default' => '',
            'select_values'=> array(
                array('name' => 'Off',  'value' => ''),
                array('name' => 'On', 'value' => '1'),
            ),
        ),

        'socialdata' => array(  'id' => 'socialdata',
                'description' => 'Social Items links (each item on new line)',
                'type' => 'textarea-exact',
                'default' => ''),

    );
	 
    public function printComponent( $options ) {
        $data = array(
              'wrapperclass' => '',
          //    'title' => $options['title'],
              'color' => $options['color'],
              'tooltip' => $options['tooltip'],
              'socialdata' => $options['socialdata'],
        );

        $instance = new ffComponentSocialIcons();
        $instance->printComponent( $data );
    }
}
?>