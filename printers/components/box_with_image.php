<?php
fEnv::registerComponent( 'Box With Image', 'componentBoxWithImage');
class componentBoxWithImage extends  componentBasic {
    protected $options = array(

        'modulename' => array(  'id' =>'html_name',
            'description' => 'Box With Image',
            'type' => 'html_name'),

        'title' => array(  'id' => 'title',
            'description' => 'Title ( optional )',
            'type' => 'text',
            'default' => 'Realtime Inventory Status'),

        'text_align' => array(  'id' => 'text_align',
                'description' => 'Text Align',
                'type' => 'select',
                'value' => 'left',
                'select_values'=> array( array('name'=>'Left', 'value'=>'left'),
                        array('name'=>'Right', 'value'=>'right'),
                        array('name'=>'Center', 'value'=>'center'),)

        ),

        'content' => array(  'id' => 'content',
            'description' => 'Text Content',
            'type' => 'textarea',
            'default' => '<p>One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in bed. <a href="http://www.google.com">Read more...</a></p>'),

        'img' => array(  'id' => 'img',
            'description' => 'Left Image Src',
            'type' => 'image',
            'default' => 'fwdefloc/images/services/tabs/1.jpg'),

    );
	 
    public function printComponent( $options ) {
        $title = '';
        if( $options['title'] != '' )
            $title = '<h4>'. $options['title'] . '</h4>';
            
        $align = empty($options['text_align']) ?
                 'center':
                 $options['text_align'];
        
        echo '<div class="tb_module">';
        echo '<div class="tb_box">';
        echo '<div class="one_box align'. $options['text_align'] .'">';
        echo '<div class="image_holder">';
        //echo '<img src="'. $options['img'] .'">';
        
        ffGalleryCollection::printImage( $options['img'] );
        echo '</div>';
        echo '<div class="text_holder">';
        echo ''. $title .'';
        echo ''. $options['content'] .'';
        echo '</div>';
        echo '<div class="clear"></div>';
        echo '</div>';

        echo '</div>';
        echo '</div>';

    }
}
?>