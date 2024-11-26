<?php

if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

<?php	if ( have_comments() ) : ?>
		<h2 class="comments-title"><?php echo wp_kses_post( sprintf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'sonaar' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ) )?></h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 60,
				) );
			?>
		</ol><!-- .comment-list -->

<?php		if ( get_comment_pages_count() > 1 && get_option('page_comments') ) : ?>
		<nav class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text section-heading"><?php esc_html_e( 'Comment navigation', 'sonaar' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'sonaar' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'sonaar' ) ); ?></div>
		</nav><!-- .comment-navigation -->
<?php		endif; // Check for comment navigation ?>

<?php		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'sonaar' ); ?></p>
<?php		endif; ?>

<?php	endif; ?>
<?php
	$iron_sonaar_commenter = wp_get_current_commenter();
	$iron_sonaar_req = get_option( 'require_name_email' );
	$iron_sonaar_aria_req = ( $iron_sonaar_req ? " aria-required='true'" : '' );

	$iron_sonaar_args = array(
		'id_form'           => 'commentform',
		'id_submit'         => 'submit',
		'title_reply'       => translateString('tr_Leave_a_Reply'),
		'title_reply_to'    => translateString('tr_Leave_a_Reply_to'),
		'cancel_reply_link' => translateString('tr_Cancel_Reply'),
		'label_submit'      => translateString('tr_Post_Comment'),

		'comment_field' =>  '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' . esc_html(translateString('tr_Comment')) . '</textarea></p>',

		'fields' => apply_filters( 'comment_form_default_fields', array(

			'author' =>
			  '<p class="comment-form-author">' .
			  '<input id="author" name="author" type="text" value="' . esc_attr( $iron_sonaar_commenter['comment_author'] ) .
			  '" size="30"' . $iron_sonaar_aria_req . ' placeholder="'. esc_html(translateString('tr_Name')) . ( $iron_sonaar_req ? ' *' : '' ) .'"/></p>',

			'email' =>
			  '<p class="comment-form-email">' .
			  '<input id="email" name="email" type="text" value="' . esc_attr(  $iron_sonaar_commenter['comment_author_email'] ) .
			  '" size="30"' . $iron_sonaar_aria_req . ' placeholder="' . esc_html(translateString('tr_Email')) . ( $iron_sonaar_req ? ' *' : '' ) . '" /></p>'
			)
		  ),
		);
?>
	<?php comment_form($iron_sonaar_args); ?>

</div>