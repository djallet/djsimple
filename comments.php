<?php
/**
 * This template will be called within single.php
 * for displaying and writing comments
 *
 * @package DJSimple Theme
 * @since 1.0
 */

?>

<div class="comments">
<?php if ( post_password_required() ) : // In case the post is password protected, ask the password before displaying comments. ?>

	<p><?php esc_html_e( 'Post is password protected. Enter the password to view any comments.', 'djsimple' ); ?></p>

<?php else : ?>

	<?php if ( have_comments() ) : // If there already are comments, display them. ?>

		<h2><?php comments_number(); ?></h2>

		<ul>
			<?php wp_list_comments(); ?>
		</ul>

		<?php paginate_comments_links(); // Show pagination for comments list if needed. ?>

	<?php endif; ?>

	<?php comment_form(); // Now display comment form to allow writing a new comment. ?>

<?php endif; ?>

</div><!-- .comments -->
<!-- End of comments.php -->
