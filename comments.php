<?php 
//hide all comments if this post is password protected
if( post_password_required() ):
	echo 'Enter the password to view the comments';
	return; //stop the rest of the file from running
endif;

//separate comment count from pings
$comments_by_type = &separate_comments($comments);
//count just the comments
$comment_count = count($comments_by_type['comment']);
//count the trackbacks and pingbacks combined
$trackback_count = count($comments_by_type['pings']);
 ?>

<section id="comments" class="clearfix">
	<h3 id="comments-title">
		<?php 
			echo $comment_count; 
			echo $comment_count == 1 ?  ' Comment' :  ' Comments'; ?> so far 

		<?php if(comments_open()): ?>
			| <a href="#respond">Leave a Comment</a>
		<?php else: ?>
			| Comments are Closed
		<?php endif; ?>
	</h3>

	<div class="commentlist">
		<?php wp_list_comments( array(
			'type' => 'comment',
			'style' => 'div',
			'avatar_size' => 70,
			'callback' => 'awesome_custom_comment', //defined in functions.php
		) ); ?>
	</div>

	<?php if( get_option('page_comments') AND get_comment_pages_count() > 1 ): ?>
	<div class="pagination">
		<?php previous_comments_link(); ?>
		<?php next_comments_link(); ?>
	</div>
	<?php endif; //paginated comments?>

	<?php comment_form(); ?>

</section><!-- end comments -->

<?php if( $trackback_count > 0): ?>
<section id="trackbacks" class="clearfix">
	<h3><?php echo $trackback_count; ?> Sites link here</h3>

	<ol>
		<?php wp_list_comments( array(
			'type' => 'pings', //trackbacks and pingbacks
			'page' => 1, //prevents comment pagination from affecting this list
			'per_page' => 100,
		) ); ?>
	</ol>

</section><!-- end trackbacks -->
<?php endif; //trackbacks exist ?>