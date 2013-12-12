<?php


class ffComponentComparsionColumn extends ffComponent {

    function getComponent($data=null){

      $ret = '';
      
      $ret .= "\n".'<!-- Start ComparsionColumn component -->'."\n";
      $ret .= '<article class="'. $this->getWidgetClass() . ' ' . $data['wrapperclass'] . ' comparison align' . $data['align'] . '">';

      if( empty($data['title']) ){
          $ret .= '<header class="noheader"></header>';
      }else{
          $ret .= '<header';
          if( $data['highlighted'] ){
              $ret .= ' class="highlighted"';
          }
          $ret .= '><h4>'.htmlspecialchars($data['title']).'</h4></header>';
      }
      
      $ret .= '<ul class="features">';

      $index = 0;

      foreach ($data['items'] as $key=>$value) {

          $index ++;
          if( 1 == $index % 2 ){
              $class = "odd ";
          }else{
              $class = "";
          }

          $yn = strtolower( trim($value) );

          if('[yes]' == $yn){
              $ret .= '<li class="'.$class.' yes"></li>';
          }else if('[no]' == $yn){
              $ret .= '<li class="'.$class.' no"></li>';
          }else{
              $ret .= '<li';
              if(!empty($class)){
                  $ret .= ' class="odd"';
              }
              $ret .='>'.$value.'</li>';
          }
      }
      $ret .= '</ul>';
      $ret .= '</article>';

      $ret .= "\n".'<!-- /End ComparsionColumn component -->'."\n";

      return $ret;
    }

}

/*
function test_ffComponentComparsionColumn(){

    $data = array(
            'wrapperclass' => '',
            'title' => 'PRO',
            'items' => array(
                '[yes]',
                '[no]',
                '1 GB',
                '1,000',
            ),
    );

    $instance = new ffComponentComparsionColumn();
    $instance->printComponent( $data );
}

add_shortcode( 'comparsionColumn', 'test_ffComponentComparsionColumn' );*/

?>
