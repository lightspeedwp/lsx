/**
 * Theme Customizer layout control JS
 *
 */

( function( $ ) {
	
	// custom controls
	$(document).on('click', '.colour-button', function(){
		var clicked = $(this),
			parent = clicked.closest('.colours-selector'),
			input = parent.find('.selected-colour');
		parent.find( '.colour-button' ).css('border', '1px solid transparent');

		clicked.css( 'border', '1px solid rgb(43, 166, 203)');
		$(input).val( clicked.data('option') ).trigger('change');

	});

} )( jQuery );
