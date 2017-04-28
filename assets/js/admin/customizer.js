/**
 * Theme Customizer enhancements for a better user experience.
 * This is the JS that runs on the site in the preview window.
 */
( function( $ ) {

	// Update the site title in real time...
	wp.customize( 'blogname', function( setting ) {
		setting.bind( function( value ) {
			$( 'h1.site-title a' ).html( value );
		} );
	} );

	// Update the site description in real time...
	wp.customize( 'blogdescription', function( setting ) {
		setting.bind( function( value ) {
			$( '.site-description' ).html( value );
		} );
	} );

	// Update the headers layout.css
	wp.customize( 'lsx_header_layout', function( setting ) {
		setting.bind( function( value ) {
			$( 'body' ).removeClass( 'header-central' );
			$( 'body' ).removeClass( 'header-expanded' );
			$( 'body' ).addClass( 'header-' + value );
		} );
	});

	// Update the fixed header in real time...
	wp.customize( 'lsx_header_fixed', function( setting ) {
		setting.bind( function( value ) {
			if ( true == value ) {
				$( 'body header.navbar' ).addClass( 'navbar-static-top' );
				$( 'body' ).addClass( 'top-menu-fixed');
				lsx.set_main_menu_as_fixed();
			} else {
				$( 'body header.navbar' ).removeClass( 'navbar-static-top' );
				$( 'body' ).removeClass( 'top-menu-fixed' );
				$( 'body header.navbar' ).trigger( 'detach.ScrollToFixed' );
			}
		} );
	} );

	// Update the fixed header in real time...
	wp.customize( 'lsx_header_search', function( setting ) {
		setting.bind( function( value ) {
			if ( true == value ) {
				$( 'body #searchform' ).show();
			} else {
				$( 'body #searchform' ).hide();
			}
		} );
	} );

} )( jQuery );
