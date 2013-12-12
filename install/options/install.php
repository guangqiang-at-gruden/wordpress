<?php
  
class ffOptionsInstall{

    function replace($content){
        global $wpdb;
        $prefix = $wpdb->prefix;
        $tablename = $prefix.'gen_options';

        $to_replace = array();
        $replace_with = array();

        $to_replace[]   = 'XXXTEMPLATEURLXXX';
        $replace_with[] = get_template_directory_uri();

        $to_replace[]   = 'XXXTABLENAMEXXX';
        $replace_with[] = $tablename;

        $content = str_replace( $to_replace, $replace_with, $content);

        return $content;
    }

    function runSQLfromFile( $file_path ){
        $content = file_get_contents($file_path);
        $content = ffOptionsInstall::replace($content);
        mysql_query( $content );
    }
    
    function defaults(){
        ffOptionsInstall::runSQLfromFile( dirname(__FILE__).'/data/tables.frs' );
        ffOptionsInstall::runSQLfromFile( dirname(__FILE__).'/data/db_all_default.frs' );
        ffOptionsInstall::runSQLfromFile( dirname(__FILE__).'/data/db_sidebars.frs' );
    }
}