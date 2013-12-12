<?php

class ffComponentEmployees extends ffComponent {

    function getComponent($data=null){

      $ret = '';

      $ret .= "\n\n<!-- Start employees component -->\n\n";

      $ret .= '<section class="'.$this->getWidgetClass().' '.$data['wrapperclass'].'">';

      $ret .= '<h4>'.htmlspecialchars($data['title']).'</h4>';

      $ret .= '<div class="miniSlider" data-autoPlay="'.$data['data-autoPlay'].'" data-autoDelay="'.$data['data-autoDelay'].'">';
      $ret .= '<div class="miniNav"></div>';

      $ret .= '<ul>';

      foreach ($data['items'] as $key=>$value) {
          $ret .= '<li class="teamMember">';
          $ret .= '<div class="teamMemberHeader">';
          $ret .= ffGalleryCollection::getPrintImage( $value['image'] );//'<img src="'.$value['image'].'" alt="" />';
          $ret .= '<div class="teamMemberName">'.htmlspecialchars($value['person']).'</div>';
          $ret .= '<div class="teamMemberPosition">'.htmlspecialchars($value['position']).'</div>';

          $infos = self::cleanInfoData($value['infodata']);
          foreach($infos as $info) {
          	$ret .= '<div class="teamMemberDetails"><span class="black">'.$info[0].': </span>'.$info[1].'</div>';
          }
          
          $socialStuff = new ffSocialFeeder( $value['socialdata'] );

          if( !empty( $socialStuff->items ) ) {
	          $ret .= '<ul class="socialIcons">';
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
	          $ret .= '</ul>';
          }


          $ret .= '</div>';
          $ret .= ''.($value['description']).'';
          $ret .= '</li>';
      }

      $ret .= '</ul>';

      $ret .= '</div>';

      $ret .= '</section>';
      
      $ret .= "\n\n<!-- End employees component -->\n\n";

      return $ret;
    }

    function cleanInfoData($data){
      $data = explode("\n", $data);
      $new_data = array();

      foreach( $data as $key=>$value) {
          $value = trim($value);
          if( empty($value) ){
              continue;
          }
          $new_data[] = $value;
      }

      $data = $new_data;
      $new_data = array();

      foreach( $data as $key=>$value) {
          if( FALSE === strpos($value,'!:!') ) {
              continue;
          }
          $value = explode('!:!',$value,2);
          $value[0] = trim($value[0]);
          $value[1] = trim($value[1]);
          $new_data[] = $value;
      }
      return $new_data;
    }

}

/*
function test_ffComponentEmployees(){

    $data = array(
          'wrapperclass' => 'onehalf row last noresize',
          'title' => 'Employees Example',
          'data-autoPlay' => 'true',
          'data-autoDelay' => '3000',
          'items' => array(
              array(
                  'person' => 'I. C. Wiener',
                  'position' => 'Executive manager',
                  'image' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about2/team/1.jpg',
                  'infodata' => 'Born!:! January 7th 1982, Chicago IL
                                 Studies!:! Harvar University, IT
                                 Skills!:! HTML, CSS, JS, Wordpress',
                  'socialdata' => 'https://twitter.com/_freshface
                                   https://plus.google.com/u/0/103144994524888181259/posts
                                   https://www.facebook.com/reditelzemekoule.salynus
                                   https://twitter.com/_freshface',
                  'description' => 'Lorem ipsum dolor sit amet, consect adipiscing elit. Pellentesque semanti nibh, laoreet sed convallis vel, mauri euismod vitae nulla velit abis ent au.',
              ),

              array(
                  'person' => 'Jane Dilbert',
                  'position' => 'Executive director',
                  'image' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/about2/team/2.jpg',
                  'infodata' => 'Born!:! January 11th 1982, Chicago IL
                                 Studies!:! Har Bar University, IT
                                 Skills!:! Cooking',
                  'socialdata' => 'https://twitter.com/_freshface
                                   https://twitter.com/_freshface',
                  'description' => 'Maecenas at viverra ante. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam tristique sollicitudin eleifend. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec id urna vitae nunc rutrum convallis sit amet vel elit.',
              ),
          ),
    );

    $instance = new ffComponentEmployees();
    $instance->printComponent( $data );
}

add_shortcode( 'employees', 'test_ffComponentEmployees' ); */
