<?php
fEnv::registerComponent( 'Button', 'componentButton');
class componentButton extends  componentBasic {
    protected $options = array(
        'modulename' => array(  'id' =>'html_name',
            'description' => 'Button',
            'type' => 'html_name'),

        'title' => array(  'id' => 'title',
            'description' => 'Button Title',
            'type' => 'text',
            'default' => 'Title'),

        'link' => array(  'id' => 'link',
            'description' => 'Linking To (URL)',
            'type' => 'text',
            'default' => 'http://www.google.com'),

        'size' => array(  'id' => 'size',
            'description' => 'Button Size',
            'type' => 'select',
            'value' => 'normal',
            'select_values'=> array(
                array('name' => 'Small',  'value' => 'small'),
                array('name' => 'Normal', 'value' => 'normal'),
                array('name' => 'Large',  'value' => 'large')
            ),
        ),

        'color' => array(  'id' => 'color',
            'description' => 'Color',
            'type' => 'select',
            'value' => 'light',
            'select_values'=> array(
                array('name' => 'Light',   'value' => 'light'),
                array('name' => 'Dark',    'value' => 'dark'),
                array('name' => 'Regular', 'value' => 'regular'),
            ),
        ),

        'border' => array(  'id' => 'border',
            'description' => 'Border',
            'type' => 'select',
            'value' => 'false',
            'select_values'=> array(
                array('name' => 'No',  'value' => 'false'),
                array('name' => 'Yes', 'value' => 'true'),
            ),
        ),
    		
    		'float' => array(  'id' => 'float',
    				'description' => 'Float',
    				'type' => 'select',
    				'value' => 'none',
    				'select_values'=> array(
    						array('name' => 'None',   'value' => 'none'),
    						array('name' => 'Left',    'value' => 'left'),
    						array('name' => 'Right', 'value' => 'right'),
    				),
    		),
    		
    		'reverted' => array(  'id' => 'reverted',
    				'description' => 'Highlighted',
    				'type' => 'checkbox',
    				'value' => 0,
    				
    		),    		


     );
	 
    public function printComponent( $options ) {
        echo '<a class="button ';

        echo ' ';
        echo (empty($options['size'])) ? 'normal' : $options['size'];

        echo ' ';
        echo (empty($options['color'])) ? 'light' : $options['color'];
		
        echo ' ';
        if( $options['reverted'] == 1 ) echo 'reverted';
        
        echo ' ';
        if( $options['float'] == 'left' )
        	echo 'floatleft';
        else if( $options['float'] == 'right' )
        	echo 'floatright';
        
        
		
        
        
        if( (empty($options['border'])) || ( 'true' == $options['border'] ) ){
            echo ' bordered';
        }

        echo '" href="';
        echo $options['link'];
        echo '">';
        echo $options['title'];
        echo '</a>';
	 }
}
?>