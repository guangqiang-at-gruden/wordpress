<?php
class ffComponentPricing extends ffComponent {

    function getComponent($data=null){

      $ret = '';
      
      $ret .= "\n".'<!-- Start Pricing component -->'."\n";
      $ret .= '<article class="'. $this->getWidgetClass() . ' ' . $data['wrapperclass'] . ' row';
      if( $data['highlighted'] ){
          $ret .= ' highlighted';
      }
      if( $data['fullPricingTable'] ){
          $ret .= ' fullPricingTable';
      } else {
      	$ret .= ' pricingTable ';
      }
      $ret .= '">';
      $ret .= '<header><h2>'.htmlspecialchars($data['title']).'</h2></header>';

      $price = explode(" ",$data['price'],3);
      if( 3 != count($price) ){
          $ret .= '<section class="price clearfix">
                    <div class="currency">$</div>
                    <div class="cost">??</div>
                    <div class="decimal">??</div>
                    <div class="recurrence">??</div>
                  </section>
          ';
      }else{
          $cost = explode(".",$price[1],2);
          if( 1==count($cost) ){
              $cost[1] = '00';
          }
          $ret .= '<section class="price clearfix">
                    <div class="currency">'.$price[0].'</div>
                    <div class="cost">'.$cost[0].'</div>
                    <div class="decimal">'.$cost[1].'</div>
                    <div class="recurrence">'.$price[2].'</div>
                  </section>
          ';
      }

      $ret .= '<div class="divider large"></div>';
      $ret .= '<ul class="features row">';

      $cnt = count($data['items']);
      if( 0 != $cnt ){
          for ($i=0;$i<$cnt;$i++) {
            $ret .= '<li>';
            $ret .= '<p>'.$data['items'][$i].'</p>';
            if( $i + 1 < $cnt ){
                $ret .= '<div class="lineSeparator"></div>';
            }
            $ret .= '</li>';
          }
      }

      $ret .= '</ul>';
      $ret .= '<a class="button normal dark';
      if( $data['highlighted'] ){
          $ret .= ' reverted';
      }
      $ret .= '" href="' . $data['buttonlink'] . '">' . $data['buttontext'] . '</a>';
      $ret .= '</article>';

      $ret .= "\n".'<!-- /End Pricing component -->'."\n";
      return $ret;
    }

}

/*
function test_ffComponentPricing(){

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

    $instance = new ffComponentPricing();
    $instance->printComponent( $data );
}

add_shortcode( 'pricing', 'test_ffComponentPricing' );*/

?>
