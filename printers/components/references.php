<?php
fEnv::registerComponent( 'References', 'componentReferences');
class componentReferences extends  componentBasic {
    protected $options = array(

        'modulename' => array(  'id' =>'html_name',
            'description' => 'References',
            'type' => 'html_name'),

        'image' => array(  'id' => 'image', 'description' => 'Image URL', 'type' => 'image', 'default' => 'fwdefloc/images/about/clients/1.jpg'),
        'link'  => array(  'id' => 'link',  'description' => 'Link',  'type' => 'text', 'default' => '#'),
    );
	 
    public function printComponent( $options ) {
    	$ret = '';
    	$ret .= '<figure class="client">';
    	$ret .= '<a href="'.$options['link'].'">';
    	$ret .= ffGalleryCollection::getPrintImage( $options['image'] );//'<img src="'.$options['image'].'" alt="" />';
    	$ret .= '</a>';
    	$ret .= '</figure>';
    	
    	echo $ret;
        /*$items = $this->_getItems($options);
        $data = array(
              'wrapperclass' => '',
              'title' => $options['title'],
              'items' => $items,
        );

        $instance = new ffComponentReferences();
        $instance->printComponent( $data );*/
    }

    /*private function _getItems( $options ) {
        $items = array();
        for( $i = 1; $i <= 10; $i++ ) {
            if( !empty( $options['image'.$i] ) ) {
                $newItem = array();
                $newItem['image'] = $options['image'.$i];
                $newItem['link'] = $options['link'.$i];
                $items[] = $newItem;
            }
        }
        return $items;
    }*/
}
?>