<?php

class ffComponentTabs extends ffComponent {

    function getComponent($data=null){

      $ret = '';
      
      $ret .= "\n\n<!-- Start tabs component -->\n\n";

      $ret .= '<div class="'. $this->getWidgetClass() . '  ' .$data['wrapperclass'].' tabs" data-autoPlay="'.$data['data-autoPlay'].'" data-autoDelay="'.$data['data-autoDelay'].'">';
	  $ret .= '<'.$data['heading_type'].'>'.$data['title'].'</'.$data['heading_type'].'>';
      $ret .= '<ul>';

      foreach ($data['items'] as $key=>$value) {
          $ret .= '<li><a href="#tabs-'.(1+1*$key).'">'.htmlspecialchars($value['title']).'</a></li>';
      }

      $ret .= '</ul>';

      foreach ($data['items'] as $key=>$value) {
          $ret .= '<div id="tabs-'.(1+1*$key).'">'.$value['description'].'</div>';
      }

      $ret .= '</div>';

      $ret .= "\n\n<!-- End tabs component -->\n\n";

      return $ret;
    }

}

/*
function test_ffComponentTabs(){

    $data = array(
            'wrapperclass' => 'widget',
            'data-autoPlay' => 'false',
            'data-autoDelay' => '3000',
            'items' => array(
                array(
                    'title' => 'Title #1',
                    'description' => '<p class="row">Lorem ipsum dolor sit amet, consect adipiscing elit. Pellentesque semanti nibh, laoreet sed convallis vel, mauri euismod vitae nulla velit abis ent au.</p>',
                ),
                array(
                    'title' => 'Title #2',
                    'description' => '<p class="row">Maecenas at viverra ante. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam tristique sollicitudin eleifend. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec id urna vitae nunc rutrum convallis sit amet vel elit.</p>',
                ),
                array(
                    'title' => 'Title #3',
                    'description' => '<p class="row">Sed bibendum pretium condimentum. Donec ac justo eros. Vestibulum et tortor lectus, vel vestibulum sem. Nullam at leo enim. Aenean vel felis vel ante adipiscing luctus laoreet eget mi.</p>',
                ),
                array(
                    'title' => 'Title #4',
                    'description' => '<p class="row">Sed bibendum pretium condimentum. Donec ac justo eros. Vestibulum et tortor lectus, vel vestibulum sem. Nullam at leo enim. Aenean vel felis vel ante adipiscing luctus laoreet eget mi.</p>',
                ),
            ),
    );

    $instance = new ffComponentTabs();
    $instance->printComponent( $data );
}

add_shortcode( 'tabs', 'test_ffComponentTabs' ); */

?>
