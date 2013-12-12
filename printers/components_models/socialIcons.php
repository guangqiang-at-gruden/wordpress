<?php

class ffComponentSocialIcons extends ffComponent {

    function getComponent($data=null){

      $ret = '';

      $ret .= "\n\n<!-- Start ffComponentSocialIcons component -->\n\n";

      

      $ret .= '<article class="row">';

      $ret .= '<ul class="socialIcons">';

      $socialStuff = new ffSocialFeeder( $data['socialdata'] );
	  if( !empty($socialStuff->items) ) { 
      foreach ($socialStuff->items as $socialItem) {
          $ret .= '<li class="';
          $ret .= $socialItem->type;
          if( !empty($data['color']) ){
            $ret .= ' normal';
          }
          $ret .= '"><a href="';
          $ret .= $socialItem->link;

          if( !empty($data['tooltip']) ){
              $ret .= '" class="tooltip" data-tooltipText="';
              $ret .= $socialItem->title;
          }

          $ret .= '">';
          $ret .= $socialItem->title;
          $ret .= '</a></li>';
      }
	  }
      $ret .= '</ul>';

      $ret .= '</article>';

      $ret .= "\n\n<!-- End ffComponentSocialIcons component -->\n\n";

      return $ret;
    }
}
