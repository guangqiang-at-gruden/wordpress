<?php
  
class dataInstall{

    function clear(){
        global $wpdb;
        $prefix = $wpdb->prefix;

        //echo "<p>CLEAR</p>"; return;

        @mysql_query( "DELETE FROM `".$prefix."gen_options` WHERE `namespace` = 'fullthemeinstall'" );

        @mysql_query( "TRUNCATE ".$prefix."commentmeta" );
        @mysql_query( "TRUNCATE ".$prefix."comments" );
        @mysql_query( "TRUNCATE ".$prefix."links" );

        @mysql_query( "TRUNCATE ".$prefix."postmeta" );
        @mysql_query( "TRUNCATE ".$prefix."posts" );
        @mysql_query( "TRUNCATE ".$prefix."term_relationships" );

        // UNCATEGORIZED FIX
        
        $sql = "SELECT * FROM ".$prefix."terms WHERE `term_id` = 1";
        if( false == ( $result = @mysql_query( $sql ) )) return;
        $row = mysql_fetch_array( $result );
        $term_1 = array( 'name'=>$row['name'], 'slug'=>$row['slug'] );


        @mysql_query( "TRUNCATE ".$prefix."term_taxonomy" );
        @mysql_query( "TRUNCATE ".$prefix."terms" );

        @mysql_query("INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`)
                      VALUES (1, 1, 'category', '', 0, 0)");

        @mysql_query("INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`)
                      VALUES (1, '".$term_1['name']."', '".$term_1['slug']."', 0)");

        add_settings_error( 'wpdata_to_clear_notice', 'wpdata_to_clear_notice',
              'All posts, pages, custom posts, tags, categories, custom taxonomies, menu items and menus, post metas and settings were removed.', 'updated' );
        settings_errors( 'wpdata_to_clear_notice' );
    }

    function install(){

        // images

        require_once ABSPATH . '/wp-admin/includes/media.php';
        require_once ABSPATH . '/wp-admin/includes/file.php';
        require_once ABSPATH . '/wp-admin/includes/image.php';

        require_once dirname(__FILE__) . '/data-images.php';
        $images = new dataInstallImages();
        $images->addToWP();

        // taxonomy

        require_once ABSPATH . '/wp-admin/includes/taxonomy.php';

        require_once dirname(__FILE__) . '/data-categories.php';
        $categories = new dataInstallCategories();
        $categories->addToWP();

        require_once dirname(__FILE__) . '/data-tags.php';
        $tags = new dataInstallTags();
        $tags->addToWP();
        
        require_once dirname(__FILE__) . '/data-tax-metas.php';
        $taxmetas = new dataInstallTaxMetas( );
        $taxmetas->addToWP();

        // post types

        require_once dirname(__FILE__) . '/data-posts.php';
        $posts = new dataInstallPosts();
        $posts->addToWP();

        require_once dirname(__FILE__) . '/data-metas.php';
        $metas = new dataInstallMetas();
        $metas->addToWP();

        // menus

        require_once dirname(__FILE__) . '/data-menus.php';
        $menus = new dataInstallMenus();
        $menus->addToWP();

        // widgets

        require_once dirname(__FILE__) . '/data-widgets.php';
        $widgets = new dataInstallWidgets();
        $widgets->addToWP();

        // pagebuilder

        require_once dirname(dirname( __FILE__ )) . '/options/installPB.php';
        ffPBOptionsInstall::defaults();

        // options

        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', ffGetByTitle::post('Blur Slider') );

        // show info

        add_settings_error( 'wpdata_to_install_notice', 'wpdata_to_install_notice',
              'Theme demo content was created.', 'updated' );
        settings_errors( 'wpdata_to_install_notice' );
        
    }
}