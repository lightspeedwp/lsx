/**
 * Theme Customizer layout control JS.
 */
jQuery( function( $ ) {

	// custom controls mobile header
	$( document ).on( 'click', '.mobile-header-layout-button', function() {
		var clicked = $( this ),
			currently_selected = $( '.selected-mobile-header-layout' );

		$( '.mobile-header-layout-button' ).each( function() {
			$( this ).css( 'border', '1px solid transparent' );
		} );

		clicked.css( 'border', '1px solid rgb(43, 166, 203)' );
		currently_selected.val( clicked.attr( 'data-option' ) ).trigger( 'change' );
	});

} );
