<?php
fEnv::registerComponent( 'Alert Box', 'componentAlertBox');
class componentAlertBox extends  componentBasic {

    protected $options = array(
        'modulename' => array(
            'id' =>'html_name',
            'description' => 'Text',
            'type' => 'html_name',
        ),

        'type' => array(
            'id' => 'type',
            'description' => 'Type',
            'type' => 'select',
            'value' => 'success',
            'select_values'=> array(
                array('name'=>'Success', 'value'=>'success'),
                array('name'=>'Warning', 'value'=>'warning'),
                array('name'=>'Error',   'value'=>'error'),
                array('name'=>'Info',    'value'=>'info')
            ),
        ),

        'text' => array(  'id' => 'text',
            'description' => 'Your username text',
            'type' => 'textarea',
            'default' => '<p>Lorem ipsum dolor sit amet metus. Etiam urna. Sed eu ante. Maecenas ligula eget odio nonummy sodales nibh malesuada id, adipiscing felis mollis eros quis venenatis tristique, mauris tincidunt mattis feugiat dui.</p>'
        ),

     );

    public function printComponent( $options ) {
        if( empty($options['type']) ) $options['type'] = 'success';

        echo '<div class="infoBox ';
        echo $options['type'];
        echo '">';
        echo $options['text'];
        echo '</div>';
    }
}
