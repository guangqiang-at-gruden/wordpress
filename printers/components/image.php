<?php
fEnv::registerComponent( 'Image', 'componentImage');
class componentImage extends  componentBasic {
    protected $options = array(

        'modulename' => array(  'id' =>'html_name',
            'description' => 'Image',
            'type' => 'html_name'),

        'title' => array(  'id' => 'title',
            'description' => 'Title',
            'type' => 'text',
            'default' => 'Image'),

        'description' => array(  'id' => 'description',
            'description' => 'Image Description',
            'type' => 'text',
            'default' => 'This is my image'),

        'image_title' => array(  'id' => 'image_title',
            'description' => 'Image Description in Jackbox',
            'type' => 'text',
            'default' => 'This is my image in Jackbox'),

        'width' => array(  'id' => 'width',
            'description' => 'Image Width (px)',
            'type' => 'text',
            'default' => '150'),

        'height' => array(  'id' => 'height',
            'description' => 'Image Height (px)',
            'type' => 'text',
            'default' => '150'),

        'src' => array(  'id' => 'src',
            'description' => 'Image Source',
            'type' => 'image',
            'default' => 'fwdefloc/images/about/team/2.jpg'),
    );
	 
    public function printComponent( $options ) {
        $width  = abs(ceil(1*str_replace('px','', $options['width'] )));
        $height = abs(ceil(1*str_replace('px','', $options['height'])));
        
        $image = ffGalleryCollection::getImageFromUrl( $options['src'] );
        
        echo '<div class="pagebuilder-component">';
        echo '<div class="pagebuilder-component-image">';

        echo '<figure>';

        echo '<a class="jackbox" data-group="featured_works" ';
        echo 'data-thumbTooltip="'. htmlspecialchars($options['image_title']) .'" ';
        echo 'data-title="'. htmlspecialchars($options['image_title']) .'" ';
        //echo 'data-description="#description_1" ';
        echo 'href="'.$options['src'].'">';

        echo '<div class="jackbox-hover jackbox-hover-blur jackbox-hover-magnify" style="width:' . $width . 'px; height:' . $height . 'px;"></div>';
        echo '<img width="' . $width . '" ';
        echo 'height="' . $height . '" ';
        echo 'src="' . fImg::resize( $options['src'], $width, $height, true ) . '" ';
        echo 'alt="'.$image->altText.'" title="'.$image->title.'" />';
        echo '<span class="portfolioImageOver transparent"></span>';
        echo '</a>';
        echo '</figure>';

        if( !empty( $options['title']) ){
            echo '<article>';
            echo '<p>';
            echo $options['title'];
            echo '</p>';
            echo '</article>';
        }

        echo '<span class="carouselArrow"></span>';
        
        echo '</div>';
        echo '</div>';
	}
}
?>