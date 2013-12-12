<?php 	
if( (fOpt::Get('disqus', 'show-comments') == 1) && comments_open() ) {
	print_disqus_comments();
} else if( comments_open() ) {
	comments_template();
}
?>