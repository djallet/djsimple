<?php
/**
/* The template for displaying any single page
 *
 * @package Simple Theme
 * @since 1.0
 */

// The get_header() function gets the header.php file and renders it.
get_header();
?>

<?php
// Do we have any pages in the databse that match our query?
// You will notice that we use the same functions have_posts() and the_posts() as in single.php.
// However, we will get pages content and not post content because we are in page.php.
?>
<?php if ( have_posts() ) : ?>

	<?php
	// If we have a page to show, start a loop that will display it.
	while ( have_posts() ) :
		the_post();
		?>

		<article class="post">

			<h2 class="post-title"><?php the_title(); // Display the title of the page. ?></h2>

			<div class="post-content">
				<?php
				// The the_content() function calls the main content of the page, the stuff in the main text box while composing.
				// This will wrap everything in p tags.
				the_content();
				?>
			</div><!-- .post-content -->

		</article>

	<?php endwhile; // Stop the page loop once we've displayed it. ?>

<?php else : // If there are no posts to display and loop through, let's apologize to the reader (also your 404 error). ?>

	<article class="post error">
		<h2 class="error-title"><?php esc_html_e( 'Nothing has been posted like that yet.', 'simple' ); ?></h2>
	</article>

<?php endif; ?>

<?php
// The get_footer() funtion gets the footer.php file and renders it here.
get_footer();
?>
<!-- End of page.php -->
