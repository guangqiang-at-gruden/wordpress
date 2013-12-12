<?php
  
class dataInstallCategories{

    public $structure;
    public $ids = array();

    function addToWP(){
        $this->addToWPRecursive( 0, $this->structure );
        return $this->structure;
    }
    
    function addToWPRecursive( $parent, &$structure ){
        foreach( $structure as $key=>$settings) {
            $cat_ID = wp_create_term( $settings['title'], 'category');
            $this->ids[ $settings['title'] ] = (int) $cat_ID['term_id'];

            $structure[$key]['ID'] = $cat_ID;
            $structure[$key]['parent'] = $parent;

            if( isSet($structure[$key]['items']) ){
                $this->addToWPRecursive( $cat_ID, $structure[$key]['items'] );
            }
        }
    }

    function __construct(){
        $this->structure = array();
        $this->structure['Blog'] = array(
            'title' => 'Blog',
            'items' => array(
                'Blog Large' => array( 'title' => 'Blog Large', ),
                'Blog Medium' => array( 'title' => 'Blog Medium', ),
            ),
        );
        $this->structure['Featured Blog Posts'] = array(
            'title' => 'Featured Blog Posts',
        );
        $this->structure['Portfolio'] = array(
            'title' => 'Portfolio',
            'items' => array(
                'Portfolio Filterable 3' => array( 'title' => 'Portfolio Filterable 3', ),
                'Portfolio Filterable 4' => array( 'title' => 'Portfolio Filterable 4', ),
                'Portfolio Filterable 5' => array( 'title' => 'Portfolio Filterable 5', ),
                'Portfolio Pagination 3' => array( 'title' => 'Portfolio Pagination 3', ),
                'Portfolio Pagination 4' => array( 'title' => 'Portfolio Pagination 4', ),
                'Portfolio Pagination 5' => array( 'title' => 'Portfolio Pagination 5', ),
            ),
        );
        $this->structure['Portfolio Single'] = array(
            'title' => 'Portfolio Single',
        );
    }
}
