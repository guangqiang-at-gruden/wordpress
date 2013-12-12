<?php
/**
 *  getInTouch
 * 
 *  @author freshface
 */

// private register this widget for framework 
fEnv::addWidget('ffLatestWorks');

class ffLatestWorks extends frameworkWidget {
	/**
	 *  Defining the widget options
	 */

     protected $_widgetAdminTitle =       "Latest Works - Custom Widget";
     protected $_widgetAdminDescription = "Thumbnails from your Portfolio";
     protected $_widgetWrapperClasses =   "textWidget clearfix";
     protected $_widgetFormSize =         frameworkWidget::WIDGET_FORM_SIZE_THIN;



     protected $options = array(
        array(  'id' => 'title',
                'description' => 'Title',
                'type' => 'text',
                'default' => 'LATEST WORKS'),

        array(  'id' => 'count',
                'description' => 'Maximum featured images count',
                'type' => 'text',
                'default' => '6'),

        array(  'id' => 'type',
                'description' => 'Use featured image from',
                'type' => 'select',
                'default' => 'custom',
                'values' => array(
                                array( 'name' => 'Category',  'value' => 'category' ),
                                array( 'name' => 'Tag', 'value' => 'tag' ),
                            ),
                'default' => 'category'),

        array(  'id' => 'tag',
                'description' => 'Tag',
                'type' => 'select-wp-tag',
                'include-values' => array(
                                array( 'name' => '', 'value' => '0' ),
                            ),
                'default' => 0),

        array(  'id' => 'category',
                'description' => 'Category',
                'type' => 'select-wp-category',
                'include-values' => array(
                                array( 'name' => 'All top catagories', 'value' => '0' ),
                            ),
                'default' => 0),

     );

	/**
	 * Printing widget, called by wordpress
	 */
    protected function _widget($args, $instance) {
		
        extract( $args );

        if( 'tag' == $instance["type"] ){
            if ( 0 == $instance["tag"] ){
                return;
            }
        }
        
        if( 'category' == $instance["type"] ){
            $catArgs = array(
                'numberposts' => $instance["count"],
                'orderby'     => 'date',
                'order'       => 'DESC',
            	'post_type'=>array('post', 'portfolio'),
                'category'    => $instance["category"]
            );
            $posts = get_posts($catArgs);
            
        }else{
            $term = get_term_by('id', $instance["tag"], 'post_tag');
            $tagArgs = array(
                'numberposts' => $instance["count"],
                'orderby'     => 'date',
                'order'       => 'DESC',
                'tag'         => $term->slug, // tag ID does not work :(
            );
            $posts = get_posts($tagArgs);
        }
		
        echo $before_widget;

        if( !empty( $instance['title'] ) ) {
            $instance['title'] = apply_filters('widget_title', $instance['title'] );
        }

  			echo $before_title . $instance['title'] . $after_title;

        $this->_printImages($posts);

        echo $after_widget;
    }

    private function _printImages($posts){
        echo '<ul>';

        $counter = 1;

        foreach ($posts as $key=>$post) {
            $gallery = ffGalleryCollection::getGallery( $post->ID );
            if( null != ($featuredImage = $gallery->getFeaturedImage() ) ){
                $image = fImg::resize($featuredImage->image->url, 71, 71, true );

                if( 0 == $counter % 3 ){
                    echo '<li class="last">';
                }else{
                    echo '<li>';
                }

                $counter ++;

                echo '<a href="'.get_permalink( $post->ID ).'">';
                echo '<img src="'.$image.'"
                           alt="'.$featuredImage->altText.'"
                           title="'.$featuredImage->title.'"
                           width="71"
                           height="71" />';
                echo '</a>';
                echo '<div class="borderHover"></div>';
                echo '</li>';
            }
        }
        echo '</ul>';
    }

}
