/**
 * LSX Scripts
 *
 * @package    lsx
 * @subpackage scripts
 */

var lsx = Object.create( null );

;( function( $, window, document, undefined ) {

	'use strict';

	var $document    = $( document ),
		$window      = $( window ),
		windowHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight,
		windowWidth  = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

	/**
	 * Test if the sidebar exists (if exists, add a class to the body).
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.add_class_sidebar_to_body = function() {
		if ( $( '#secondary' ).length > 0 ) {
			$( 'body' ).addClass( 'has-sidebar' );
		}
	};

	/**
	 * Add Bootstrap class to WordPress tables.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.add_class_bootstrap_to_table = function() {
		var tables = $( 'table#wp-calendar' );

		if ( tables.length > 0 ) {
			tables.addClass( 'table' );
		}
	};

	/**
	 * Fix Bootstrap menus (touchstart).
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.fix_bootstrap_menus_touchstart = function() {
		$( '.dropdown-menu' ).on( 'touchstart.dropdown.data-api', function( e ) {
			e.stopPropagation();
		} );
	};

	/**
	 * Fix Bootstrap menus (dropdown).
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.fix_bootstrap_menus_dropdown = function() {
		$( '.dropdown' ).on( 'show.bs.dropdown', function() {
			if ( windowWidth < 1200 ) {
				$( this ).siblings( '.open' ).removeClass( 'open' ).find( 'a.dropdown-toggle' ).attr( 'data-toggle', 'dropdown' );
				$( this ).find( 'a.dropdown-toggle' ).removeAttr( 'data-toggle' );
			}
		} );

		if ( windowWidth > 1199 ) {
			$( '.navbar-nav li.dropdown a, #top-menu li.dropdown a' ).each( function() {
				$( this ).removeClass( 'dropdown-toggle' );
				$( this ).removeAttr( 'data-toggle' );
			} );
		}

		$window.resize( function() {
			if ( windowWidth > 1199 ) {
				$( '.navbar-nav li.dropdown a, #top-menu li.dropdown a' ).each( function() {
					$( this ).removeClass( 'dropdown-toggle' );
					$( this ).removeAttr( 'data-toggle' );
				} );
			} else {
				$( '.navbar-nav li.dropdown a, #top-menu li.dropdown a' ).each( function() {
					$( this ).addClass( 'dropdown-toggle' );
					$( this ).attr( 'data-toggle','dropdown' );
				} );
			}
		} );
	};

	/**
	 * Fix Bootstrap menus (dropdown - grandchild items).
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.fix_bootstrap_menus_dropdown_grandchild_items = function() {
		if ( windowWidth > 1199 ) {
			$( '.navbar-nav > .menu-item:last-child' ).each( function() {
				if ( $( this ).hasClass( 'menu-item-has-children' ) ) {
					var $firstMenuItem = $( this ),
						$dropdown      = $firstMenuItem.children( '.dropdown-menu' ),
						$dropdownItem  = $dropdown.children( '.menu-item-has-children' ),
						dropdownWidth,
						firstMenuItemRight;

					//if ( $dropdownItem.length > 0 ) {
						dropdownWidth      = $dropdown.outerWidth();
						firstMenuItemRight = ( windowWidth - ( $firstMenuItem.offset().left + $firstMenuItem.outerWidth() ) );

						if ( firstMenuItemRight < dropdownWidth ) {
							$dropdown.addClass( 'pull-right' );
							$dropdownItem.addClass( 'dropdown-menu-left' );
						}
					//}
				}
			} );
		} else {
			$( '.dropdown .dropdown > a' ).on( 'click', function( e ) {
				if ( ! $( this ).parent().hasClass( 'open' ) ) {
					$( this ).parent().addClass( 'open' );
					$( this ).next( '.dropdown-menu' ).dropdown('toggle');
					e.stopPropagation();
					e.preventDefault();
				}
			} );

			$( '.dropdown .dropdown .dropdown-menu a' ).on( 'click', function( e ) {
				document.location.href = this.href;
			} );
		}
	};

	/**
	 * Fix LazyLoad on Envira
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.fix_lazyload_envira_gallery = function() {
		if ( $( '.lazyload, .lazyloaded' ).length > 0 ) {
			if ( typeof envira_isotopes == 'object' ) {
				$window.scroll( function() {
					$( '.envira-gallery-wrap' ).each( function() {
						var id = $( this ).attr( 'id' );
						id = id.replace( 'envira-gallery-wrap-', '' );

						if ( typeof envira_isotopes[ id ] == 'object' ) {
							envira_isotopes[ id ].enviratope( 'layout' );
						}
					} );
				} );
			}
		}
	};

	/**
	 * Fixed main menu.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.set_main_menu_as_fixed = function() {
		if ( $( 'body' ).hasClass( 'top-menu-fixed' ) ) {
			$( 'header.navbar' ).scrollToFixed( {
				marginTop: function() {
					var wpadminbar = $( '#wpadminbar' );

					if ( wpadminbar.length > 0 ) {
						return wpadminbar.outerHeight();
					}

					return 0;
				},

				minWidth: 768,

				preFixed: function() {
					$( this ).addClass( 'scrolled' );
				},

				preUnfixed: function() {
					$( this ).removeClass( 'scrolled' );
				}
			} );
		}
	};

	/**
	 * Banner effect (parallax).
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.set_banner_effect_parallax = function() {
		var $banner,
			$bannerImage,
			$bannerContainer,
			bannerHeight            = 0,
			bannerContainerBaseSize = 0,

			bannerParallax = function() {
				if ( $window.scrollTop() <= windowHeight ) {
					var scrolled   = $window.scrollTop() / windowHeight * 100,
						paddingTop = ( 4 * scrolled ),
						base       = -130,
						top        = base + ( 3 * scrolled ),
						bottom     = base - ( 3 * scrolled ),
						breakpoint = bannerContainerBaseSize + paddingTop;

					$bannerImage.css( 'top', top + 'px' );
					$bannerImage.css( 'bottom', bottom + 'px' );

					if ( breakpoint < bannerHeight ) {
						$bannerContainer.css( 'padding-top', paddingTop + 'px' );
					}
				}
			};

		if ( windowWidth > 991 ) {
			$banner = $( '.page-banner:not(.gmap-banner)' );

			if ( $banner.length > 0 ) {
				$bannerImage     = $banner.children( '.page-banner-image' );
				$bannerContainer = $banner.children( '.container' );

				if ( $bannerContainer.length > 0 ) {
					bannerHeight            = $banner.height();
					bannerContainerBaseSize = $bannerContainer.height() +
												parseInt( ( $bannerContainer.css( 'margin-top' ) ).replace( 'px', '' ) ) +
												parseInt( ( $bannerContainer.css( 'margin-bottom' ) ).replace( 'px', '' ) ) +
												parseInt( ( $bannerContainer.css( 'padding-bottom' ) ).replace( 'px', '' ) );
					bannerParallax();

					$window.resize( function() {
						bannerHeight            = $banner.height();
						bannerContainerBaseSize = $bannerContainer.height() +
													parseInt( ( $bannerContainer.css( 'margin-top' ) ).replace( 'px', '' ) ) +
													parseInt( ( $bannerContainer.css( 'margin-bottom' ) ).replace( 'px', '' ) ) +
													parseInt( ( $bannerContainer.css( 'padding-bottom' ) ).replace( 'px', '' ) );
					} );

					$window.scroll( function() {
						bannerParallax();
					} );
				}
			}
		}
	};

	/**
	 * Search form effect (on mobile).
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.set_search_form_effect_mobile = function() {
		$document.on( 'click', 'header.navbar #searchform button.search-submit', function( e ) {
			if ( windowWidth < 1200 ) {
				e.preventDefault();
				var form = $( this ).closest( 'form' );

				if ( form.hasClass( 'hover' ) ) {
					form.submit();
				} else {
					form.addClass( 'hover' );
					form.find( '.search-field' ).focus();
				}
			}
		} );

		$document.on( 'blur', 'header.navbar #searchform .search-field', function( e ) {
			if ( windowWidth < 1200 ) {
				var form = $( this ).closest( 'form' );
				form.removeClass( 'hover' );
			}
		} );
	};

	/**
	 * Comments anchor effect (using location.hash)
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.set_comments_anchor_effect = function() {
		var margin;

		if ( document.location.hash == '#comments' ) {
			margin = $( 'body' ).hasClass( 'top-menu-fixed' ) ? $( 'header.navbar' ).height() : 0;
			margin += $( 'body' ).hasClass( 'admin-bar' ) ? $( '#wpadminbar' ).height() : 0;

			$( 'html, body' ).animate( {
				scrollTop: $( '.comments-link' ).offset().top - margin
			}, 500, function() {
				$( '.comments-link' ).trigger( 'click' );
			} );
		}

		if ( ( new RegExp( '#comment-', 'gi' ) ).test( document.location.hash ) ) {
			margin  = $( 'body' ).hasClass( 'top-menu-fixed' ) ? $( 'header.navbar' ).height() : 0;
			margin += $( 'body' ).hasClass( 'admin-bar' ) ? $( '#wpadminbar' ).height() : 0;

			$( 'html, body' ).animate( {
				scrollTop: $( '.comments-link' ).offset().top - margin
			}, 500, function() {
				$( '.comments-link' ).trigger( 'click' );

				$( 'html, body' ).animate( {
					scrollTop: $( document.location.hash ).offset().top - margin
				}, 500);
			} );
		}
	};

	/**
	 * On window resize.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	$window.resize( function() {

		windowHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
		windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

	} );

	/**
	 * On document ready.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	$document.ready( function() {

		lsx.fix_bootstrap_menus_touchstart();

		lsx.add_class_sidebar_to_body();
		lsx.add_class_bootstrap_to_table();

		lsx.set_main_menu_as_fixed();

	} );

	/**
	 * On window load.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	$window.load( function() {

		lsx.fix_bootstrap_menus_dropdown();
		lsx.fix_bootstrap_menus_dropdown_grandchild_items();
		lsx.fix_lazyload_envira_gallery();

		lsx.set_search_form_effect_mobile();
		lsx.set_banner_effect_parallax();
		lsx.set_comments_anchor_effect();

		/* LAST CODE TO EXECUTE */
		$( 'body.preloader-content-enable' ).addClass( 'html-loaded' );

	} );

} )( jQuery, window, document );
