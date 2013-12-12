<?php
fEnv::registerComponent( 'Featured Works', 'componentFeaturedWorks');
class componentFeaturedWorks extends  componentBasic {
	protected $options = array(
	
		'modulename' => array(  'id' =>'html_name',
				'description' => 'Featured Works',
				'type' => 'html_name'),
	
		'title' => array(  'id' => 'title',
                'description' => 'Component Title',
                'type' => 'text',
                'default' => 'Featured Works'),
	
		'contact_form_id' => array(  'id' => 'categories',
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
	 	
	 	$data = array(
	      'title' => $options['title'],
	
	      // Duuno what to give inti this: ( I read info from category post )
	
	      'data-title' => "Image Title with <a href='http://themeforest.net/user/wiseguys' target=_blank'>link</a>",
	      'data-autoPlay' => $options['data-autoPlay'],
	      'data-autoDelay' => $options['delay'],
	      'cat' => $options['categories'],
	      'count' => $options['num_of_posts'],
	    );

    	$instance = new ffComponentFeaturedWorks();
    	$instance->printComponent( $data );
    	 
	 }
}

function components_featuredWorks_callback() {
	$items = array();
	$args = array( 'hide_empty' => false );
	$pads = array( 0=>'' );
	$categories = get_categories( $args );
	foreach ($categories as $category) {
		if( 0 != $category->category_parent ){
			$act_pads = $pads[ $category->category_parent ] . ' - ';
		}else{
			$act_pads = '';
		}
		$items[] = array(
				'name' => $act_pads . $category->name.' ('.$category->category_count.')',
				'value' => $category->term_id
		);
		$pads[ $category->term_id ] = $act_pads;
	}
	return $items;
}

?>