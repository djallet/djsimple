<?php
/**
 * This template will be called by all other template files to begin
 * rendering the page and display the header/nav
 *
 * @package Simple Theme
 * @since 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php // Specify the character encoding for the HTML document. ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<?php // Mobile device optimization defining viewport size as the screen size. ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<?php // Speed up google analytics domain name resolution. ?>
	<link href="//www.google-analytics.com" rel="dns-prefetch">

	<?php
	// For comments reply support using javascript.
	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// The wp_head() function allows plugins, and WordPress itself, to insert scripts/css/files right here.
	// For instance, WordPress uses this function to generate html header code for:
	// - a site meta description for search engines,
	// - favicons, using the image provided in theme setings of the admin panel,
	// - title tag, thanks to 'title-tag' theme support. See functions.php.
	// Keep it here just before </head> tag.
	wp_head();
	?>
</head>

<body
	<?php
	// The body_class() function will display a class specific to whatever is being loaded by WordPress,
	// i.e. on a home page, it will return [class="home"],
	// on a single post, it will return [class="single postid-{ID}"],
	// and the list goes on. Look it up if you want more.
	body_class();
	?>
>

<header id="top" class="header" <?php // Add id="top" to improve accessibility. ?>>

		<div class="brand">

			<h1 class="site-title">
				<a  href="<?php echo esc_url( home_url( '/' ) ); // Link to the home page. ?>"
					title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); // Title it with the blog name. ?>"
					rel="home"><?php bloginfo( 'name' ); // Display the blog name. ?>
				</a>
			</h1>
			<h2 class="site-description">
				<?php bloginfo( 'description' ); // Display the blog description, found in General Settings. ?>
			</h2>
			<?php // The following anchor displays the mobile menu. The '&#9776;' HTML character looks like a burger. ?>
			<a class="mobile-menu" href="#" aria-label="Menu">&#9776;</a>

		</div><!-- .brand -->

		<?php // This is the main navigation menu. It is the same on mobile and other devices, only styling change (see style.css). ?>
		<nav class="main-navigation" aria-label="Main navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'main' ) ); // Display the user-defined menu in Appearance > Menus. ?>
		</nav><!-- .main-navigation -->

</header><!-- .header -->

<main class="main" <?php // Start the page containter. ?>>
<!-- End of header.php -->
