<?php
fEnv::registerComponent( 'Call To Action', 'componentCallToAction');
class componentCallToAction extends componentBasic {
    protected $options = array(

        'modulename' => array(  'id' =>'html_name',
            'description' => 'Call To Action',
            'type' => 'html_name'),

        'title' => array(  'id' => 'title',
            'description' => 'Title',
            'type' => 'text',
            'default' => 'Wise Guys is flexible, friendly and intuitive, and it’s packed with goodies'),

        'description' => array(  'id' => 'description',
            'description' => 'Text Content',
            'type' => 'textarea',
            'default' => '<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas quis nisl quis mi pharetra euismod.</p>'),

        'buttonlink' => array(  'id' => 'buttonlink',
            'description' => 'Button Link',
            'type' => 'text',
            'default' => 'http://www.google.com/'),

        'buttontext' => array(  'id' => 'buttontext',
            'description' => 'Button Text',
            'type' => 'text',
            'default' => 'BUY IT NOW'),

        'buttonsize' => array(
            'id' => 'buttonsize',
            'description' => 'Button Size',
            'type' => 'select',
            'value' => 'large',
            'default' => 'large',
            'select_values'=> array(
                array('name'=>'Large',  'value'=>'large'),
                array('name'=>'Normal', 'value'=>'normal')
            ),
        ),
    		
    		'targetblank' => array(
    				'id' => 'targetblank',
    				'description' => 'Target Blank ?',
    				'type' => 'select',
    				'value' => 'false',
    				'default' => 'false',
    				'select_values'=> array(
    						array('name' => 'No',  'value' => 'false'),
    						array('name' => 'Yes', 'value' => 'true'),
    				),
			),

        'buttonborder' => array(
            'id' => 'buttonborder',
            'description' => 'Button Border',
            'type' => 'select',
            'value' => 'false',
            'default' => 'false',
            'select_values'=> array(
                array('name' => 'No',  'value' => 'false'),
                array('name' => 'Yes', 'value' => 'true'),
            ),
        ),

    );
	 
    public function printComponent( $options ) {
        $data = $options;
        $data['wrapperclass'] = '';

        $instance = new ffComponentCallToAction();
        $instance->printComponent( $data );

    }
}
?>