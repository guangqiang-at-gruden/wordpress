<?php

class ffComponentListAndBullets extends ffComponent {

    function getComponent($data=null){

      $ret = '';

      $ret .= "\n\n<!-- Start ffComponentListAndBullets component -->\n\n";

      $ret .= '<article class="'.$data['wrapperclass'].'">';

      $ret .= '<h4>'.htmlspecialchars($data['title']).'</h4>';

      if('check' == $data['type']){
          $ret .= '<ul class="check">';
      }else if('bullet' == $data['type']){
          $ret .= '<ul class="bullet">';
      }else{
          $ret .= '<ol>';
      }

      $items = explode("\n",$data['items']);

      foreach ($items as $item) {
          $item = trim($item);
          if( empty($item) ){
              continue;
          }
          $ret .= '<li>'.$item.'</li>';
      }

      if('ordered' == $data['type']){
          $ret .= '</ol>';
      }else{
          $ret .= '</ul>';
      }

      $ret .= '</article>';
      $ret .= "\n\n<!-- End ffComponentListAndBullets component -->\n\n";

      return $ret;
    }
}


