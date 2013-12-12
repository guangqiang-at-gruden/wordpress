<?php

class ffComponentToggle extends ffComponent {

    function getComponent($data=null){

      $ret = '';
      
      $ret .= "\n".'<!-- Start toggle component -->'."\n";
      $ret .= '<section class="'.$data['wrapperclass'].' faq" data-toggle="true">';

      foreach ($data['items'] as $key=>$value) {
          $ret .= '<article class="row">';
          $ret .= '<div class="question">'.htmlspecialchars($value['title']).'</div>';
          $ret .= $value['description'];
          $ret .= '<div class="separator"></div>';
          $ret .= '</article>';
      }

      $ret .= '</section>';
      $ret .= "\n".'<!-- /End toggle component -->'."\n";

      return $ret;
    }

}
/*
function test_ffComponentToggle(){
    $data = array(
      'wrapperclass' => 'onehalf tabletfull row widget',
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

    $instance = new ffComponentToggle();
    $instance->printComponent( $data );

}

add_shortcode( 'toggle', 'test_ffComponentToggle' );
*/
?>
