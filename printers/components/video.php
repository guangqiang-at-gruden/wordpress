<?php
fEnv::registerComponent( 'Video', 'componentVideo');
class componentVideo extends  componentBasic {
    protected $options = array(

    'modulename' => array(  'id' =>'html_name',
        'description' => 'Video',
        'type' => 'html_name'),

    'title' => array(  'id' => 'title',
        'description' => 'Title',
        'type' => 'text',
        'default' => 'Video'),

    'link' => array(  'id' => 'link',
        'description' => 'Youtube / Vimeo link to video ( NOT EMBED CODE )',
        'type' => 'text',
        'default' => 'http://www.youtube.com/watch?v=yHvfVmUoehc'),

    'width' => array(  'id' => 'video_width',
        'description' => 'Width',
        'type' => 'text',
        'default' => '293'),

    'height' => array(  'id' => 'video_height',
        'description' => 'Height',
        'type' => 'text',
        'default' => '200'),

    );
	 
    public function printComponent( $options ) {
        $link = $options['link'];
        $type = '';

        // detect type
        if( strpos( $link, 'youtube.com') !== false)
            $type = 'youtube';
        else if( strpos( $link, 'vimeo.com') !== false)
            $type = 'vimeo';

        // sanitize width and height
        $width = $options['video_width'];
        $height = $options['video_height'];

        if( empty($width)  ) $width  = 500;
        if( empty($height) ) $height = 300;

        // print youtube video
        if( $type == 'youtube') {
            $link_new = str_replace('watch?v=', 'embed/', $link);
            echo '<div class="video"><div class="youtube-video-player">';
            if( $options['title'] != '') echo '<h4>' . $options['title'] . '</h4>';
            echo '<iframe width="'.$width.'" height="'.$height.'" src="'.$link_new.'" frameborder="0" allowfullscreen></iframe></div></div>';
        }
        // print vimeo video
        else if( $type == 'vimeo' ) {
            $link_new = str_replace('vimeo.com/', 'player.vimeo.com/video/', $link);
            echo '<div class="video"><div class="vimeo-video-player">';
            if( $options['title'] != '') echo '<h4>' . $options['title'] . '</h4>';
            echo '<iframe src="'.$link_new.'" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';
        }
    }
}
?>