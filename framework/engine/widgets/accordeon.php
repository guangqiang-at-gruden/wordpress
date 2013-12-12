<?php
/**
 *  getInTouch
 * 
 *  @author freshface
 */

// private register this widget for framework 
fEnv::addWidget('ffAccordeon');

class ffAccordeon extends frameworkWidget {
	/**
	 *  Defining the widget options
	 */

     protected $_widgetAdminTitle =       "Accordeon - Custom Widget";
     protected $_widgetAdminDescription = "Shows and Hides blocks of content";
     protected $_widgetWrapperClasses =   "";
     protected $_widgetFormSize =         frameworkWidget::WIDGET_FORM_SIZE_WIDE;

     const SECTION_COUNT = 5;

     protected $options = array(
        array(  'id' => 'title',
                'description' => 'Widget Title',
                'type' => 'text',
                'default' => ''),

        array(
                'type' => 'loop',
                'count' => self::SECTION_COUNT,
                'looptions' => array(
                      array(  'description' => 'Section #%i%',
                              'type' => 'header', ),

                      array(  'id' => 'section_title_%i%',
                              'description' => 'Title',
                              'type' => 'text',
                              'default' => ''),

                      array(  'id' => 'section_text_%i%',
                              'description' => 'Text',
                              'type' => 'smallarea',
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

        echo '<ul class="acc" id="acc">';
        for( $i=1; $i<=self::SECTION_COUNT; $i++ ){
            $instance["section_title_$i"] = trim( $instance["section_title_$i"] );
            if( empty( $instance["section_title_$i"] ) ){
                continue;
            }
            echo '<li>';
            echo '<h4><span>'. $instance["section_title_$i"] .'</span></h4>';
            echo '<div class="acc-section">';
            echo '<div class="acc-content">';
            echo '<p>';
            echo $instance["section_text_$i"];
            echo '</p>';
            echo '</div>';
            echo '</div>';
            echo '</li>';

        }
        echo '</ul>';

        echo $after_widget;
    }
}
