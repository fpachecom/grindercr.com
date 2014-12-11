<script type="text/javascript">
    $(document).ready(function(){
        // Toogle reviews
        $('.toogleReviews').click(function(e){
            e.preventDefault();
            var label = $(this).text();
            if (label == '<?php lang::_e('Show All Reviews'); ?>') {
                label = '<?php lang::_e('Hide Reviews'); ?>';
                $('.hiddenReview').show('fast');
            } else {
                label = '<?php lang::_e('Show All Reviews'); ?>';
                $('.hiddenReview').hide('fast');
            } 
            $(this).text(label);        
        });
    });
</script>

<div id="prod-leave-review-tab" class="product-info-box six columns">
    <h4><?php lang::_e('Reviews'); ?></h4>
	<div id="respond">
        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
            <div id="cancel-comment-reply">
                <small><?php cancel_comment_reply_link() ?></small>
            </div>
            <?php if ( $user_ID ) : ?>

            <p>
                <?php printf(lang::_('You logged as %s.'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?>
                <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php lang::_e('Exit') ?>"><?php lang::_e('Exit »'); ?></a>
            </p>

            <?php else : ?>

            <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" placeholder="<?php lang::_e('Nickname (Required)'); ?>" />

            <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" placeholder="<?php lang::_e('Email (Required)'); ?>" />

            <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" placeholder="<?php lang::_e('Website'); ?>" />


            <?php endif; ?>
            <?php comment_id_fields(); ?>

            <p><textarea name="comment" id="comment" tabindex="4" placeholder="<?php lang::_e('Review'); ?>"></textarea></p>

            <p>
                <input name="submit-contact" type="submit" id="submit" tabindex="5" value="<?php lang::_e('Post Review'); ?>" />
            </p>
            <?php do_action('comment_form', $post->ID); ?>

        </form>
    </div>
</div>
<div class="clear"></div>
<div id="prod-last-review-tab">
	<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php lang::_e( 'This post is password protected. Enter the password to view any comments.' ); ?></p>
	</div><!-- #comments -->
	<?php
			return;
		endif;
	?>

	<?php if ( have_comments() ) : ?>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-above">
			<h1 class="assistive-text"><?php lang::_e( 'Comment navigation' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( lang::_( '&larr; Older Reviews' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( lang::_( 'Newer Reviews &rarr;' ) ); ?></div>
		</nav>
		<?php endif; ?>

		<ol class="commentlist">
			<?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
		</ol>
        
        <a href="#" class="toogleReviews"><?php lang::_e('Show All Reviews'); ?></a>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<div id="comment-nav-below">
			<h1 class="assistive-text"><?php lang::_e( 'Review navigation'); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( lang::_( '&larr; Older Reviews') ); ?></div>
			<div class="nav-next"><?php next_comments_link( lang::_( 'Newer Reviews &rarr;') ); ?></div>
		</div>
		<?php endif; // check for comment navigation ?>
	<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="nocomments"><?php lang::_e( 'Reviews are closed.'); ?></p>
	<?php endif; ?>
</div>
</div>
