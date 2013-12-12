<?php
fEnv::registerComponent( 'Employees', 'componentEmployees');
class componentEmployees extends  componentBasic {
	protected $options = array(
	
		'modulename' => array(  'id' =>'html_name',
				'description' => 'Employees',
				'type' => 'html_name'),
	
		'title' => array(  'id' => 'title',
                'description' => 'Component Title',
                'type' => 'text',
                'default' => 'Employees'),
	
		'data-autoPlay' => array(  'id' => 'data-autoPlay',
				'description' => 'Autoplay',
				'type' => 'select',
				'value' => 'On',
				'select_values'=> array(
						array('name'=>'On', 'value'=>'true'),
						array('name'=>'Off', 'value'=>'false')
				)
		),
		
		'data-autoDelay' => array(  'id' => 'data-autoDelay',
				'description' => 'Autodelay',
				'type' => 'text',
				'default' => '3000'),			
			
			
////////////////////////////////////////////////////////////////////////////////			
			
        'person1' => array(  'id' => 'person1',
                'description' => 'Person 1',
                'type' => 'text',
                'default' => 'I. C. Wiener'),


		'position1' => array(  'id' => 'position1',
				'description' => 'Position 1',
				'type' => 'text',
				'default' => 'Executive manager'),	
			
		'image1' => array(  'id' => 'image1',
				'description' => 'Image 1',
				'type' => 'image',
				'default' => 'fwdefloc/images/about/team/1.jpg'),
		
		'info1' => array(  'id' => 'info1',
					'description' => 'Informations 1',
					'type' => 'textarea-exact',
					'default' =>"Born!:! January 7th 1982, Chicago IL\n
                                 Studies!:! Harvar University, IT\n
                                 Skills!:! HTML, CSS, JS, Wordpress"),			
			
		'social1' => array(  'id' => 'social1',
                'description' => 'Social Data 1',
                'type' => 'textarea-exact',
                'default' => 		"https://twitter.com/_freshface \nhttps://facebook.com/_freshface \nhttps://linkedin.com/_freshface \n"),
        'description1' => array(  'id' => 'description1',
                'description' => 'Description 1',
                'type' => 'textarea',
                'default' => '<p>Lorem ipsum dolor sit amet, consect adipiscing elit. Pellentesque semanti nibh, laoreet sed convallis vel, mauri euismod vitae nulla velit abis ent au.</p>'),		
   
////////////////////////////////////////////////////////////////////////////////
				
			'person2' => array(  'id' => 'person2',
					'description' => 'Person 2',
					'type' => 'text',
					'default' => 'I. C. Wiener'),
			
			
			'position2' => array(  'id' => 'position2',
					'description' => 'Position 2',
					'type' => 'text',
					'default' => 'Executive manager'),
								
			'image2' => array(  'id' => 'image2',
					'description' => 'Image 2',
					'type' => 'image',
				'default' => 'fwdefloc/images/about/team/2.jpg'),

			'info2' => array(  'id' => 'info2',
					'description' => 'Informations 2',
					'type' => 'textarea-exact',
					'default' =>"Born!:! January 7th 2982, Chicago IL\n
					Studies!:! Harvar University, IT\n
					Skills!:! HTML, CSS, JS, Wordpress"),
			                                 	
			'social2' => array(  'id' => 'social2',
					'description' => 'Social Data 2',
					'type' => 'textarea-exact',
                'default' => 		"https://twitter.com/_freshface \nhttps://facebook.com/_freshface \nhttps://linkedin.com/_freshface \n"),

			'description2' => array(  'id' => 'description2',
					'description' => 'Description 2',
					'type' => 'textarea',
					'default' => '<p>Lorem ipsum dolor sit amet, consect adipiscing elit. Pellentesque semanti nibh, laoreet sed convallis vel, mauri euismod vitae nulla velit abis ent au.</p>'),
			
////////////////////////////////////////////////////////////////////////////////
			
			'person3' => array(  'id' => 'person3',
					'description' => 'Person 3',
					'type' => 'text',
					'default' => 'I. C. Wiener'),
						
						
			'position3' => array(  'id' => 'position3',
					'description' => 'Position 3',
					'type' => 'text',
					'default' => 'Executive manager'),
			
			'image3' => array(  'id' => 'image3',
					'description' => 'Image 3',
					'type' => 'image',
					'default' => 'fwdefloc/images/about/team/2.jpg'),

			'info3' => array(  'id' => 'info3',
					'description' => 'Informations 3',
					'type' => 'textarea-exact',
					'default' =>"Born!:! January 7th 2982, Chicago IL\n
					Studies!:! Harvar University, IT\n
					Skills!:! HTML, CSS, JS, Wordpress"),
								 
			'social3' => array(  'id' => 'social3',
					'description' => 'Social Data 3',
					'type' => 'textarea-exact',
                'default' => 		"https://twitter.com/_freshface \nhttps://facebook.com/_freshface \nhttps://linkedin.com/_freshface \n"),

			'description3' => array(  'id' => 'description3',
					'description' => 'Description 3',
					'type' => 'textarea',
					'default' => '<p>Lorem ipsum dolor sit amet, consect adipiscing elit. Pellentesque semanti nibh, laoreet sed convallis vel, mauri euismod vitae nulla velit abis ent au.</p>'),

			
////////////////////////////////////////////////////////////////////////////////
			
			'person4' => array(  'id' => 'person4',
					'description' => 'Person 4',
					'type' => 'text',
					'default' => 'I. C. Wiener'),
						
						
			'position4' => array(  'id' => 'position4',
					'description' => 'Position 4',
					'type' => 'text',
					'default' => 'Executive manager'),

			'image4' => array(  'id' => 'image4',
					'description' => 'Image 4',
					'type' => 'image',
				'default' => 'fwdefloc/images/about/team/2.jpg'),

			'info4' => array(  'id' => 'info4',
					'description' => 'Informations 4',
					'type' => 'textarea-exact',
					'default' =>"Born!:! January 7th 2982, Chicago IL\n
					Studies!:! Harvar University, IT\n
					Skills!:! HTML, CSS, JS, Wordpress"),
			 
			'social4' => array(  'id' => 'social4',
					'description' => 'Social Data 4',
					'type' => 'textarea-exact',
                'default' => 		"https://twitter.com/_freshface \nhttps://facebook.com/_freshface \nhttps://linkedin.com/_freshface \n"),

			'description4' => array(  'id' => 'description4',
					'description' => 'Description 4',
					'type' => 'textarea',
					'default' => '<p>Lorem ipsum dolor sit amet, consect adipiscing elit. Pellentesque semanti nibh, laoreet sed convallis vel, mauri euismod vitae nulla velit abis ent au.</p>'),


////////////////////////////////////////////////////////////////////////////////
			
			'person5' => array(  'id' => 'person5',
					'description' => 'Person 5',
					'type' => 'text',
					'default' => 'I. C. Wiener'),
						
						
			'position5' => array(  'id' => 'position5',
					'description' => 'Position 5',
					'type' => 'text',
					'default' => 'Executive manager'),
			
			'image5' => array(  'id' => 'image5',
					'description' => 'Image 5',
					'type' => 'image',
					'default' => 'fwdefloc/images/about/team/2.jpg'),

			'info5' => array(  'id' => 'info5',
					'description' => 'Informations 5',
					'type' => 'textarea-exact',
					'default' =>"Born!:! January 7th 2982, Chicago IL\n
					Studies!:! Harvar University, IT\n
					Skills!:! HTML, CSS, JS, Wordpress"),
		 
			'social5' => array(  'id' => 'social5',
					'description' => 'Social Data 5',
					'type' => 'textarea-exact',
                'default' => 		"https://twitter.com/_freshface \nhttps://facebook.com/_freshface \nhttps://linkedin.com/_freshface \n"),

			'description5' => array(  'id' => 'description5',
					'description' => 'Description 5',
					'type' => 'textarea',
					'default' => '<p>Lorem ipsum dolor sit amet, consect adipiscing elit. Pellentesque semanti nibh, laoreet sed convallis vel, mauri euismod vitae nulla velit abis ent au.</p>'),

			
			                                 		 			
                
     );
	 
	 public function printComponent( $options ) {
	 	$items = $this->_createItems( $options );
    	$data = array(
          'wrapperclass' => '',
          'title' => $options['title'],
          'data-autoPlay' => $options['data-autoPlay'],
          'data-autoDelay' => $options['data-autoDelay'],
          'items' => $items,
		);
    	

    	$instance = new ffComponentEmployees();
    	$instance->printComponent( $data );
	 }
	 private function _createItems( $options ) {
	 	$items = array();
	 	for( $i = 1; $i <= 5; $i++ ) {
	 		if( !empty($options['person'.$i] ) ) {
	 			$newItem = array(); // person position image info social description
	 			$newItem['person'] = $options['person'.$i];
	 			$newItem['position'] = $options['position'.$i];
	 			$newItem['image'] = $options['image'.$i];
	 			$newItem['infodata'] = $options['info'.$i];
	 			$newItem['socialdata'] = $options['social'.$i];
	 			$newItem['description'] = $options['description'.$i];
	 			$items[] = $newItem;
	 		}
	 	}
	 	return $items;
	 }
}
?>