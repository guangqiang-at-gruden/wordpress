<?php

class ffComponentSlider extends ffComponent {

    function getComponent($data=null){

      if( empty($data['items']) ){
          return '';
      }

      $ret = '';
      
      $ret .= "\n\n<!-- Start slider component -->\n\n";

      $ret .= '<section class="'.$data['wrapperclass'].'">';
      if( !empty( $data['title'] ) ) $ret .= '<h4>'.$data['title'].'</h4>';

//      $ret .= '<div style="width:' . $data['width'] . 'px;height:' . $data['height'] . 'px;">';
	
      $ret .= '<div>';
      
      $ret .= '<div class="flexslider arrowvisible" data-arrows="'.$data['data-arrows'].'" data-thumbnail="'.$data['data-thumbnail'].'">';

      $ret .= '<ul class="slides">';


      foreach ($data['items'] as $key=>$value) {

          $img = $value;//fImg::resize( $value, $data['width'], $data['height'], true );

          $ret .= '<li>';
          $ret .= ffGalleryCollection::getPrintImage( $img );//'<img src="'.$img.'" alt="" />';
          $ret .= '</li>';
      }

      $ret .= '</ul>';

      $ret .= '</div>';
      
      $ret .= '</div>';

      $ret .= '</section>';

      $ret .= "\n\n<!-- End slider component -->\n\n";

      return $ret;
    }

}

/*
function test_ffComponentSlider(){
    $data = array(
            'wrapperclass' => 'onehalf tabletfull row last',
            'title' => 'Slider Example',
            'data-arrows' => 'true',
            'data-thumbnail' => 'false',
            'items' => array(
                'http://www.wiseguys-themes.com/wiseguys/creative/images/services2/slider/1.jpg',
                'http://www.wiseguys-themes.com/wiseguys/creative/images/services2/slider/2.jpg',
                'http://www.wiseguys-themes.com/wiseguys/creative/images/services2/slider/3.jpg',
            ),
    );

    $instance = new ffComponentSlider();
    $instance->printComponent( $data );
}

add_shortcode( 'slider', 'test_ffComponentSlider' );

*/

?>
