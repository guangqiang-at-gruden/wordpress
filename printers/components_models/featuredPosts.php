<?php

class ffComponentFeaturedPosts extends ffComponent {

    function getCommentCountString( $postID ){
          // get_comments_number().' 28 <a href="#">Comments</a>';$commZero = fOpt::Get('translation', 'post-comment-count-zero');
    		$commZero = fOpt::Get('translation', 'post-comment-count-zero');
			$commOne = fOpt::Get('translation', 'post-comment-count-one');
			$commMore = fOpt::Get('translation', 'post-comment-count-more');
			ob_start();					
			ff_comments_popup_link( $commZero, $commOne, $commMore, 'comments-link', '');
          	$retStr = ob_get_contents();
          	ob_clean();
          return $retStr;
    }

    function getComponent($data=null){

      $ret = '';
      
      $ret .= "\n".'<!-- Start FeaturedPost component -->'."\n";

      

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
      $ret .= '<ul class="carousel blog" data-autoPlay="'.$data['data-autoPlay'].'" data-autoDelay="'.$data['data-autoDelay'].'">';

      $posts = ffPostFeeder::getInstance()->getCategoryPosts($data['cat'], $data['count']);

      $index = 0;

      global $post;
      $currentPost = $post;
			
      foreach($posts as $post) {
          setup_postdata( $post );
          $simGall = ffGalleryCollection::getGallery( $post->ID );
          if( $simGall->getFeaturedImage() == null ) continue;
          $fimg = $simGall->getFeaturedImage();
          $index++;

          $ret .= '<li>';

          $ret .= '<img width="225" height="165" src="'.$simGall->getFeaturedImage()->image->resize(225,165, true).'" alt="'.$fimg->altText.'" title="'.$fimg->title.'" />';

          $ret .= '<div class="blogDate">';
          $ret .= '<p>';
          $ret .= date( 'd', strtotime($post->post_date) );
          $ret .= '</p>';
          $ret .= '<span>';
          $ret .= date( 'M Y', strtotime($post->post_date) );
          $ret .= '</span>';
          $ret .= '<div class="arrow-down"></div>';
          $ret .= '</div>';
          $ret .= '<article>';
          $ret .= '<a href="'.get_permalink().'"><h4>'.get_the_title().'</h4></a>';
          $ret .= '<p class="blogMeta">by <a href="'.get_the_author_link().'">'.get_the_author().'</a>, in ';
			
          $category = get_the_category();
          foreach ($category as $cat) {
              $ret .= '<a href="'.get_category_link($cat->term_id ).'">'.$cat->cat_name.'</a>, ';
              break;
          }

          $ret .= ' '.$this->getCommentCountString($post->ID);

          $ret .= '</p>';

          $ret .= '<p>';
          if( empty($post->post_excerpt) ){
          	
             // $pos = strpos($post->post_content,'<!--more-->');
              //if( FALSE !== $pos ){
                  //$ret .= substr($post->post_content, 0, $pos);
              //} else {
              	$ret.= strip_tags(substr($post->post_content, 0, 220));
              //}
              
          }else{
              
              $ret.= strip_tags(substr($post->post_excerpt, 0, 220));
          }
          
          $ret .= '</p>';
          $ret .= '</article>';
          $ret .= '</li>';
      }

      $post = $currentPost;
			setup_postdata( $post );

      $ret .= '</ul>';
      $ret .= '<div class="clearfix"></div>';
      $ret .= '</div><!-- /End carousel -->';

      

      $ret .= "\n".'<!-- /End FeaturedPost component -->'."\n";

      return $ret;
    }

}
/*
function test_ffComponentFeaturedPosts(){
    $data = array(
      'title' => 'FeaturedPost WORKS',

      // Duuno what to give inti this: ( I read info from category post )

      'data-title' => "Image Title with <a href='http://themeforest.net/user/wiseguys' target=_blank'>link</a>",
      'data-autoPlay' => 'false',
      'data-autoDelay' => '3000',
      'cat' => 10,
      'count' => -1,
    );

    $instance = new ffComponentFeaturedPosts();
    $instance->printComponent( $data );

}

add_shortcode( 'featuredposts', 'test_ffComponentFeaturedPosts' ); */

?>
