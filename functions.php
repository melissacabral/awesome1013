<?php
//unlock sleeping features
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-background' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-formats', 
	array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat') );

add_image_size( 'home-banner', 1120, 330, true );

//unlock the ability to add editor-style.css to control the editor screen
add_editor_style();

/**
 * Make Excerpts Better!
 * @since 1.0
 */
//control the length of the excerpt, in words
function awesome_excerpt_length(){
	return 75;
}
add_filter( 'excerpt_length', 'awesome_excerpt_length', 999 );

//change the [...]
function awesome_excerpt_readmore(){
	return ' <a href="' . get_permalink() . '" class="readmore">Read More</a>';
}
add_filter( 'excerpt_more', 'awesome_excerpt_readmore', 999 );

/**
 * improve UX when replying to nested comments. Bring the form to the user!
 * @since 1.0
 */
function awesome_comment_reply(){
	if( is_singular() AND comments_open() AND get_option('thread_comments') ):
		wp_enqueue_script('comment-reply');
	endif;
}
add_action( 'wp_print_scripts', 'awesome_comment_reply' );

/**
 * Add Navigation Menu Areas
 * @since 1.0
 */
add_action( 'init', 'awesome_setup_menus' );
function awesome_setup_menus(){
	register_nav_menus( array(
		'main_menu' => 'Main Navigation Bar',
		'utilities' => 'Utility Area'
	) );
}

/**
 * Set up Widget Areas
 * @since 1.0
 */
add_action( 'widgets_init', 'awesome_sidebars' );
function awesome_sidebars(){
	register_sidebar( array(
		'name' 			=> 'Blog Sidebar',
		'id' 			=> 'blog-sidebar',
		'description' 	=> 'Appears alongside all blog archives and posts',
		'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>',
	) );
	register_sidebar( array(
		'name' 			=> 'Home Area 1',
		'id' 			=> 'home-area-1',
		'description' 	=> 'Appears in the middle of the home page',
		'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>',
	) );
	register_sidebar( array(
		'name' 			=> 'Home Area 2',
		'id' 			=> 'home-area-2',
		'description' 	=> 'Appears at the bottom of the home page',
		'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>',
	) );
	register_sidebar( array(
		'name' 			=> 'Page Sidebar',
		'id' 			=> 'page-sidebar',
		'description' 	=> 'Appears alongside all static pages',
		'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>',
	) );
	register_sidebar( array(
		'name' 			=> 'Footer Area',
		'id' 			=> 'footer-area',
		'description' 	=> 'Appears at the bottom of every view',
		'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>',
	) );
}

/**
 * Custom Callback function
 * used in comments.php
 * from http://codex.wordpress.org/Function_Reference/wp_list_comments#Comments_Only_With_A_Custom_Comment_Display
 * @since 1.0
 */
function awesome_custom_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
?>
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>

		<?php //BEGIN CUSTOMIZING HERE  ?>

		<div class="comment-author vcard">
			<?php echo get_avatar( $comment->comment_author_email, $args['avatar_size'] ); ?>
			<span class="fn"><?php comment_author_link(); ?></span>
		</div>

<div class="comment-content">
	<?php if ($comment->comment_approved == '0') : ?>
		<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
		<br />
<?php endif; ?>

		<?php comment_text() ?>

		<div class="comment-meta commentmetadata">
			<span class="comment-date"><?php comment_date('F j, Y'); ?></span>
			<span class="comment-link"><a href="<?php comment_link(); ?>">link</a></span>
			<span class="edit-comment"><?php edit_comment_link(); ?></span>
			
			<?php if( comments_open() && $depth < $max_depth ): ?>
			<span class="comment-reply-button">
				<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</span>
			<?php endif; //comments open ?>

		</div>			
</div>	<!-- end comment-content -->

		<?php //STOP CUSTOMIZING HERE ?>

		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
<?php
} //end custom comment function


//no close php