<?php

class ffComponentTestimonial extends ffComponent {

    function getComponent($data=null){

      $ret = '';
      
      $ret .= "\n\n<!-- Start testimonial component -->\n\n";

      $ret .= '<section class="'.$data['wrapperclass'].'">';

      $ret .= '<h4>'.htmlspecialchars($data['title']).'</h4>';

      $ret .= '<div class="miniSlider" data-autoPlay="'.$data['data-autoPlay'].'" data-autoDelay="'.$data['data-autoDelay'].'">';
      $ret .= '<div class="miniNav"></div>';

      $ret .= '<ul>';

      foreach ($data['items'] as $key=>$value) {
          $ret .= '<li class="testimonial">';
          $ret .= ($value['description']);
          $ret .= '<span class="testimonialAuthor">'.($value['author']).'</span>';
          $ret .= '<span class="testimonialPosition">'.($value['position']).'</span>';
          $ret .= '</li>';
      }

      $ret .= '</ul>';

      $ret .= '</div>';

      $ret .= '</section>';
      
      $ret .= "\n\n<!-- End testimonial component -->\n\n";

      return $ret;
    }

}


/*
function test_ffComponentTestimonial(){

    $data = array(
            'wrapperclass' => 'onehalf row last noresize',
            'title' => 'Testimonial Example',
            'data-autoPlay' => 'true',
            'data-autoDelay' => '3000',
            'items' => array(
                array(
                    'description' => 'Lorem ipsum dolor sit amet, consect adipiscing elit. Pellentesque semanti nibh, laoreet sed convallis vel, mauri euismod vitae nulla velit abis ent au.',
                    'author' => 'I. C. Wiener',
                    'position' => 'Executive manager',
                ),
                array(
                    'description' => 'Maecenas at viverra ante. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam tristique sollicitudin eleifend. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec id urna vitae nunc rutrum convallis sit amet vel elit.',
                    'author' => 'Jane Dilbert',
                    'position' => 'Executive director',
                ),
                array(
                    'description' => 'Sed bibendum pretium condimentum. Donec ac justo eros. Vestibulum et tortor lectus, vel vestibulum sem. Nullam at leo enim. Aenean vel felis vel ante adipiscing luctus laoreet eget mi.',
                    'author' => 'I. C. Q.',
                    'position' => 'Executive decorator',
                ),
                array(
                    'description' => 'Sed bibendum pretium condimentum. Donec ac justo eros. Vestibulum et tortor lectus, vel vestibulum sem. Nullam at leo enim. Aenean vel felis vel ante adipiscing luctus laoreet eget mi.',
                    'author' => 'I. C. See',
                    'position' => 'Executive cop',
                ),
            ),
    );

    $instance = new ffComponentTestimonial();
    $instance->printComponent( $data );
}

add_shortcode( 'testimonial', 'test_ffComponentTestimonial' );
*/

?>
