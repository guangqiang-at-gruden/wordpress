<?php
fEnv::registerComponent( 'Person', 'componentPerson');
class componentPerson extends  componentBasic {
    protected $options = array(

        'modulename' => array(  'id' =>'html_name',
            'description' => 'Person',
            'type' => 'html_name'),

        'title' => array(  'id' => 'title',
            'description' => 'Title',
            'type' => 'text',
            'default' => 'Person'),

        'person' => array(  'id' => 'person',
                'description' => 'Person',
                'type' => 'text',
                'default' => 'John Doe'),
        'position' => array(  'id' => 'position',
                'description' => 'Position',
                'type' => 'text',
                'default' => 'Executive director'),
        'image' => array(  'id' => 'image',
                'description' => 'Image',
                'type' => 'image',
                'default' => 'fwdefloc/images/about/team/2.jpg'),
        'description' => array(  'id' => 'description',
                'description' => 'Description',
                'type' => 'textarea',
                'default' => 'Lorem ipsum dolor sit amet, consect adipiscing elit.'),
        'socialdata' => array(  'id' => 'socialdata',
                'description' => 'Social links',
                'type' => 'textarea-exact',
                'default' => '# each link on new line:
                              https://twitter.com/_freshface'),

    );
	 
    public function printComponent( $options ) {
        $data = array(
              'wrapperclass' => '',
              'title' => $options['title'],
              'person' => $options['person'],
              'position' => $options['position'],
              'image' => $options['image'],
              'description' => $options['description'],
              'socialdata' => $options['socialdata'],
        );

        $instance = new ffComponentPerson();
        $instance->printComponent( $data );
    }
}
?>