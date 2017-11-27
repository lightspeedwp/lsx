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
	 * Adds browser class to html tag.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.add_class_browser_to_html = function() {
		if ( 'undefined' !== typeof platform ) {
			var platform_name = platform.name.toLowerCase(),
				platform_version = platform.version.toLowerCase().replace(/\..*$/g, '');

			$( 'html' ).addClass( platform_name ).addClass( platform_version );
		}
	};

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
	 * Add a class to identify when the mobile nav is open
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */

	lsx.navbar_toggle_handler = function() {
		$( '.navbar-toggle' ).parent().on( 'click', function() {
			var $parent = $( this );
			$parent.toggleClass( 'open' );
		} );
	};

	/**
	 * Fix Bootstrap menus (touchstart).
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	// lsx.fix_bootstrap_menus_touchstart = function() {
	// 	$( '.dropdown-menu' ).on( 'touchstart.dropdown.data-api', function( e ) {
	// 		e.stopPropagation();
	// 	} );
	// };

	/**
	 * Fix Bootstrap menus (dropdown).
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.fix_bootstrap_menus_dropdown = function() {
		$( '.navbar-nav .dropdown, #top-menu .dropdown' ).on( 'show.bs.dropdown', function() {
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
					$( this ).attr( 'data-toggle', 'dropdown' );
				} );
			}
		} );
	};

	/**
	 * Fix Bootstrap menus (dropdown inside dropdown - click).
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.fix_bootstrap_menus_dropdown_click = function() {
		if ( windowWidth < 1200 ) {
			$( '.navbar-nav .dropdown .dropdown > a, #top-menu .dropdown .dropdown > a' ).on( 'click', function( e ) {
				if ( ! $( this ).parent().hasClass( 'open' ) ) {
					$( this ).parent().addClass( 'open' );
					$( this ).next( '.dropdown-menu' ).dropdown( 'toggle' );
					e.stopPropagation();
					e.preventDefault();
				}
			} );

			$( '.navbar-nav .dropdown .dropdown .dropdown-menu a, #top-menu .dropdown .dropdown > a' ).on( 'click', function( e ) {
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
		if ( windowWidth > 1199 ) {
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
			bannerEndPosition,
			base = -40,

			bannerParallax = function() {
				if ( $window.scrollTop() <= bannerEndPosition ) {
					var scrolled  = $window.scrollTop() / bannerEndPosition * 100,
						top       = base + scrolled,
						bottom    = base - scrolled;

					$bannerImage.css( {
						'top': top + 'px',
						'bottom': bottom + 'px'
					} );
				}
			};

		if ( windowWidth > 1199 ) {
			$banner = $( '.page-banner:not(.gmap-banner)' );

			if ( $banner.length > 0 ) {
				bannerEndPosition = $banner.height() + $banner.offset().top;
				$bannerImage = $banner.children( '.page-banner-image' );

				if ( $bannerImage.length > 0 ) {
					bannerParallax();

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
	 * Search form effect (on mobile).
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.search_form_prevent_empty_submissions = function() {
		$document.on( 'submit', '#searchform', function( e ) {
			if ( '' === $( this ).find('input[name="s"]').val() ) {
				e.preventDefault();
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
	 * Slider Lightbox.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.build_slider_lightbox = function() {
		$( 'body:not(.single-tour-operator) .gallery' ).slickLightbox( {
			caption: function( element, info ) {
				return $( element ).find( 'img' ).attr( 'alt' );
			}
		} );
	};

	/**
	 * Init WooCommerce slider.
	 *
	 * @package	lsx
	 * @subpackage scripts
	 */
	lsx.init_wc_slider = function() {
		var $wcSlider = $( '.lsx-woocommerce-slider' );

		$wcSlider.each( function( index, el ) {
			var $self = $( this ),
				_slidesToShow = 4,
				_slidesToScroll = 4,
				_slidesToShow_992 = 3,
				_slidesToScroll_992 = 3,
				_slidesToShow_768 = 1,
				_slidesToScroll_768 = 1;

			if ( $self.find( '.lsx-woocommerce-review-slot' ).length > 0 ) {
				_slidesToShow = 2;
				_slidesToScroll = 2;
				_slidesToShow_992 = 2;
				_slidesToScroll_992 = 2;
			}

			if ( $self.closest( '#secondary' ).length > 0 ) {
				_slidesToShow = 1;
				_slidesToScroll = 1;
				_slidesToShow_992 = 1;
				_slidesToScroll_992 = 1;
			}

			$self.on( 'init', function( event, slick ) {
				if ( slick.options.arrows && slick.slideCount > slick.options.slidesToShow ) {
					$self.addClass( 'slick-has-arrows' );
				}
			} );

			$self.on( 'setPosition', function( event, slick ) {
				if ( ! slick.options.arrows ) {
					$self.removeClass('slick-has-arrows');
				} else if ( slick.slideCount > slick.options.slidesToShow ) {
					$self.addClass('slick-has-arrows');
				}
			} );

			$self.slick( {
				draggable: false,
				infinite: true,
				swipe: false,
				cssEase: 'ease-out',
				dots: true,
				slidesToShow: _slidesToShow,
				slidesToScroll: _slidesToScroll,
				responsive: [{
					breakpoint: 992,
					settings: {
						slidesToShow: _slidesToShow_992,
						slidesToScroll: _slidesToScroll_992,
						draggable: true,
						arrows: false,
						swipe: true
					}
				}, {
					breakpoint: 768,
					settings: {
						slidesToShow: _slidesToShow_768,
						slidesToScroll: _slidesToScroll_768,
						draggable: true,
						arrows: false,
						swipe: true
					}
				}]
			} );
		} );

		if ( $( 'a[href="#tab-bundled_products"]' ).length > 0 ) {
			$document.on( 'click', 'a[href="#tab-bundled_products"]', function( e ) {
				$( '#tab-bundled_products .lsx-woocommerce-slider' ).slick( 'setPosition' );
			});
		}
	}

	/**
	 * Remove gallery IMG width and height.
	 *
	 * @package	lsx
	 * @subpackage scripts
	 */
	lsx.remove_gallery_img_width_height = function() {
		$( '.gallery-size-full img' ).each( function() {
			var $self = $( this );

			$self.removeAttr( 'height' );
			$self.removeAttr( 'width' );
		} );
	};

	/**
	 * Helper function to scroll to an element.
	 *
	 * @package	lsx
	 * @subpackage scripts
	 */
	lsx.do_scroll = function( _$el ) {
		var _href = ( _$el.href ).replace( /^[^#]*(#.+$)/gi, '$1' ),
			_$to = $( _href ),
			_top = parseInt( _$to.offset().top ),
			_extra = -100;

		$( 'html, body' ).animate( {
			scrollTop: ( _top+_extra )
		}, 800);
	};

	/**
	 * Fix WooCommerce API orders style/HTML.
	 * Fix WooCommerce checkboxes style/HTML.
	 *
	 * @package	lsx
	 * @subpackage scripts
	 */
	lsx.fix_wc_elements = function( _$el ) {
		$( '.woocommerce-MyAccount-content .api-manager-changelog, .woocommerce-MyAccount-content .api-manager-download' ).each( function() {
			var $this = $( this );

			$this.children( 'br:first-child' ).remove();
			$this.children( 'hr:first-child' ).remove();

			$this.children( 'hr:last-child' ).remove();
			$this.children( 'br:last-child' ).remove();
		} );

		$( '.woocommerce-form__label-for-checkbox.checkbox' ).removeClass( 'checkbox' );

		$( document.body ).on( 'updated_checkout', function() {
			$( '.woocommerce-form__label-for-checkbox.checkbox' ).removeClass( 'checkbox' );
		} );
	};

	/**
	 * Fix Caldera Forms modal title.
	 *
	 * @package	lsx
	 * @subpackage scripts
	 */
	lsx.fix_caldera_form_modal_title = function() {
		$( '[data-remodal-id]' ).each( function() {
			var $form = $( this ),
				$button = $( '[data-remodal-target="' + $form.attr( 'id' ) + '"]' ),
				title = $button.text();

			$form.find( '[role="field"]' ).first().before( '<div><h4>' + title + '</h4></div>' );
		} );
	};

	/**
	 * Open/close WC footer bar search.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */

	lsx.wc_footer_bar_toggle_handler = function() {
		$( '.lsx-wc-footer-bar-link-toogle' ).on( 'click', function( event ) {
			event.preventDefault();
			$( '.lsx-wc-footer-bar-form' ).slideToggle();
			$( '.lsx-wc-footer-bar' ).toggleClass( 'lsx-wc-footer-bar-search-on' );
		} );
	};

	/**
	 * Fix WC messages/notices visual.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */

	lsx.wc_fix_messages_visual = function() {
		$(
			'.woocommerce-message,' +
			'.woocommerce-info,' +
			'.woocommerce-error,' +
			'.woocommerce-noreviews,' +
			'.woocommerce_message,' +
			'.woocommerce_info,' +
			'.woocommerce_error,' +
			'.woocommerce_noreviews,' +
			'p.no-comments,' +
			'.stock,' +
			'.woocommerce-password-strength' ).each( function() {
				var _$this = $( this );

				if ( 0 === _$this.find( '.button' ).length ) {
					return;
				}

				_$this.wrapInner( '<div class="lsx-woocommerce-message-text"></div>' );
				_$this.addClass( 'lsx-woocommerce-message-wrap' );
				_$this.find( '.button' ).appendTo( _$this );
			}
		);
	};

	/**
	 * Fix WC subscrive to replies checkbox visual.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */

	lsx.wc_fix_subscribe_to_replies_checkbox = function() {
		$( 'input[name="subscribe_to_replies"]' ).removeClass( 'form-control' );
	};

	/**
	 * Add to the WC Quick View modal the close button.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */

	lsx.wc_add_quick_view_close_button = function() {
		$( 'body' ).on( 'quick-view-displayed', function( event ) {
			if ( 0 === $( '.pp_content_container' ).children( '.close' ).length ) {
				$( '.pp_content_container' ).prepend( '<button type="button" class="close">&times;</button>' );
			}
		} );

		$document.on( 'click', '.pp_content_container .close', function( e ) {
			$.prettyPhoto.close();
		} );
	};

	/**
	 * Fix WC subscriptions empty message.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */

	lsx.wc_fix_subscriptions_empty_message = function() {
		if ( '' === $( '.first-payment-date' ).text() ) {
			$( '.first-payment-date' ).remove();
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

		lsx.navbar_toggle_handler();

		// lsx.fix_bootstrap_menus_touchstart();

		lsx.add_class_browser_to_html();
		lsx.add_class_sidebar_to_body();
		lsx.add_class_bootstrap_to_table();

		lsx.set_main_menu_as_fixed();

		lsx.search_form_prevent_empty_submissions();
		lsx.remove_gallery_img_width_height();

		lsx.init_wc_slider();
		lsx.fix_wc_elements();
		lsx.fix_caldera_form_modal_title();
		lsx.wc_footer_bar_toggle_handler();
		lsx.wc_fix_messages_visual();
		lsx.wc_fix_subscribe_to_replies_checkbox();
		lsx.wc_add_quick_view_close_button();
		lsx.wc_fix_subscriptions_empty_message();

	} );

	/**
	 * On window load.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	$window.load( function() {

		lsx.fix_bootstrap_menus_dropdown();
		lsx.fix_bootstrap_menus_dropdown_click();
		lsx.fix_lazyload_envira_gallery();

		lsx.set_search_form_effect_mobile();

		lsx.build_slider_lightbox();

		lsx.set_banner_effect_parallax();

		/* LAST CODE TO EXECUTE */
		$( 'body.preloader-content-enable' ).addClass( 'html-loaded' );

	} );

} )( jQuery, window, document );
