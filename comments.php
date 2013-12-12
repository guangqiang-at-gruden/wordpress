<?php
global $fprinter;

function ff_framework_comments_end_callback($comment, $args, $depth) {
    echo '</li>';
    echo '<!-- END COMMENT -->';
    echo "\n";
}

function ff_framework_comments_callback($comment, $args, $depth) {
	
	// MUST BE PRESENT - WORDPRESS REQUIRE THIS SHIT ( dunno why)
	$GLOBALS['comment'] = $comment;
	$GLOBALS['comment_depth'] = $depth;
	
	static $comment_number_counter = 0;			
	$comment_number_counter++;
	
	$commentNumberDecoration = $comment_number_counter;
	if( $commentNumberDecoration < 10 ) $commentNumberDecoration = '0' . $commentNumberDecoration;

	//conopt
	$commentTimeFormat = fOpt::Get('translation', 'comment-time-format'); //'F j, Y, \a\t g:i A'; //December 30, 2012, at 10:30 PM
?>
	<!-- COMMENT -->                
	<li id="comment-<?php comment_ID() ?>" class="comment depth-<?php echo $depth; ?> clearfix row">                
		<div class="arrow"></div>
		<a href="<?php echo get_comment_author_url();  ?>" class="avatar">
			<?php echo get_avatar( get_comment_author_email(), '60', get_template_directory_uri().'/images/img60.jpg');?>
		</a>
		<div class="commentHeader">
			<h3><?php comment_author(); ?></h3>
			<div class="separator"></div>
			<div class="timeStamp"><?php echo get_comment_time($commentTimeFormat); ?></div>
			<div class="number"><?php echo $commentNumberDecoration; ?></div>
		</div>
		<?php 
			comment_text();
			if ($comment->comment_approved == '0') {
				echo '<p class="comment_approval">'. fOpt::Get('blog','tr-comment-approval').'</p>';
			}
		?>			 	
		<ul class="reply customButtons">
			<li class="button comment"> 
			<?php
				//conopt 
				comment_reply_link(array_merge($args, array(
				'reply_text' => fOpt::Get('translation', 'comment-reply'),
				'login_text' => fOpt::Get('translation', 'comment-log-in-to-reply'),
				'depth' => $depth,
				'before' => '',
				'after' => ''
				)));
				//conopt
			?>
			</li>
			
			<li class="lineSeparator"></li>
		</ul>                
<?php
	}                
?> 
<div class="clearfix"></div>
<div class="separator large row-fifty"></div>
<section class="comments" id="commentSection">
	<div class="sectionHeader row clearfix">
		<div class="sectionHeadingWrap">
			<span class="sectionHeading"><?php $fprinter->printCommentsNumber(); ?></span>
		</div>
	</div>
	<ul>
		<?php  wp_list_comments( array(
                'callback' => 'ff_framework_comments_callback',
                'end-callback' => 'ff_framework_comments_end_callback',
    )); ?>
	</ul>
</section>
<!-- Pagination
	================================================== -->
<section class="pagination clearfix row">
	<ul>
	 <?php 
	 		$commentPagination = new ffPaginationComments();
	 		$computedPagination  =$commentPagination->compute();
	 		if( get_option('page_comments') && !empty( $computedPagination ) && 0 != get_comments_number() ) {
		 		
		 		foreach( $computedPagination  as $oneComment ) {
					
					if( $oneComment['selected'] == true ) {
						echo '<li class="selected">';
					} else {
						echo '<li>';
						echo '<a href="'.$oneComment['link'].'" >';
					}
					
					if(  $oneComment['page'] == 'startdot' || $oneComment['page'] == 'enddot' ) {
						echo '...';
					} else {
						echo $oneComment['page'];
					}
					
					if( true == $oneComment['selected'] ) {
						echo '</li>';
					} else {
						echo '</a></li>';
					}
				} 
			}
	 ?>
	</ul>

</section>
<!-- #pagination -->
<div class="clearfix row"></div>
<?php 
$name = fOpt::get('translation', 'comment-name');
$email =fOpt::get('translation', 'comment-email');
$website = fOpt::get('translation', 'comment-website');
$content = fOpt::get('translation', 'comment-content');
$submit = fOpt::get('translation', 'comment-submit');

$mustLogin = fOpt::get('translation', 'comment-log-in-to-reply');

$loggedInAs = fOpt::get('translation', 'comment-log-in');



$commentForm = new ffCommentForm();

$commentForm->setFieldAuthor('<p class="comment-form-author">' . '<label for="author">' . $name . '</label> ' .'<input id="author" name="author" type="text" value="" size="30" /></p>');

$commentForm->setFieldEmail('<p class="comment-form-email"><label for="email">' . $email . '</label> ' . '<input id="email" name="email" type="text" value="" size="30" /></p>');

$commentForm->setFieldUrl('<p class="comment-form-url"><label for="url">' . $website . '</label>' . '<input id="url" name="url" type="text" value="" size="30" /></p>');

$commentForm->setFieldComment('<p class="comment-form-comment"><label for="comment">' .$content . '</label><textarea id="comment" name="comment" cols="45" rows="8"></textarea></p>');

$commentForm->setTextSubmit($submit);


//$commentForm->setTextMustLogIn($mustLogIn)( fOpt::Get('translation', 'comment-log-in') );

$commentForm->setTextLoggedInAs( $loggedInAs );
$commentForm->setTextCommentNotesAfter('');
$commentForm->setTextCommentNotesBefore('');
$commentForm->setTextTitle('');


$commentForm->setTextMustLogIn($mustLogin);
$commentForm->setTextCancelReplyLink( fOpt::Get('translation', 'comment-cancel' ) );


$commentForm->setIdForm('commentform');

$commentForm->setIdSubmit('submit');

$commentForm->setTextTitle( fOpt::get('translation', 'comment-enter-discussion') );

// ADJUSTING THE WORDPRESS FUNCTION TO BETTER FIT BY REPLACE RULES
//$commentForm->addReplaceRule('<div id="respond">', '<div id="respond"><h3 class="h5">NADPIS</h3>');
//$commentForm->addReplaceRule('id="reply-title"', 'style="display:none;"');
//$commentForm->addReplaceRule('id="submit"', 'id="submit" class="submit_comment"');

$commentForm->renderForm();