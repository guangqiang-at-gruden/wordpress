<!-- Header content
        ================================================== -->
        <!-- For data-layout, you can choose between a color background like that "#aaa", "blur" or "image" -->
        <?php
        	$layout_type = 'blur';
        	if( fOpt::Get('skins', 'theme-background-blur') != 1 ) 
        		$layout_type = 'image';
        ?>
        <section id="noslider" class="sixteen columns headerContent" data-layout="<?php echo $layout_type; ?>">
        
            <div id="blurMask">
                <canvas id="blurCanvas"></canvas>
            </div>
            
            <div class="headerContentContainer">
               <div class="pageTitle">
               	<?php
               		echo $upperDescriptionTitle; 
               	?>
               	</div>
               <div class="breadCrumbs">
               <?php	
               
              		if( $showBreadcrumbs ) {
	               		$bc = ffBreadcrumbs::getInstance()->getBreadcrumbs();
	               		
	               		if( !empty( $bc ) ) {	
		               		foreach( $bc as $oneBc ) {
								
								if( $oneBc->selected == true ) echo '<span class="highlight">'; 
								else echo '<a href="'. $oneBc->url.'">';
								
									echo $oneBc->title;
									
								if( $oneBc->selected == true ) echo '</span>';
								else echo '</a>';
								
								if( $oneBc !== end($bc) ) echo ' / ';
							}  
						}
					}
               ?>
               </div>
            </div>
            
        </section>
        
