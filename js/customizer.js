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
			$( 'a' ).css( 'color' , value );
		} );
	} );	
	
} )( jQuery );
