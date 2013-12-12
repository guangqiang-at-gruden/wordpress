<?php
/*

SELECT m.`meta_key` , p.`post_title` ,  m.`meta_value`
FROM  `wp_posts` p,  `wp_postmeta` m
WHERE p.`ID` = m.`post_id`
AND ( p.`post_type` = 'page' OR p.`post_type` = 'portfolio' OR p.`post_type` = 'post' )
AND m.`meta_value` NOT LIKE '%!!!%'
AND m.`meta_key` != 'contact_form_name'
AND m.`meta_key` != 'map_hnear'
AND m.`meta_key` != 'map_ll'
AND m.`meta_key` NOT LIKE '_edit_%'
ORDER BY m.`meta_key`, p.`post_title`, p.`ID`

*/


class dataInstallMetas{

    public $structure;
    public $posts;

    function addToWP(){
        foreach( $this->structure as $settings) {
            if( 'a:' == substr($settings['meta_value'],0,2) ){
                $settings['meta_value'] = preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $settings['meta_value']);
                $settings['meta_value'] = unserialize($settings['meta_value']);
            }

            add_post_meta(
                ffGetByTitle::post( $settings['post_title'] ),
                $settings['meta_key'],
                $settings['meta_value'],
                TRUE // UNIQUE
            );
        }
    }

    function __construct(){
        $gallery_slider_1 = "" . ffGetByTitle::image('Placeholder #1') . "";
        $gallery_slider_3 = "" . ffGetByTitle::image('Placeholder #1') . ","
                               . ffGetByTitle::image('Placeholder #2') . ","
                               . ffGetByTitle::image('Placeholder #3') . "";

        $this->structure = array(
  array('meta_key'=>'description_bg_color','post_title'=>'Fullwidth slider','meta_value'=>'f8f8f8'),
  array('meta_key'=>'description_bg_image','post_title'=>'3D Slider','meta_value'=>get_template_directory_uri().'/images/backgrounds/car.jpg'),
  array('meta_key'=>'description_bg_image','post_title'=>'About <span class="highlight">Us</span>','meta_value'=>get_template_directory_uri().'/images/backgrounds/car.jpg'),
  array('meta_key'=>'description_bg_image','post_title'=>'About <span class="highlight">Us</span> #2','meta_value'=>get_template_directory_uri().'/images/backgrounds/car.jpg'),
  array('meta_key'=>'description_bg_image','post_title'=>'Comparison <span class="highlight">tables</span>','meta_value'=>get_template_directory_uri().'/images/backgrounds/car.jpg'),
  array('meta_key'=>'description_bg_image','post_title'=>'Contact <span class="highlight">Us</span>','meta_value'=>get_template_directory_uri().'/images/backgrounds/car.jpg'),
  array('meta_key'=>'description_bg_image','post_title'=>'Cool <span class="highlight">Elements</span>','meta_value'=>get_template_directory_uri().'/images/backgrounds/car.jpg'),
  array('meta_key'=>'description_bg_image','post_title'=>'Cool <span class="highlight">Sliders</span>','meta_value'=>get_template_directory_uri().'/images/backgrounds/car.jpg'),
  array('meta_key'=>'description_bg_image','post_title'=>'Feature <span class="highlight">FAQ</span>','meta_value'=>get_template_directory_uri().'/images/backgrounds/car.jpg'),
  array('meta_key'=>'description_bg_image','post_title'=>'Home <span class="highlight">2</span>','meta_value'=>get_template_directory_uri().'/images/backgrounds/car.jpg'),
  array('meta_key'=>'description_bg_image','post_title'=>'Homepage','meta_value'=>get_template_directory_uri().'/images/backgrounds/car.jpg'),
  array('meta_key'=>'description_bg_image','post_title'=>'Our <span class="highlight">Services</span>','meta_value'=>get_template_directory_uri().'/images/backgrounds/car.jpg'),
  array('meta_key'=>'description_bg_image','post_title'=>'Our <span class="highlight">Services</span> #2','meta_value'=>get_template_directory_uri().'/images/backgrounds/car.jpg'),
  array('meta_key'=>'description_bg_image','post_title'=>'Pricing <span class="highlight">Options</span>','meta_value'=>get_template_directory_uri().'/images/backgrounds/car.jpg'),
  array('meta_key'=>'description_bg_image','post_title'=>'Pricing <span class="highlight">Tables</span>','meta_value'=>get_template_directory_uri().'/images/backgrounds/car.jpg'),
  array('meta_key'=>'description_bg_image','post_title'=>'Side <span class="highlight">Menu</span>','meta_value'=>get_template_directory_uri().'/images/backgrounds/car.jpg'),
  array('meta_key'=>'description_bg_image','post_title'=>'Simple Slider','meta_value'=>get_template_directory_uri().'/images/backgrounds/car.jpg'),
  array('meta_key'=>'description_bg_image','post_title'=>'The <span class="highlight">Gallery</span>','meta_value'=>get_template_directory_uri().'/images/backgrounds/car.jpg'),
  array('meta_key'=>'description_bg_image','post_title'=>'The <span class="highlight">Gallery</span> #2','meta_value'=>get_template_directory_uri().'/images/backgrounds/car.jpg'),
  array('meta_key'=>'description_bg_image','post_title'=>'The <span class="highlight">Gallery</span> #3','meta_value'=>get_template_directory_uri().'/images/backgrounds/car.jpg'),
  array('meta_key'=>'description_bg_image','post_title'=>'Typo<span class="highlight">graphy</span>','meta_value'=>get_template_directory_uri().'/images/backgrounds/car.jpg'),
  array('meta_key'=>'description_bg_image','post_title'=>'Typo<span class="highlight">graphy</span> #2','meta_value'=>get_template_directory_uri().'/images/backgrounds/car.jpg'),
  array('meta_key'=>'description_bg_type','post_title'=>'3D Slider','meta_value'=>'image'),
  array('meta_key'=>'description_bg_type','post_title'=>'About <span class="highlight">Us</span>','meta_value'=>'image'),
  array('meta_key'=>'description_bg_type','post_title'=>'About <span class="highlight">Us</span> #2','meta_value'=>'image'),
  array('meta_key'=>'description_bg_type','post_title'=>'Blur Slider','meta_value'=>'default'),
  array('meta_key'=>'description_bg_type','post_title'=>'Comment Page Test','meta_value'=>'default'),
  array('meta_key'=>'description_bg_type','post_title'=>'Comparison <span class="highlight">tables</span>','meta_value'=>'image'),
  array('meta_key'=>'description_bg_type','post_title'=>'Contact <span class="highlight">Us</span>','meta_value'=>'image'),
  array('meta_key'=>'description_bg_type','post_title'=>'Cool <span class="highlight">Elements</span>','meta_value'=>'image'),
  array('meta_key'=>'description_bg_type','post_title'=>'Cool <span class="highlight">Sliders</span>','meta_value'=>'image'),
  array('meta_key'=>'description_bg_type','post_title'=>'Feature <span class="highlight">FAQ</span>','meta_value'=>'image'),
  array('meta_key'=>'description_bg_type','post_title'=>'Fullwidth slider','meta_value'=>'color'),
  array('meta_key'=>'description_bg_type','post_title'=>'Home <span class="highlight">2</span>','meta_value'=>'image'),
  array('meta_key'=>'description_bg_type','post_title'=>'Home <span class="highlight">3</span>','meta_value'=>'default'),
  array('meta_key'=>'description_bg_type','post_title'=>'Homepage','meta_value'=>'image'),
  array('meta_key'=>'description_bg_type','post_title'=>'Our <span class="highlight">Services</span>','meta_value'=>'image'),
  array('meta_key'=>'description_bg_type','post_title'=>'Our <span class="highlight">Services</span> #2','meta_value'=>'image'),
  array('meta_key'=>'description_bg_type','post_title'=>'Pricing <span class="highlight">Options</span>','meta_value'=>'image'),
  array('meta_key'=>'description_bg_type','post_title'=>'Pricing <span class="highlight">Tables</span>','meta_value'=>'image'),
  array('meta_key'=>'description_bg_type','post_title'=>'Side <span class="highlight">Menu</span>','meta_value'=>'image'),
  array('meta_key'=>'description_bg_type','post_title'=>'Simple Slider','meta_value'=>'image'),
  array('meta_key'=>'description_bg_type','post_title'=>'The <span class="highlight">Gallery</span>','meta_value'=>'image'),
  array('meta_key'=>'description_bg_type','post_title'=>'The <span class="highlight">Gallery</span> #2','meta_value'=>'image'),
  array('meta_key'=>'description_bg_type','post_title'=>'The <span class="highlight">Gallery</span> #3','meta_value'=>'image'),
  array('meta_key'=>'description_bg_type','post_title'=>'Typo<span class="highlight">graphy</span>','meta_value'=>'image'),
  array('meta_key'=>'description_bg_type','post_title'=>'Typo<span class="highlight">graphy</span> #2','meta_value'=>'default'),
  array('meta_key'=>'description_lower','post_title'=>'3D Slider','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'About <span class="highlight">Us</span>','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'About <span class="highlight">Us</span> #2','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'Blur Slider','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'Comparison <span class="highlight">tables</span>','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'Contact <span class="highlight">Us</span>','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'Cool <span class="highlight">Elements</span>','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'Cool <span class="highlight">Sliders</span>','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'Feature <span class="highlight">FAQ</span>','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'Fullwidth slider','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'Home <span class="highlight">2</span>','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'Home <span class="highlight">3</span>','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'Our <span class="highlight">Services</span>','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'Our <span class="highlight">Services</span> #2','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'Pricing <span class="highlight">Options</span>','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'Pricing <span class="highlight">Tables</span>','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'Side <span class="highlight">Menu</span>','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'Simple Slider','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'The <span class="highlight">Gallery</span>','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'The <span class="highlight">Gallery</span> #2','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'The <span class="highlight">Gallery</span> #3','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'Typo<span class="highlight">graphy</span>','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'description_lower','post_title'=>'Typo<span class="highlight">graphy</span> #2','meta_value'=>'The most <span class="highlight">innovative designers</span> consciously reject the standard option box and <span class="highlight">cultivate</span> an appetite for <span class="highlight">thinking</span> wrong.'),
  array('meta_key'=>'featured_image_type','post_title'=>'3D Slider','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'About <span class="highlight">Us</span>','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'About <span class="highlight">Us</span> #2','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Ahoy there, I am the Vimeo post for your creative videos','meta_value'=>'video'),
  array('meta_key'=>'featured_image_type','post_title'=>'Ahoy there, I\'m the lighbox example','meta_value'=>'lightbox'),
  array('meta_key'=>'featured_image_type','post_title'=>'Blur Slider','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Click me, click me, I\'m the Vimeo post','meta_value'=>'video'),
  array('meta_key'=>'featured_image_type','post_title'=>'Comment Page Test','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Comparison <span class="highlight">tables</span>','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Contact <span class="highlight">Us</span>','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Cool <span class="highlight">Elements</span>','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Cool <span class="highlight">Sliders</span>','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Feature <span class="highlight">FAQ</span>','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Fullwidth slider','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Guess what, I\'m the YouTube example','meta_value'=>'video'),
  array('meta_key'=>'featured_image_type','post_title'=>'Hello there, I am a single image post example','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Hello there, I am a single image post example','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Hey, I\'m the Flex slider post example','meta_value'=>'slider'),
  array('meta_key'=>'featured_image_type','post_title'=>'Hey, I\'m the YouTube post and I can display milions of videos','meta_value'=>'video'),
  array('meta_key'=>'featured_image_type','post_title'=>'Home <span class="highlight">2</span>','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Home <span class="highlight">3</span>','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Homepage','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'I am a Flex slider example and I can slide your images smoothly','meta_value'=>'slider'),
  array('meta_key'=>'featured_image_type','post_title'=>'Last but not least, I am the lightbox post and I can group media','meta_value'=>'lightbox'),
  array('meta_key'=>'featured_image_type','post_title'=>'Lorem ipsum sit amet faeris velitulat est','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Our <span class="highlight">Services</span>','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Our <span class="highlight">Services</span> #2','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Pricing <span class="highlight">Options</span>','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Pricing <span class="highlight">Tables</span>','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Side <span class="highlight">Menu</span>','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Simple Slider','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Suspendi braus es vicat farus metis','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'The <span class="highlight">Gallery</span>','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'The <span class="highlight">Gallery</span> #2','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'The <span class="highlight">Gallery</span> #3','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Typo<span class="highlight">graphy</span>','meta_value'=>'std'),
  array('meta_key'=>'featured_image_type','post_title'=>'Typo<span class="highlight">graphy</span> #2','meta_value'=>'std'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Ahoy there, I am the Vimeo post for your creative videos','meta_value'=>'http://player.vimeo.com/video/24302498'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Audio example here','meta_value'=>get_template_directory_uri().'/music/1.mp3'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Click me, click me, I\'m the Vimeo post','meta_value'=>'http://vimeo.com/24302498'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Cool Vimeo video','meta_value'=>'http://vimeo.com/24302498'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Cool Vimeo video','meta_value'=>'http://vimeo.com/24302498'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Guess what, I\'m the YouTube example','meta_value'=>'http://www.youtube.com/watch?v=e2rWG0DCrpI'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Hey, I\'m the YouTube post and I can display milions of videos','meta_value'=>'http://www.youtube.com/watch?v=e2rWG0DCrpI'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Local video y\'all','meta_value'=>get_template_directory_uri().'/video/portrait_760.mp4'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Wicked YouTube','meta_value'=>'http://www.youtube.com/watch?v=i6T8LfDwQjo'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Wicked YouTube','meta_value'=>'http://www.youtube.com/watch?v=i6T8LfDwQjo'),
  array('meta_key'=>'fw_sidebar','post_title'=>'3D Slider','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'About <span class="highlight">Us</span>','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'About <span class="highlight">Us</span> #2','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'Blur Slider','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'Comment Page Test','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'Comparison <span class="highlight">tables</span>','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'Contact <span class="highlight">Us</span>','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'Cool <span class="highlight">Elements</span>','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'Cool <span class="highlight">Sliders</span>','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'Feature <span class="highlight">FAQ</span>','meta_value'=>'1'),
  array('meta_key'=>'fw_sidebar','post_title'=>'Fullwidth slider','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'Home <span class="highlight">2</span>','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'Home <span class="highlight">3</span>','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'Homepage','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'Our <span class="highlight">Services</span>','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'Our <span class="highlight">Services</span> #2','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'Pricing <span class="highlight">Options</span>','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'Pricing <span class="highlight">Tables</span>','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'Side <span class="highlight">Menu</span>','meta_value'=>'5'),
  array('meta_key'=>'fw_sidebar','post_title'=>'Simple Slider','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'The <span class="highlight">Gallery</span>','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'The <span class="highlight">Gallery</span> #2','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'The <span class="highlight">Gallery</span> #3','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'Typo<span class="highlight">graphy</span>','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar','post_title'=>'Typo<span class="highlight">graphy</span> #2','meta_value'=>'default'),
  array('meta_key'=>'fw_sidebar_position','post_title'=>'Comment Page Test','meta_value'=>'right'),
  array('meta_key'=>'gallery_columns','post_title'=>'3D Slider','meta_value'=>'3'),
  array('meta_key'=>'gallery_columns','post_title'=>'About <span class="highlight">Us</span>','meta_value'=>'3'),
  array('meta_key'=>'gallery_columns','post_title'=>'About <span class="highlight">Us</span> #2','meta_value'=>'3'),
  array('meta_key'=>'gallery_columns','post_title'=>'Comment Page Test','meta_value'=>'3'),
  array('meta_key'=>'gallery_columns','post_title'=>'Comparison <span class="highlight">tables</span>','meta_value'=>'3'),
  array('meta_key'=>'gallery_columns','post_title'=>'Contact <span class="highlight">Us</span>','meta_value'=>'3'),
  array('meta_key'=>'gallery_columns','post_title'=>'Cool <span class="highlight">Elements</span>','meta_value'=>'3'),
  array('meta_key'=>'gallery_columns','post_title'=>'Cool <span class="highlight">Sliders</span>','meta_value'=>'3'),
  array('meta_key'=>'gallery_columns','post_title'=>'Feature <span class="highlight">FAQ</span>','meta_value'=>'3'),
  array('meta_key'=>'gallery_columns','post_title'=>'Fullwidth slider','meta_value'=>'3'),
  array('meta_key'=>'gallery_columns','post_title'=>'Our <span class="highlight">Services</span>','meta_value'=>'3'),
  array('meta_key'=>'gallery_columns','post_title'=>'Our <span class="highlight">Services</span> #2','meta_value'=>'3'),
  array('meta_key'=>'gallery_columns','post_title'=>'Pricing <span class="highlight">Options</span>','meta_value'=>'3'),
  array('meta_key'=>'gallery_columns','post_title'=>'Pricing <span class="highlight">Tables</span>','meta_value'=>'3'),
  array('meta_key'=>'gallery_columns','post_title'=>'Side <span class="highlight">Menu</span>','meta_value'=>'3'),
  array('meta_key'=>'gallery_columns','post_title'=>'Simple Slider','meta_value'=>'3'),
  array('meta_key'=>'gallery_columns','post_title'=>'The <span class="highlight">Gallery</span>','meta_value'=>'3'),
  array('meta_key'=>'gallery_columns','post_title'=>'The <span class="highlight">Gallery</span> #2','meta_value'=>'4'),
  array('meta_key'=>'gallery_columns','post_title'=>'The <span class="highlight">Gallery</span> #3','meta_value'=>'5'),
  array('meta_key'=>'gallery_columns','post_title'=>'Typo<span class="highlight">graphy</span>','meta_value'=>'3'),
  array('meta_key'=>'gallery_columns','post_title'=>'Typo<span class="highlight">graphy</span> #2','meta_value'=>'3'),
  array('meta_key'=>'gallery_slider','post_title'=>'Audio example here','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'gallery_slider','post_title'=>'Cool Vimeo video','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'gallery_slider','post_title'=>'Cool Vimeo video','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'gallery_slider','post_title'=>'DWA interior design','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'gallery_slider','post_title'=>'Electric swordsman','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'gallery_slider','post_title'=>'Hey, I\'m the Flex slider post example','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'gallery_slider','post_title'=>'I am a Flex slider example and I can slide your images smoothly','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'gallery_slider','post_title'=>'Jessica Watson musician','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'gallery_slider','post_title'=>'Local video y\'all','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'gallery_slider','post_title'=>'My naked roomie','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'gallery_slider','post_title'=>'Nice items example','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'gallery_slider','post_title'=>'Single image example','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'gallery_slider','post_title'=>'Single image example','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'gallery_slider','post_title'=>'Speed king studios','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'gallery_slider','post_title'=>'The <span class="highlight">Gallery</span>','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'gallery_slider','post_title'=>'The <span class="highlight">Gallery</span> #2','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'gallery_slider','post_title'=>'The <span class="highlight">Gallery</span> #3','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'gallery_slider','post_title'=>'The good old classics','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'gallery_slider','post_title'=>'The great skyline','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'gallery_slider','post_title'=>'The great skyline','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'gallery_slider','post_title'=>'The secret girl spy','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'gallery_slider','post_title'=>'Under the clouds','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'gallery_slider','post_title'=>'Wicked YouTube','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'gallery_slider','post_title'=>'Wicked YouTube','meta_value'=>$gallery_slider_3),
  array('meta_key'=>'portfolio_image_description','post_title'=>'Audio example here','meta_value'=>'- music -'),
  array('meta_key'=>'portfolio_image_description','post_title'=>'Cool Vimeo video','meta_value'=>'- vimeo video -'),
  array('meta_key'=>'portfolio_image_description','post_title'=>'Cool Vimeo video','meta_value'=>'- vimeo video -'),
  array('meta_key'=>'portfolio_image_description','post_title'=>'DWA interior design','meta_value'=>'- branding -'),
  array('meta_key'=>'portfolio_image_description','post_title'=>'Electric swordsman','meta_value'=>'- web design -'),
  array('meta_key'=>'portfolio_image_description','post_title'=>'Jessica Watson musician','meta_value'=>'- branding -'),
  array('meta_key'=>'portfolio_image_description','post_title'=>'Local video y\'all','meta_value'=>'- my video -'),
  array('meta_key'=>'portfolio_image_description','post_title'=>'My naked roomie','meta_value'=>'- photography -'),
  array('meta_key'=>'portfolio_image_description','post_title'=>'Nice items example','meta_value'=>'- cool vids -'),
  array('meta_key'=>'portfolio_image_description','post_title'=>'Single image example','meta_value'=>'- illustration -'),
  array('meta_key'=>'portfolio_image_description','post_title'=>'Single image example','meta_value'=>'- illustration -'),
  array('meta_key'=>'portfolio_image_description','post_title'=>'Speed king studios','meta_value'=>'- web development -'),
  array('meta_key'=>'portfolio_image_description','post_title'=>'The good old classics','meta_value'=>'- digital art -'),
  array('meta_key'=>'portfolio_image_description','post_title'=>'The great skyline','meta_value'=>'- photography -'),
  array('meta_key'=>'portfolio_image_description','post_title'=>'The great skyline','meta_value'=>'- photography -'),
  array('meta_key'=>'portfolio_image_description','post_title'=>'The secret girl spy','meta_value'=>'- digital art -'),
  array('meta_key'=>'portfolio_image_description','post_title'=>'Under the clouds','meta_value'=>'- digital art -'),
  array('meta_key'=>'portfolio_image_description','post_title'=>'Wicked YouTube','meta_value'=>'- youtube video -'),
  array('meta_key'=>'portfolio_image_description','post_title'=>'Wicked YouTube','meta_value'=>'- youtube video -'),
  array('meta_key'=>'project_details_text','post_title'=>'Audio example here','meta_value'=>'Client!:! Wise Guys Inc.
Project type!:! Web development
Project date!:! December 15th 2012
Skills!:! Wordpress, HTML5, javascript
URL!:! <a href="http://www.wiseguys.com">www.wiseguys.com</a>'),
  array('meta_key'=>'project_details_text','post_title'=>'Cool Vimeo video','meta_value'=>'Client!:! Wise Guys Inc.
Project type!:! Web development
Project date!:! December 15th 2012
Skills!:! Wordpress, HTML5, javascript
URL!:! <a href="http://www.wiseguys.com">www.wiseguys.com</a>'),
  array('meta_key'=>'project_details_text','post_title'=>'Cool Vimeo video','meta_value'=>'Client!:! Wise Guys Inc.
Project type!:! Web development
Project date!:! December 15th 2012
Skills!:! Wordpress, HTML5, javascript
URL!:! <a href="http://www.wiseguys.com">www.wiseguys.com</a>'),
  array('meta_key'=>'project_details_text','post_title'=>'DWA interior design','meta_value'=>'Client!:! Wise Guys Inc.
Project type!:! Web development
Project date!:! December 15th 2012
Skills!:! Wordpress, HTML5, javascript
URL!:! <a href="http://www.wiseguys.com">www.wiseguys.com</a>'),
  array('meta_key'=>'project_details_text','post_title'=>'Electric swordsman','meta_value'=>'Client!:! Wise Guys Inc.
Project type!:! Web development
Project date!:! December 15th 2012
Skills!:! Wordpress, HTML5, javascript
URL!:! <a href="http://www.wiseguys.com">www.wiseguys.com</a>'),
  array('meta_key'=>'project_details_text','post_title'=>'Jessica Watson musician','meta_value'=>'Client!:! Wise Guys Inc.
Project type!:! Web development
Project date!:! December 15th 2012
Skills!:! Wordpress, HTML5, javascript
URL!:! <a href="http://www.wiseguys.com">www.wiseguys.com</a>'),
  array('meta_key'=>'project_details_text','post_title'=>'Local video y\'all','meta_value'=>'Client!:! Wise Guys Inc.
Project type!:! Web development
Project date!:! December 15th 2012
Skills!:! Wordpress, HTML5, javascript
URL!:! <a href="http://www.wiseguys.com">www.wiseguys.com</a>'),
  array('meta_key'=>'project_details_text','post_title'=>'My naked roomie','meta_value'=>'Client!:! Wise Guys Inc.
Project type!:! Web development
Project date!:! December 15th 2012
Skills!:! Wordpress, HTML5, javascript
URL!:! <a href="http://www.wiseguys.com">www.wiseguys.com</a>'),
  array('meta_key'=>'project_details_text','post_title'=>'Nice items example','meta_value'=>'Client!:! Wise Guys Inc.
Project type!:! Web development
Project date!:! December 15th 2012
Skills!:! Wordpress, HTML5, javascript
URL!:! <a href="http://www.wiseguys.com">www.wiseguys.com</a>'),
  array('meta_key'=>'project_details_text','post_title'=>'Single image example','meta_value'=>'Client!:! Wise Guys Inc.
Project type!:! Web development
Project date!:! December 15th 2012
Skills!:! Wordpress, HTML5, javascript
URL!:! <a href="http://www.wiseguys.com">www.wiseguys.com</a>'),
  array('meta_key'=>'project_details_text','post_title'=>'Single image example','meta_value'=>'Client!:! Wise Guys Inc.
Project type!:! Web development
Project date!:! December 15th 2012
Skills!:! Wordpress, HTML5, javascript
URL!:! <a href="http://www.wiseguys.com">www.wiseguys.com</a>'),
  array('meta_key'=>'project_details_text','post_title'=>'Speed king studios','meta_value'=>'Client!:! Wise Guys Inc.
Project type!:! Web development
Project date!:! December 15th 2012
Skills!:! Wordpress, HTML5, javascript
URL!:! <a href="http://www.wiseguys.com">www.wiseguys.com</a>'),
  array('meta_key'=>'project_details_text','post_title'=>'The good old classics','meta_value'=>'Client!:! Wise Guys Inc.
Project type!:! Web development
Project date!:! December 15th 2012
Skills!:! Wordpress, HTML5, javascript
URL!:! <a href="http://www.wiseguys.com">www.wiseguys.com</a>'),
  array('meta_key'=>'project_details_text','post_title'=>'The great skyline','meta_value'=>'Client!:! Wise Guys Inc.
Project type!:! Web development
Project date!:! December 15th 2012
Skills!:! Wordpress, HTML5, javascript
URL!:! <a href="http://www.wiseguys.com">www.wiseguys.com</a>'),
  array('meta_key'=>'project_details_text','post_title'=>'The great skyline','meta_value'=>'Client!:! Wise Guys Inc.
Project type!:! Web development
Project date!:! December 15th 2012
Skills!:! Wordpress, HTML5, javascript
URL!:! <a href="http://www.wiseguys.com">www.wiseguys.com</a>'),
  array('meta_key'=>'project_details_text','post_title'=>'The secret girl spy','meta_value'=>'Client!:! Wise Guys Inc.
Project type!:! Web development
Project date!:! December 15th 2012
Skills!:! Wordpress, HTML5, javascript
URL!:! <a href="http://www.wiseguys.com">www.wiseguys.com</a>'),
  array('meta_key'=>'project_details_text','post_title'=>'Under the clouds','meta_value'=>'Client!:! Wise Guys Inc.
Project type!:! Web development
Project date!:! December 15th 2012
Skills!:! Wordpress, HTML5, javascript
URL!:! <a href="http://www.wiseguys.com">www.wiseguys.com</a>'),
  array('meta_key'=>'project_details_text','post_title'=>'Wicked YouTube','meta_value'=>'Client!:! Wise Guys Inc.
Project type!:! Web development
Project date!:! December 15th 2012
Skills!:! Wordpress, HTML5, javascript
URL!:! <a href="http://www.wiseguys.com">www.wiseguys.com</a>'),
  array('meta_key'=>'project_details_text','post_title'=>'Wicked YouTube','meta_value'=>'Client!:! Wise Guys Inc.
Project type!:! Web development
Project date!:! December 15th 2012
Skills!:! Wordpress, HTML5, javascript
URL!:! <a href="http://www.wiseguys.com">www.wiseguys.com</a>'),
  array('meta_key'=>'project_details_title','post_title'=>'Audio example here','meta_value'=>'Project Details'),
  array('meta_key'=>'project_details_title','post_title'=>'Cool Vimeo video','meta_value'=>'Project Details'),
  array('meta_key'=>'project_details_title','post_title'=>'Cool Vimeo video','meta_value'=>'Project Details'),
  array('meta_key'=>'project_details_title','post_title'=>'DWA interior design','meta_value'=>'Project Details'),
  array('meta_key'=>'project_details_title','post_title'=>'Electric swordsman','meta_value'=>'Project Details'),
  array('meta_key'=>'project_details_title','post_title'=>'Jessica Watson musician','meta_value'=>'Project Details'),
  array('meta_key'=>'project_details_title','post_title'=>'Local video y\'all','meta_value'=>'Project Details'),
  array('meta_key'=>'project_details_title','post_title'=>'My naked roomie','meta_value'=>'Project Details'),
  array('meta_key'=>'project_details_title','post_title'=>'Nice items example','meta_value'=>'Project Details'),
  array('meta_key'=>'project_details_title','post_title'=>'Single image example','meta_value'=>'Project Details'),
  array('meta_key'=>'project_details_title','post_title'=>'Single image example','meta_value'=>'Project Details'),
  array('meta_key'=>'project_details_title','post_title'=>'Speed king studios','meta_value'=>'Project Details'),
  array('meta_key'=>'project_details_title','post_title'=>'The good old classics','meta_value'=>'Project Details'),
  array('meta_key'=>'project_details_title','post_title'=>'The great skyline','meta_value'=>'Project Details'),
  array('meta_key'=>'project_details_title','post_title'=>'The great skyline','meta_value'=>'Project Details'),
  array('meta_key'=>'project_details_title','post_title'=>'The secret girl spy','meta_value'=>'Project Details'),
  array('meta_key'=>'project_details_title','post_title'=>'Under the clouds','meta_value'=>'Project Details'),
  array('meta_key'=>'project_details_title','post_title'=>'Wicked YouTube','meta_value'=>'Project Details'),
  array('meta_key'=>'project_details_title','post_title'=>'Wicked YouTube','meta_value'=>'Project Details'),
  array('meta_key'=>'slider_type','post_title'=>'3D Slider','meta_value'=>'slider3d'),
  array('meta_key'=>'slider_type','post_title'=>'About <span class="highlight">Us</span>','meta_value'=>'mainslider1'),
  array('meta_key'=>'slider_type','post_title'=>'About <span class="highlight">Us</span> #2','meta_value'=>'mainslider1'),
  array('meta_key'=>'slider_type','post_title'=>'Blur Slider','meta_value'=>'mainslider1'),
  array('meta_key'=>'slider_type','post_title'=>'Comment Page Test','meta_value'=>'mainslider1'),
  array('meta_key'=>'slider_type','post_title'=>'Comparison <span class="highlight">tables</span>','meta_value'=>'mainslider1'),
  array('meta_key'=>'slider_type','post_title'=>'Contact <span class="highlight">Us</span>','meta_value'=>'mainslider1'),
  array('meta_key'=>'slider_type','post_title'=>'Cool <span class="highlight">Elements</span>','meta_value'=>'mainslider1'),
  array('meta_key'=>'slider_type','post_title'=>'Cool <span class="highlight">Sliders</span>','meta_value'=>'mainslider1'),
  array('meta_key'=>'slider_type','post_title'=>'Feature <span class="highlight">FAQ</span>','meta_value'=>'mainslider1'),
  array('meta_key'=>'slider_type','post_title'=>'Fullwidth slider','meta_value'=>'fullwidthslider'),
  array('meta_key'=>'slider_type','post_title'=>'Home <span class="highlight">2</span>','meta_value'=>'mainslider1'),
  array('meta_key'=>'slider_type','post_title'=>'Home <span class="highlight">3</span>','meta_value'=>'mainslider1'),
  array('meta_key'=>'slider_type','post_title'=>'Homepage','meta_value'=>'mainslider1'),
  array('meta_key'=>'slider_type','post_title'=>'Our <span class="highlight">Services</span>','meta_value'=>'mainslider1'),
  array('meta_key'=>'slider_type','post_title'=>'Our <span class="highlight">Services</span> #2','meta_value'=>'mainslider1'),
  array('meta_key'=>'slider_type','post_title'=>'Pricing <span class="highlight">Options</span>','meta_value'=>'mainslider1'),
  array('meta_key'=>'slider_type','post_title'=>'Pricing <span class="highlight">Tables</span>','meta_value'=>'mainslider1'),
  array('meta_key'=>'slider_type','post_title'=>'Side <span class="highlight">Menu</span>','meta_value'=>'mainslider1'),
  array('meta_key'=>'slider_type','post_title'=>'Simple Slider','meta_value'=>'simpleslider'),
  array('meta_key'=>'slider_type','post_title'=>'The <span class="highlight">Gallery</span>','meta_value'=>'mainslider1'),
  array('meta_key'=>'slider_type','post_title'=>'The <span class="highlight">Gallery</span> #2','meta_value'=>'mainslider1'),
  array('meta_key'=>'slider_type','post_title'=>'The <span class="highlight">Gallery</span> #3','meta_value'=>'mainslider1'),
  array('meta_key'=>'slider_type','post_title'=>'Typo<span class="highlight">graphy</span>','meta_value'=>'mainslider1'),
  array('meta_key'=>'slider_type','post_title'=>'Typo<span class="highlight">graphy</span> #2','meta_value'=>'mainslider1'),
  array('meta_key'=>'social_icons','post_title'=>'Contact <span class="highlight">Us</span>','meta_value'=>'http://www.vimeo.com/
http://www.facebook.com/
http://www.linkedin.com/
http://www.twitter.com/
http://www.pinterest.com/'),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Ahoy there, I am the Vimeo post for your creative videos','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Ahoy there, I\'m the lighbox example','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Audio example here','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Click me, click me, I\'m the Vimeo post','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Cool Vimeo video','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Cool Vimeo video','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'DWA interior design','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Electric swordsman','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Guess what, I\'m the YouTube example','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Hello there, I am a single image post example','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Hello there, I am a single image post example','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Hey, I\'m the Flex slider post example','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'I am a Flex slider example and I can slide your images smoothly','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Jessica Watson musician','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Last but not least, I am the lightbox post and I can group media','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Local video y\'all','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Lorem ipsum sit amet faeris velitulat est','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'My naked roomie','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Nice items example','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Single image example','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Single image example','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Speed king studios','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Suspendi braus es vicat farus metis','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'The good old classics','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'The great skyline','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'The great skyline','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'The secret girl spy','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Under the clouds','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Wicked YouTube','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_thumbnail_id','post_title'=>'Wicked YouTube','meta_value'=>$gallery_slider_1),
  array('meta_key'=>'_wp_page_template','post_title'=>'3D Slider','meta_value'=>'default'),
  array('meta_key'=>'_wp_page_template','post_title'=>'About <span class="highlight">Us</span>','meta_value'=>'default'),
  array('meta_key'=>'_wp_page_template','post_title'=>'About <span class="highlight">Us</span> #2','meta_value'=>'default'),
  array('meta_key'=>'_wp_page_template','post_title'=>'Blur Slider','meta_value'=>'default'),
  array('meta_key'=>'_wp_page_template','post_title'=>'Comment Page Test','meta_value'=>'default'),
  array('meta_key'=>'_wp_page_template','post_title'=>'Comparison <span class="highlight">tables</span>','meta_value'=>'default'),
  array('meta_key'=>'_wp_page_template','post_title'=>'Contact <span class="highlight">Us</span>','meta_value'=>'page-contact.php'),
  array('meta_key'=>'_wp_page_template','post_title'=>'Cool <span class="highlight">Elements</span>','meta_value'=>'default'),
  array('meta_key'=>'_wp_page_template','post_title'=>'Cool <span class="highlight">Sliders</span>','meta_value'=>'default'),
  array('meta_key'=>'_wp_page_template','post_title'=>'Feature <span class="highlight">FAQ</span>','meta_value'=>'page-sidebar.php'),
  array('meta_key'=>'_wp_page_template','post_title'=>'Fullwidth slider','meta_value'=>'default'),
  array('meta_key'=>'_wp_page_template','post_title'=>'Home <span class="highlight">2</span>','meta_value'=>'default'),
  array('meta_key'=>'_wp_page_template','post_title'=>'Home <span class="highlight">3</span>','meta_value'=>'default'),
  array('meta_key'=>'_wp_page_template','post_title'=>'Homepage','meta_value'=>'default'),
  array('meta_key'=>'_wp_page_template','post_title'=>'Our <span class="highlight">Services</span>','meta_value'=>'default'),
  array('meta_key'=>'_wp_page_template','post_title'=>'Our <span class="highlight">Services</span> #2','meta_value'=>'default'),
  array('meta_key'=>'_wp_page_template','post_title'=>'Pricing <span class="highlight">Options</span>','meta_value'=>'default'),
  array('meta_key'=>'_wp_page_template','post_title'=>'Pricing <span class="highlight">Tables</span>','meta_value'=>'default'),
  array('meta_key'=>'_wp_page_template','post_title'=>'Sample Page','meta_value'=>'default'),
  array('meta_key'=>'_wp_page_template','post_title'=>'Side <span class="highlight">Menu</span>','meta_value'=>'page-sidebar.php'),
  array('meta_key'=>'_wp_page_template','post_title'=>'Simple Slider','meta_value'=>'default'),
  array('meta_key'=>'_wp_page_template','post_title'=>'The <span class="highlight">Gallery</span>','meta_value'=>'page-gallery.php'),
  array('meta_key'=>'_wp_page_template','post_title'=>'The <span class="highlight">Gallery</span> #2','meta_value'=>'page-gallery.php'),
  array('meta_key'=>'_wp_page_template','post_title'=>'The <span class="highlight">Gallery</span> #3','meta_value'=>'page-gallery.php'),
  array('meta_key'=>'_wp_page_template','post_title'=>'Typo<span class="highlight">graphy</span>','meta_value'=>'default'),
  array('meta_key'=>'_wp_page_template','post_title'=>'Typo<span class="highlight">graphy</span> #2','meta_value'=>'default'),




  array('meta_key'=>'description_bc_show','post_title'=>'3D Slider','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'About <span class="highlight">Us</span>','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'About <span class="highlight">Us</span> #2','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Ahoy there, I am the Vimeo post for your creative videos','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Ahoy there, I\'m the lighbox example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Audio example here','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Blur Slider','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Click me, click me, I\'m the Vimeo post','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Comment Page Test','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Comparison <span class="highlight">tables</span>','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Contact <span class="highlight">Us</span>','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Cool <span class="highlight">Elements</span>','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Cool <span class="highlight">Sliders</span>','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Cool Vimeo video','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Cool Vimeo video','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'DWA interior design','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Electric swordsman','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Feature <span class="highlight">FAQ</span>','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Fullwidth slider','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Guess what, I\'m the YouTube example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Hello there, I am a single image post example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Hello there, I am a single image post example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Hey, I\'m the Flex slider post example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Hey, I\'m the YouTube post and I can display milions of videos','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Home <span class="highlight">2</span>','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Home <span class="highlight">3</span>','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Homepage','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'I am a Flex slider example and I can slide your images smoothly','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Jessica Watson musician','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Last but not least, I am the lightbox post and I can group media','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Local video y\'all','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Lorem ipsum sit amet faeris velitulat est','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'My naked roomie','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Nice items example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Our <span class="highlight">Services</span>','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Our <span class="highlight">Services</span> #2','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Pricing <span class="highlight">Options</span>','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Pricing <span class="highlight">Tables</span>','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Side <span class="highlight">Menu</span>','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Simple Slider','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Single image example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Single image example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Speed king studios','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Suspendi braus es vicat farus metis','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'The <span class="highlight">Gallery</span>','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'The <span class="highlight">Gallery</span> #2','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'The <span class="highlight">Gallery</span> #3','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'The good old classics','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'The great skyline','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'The great skyline','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'The secret girl spy','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Typo<span class="highlight">graphy</span>','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Typo<span class="highlight">graphy</span> #2','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Under the clouds','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Wicked YouTube','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bc_show','post_title'=>'Wicked YouTube','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'3D Slider','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'About <span class="highlight">Us</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'About <span class="highlight">Us</span> #2','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'Blur Slider','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'Comment Page Test','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'Comparison <span class="highlight">tables</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'Contact <span class="highlight">Us</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'Cool <span class="highlight">Elements</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'Cool <span class="highlight">Sliders</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'Feature <span class="highlight">FAQ</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'Home <span class="highlight">2</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'Home <span class="highlight">3</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'Homepage','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'Our <span class="highlight">Services</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'Our <span class="highlight">Services</span> #2','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'Pricing <span class="highlight">Options</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'Pricing <span class="highlight">Tables</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'Side <span class="highlight">Menu</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'Simple Slider','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'The <span class="highlight">Gallery</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'The <span class="highlight">Gallery</span> #2','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'The <span class="highlight">Gallery</span> #3','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'Typo<span class="highlight">graphy</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_color','post_title'=>'Typo<span class="highlight">graphy</span> #2','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_image','post_title'=>'Blur Slider','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_image','post_title'=>'Comment Page Test','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_image','post_title'=>'Fullwidth slider','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_bg_image','post_title'=>'Home <span class="highlight">3</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_lower','post_title'=>'Comment Page Test','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'description_lower','post_title'=>'Homepage','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'3D Slider','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'About <span class="highlight">Us</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'About <span class="highlight">Us</span> #2','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Ahoy there, I am the Vimeo post for your creative videos','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Ahoy there, I\'m the lighbox example','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Blur Slider','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Click me, click me, I\'m the Vimeo post','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Comment Page Test','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Comparison <span class="highlight">tables</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Contact <span class="highlight">Us</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Cool <span class="highlight">Elements</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Cool <span class="highlight">Sliders</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Feature <span class="highlight">FAQ</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Fullwidth slider','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Guess what, I\'m the YouTube example','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Hello there, I am a single image post example','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Hello there, I am a single image post example','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Hey, I\'m the Flex slider post example','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Hey, I\'m the YouTube post and I can display milions of videos','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Home <span class="highlight">2</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Home <span class="highlight">3</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Homepage','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'I am a Flex slider example and I can slide your images smoothly','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Last but not least, I am the lightbox post and I can group media','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Lorem ipsum sit amet faeris velitulat est','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Our <span class="highlight">Services</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Our <span class="highlight">Services</span> #2','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Pricing <span class="highlight">Options</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Pricing <span class="highlight">Tables</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Side <span class="highlight">Menu</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Simple Slider','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Suspendi braus es vicat farus metis','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'The <span class="highlight">Gallery</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'The <span class="highlight">Gallery</span> #2','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'The <span class="highlight">Gallery</span> #3','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Typo<span class="highlight">graphy</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_height','post_title'=>'Typo<span class="highlight">graphy</span> #2','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'3D Slider','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'About <span class="highlight">Us</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'About <span class="highlight">Us</span> #2','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Ahoy there, I\'m the lighbox example','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Blur Slider','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Comment Page Test','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Comparison <span class="highlight">tables</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Contact <span class="highlight">Us</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Cool <span class="highlight">Elements</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Cool <span class="highlight">Sliders</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'DWA interior design','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Electric swordsman','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Feature <span class="highlight">FAQ</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Fullwidth slider','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Hello there, I am a single image post example','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Hello there, I am a single image post example','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Hey, I\'m the Flex slider post example','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Home <span class="highlight">2</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Home <span class="highlight">3</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Homepage','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'I am a Flex slider example and I can slide your images smoothly','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Jessica Watson musician','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Last but not least, I am the lightbox post and I can group media','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Lorem ipsum sit amet faeris velitulat est','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'My naked roomie','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Nice items example','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Our <span class="highlight">Services</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Our <span class="highlight">Services</span> #2','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Pricing <span class="highlight">Options</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Pricing <span class="highlight">Tables</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Side <span class="highlight">Menu</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Simple Slider','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Single image example','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Single image example','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Speed king studios','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Suspendi braus es vicat farus metis','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'The <span class="highlight">Gallery</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'The <span class="highlight">Gallery</span> #2','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'The <span class="highlight">Gallery</span> #3','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'The good old classics','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'The great skyline','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'The great skyline','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'The secret girl spy','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Typo<span class="highlight">graphy</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Typo<span class="highlight">graphy</span> #2','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'featured_image_video_link','post_title'=>'Under the clouds','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'3D Slider','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'About <span class="highlight">Us</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'About <span class="highlight">Us</span> #2','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Ahoy there, I am the Vimeo post for your creative videos','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Ahoy there, I\'m the lighbox example','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Blur Slider','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Click me, click me, I\'m the Vimeo post','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Comment Page Test','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Comparison <span class="highlight">tables</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Contact <span class="highlight">Us</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Cool <span class="highlight">Elements</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Cool <span class="highlight">Sliders</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Feature <span class="highlight">FAQ</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Fullwidth slider','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Guess what, I\'m the YouTube example','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Hello there, I am a single image post example','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Hello there, I am a single image post example','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Hey, I\'m the YouTube post and I can display milions of videos','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Home <span class="highlight">2</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Home <span class="highlight">3</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Homepage','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Last but not least, I am the lightbox post and I can group media','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Lorem ipsum sit amet faeris velitulat est','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Our <span class="highlight">Services</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Our <span class="highlight">Services</span> #2','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Pricing <span class="highlight">Options</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Pricing <span class="highlight">Tables</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Side <span class="highlight">Menu</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Simple Slider','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Suspendi braus es vicat farus metis','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Typo<span class="highlight">graphy</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'gallery_slider','post_title'=>'Typo<span class="highlight">graphy</span> #2','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'map_show','post_title'=>'3D Slider','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'About <span class="highlight">Us</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'About <span class="highlight">Us</span> #2','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Ahoy there, I am the Vimeo post for your creative videos','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Ahoy there, I\'m the lighbox example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Audio example here','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Blur Slider','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Click me, click me, I\'m the Vimeo post','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Comment Page Test','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Comparison <span class="highlight">tables</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Contact <span class="highlight">Us</span>','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Cool <span class="highlight">Elements</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Cool <span class="highlight">Sliders</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Cool Vimeo video','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Cool Vimeo video','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'DWA interior design','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Electric swordsman','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Feature <span class="highlight">FAQ</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Fullwidth slider','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Guess what, I\'m the YouTube example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Hello there, I am a single image post example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Hello there, I am a single image post example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Hey, I\'m the Flex slider post example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Hey, I\'m the YouTube post and I can display milions of videos','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Home <span class="highlight">2</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Home <span class="highlight">3</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Homepage','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'I am a Flex slider example and I can slide your images smoothly','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Jessica Watson musician','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Last but not least, I am the lightbox post and I can group media','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Local video y\'all','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Lorem ipsum sit amet faeris velitulat est','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'My naked roomie','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Nice items example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Our <span class="highlight">Services</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Our <span class="highlight">Services</span> #2','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Pricing <span class="highlight">Options</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Pricing <span class="highlight">Tables</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Side <span class="highlight">Menu</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Simple Slider','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Single image example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Single image example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Speed king studios','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Suspendi braus es vicat farus metis','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'The <span class="highlight">Gallery</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'The <span class="highlight">Gallery</span> #2','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'The <span class="highlight">Gallery</span> #3','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'The good old classics','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'The great skyline','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'The great skyline','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'The secret girl spy','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Typo<span class="highlight">graphy</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Typo<span class="highlight">graphy</span> #2','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Under the clouds','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Wicked YouTube','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'map_show','post_title'=>'Wicked YouTube','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'3D Slider','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'About <span class="highlight">Us</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'About <span class="highlight">Us</span> #2','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Ahoy there, I am the Vimeo post for your creative videos','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Ahoy there, I\'m the lighbox example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Audio example here','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Blur Slider','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Click me, click me, I\'m the Vimeo post','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Comment Page Test','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Comparison <span class="highlight">tables</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Contact <span class="highlight">Us</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Cool <span class="highlight">Elements</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Cool <span class="highlight">Sliders</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Cool Vimeo video','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Cool Vimeo video','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'DWA interior design','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Electric swordsman','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Feature <span class="highlight">FAQ</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Fullwidth slider','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Guess what, I\'m the YouTube example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Hello there, I am a single image post example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Hello there, I am a single image post example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Hey, I\'m the Flex slider post example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Hey, I\'m the YouTube post and I can display milions of videos','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Home <span class="highlight">2</span>','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Home <span class="highlight">3</span>','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Homepage','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'I am a Flex slider example and I can slide your images smoothly','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Jessica Watson musician','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Last but not least, I am the lightbox post and I can group media','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Local video y\'all','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Lorem ipsum sit amet faeris velitulat est','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'My naked roomie','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Nice items example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Our <span class="highlight">Services</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Our <span class="highlight">Services</span> #2','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Pricing <span class="highlight">Options</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Pricing <span class="highlight">Tables</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Side <span class="highlight">Menu</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Simple Slider','meta_value'=>'_!!!fieldChecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Single image example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Single image example','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Speed king studios','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Suspendi braus es vicat farus metis','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'The <span class="highlight">Gallery</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'The <span class="highlight">Gallery</span> #2','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'The <span class="highlight">Gallery</span> #3','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'The good old classics','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'The great skyline','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'The great skyline','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'The secret girl spy','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Typo<span class="highlight">graphy</span>','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Typo<span class="highlight">graphy</span> #2','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Under the clouds','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Wicked YouTube','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'slider_show','post_title'=>'Wicked YouTube','meta_value'=>'_!!!fieldUnchecked!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'3D Slider','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'About <span class="highlight">Us</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'About <span class="highlight">Us</span> #2','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'Blur Slider','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'Comment Page Test','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'Comparison <span class="highlight">tables</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'Cool <span class="highlight">Elements</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'Cool <span class="highlight">Sliders</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'Feature <span class="highlight">FAQ</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'Fullwidth slider','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'Home <span class="highlight">2</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'Home <span class="highlight">3</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'Homepage','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'Our <span class="highlight">Services</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'Our <span class="highlight">Services</span> #2','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'Pricing <span class="highlight">Options</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'Pricing <span class="highlight">Tables</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'Side <span class="highlight">Menu</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'Simple Slider','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'The <span class="highlight">Gallery</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'The <span class="highlight">Gallery</span> #2','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'The <span class="highlight">Gallery</span> #3','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'Typo<span class="highlight">graphy</span>','meta_value'=>'_!!!fieldIsEmpty!!!_'),
  array('meta_key'=>'social_icons','post_title'=>'Typo<span class="highlight">graphy</span> #2','meta_value'=>'_!!!fieldIsEmpty!!!_'),

  array('meta_key' => '_additional_settings','post_title' => 'contact page form','meta_value' => ''),
  array('meta_key' => '_additional_settings','post_title' => 'WG - request quote','meta_value' => ''),
  array('meta_key' => '_form','post_title' => 'contact page form','meta_value' => '<p>Your Name*<br />
    [text* your-name] </p>

<p>Your Email*<br />
    [email* your-email] </p>

<p>Subject<br />
    [text your-subject] </p>

<p>Your Message*<br />
    [textarea* your-message] </p>

<p class="captcha">Captcha code: [captchac captcha-816]<br />
    [captchar captcha-816]</p>

<p>[submit "SEND MESSAGE"]</p>'),
  array('meta_key' => '_form','post_title' => 'WG - request quote','meta_value' => '<span class="black">Your name*</span><br />
[text* your-name akismet:author]

<span class="black">Your email*</span><br />
[email* your-email id:email]

<span class="black">Your website</span><br />
[text your-website id:website]

<span class="black">Your company type</span><br />
[select your-company id:type "Company" "Freelance" "Organisation"]


<span class="black">Preferred contact method:</span>
[radio contact-method use_label_element "Email" "Phone" "Telepathy"]

<span class="black">What kind of project do you need:</span>
[radio project-type use_label_element "PSD Design" "HTML / CSS / JS" "Wordpress"]

<span class="black">What\'s your budget:</span>
[radio budget use_label_element "1000$" "2000$" "3000$"]

<span class="black">Project details*</span>
[textarea* textarea-939]


<p class="captcha">Captcha code: [captchac captcha-816]<br />
    [captchar captcha-816]</p>

[submit "SEND MESSAGE"]'),
  array('meta_key' => '_mail','post_title' => 'contact page form','meta_value' => 'a:7:{s:7:"subject";s:14:"[your-subject]";s:6:"sender";s:26:"[your-name] <[your-email]>";s:4:"body";s:176:"From: [your-name] <[your-email]>
Subject: [your-subject]

Message Body:
[your-message]

--
This mail is sent via contact form on Wise Guys http://demo.freshface.net/file/wgc/wp";s:9:"recipient";s:27:"info@motionflashdesigns.com";s:18:"additional_headers";s:0:"";s:11:"attachments";s:0:"";s:8:"use_html";b:0;}'),
  array('meta_key' => '_mail','post_title' => 'WG - request quote','meta_value' => 'a:7:{s:7:"subject";s:14:"[your-subject]";s:6:"sender";s:26:"[your-name] <[your-email]>";s:4:"body";s:293:"From: [your-name] <[your-email]>
Website: [your-website]
Company: [your-company]
Preferred contact method: [contact-method]
Project type: [project-type]
Budget: [budget]

Project details:

[textarea-939]

--
This mail is sent via contact form on Wise Guys http://demo.freshface.net/file/wgc/wp";s:9:"recipient";s:27:"info@motionflashdesigns.com";s:18:"additional_headers";s:0:"";s:11:"attachments";s:0:"";s:8:"use_html";b:0;}'),
  array('meta_key' => '_mail_2','post_title' => 'contact page form','meta_value' => 'a:8:{s:6:"active";b:0;s:7:"subject";s:14:"[your-subject]";s:6:"sender";s:26:"[your-name] <[your-email]>";s:4:"body";s:118:"Message body:
[your-message]

--
This mail is sent via contact form on Wise Guys http://demo.freshface.net/file/wgc/wp";s:9:"recipient";s:12:"[your-email]";s:18:"additional_headers";s:0:"";s:11:"attachments";s:0:"";s:8:"use_html";b:0;}'),
  array('meta_key' => '_mail_2','post_title' => 'WG - request quote','meta_value' => 'a:8:{s:6:"active";b:0;s:7:"subject";s:14:"[your-subject]";s:6:"sender";s:26:"[your-name] <[your-email]>";s:4:"body";s:118:"Message body:
[your-message]

--
This mail is sent via contact form on Wise Guys http://demo.freshface.net/file/wgc/wp";s:9:"recipient";s:12:"[your-email]";s:18:"additional_headers";s:0:"";s:11:"attachments";s:0:"";s:8:"use_html";b:0;}'),
  array('meta_key' => '_messages','post_title' => 'contact page form','meta_value' => 'a:13:{s:12:"mail_sent_ok";s:43:"Your message was sent successfully. Thanks.";s:12:"mail_sent_ng";s:93:"Failed to send your message. Please try later or contact the administrator by another method.";s:16:"validation_error";s:74:"Validation errors occurred. Please confirm the fields and submit it again.";s:4:"spam";s:93:"Failed to send your message. Please try later or contact the administrator by another method.";s:12:"accept_terms";s:35:"Please accept the terms to proceed.";s:13:"invalid_email";s:28:"Email address seems invalid.";s:16:"invalid_required";s:31:"Please fill the required field.";s:23:"quiz_answer_not_correct";s:27:"Your answer is not correct.";s:13:"upload_failed";s:22:"Failed to upload file.";s:24:"upload_file_type_invalid";s:30:"This file type is not allowed.";s:21:"upload_file_too_large";s:23:"This file is too large.";s:23:"upload_failed_php_error";s:38:"Failed to upload file. Error occurred.";s:17:"captcha_not_match";s:31:"Your entered code is incorrect.";}'),
  array('meta_key' => '_messages','post_title' => 'WG - request quote','meta_value' => 'a:13:{s:12:"mail_sent_ok";s:43:"Your message was sent successfully. Thanks.";s:12:"mail_sent_ng";s:93:"Failed to send your message. Please try later or contact the administrator by another method.";s:16:"validation_error";s:74:"Validation errors occurred. Please confirm the fields and submit it again.";s:4:"spam";s:93:"Failed to send your message. Please try later or contact the administrator by another method.";s:12:"accept_terms";s:35:"Please accept the terms to proceed.";s:13:"invalid_email";s:28:"Email address seems invalid.";s:16:"invalid_required";s:31:"Please fill the required field.";s:23:"quiz_answer_not_correct";s:27:"Your answer is not correct.";s:13:"upload_failed";s:22:"Failed to upload file.";s:24:"upload_file_type_invalid";s:30:"This file type is not allowed.";s:21:"upload_file_too_large";s:23:"This file is too large.";s:23:"upload_failed_php_error";s:38:"Failed to upload file. Error occurred.";s:17:"captcha_not_match";s:31:"Your entered code is incorrect.";}'),
);

    }
}