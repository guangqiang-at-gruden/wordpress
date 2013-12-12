<?php
  
class dataInstallWidgets{

    public $structure;
    public $widgets;

    function addToWP(){

        global $wpdb;
        $prefix = $wpdb->prefix;

        self::clearWidgets();
        
        $value = serialize( $this->widgets );

        $SQL = $wpdb->prepare(
            " INSERT INTO ".$wpdb->options."
              (`option_name`, `option_value`, `autoload`)
              VALUES
              ('sidebars_widgets', %s, 'yes')",
              $value
        );

        mysql_query( $SQL );
        
        foreach ($this->structure as $name=>$value) {
            $value = serialize( $value );

            $SQL = $wpdb->prepare(
                " INSERT INTO ".$wpdb->options."
                  (`option_name`, `option_value`, `autoload`)
                  VALUES
                  (%s, %s, 'yes')",
                  $name, $value
            );

            mysql_query( $SQL );
        }
    }
    
    function clearWidgets(){
        global $wpdb;
        $prefix = $wpdb->prefix;

        $SQL = "DELETE FROM ".$wpdb->options." WHERE `option_name` LIKE 'widget_%'";
        mysql_query( $SQL );

        $SQL = "DELETE FROM ".$wpdb->options." WHERE `option_name` = 'sidebars_widgets'";
        mysql_query( $SQL );
    }
    
    function __construct(){
        $this->structure = array (


              'widget_archives' => array (
                    2 => array (
                      'title' => '',
                      'count' => 0,
                      'dropdown' => 0,
                    ),
                    '_multiwidget' => 1,
              ),


              'widget_categories' => array (
                    2 => array (
                      'title' => '',
                      'count' => 0,
                      'hierarchical' => 0,
                      'dropdown' => 0,
                    ),
                    '_multiwidget' => 1,
              ),


              'widget_ffaccordeon' => array (
                    2 => array (
                        'title' => 'ABOUT US',
                        '' => '',
                        'section_title_1' => 'Web development',
                        'section_text_1' => 'Lorem ipsum dolor sit amet, consect adipiscing elit. Pellentesque semanti nibh, laoreet sed convallis vel, mauri euismod vitae nulla velit abis ent au.',
                        'section_title_2' => 'Audio processing',
                        'section_text_2' => 'Maecenas at viverra ante. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam tristique sollicitudin eleifend. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec id urna vitae nunc rutrum convallis sit amet vel elit.',
                        'section_title_3' => 'Branding and advertising',
                        'section_text_3' => 'Sed bibendum pretium condimentum. Donec ac justo eros. Vestibulum et tortor lectus, vel vestibulum sem. Nullam at leo enim. Aenean vel felis vel ante adipiscing luctus laoreet eget mi.',
                        'section_title_4' => '',
                        'section_text_4' => '',
                        'section_title_5' => '',
                        'section_text_5' => '',
                    ),
                    '_multiwidget' => 1,
              ),


              'widget_ffcategories' => array (
                    2 => array (
                      'title' => 'CATEGORIES',
                      'type' => 'custom',
                      'custom_menu' => ffGetByTitle::term('Blog Side Menu'),
                      'category' => '0',
                    ),
                    '_multiwidget' => 1,
              ),


              'widget_ffcontactbydepartment' => array (
                    2 => array (
                      'title' => 'CONTACT BY DEPARTMENT',
                      '' => '',
                      'person_name_1' => 'Jessica Donovan',
                      'person_link_1' => '#',
                      'person_position_1' => 'management',
                      'person_name_2' => 'Michael Thompson',
                      'person_link_2' => '#',
                      'person_position_2' => 'development',
                      'person_name_3' => 'Jennifer Taylor',
                      'person_link_3' => '#',
                      'person_position_3' => 'finance',
                      'person_name_4' => '',
                      'person_link_4' => '',
                      'person_position_4' => '',
                      'person_name_5' => '',
                      'person_link_5' => '',
                      'person_position_5' => '',
                    ),
                    '_multiwidget' => 1,
              ),


              'widget_ffcontactdetails' => array (
                    2 => array (
                      'title' => 'CONTACT DETAILS',
                      'title_address' => 'Address',
                      'address' => 'Wise Guys Inc.'."\n".'25 Sunset Blvd. CA, 935, U.S.A.',
                      'title_phone' => 'Phone',
                      'phone' => '0034 556.445.623'."\n".'0034 558.436.221',
                      'title_email' => 'Email',
                      'email' => 'office@wiseguys.com',
                    ),
                    '_multiwidget' => 1,
              ),


              'widget_ffgetintouch' => array (
                    2 => array (
                      'title' => 'GET IN TOUCH',
                      'address' => '25 Sunset Blvd. CA, 935',
                      'phone' => '0034 556.445.623',
                      'mail' => 'office@freshface.com',
                      'social' => 'http://www.vimeo.com/'."\n".'http://www.facebook.com/'."\n".'http://www.linkedin.com/'."\n".'http://www.twitter.com/'."\n".'http://www.pinterest.com/',
                    ),
                    '_multiwidget' => 1,
              ),


              'widget_fflatestworks' => array (
                    2 => array (
                      'title' => 'FEATURED WORKS',
                      'count' => '3',
                      'type' => 'category',
                      'tag' => '0',
                      'category' => ffGetByTitle::term('Portfolio Filterable 5'),
                    ),
                    3 => array (
                      'title' => 'LATEST WORK',
                      'count' => '6',
                      'type' => 'category',
                      'tag' => '0',
                      'category' => ffGetByTitle::term('Portfolio Filterable 5'),
                    ),
                    '_multiwidget' => 1,
              ),


              'widget_ffsidemenu' => array (
                    2 => array (
                      'title' => '',
                      'custom_menu' => ffGetByTitle::term('Blog Side Menu'),
                    ),
                    3 => array (
                      'title' => '',
                      'custom_menu' => ffGetByTitle::term('Blog Side Menu'),
                    ),
                    4 => array (
                      'title' => '',
                      'custom_menu' => ffGetByTitle::term('Blog Side Menu'),
                    ),
                    '_multiwidget' => 1,
              ),



              'widget_fftabposts' => array (
                    5 => array (
                      'title' => 'MORE POSTS',
                      '' => '',
                      'popular_show' => 1,
                      'popular_title' => 'Popular',
                      'popular_categories' => ffGetByTitle::term('Blog Medium'),
                      'popular_num_of_posts' => '3',
                      'recent_show' => 1,
                      'recent_title' => 'Recent',
                      'recent_categories' => ffGetByTitle::term('Blog Medium'),
                      'recent_num_of_posts' => '3',
                    ),
                    '_multiwidget' => 1,
              ),



              'widget_fftestimonial' => array (
                    2 => array (
                      'title' => 'TESTIMONIALS',
                      'autoplay' => 'true',
                      'autodelay' => '3000',
                      '' => '',
                      'section_author_1' => 'John C. William',
                      'section_job_1' => 'manager at Domus Inc.',
                      'section_testimonial_1' => 'This is by far the best theme I ever got, all those features are just amazing, couldn\'t be happier.',
                      'section_author_2' => 'Chris Watson',
                      'section_job_2' => 'designer at FarDesign',
                      'section_testimonial_2' => 'I bought this for one of my clients and he was extremely happy with it, very flexible and customizable.',
                      'section_author_3' => 'Greg Johnson',
                      'section_job_3' => 'motion designer',
                      'section_testimonial_3' => 'Man this theme rocks, bought to showcase my video portfolio, very stylish and modern, kudos.',
                      'section_author_4' => 'Victoria Beneton',
                      'section_job_4' => 'freelance photographer',
                      'section_testimonial_4' => 'Bravo, well done. A stylish, unique theme, with lots of features and options, what more could I want.',
                    ),
                    3 => array (
                      'title' => 'TESTIMONIALS',
                      'autoplay' => 'false',
                      'autodelay' => '3000',
                      '' => '',
                      'section_author_1' => 'John C. William',
                      'section_job_1' => 'manager at Domus Inc.',
                      'section_testimonial_1' => 'This is by far the best theme I ever got, all those features are just amazing, couldn\'t be happier.',
                      'section_author_2' => 'Chris Watson',
                      'section_job_2' => 'designer at FarDesign',
                      'section_testimonial_2' => 'I bought this for one of my clients and he was extremely happy with it, very flexible and customizable.',
                      'section_author_3' => 'Greg Johnson',
                      'section_job_3' => 'motion designer',
                      'section_testimonial_3' => 'Man this theme rocks, bought to showcase my video portfolio, very stylish and modern, kudos.',
                      'section_author_4' => 'Victoria Beneton',
                      'section_job_4' => 'freelance photographer',
                      'section_testimonial_4' => 'Bravo, well done. A stylish, unique theme , with lots of features and options, what more could I want.',
                    ),
                    '_multiwidget' => 1,
              ),

              'widget_fftwitter' => array (
                    2 => array (
                      'title' => 'LATEST TWEETS',
                      'username' => 'WiseGuysThemes',
                      'number' => '2',
                    ),
                    3 => array (
                      'title' => 'LATEST TWEETS',
                      'username' => 'WiseGuysThemes',
                      'number' => '2',
                    ),
                    '_multiwidget' => 1,
              ),
              


              'widget_mailchimpsf_widget' => array (
                    3 => array (
                    ),
                    '_multiwidget' => 1,
              ),



              'widget_meta' => array (
                    2 => array (
                      'title' => '',
                    ),
                    '_multiwidget' => 1,
              ),



              'widget_nav_menu' => array (
                    2 => array (
                      'title' => 'ABOUT WISEGUYS',
                      'nav_menu' =>  ffGetByTitle::term('Blog Side Menu'),
                    ),
                    '_multiwidget' => 1,
              ),



              'widget_recent-comments' => array (
                    2 => array (
                      'title' => '',
                      'number' => 5,
                    ),
                    '_multiwidget' => 1,
              ),


              'widget_recent-posts' => array (
                    2 => array (
                      'title' => '',
                      'number' => 5,
                    ),
                    '_multiwidget' => 1,
              ),



              'widget_rss' => array ( ),


              'widget_search' => array (
                    2 => array (
                      'title' => '',
                    ),
                    3 => array (
                      'title' => '',
                    ),
                    '_multiwidget' => 1,
              ),



              'widget_tag_cloud' => array (
                    2 => array (
                      'title' => 'tc',
                      'taxonomy' => 'post_tag',
                    ),
                    '_multiwidget' => 1,
              ),


              'widget_text' => array (
                    2 => array (
                      'title' => 'OUR PROMISE',
                      'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam euismod, massa et aliquet feugiat, enim felis ultri mauris, nec iaculis nisi nunc a lacus. Quisque molestie sodales enim non congue.',
                      'filter' => false,
                    ),
                    3 => array (
                      'title' => 'TEXT WIDGET',
                      'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam euismod, massa et aliquet feugiat, enim felis ultri mauris, nec iaculis nisi nunc a lacus. Quisque molestie sodales enim non congue.',
                      'filter' => false,
                    ),
                    4 => array (
                      'title' => '',
                      'text' => '<a href="http://demo.freshface.net/file/wgc/wp/"><div class="footerLogo"></div></a>'."\n".'<p>Donec consectetur, diam sed ullamcorp sagittis, augue leo rhoncus dui, ac faris egestas felis lectus at neque. Curabitur sit amet libero risus, at ultricies urnali. Nunci justo nisi, suscipit sodales ornare. Lorem ipsum dolor sit amet, mauris et fusce teni dasitiri un qual cosa fenettis.</p>',
                      'filter' => false,
                    ),
                    '_multiwidget' => 1,
              ),
        ); // $this->structure = array (



        $this->widgets = array (
              'wp_inactive_widgets' => array (
                0 => 'ffsidemenu-2',
              ),
              'wiseguys-global' => array (
                0 => 'search-2',
                1 => 'recent-posts-2',
                2 => 'recent-comments-2',
                3 => 'archives-2',
                4 => 'meta-2',
              ),
              'wiseguys-home' => array ( ),
              'wiseguys-blog' => array (
                0 => 'search-3',
                1 => 'ffcategories-2',
                2 => 'fflatestworks-3',
                3 => 'text-3',
                4 => 'fftestimonial-3',
                5 => 'ffaccordeon-2',
                6 => 'fftwitter-2',
                7 => 'fftabposts-5',
              ),
              'wiseguys-blog-single' => array ( ),
              'wiseguys-portfolio-single' => array (
                0 => 'text-2',
                1 => 'fflatestworks-2',
                2 => 'fftestimonial-2',
              ),
              'wiseguys-page' => array ( ),
              'wiseguys-page-contact' => array (
                0 => 'ffcontactdetails-2',
                1 => 'ffcontactbydepartment-2',
              ),
              'wiseguys-search' => array (
                0 => 'tag_cloud-2',
              ),
              'wiseguys-footer-1' => array (
                0 => 'text-4',
              ),
              'wiseguys-footer-2' => array (
                0 => 'ffgetintouch-2',
                1 => 'mailchimpsf_widget-3',
              ),
              'wiseguys-footer-3' => array (
                0 => 'nav_menu-2',
              ),
              'wiseguys-footer-4' => array (
                0 => 'fftwitter-3',
              ),
              'wiseguyscustom5' => array (
                0 => 'ffsidemenu-3',
              ),
              'wiseguyscustom1' => array (
                0 => 'ffsidemenu-4',
              ),
              'array_version' => 3,
        ); // $this->widgets = array (
    }
}

/*

$wp_options = array(
  array('name'=>'widget_archives','value'=>'a:2:{i:2;a:3:{s:5:"title";s:0:"";s:5:"count";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}'),
  array('name'=>'widget_categories','value'=>'a:2:{i:2;a:4:{s:5:"title";s:0:"";s:5:"count";i:0;s:12:"hierarchical";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}'),
  array('name'=>'widget_ffaccordeon','value'=>'a:2:{i:2;a:12:{s:5:"title";s:8:"ABOUT US";s:0:"";s:0:"";s:15:"section_title_1";s:15:"Web development";s:14:"section_text_1";s:151:"Lorem ipsum dolor sit amet, consect adipiscing elit. Pellentesque semanti nibh, laoreet sed convallis vel, mauri euismod vitae nulla velit abis ent au.";s:15:"section_title_2";s:16:"Audio processing";s:14:"section_text_2";s:309:"Maecenas at viverra ante. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam tristique sollicitudin eleifend. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec id urna vitae nunc rutrum convallis sit amet vel elit.";s:15:"section_title_3";s:24:"Branding and advertising";s:14:"section_text_3";s:184:"Sed bibendum pretium condimentum. Donec ac justo eros. Vestibulum et tortor lectus, vel vestibulum sem. Nullam at leo enim. Aenean vel felis vel ante adipiscing luctus laoreet eget mi.";s:15:"section_title_4";s:0:"";s:14:"section_text_4";s:0:"";s:15:"section_title_5";s:0:"";s:14:"section_text_5";s:0:"";}s:12:"_multiwidget";i:1;}'),
  array('name'=>'widget_ffcategories','value'=>'a:2:{i:2;a:4:{s:5:"title";s:10:"CATEGORIES";s:4:"type";s:6:"custom";s:11:"custom_menu";s:2:"18";s:8:"category";s:2:"19";}s:12:"_multiwidget";i:1;}'),
  array('name'=>'widget_ffcontactbydepartment','value'=>'a:2:{i:2;a:17:{s:5:"title";s:21:"CONTACT BY DEPARTMENT";s:0:"";s:0:"";s:13:"person_name_1";s:15:"Jessica Donovan";s:13:"person_link_1";s:1:"#";s:17:"person_position_1";s:10:"management";s:13:"person_name_2";s:16:"Michael Thompson";s:13:"person_link_2";s:1:"#";s:17:"person_position_2";s:11:"development";s:13:"person_name_3";s:15:"Jennifer Taylor";s:13:"person_link_3";s:1:"#";s:17:"person_position_3";s:7:"finance";s:13:"person_name_4";s:0:"";s:13:"person_link_4";s:0:"";s:17:"person_position_4";s:0:"";s:13:"person_name_5";s:0:"";s:13:"person_link_5";s:0:"";s:17:"person_position_5";s:0:"";}s:12:"_multiwidget";i:1;}'),
  array('name'=>'widget_ffcontactdetails','value'=>'a:2:{i:2;a:7:{s:5:"title";s:15:"CONTACT DETAILS";s:13:"title_address";s:7:"Address";s:7:"address";s:47:"Wise Guys Inc.
25 Sunset Blvd. CA, 935, U.S.A.";s:11:"title_phone";s:5:"Phone";s:5:"phone";s:34:"0034 556.445.623
0034 558.436.221";s:11:"title_email";s:5:"Email";s:5:"email";s:19:"office@wiseguys.com";}s:12:"_multiwidget";i:1;}'),
  array('name'=>'widget_ffgetintouch','value'=>'a:2:{i:2;a:5:{s:5:"title";s:12:"GET IN TOUCH";s:7:"address";s:23:"25 Sunset Blvd. CA, 935";s:5:"phone";s:16:"0034 556.445.623";s:4:"mail";s:20:"office@freshface.com";s:6:"social";s:125:"http://www.vimeo.com/
http://www.facebook.com/
http://www.linkedin.com/
http://www.twitter.com/
http://www.pinterest.com/";}s:12:"_multiwidget";i:1;}'),
  array('name'=>'widget_fflatestworks','value'=>'a:3:{i:2;a:5:{s:5:"title";s:14:"FEATURED WORKS";s:5:"count";s:1:"3";s:4:"type";s:8:"category";s:3:"tag";s:1:"5";s:8:"category";s:1:"9";}i:3;a:5:{s:5:"title";s:11:"LATEST WORK";s:5:"count";s:1:"6";s:4:"type";s:8:"category";s:3:"tag";s:1:"0";s:8:"category";s:2:"12";}s:12:"_multiwidget";i:1;}'),
  array('name'=>'widget_ffsidemenu','value'=>'a:4:{i:2;a:2:{s:5:"title";s:2:"aa";s:11:"custom_menu";s:1:"2";}i:3;a:2:{s:5:"title";s:0:"";s:11:"custom_menu";s:1:"3";}i:4;a:2:{s:5:"title";s:0:"";s:11:"custom_menu";s:1:"3";}s:12:"_multiwidget";i:1;}'),
  array('name'=>'widget_fftabposts','value'=>'a:2:{i:5;a:10:{s:5:"title";s:10:"MORE POSTS";s:0:"";s:0:"";s:12:"popular_show";i:1;s:13:"popular_title";s:7:"Popular";s:18:"popular_categories";s:2:"17";s:20:"popular_num_of_posts";s:1:"3";s:11:"recent_show";i:1;s:12:"recent_title";s:6:"Recent";s:17:"recent_categories";s:2:"12";s:19:"recent_num_of_posts";s:1:"3";}s:12:"_multiwidget";i:1;}'),
  array('name'=>'widget_fftestimonial','value'=>'a:3:{i:2;a:16:{s:5:"title";s:12:"TESTIMONIALS";s:8:"autoplay";s:4:"true";s:9:"autodelay";s:4:"3000";s:0:"";s:0:"";s:16:"section_author_1";s:15:"John C. William";s:13:"section_job_1";s:21:"manager at Domus Inc.";s:21:"section_testimonial_1";s:99:"This is by far the best theme I ever got, all those features are just amazing, couldn\'t be happier.";s:16:"section_author_2";s:12:"Chris Watson";s:13:"section_job_2";s:21:"designer at FarDesign";s:21:"section_testimonial_2";s:103:"I bought this for one of my clients and he was extremely happy with it, very flexible and customizable.";s:16:"section_author_3";s:12:"Greg Johnson";s:13:"section_job_3";s:15:"motion designer";s:21:"section_testimonial_3";s:92:"Man this theme rocks, bought to showcase my video portfolio, very stylish and modern, kudos.";s:16:"section_author_4";s:16:"Victoria Beneton";s:13:"section_job_4";s:22:"freelance photographer";s:21:"section_testimonial_4";s:101:"Bravo, well done. A stylish, unique theme, with lots of features and options, what more could I want.";}i:3;a:16:{s:5:"title";s:12:"TESTIMONIALS";s:8:"autoplay";s:5:"false";s:9:"autodelay";s:4:"3000";s:0:"";s:0:"";s:16:"section_author_1";s:15:"John C. William";s:13:"section_job_1";s:21:"manager at Domus Inc.";s:21:"section_testimonial_1";s:99:"This is by far the best theme I ever got, all those features are just amazing, couldn\'t be happier.";s:16:"section_author_2";s:12:"Chris Watson";s:13:"section_job_2";s:21:"designer at FarDesign";s:21:"section_testimonial_2";s:103:"I bought this for one of my clients and he was extremely happy with it, very flexible and customizable.";s:16:"section_author_3";s:12:"Greg Johnson";s:13:"section_job_3";s:15:"motion designer";s:21:"section_testimonial_3";s:92:"Man this theme rocks, bought to showcase my video portfolio, very stylish and modern, kudos.";s:16:"section_author_4";s:16:"Victoria Beneton";s:13:"section_job_4";s:22:"freelance photographer";s:21:"section_testimonial_4";s:102:"Bravo, well done. A stylish, unique theme , with lots of features and options, what more could I want.";}s:12:"_multiwidget";i:1;}'),
  array('name'=>'widget_fftwitter','value'=>'a:3:{i:2;a:3:{s:5:"title";s:13:"LATEST TWEETS";s:8:"username";s:14:"WiseGuysThemes";s:6:"number";s:1:"2";}i:3;a:3:{s:5:"title";s:13:"LATEST TWEETS";s:8:"username";s:14:"WiseGuysThemes";s:6:"number";s:1:"2";}s:12:"_multiwidget";i:1;}'),
  array('name'=>'widget_mailchimpsf_widget','value'=>'a:2:{i:3;a:0:{}s:12:"_multiwidget";i:1;}'),
  array('name'=>'widget_meta','value'=>'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}'),
  array('name'=>'widget_nav_menu','value'=>'a:2:{i:2;a:2:{s:5:"title";s:14:"ABOUT WISEGUYS";s:8:"nav_menu";i:18;}s:12:"_multiwidget";i:1;}'),
  array('name'=>'widget_recent-comments','value'=>'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}'),
  array('name'=>'widget_recent-posts','value'=>'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}'),
  array('name'=>'widget_rss','value'=>'a:0:{}'),
  array('name'=>'widget_search','value'=>'a:3:{i:2;a:1:{s:5:"title";s:0:"";}i:3;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}'),
  array('name'=>'widget_tag_cloud','value'=>'a:2:{i:2;a:2:{s:5:"title";s:2:"tc";s:8:"taxonomy";s:8:"post_tag";}s:12:"_multiwidget";i:1;}'),
  array('name'=>'widget_text','value'=>'a:4:{i:2;a:3:{s:5:"title";s:11:"OUR PROMISE";s:4:"text";s:193:"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam euismod, massa et aliquet feugiat, enim felis ultri mauris, nec iaculis nisi nunc a lacus. Quisque molestie sodales enim non congue.";s:6:"filter";b:0;}i:3;a:3:{s:5:"title";s:11:"TEXT WIDGET";s:4:"text";s:193:"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam euismod, massa et aliquet feugiat, enim felis ultri mauris, nec iaculis nisi nunc a lacus. Quisque molestie sodales enim non congue.";s:6:"filter";b:0;}i:4;a:3:{s:5:"title";s:0:"";s:4:"text";s:380:"<a href="http://demo.freshface.net/file/wgc/wp/"><div class="footerLogo"></div></a>
<p>Donec consectetur, diam sed ullamcorp sagittis, augue leo rhoncus dui, ac faris egestas felis lectus at neque. Curabitur sit amet libero risus, at ultricies urnali. Nunci justo nisi, suscipit sodales ornare. Lorem ipsum dolor sit amet, mauris et fusce teni dasitiri un qual cosa fenettis.</p>";s:6:"filter";b:0;}s:12:"_multiwidget";i:1;}')
);

$widgets = array();
foreach ($wp_options as $key=>$data) {
    $widgets[ $data['name'] ] = unserialize($data['value']);
}

echo var_export($widgets);

*/


/*
$sidebars_widgets = 'a:16:{s:19:"wp_inactive_widgets";a:1:{i:0;s:12:"ffsidemenu-2";}s:15:"wiseguys-global";a:5:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:6:"meta-2";}s:13:"wiseguys-home";a:0:{}s:13:"wiseguys-blog";a:8:{i:0;s:8:"search-3";i:1;s:14:"ffcategories-2";i:2;s:15:"fflatestworks-3";i:3;s:6:"text-3";i:4;s:15:"fftestimonial-3";i:5;s:13:"ffaccordeon-2";i:6;s:11:"fftwitter-2";i:7;s:12:"fftabposts-5";}s:20:"wiseguys-blog-single";a:0:{}s:25:"wiseguys-portfolio-single";a:3:{i:0;s:6:"text-2";i:1;s:15:"fflatestworks-2";i:2;s:15:"fftestimonial-2";}s:13:"wiseguys-page";a:0:{}s:21:"wiseguys-page-contact";a:2:{i:0;s:18:"ffcontactdetails-2";i:1;s:23:"ffcontactbydepartment-2";}s:15:"wiseguys-search";a:1:{i:0;s:11:"tag_cloud-2";}s:17:"wiseguys-footer-1";a:1:{i:0;s:6:"text-4";}s:17:"wiseguys-footer-2";a:2:{i:0;s:14:"ffgetintouch-2";i:1;s:20:"mailchimpsf_widget-3";}s:17:"wiseguys-footer-3";a:1:{i:0;s:10:"nav_menu-2";}s:17:"wiseguys-footer-4";a:1:{i:0;s:11:"fftwitter-3";}s:15:"wiseguyscustom5";a:1:{i:0;s:12:"ffsidemenu-3";}s:15:"wiseguyscustom1";a:1:{i:0;s:12:"ffsidemenu-4";}s:13:"array_version";i:3;}';
$sidebars_widgets = unserialize($sidebars_widgets);
echo var_export($sidebars_widgets);
*/

