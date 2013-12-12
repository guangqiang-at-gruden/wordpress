<?php
/**
 * Prints 4 types of feed:
 * Popular ( posts )
 * Recent ( posts )
 * Comments ( comment )
 * Tags ( in post table )
 * 
 * 
 * informace jsou ve funkci widget, doporucuju kazdou promenou vardumpnout
 */

// private register this widget for framework
fEnv::addWidget('ffTabPosts');

class ffTabPosts extends frameworkWidget {
  /**
   *  Defining the widget options
   */

     protected $_widgetAdminTitle =       "Tab Posts - Custom Widget";
     protected $_widgetAdminDescription = "Tabs with Recent and Popular Posts";
     protected $_widgetWrapperClasses =   "tabs";
     protected $_widgetFormSize =         frameworkWidget::WIDGET_FORM_SIZE_THIN;



     protected $options = array(
     
        array(  'id' => 'title',
                'description' => 'Title',
                'type' => 'text',
                'default' => 'MORE POSTS'),

/******************************************************************************/
/* POPULAR AREA
/******************************************************************************/         

        array(  'description' => 'Popular Posts',
                'type' => 'header', ),

        array(  'id' => 'popular_show',
                'description' => 'Show Popular Posts',
                'type' => 'checkbox',  // [[ text, check, select ]]
                'default' => 1),
         
        array(  'id' => 'popular_title',
                'description' => 'Popular Posts Title',
                'type' => 'text',  // [[ text, check, select ]]
                'default' => 'Popular'),

        array(  'id' => 'popular_categories',
                'description' => 'Category',
                'type' => 'select-wp-category',
                'include-values' => array(
                                array( 'name' => 'All top catagories', 'value' => '0' ),
                            ),
                'default' => 0),
         
        array(  'id' => 'popular_num_of_posts',
                'description' => 'Number of popular posts to show',
                'type' => 'text',  // [[ text, check, select ]]
                'default' => '5'),
         
/******************************************************************************/
/* RECENT AREA
/******************************************************************************/         
         
        array(  'description' => 'Recent posts',
                'type' => 'header', ),

        array(  'id' => 'recent_show',
                'description' => 'Show recent posts',
                'type' => 'checkbox',  // [[ text, check, select ]]
                'default' => 1),
         
        array(  'id' => 'recent_title',
                'description' => 'recent Posts title',
                'type' => 'text',  // [[ text, check, select ]]
                'default' => 'Recent'),
         
        array(  'id' => 'recent_categories',
                'description' => 'Category',
                'type' => 'select-wp-category',
                'include-values' => array(
                                array( 'name' => 'All top catagories', 'value' => '0' ),
                            ),
                'default' => 0),
         
        array(  'id' => 'recent_num_of_posts',
                'description' => 'Number of recent posts to show',
                'type' => 'text',  // [[ text, check, select ]]
                'default' => '5'),

);

    /**
     * Printing widget, called by wordpress
     */
    protected function _widget($args, $instance) {
        $feedData = $this->_collect_data( $instance );

        $postsDataByIndex = array(
            1 => $feedData->popular_posts,
            2 => $feedData->recent_posts,
            //3 => $feedData->featured_posts,
        );

        if(    empty( $feedData->popular_posts )
            && empty( $feedData->recent_posts )
            //&& empty( $feedData->featured_posts )
          ){

            // if there is not stuff to show DO NOT show anything
            return;
        }

        extract( $args );

        echo $before_widget;

        if( !empty( $instance['title'] ) ) {
            $instance['title'] = apply_filters('widget_title', $instance['title'] );
        }

  			echo $before_title . $instance['title'] . $after_title;

        echo '<ul>';

        if( !empty( $feedData->popular_posts  ) ){ echo '<li><a href="#tabs-1">'.$instance["popular_title"].'</a></li>'; }
        if( !empty( $feedData->recent_posts   ) ){ echo '<li><a href="#tabs-2">'.$instance["recent_title"]. '</a></li>'; }
        //if( !empty( $feedData->featured_posts ) ){ echo '<li><a href="#tabs-2">'.$instance["featured_posts"]. '</a></li>'; }

        echo '</ul>';
        
        foreach($postsDataByIndex as $tabIndex=>$posts) {
            $this->_print_widget_tab($tabIndex,$posts);
        }

        echo $after_widget;
    }    
    
    private function _print_widget_tab($tabIndex,$posts){

        $dateFormat = "M d Y";

        if( empty( $posts ) ){
            return;
        }

        echo '<div id="tabs-'.$tabIndex.'">';

        foreach( $posts as $post ) {
            echo '<p>';

            $gallery = ffGalleryCollection::getGallery( $post->ID );
            if( null != ($featuredImage = $gallery->getFeaturedImage() ) ){
                $image = fImg::resize($featuredImage->image->url, 53, 53, true );
                echo '<img src="'.$image.'"
                           alt="'.$featuredImage->altText.'"
                           title="'.$featuredImage->title.'"
                           width="53"
                           height="53" />';
            }

            echo '<a href="'.get_permalink( $post->ID ).'">';
            echo $post->post_title;
            echo '</a>';
            echo '<span class="date">';
            echo date($dateFormat, strtotime($post->post_date) );
            echo '</span>';
            echo '</p>';
        }

        echo '</div>';
    }

/******************************************************************************/
/* COLLECTING DATA
/******************************************************************************/
    
    private function _collect_data( $instance ) {
      $feedData = new stdClass();
      $feedData->number_of_sections = 0;
      $feedData->popular_posts = null;
      $feedData->recent_posts = null;
      $feedData->recent_comments = null;
      $feedData->tags = null;
      
      
      if( $instance['popular_show'] == 1 ) {
        $popular_posts = $this->_get_popular_posts( $instance );
        if( !empty( $popular_posts ) ) {
          $feedData->popular_posts = $popular_posts;
          $feedData->number_of_sections++;
        }
      }
      
      if( $instance['recent_show'] == 1 ) {
        $recent_posts = $this->_get_recent_posts($instance);
        if( !empty( $recent_posts ) ) {
          $feedData->recent_posts = $recent_posts;
          $feedData->number_of_sections++;
        }
      }
      
      return $feedData;
    }
    
    private function _get_tags( $instance ) {
      $args = array( 'number'=> $instance['tags_num_of_posts'] );
      $tags = get_tags( $args );
      return $tags;
    }
    
    private function _get_recent_comments( $instance ) {
    $args = array( 'number' => $instance['comments_num_of_posts'], 'status'=>'approve' );
      $comments = get_comments( $args );
      return $comments;
    }
    
    private function _get_popular_posts( $instance ) {
      $args = array('orderby' => 'comment_count', 'order'=>'desc', 'numberposts'=> $instance['popular_num_of_posts'], 'post_type'=>array('post','portfolio') );
      if( !empty( $instance['popular_categories'] ) ) $args['category'] = $instance['popular_categories'];
      $posts = get_posts( $args );
      return $posts;
    }
    
    private function _get_recent_posts( $instance ) {
      $args = array('orderby' => 'post_date', 'order'=>'desc', 'numberposts'=> $instance['recent_num_of_posts'], 'post_type'=>array('post','portfolio') );
      if( !empty( $instance['recent_categories'] ) ) $args['category'] = $instance['recent_categories'];
      $posts = get_posts( $args );
      return $posts;
    }
}
?>