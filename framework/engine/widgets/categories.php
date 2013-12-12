<?php
/**
 *  getInTouch
 * 
 *  @author freshface
 */

// private register this widget for framework 
fEnv::addWidget('ffCategories');

class ffCategories extends frameworkWidget {
	/**
	 *  Defining the widget options
	 */

     protected $_widgetAdminTitle =       "Categories - Custom Widget";
     protected $_widgetAdminDescription = "A simple List of your Categories";
     protected $_widgetWrapperClasses =   "blogCategories";
     protected $_widgetFormSize =         frameworkWidget::WIDGET_FORM_SIZE_THIN;



     protected $options = array(
        array(  'id' => 'title',
                'description' => 'Title',
                'type' => 'text',
                'default' => ''),

        array(  'id' => 'type',
                'description' => 'Type of menu',
                'type' => 'select',
                'default' => 'custom',
                'values' => array(
                                array( 'name' => 'Use one of custom menus', 'value' => 'custom' ),
                                array( 'name' => 'Use childs of category',  'value' => 'category' ),
                            ),
                ),

        array(  'id' => 'custom_menu',
                'description' => 'Custom menu',
                'type' => 'select-wp-custom-menu',
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

        echo $before_widget;

        if( !empty( $instance['title'] ) ) {
            $instance['title'] = apply_filters('widget_title', $instance['title'] );
        }

  			echo $before_title . $instance['title'] . $after_title;

        if( 'category' == $instance["type"]){
            $this->_printCategories( $instance["category"] );
        }else{
            $this->_printCustomMenu( $instance["custom_menu"] );
        }

        echo $after_widget;
    }

    private function _printCategories($cat){

        $args = array( 'parent' => $cat );
        $categories=get_categories($args);

        echo '<ul>';
        foreach($categories as $category) {
          echo '<li>';
          echo '<div class="icon"></div>';
          echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s", ffgtd() ), $category->name ) . '" ' . '>' . $category->name.'</a>';
          echo '</li>';
        }
        echo '</ul>';
    }

    private function _printCustomMenu($customMenuID){
        $menuItems = wp_get_nav_menu_items( $customMenuID );

        echo '<ul>';
        foreach($menuItems as $item) {
          if( 0 != $item->menu_item_parent ){
              continue;
          }
          echo '<li>';
          echo '<div class="icon"></div>';
          echo '<a href="' . $item->url . '" title="' . $item->title . '" ' . '>' . $item->title.'</a>';
          echo '</li>';
        }
        echo '</ul>';
    }
}
