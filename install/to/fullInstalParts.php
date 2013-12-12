<?php
  
class fullInstalParts{
    protected $last_function = 'options';

    protected $steps = array(
        'images'      => 'Images',
        'categories'  => 'Categories',
        'tags'        => 'Tags',
        'tax_metas'   => 'Settings for tags and categories',
        'posts'       => 'Posts',
        'pages'       => 'Pages',
        'portfolio'   => 'Portfolio items',
        'wpcf7_contact_form' => 'Contact forms',
        'post_metas'  => 'Settings for posts, pages, portfolio items',
        'menu1'       => 'Blog Side Menu',
        'menu2'       => 'FAQ Menu',
        'menu3'       => 'Footer Menu',
        'menu4'       => 'Navigation Menu',
        'widgets'     => 'Widgets',
        'pagebuilder' => 'Template builder items',
        'options'     => 'Settings and options',
        //*/
    );
    
    function __construct(){
        $this->includeRequiredScripts();
        $this->printInfo();
    }
    
    function printInfo(){

        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

        readfile( dirname(__FILE__) . '/iframe_template.htm' );

        $installed = 1 * fOpt::Get('fullthemeinstall', $this->last_function );

        $ready_before = 1;

        if( empty($installed) ){
            global $_GET;
            if( empty($_GET['installation']) ){

                $ready_before = 0;

                echo '<div class="warning"><p>';
                echo 'The Full Installation is meant for <strong>empty sites only</strong> because it can overwrite/delete your existing content or settings. There is no going back after you install it.';
                echo '</p><p>';

                echo 'But if you are an experienced developer and are absolutely sure that you want to install the Full Installation over an existing site for whatever reason, then we suggest you <strong>backup</strong> your MySQL database before running the Full Installation.';
                echo '</p><p>';
                echo 'NOTE: We cannot be held responsible for any data loss or problems resulting from installing the Full Installation over an existing site.';
                echo '</p></div>';

                echo '<a href="./themeInstall.php?installation=1" class="button">Install Full Demo Installation</a>';

            }else{
                echo '<div class="warning"><p>DO NOT leave this page until the installation has finished.</p></div>';
            }
        }

        $installFunction = '';

        foreach ($this->steps as $function => $description ) {
            $installed = 1 * fOpt::Get('fullthemeinstall', $function );

            if( $installed ){
                echo "<p class=ready>$description</p>";
            }else{
                if( $ready_before ){
                    echo "<p class=activating>$description</p>";
                    $ready_before = 0;
                    $installFunction = $function;
                }else{
                    echo "<p class=not_ready>$description</p>";
                }
            }
        }

        echo "\n";
        echo str_repeat(" ", 20480);
        echo "\n";

        if( empty( $installFunction ) ){
            //echo 'all installed';
        }else{
            ob_start();

            $time = $this->microtime_float();

            $this->$installFunction();

            $time = $this->microtime_float() - $time;

            $ob = ob_get_contents();
            ob_end_clean();
            
            //echo '<p>It takes '.$time.' ms.</p>';

            if( empty( $ob ) ) {
                echo '<script>location.reload()</script>';
            }else{
                echo '<h1>Something WRONG ^$@#@^#^!#</h1>';
                echo $ob;
            }
        }
        
        echo '</body></html>';
    }
    
    function includeRequiredScripts(){

        //images

        require_once ABSPATH . '/wp-admin/includes/media.php';
        require_once ABSPATH . '/wp-admin/includes/file.php';
        require_once ABSPATH . '/wp-admin/includes/image.php';

        // taxonomy

        require_once ABSPATH . '/wp-admin/includes/taxonomy.php';

        // getter by title
        
        require_once dirname( dirname( __FILE__ ) ) . '/ffGetByTitle.php';
    }
    
    function microtime_float() {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

    function images(){
        require_once dirname( dirname( __FILE__ ) ) . '/data/data-images.php';
        $images = new dataInstallImages();
        $images->addToWP();
        
        fOpt::Set('fullthemeinstall', 'images', 1 );
    }

    function categories(){
        require_once dirname( dirname( __FILE__ ) ) . '/data/data-categories.php';
        $categories = new dataInstallCategories();
        $categories->addToWP();

        fOpt::Set('fullthemeinstall', 'categories', 1 );
    }

    function tags(){
        require_once dirname( dirname( __FILE__ ) ) . '/data/data-tags.php';
        $tags = new dataInstallTags();
        $tags->addToWP();

        fOpt::Set('fullthemeinstall', 'tags', 1 );
    }

    function tax_metas(){
        require_once dirname( dirname( __FILE__ ) ) . '/data/data-tax-metas.php';
        $taxmetas = new dataInstallTaxMetas( );
        $taxmetas->addToWP();

        fOpt::Set('fullthemeinstall', 'tax_metas', 1 );
    }

    function posts(){
        require_once dirname( dirname( __FILE__ ) ) . '/data/data-posts.php';
        $posts = new dataInstallPosts();
        $posts->addToWP('post');

        fOpt::Set('fullthemeinstall', 'posts', 1 );
    }

    function pages(){
        require_once dirname( dirname( __FILE__ ) ) . '/data/data-posts.php';
        $posts = new dataInstallPosts();
        $posts->addToWP('page');

        fOpt::Set('fullthemeinstall', 'pages', 1 );
    }

    function portfolio(){
        require_once dirname( dirname( __FILE__ ) ) . '/data/data-posts.php';
        $posts = new dataInstallPosts();
        $posts->addToWP('portfolio');

        fOpt::Set('fullthemeinstall', 'portfolio', 1 );
    }
    
    function wpcf7_contact_form(){
        require_once dirname( dirname( __FILE__ ) ) . '/data/data-posts.php';
        $posts = new dataInstallPosts();
        $posts->addToWP('wpcf7_contact_form');

        fOpt::Set('fullthemeinstall', 'wpcf7_contact_form', 1 );
    }

    function post_metas(){
        require_once dirname( dirname( __FILE__ ) ) . '/data/data-metas.php';
        $metas = new dataInstallMetas();
        $metas->addToWP();

        fOpt::Set('fullthemeinstall', 'post_metas', 1 );
    }

    function menu1(){
        require_once dirname( dirname( __FILE__ ) ) . '/data/data-menus.php';
        $menus = new dataInstallMenus();
        $menus->addToWP('Blog Side Menu');

        fOpt::Set('fullthemeinstall', 'menu1', 1 );
    }

    function menu2(){
        require_once dirname( dirname( __FILE__ ) ) . '/data/data-menus.php';
        $menus = new dataInstallMenus();
        $menus->addToWP('FAQ Menu');

        fOpt::Set('fullthemeinstall', 'menu2', 1 );
    }

    function menu3(){
        require_once dirname( dirname( __FILE__ ) ) . '/data/data-menus.php';
        $menus = new dataInstallMenus();
        $menus->addToWP('Footer Menu');

        fOpt::Set('fullthemeinstall', 'menu3', 1 );
    }

    function menu4(){
        require_once dirname( dirname( __FILE__ ) ) . '/data/data-menus.php';
        $menus = new dataInstallMenus();
        $menus->addToWP('Navigation');

        fOpt::Set('fullthemeinstall', 'menu4', 1 );
    }

    function widgets(){
        require_once dirname( dirname( __FILE__ ) ) . '/data/data-widgets.php';
        $widgets = new dataInstallWidgets();
        $widgets->addToWP();

        fOpt::Set('fullthemeinstall', 'widgets', 1 );
    }

    function pagebuilder(){
        require_once dirname(dirname( __FILE__ )) . '/options/installPB.php';
        ffPBOptionsInstall::defaults();

        fOpt::Set('fullthemeinstall', 'pagebuilder', 1 );
    }

    function options(){

        // Homepage

        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', ffGetByTitle::post('Blur Slider') );

        // Conecting menus

        $menus = array (
            0 => "",
            'nav_menu_locations' => array (
                'navigation' => ffGetByTitle::term('Navigation'),
                'footermenu' => ffGetByTitle::term('Footer Menu'),
            )
        );

        update_option( 'theme_mods_wiseguys', $menus );

        // Contact forms
        
        add_post_meta(
            ffGetByTitle::post( 'Contact <span class="highlight">Us</span>' ),
            'contact_form_name',
            ffGetByTitle::post( 'contact page form' ),
            TRUE // UNIQUE
        );

        // All checked

        fOpt::Set('fullthemeinstall', 'options', 1 );
    }

}