/**
 * Add a listener to the Color Scheme control to update other color controls to new values/defaults.
 * Also trigger an update of the Color Scheme CSS when a color is changed.
 */

( function( api ) {
	var cssTemplate = wp.template( 'lsx-color-scheme' );

	api.controlConstructor.select = api.Control.extend( {
		ready: function() {
			if ( 'color_scheme' === this.id ) {
				this.setting.bind( 'change', function( value ) {
					var colors = colorScheme[value].colors;

					_.each( colors, function( color, i ) {
						if (typeof api( colorSchemeKeys[i] ) == 'function') {
							api( colorSchemeKeys[i] ).set( color );
							api.control( colorSchemeKeys[i] ).container.find( '.color-picker-hex' )
								.data( 'data-default-color', color )
								.wpColorPicker( 'defaultColor', color );
						}
					} );
				} );
			}
		}
	} );

	// Generate the CSS for the current Color Scheme.
	function updateCSS() {
		var scheme = api( 'color_scheme' )(),
			css,
			colors = _.object( colorSchemeKeys, colorScheme[ scheme ].colors );

		// Merge in color scheme overrides.
		_.each( colorSchemeKeys, function( setting ) {
			if (typeof api( setting ) == 'function') {
				colors[ setting ] = api( setting )();
			}
		} );

		css = cssTemplate( colors );
		api.previewer.send( 'update-color-scheme-css', css );
	}

	// Update the CSS whenever a color setting is changed.
	_.each( colorSchemeKeys, function( setting ) {
		api( setting, function( setting ) {
			setting.bind( updateCSS );
		} );
	} );
} )( wp.customize );
