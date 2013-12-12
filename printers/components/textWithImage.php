<?php
fEnv::registerComponent( 'Text with Image', 'componentTextWithImage');
class componentTextWithImage extends  componentBasic {
    protected $options = array(

        'modulename' => array(  'id' =>'html_name',
            'description' => 'TextWithImage',
            'type' => 'html_name'),

        'title' => array(  'id' => 'title',
            'description' => 'Title',
            'type' => 'text',
            'default' => 'Title of text with image'),

        'image' => array(  'id' => 'image',
            'description' => 'Image',
            'type' => 'image',
            'default' => 'fwdefloc/images/services/tabs/1.jpg'),

        'description' => array(  'id' => 'description',
            'description' => 'Description',
            'type' => 'textarea',
            'default' => '<p>Lorem ipsum dolor sit amet, consect adipiscing elit.</p>'),

        'buttonlink' => array(  'id' => 'buttonlink',
            'description' => 'Button Link',
            'type' => 'text',
            'default' => '#'),

        'buttontext' => array(  'id' => 'buttontext',
            'description' => 'Button text',
            'type' => 'text',
            'default' => 'SEE THAT IMAGE'),

    );
	 
    public function printComponent( $options ) {
        $data = array(
              	'wrapperclass' => '',
              	'title' => $options['title'],
              	'image' => $options['image'],
              	'description' => $options['description'],
              	'buttonlink' => $options['buttonlink'],
              	'buttontext' => $options['buttontext'],
        );

        $instance = new ffComponentTextWithImage();
        $instance->printComponent( $data );
    }
}
?>