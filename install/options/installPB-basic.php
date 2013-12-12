<?php
  
class ffPBbasicOptionsInstall{

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
        
        // CSS
        $to_replace[]   = ";\n ";
        $replace_with[] = "; ";

        $to_replace[]   = "&nbsp;\n";
        $replace_with[] = "&nbsp;";

        $to_replace[]   = "&amp;\n";
        $replace_with[] = "&amp;";

        $to_replace[]   = ";\n\\";
        $replace_with[] = ";\\";

        $to_replace[]   = 'XXX_LOT_OF_SOCIAL_LINKS_XXX';
        $replace_with[] = 'http://vimeo.com/\nhttps://www.facebook.com/home.php\nXXX_LINKEDIN_URL_XXX\nhttps://twitter.com/_freshface\nhttp://pinterest.com/\nhttp://www.flickr.com/\nhttp://digg.com/\nhttp://uk.yahoo.com/\nhttp://www.reddit.com/\nhttps://plus.google.com/?hl=en\nhttp://www.stumbleupon.com/\nhttp://www.skype.com/\nhttp://www.deviantart.com/\nhttps://delicious.com/\nhttps://www.tumblr.com/\nhttp://www.last.fm/\nhttp://www.youtube.com/watch?v=L83cTan6ESk\nhttp://friendfeed.com/\nhttps://new.myspace.com/\nrss: http://googleblog.blogspot.com/feeds/posts/default?alt=rss\nhttp://badoo.com/\nhttp://dribbble.com/\nhttp://googleblog.blogspot.com/\nhomeicon: http://www.wiseguys-themes.com/wiseguys/\nphone: #911\nemail: mailto:someone@example.com?Subject=Hello\nhttp://picasa.google.com/\nhttp://lolcats.livejournal.com/\nhttp://www.bebo.com/\nhttp://technorati.com/\nhttp://www.newsvine.com/\nhttp://wordpress.org/\nhttp://www.yelp.com/';

        $to_replace[]   = 'XXX_FACEBOOK_URL_XXX';
        $replace_with[] = 'http://www.facebook.com/';

        $to_replace[]   = 'XXX_LINKEDIN_URL_XXX';
        $replace_with[] = 'http://www.linkedin.com/';

        $to_replace[]   = 'XXX_TWITTER_URL_XXX';
        $replace_with[] = 'http://www.twitter.com/_freshface';

        foreach ( $to_replace as $key=>$value) {
            $content = str_replace( $to_replace[$key], $replace_with[$key], $content);
        }
        
        $content = explode("\n", $content);
        foreach ($content as $key=>$line) {
            $line = trim($line);
            if( "s:" != substr($line, 0, 2) ){
                continue;
            }
            $comp = explode(":",$line,3);

            $comp[2] = substr($comp[2], 1);
            $comp[2] = substr($comp[2], 0, -2);
            $comp[2] = stripcslashes($comp[2]);
            
            // $comp[1] = strlen( stripcslashes($comp[2])) - 3 - substr_count($comp[2], "\\n") - substr_count($comp[2], "''") ;
            $content[ $key ] = $wpdb->escape( serialize($comp[2]) );
        }
        $content = implode("\n", $content);

        $content = str_replace(";\n", ";", $content);

        return $content;
    }

    function runSQLfromFile( $file_path ){
        $content = file_get_contents($file_path);
        $content = ffPBbasicOptionsInstall::replace($content);
        mysql_query( $content );
    }
    
    function install(){
        if( fOpt::Get('pagebuilder_templates', 'default') ){
            return;
        }
        if( fOpt::Get('pagebuilder_templates', 'aboutus') ){
            return;
        }
        ffPBbasicOptionsInstall::runSQLfromFile( dirname(__FILE__).'/data/db_pb_exp_basic.frs' );
    }
}