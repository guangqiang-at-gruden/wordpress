<?php
/**
 *  getInTouch
 * 
 *  @author freshface
 */

// private register this widget for framework 
fEnv::addWidget('ffContactByDepartment');

class ffContactByDepartment extends frameworkWidget {
	/**
	 *  Defining the widget options
	 */

     protected $_widgetAdminTitle =       "Contact By Department - Custom Widget";
     protected $_widgetAdminDescription = "Contact Links with Names and Positions";
     protected $_widgetWrapperClasses =   "";
     protected $_widgetFormSize =         frameworkWidget::WIDGET_FORM_SIZE_THIN;

     const SECTION_COUNT = 5;

     protected $options = array(
        array(  'id' => 'title',
                'description' => 'Widget Title',
                'type' => 'text',
                'default' => 'CONTACT BY DEPARTMENT'),

        array(
                'type' => 'loop',
                'count' => self::SECTION_COUNT,
                'looptions' => array(
                      array(  'description' => 'Person #%i%',
                              'type' => 'header', ),

                      array(  'id' => 'person_name_%i%',
                              'description' => 'Name',
                              'type' => 'text',
                              'default' => ''),

                      array(  'id' => 'person_link_%i%',
                              'description' => 'Link',
                              'type' => 'text',
                              'default' => ''),

                      array(  'id' => 'person_position_%i%',
                              'description' => 'Position',
                              'type' => 'text',
                              'default' => ''),
                ),
        ),

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

        echo '<ul class="contactSidemenu">';
        for( $i=1; $i<=self::SECTION_COUNT; $i++ ){
            $instance["person_name_"] = trim( $instance["person_name_$i"] );
            if( empty( $instance["person_name_$i"] ) ){
                continue;
            }
            echo '<li>';
            echo '<a href="'.$instance["person_link_$i"].'">'. $instance["person_name_$i"] .'</a> - ';
            echo $instance["person_position_$i"];
            echo '</li>';

        }
        echo '</ul>';

        echo $after_widget;
    }
}
