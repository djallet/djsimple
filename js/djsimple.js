// Use $ shortcut for jQuery object.
( function( $ ) {

	// Do various initializations.
	$( document ).ready( function() {

		// Init scroll to top with quite high speed: 200.
		$( '#toTop' ).scrollToTop( 200 );

		// Check if we need to initialize mobile menu on initial page load
		initMobileMenu();

		// Check if we need to initialize mobile menu on resize of the window
		$(window).resize( initMobileMenu );

		// Mobile menu callback.
		$( '.mobile-menu' ).click( function( e ) {
			$( '.main-navigation ul' ).slideToggle( 500 );
			e.preventDefault();
		});

	});

	// Check if we need to initialize mobile menu when it is displayed,
	// so we know we are on a mobile device.
	// Source : https://www.fourfront.us/blog/jquery-window-width-and-media-queries
	function initMobileMenu(){
		if ( $( '.mobile-menu' ).css( 'display' ) !== 'none' ) {
			$( '.main-navigation ul' ).hide();
		}
		else {
			// Caution ! Only works with this css rule in style.css:
			// .menu li:hover > ul { display: block !important; }
			// Otherwise, dropdown menus are not displayed.
			$( '.menu' ).show();
			
			// Hide sub menu in case it was previously open such as in mobile device mode
			$( '.sub-menu' ).hide();
		}
	}

})( jQuery );

