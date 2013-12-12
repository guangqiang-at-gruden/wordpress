<?php
/**
 *  contactDetails
 * 
 *  @author freshface
 */

// private register this widget for framework 
fEnv::addWidget('ffContactDetails');

class ffContactDetails extends frameworkWidget {
    /**
     *  Defining the widget options
     */

     protected $_widgetAdminTitle =       "Contact Details - Custom Widget";
     protected $_widgetAdminDescription = "Detailed Contact Information";
     protected $_widgetWrapperClasses =   "contactInfo row";
     protected $_widgetFormSize =         frameworkWidget::WIDGET_FORM_SIZE_THIN;



     protected $options = array(
        array(  'id' => 'title',
                'description' => 'Title',
                'type' => 'text',
                'default' => 'CONTACT DETAILS'),

        array(  'id' => 'title_address',
                'description' => 'Address(es)',
                'type' => 'text',
                'default' => 'Address'),

        array(  'id' => 'address',
                'type' => 'smallarea',
                'default' => ''),

        array(  'id' => 'title_phone',
                'description' => 'Phone(s)',
                'type' => 'text',
                'default' => ''),

        array(  'id' => 'phone',
                'type' => 'smallarea',
                'default' => ''),

        array(  'id' => 'title_email',
                'description' => 'Emails(s)',
                'type' => 'text',
                'default' => '@'),

        array(  'id' => 'email',
                'type' => 'smallarea',
                'default' => ''),

     );

    /**
     * Printing widget, called by wordpress
     */
    function _widget($args, $instance) {

        extract( $args );

        echo $before_widget;

        if( !empty( $instance['title'] ) ) {
            $instance['title'] = apply_filters('widget_title', $instance['title'] );
        }

  			echo $before_title . $instance['title'] . $after_title;
  			
        // Address

        $instance['address'] = trim( $instance['address'] );

        echo '<article class="contactInfoItem">';
        echo '<header><div>'.$instance['title_address'].'</div><div class="headerBg"></div></header>';
        echo '<ul><li>'. str_replace("\n", '</li><li>', $instance['address']) .'</li></ul>';
        echo '</article>';

        // Phone

        $instance['phone'] = trim( $instance['phone'] );

        echo '<article class="contactInfoItem">';
        echo '<header><div>'.$instance['title_phone'].'</div><div class="headerBg"></div></header>';
        echo '<ul><li>'. str_replace("\n", '</li><li>', $instance['phone']) .'</li></ul>';
        echo '</article>';

        // Email

        $instance['email'] = trim( $instance['email'] );
        $emails_tmp = explode("\n", $instance['email']);
        $emails = array();
        foreach ($emails_tmp as $key=>$value) {
            $value = trim($value);
            if( empty($value) ){
                continue;
            }
            $emails[] = '<a href="mailto:'.$value.'">'.$value.'</a>';
        }

        echo '<article class="contactInfoItem">';
        echo '<header><div>'.$instance['title_email'].'</div><div class="headerBg"></div></header>';
        echo '<ul><li>'. implode('</li><li>', $emails) .'</li></ul>';
        echo '</article>';

        echo $after_widget;
    }
}
?>
