<?php
fEnv::registerComponent( 'Button with icon', 'componentButtonWithIcon');
class componentButtonWithIcon extends componentBasic {
    protected $options = array(
        'modulename' => array(  'id' =>'html_name',
            'description' => 'componentButtonWithCustomIcon',
            'type' => 'html_name'),

        'title' => array(  'id' => 'title',
            'description' => 'Button Title',
            'type' => 'text',
            'default' => 'Title'),

        'highlight' => array( 'id' => 'highlight',
            'description' => 'Button Highlight',
            'type' => 'select',
            'value' => '',
            'default' => '',
            'select_values'=> array(
                array( 'value' => '',          'name' => 'Off'    ),
                array( 'value' => 'highlight', 'name' => 'On' ),
            ),
        ),

        'icon' => array( 'id' => 'icon',
            'description' => 'Button Icon',
            'type' => 'select-icon',
            'icon-height' => '16',
            'icon-path' => '/images/icons/%%%value%%%.png',
            'value' => '--there is val ---',
            'default' => '',
            'select_values'=> array(
                array('value' => 'tags',        'name' => 'Tags'),
                array('value' => 'comment',     'name' => 'Comment'),
                array('value' => 'categories',  'name' => 'Categories'),
                array('value' => 'categories2', 'name' => 'Categories'),
                array('value' => 'contact',     'name' => 'Contact'),
                array('value' => 'author',      'name' => 'Author'),
                array('value' => 'search',      'name' => 'Search'),
                array('value' => 'photography', 'name' => 'Photography'),
                array('value' => 'video',       'name' => 'Video'),
                array('value' => 'video2',      'name' => 'Video2'),
                array('value' => 'music',       'name' => 'Music'),
                array('value' => 'sound',       'name' => 'Sound'),
                array('value' => 'ecommerce',   'name' => 'E-commerce'),
                array('value' => 'webdesign',   'name' => 'Web design'),
                array('value' => 'development', 'name' => 'Development'),
                array('value' => 'software',    'name' => 'Software'),
                array('value' => 'threed',      'name' => '3D modeling'),
                array('value' => 'game',        'name' => 'Game'),
                array('value' => 'demo',        'name' => 'Watch demo', 'path' => '/images/icons/screen.png' ),
                array('value' => 'readmore',    'name' => 'Read more',  'path' => '/images/icons/%%%theme-color%%%/arrowSmall.png' ),
                array('value' => 'back',        'name' => 'Back',       'path' => '/images/icons/%%%theme-color%%%/back.png' ),
                array('value' => 'download',    'name' => 'Download',   'path' => '/images/icons/arrowSmallDown.png' ),
                array('value' => 'upload',      'name' => 'Upload',     'path' => '/images/icons/arrowSmallUp.png' ),
                array('value' => 'faq',         'name' => 'FAQ',        'path' => '/images/icons/question.png' ),
                array('value' => 'like',        'name' => 'Appreciate', 'path' => '/images/icons/thumb.png' ),
                array('value' => 'share',       'name' => 'Share',      'path' => '/images/icons/plus.png' ),
                array('value' => 'love',        'name' => 'Love'),
            ),
        ),

        'link' => array(  'id' => 'link',
            'description' => 'Linking To (URL)',
            'type' => 'text',
            'default' => 'http://www.google.com'),
    		
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
    		    		

     );
	 
    public function printComponent( $options ) {
    	$float = '';
    	if( $options['float'] == 'left')
    		$float = ' floatleft';
    	else if( $options['float'] == 'right')
    		$float = ' floatright';
    	
        echo '<span class="customButton '.$options['icon'].$float.'">';
        echo '<a';
        if( !empty($options['highlight']) ){
            echo ' class="highlight"';
        }
        echo ' href="';
        echo $options['link'];
        echo '">';
        echo $options['title'];
        echo '</a>';
        echo '</span>';
	 }
}
?>