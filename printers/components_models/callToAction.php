<?php

class ffComponentCallToAction extends ffComponent {

    function getComponent($data=null){

      $ret = '';
      
      $ret .= "\n\n<!-- Start CallToAction component -->\n\n";

      $ret .= '<div class="actionBox row">';
      $ret .= '<a class="button '.$data['buttonsize'];
      if( (empty($data['buttonborder'])) || ( 'true' == $data['buttonborder'] ) ){
          $ret .= ' bordered';
      }
      $targetBlank = ( $data['targetblank'] == 'true') ? ' target="_blank" ' : '';
      
      $ret .= ' dark reverted" href="'.$data['buttonlink'].'" '.$targetBlank.'>'.$data['buttontext'].'</a>';
      $ret .= '<h3>'.$data['title'].'</h3>';
      $ret .= $data['description'];
      $ret .= '</div>';

      $ret .= "\n\n<!-- End CallToAction component -->\n\n";

      return $ret;
    }

}

/*
function test_ffComponentCallToAction(){

    $data = array(
            'title' => 'Wise Guys is flexible, friendly and intuitive, and it’s packed with goodies',
            'description' => 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas quis nisl quis mi pharetra euismod.',
            'buttonlink' => 'http://www.google.com/',
            'buttontext' => 'BUY IT NOW',
            'buttonsize' => 'large',
            // 'buttonsize' => 'normal', //
    );

    $instance = new ffComponentCallToAction();
    $instance->printComponent( $data );
}

add_shortcode( 'calltoaction', 'test_ffComponentCallToAction' );
*/
?>
