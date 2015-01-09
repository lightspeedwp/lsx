/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	
	// template for postMessage transport.
	wp.customize( 'my_setting', function( message ) {
		// push message
		message.bind( function( value ) {
			// Do stuff with pushed message value
<<<<<<< HEAD

=======
>>>>>>> d66d3db14d1c9d66dbba1f307c9d05c94b09d93e
			$( 'a' ).css( 'color' , value );
		} );
	} );	
	
} )( jQuery );
