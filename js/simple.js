// Use $ shortcut
( function( $ ) {

	// Do various initializations
	$( document ).ready( function() {

		// Init scroll to top with quite high speed: 200
		$( '#toTop' ).scrollToTop( 200 );

		// Mobile menu callback
		$( '.mobile-menu' ).click( function( e ) {

			$( '.main-navigation ul' ).slideToggle( 500 );
			e.preventDefault();
		});
	});
})( jQuery );

