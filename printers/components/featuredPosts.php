<?php
fEnv::registerComponent( 'Featured Posts', 'componentFeaturedPosts');
class componentFeaturedPosts extends  componentBasic {
	protected $options = array(
	
		'modulename' => array(  'id' =>'html_name',
				'description' => 'Featured Posts',
				'type' => 'html_name'),
	
		'title' => array(  'id' => 'title',
                'description' => 'Component Title',
                'type' => 'text',
                'default' => 'Featured Posts'),
	
		'categories' => array(  'id' => 'categories',
				'description' => 'Categories',
				'type' => 'select-category',
				'default' => ''),			
		
		'num_of_posts' => array(  'id' => 'num_of_posts',
				'description' => 'Number Of Posts',
				'type' => 'text',
				'default' => '-1'),
						
			
			
        'data-autoPlay' => array(  'id' => 'data-autoPlay',
                'description' => 'Autoplay',
                'type' => 'select',
                'value' => 'On',
                'select_values'=> array(
                    array('name'=>'On', 'value'=>'true'),
                    array('name'=>'Off', 'value'=>'false')
                )
        ),
        
		'delay' => array(  'id' => 'delay',
				'description' => 'Delay in (ms)',
				'type' => 'text',
				'default' => '3000'),
						
			
			
     );
	 
	 public function printComponent( $options ) {
	 	( $options['data-autoPlay'] === '1' ) ? $autoplay = true : $autoplay = false;
	 	$data = array(
	      'title' => $options['title'],
	
	      // Duuno what to give inti this: ( I read info from category post )
	
	      'data-title' => "Image Title with <a href='http://themeforest.net/user/wiseguys' target=_blank'>link</a>",
	      'data-autoPlay' => $options['data-autoPlay'],
	      'data-autoDelay' => $options['delay'],
	      'cat' => $options['categories'],
	      'count' => $options['num_of_posts'],
	    );

    	$instance = new ffComponentFeaturedPosts();
    	$instance->printComponent( $data );
	 }
}
?>