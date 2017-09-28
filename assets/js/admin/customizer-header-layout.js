/**
 * Theme Customizer layout control JS.
 */
jQuery( function( $ ) {

	// custom controls
	$( document ).on( 'click', '.header-layout-button', function() {
		var clicked = $( this ),
			currently_selected = $( '.selected-header-layout' );

		$( '.header-layout-button' ).each( function() {
			$( this ).css( 'border', '1px solid transparent' );
		} );

		clicked.css( 'border', '1px solid rgb(43, 166, 203)' );
		currently_selected.val( clicked.attr( 'data-option' ) ).trigger( 'change' );
	});

} );
