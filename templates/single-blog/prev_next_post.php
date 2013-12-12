<?php 
	$prevPostObject = (get_adjacent_post(true,'', true));
	$nextPostObject = (get_adjacent_post(true,'', false));
	if( !empty( $prevPostObject ) ) {
		$prevPostTitle = $prevPostObject->post_title;
		
		if( 51 <= strlen( $prevPostTitle ) ) {
			
			$prevPostTitle = substr($prevPostTitle, 0, 51) . '...';
		}
		$prevPostLink = get_permalink( $prevPostObject );
	}
	
	if( !empty( $nextPostObject ) ) {
		$nextPostTitle = $nextPostObject->post_title;
	
		if( 51 <= strlen( $nextPostTitle ) ) {
				
			$nextPostTitle = substr($nextPostTitle, 0, 51) . '...';
		}
		$nextPostLink = get_permalink( $nextPostObject );
	}

	

?>
<?php 
if( !empty( $prevPostObject ) || !empty( $nextPostObject ) ) { 
?>

           <!-- separator
            ================================================== -->
            
            <div class="lineSeparator  twelve columns row"></div>
            
            
            <!-- Portfolio single navigation
            ================================================== -->
            
            <section class="projectNav row">
               <ul>
               	<?php 
               		if( !empty($prevPostObject) ) {
						echo '<li class="projectName"><a href="'.$prevPostLink.'">'.$prevPostTitle.'</a></li>'; 
					}
                ?>
                    
                  <ul>
                  <?php 
                  	if(  !empty($prevPostObject) ) {
						echo '<li class="projectPrev"><a href="'.$prevPostLink.'"></a></li>';
					}
					
					echo '<li class="separator"></li>';
					
					if( !empty($nextPostObject ) ) {
						echo '<li class="projectNext"><a href="'.$nextPostLink.'"></a></li>';
					}
                  ?>
                  </ul>
                  <?php 
               		if( !empty($nextPostObject) ) {
						echo '<li class="projectName"><a href="'.$nextPostLink.'">'.$nextPostTitle.'</a></li>';
					}
                ?>
               </ul>
            </section> 
            
            <!-- separator
            ================================================== -->
            
            <div class="lineSeparator twelve columns row bottomY-49"></div>

<?php 
}
?>