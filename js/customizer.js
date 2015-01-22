/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	
	// Update the site title in real time...
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( 'h1.site-title a' ).html( newval );
		} );
	} );
	
	//Update the site description in real time...
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( newval ) {
			$( '.site-description' ).html( newval );
		} );
	} );

	//Update site background color...
	wp.customize( 'background_color', function( value ) {
		value.bind( function( newval ) {
			$('body').css('background-color', newval );
		} );
	} );
	
	//Site Logo js for Jetpacks Site Logo
	wp.customize( 'site_logo', function( value ) {
		value.bind( function( newval ) {
			if($( 'body' ).hasClass('has-site-logo')){
			}else{
				
				/*jQuery.ajax({
			        type: "post",
			        url: lsx_customizer_params.ajaxurl,
			        data: {
			            action: 'wp_ajax_customizer_site_title'
			        },
			        success: function(response){ //so, if data is retrieved, store it in html
			            //if no categories are found
			            if(response != "") {
			            	$( 'body .navbar-header' ).ammed(response);
			            }
			        }
			    });*/	
				
				alert($('#customize-control-site_logo_header_text input').val());
			}
			
			
			
		} );
	} );	
} )( jQuery );
