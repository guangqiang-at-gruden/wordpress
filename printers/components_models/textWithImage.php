<?php

class ffComponentTextWithImage extends ffComponent {

    function getComponent($data=null){
    	
      	$ret = '';
      
      	$ret .= "\n".'<!-- Start ComponentTextWithImage component -->'."\n";

      	$ret .= "\n".'<article class="'.$data['wrapperclass'].' row">'."\n";;
      	if( !empty($data['image']) ){
      		$ret .= ffGalleryCollection::getPrintImage( $data['image'], 'half-bottom');//'<img class="half-bottom" src="'.$data['image'].'" alt="" />';
      	}
      	$ret .= '<h4>'.htmlspecialchars($data['title']).'</h4>';
      	$ret .= $data['description'];
      	if( !empty($data['buttonlink']) ){
	      	$ret .= '<a class="button small dark" href="'.htmlspecialchars($data['buttonlink']).'">';
	      	$ret .= htmlspecialchars($data['buttontext']).'</a>';
	      	
      	}
      	$ret .= '</article>';
      	$ret .= "\n".'<!-- End ComponentTextWithImage component -->'."\n";
      	
      	return $ret;
    }

}
/*
function test_ffComponentTextWithImage(){

    $data = array(
    			'wrapperclass' => 'onefourth',
                'title' => 'HTML5 / CSS3 / Javascript development',
    			'image' => 'http://www.wiseguys-themes.com/wiseguys/creative/images/services/offer/1.png',
                'description' => 'Lorem ipsum dolor sit amet, consect adipiscing elit. Pellentesque semanti nibh, laoreet sed convallis vel, mauri euismod vitae nulla velit abis ent au.',
    	        'buttonlink' => 'http://www.google.com/',
	            'buttontext' => 'READ MORE',
    );

    $instance = new ffComponentTextWithImage();
    $instance->printComponent( $data );
}

add_shortcode( 'TextWithImage', 'test_ffComponentTextWithImage' );
*/
?>
