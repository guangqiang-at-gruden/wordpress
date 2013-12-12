<?php
/**
 * frameworkWidget
 *
 * This class extends default WP_Widget class and add an automaticall widget settings form
 * !!! extended class has to have $options variable
 *
 * @author freshface
 */
class frameworkWidget extends WP_Widget {
    const ADD_CLASS = '!!!add_class!!!';

    const WIDGET_FORM_SIZE_WIDE = 'wide';
    const WIDGET_FORM_SIZE_THIN = 'thin';

    protected $_widgetWrapperClasses = "";

    protected $_widgetFormSize = frameworkWidget::WIDGET_FORM_SIZE_THIN;


	/**
	 * Registering the widget to the wordpress
	 */
    function __construct() {
        $this->_updateLoopOptions();
        $options = array('classname' => get_class($this), 'description' =>  $this->_widgetAdminDescription  );
    		$controls = array('width' => $this->_getFormSize(), 'height' => 200);
    		$this->WP_Widget( get_class($this) ,  $this->_widgetAdminTitle , $options, $controls);
    }

    protected function doAdditionalUpdates($new_instance){
        // nothing to do
    }

    /**
     * this function is updating values, called by wordpress
     */
    function update($new_instance, $old_instance) {
        $this->doAdditionalUpdates($new_instance);
        //save the widget
        foreach( $this->options as $one_option ) {
            $id = $one_option['id'];
            switch ($one_option['type']) {
                case 'select-wp-custom-menu':
                case 'select-wp-category':
                case 'select-wp-tag':
                case 'select':
                    $instance[$id] = $new_instance[$id];
                    break;
                case 'checkbox':
                    $instance[$id] = 0;
                    if( !empty($new_instance[$id]) ) $instance[$id] = 1;
                    break;
                case 'smallarea':
                case 'textarea':
                case 'text':
                default:
                    $instance[$id] = strip_tags($new_instance[$id]);
            	      break;
            }
        }
        return $instance;
    }

    protected function _getFormSize(){
        $size = 250;

        if( $this->_widgetFormSize == frameworkWidget::WIDGET_FORM_SIZE_WIDE ){
            $size = 430;
        }

        return $size;
    }

    protected function _itemTooltip($one_option){
        if( empty( $one_option['tooltip'] ) ){
            return;
        }

        if( is_array( $one_option['tooltip'] ) ){
            $img = empty( $one_option['tooltip']['img'] )  ? "" : $one_option['tooltip']['img'];
            $url = empty( $one_option['tooltip']['url'] )  ? "" : $one_option['tooltip']['url'];
            $dsc = empty( $one_option['tooltip']['text'] ) ? "" : $one_option['tooltip']['text'];
        }else{
            $img = "";
            $url = "";
            $dsc = "" . $one_option['tooltip'];
        }
        
        $dsc = str_replace("%TEMPLATE_DIRECTORY%",get_template_directory_uri(),$dsc);

        echo '<span class="ffFormTooltip_';
        if( $this->_widgetFormSize == frameworkWidget::WIDGET_FORM_SIZE_WIDE ){
            echo 'wide';
        }else if( $this->_widgetFormSize == frameworkWidget::WIDGET_FORM_SIZE_THIN ){
            echo 'thin';
        }else{
            echo 'thin unknown';
        }
        echo " ffFormTooltip_".$one_option['type'];
        echo '">';
        
        echo '<span class="ffFormTooltip_inner">';

        if( !empty($img) ){
            echo '<img src="'.get_template_directory_uri().$img.'" />';
        }
        
        if( !empty($dsc) ){
            echo $dsc;
        }

        if( !empty($url) ){
            echo '<p class="read-more"><a href="'.$url.'">Read more</a></p>';
        }


        echo '</span>';
        echo '</span>';
    }

    protected function _formItemText($instance, $one_option){

        $value = $one_option['default'];

        if( isset($instance[ $one_option['id'] ]) ) {
            $value = htmlspecialchars( $instance[ $one_option['id'] ] );
        }

        echo '<p>';
        if( !empty( $one_option['description'] ) ){
            echo '<label for="' . $this->get_field_id( $one_option['id'] ) . '">' . $one_option['description'] . ':</label>';
        }
        echo '<input id="' . $this->get_field_id( $one_option['id'] ) . '" name="' . $this->get_field_name( $one_option['id'] ) . '" type="text" class="widefat" value="'.$value.'">';
        echo '</p>';
        $this-> _itemTooltip($one_option);
    }

    protected function _formItemCheckBox($instance, $one_option){

        $value = '';

        if( ( !isset($instance[ $one_option['id'] ]) && $one_option['default'] == 1 ) || $instance[ $one_option['id'] ] == 1 ) {
            $value = 'checked="checked"';
        }

        echo '<p>';
        if( !empty( $one_option['description'] ) ){
            echo '<label for="' . $this->get_field_id( $one_option['id'] ) . '">';
        }
        echo '<input id="' . $this->get_field_id( $one_option['id'] ) . '" name="' . $this->get_field_name( $one_option['id'] ) . '" type="checkbox" '.$value.'>';
        echo ' ';
        if( !empty( $one_option['description'] ) ){
            echo $one_option['description'];
            echo '</label>';
        }
        echo '</p>';
        $this-> _itemTooltip($one_option);
    }

    protected function _formItemSelect($instance, $one_option){

        $value = $one_option['default'];

        if( isset($instance[ $one_option['id'] ]) ) {
            $value = $instance[ $one_option['id'] ];
        }

        echo '<p>';
        if( !empty( $one_option['description'] ) ){
            echo '<label for="' . $this->get_field_id( $one_option['id'] ) . '">' . $one_option['description'] . ':</label>';
        }
        echo '<select id="' . $this->get_field_id( $one_option['id'] ) . '" name="' . $this->get_field_name( $one_option['id'] ) . '" class="widefat">';
        foreach( $one_option['values'] as $one_val ) {

            $selected = null;

            if( $value == $one_val['value'] ) $selected = 'selected="selected"';

            $val = 'value="'.$one_val['value'].'"';

            echo "<option {$val} {$selected}>";
            echo $one_val['name'];
            echo "</option>";

        }

        echo '</select>';
        echo '</p>';

        $this-> _itemTooltip($one_option);
    }

    protected function _formItemTextArea($instance, $one_option){

        $value = $one_option['default'];

        if( isset($instance[ $one_option['id'] ]) ) {
            $value = htmlspecialchars ( $instance[ $one_option['id'] ] );
        }

        $this-> _itemTooltip($one_option);

        echo '<p>';
        if( !empty( $one_option['description'] ) ){
            echo '<label for="' . $this->get_field_id( $one_option['id'] ) . '">' . $one_option['description'] . ':</label>';
        }
        echo '<textarea id="' . $this->get_field_id( $one_option['id'] ) . '" name="' . $this->get_field_name( $one_option['id'] ) . '" class="widefat" rows="16" cols="20">'.$value.'</textarea>';
        echo '</p>';
    }

    protected function _formItemSmallArea($instance, $one_option){

        $value = $one_option['default'];

        if( isset($instance[ $one_option['id'] ]) ) {
            $value = htmlspecialchars ( $instance[ $one_option['id'] ] );
        }

        $this-> _itemTooltip($one_option);

        echo '<p>';
        if( !empty( $one_option['description'] ) ){
            echo '<label for="' . $this->get_field_id( $one_option['id'] ) . '">' . $one_option['description'] . ':</label>';
        }
        echo '<textarea id="' . $this->get_field_id( $one_option['id'] ) . '" name="' . $this->get_field_name( $one_option['id'] ) . '" class="widefat" rows="5" cols="20">'.$value.'</textarea>';
        echo '</p>';
    }
    
    protected function _formItemHeader($one_option){
        echo '<h3>';
        echo $one_option['description'];
        echo '</h3>';
    }

    protected function _getNavMenus(){
        
        $menus = wp_get_nav_menus( );
        
        $items = array();
        
        foreach ($menus as $customMenu) {
            $items[] = array(
                'name' => $customMenu->name,
                'value' => $customMenu->term_id
            );
        }

        return $items;
    }
    
    protected function _getCategories($one_option = null){

        $items = array();

        if( !empty( $one_option ) ){
            if( !empty( $one_option['include-values'] ) ){
                $items = $one_option['include-values'];
            }
        }

        $args = array( 'hide_empty' => false );

        $pads = array( 0=>'' );

        $categories = get_categories( $args );

        foreach ($categories as $category) {

            if( 0 != $category->category_parent ){
                $act_pads = $pads[ $category->category_parent ] . ' - ';
            }else{
                $act_pads = '';
            }

            $items[] = array(
                'name' => $act_pads . $category->name.' ('.$category->category_count.')',
                'value' => $category->term_id
            );

            $pads[ $category->term_id ] = $act_pads;
        }

        return $items;
    }

    protected function _getTags($one_option = null){

        $items = array();

        if( !empty( $one_option ) ){
            if( !empty( $one_option['include-values'] ) ){
                $items = $one_option['include-values'];
            }
        }

        $args = array( 'hide_empty' => false );

        $tags = get_tags( $args );

        foreach ($tags as $tag) {
            $items[] = array(
                'name' => $tag->name.' ('.$tag->count.')',
                'value' => $tag->term_id
            );
        }

        return $items;
    }

    /**
     * this function is printing wordpress widget forms, called by wordpress
     */
    function form($instance) {

        foreach( $this->options as $one_option ) {

            if( empty( $one_option['default'] ) ){
                $one_option['default'] = '';
            }

            $one_option['default'] =  str_replace('fwdefloc/', fEnv::getImgPrevDir(), $one_option['default']);

            switch ( $one_option['type'] ) {

                case 'header':
                    $this->_formItemHeader($one_option);
                    break;

                case 'checkbox':
                    $this->_formItemCheckBox($instance, $one_option);
                    break;

                case 'select-wp-custom-menu':
                    $one_option['values'] = $this->_getNavMenus();
                    $this->_formItemSelect($instance, $one_option);
                    break;

                case 'select-wp-category':
                    $one_option['values'] = $this->_getCategories($one_option);
                    $this->_formItemSelect($instance, $one_option);
                    break;

                case 'select-wp-tag':
                    $one_option['values'] = $this->_getTags($one_option);
                    $this->_formItemSelect($instance, $one_option);
                    break;

                case 'select':
                    $this->_formItemSelect($instance, $one_option);
                    break;

                case 'textarea':
                    $this->_formItemTextArea($instance, $one_option);
                    break;

                case 'smallarea':
                    $this->_formItemSmallArea($instance, $one_option);
                    break;

                case 'text':
                default:
                    $this->_formItemText($instance, $one_option);
                    break;
            }
        }
    }

    protected function _getOptionsFromLoop($options, $index){
        foreach ($options as $opIndex=>$option) {
            foreach ($option as $key=>$value) {
                $options[ $opIndex ][ $key ] = str_replace("%i%", $index, $value);
            }
        }
        return $options;
    }

    protected function _updateLoopOptions(){
        $newOptions = array();
        
        foreach( $this->options as $data ) {
            if( 'loop' == $data['type']){
                for( $index = 1; $index <= $data['count']; $index ++ ){
                    foreach( $this->_getOptionsFromLoop( $data['looptions'], $index ) as $loopdata) {
                        $newOptions[] = $loopdata;
                    }
                }
            }else{
                $newOptions[] = $data;
            }
        }
        
        $this->options = $newOptions;


    }

    public function getOptions() {
        return $this->options;
    }

    public function widget($args, $instance){
        $args['before_widget'] = str_replace(self::ADD_CLASS, $this->_widgetWrapperClasses, $args['before_widget'] );
        
        $args['before_widget'] = str_replace(self::ADD_CLASS, '', $args['before_widget'] );
        $this->_widget($args, $instance);
    }
}

