<?php
/**
/* This template is a multi-purpose template for displaying anything except single post (which use single.php) and page (which use page.php)
/* For instance :
/* - homepage
/* - category page
/* - search result page
/* This template will also be called in any case where the WordPress engine doesn't know which template to use (e.g. 404 error)
 *
 * @package Simple Theme
 * @since 1.0
 */

// The get_header() function gets the content of header.php file and renders it here.
get_header();
?>

<h2 class="list-title">
<?php
// Show a title depending on the nature of the posts list.
if ( is_category() ) :
	// If we are displaying a category, show its title name.
	single_cat_title();
elseif ( is_search() ) :
	// If we are displaying a search result, show the search string.
	echo esc_html__( 'Search result for: ', 'simple' ) . esc_html( get_search_query( false ) );
elseif ( is_tag() ) :
	// If we are displaying a tag, show its name.
	esc_html_e( 'Tag: ', 'simple' ) . single_tag_title();
endif;
?>
</h2>

<?php
// Do we have any posts in the database that match our query?
// In the case of the homepage, this will call for the most recent posts.
if ( have_posts() ) :

	// If we have some posts to show, start a loop that will display each one the same way.
	while ( have_posts() ) :
		the_post();
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php
				// Adding role="presentation" excludes the thumbnail from accessibility tools.
				// This avoids redundant content and link with following title and excerpt.
			?>
			<figure class="post-thumbnail" role="presentation">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail( 'thumbnail' ); // Get the thumbnail of this post. ?>
				</a>
			</figure> <!-- .post-thumbnail -->

			<h2 class="post-title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php
					// The the_title() function shows the title of the post.
					// It is surrounded by a <a> tag to add a link to the post,
					// using the_permalink() function.
					the_title();
					?>
				</a>
			</h2><!-- .post-title -->

			<div class="post-meta">
				<div class="post-category">
					<?php
					// The the_category() function Display the categories this post belongs to, as links.
					the_category();
					?>
				</div><!-- .post-category -->
				&nbsp;&nbsp;&nbsp;
				<div class="post-date">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<time datetime="<?php the_time( 'Y-m-d' ); ?>">
							<?php
							// Permalink is added around the date in case the post has no title.
							// The get_option() function uses the date format defined in Settings/General in the admin panel of WordPress.
							the_time( get_option( 'date_format' ) );
							?>
						</time>
					</a>
				</div><!-- .post-date -->
			</div> <!-- .post-meta -->

			<div class="post-excerpt">
				<?php
				// the_excerpt() function display a summary of the post applying several filters to it.
				// This will wrap everything in p tags and show a link as 'Continue...'.
				the_excerpt();
				?>
			</div><!-- .post-excerpt -->

		</article>

	<?php endwhile; // Stop the posts loop once we've exhausted our query/number of posts. ?>

	<div class="pagination">
		<?php
		// The simple_pagination() function is defined in functions.php.
		// It generates the pagination to navigate between posts lists.
		simple_pagination();
		?>
	</div><!-- .pagination -->


<?php else : // If there is no post to display and loop through, let's apologize to the reader (also your 404 error). ?>

	<article class="post error">
		<h2 class="error-title"><?php esc_html_e( 'Nothing has been posted like that yet.', 'simple' ); ?></h2>
	</article>

<?php endif; ?>

<?php
// The get_footer() function gets the content of footer.php file and renders it here.
get_footer();
?>
<!-- End of index.php -->
