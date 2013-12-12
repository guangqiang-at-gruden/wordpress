<?php
$_ffContact_ll = metaBoxManager::getMeta('map_ll');//"34.052234,-118.243685";
$_ffContact_hnear = metaBoxManager::getMeta('map_hnear');

?>

        <!-- Main content
        ================================================== -->


        <section class="twelve columns clearfix contact <?php $fprinter->printSidebarPositionClass(); ?>">
<?php 


	if( metaboxManager::CHECKED_FIELD == metaboxManager::getMeta('map_show' ) ) {
?>
          <article class="gMap">
            <iframe width="695" height="348"
                    src="https://maps.google.co.uk/maps?f=q&amp;source=s_q&amp;q=<?php
              echo $_ffContact_hnear;
            ?>&amp;aq=&amp;ie=UTF8&amp;hq=&amp;hnear=<?php
              echo $_ffContact_hnear;
            ?>&amp;t=m&amp;z=10&amp;ll=<?php
              echo $_ffContact_ll;
            ?>&amp;iwloc=near&amp;output=embed"></iframe>
          </article>
<?php
	}
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
    the_content();
	endwhile;
endif;
?>

          <article>
               <ul class="socialIcons row">
               <?php 
               		$socialFeeder = new ffSocialFeeder( metaBoxManager::getMeta('social_icons') );
               		if( !empty( $socialFeeder->items ) ) {
	               		foreach( $socialFeeder->items as $oneItem ) {
							echo '<li class="'.$oneItem->type.' normal"><a class="tooltip" data-tooltipText="'.$oneItem->title.'" href="'.$oneItem->link.'">'.$oneItem->title.'</a></li>';
						}
					}
               ?>
              </ul>

          </article>

          <div class="divider large"></div>

          <section class="contactForm row">
             <?php
             $cfID = metaboxManager::getMeta('contact_form_name');
             if( 'nocf7' == $cfID ) {
             	echo 'You will need to install Contact Form 7 plugin';
             	return;
             }
             $shortcode = '[contact-form-7 id="'.$cfID.'"]';
             echo do_shortcode( $shortcode );
              ?>

             

          </section>


        </section><!-- End // main content -->
