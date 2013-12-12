<?php
/**
 * Prints pagination from data received from fPaginationData.
 * 
 * The received data are in this format
 * page => pagenumber( eg. 1, 2, 50), prev, next, startdot, enddot
 * link => url or null
 * selected => true or false
 * 
 * @author boobs.lover
 */
class fPagination {
	
	/**
	 * 
	 * <section class="pagination clearfix row">
              <ul>
                  <li><a href="#">previous</a></li>
                  <li class="selected">1</li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">next</a></li>
              </ul>
            </section> <!-- #pagination -->
	 */
	
	
	public static function Render() {
		$pg = new fPaginationData();
		$data = $pg->compute();
		if( $data == null ) return;
		
		$before_button_selected = '<li class="selected">';		
		$after_button_selected = '</li>';		
		
		$before_button = '<li>';
		$after_button = '</li>';		
		
		$trans_next = fOpt::Get('translation', 'pagination-next');
		$trans_prev = fOpt::Get('translation', 'pagination-prev');
		$trans_dots = fOpt::Get('translation', 'pagination-dots');
		
		echo '<section class="pagination clearfix row">';
		echo '<ul>';	
		foreach( $data as $one_element ) {
		
			if( $one_element['selected'] == true ) {
				echo $before_button_selected;
				echo $one_element['page'];
				echo $after_button_selected;	
			} else if ( $one_element['page'] == 'startdot' || $one_element['page'] == 'enddot') {
				//echo '<div class="pagination_item">';				
				echo $before_button;
				echo $trans_dots;
				echo $after_button;
				//echo '</div>';
				
			} else {
				echo '<a href="'.$one_element['link'].'">';				
				echo $before_button;
				
				if( $one_element['page'] == 'next')
					echo $trans_next;
				else if( $one_element['page'] == 'prev')
					echo $trans_prev;
				else
					echo $one_element['page'];
				echo $after_button;
				echo '</a>';
			} 
				
			
			
		}
		
		echo '</ul>';
		echo '</section>';
	}
}
