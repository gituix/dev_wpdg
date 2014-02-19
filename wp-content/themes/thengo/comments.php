<?php
/**
 * Comments Template
 * @package WordPress
 * @subpackage Templuto
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!'));

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.'); ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<div class="comments_numbar">	<h3 id="comments"><?php comments_number(__('Zero Comments', THEME_SLUG), __('1 Comment', THEME_SLUG), __('% Comments', THEME_SLUG)); ?></h3></div>

	<div class="navigation_comment">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>

	<div class="commentlist" id="comments">
        <ol>
        <?php wp_list_comments( array( 'callback' => 'tpo_comment', 'type' => 'comment', 'avatar_size' => 40 ) ); ?>
        </ol>
	</div>
	<div class="navigation_comment">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If <?php  _e('Comments are closed.' , THEME_SLUG); ?> -->
		<p class="nocomments"><?php  _e('Comments are closed.' , THEME_SLUG); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

<h3><?php comment_form_title( __('Leave a Reply', THEME_SLUG), __('Leave a Reply to %s', THEME_SLUG) ); ?></h3>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p class="must-log-in"><?php echo sprintf( __('You must be <a href="%s">logged in</a> to post a comment.' , THEME_SLUG ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) ?></p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : 

echo '<p class="logged-in-as">' . sprintf( __('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' , THEME_SLUG ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>';

?>

<div id="commentbox-admin" >
	<label for="url"><?php  _e('Comment' , THEME_SLUG); ?></label> 
	<textarea name="comment" id="comment"  rows="9" tabindex="4"></textarea>
</div>

<?php else : ?>

<div id="commentbox-left" >
	<label for="author"><?php  _e('Name' , THEME_SLUG ); ?> <?php if ($req) echo "(required)"; ?></label>
    <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
    
     <label for="email"><?php  _e('Mail (will not be published)' , THEME_SLUG ); ?> <?php if ($req) echo "(required)"; ?></label>
    <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />

    <label for="url"><?php  _e('Website' , THEME_SLUG ); ?></label>  
    <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />

</div>
<div id="commentbox-right" >
	<label for="url"><?php  _e('Comment', THEME_SLUG); ?></label> 
	<textarea name="comment" id="comment"   rows="9" tabindex="4"></textarea>
</div>
<?php endif; ?>



<div id="commentbox-submit" ><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
<?php comment_id_fields(); ?>
</div>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>
