<?php
fEnv::registerComponent( 'List And Bullets', 'componentListAndBullets');
class componentListAndBullets extends  componentBasic {
    protected $options = array(

        'modulename' => array(  'id' =>'html_name',
            'description' => 'List And Bullets',
            'type' => 'html_name'),

        'title' => array(  'id' => 'title',
            'description' => 'Title',
            'type' => 'text',
            'default' => 'List And Bullets'),

        'type' => array(  'id' => 'type',
            'description' => 'List type',
            'type' => 'select',
            'value' => 'check',
            'default' => 'check',
            'select_values'=> array(
                array('name' => 'Check',  'value' => 'check'),
                array('name' => 'Bullet', 'value' => 'bullet'),
                array('name' => 'Ordered',  'value' => 'ordered')
            ),
        ),

        'items' => array(  'id' => 'items',
                'description' => 'List Items (each item on new line)',
                'type' => 'textarea-exact',
                'default' => ''),

    );
	 
    public function printComponent( $options ) {
        $data = array(
              'wrapperclass' => '',
              'title' => $options['title'],
              'type' => $options['type'],
              'items' => $options['items'],
        );

        $instance = new ffComponentListAndBullets();
        $instance->printComponent( $data );
    }
}
?>