<?php
fEnv::registerComponent( 'Text', 'componentText');
class componentText extends  componentBasic {
	protected $options = array(
	
		'modulename' => array(  'id' =>'html_name',
				'description' => 'Text',
				'type' => 'html_name'),
		
        'title' => array(  'id' => 'title',
                'description' => 'Title',
                'type' => 'text',
                'default' => 'Text'),
                
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

        'text' => array(  'id' => 'text',
                'description' => 'Your username text',
                'type' => 'textarea',
                'default' => '<p>Lorem ipsum dolor sit amet metus. Etiam urna. Sed eu ante. Maecenas ligula eget odio nonummy sodales nibh malesuada id, adipiscing felis mollis eros quis venenatis tristique, mauris tincidunt mattis feugiat dui, non nisl ac turpis egestas. Integer id odio consequat ligula at ipsum. Nunc semper, nisl pellentesque erat volutpat.</p>'),		
                
     );
	 
	 public function printComponent( $options ) {
	 	echo empty($options);
		echo '<div class="pagebuilder-component-text">';
		if( $options['title'] != '') echo '<'.$options['heading_type'].'>' . $options['title'] . '</'.$options['heading_type'].'>';
		echo $options['text'] ;
		echo '</div>';
	 	
	 }
}
?>