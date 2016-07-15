/**
 * Add a listener to the Color Scheme control to update other color controls to new values/defaults.
 * Also trigger an update of the Color Scheme CSS when a color is changed.
 */

( function( api ) {
	var cssTemplate = wp.template( 'lsx-color-scheme' ),
		colorSchemeKeys = [
			'button_background_color',
			'button_background_hover_color',
			'button_text_color',
			'button_text_color_hover',

			'button_cta_background_color',
			'button_cta_background_hover_color',
			'button_cta_text_color',
			'button_cta_text_color_hover',

			'top_menu_background_color',
			'top_menu_text_color',
			'top_menu_text_hover_color',

			'header_background_color',
			'header_title_color',
			'header_title_hover_color',
			'header_description_color',

			'main_menu_background_color',
			'main_menu_background_hover_color',
			'main_menu_text_color',
			'main_menu_text_hover_color',

			'banner_background_color',
			'banner_text_color',

			'body_background_color',
			'body_text_color',
			'body_link_color',
			'body_link_hover_color',

			'footer_cta_background_color',
			'footer_cta_text_color',
			'footer_cta_link_color',
			'footer_cta_link_hover_color',

			'footer_widgets_background_color',
			'footer_widgets_text_color',
			'footer_widgets_link_color',
			'footer_widgets_link_hover_color',

			'footer_background_color',
			'footer_text_color',
			'footer_link_color',
			'footer_link_hover_color'
		],
		colorSettings = colorSchemeKeys;

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
		_.each( colorSettings, function( setting ) {
			if (typeof api( setting ) == 'function') {
				colors[ setting ] = api( setting )();
			}
		} );

		css = cssTemplate( colors );
		api.previewer.send( 'update-color-scheme-css', css );
	}

	// Update the CSS whenever a color setting is changed.
	_.each( colorSettings, function( setting ) {
		api( setting, function( setting ) {
			setting.bind( updateCSS );
		} );
	} );
} )( wp.customize );
