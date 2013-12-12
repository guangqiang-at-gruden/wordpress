<?php
fEnv::registerComponent( 'Testimonial', 'componentTestimonial');
class componentTestimonial extends componentBasic {
    protected $options = array(

        'modulename' => array(  'id' =>'html_name',
                'description' => 'Testimonial',
                'type' => 'html_name'),
        
        'title' => array(  'id' => 'title',
                'description' => 'Title',
                'type' => 'text',
                'default' => 'Testimonial'),
                
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

        'author1' => array(  'id' => 'author1',
                'description' => 'Author 1',
                'type' => 'text',
                'default' => 'John Doe'),
        'position1' => array(  'id' => 'position1',
                'description' => 'Position 1',
                'type' => 'text',
                'default' => 'Executive director'),
        'description1' => array(  'id' => 'description1',
                'description' => 'Description 1',
                'type' => 'textarea',
                'default' => 'Lorem ipsum dolor sit amet, consect adipiscing elit.'),

        'author2' => array(  'id' => 'author2',
                'description' => 'Author 2',
                'type' => 'text',
                'default' => 'John Doe'),
        'position2' => array(  'id' => 'position2',
                'description' => 'Position 2',
                'type' => 'text',
                'default' => 'Executive director'),
        'description2' => array(  'id' => 'description2',
                'description' => 'Description 2',
                'type' => 'textarea',
                'default' => 'Lorem ipsum dolor sit amet, consect adipiscing elit.'),

        'author3' => array(  'id' => 'author3',
                'description' => 'Author 3',
                'type' => 'text',
                'default' => 'John Doe'),
        'position3' => array(  'id' => 'position3',
                'description' => 'Position 3',
                'type' => 'text',
                'default' => 'Executive director'),
        'description3' => array(  'id' => 'description3',
                'description' => 'Description 3',
                'type' => 'textarea',
                'default' => 'Lorem ipsum dolor sit amet, consect adipiscing elit.'),

        'author4' => array(  'id' => 'author4',
                'description' => 'Author 4',
                'type' => 'text',
                'default' => 'John Doe'),
        'position4' => array(  'id' => 'position4',
                'description' => 'Position 4',
                'type' => 'text',
                'default' => 'Executive director'),
        'description4' => array(  'id' => 'description4',
                'description' => 'Description 4',
                'type' => 'textarea',
                'default' => 'Lorem ipsum dolor sit amet, consect adipiscing elit.'),

        'author5' => array(  'id' => 'author5',
                'description' => 'Author 5',
                'type' => 'text',
                'default' => 'John Doe'),
        'position5' => array(  'id' => 'position5',
                'description' => 'Position 5',
                'type' => 'text',
                'default' => 'Executive director'),
        'description5' => array(  'id' => 'description5',
                'description' => 'Description 5',
                'type' => 'textarea',
                'default' => 'Lorem ipsum dolor sit amet, consect adipiscing elit.'),

        'author6' => array(  'id' => 'author6',
                'description' => 'Author 6',
                'type' => 'text',
                'default' => 'John Doe'),
        'position6' => array(  'id' => 'position6',
                'description' => 'Position 6',
                'type' => 'text',
                'default' => 'Executive director'),
        'description6' => array(  'id' => 'description6',
                'description' => 'Description 6',
                'type' => 'textarea',
                'default' => 'Lorem ipsum dolor sit amet, consect adipiscing elit.'),

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

          $instance = new ffComponentTestimonial();
          $instance->printComponent( $data );
      }
      
      private function _createItems( $options ) {
          $items = array();
          for( $i = 1; $i <= 6; $i++ ) {
              if( !empty($options['author'.$i] ) ) {
                  $newItem = array();
                  $newItem['author'] = $options['author'.$i];
                  $newItem['position'] = $options['position'.$i];
                  $newItem['description'] = $options['description'.$i];
                  $items[] = $newItem;
              }
          }
          return $items;
      }
}
?>