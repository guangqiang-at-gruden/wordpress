<?php
  
class ffInstallBasic{

    private function _updateGenOptions(){
        global $wpdb;

        // CHECKING OLD DB TABLE VERSION

        $SQL = "SELECT * FROM `".$wpdb->prefix."gen_options` LIMIT 0 , 1";
        $res = mysql_query( $SQL );
        $row = mysql_fetch_array( $res );
        if( !empty($row['id']) ){
            return;
        }

        // SELECT ALL DUPLICIT ROWS
        
        $SQL = "SELECT * FROM (
                    SELECT  `namespace` ,  `name` , COUNT(  `namespace` +  '---' +  `name` ) AS cnt
                    FROM  `".$wpdb->prefix."gen_options`
                    GROUP BY  `namespace` ,  `name`
                ) AS derived
                WHERE derived.cnt > 1";

        $res = mysql_query( $SQL );
        
        // DELETE ALL DUPLICIT ROWS

        while( $row = mysql_fetch_array( $res ) ){
            $SQL = "DELETE
                    FROM `".$wpdb->prefix."gen_options`
                    WHERE `namespace` = '".$row['namespace']."'
                    AND `name` = '".$row['name']."'
                    LIMIT ".($row['cnt']-1);
            //echo "<pre>$SQL\n\n</pre>";
            mysql_query( $SQL );
         }
         
         // INSERTING UNIQUE KEY
         
         $SQL = "ALTER TABLE `".$wpdb->prefix."gen_options` ADD UNIQUE ( `namespace` , `name` )";
         mysql_query( $SQL );
         
         $SQL = "ALTER TABLE `".$wpdb->prefix."gen_options` ADD  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";
         mysql_query( $SQL );
    }

    private function _createHomepage() {
        $firstPostName = 'First Homepage Page After Installation';
        if( get_page_by_title($firstPostName) == null ) {
            $my_post = array(
                'post_title'    => $firstPostName,
                'post_content'  => '[templatebuilder name="aboutus"]',
                'post_status'   => 'publish',
                'post_author'   => 1,
                'post_type'     => 'page'
            );

            // Insert the post into the database
            $pageId = wp_insert_post( $my_post );
            fOpt::Set('homepage', 'content-page', $pageId );
        }
    }

    function install(){
        self::_updateGenOptions();

        if( fOpt::Get('basicinstall', 'pagebuilder' ) ){
            ;
        }else{
            require_once dirname(dirname( __FILE__ )) . '/options/installPB-basic.php';
            ffPBbasicOptionsInstall::install();
            fOpt::Set('basicinstall', 'pagebuilder', 1 );
        }

        self::_createHomepage();

        require_once dirname(dirname( __FILE__ )) . '/revslider/install.php';
        revsliderInstall::addDefaultSliders();
    }

    function init(){
        if( ! empty($_GET['run_basic_install']) ){
            self::install();
            return;
        }
        if( ( 'finished' != fOpt::Get('basicinstall', 'plugins' ) ) and ( 'aborted' != fOpt::Get('basicinstall', 'plugins' ) ) ) {
            self::install();
        }
    }
}