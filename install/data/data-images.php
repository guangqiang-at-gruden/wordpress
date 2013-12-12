<?php
  
class dataInstallImages{

    public $structure;
    public $ids = array();

    function addToWP(){
        foreach( $this->structure as $key=>$settings) {

            $id = get_page_by_title( $settings['post_title'], 'OBJECT', 'attachment' );
            if( $id ){
                ;
            }else{
                $id = $this->_media_sideload_image($settings['post_content'], 0, $settings['post_title']);
            }
            
            $this->ids[ $settings['post_title'] ] = $id;
        }

        return $this->structure;
    }

    function _media_sideload_image($file, $post_id, $desc = null) {
        if ( empty($file) ) {
            return null;
        }

        // Download file to temp location
        $tmp = download_url( $file );

        // Set variables for storage
        // fix file filename for query strings
        preg_match( '/[^\?]+\.(jpe?g|jpe|gif|png)\b/i', $file, $matches );
        $file_array['name'] = basename($matches[0]);
        $file_array['tmp_name'] = $tmp;

        // If error storing temporarily, unlink
        if ( is_wp_error( $tmp ) ) {
          @unlink($file_array['tmp_name']);
          $file_array['tmp_name'] = '';
        }

        // do the validation and storage stuff
        $id = media_handle_sideload( $file_array, $post_id, $desc );
        // If error storing permanently, unlink
        if ( is_wp_error($id) ) {
          @unlink($file_array['tmp_name']);
          return $id;
        }
        
        return $id;
    }

    function __construct(){

        $this->structure = array();
        $this->structure[] = array(
            'post_title'    => 'Placeholder #1',
            'post_content'  => get_template_directory_uri().'/install/images/1.jpg',
        );

        $this->structure[] = array(
            'post_title'    => 'Placeholder #2',
            'post_content'  => get_template_directory_uri().'/install/images/2.jpg',
        );

        $this->structure[] = array(
            'post_title'    => 'Placeholder #3',
            'post_content'  => get_template_directory_uri().'/install/images/3.jpg',
        );

    }
}