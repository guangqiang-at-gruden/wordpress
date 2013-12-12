<?php
/**
 *  Testimonial
 *
 *  @author freshface
 */

// private register this widget for framework 
fEnv::addWidget('ffTestimonial');

class ffTestimonial extends frameworkWidget {
	/**
	 *  Defining the widget options
	 */

     protected $_widgetAdminTitle =       "Testimonial - Custom Widget";
     protected $_widgetAdminDescription = "A slider with several Customer Stories";
     protected $_widgetWrapperClasses =   "";
     protected $_widgetFormSize =         frameworkWidget::WIDGET_FORM_SIZE_WIDE;

     const SECTION_COUNT = 4;

     protected $options = array(
        array(  'id' => 'title',
                'description' => 'Widget Title',
                'type' => 'text',
                'default' => ''),

        array(  'id' => 'autoplay',
                'description' => 'Autoplay',
                'type' => 'select',
                'default' => 'false',
                'values' => array(
                                array( 'name' => 'On', 'value' => 'true' ),
                                array( 'name' => 'Off',  'value' => 'false' ),
                            ),
                ),

        array(  'id' => 'autodelay',
                'description' => 'Delay (in ms)',
                'type' => 'text',
                'default' => '3000'),

        array(
                'type' => 'loop',
                'count' => self::SECTION_COUNT,
                'looptions' => array(
                                  array(  'description' => 'Section #%i%',
                                          'type' => 'header', ),

                                  array(  'id' => 'section_author_%i%',
                                          'description' => 'Author',
                                          'type' => 'text',
                                          'default' => ''),

                                  array(  'id' => 'section_job_%i%',
                                          'description' => 'Job',
                                          'type' => 'text',
                                          'default' => ''),

                                  array(  'id' => 'section_testimonial_%i%',
                                          'description' => 'Testimonial',
                                          'type' => 'smallarea',
                                          'default' => '',),
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

        echo '<div class="miniSlider" data-autoPlay="'.$instance["autoplay"].'" data-autoDelay="'.$instance["autodelay"].'">';
        echo '<div class="miniNav"></div>';
        echo '<ul>';

        for( $i=1; $i<=self::SECTION_COUNT; $i++ ){
            $instance["section_author_$i"] = trim( $instance["section_author_$i"] );
            if( empty( $instance["section_author_$i"] ) ){
                continue;
            }
            echo '<li class="testimonial">';
            echo '<p>'. $instance["section_testimonial_$i"] .'</p>';
            echo '<span class="testimonialAuthor">'. $instance["section_author_$i"] .'</span>';
            echo '<span class="testimonialPosition">'. $instance["section_job_$i"] .'</span>';
            echo '</li>';
        }

        echo '</ul>';
        echo '</div>';

        echo $after_widget;
    }
}
