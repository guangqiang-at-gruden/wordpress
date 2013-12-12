<?php

class ffComponentReferences extends ffComponent {

    function getComponent($data=null){

      $ret = '';

      $ret .= "\n\n<!-- Start References component -->\n\n";

      foreach ($data['items'] as $item) {
          $index ++;
          $ret .= '<figure class="onefifth client row">';
          $ret .= '<a href="'.$item['link'].'">';
          $ret .= ffGalleryCollection::getPrintImage( $item['image'] );//'<img src="'.$item['image'].'" alt="" />';
          $ret .= '</a>';
          $ret .= '</figure>';
      }
      $ret .= '</ul>';

      $ret .= "\n\n<!-- End References component -->\n\n";

      return $ret;
    }
}

/*
function test_ffComponentReferences(){

    $data = array(
          'items' => array(
                array(
                    'image' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about/clients/1.jpg',
                    'link' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about/clients/1.jpg',
                ),
                array(
                    'image' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about/clients/2.jpg',
                    'link' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about/clients/2.jpg',
                ),
                array(
                    'image' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about/clients/3.jpg',
                    'link' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about/clients/3.jpg',
                ),
                array(
                    'image' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about/clients/4.jpg',
                    'link' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about/clients/4.jpg',
                ),
                array(
                    'image' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about/clients/5.jpg',
                    'link' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about/clients/5.jpg',
                ),
                array(
                    'image' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about/clients/6.jpg',
                    'link' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about/clients/6.jpg',
                ),
                array(
                    'image' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about/clients/7.jpg',
                    'link' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about/clients/7.jpg',
                ),
                array(
                    'image' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about/clients/8.jpg',
                    'link' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about/clients/8.jpg',
                ),
                array(
                    'image' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about/clients/9.jpg',
                    'link' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about/clients/9.jpg',
                ),
                array(
                    'image' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about/clients/10.jpg',
                    'link' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about/clients/10.jpg',
                ),
          ),
    );

    $instance = new ffComponentReferences();
    $instance->printComponent( $data );
}

add_shortcode( 'references', 'test_ffComponentReferences' );

*/