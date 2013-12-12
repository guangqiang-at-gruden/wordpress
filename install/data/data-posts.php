<?php
  
class dataInstallPosts{

    public $structure;
    public $ids = array();
    
    function addToWP( $post_type = '' ){
        foreach( $this->structure as $key=>$settings) {
            if( ! empty($post_type) ){
                if( $post_type != $settings['post_type'] ){
                    continue;
                }
            }

            // avoid to insert that post twice
            //$post = get_page_by_title( $settings['post_title'], 'OBJECT', $settings['post_type'] );
            $post = ffGetByTitle::post( $settings['post_title'] );
            if( $post ){
                //$this->structure[$key]['ID'] = $post->ID;
                $this->structure[$key]['ID'] = $post;
            }else{
                $this->structure[$key]['ID'] = wp_insert_post( $settings, TRUE );
            }
            $this->ids[ $settings['post_title'] ] = $this->structure[$key]['ID'];
            
            // add featured image
            add_post_meta(
                $this->structure[$key]['ID'],
                '_thumbnail_id',
                ffGetByTitle::image('Placeholder #1'),
                true
            );

            if( !empty($settings['category']) ){
                $this->setTaxIds($this->structure[$key]['ID'], $settings['category'], 'category');
            }

            if( !empty($settings['post_tag']) ){
                $this->setTaxIds($this->structure[$key]['ID'], $settings['post_tag'], 'post_tag');
            }
        }
    }
    
    function setTaxIds($post_ID, $tax_text, $tax_type){

        if( FALSE === strpos($tax_text, ',') ){
            $t_tax = array( trim($tax_text) );
        }else{
            $t_tax = explode(',',$tax_text);
            foreach ($t_tax as $key=>$title) {
                $t_tax[$key] = trim($title);
            }
        }

        $tax_IDs = array();

        foreach ($t_tax as $key=>$title) {
            $tax_ID = ffGetByTitle::term($title);
            if( 0 == $tax_ID ){
                continue;
            }

            $tax_IDs[] = $tax_ID;
        }

        wp_set_object_terms( $post_ID, $tax_IDs, $tax_type, false);

    }

    function __construct(){

        $lorem = file_get_contents( dirname(__FILE__).'/lorem.txt' );
        $excerpt1 = "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas quis nisl quis mi pharetra euismod. Proin laoreet mi eget lorem laoreet quis tempus magna facilisis. Mauris eget libero sem, eget ultrices mi. Duis tristique rhoncus dolor a pharetra. Sed mollis nunc ac risus pretium sodales. Donec consequat, turpis at imperdiet porta, nunc tellus vulputate risus, hendrerit placerat ligula ligula sit amet justo. In eget bibendum nunc. Phasellus id suscipit dui. Duis leo eros, elementum in varius non, luctus sit amet mauris.";
        $excerpt2 = "Vivamus semper aliquet cursus. Sed non tincidunt nibh. Praesent fermentum euismod porttitor. Duis viverra fringilla nulla, sed gravida mi luctus ut. Maecenas pulvinar, sapien non eleifend suscipit, metus enim dapibus neque, vitae dapibus augue sapien sit amet lorem. Aenean purus ligula, elementum non consectetur sed, vestibulum eget odio. Vestibulum eu accumsan libero. Morbi tincidunt convallis nunc sit amet congue. Aenean venenatis nibh faucibus justo congue tincidunt. Nulla eget condimentum massa. Donec purus elit, egestas in placerat eu, consectetur non magna. Donec tempus mattis sem, sed fermentum dui imperdiet a. Sed commodo arcu a neque imperdiet cursus. Sed dictum mauris vitae purus fermentum feugiat. Nulla rhoncus rutrum tortor et elementum.";

        $this->structure = array();


        // PAGES


        $this->structure[] = array( 'post_title'=>'3D Slider',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'[templatebuilder name="aboutus"]');

        $this->structure[] = array( 'post_title'=>'About <span class="highlight">Us</span>',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'[templatebuilder name="aboutus"]');

        $this->structure[] = array( 'post_title'=>'About <span class="highlight">Us</span> #2',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'[templatebuilder name="about-us-2"]');

        $this->structure[] = array( 'post_title'=>'Blur Slider',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'[templatebuilder name="aboutus"]');

        $this->structure[] = array( 'post_title'=>'Comparison <span class="highlight">tables</span>',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'[templatebuilder name="comparisontables"]');

        $this->structure[] = array( 'post_title'=>'Contact <span class="highlight">Us</span>',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed iaculis consectetur turpis ut bibendum. Cum sociis natoque fajitin penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed sit amet molestie nisl. Aliquam sit amet auctor mauris. Donec ipsum urna, suscipit euismod tempus vitae, tincidunt quis leo. Suspendisse nisi lectus, tincidunt ut condimentum eu, pretium a purus. Nullam in quam sed nisi tincidunt convallis nec ac tellus. Quisque sodales lobortis nunc a ultrices.');

        $this->structure[] = array( 'post_title'=>'Cool <span class="highlight">Elements</span>',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'[templatebuilder name="coolelements"]');

        $this->structure[] = array( 'post_title'=>'Cool <span class="highlight">Sliders</span>',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'[templatebuilder name="coolsliders"]');

        $this->structure[] = array( 'post_title'=>'Feature <span class="highlight">FAQ</span>',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'[templatebuilder name="faq"]');

        $this->structure[] = array( 'post_title'=>'Fullwidth slider',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'[templatebuilder name="fullscreenslider"]');

        $this->structure[] = array( 'post_title'=>'Home <span class="highlight">2</span>',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'[templatebuilder name="home2"]');

        $this->structure[] = array( 'post_title'=>'Home <span class="highlight">3</span>',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'[templatebuilder name="home3"]');

        $this->structure[] = array( 'post_title'=>'Homepage',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'[templatebuilder name="homepage"]');

        $this->structure[] = array( 'post_title'=>'Our <span class="highlight">Services</span>',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'[templatebuilder name="our-services-one"]');

        $this->structure[] = array( 'post_title'=>'Our <span class="highlight">Services</span> #2',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'[templatebuilder name="our-services"]');

        $this->structure[] = array( 'post_title'=>'Pricing <span class="highlight">Options</span>',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'[templatebuilder name="pricing-options"]');

        $this->structure[] = array( 'post_title'=>'Pricing <span class="highlight">Tables</span>',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'[templatebuilder name="pricingtables"]');

        $this->structure[] = array( 'post_title'=>'Side <span class="highlight">Menu</span>',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'[templatebuilder name="sidemenu"]');

        $this->structure[] = array( 'post_title'=>'Simple Slider',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'[templatebuilder name="simpleslider"]');

        $this->structure[] = array( 'post_title'=>'The <span class="highlight">Gallery</span>',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'');

        $this->structure[] = array( 'post_title'=>'The <span class="highlight">Gallery</span> #2',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'');

        $this->structure[] = array( 'post_title'=>'The <span class="highlight">Gallery</span> #3',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'');

        $this->structure[] = array( 'post_title'=>'Typo<span class="highlight">graphy</span>',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'[templatebuilder name="typography"]');

        $this->structure[] = array( 'post_title'=>'Typo<span class="highlight">graphy</span> #2',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type'=>'page',
                                    'post_content'=>'[templatebuilder name="typography"]');

        /*
        $this->structure[] = array(
            'post_title'    => 'Blur Slider',
            'post_content'  => '[templatebuilder name="aboutus"]',
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_type'     => 'page',
        );
        $this->structure[] = array(
            'post_title'    => 'Fullwidth Slider',
            'post_content'  => '[templatebuilder name="aboutus"]',
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_type'     => 'page',
        );
        $this->structure[] = array(
            'post_title'    => '3D Slider',
            'post_content'  => '[templatebuilder name="aboutus"]',
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_type'     => 'page',
        );
        $this->structure[] = array(
            'post_title'    => 'Simple Slider',
            'post_content'  => '[templatebuilder name="aboutus"]',
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_type'     => 'page',
        );
        */

        // EXCERPT #1


        $this->structure[] = array(
            'post_title'    => 'Last but not least, I am the lightbox post and I can group media',
            'post_content'  => $lorem, 'post_excerpt' => $excerpt1, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Blog Large',
            'post_tag'      => 'Art, Branding, Development, HTML5, Marketing, PHP, Web Design, Web studio',
            'post_type'     => 'post', );

        $this->structure[] = array(
            'post_title'    => 'Ahoy there, I am the Vimeo post for your creative videos',
            'post_content'  => $lorem, 'post_excerpt' => $excerpt1, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Blog Large',
            'post_tag'      => 'Art, Branding, Development, HTML5, Marketing, PHP, Web Design, Web studio',
            'post_type'     => 'post', );

        $this->structure[] = array(
            'post_title'    => 'Hey, I\'m the YouTube post and I can display milions of videos',
            'post_content'  => $lorem, 'post_excerpt' => $excerpt1, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Blog Large',
            'post_tag'      => 'Art, Branding, Development, HTML5, Marketing, PHP, Web Design, Web studio',
            'post_type'     => 'post', );

        $this->structure[] = array(
            'post_title'    => 'I am a Flex slider example and I can slide your images smoothly',
            'post_content'  => $lorem, 'post_excerpt' => $excerpt1, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Blog Large',
            'post_tag'      => 'Art, Branding, Development, HTML5, Marketing, PHP, Web Design, Web studio',
            'post_type'     => 'post', );

        $this->structure[] = array(
            'post_title'    => 'Hello there, I am a single image post example',
            'post_content'  => $lorem, 'post_excerpt' => $excerpt1, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Blog Large',
            'post_tag'      => 'Art, Branding, Development, HTML5, Marketing, PHP, Web Design, Web studio',
            'post_type'     => 'post', );


        // EXCERPT #2


        $this->structure[] = array(
            'post_title'    => 'Lorem ipsum sit amet faeris velitulat est',
            'post_content'  => $lorem, 'post_excerpt' => $excerpt2, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Blog Medium',
            'post_tag'      => 'Art, Branding, Development, HTML5, Marketing, PHP, Web Design, Web studio',
            'post_type'     => 'post', );

        $this->structure[] = array(
            'post_title'    => 'Suspendi braus es vicat farus metis',
            'post_content'  => $lorem, 'post_excerpt' => $excerpt2, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Blog Medium, Featured Blog Posts',
            'post_tag'      => 'Art, Branding, Development, HTML5, Marketing, PHP, Web Design, Web studio',
            'post_type'     => 'post', );

        $this->structure[] = array(
            'post_title'    => 'Ahoy there, I\'m the lighbox example',
            'post_content'  => $lorem, 'post_excerpt' => $excerpt2, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Blog Medium, Featured Blog Posts',
            'post_tag'      => 'Art, Branding, Development, HTML5, Marketing, PHP, Web Design, Web studio',
            'post_type'     => 'post', );

        $this->structure[] = array(
            'post_title'    => 'Click me, click me, I\'m the Vimeo post',
            'post_content'  => $lorem, 'post_excerpt' => $excerpt2, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Blog Medium, Featured Blog Posts',
            'post_tag'      => 'Art, Branding, Development, HTML5, Marketing, PHP, Web Design, Web studio',
            'post_type'     => 'post', );

        $this->structure[] = array(
            'post_title'    => 'Guess what, I\'m the YouTube example',
            'post_content'  => $lorem, 'post_excerpt' => $excerpt2, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Blog Medium',
            'post_tag'      => 'Art, Branding, Development, HTML5, Marketing, PHP, Web Design, Web studio',
            'post_type'     => 'post', );

        $this->structure[] = array(
            'post_title'    => 'Hey, I\'m the Flex slider post example',
            'post_content'  => $lorem, 'post_excerpt' => $excerpt2, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Blog Medium',
            'post_tag'      => 'Art, Branding, Development, HTML5, Marketing, PHP, Web Design, Web studio',
            'post_type'     => 'post', );


        // PORTFOLIO


        $this->structure[] = array(
            'post_title'    => 'The good old classics',
            'post_content'  => $lorem, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Portfolio Filterable 3, Portfolio Filterable 4, Portfolio Filterable 5, Portfolio Pagination 3, Portfolio Pagination 4, Portfolio Pagination 5',
            'post_tag'      => 'Web Design',
            'post_type'     => 'portfolio', );

        $this->structure[] = array(
            'post_title'    => 'Jessica Watson musician',
            'post_content'  => $lorem, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Portfolio Filterable 3, Portfolio Filterable 4, Portfolio Filterable 5, Portfolio Pagination 3, Portfolio Pagination 4, Portfolio Pagination 5',
            'post_tag'      => 'Illustration',
            'post_type'     => 'portfolio', );

        $this->structure[] = array(
            'post_title'    => 'Speed king studios',
            'post_content'  => $lorem, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Portfolio Filterable 3, Portfolio Filterable 4, Portfolio Filterable 5, Portfolio Pagination 3, Portfolio Pagination 4, Portfolio Pagination 5',
            'post_tag'      => 'Web Design',
            'post_type'     => 'portfolio', );

        $this->structure[] = array(
            'post_title'    => 'My naked roomie',
            'post_content'  => $lorem, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Portfolio Filterable 3, Portfolio Filterable 4, Portfolio Filterable 5, Portfolio Pagination 3, Portfolio Pagination 4, Portfolio Pagination 5',
            'post_tag'      => 'Illustration',
            'post_type'     => 'portfolio', );

        $this->structure[] = array(
            'post_title'    => 'The secret girl spy',
            'post_content'  => $lorem, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Portfolio Filterable 3, Portfolio Filterable 4, Portfolio Filterable 5, Portfolio Pagination 3, Portfolio Pagination 4, Portfolio Pagination 5',
            'post_tag'      => 'Web Design',
            'post_type'     => 'portfolio', );

        $this->structure[] = array(
            'post_title'    => 'DWA interior design',
            'post_content'  => $lorem, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Portfolio Filterable 3, Portfolio Filterable 4, Portfolio Filterable 5, Portfolio Pagination 3, Portfolio Pagination 4, Portfolio Pagination 5',
            'post_tag'      => 'Illustration',
            'post_type'     => 'portfolio', );

        $this->structure[] = array(
            'post_title'    => 'Electric swordsman',
            'post_content'  => $lorem, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Portfolio Filterable 3, Portfolio Filterable 4, Portfolio Filterable 5, Portfolio Pagination 3, Portfolio Pagination 4, Portfolio Pagination 5',
            'post_tag'      => 'Web Design',
            'post_type'     => 'portfolio', );

        $this->structure[] = array(
            'post_title'    => 'The great skyline',
            'post_content'  => $lorem, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Portfolio Filterable 3, Portfolio Filterable 4, Portfolio Filterable 5, Portfolio Pagination 3, Portfolio Pagination 4, Portfolio Pagination 5',
            'post_tag'      => 'Illustration',
            'post_type'     => 'portfolio', );

        $this->structure[] = array(
            'post_title'    => 'Under the clouds',
            'post_content'  => $lorem, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Portfolio Filterable 3, Portfolio Filterable 4, Portfolio Filterable 5, Portfolio Pagination 3, Portfolio Pagination 4, Portfolio Pagination 5',
            'post_tag'      => 'Web Design',
            'post_type'     => 'portfolio', );

        $this->structure[] = array(
            'post_title'    => 'Audio example here',
            'post_content'  => $lorem, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Portfolio Filterable 3, Portfolio Filterable 4, Portfolio Filterable 5, Portfolio Pagination 3, Portfolio Pagination 4, Portfolio Pagination 5',
            'post_tag'      => 'Music',
            'post_type'     => 'portfolio', );

        $this->structure[] = array(
            'post_title'    => 'Nice items example',
            'post_content'  => $lorem, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Portfolio Filterable 3, Portfolio Filterable 4, Portfolio Filterable 5, Portfolio Pagination 3, Portfolio Pagination 4, Portfolio Pagination 5',
            'post_tag'      => 'Motion',
            'post_type'     => 'portfolio', );

        $this->structure[] = array(
            'post_title'    => 'Local video y\'all',
            'post_content'  => $lorem, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Portfolio Filterable 3, Portfolio Filterable 4, Portfolio Filterable 5, Portfolio Pagination 3, Portfolio Pagination 4, Portfolio Pagination 5',
            'post_tag'      => 'Motion',
            'post_type'     => 'portfolio', );

        $this->structure[] = array(
            'post_title'    => 'Wicked YouTube',
            'post_content'  => $lorem, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Portfolio, Portfolio Single, Portfolio Filterable 3, Portfolio Filterable 4, Portfolio Filterable 5, Portfolio Pagination 3, Portfolio Pagination 4, Portfolio Pagination 5',
            'post_tag'      => 'Motion',
            'post_type'     => 'portfolio', );

        $this->structure[] = array(
            'post_title'    => 'Cool Vimeo video',
            'post_content'  => $lorem, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Portfolio, Portfolio Single, Portfolio Filterable 3, Portfolio Filterable 4, Portfolio Filterable 5, Portfolio Pagination 3, Portfolio Pagination 4, Portfolio Pagination 5',
            'post_tag'      => 'Motion',
            'post_type'     => 'portfolio', );

        $this->structure[] = array(
            'post_title'    => 'Single image example',
            'post_content'  => $lorem, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Portfolio, Portfolio Single',
            'post_tag'      => '',
            'post_type'     => 'portfolio', );

        $this->structure[] = array(
            'post_title'    => 'The great skyline',
            'post_content'  => $lorem, 'post_status' => 'publish', 'post_author' => 1,
            'category'      => 'Portfolio, Portfolio Single',
            'post_tag'      => '',
            'post_type'     => 'portfolio', );


        $this->structure[] = array( 'post_title' => 'WG - request quote',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type' => 'wpcf7_contact_form',
                                    'post_content' => '<span class="black">Your name*</span><br />
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

[submit "SEND MESSAGE"]
[your-subject]
[your-name] <[your-email]>
From: [your-name] <[your-email]>
Website: [your-website]
Company: [your-company]
Preferred contact method: [contact-method]
Project type: [project-type]
Budget: [budget]

Project details:

[textarea-939]

--
This mail is sent via contact form on Wise Guys http://demo.freshface.net/file/wgc/wp
info@motionflashdesigns.com




[your-subject]
[your-name] <[your-email]>
Message body:
[your-message]

--
This mail is sent via contact form on Wise Guys http://demo.freshface.net/file/wgc/wp
[your-email]



Your message was sent successfully. Thanks.
Failed to send your message. Please try later or contact the administrator by another method.
Validation errors occurred. Please confirm the fields and submit it again.
Failed to send your message. Please try later or contact the administrator by another method.
Please accept the terms to proceed.
Email address seems invalid.
Please fill the required field.
Your answer is not correct.
Failed to upload file.
This file type is not allowed.
This file is too large.
Failed to upload file. Error occurred.
Your entered code is incorrect.');


        $this->structure[] = array( 'post_title' => 'contact page form',
                                    'comment_status'=>'closed','ping_status'=>'closed',
                                    'post_status'=>'publish','post_type' => 'wpcf7_contact_form',
                                    'post_content' => '<p>Your Name*<br />
    [text* your-name] </p>

<p>Your Email*<br />
    [email* your-email] </p>

<p>Subject<br />
    [text your-subject] </p>

<p>Your Message*<br />
    [textarea* your-message] </p>

<p class="captcha">Captcha code: [captchac captcha-816]<br />
    [captchar captcha-816]</p>

<p>[submit "SEND MESSAGE"]</p>
[your-subject]
[your-name] <[your-email]>
From: [your-name] <[your-email]>
Subject: [your-subject]

Message Body:
[your-message]

--
This mail is sent via contact form on Wise Guys http://demo.freshface.net/file/wgc/wp
info@motionflashdesigns.com




[your-subject]
[your-name] <[your-email]>
Message body:
[your-message]

--
This mail is sent via contact form on Wise Guys http://demo.freshface.net/file/wgc/wp
[your-email]



Your message was sent successfully. Thanks.
Failed to send your message. Please try later or contact the administrator by another method.
Validation errors occurred. Please confirm the fields and submit it again.
Failed to send your message. Please try later or contact the administrator by another method.
Please accept the terms to proceed.
Email address seems invalid.
Please fill the required field.
Your answer is not correct.
Failed to upload file.
This file type is not allowed.
This file is too large.
Failed to upload file. Error occurred.
Your entered code is incorrect.');


    }
}