<?php
$_ffContact_ll = "34.052234,-118.243685";
$_ffContact_hnear = "Los+Angeles,+California,+United+States";

?>

        <!-- Main content
        ================================================== -->


        <section class="twelve columns clearfix contact">

          <article class="gMap">
            <iframe width="695" height="348" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                    src="https://maps.google.co.uk/maps?f=q&amp;source=s_q&amp;q=<?php
              echo $_ffContact_hnear;
            ?>&amp;aq=&amp;ie=UTF8&amp;hq=&amp;hnear=<?php
              echo $_ffContact_hnear;
            ?>&amp;t=m&amp;z=10&amp;ll=<?php
              echo $_ffContact_ll;
            ?>&amp;iwloc=near&amp;output=embed"></iframe>
          </article>

<?php

if ( have_posts() ) :
	while ( have_posts() ) : the_post();
    the_content();
	endwhile;
endif;

?>

          <article>

               <ul class="socialIcons row">
                 <li class="vimeo normal"><a class="tooltip" data-tooltipText="Vimeo" href="#">Vimeo</a></li>
                 <li class="facebook normal"><a class="tooltip" data-tooltipText="Facebook" href="#">Facebook</a></li>
                 <li class="linkedin normal"><a class="tooltip" data-tooltipText="LinkedIn" href="#">LinkedIn</a></li>
                 <li class="twitter normal"><a class="tooltip" data-tooltipText="Twitter" href="#">Twitter</a></li>
                 <li class="pinterest normal"><a class="tooltip" data-tooltipText="Pinterest" href="#">Pinterest</a></li>
                 <li class="flickr normal"><a class="tooltip" data-tooltipText="Flickr" href="#">Flickr</a></li>
                 <li class="digg normal"><a class="tooltip" data-tooltipText="Digg" href="#">Digg</a></li>
                 <li class="yahoo1 normal"><a class="tooltip" data-tooltipText="Yahoo" href="#">yahoo1</a></li>
                 <li class="reddit normal"><a class="tooltip" data-tooltipText="Reddit" href="#">Reddit</a></li>
                 <li class="googleplus normal"><a class="tooltip" data-tooltipText="Google plus" href="#">Googleplus</a></li>
                 <li class="stumbleupon normal"><a class="tooltip" data-tooltipText="Stumbleupon" href="#">Stumbleupon</a></li>
                 <li class="skype normal"><a class="tooltip" data-tooltipText="Skype" href="#">Skype</a></li>
                 <li class="deviantart normal"><a class="tooltip" data-tooltipText="Deviantart" href="#">Deviantart</a></li>
              </ul>

          </article>

          <div class="divider large"></div>

          <section class="contactForm">
             <h2>Contact form</h2>

             <div id="contact">

             <div id="message"></div>

              <form method="post" action="classes/contact.php" name="contactform" id="contactform">

              <fieldset>

              <input name="name" type="text" id="name" size="30" value="Name*" />


              <input name="email" type="text" id="email" size="30" value="Email*" />


              <input name="website" type="text" id="website" size="30" value="Website" />

              <select name="subject" id="subject">
                <option value="Subject" selected="selected">Choose a subject</option>
                <option value="Support">Support</option>
                <option value="Sale">Sales</option>
                <option value="Bug">Report a bug</option>
              </select>


              <textarea name="comments" cols="40" rows="3" id="comments">Message*</textarea>


              <input type="submit" class="submit button normal dark" id="submit" value="SEND MESSAGE" />

              <p class="verifyText">Are you human?<span class="required">*</span></p>
              <label for="verify" accesskey="V" id="verifyImage"><img src="classes/image.php" alt="Image verification" border="0"/></label>
              <input name="verify" type="text" id="verify" size="6" value="" style="width: 50px;" /><br /><br />



              </fieldset>

              </form>

             </div>

          </section>


        </section><!-- End // main content -->
