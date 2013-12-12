<?php
  
class dataInstallTags{

    public $structure;
    public $ids = array();

    function addToWP(){
        foreach( $this->structure as $key=>$settings) {
            $tag_ID = wp_create_term( $settings['title'], 'post_tag');
            $this->ids[ $settings['title'] ] = (int) $tag_ID['term_id'];
        }
    }

    function __construct(){
        $this->structure = array();
        $this->structure[] = array('title' => 'Art');
        $this->structure[] = array('title' => 'Branding');
        $this->structure[] = array('title' => 'Development');
        $this->structure[] = array('title' => 'HTML5');
        $this->structure[] = array('title' => 'Illustration');
        $this->structure[] = array('title' => 'Marketing');
        $this->structure[] = array('title' => 'Motion');
        $this->structure[] = array('title' => 'Music');
        $this->structure[] = array('title' => 'PHP');
        $this->structure[] = array('title' => 'Web Design');
        $this->structure[] = array('title' => 'Web studio');
    }
}
