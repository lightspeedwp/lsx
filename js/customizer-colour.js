/**
 * Add a listener to the Color Scheme control to update other color controls to new values/defaults.
 * Also trigger an update of the Color Scheme CSS when a color is changed.
 */

( function( api ) {
	var cssTemplate = wp.template( 'lsx-color-scheme' ),
		skipUpdateCss = false;

	api.controlConstructor.select = api.Control.extend( {
		ready: function() {
			if ( 'color_scheme' === this.id ) {
				this.setting.bind( 'change', function( _value ) {
					skipUpdateCss = true;

					var _colors = colorScheme[_value].colors;

					_.each( _colors, function( _color, _setting ) {
						if ('function' === typeof api( _setting )) {
							api( _setting ).set( _color );
							api.control( _setting ).container.find( '.color-picker-hex' )
								.data( 'data-default-color', _color )
								.wpColorPicker( 'defaultColor', _color );
						}
					} );

					skipUpdateCss = false;
					updateCSS();
				} );
			}
		}
	} );

	// Generate the CSS for the current Color Scheme.
	function updateCSS() {
		if (skipUpdateCss) {
			return;
		}

		var __scheme = api( 'color_scheme' )(),
			__css,
			__colors = colorScheme[ __scheme ].colors;

		// Merge in color scheme overrides.
		_.each( colorSchemeKeys, function( __setting ) {
			if ('function' === typeof api( __setting )) {
				__colors[ __setting ] = api( __setting )();
			}
		} );

		__css = cssTemplate( __colors );
		api.previewer.send( 'update-color-scheme-css', __css );
	}

	// Update the CSS whenever a color setting is changed.
	_.each( colorSchemeKeys, function( __setting ) {
		api( __setting, function( __setting ) {
			__setting.bind( updateCSS );
		} );
	} );
} )( wp.customize );
