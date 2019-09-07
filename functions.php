<?php
/**
 * This file will be referenced every time a template/page loads on your WordPress site
 * This is the place to define custom fxns and specialty code
 *
 * @package Simple Theme
 * @since 1.0
 */

/**
 * Usefull plugins to use with this theme:
 *  AMP - AMP enabler
 *  Disqus for WordPress - Manage comments using Disqus
 *  Enlighter - Customizable Syntax Highlighter
 *  Footnotes Made Easy
 *  Google Analytics Dashboard pour WP (GADWP)
 *  Open external links in a new window
 *  Social Pug - Display social share buttons
 *
 * To improve performance:
 *  Autoptimize - css and js minifying and combining, and more
 *  WP Fastest Cache - cache page system
 *
 * Recommended thumbnail size : 200x200
 */



/**
 * Define the version so we can easily replace it throughout the theme
 *
 * @since 1.0
 */
define( 'SIMPLE_VERSION', '1.0' );



/**
 * Sets up theme defaults and registers support for various WordPress features
 *
 * @since 1.0
 *
 * @global int $content_width
 */
add_action(
	'after_setup_theme',
	function() {
		// Set the default content width in pixel.
		$GLOBALS['content_width'] = 992;

		// Add Rss feed support to Head section.
		add_theme_support( 'automatic-feed-links' );

		// Add post thumbnail / featured image support.
		add_theme_support( 'post-thumbnails' );

		// Let WordPress handle <title> tag in order to allow plugins and child themes to override it.
		add_theme_support( 'title-tag' );

		// Enable HTML5 support for comments list, comment form, search form, gallery and caption.
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

		// Localisation support to enable theme translations.
		load_theme_textdomain( 'simple', get_template_directory() . '/languages' );

		// Register main menu for WordPress use.
		register_nav_menus(
			array(
				'main' => __( 'Main Menu', 'simple' ), // Register the main menu that will appear in header.
				// Copy and paste the line above right here if you want to make another menu,
				// just change the 'primary' and 'secondary' to another name.
			)
		);
	}
);



/**
 * Adding sidebars to WordPress
 *
 * @since 1.0
 */
add_action(
	'widgets_init',
	function() {
		// Left footer widget area.
		register_sidebar(
			array(
				'id'            => 'footer-left',                             // Sidebar id.
				'name'          => __( 'Footer Left', 'simple' ),             // Name that appears in the admin side.
				'description'   => __( 'Left footer widget area', 'simple' ), // Dumb description for the admin side.
				'before_widget' => '<div>',                                   // What to display before each widget.
				'after_widget'  => '</div>',                                  // What to display following each widget.
				'before_title'  => '<h3 class="widget-title">',               // What to display before each widget's title.
				'after_title'   => '</h3>',                                   // What to display following each widget's title.
				'empty_title'   => '',                                        // What to display in the case of no title defined for a widget.
			)
		);

		// Middle footer widget area.
		register_sidebar(
			array(
				'id'            => 'footer-middle',
				'name'          => __( 'Footer Middle', 'simple' ),
				'description'   => __( 'Middle footer widget area', 'simple' ),
				'before_widget' => '<div>',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
				'empty_title'   => '',
			)
		);

		// Right footer widget area.
		register_sidebar(
			array(
				'id'            => 'footer-right',
				'name'          => __( 'Footer Right', 'simple' ),
				'description'   => __( 'Right footer widget area', 'simple' ),
				'before_widget' => '<div>',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
				'empty_title'   => '',
			)
		);
		// Copy and paste the register_sidebar() fxn lines above right here if you want to make another sidebar,
		// just change the values of id and name to another word/name.
	}
);



/**
 * Add custom styles to wp_header() - Despite its name, wp_enqueue_scripts is the right action
 *
 * @since 1.0
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		// Normalize stylesheet.
		wp_register_style( 'normalize', get_template_directory_uri() . '/css/normalize.css', array(), '8.0.1', 'all' );

		// Theme stylesheet.
		wp_register_style( 'simple', get_template_directory_uri() . '/style.css', array( 'normalize' ), SIMPLE_VERSION, 'all' );

		// Enqueue styles - It will also enqueue normalize as simple depends on it.
		wp_enqueue_style( 'simple' );
	}
);



/**
 * Force all scripts to wp_footer() and add custom ones there too
 *
 * @since 1.0
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		// Force all scripts to footer.
		remove_action( 'wp_head', 'wp_print_scripts' );
		remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
		remove_action( 'wp_head', 'wp_enqueue_scripts', 1 );

		// Add scrolltotop.
		wp_register_script( 'scrolltotop', get_template_directory_uri() . '/js/scrolltotop.js', array( 'jquery' ), '1.0', true );

		// Add theme script.
		wp_register_script( 'simple', get_template_directory_uri() . '/js/simple.js', array( 'scrolltotop' ), SIMPLE_VERSION, true );

		// Enqueue scripts - It will also enqueue scrolltotop as djth depends on it.
		wp_enqueue_script( 'simple' );
	}
);



/**
 * Remove JS and CSS 'type' attributes which are not HTML5 compliant
 *
 * @since 1.0
 */
add_action(
	'template_redirect',
	function() {
		ob_start(
			function( $buffer ) {
				$buffer = str_replace( array( 'type="text/javascript"', "type='text/javascript'", 'type="text/css"', "type='text/css'" ), '', $buffer );

				return $buffer;
			}
		);
	}
);



/**
 * Add 'Scroll To Top' element in footer of any page
 *
 * @since 1.0
 */
add_action(
	'wp_footer',
	function() {
		$allowed_html =
		[
			'a'   =>
			[
				'href'   => [],
				'target' => [],
				'id'     => [],
			],
			'div' =>
			[
				'class' => [],
			],
		];

		// Add a text "To top" to improve accessibbility (ie screen reader).
		// "id=top" was also added to the "header" tag to explicit where the link goes (see header.php).
		$scroll_to_top = '<a href="#top" target="_top" id="toTop"><div class="arrow-up">To top</div></a>';

		echo wp_kses( $scroll_to_top, $allowed_html );
	}
);



/**
 * Excerpt length 30 words
 *
 * @since 1.0
 *
 * @param int $length The length of excerpt as number of words.
 */
add_filter(
	'excerpt_length',
	function( $length ) {
		return 30;
	},
	999
);



/**
 * Custom 'read more' in excerpt
 *
 * @since 1.0
 *
 * @param string $more The html code for more link in excerpt.
 */
add_filter(
	'excerpt_more',
	function( $more ) {
		if ( ! is_single() ) {
			$more = sprintf(
				'...&nbsp;<a class="read-more" href="%1$s">%2$s</a>',
				get_permalink( get_the_ID() ),
				__( 'Read More', 'simple' )
			);
		}
		return $more;
	}
);


/**
 * Custom pagination for paged posts list: Page 1, Page 2, Page 3, with Next and Previous Links
 * Thanks to HTML5Blank :-)
 *
 * @since 1.0
 */
function simple_pagination() {
	global $wp_query;
	$big = 999999999;

	// Escaping output to securize it with wp_kses.
	$allowed_html =
	[
		'span' =>
		[
			'aria-current' => [],
			'class'        => [],
		],
		'a'    =>
		[
			'class' => [],
			'href'  => [],
		],
	];

	echo wp_kses(
		paginate_links(
			array(
				'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'  => '?paged=%#%',
				'current' => max( 1, get_query_var( 'paged' ) ),
				'total'   => $wp_query->max_num_pages,
			)
		),
		$allowed_html
	);
}



/**
 * Post thumbnail caption, used with featured image
 *
 * @since 1.0
 */
function simple_post_thumbnail_caption() {
	// Escaping output to securize it with wp_kses.
	$allowed_html =
	[
		'div' =>
		[
			'class' => [],
		],
		'a'   =>
		[
			'title' => [],
			'href'  => [],
		],
	];

	$thumbnail_image = get_posts(
		array(
			'p'         => get_post_thumbnail_id(),
			'post_type' => 'attachment',
		)
	);

	if ( $thumbnail_image && isset( $thumbnail_image[0] ) && ! empty( $thumbnail_image[0]->post_excerpt ) ) {
		$caption  = '<div class="post-thumbnail-caption">' . PHP_EOL;
		$caption .= '                    ' . $thumbnail_image[0]->post_excerpt . PHP_EOL;
		$caption .= '                </div> <!-- /post-thumbnail-caption -->' . PHP_EOL;
		echo wp_kses( $caption, $allowed_html );
	}
}

