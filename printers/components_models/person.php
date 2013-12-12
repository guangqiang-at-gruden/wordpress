<?php

class ffComponentPerson extends ffComponent {

    function getComponent($data=null){

      $ret = '';

      $ret .= "\n\n<!-- Start Person component -->\n\n";

      $ret .= '<article class="'.$data['wrapperclass'].' teamMember">';

      $ret .= ffGalleryCollection::getPrintImage( $data['image'] );//'<img src="'.$data['image'].'" alt="" />';
      $ret .= '<h4>'.htmlspecialchars($data['person']).'</h4>';
      $ret .= '<div class="italic">'.$data['position'].'</div>';
      $ret .= ''.$data['description'].'';

      $ret .= '<ul class="socialIcons">';

      $socialStuff = new ffSocialFeeder( $data['socialdata'] );
	  if( !empty($socialStuff->items) ) {
	      foreach ($socialStuff->items as $socialItem) {
	          $ret .= '<li class="';
	          $ret .= $socialItem->type;
	          $ret .= ' normal"><a href="';
	          $ret .= $socialItem->link;
	          $ret .= '" class="tooltip" data-tooltipText="';
	          $ret .= $socialItem->title;
	          $ret .= '">';
	          $ret .= $socialItem->title;
	          $ret .= '</a></li>';
	      }
	  }
      $ret .= '</ul>';

      $ret .= '</article>';
      
      $ret .= "\n\n<!-- End Person component -->\n\n";

      return $ret;
    }
}

/*
function test_ffComponentPerson(){

    $data = array(
          'wrapperclass' => 'onefourth row',
          'person' => 'I. C. Wiener',
          'position' => 'Executive manager',
          'image' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about/team/1.jpg',
          'socialdata' => 'https://twitter.com/_freshface
                           https://plus.google.com/u/0/103144994524888181259/posts
                           https://www.facebook.com/reditelzemekoule.salynus
                           https://twitter.com/_freshface',
          'description' => 'Lorem ipsum dolor sit amet, consect adipiscing elit. Pellentesque semanti nibh, laoreet sed convallis vel, mauri euismod vitae nulla velit abis ent au.',
    );

    $instance = new ffComponentPerson();
    $instance->printComponent( $data );
}

add_shortcode( 'person', 'test_ffComponentPerson' );

*/