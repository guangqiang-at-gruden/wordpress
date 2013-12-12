<?php
class dataInstallMenus{

    public $structure;
    public $custom_menu_items;
    public $tax_menu_items;
    public $post_menu_items;

    public $navMenus = array();
    
    function addToWP( $menu_name = '' ){
        if( !empty( $menu_name ) ){
            foreach ($this->structure as $index=>$value) {
                if( $menu_name == $value['menu_name'] ){
                    $this->insertMenuItem($index);
                }
            }
        }else{
            foreach ($this->structure as $index=>$value) {
                $this->insertMenuItem($index);
            }
        }
    }

    function insertMenuItem( $index ){
        $menuitem = $this->structure[$index];
        
        $menutitle = $menuitem[ 'menu_item_title' ];

        $menu_id = $this->getNavMenuID( $menuitem['menu_name']);

        $menu_item_id = wp_insert_post( array( 'post_type' => 'nav_menu_item'), TRUE );
        $this->structure[$index]['ID'] = $menu_item_id;

        $menu_settings = array();
        
        $parent = $menuitem['menu_item_parent'];
        if( $parent ){
            $parent = $this->structure[ $menuitem['menu_item_parent'] ] ['ID'];
        }
        $menu_settings[ 'menu-item-parent-id' ] = $parent;

        $menu_settings[ 'menu-item-title' ] = $menutitle;
        $menu_settings[ 'menu-item-description' ] = $menuitem[ 'menu_item_description' ];

        if( isSet( $this->custom_menu_items[$index] ) ){
            $menu_settings[ 'menu-item-type' ] = 'custom';
            $menu_settings[ 'menu-item-object' ] = 'custom';
            $menu_settings[ 'menu-item-url' ] = $this->custom_menu_items[$index];
        }else if( isSet( $this->tax_menu_items[$index] ) ){
            $menu_settings[ 'menu-item-type' ] = 'taxonomy';
            $menu_settings[ 'menu-item-object' ] = 'category';
            $menu_settings[ 'menu-item-object-id' ] = ffGetByTitle::term( $this->tax_menu_items[$index] );

        }else if( isSet( $this->post_menu_items[$index] ) ){
                $menu_settings[ 'menu-item-type' ] = 'post_type';
                $menu_settings[ 'menu-item-object' ]    = ffGetByTitle::post_type( $this->post_menu_items[$index] );
                $menu_settings[ 'menu-item-object-id' ] = ffGetByTitle::post( $this->post_menu_items[$index] );
        }

        wp_update_nav_menu_item( $menu_id, $menu_item_id, $menu_settings );
        //echo "<hr>wp_update_nav_menu_item( $menu_id, $menu_item_id, <pre>";print_r( $menu_settings ); echo "</pre><hr>";

        if( empty($menu_id) ){
            echo "wp_update_nav_menu_item( $menu_id, $menu_item_id, ";print_r($menu_settings);echo " );<br><hr><br>";
            echo "<p>Unable to find menu";
            exit;
        }
    }
    
    function getNavMenuID( $title ){
        if( isSet( $this->navMenus[ $title ] ) ){
            return $this->navMenus[ $title ];
        }

        $menu_obj = get_term_by( 'name', $title, 'nav_menu' );

        if( $menu_obj ){
            return $this->navMenus[ $title ] = $menu_obj->term_id;
        }

        return $this->navMenus[ $title ] = wp_create_nav_menu( $title );
    }

    function __construct(){

        $this->structure = array(
              264 => array( 'menu_item_title'=>'Web development','menu_item_description'=>'','order'=>'1','menu_item_parent'=>'0','menu_name'=>'Blog Side Menu'),
              265 => array( 'menu_item_title'=>'Design and implementation','menu_item_description'=>'','order'=>'2','menu_item_parent'=>'0','menu_name'=>'Blog Side Menu'),
              266 => array( 'menu_item_title'=>'Branding and packaging','menu_item_description'=>'','order'=>'3','menu_item_parent'=>'0','menu_name'=>'Blog Side Menu'),
              267 => array( 'menu_item_title'=>'Motion-design and rendering','menu_item_description'=>'','order'=>'4','menu_item_parent'=>'0','menu_name'=>'Blog Side Menu'),
              670 => array( 'menu_item_title'=>'Meet our team','menu_item_description'=>'','order'=>'5','menu_item_parent'=>'0','menu_name'=>'Blog Side Menu'),
              671 => array( 'menu_item_title'=>'Some of our best works','menu_item_description'=>'','order'=>'6','menu_item_parent'=>'0','menu_name'=>'Blog Side Menu'),
              
              
              81 => array( 'menu_item_title'=>'Side menu','menu_item_description'=>'','order'=>'1','menu_item_parent'=>'0','menu_name'=>'FAQ Menu'),
              80 => array( 'menu_item_title'=>'WiseGuys features FAQ','menu_item_description'=>'','order'=>'2','menu_item_parent'=>'0','menu_name'=>'FAQ Menu'),
              82 => array( 'menu_item_title'=>'Lorem ipsum dolor','menu_item_description'=>'','order'=>'3','menu_item_parent'=>'0','menu_name'=>'FAQ Menu'),
              84 => array( 'menu_item_title'=>'Quisque molestie enim','menu_item_description'=>'','order'=>'4','menu_item_parent'=>'0','menu_name'=>'FAQ Menu'),
              85 => array( 'menu_item_title'=>'Suspendisse imperdiet','menu_item_description'=>'','order'=>'5','menu_item_parent'=>'0','menu_name'=>'FAQ Menu'),
              86 => array( 'menu_item_title'=>'Vivamus sagittis','menu_item_description'=>'','order'=>'6','menu_item_parent'=>'0','menu_name'=>'FAQ Menu'),
              87 => array( 'menu_item_title'=>'Nullam porta faucibus','menu_item_description'=>'','order'=>'7','menu_item_parent'=>'0','menu_name'=>'FAQ Menu'),
              89 => array( 'menu_item_title'=>'Maecenas dapibus','menu_item_description'=>'','order'=>'8','menu_item_parent'=>'0','menu_name'=>'FAQ Menu'),
              91 => array( 'menu_item_title'=>'Aliquam porttitor purus','menu_item_description'=>'','order'=>'9','menu_item_parent'=>'0','menu_name'=>'FAQ Menu'),


              463 => array( 'menu_item_title'=>'HOME','menu_item_description'=>'','order'=>'1','menu_item_parent'=>'0','menu_name'=>'Footer Menu'),
              464 => array( 'menu_item_title'=>'NEWS','menu_item_description'=>'','order'=>'2','menu_item_parent'=>'0','menu_name'=>'Footer Menu'),
              465 => array( 'menu_item_title'=>'PORTFOLIO','menu_item_description'=>'','order'=>'3','menu_item_parent'=>'0','menu_name'=>'Footer Menu'),
              466 => array( 'menu_item_title'=>'THE BLOG','menu_item_description'=>'','order'=>'4','menu_item_parent'=>'0','menu_name'=>'Footer Menu'),
              467 => array( 'menu_item_title'=>'CONTACT','menu_item_description'=>'','order'=>'5','menu_item_parent'=>'0','menu_name'=>'Footer Menu'),


              11 => array( 'menu_item_title'=>'HOME','menu_item_description'=>'- hi there -','order'=>'1','menu_item_parent'=>'0','menu_name'=>'Navigation'),
              13 => array( 'menu_item_title'=>'PAGES','menu_item_description'=>'- useful pages -','order'=>'6','menu_item_parent'=>'0','menu_name'=>'Navigation'),
              359 => array( 'menu_item_title'=>'OUR WORKS','menu_item_description'=>'- greatest hits -','order'=>'16','menu_item_parent'=>'0','menu_name'=>'Navigation'),
              280 => array( 'menu_item_title'=>'OUR BLOG','menu_item_description'=>'- what’s up -','order'=>'34','menu_item_parent'=>'0','menu_name'=>'Navigation'),
              161 => array( 'menu_item_title'=>'FEATURES','menu_item_description'=>'- cool stuff -','order'=>'42','menu_item_parent'=>'0','menu_name'=>'Navigation'),
              472 => array( 'menu_item_title'=>'CONTACT','menu_item_description'=>'- get in touch -','order'=>'48','menu_item_parent'=>'0','menu_name'=>'Navigation'),
              468 => array( 'menu_item_title'=>'BLUR SLIDER','menu_item_description'=>'','order'=>'2','menu_item_parent'=>'11','menu_name'=>'Navigation'),
              452 => array( 'menu_item_title'=>'FULLWIDTH SLIDER','menu_item_description'=>'','order'=>'3','menu_item_parent'=>'11','menu_name'=>'Navigation'),
              461 => array( 'menu_item_title'=>'3D SLIDER','menu_item_description'=>'','order'=>'4','menu_item_parent'=>'11','menu_name'=>'Navigation'),
              459 => array( 'menu_item_title'=>'SIMPLE SLIDER','menu_item_description'=>'','order'=>'5','menu_item_parent'=>'11','menu_name'=>'Navigation'),
              279 => array( 'menu_item_title'=>'HOME 2','menu_item_description'=>'','order'=>'7','menu_item_parent'=>'13','menu_name'=>'Navigation'),
              326 => array( 'menu_item_title'=>'HOME 3','menu_item_description'=>'','order'=>'8','menu_item_parent'=>'13','menu_name'=>'Navigation'),
              14 => array( 'menu_item_title'=>'ABOUT US','menu_item_description'=>'','order'=>'9','menu_item_parent'=>'13','menu_name'=>'Navigation'),
              41 => array( 'menu_item_title'=>'ABOUT US 2','menu_item_description'=>'','order'=>'10','menu_item_parent'=>'13','menu_name'=>'Navigation'),
              63 => array( 'menu_item_title'=>'OUR SERVICES','menu_item_description'=>'','order'=>'11','menu_item_parent'=>'13','menu_name'=>'Navigation'),
              54 => array( 'menu_item_title'=>'OUR SERVICES 2','menu_item_description'=>'','order'=>'12','menu_item_parent'=>'13','menu_name'=>'Navigation'),
              74 => array( 'menu_item_title'=>'OUR PRICES','menu_item_description'=>'','order'=>'13','menu_item_parent'=>'13','menu_name'=>'Navigation'),
              145 => array( 'menu_item_title'=>'FAQ PAGE','menu_item_description'=>'','order'=>'14','menu_item_parent'=>'13','menu_name'=>'Navigation'),
              158 => array( 'menu_item_title'=>'SIDE MENU','menu_item_description'=>'','order'=>'15','menu_item_parent'=>'13','menu_name'=>'Navigation'),
              165 => array( 'menu_item_title'=>'TYPOGRAPHY','menu_item_description'=>'','order'=>'43','menu_item_parent'=>'161','menu_name'=>'Navigation'),
              192 => array( 'menu_item_title'=>'PRICING TABLES','menu_item_description'=>'','order'=>'44','menu_item_parent'=>'161','menu_name'=>'Navigation'),
              195 => array( 'menu_item_title'=>'COMPARISON TABLES','menu_item_description'=>'','order'=>'45','menu_item_parent'=>'161','menu_name'=>'Navigation'),
              216 => array( 'menu_item_title'=>'ELEMENTS','menu_item_description'=>'','order'=>'46','menu_item_parent'=>'161','menu_name'=>'Navigation'),
              271 => array( 'menu_item_title'=>'SLIDERS','menu_item_description'=>'','order'=>'47','menu_item_parent'=>'161','menu_name'=>'Navigation'),
              281 => array( 'menu_item_title'=>'BLOG LARGE','menu_item_description'=>'','order'=>'35','menu_item_parent'=>'280','menu_name'=>'Navigation'),
              294 => array( 'menu_item_title'=>'BLOG MEDIUM','menu_item_description'=>'','order'=>'36','menu_item_parent'=>'280','menu_name'=>'Navigation'),
              482 => array( 'menu_item_title'=>'IMAGE POST','menu_item_description'=>'','order'=>'37','menu_item_parent'=>'280','menu_name'=>'Navigation'),
              483 => array( 'menu_item_title'=>'SLIDER POST','menu_item_description'=>'','order'=>'38','menu_item_parent'=>'280','menu_name'=>'Navigation'),
              484 => array( 'menu_item_title'=>'VIMEO POST','menu_item_description'=>'','order'=>'39','menu_item_parent'=>'280','menu_name'=>'Navigation'),
              486 => array( 'menu_item_title'=>'YOUTUBE POST','menu_item_description'=>'','order'=>'40','menu_item_parent'=>'280','menu_name'=>'Navigation'),
              485 => array( 'menu_item_title'=>'LIGHTBOX POST','menu_item_description'=>'','order'=>'41','menu_item_parent'=>'280','menu_name'=>'Navigation'),

              550 => array( 'menu_item_title'=>'PORTFOLIO','menu_item_description'=>'','order'=>'17','menu_item_parent'=>'359','menu_name'=>'Navigation'),
              462 => array( 'menu_item_title'=>'GALLERY','menu_item_description'=>'','order'=>'30','menu_item_parent'=>'359','menu_name'=>'Navigation'),

              361 => array( 'menu_item_title'=>'FILTERABLE','menu_item_description'=>'','order'=>'18','menu_item_parent'=>'550','menu_name'=>'Navigation'),
              545 => array( 'menu_item_title'=>'PAGINATION','menu_item_description'=>'','order'=>'22','menu_item_parent'=>'550','menu_name'=>'Navigation'),

              364 => array( 'menu_item_title'=>'3 COLUMNS','menu_item_description'=>'','order'=>'19','menu_item_parent'=>'361','menu_name'=>'Navigation'),
              543 => array( 'menu_item_title'=>'4 COLUMNS','menu_item_description'=>'','order'=>'20','menu_item_parent'=>'361','menu_name'=>'Navigation'),
              544 => array( 'menu_item_title'=>'5 COLUMNS','menu_item_description'=>'','order'=>'21','menu_item_parent'=>'361','menu_name'=>'Navigation'),
              496 => array( 'menu_item_title'=>'3 COLUMNS','menu_item_description'=>'','order'=>'31','menu_item_parent'=>'462','menu_name'=>'Navigation'),
              495 => array( 'menu_item_title'=>'4 COLUMNS','menu_item_description'=>'','order'=>'32','menu_item_parent'=>'462','menu_name'=>'Navigation'),
              494 => array( 'menu_item_title'=>'5 COLUMNS','menu_item_description'=>'','order'=>'33','menu_item_parent'=>'462','menu_name'=>'Navigation'),
              546 => array( 'menu_item_title'=>'3 COLUMNS','menu_item_description'=>'','order'=>'23','menu_item_parent'=>'545','menu_name'=>'Navigation'),
              547 => array( 'menu_item_title'=>'4 COLUMNS','menu_item_description'=>'','order'=>'24','menu_item_parent'=>'545','menu_name'=>'Navigation'),
              548 => array( 'menu_item_title'=>'5 COLUMNS','menu_item_description'=>'','order'=>'25','menu_item_parent'=>'545','menu_name'=>'Navigation'),
              487 => array( 'menu_item_title'=>'PORTFOLIO SINGLE','menu_item_description'=>'','order'=>'26','menu_item_parent'=>'550','menu_name'=>'Navigation'),
              610 => array( 'menu_item_title'=>'PORTFOLIO VIMEO','menu_item_description'=>'','order'=>'27','menu_item_parent'=>'550','menu_name'=>'Navigation'),
              611 => array( 'menu_item_title'=>'PORTFOLIO YOUTUBE','menu_item_description'=>'','order'=>'28','menu_item_parent'=>'550','menu_name'=>'Navigation'),
              612 => array( 'menu_item_title'=>'PORTFOLIO SLIDER','menu_item_description'=>'','order'=>'29','menu_item_parent'=>'550','menu_name'=>'Navigation'),

        );
        
        $this->custom_menu_items = array(

              82 => '#',
              84 => '#',
              85 => '#',
              86 => '#',
              87 => '#',
              89 => '#',
              91 => '#',
              161 => '#',
              280 => '#',
              359 => '#',
              463 => '#',
              464 => '#',
              465 => '#',
              466 => '#',
              467 => '#',
        );

        $this->tax_menu_items = array(
              264 => 'Blog Medium',
              266 => 'Blog Large',

              265 => 'Featured Blog Posts',

              545 => 'Portfolio Pagination 3',
              546 => 'Portfolio Pagination 3',
              547 => 'Portfolio Pagination 4',
              548 => 'Portfolio Pagination 5',
              671 => 'Portfolio Pagination 4',

              281 => 'Blog Large',
              294 => 'Blog Medium',
              361 => 'Portfolio Filterable 3',
              364 => 'Portfolio Filterable 3',
              543 => 'Portfolio Filterable 4',
              544 => 'Portfolio Filterable 5',
              550 => 'Portfolio',
        );
        
        $this->post_menu_items = array(
              11 => 'Blur Slider',
              468 => 'Blur Slider',
              13 => 'Home <span class="highlight">2</span>',
              80 => 'Feature <span class="highlight">FAQ</span>',
              81 => 'Side <span class="highlight">Menu</span>',
              670 => 'About <span class="highlight">Us</span>',

              482 => 'Hello there, I am a single image post example',
              483 => 'I am a Flex slider example and I can slide your images smoothly',
              484 => 'Ahoy there, I am the Vimeo post for your creative videos',
              485 => 'Last but not least, I am the lightbox post and I can group media',
              486 => 'Hey, I\'m the YouTube post and I can display milions of videos',
              487 => 'Hello there, I am a single image post example',

              610 => 'Cool Vimeo video',
              611 => 'Wicked YouTube',
              612 => 'The great skyline',

              14 => 'About <span class="highlight">Us</span>',
              41 => 'About <span class="highlight">Us</span> #2',
              54 => 'Our <span class="highlight">Services</span> #2',
              63 => 'Our <span class="highlight">Services</span>',
              74 => 'Pricing <span class="highlight">Options</span>',
              145 => 'Feature <span class="highlight">FAQ</span>',
              158 => 'Side <span class="highlight">Menu</span>',
              165 => 'Typo<span class="highlight">graphy</span>',
              192 => 'Pricing <span class="highlight">Tables</span>',
              195 => 'Comparison <span class="highlight">tables</span>',
              216 => 'Cool <span class="highlight">Elements</span>',
              271 => 'Cool <span class="highlight">Sliders</span>',
              279 => 'Home <span class="highlight">2</span>',
              326 => 'Home <span class="highlight">3</span>',
              452 => 'Fullwidth slider',
              459 => 'Simple Slider',
              462 => 'The <span class="highlight">Gallery</span>',
              461 => '3D Slider',
              472 => 'Contact <span class="highlight">Us</span>',
              494 => 'The <span class="highlight">Gallery</span> #3',
              495 => 'The <span class="highlight">Gallery</span> #2',
              496 => 'The <span class="highlight">Gallery</span>',
              267 => 'The <span class="highlight">Gallery</span>',
        );
    }
}