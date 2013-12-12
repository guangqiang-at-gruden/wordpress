<?php
fEnv::registerComponent( 'Divider', 'componentDivider');
class componentDivider extends  componentBasic {
    protected $options = array(
        'modulename' => array(  'id' =>'html_name',
            'description' => 'Divider',
            'type' => 'html_name'),

        'margin_top' => array(  'id' => 'margin_top',
            'description' => 'Margin Top (px)',
            'type' => 'text',
            'default' => '0'),
    		
		'margin_bottom' => array(  'id' => 'margin_bottom',
			'description' => 'Margin Bottom (px)',
			'type' => 'text',
			'default' => '30'),    		

        'line' => array(  'id' => 'line',
            'description' => 'Show Line',
            'type' => 'checkbox',
            'default' => 0),
    );
	 
    public function printComponent( $options ) {
    	
        $margin_top  = ceil( 1 * $options['margin_top'] );
        $margin_bottom  = ceil( 1 * $options['margin_bottom'] );
		$show_line = (int)$options['line'];
        
        $style = '';

        if( !empty($margin_top) )  $style .= 'margin-top:'.$margin_top.'px;';
        if( !empty($margin_bottom) ) $style .= 'margin-bottom:'.$margin_bottom.'px;';

        $class = '';
        if( $show_line == 1 ) $class =' large';
        echo '<div class="divider'.$class.'" style="'.$style .'"></div>';
    }
}
?>