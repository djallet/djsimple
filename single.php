<?php
/**
 * The template for displaying any single post
 *
 * @package DJSimple Theme
 * @since 1.0
 */

// The get_header() function gets the header.php file and renders it.
get_header();
?>

<?php // Do we have any posts in the databse that match our query? ?>
<?php if ( have_posts() ) : ?>

	<?php
	// If we have a post to show, start a loop that will display it.
	while ( have_posts() ) :
		the_post();
		?>

		<article class="post">

			<h2 class="post-title"><?php the_title(); // Display the title of the post. ?></h2>

			<div class="post-meta">
				<div class="post-category">
					<?php the_category(); // Display the categories this post belongs to, as links. ?>
				</div><!-- .post-category -->
				&nbsp;&nbsp;&nbsp;
				<div class="post-date">
					<time datetime="<?php the_time( get_option( 'date_format' ) ); ?>">
						<?php the_time( get_option( 'date_format' ) ); // get_option uses the date format defined in Settings/General in the admin panel. ?>
					</time>
				</div><!-- .post-date -->
			</div><!-- .post-meta -->

			<?php if ( has_post_thumbnail() ) : // Check if thumbnail exists. ?>
			<figure class="post-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail( 'large' ); // Get the thumbnail of this post. ?>
				</a>
				<?php djsimple_post_thumbnail_caption(); ?>
			</figure> <!-- .post-thumbnail -->
			<?php endif; ?>

			<div class="post-content">
				<?php
				// The the_content() function calls the main content of the page, the stuff in the main text box while composing.
				// This will wrap everything in p tags.
				the_content();
				?>
				<?php wp_link_pages(); // This will display pagination links, if applicable to the page. ?>
			</div><!-- .post-content -->

			<div class="tags">
				<?php the_tags( __( 'Tags: ', 'djsimple' ), ', ', '' ); // Display the tags this post has, as links separated by comma. ?>
			</div>

		</article>

	<?php endwhile; // Stop the post loop once we've displayed it. ?>

	<?php
	// If comments are open or we have at least one comment, load up comments.php template.
	// comments.php is the default name, so '' as first parameter of comments_template() is ok.
	// We could have use the WordPress default template, but it is now mandatory to have one in a theme.
	// If we don't put one, Theme Check raises an error.
	if ( comments_open() || '0' !== get_comments_number() ) {
		comments_template( '', true );
	} elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) {
		esc_html_e( 'Comments are closed here.', 'djsimple' );
	}
	?>

<?php else : // If there are no posts to display and loop through, let's apologize to the reader (also your 404 error). ?>

	<article class="post error">
		<h2 class="error-title"><?php esc_html_e( 'Nothing has been posted like that yet.', 'djsimple' ); ?></h2>
	</article>

<?php endif; ?>

<?php 
// The get_footer(à function gets the footer.php file and renders it here.
get_footer();
?>
<!-- End of single.php -->
