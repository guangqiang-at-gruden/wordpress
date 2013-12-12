<?php
/**
 *  sideMenu
 * 
 *  @author freshface
 */

// private register this widget for framework 
fEnv::addWidget('ffSideMenu');

class ffSideMenu extends frameworkWidget {
	/**
	 *  Defining the widget options
	 */

     protected $_widgetAdminTitle =       "SideMenu - Custom Sidebar Widget";
     protected $_widgetAdminDescription = "Side Navigation, great for FAQ pages, etc.";
     protected $_widgetWrapperClasses =   "";
     protected $_widgetFormSize =         frameworkWidget::WIDGET_FORM_SIZE_THIN;



     protected $options = array(
        array(  'id' => 'title',
                'description' => 'Title',
                'type' => 'text',
                'default' => ''),

        array(  'id' => 'custom_menu',
                'description' => 'Custom menu',
                'type' => 'select-wp-custom-menu',
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

        $this->_printCustomMenu( $instance["custom_menu"] );

        echo $after_widget;
    }

    private function _printCustomMenu($customMenuID){
        $menuItems = wp_get_nav_menu_items( $customMenuID );
		$permalink = get_permalink();
		
        echo '<ul class="sidemenu">';
        foreach($menuItems as $item) {
          if( 0 != $item->menu_item_parent ){
              continue;
          }
          
          $current = '';
          if( $permalink == $item->url ) {
          	$current = 'current';
          }
          echo '<li class="'.$current.'">';
          echo '<div class="arrow"></div>';
          echo '<a href="' . $item->url . '" title="' . $item->title . '" ' . '>' . $item->title.'</a>';
          echo '</li>';
        }
        echo '</ul>';
    }
}
