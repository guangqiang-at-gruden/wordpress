<?php

class ffComponentFeaturedWorks extends ffComponent {
	private function _getJackboxImage() {
		
	}
    function getComponent($data=null){

      $ret = '';
      
      $ret .= "\n".'<!-- Start FeaturedWorks component -->'."\n";

      

      $ret .= '<!-- Start section header -->';
      $ret .= '<div class="sectionHeader row">';

      $ret .= '<div class="sectionHeadingWrap">';
      $ret .= '<span class="sectionHeading">'.$data['title'].'</span>';
      $ret .= '</div>';

      $ret .= '<!-- Carousel navigation -->';
      $ret .= '<div class="carouselNav">';
      $ret .= '<div class="carouselPrevious"></div>';
      $ret .= '<div class="carouselNext"></div>';
      $ret .= '</div>';

      $ret .= '</div>';
      $ret .= '<!-- /End section header -->';

      $ret .= '<!-- Start carousel large-->';
      $ret .= '<div class="carouselWrapper large">';
      $ret .= '<ul class="carousel portfolio" data-autoPlay="'.$data['data-autoPlay'].'" data-autoDelay="'.$data['data-autoDelay'].'">';

      $posts = ffPostFeeder::getInstance()->getCategoryPosts($data['cat'], $data['count']);

      $index = 0;

      foreach($posts as $post) {

					$simGall = ffGalleryCollection::getGallery( $post->ID );

          $index++;

          if( $simGall->getFeaturedImage() == null ) continue;
		 	$fimg = $simGall->getFeaturedImage();
          $hoverClass = 'magnify';
          $imageLink = $simGall->getFeaturedImage()->image->url;
          
          $videoLink = metaBoxManager::getMeta('featured_image_video_link', null, $post->ID);
          if( !empty( $videoLink ) ) {
          	$hoverClass = 'play';
          	$imageLink = $videoLink;
          }
          
          $ret .= '<li>';

          
          /*<a class="jackbox" data-group="featured_works" data-thumbtooltip="YouTube video" data-autoplay="true" data-title="Image Title with &lt;a href='http://www.google.com' target=_blank'&gt;link&lt;/a&gt;" href="http://www.youtube.com/watch?v=i6T8LfDwQjo" data-thumbnail="http://img.youtube.com/vi/i6T8LfDwQjo/1.jpg">
          <canvas class="jackbox-canvas-blur" width="225" height="170" id="1360664436304" style="width: 225px; height: 170px;"></canvas><div class="jackbox-hover jackbox-hover-blur jackbox-hover-play"></div>
          <img width="225" height="170" src="images/portfolio/thumbs4/3.jpg" id="1360664436303">
          <span class="portfolioImageOver transparent"></span>
          </a>*/
          
          $ret .= '<figure>';
          $ret .= '<a class="jackbox" data-group="featured_works" data-thumbTooltip="';
          $ret .= $post->post_title;

          
          // - in HTML template there is something another, but dunno whith which data to fill it
          $ret .= '" data-title="'.get_the_title($post->ID).'" ';
          $ret .= 'data-description="" href="'.$imageLink.'">';

          $ret .= '<div class="jackbox-hover jackbox-hover-blur jackbox-hover-'.$hoverClass.'"></div>';
          $ret .= '<img width="225" height="170" src="'.$simGall->getFeaturedImage()->image->resize(225,170, true).'" alt="'.$simGall->getFeaturedImage()->altText.'" title="'.$fimg->title.'"/>';
          $ret .= '<span class="portfolioImageOver transparent"></span>';
          $ret .= '</a>';
          $ret .= '</figure>';

          $ret .= '<article data-targetURL="'.get_permalink($post->ID).'">';
          $ret .= '<p>';
          $ret .= $post->post_title;
          $ret .= '</p>';
          $ret .= '<span>'.metaBoxManager::getMeta('portfolio_image_description', null, $post->ID).'</span>';
          $ret .= '</article>';
          $ret .= '<span class="carouselArrow"></span>';
          
          if( empty($post->post_excerpt) ){
              $pos = strpos($post->post_content,'<!--more-->');
              if( FALSE !== $pos ){
                  $ret .= '<div class="jackbox-description" id="description_'.$index.'">';
                  $ret .= '<h3>'.get_the_title($post->ID).'</h3>';
                  $ret .= strip_tags(substr($post->post_content, 0, 220));
                  $ret .= '</div>';
              }
          }else{
              $ret .= '<div class="jackbox-description">';
              $ret .= '<h3>'.get_the_title($post->ID).'</h3>';
              $ret .= strip_tags(substr($post->post_excerpt, 0, 220));
              $ret .= '</div>';
          }
          $ret .= '</li>';
      }

      $ret .= '</ul>';
      $ret .= '<div class="clearfix"></div>';
      $ret .= '</div><!-- /End carousel -->';

      

      $ret .= "\n".'<!-- /End FeaturedWorks component -->'."\n";

      return $ret;
    }

}
/*
function test_ffComponentFeaturedWorks(){
    $data = array(
      'title' => 'FeaturedWorks WORKS',

      // Duuno what to give inti this: ( I read info from category post )

      'data-title' => "Image Title with <a href='http://themeforest.net/user/wiseguys' target=_blank'>link</a>",
      'data-autoPlay' => 'false',
      'data-autoDelay' => '3000',
      'cat' => 10,
      'count' => -1,
    );

    $instance = new ffComponentFeaturedWorks();
    $instance->printComponent( $data );

}

add_shortcode( 'featuredworks', 'test_ffComponentFeaturedWorks' );
*/
?>
