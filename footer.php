<?php
/**
 * This template will be called by all other template files to finish
 * rendering the page and display the footer area/content
 *
 * @package Simple Theme
 * @since 1.0
 */

?>

</main <?php // End page container, begun in the header. ?>>

<footer class="footer">

	<div class="footer-left">
		<?php dynamic_sidebar( 'footer-left' ); ?>
	</div><!-- .footer-left -->
	<div class="footer-middle">
		<?php dynamic_sidebar( 'footer-middle' ); ?>
	</div><!-- .footer-middle -->
	<div class="footer-right">
		<?php dynamic_sidebar( 'footer-right' ); ?>
	</div><!-- .footer-right -->

	<div class="site-info">
		<p><a href="https://github.com/djallet/simple" rel="theme"><?php esc_html_e( 'Simple Theme', 'simple' ); ?></a>
			<?php esc_html_e( 'was cooked for you on ', 'simple' ); ?><a href="http://wordpress.org" rel="generator">WordPress</a>
			<?php esc_html_e( 'by ', 'simple' ); ?><a href="https://jallet.org" rel="author">Denis Jallet</a>
		</p>
	</div><!-- .site-info -->

</footer><!-- .footer -->

<?php
// The wp_footer() function allows plugins to insert themselves/scripts/css/files (right here) into the footer of your website.
// Removing this fxn call will disable all kinds of plugins.
// Keep it here just before </body> tag.
wp_footer();
?>

</body>
</html>
<!-- End of footer.php -->
