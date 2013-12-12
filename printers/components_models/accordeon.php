<?php

class ffComponentAccordeon extends ffComponent {

    function getComponent($data=null){

      $ret = '';
      
      $ret .= "\n".'<!-- Start accordion component -->'."\n";
      $ret .= '<div class="'. $this->getWidgetClass() . ' ' .$data['wrapperclass'].'">';
      if( !empty( $data['title'] ) ) $ret .= '<h4>'.$data['title'].'</h4>';
      $ret .= '<ul class="acc">';

      foreach ($data['items'] as $key=>$value) {
          $ret .= '<li>';
          $ret .= '<h4><span>'.htmlspecialchars($value['title']).'</span></h4>';
          $ret .= '<div class="acc-section"><div class="acc-content">'.$value['description'].'</div></div>';
          $ret .= '</li>';
      }

      $ret .= '</ul>';
      $ret .= '</div>';
      $ret .= "\n".'<!-- /End accordion component -->'."\n";

      return $ret;
    }

}

/*
function test_ffComponentAccordeon(){

    $data = array(
            'wrapperclass' => 'widget',
            'title' => 'Accordeon Example',
            'items' => array(
                array(
                    'title' => 'HTML5 / CSS3 / Javascript development',
                    'description' => 'Lorem ipsum dolor sit amet, consect adipiscing elit. Pellentesque semanti nibh, laoreet sed convallis vel, mauri euismod vitae nulla velit abis ent au.',
                ),
                array(
                    'title' => 'Wordpress programming and support',
                    'description' => 'Maecenas at viverra ante. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam tristique sollicitudin eleifend. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec id urna vitae nunc rutrum convallis sit amet vel elit.',
                ),
                array(
                    'title' => 'Web design and illustration',
                    'description' => 'Sed bibendum pretium condimentum. Donec ac justo eros. Vestibulum et tortor lectus, vel vestibulum sem. Nullam at leo enim. Aenean vel felis vel ante adipiscing luctus laoreet eget mi.',
                ),
                array(
                    'title' => 'Template and theme customization',
                    'description' => 'Sed bibendum pretium condimentum. Donec ac justo eros. Vestibulum et tortor lectus, vel vestibulum sem. Nullam at leo enim. Aenean vel felis vel ante adipiscing luctus laoreet eget mi.',
                ),
            ),
    );

    $instance = new ffComponentAccordeon();
    $instance->printComponent( $data );
}

add_shortcode( 'accordeon', 'test_ffComponentAccordeon' );*/

?>
