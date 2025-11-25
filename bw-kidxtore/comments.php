<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package BzoTech-Framework
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if ( post_password_required() ) {
	return;
}
if(!function_exists('bzotech_comments_list'))
{ 
    function bzotech_comments_list($comment, $args, $depth) {
        $icon_reply = bzotech_get_icon_svg('reply');
        $GLOBALS['comment'] = $comment;
        /* override default avatar size */
        $args['avatar_size'] = 120;
        if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) :
            ?>
            <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
                <div class="comment-body">
                    <?php esc_html_e('Pingback:', 'bw-kidxtore'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(esc_html__('Edit', 'bw-kidxtore'), '<span class="edit-link"><i class="fa fa-pencil-square-o"></i>', '</span>'); ?>
                </div>
        <?php else : ?>
            <li <?php comment_class(empty($args['has_children']) ? '' : 'parent' ); ?>>
                <div id="comment-<?php comment_ID(); ?>" class="item-comment flex-wrapper">
                    <div class="comment-thumb vcard">
                        <?php
                            if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] );
                        ?>
                    </div>					
					<div class="comment-info">
                        <?php 
                        echo '<div class="author-date">'.get_comment_time('M d, Y').esc_html__(' at ','bw-kidxtore').get_comment_time('h:i A').'</div>';
                        echo '<div class="author-name">'.get_comment_author_link().'</div>';

                        ?>
						
                        <div class="content-comment desc-comment-text clearfix"><?php comment_text();?></div>
						
						<?php if (comments_open()): ?>
                            <?php echo str_replace('comment-reply-link', 'comment-reply-link reply-button', get_comment_reply_link(array_merge( $args, array(esc_html__('Reply','bw-kidxtore'),'depth' => $depth, 'max_depth' => $args['max_depth'])))) ?>
						<?php endif; ?>
					</div>
				</div>
        <?php
        endif;
    }
}

if ( have_comments() ) : ?>
    <div id="comments" class="comments-area comments bzotech-blog-list-comment ">
		<h3 class="anton title-comment-post"><span>
            <?php printf( _nx( '%1$s Comment', '%1$s Comments', get_comments_number(), 'comments title', 'bw-kidxtore' ),number_format_i18n( get_comments_number() ));?></span>
        </h3>
        <div class="comments">
        	<ul class="comment-list list-none">
	            <?php
	            wp_list_comments(array(
	                'style' 		=> '',
	                'short_ping' 	=> true,
	                'avatar_size' 	=> 70,
	                'max_depth' 	=> '5',
	                'callback' 		=> 'bzotech_comments_list',
	            ));
	            ?>
	        </ul>
        </div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'bw-kidxtore' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'bw-kidxtore' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'bw-kidxtore' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>
    </div><!-- #comments -->
<?php endif; // have_comments() ?>

<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
?>
	<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'bw-kidxtore' ); ?></p>
<?php endif; ?>

<?php
$comment_form = array(
    'title_reply' => esc_html__('Leave a comment', 'bw-kidxtore'),
    'fields' => apply_filters( 'comment_form_default_fields', array(
            'author' =>	'<div class="bzotech-row"><div class="bzotech-col-md-6"><p class="contact-name">
                            <span class="title-label"><span class="">* </span>'.esc_html__("Name",'bw-kidxtore').'</span>
                            <input class="border" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .'"/>
                        </p></div>',
            'email' =>	'<div class="bzotech-col-md-6"><p class="contact-email">
                            <span class="title-label"><span class="">* </span>'.esc_html__("Email",'bw-kidxtore').'</span>
                            <input class="border" id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .'" />
                        </p></div></div>',
            'url' =>	'<p class="contact-site">
                            <span class="title-label">'.esc_html__("Web Site",'bw-kidxtore').'</span>
                            <input class="border" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .'"/>
                        </p>',
        )
    ),
    'comment_field' =>  '<p class="contact-message">
                            <span class="title-label"><span class="">* </span>'.esc_html__("Comment",'bw-kidxtore').'</span>
                            <textarea id="comment" class="border" rows="5" name="comment" aria-required="true"></textarea>
                        </p>',
    'must_log_in' => '<div class="must-log-in control-group"><p class="desc silver">' .sprintf(wp_kses_post(__( 'You must be <a href="%s">logged in</a> to post a comment.','bw-kidxtore' )),wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )) . '</p></div >',
    'logged_in_as' => '<div class="logged-in-as control-group"><p class="desc silver">' .sprintf(wp_kses_post(__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','bw-kidxtore' )),admin_url( 'profile.php' ),$user_identity,wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )) . '</p></div>',
    'comment_notes_before' => '',
    'comment_notes_after' => '',
    'id_form'              => 'commentform',
    'id_submit'            => 'submit',
    'title_reply'          => esc_html__( 'Leave a comment','bw-kidxtore' ),
    'title_reply_to'       => esc_html__( 'Leave a Reply %s','bw-kidxtore' ),
    'cancel_reply_link'    => esc_html__( 'Cancel reply','bw-kidxtore' ),
    'label_submit'         => esc_html__( 'Post comment','bw-kidxtore' ),
    'class_submit'         => 'elbzotech-bt-default',
    'class_container'         => "comment-respond leave-comments reply-comment bzotech-blog-form-comment",
    'title_reply_before'=>'<h3 id="reply-title" class=" comment-reply-title font-title"><span>',
    'title_reply_after'=>'</span></h3>'
);
//get comment form
comment_form($comment_form); 


class bzotech_custom_comment extends Walker_Comment {
     
    /** START_LVL 
     * Starts the list before the CHILD elements are added. */
    function start_lvl( &$output, $depth = 0, $args = array() ) {       
        $GLOBALS['comment_depth'] = $depth + 1;

           $output .= '<div class="children">';
        }
 
    /** END_LVL 
     * Ends the children list of after the elements are added. */
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1;
        $output .= '</div>';
    }
    function end_el( &$output, $object, $depth = 0, $args = array() ) {
    	$output .= '';
    }
}