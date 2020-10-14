/**
 * LSX Scripts
 *
 * @package    lsx
 * @subpackage scripts
 */

var lsx = Object.create(null);

(function($, window, document, undefined) {
	"use strict";

	var $document = $(document),
		$window = $(window),
		windowHeight =
			window.innerHeight ||
			document.documentElement.clientHeight ||
			document.body.clientHeight,
		windowWidth =
			window.innerWidth ||
			document.documentElement.clientWidth ||
			document.body.clientWidth;

	/**
	 * Adds browser class to html tag.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.add_class_browser_to_html = function() {
		if ("undefined" !== typeof platform) {
			var platform_name = "chrome";
			if (null !== platform.name) {
				platform_name = platform.name.toLowerCase();
			}

			var platform_version = "69";
			if (null !== platform.version) {
				platform_version = platform.version.toLowerCase();
			}

			$("html")
				.addClass(platform_name)
				.addClass(platform_version);
		}
	};

	/**
	 * Test if the sidebar exists (if exists, add a class to the body).
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.add_class_sidebar_to_body = function() {
		if ($("#secondary").length > 0) {
			$("body").addClass("has-sidebar");
		}
	};

	/**
	 * Add Bootstrap class to WordPress tables.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.add_class_bootstrap_to_table = function() {
		var tables = $("table#wp-calendar");

		if (tables.length > 0) {
			tables.addClass("table");
		}
	};

	/**
	 * Add a class to identify when the mobile nav is open
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */

	lsx.navbar_toggle_handler = function() {
		$(".navbar-toggle")
			.parent()
			.on("click", function() {
				var $parent = $(this);
				$parent.toggleClass("open");
				$("#masthead").toggleClass("masthead-open");
			});
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
		$(".navbar-nav .dropdown, #top-menu .dropdown").on(
			"show.bs.dropdown",
			function() {
				if (windowWidth < 1200) {
					$(this)
						.siblings(".open")
						.removeClass("open")
						.find("a.dropdown-toggle")
						.attr("data-toggle", "dropdown");
					$(this)
						.find("a.dropdown-toggle")
						.removeAttr("data-toggle");
				}
			}
		);

		if (windowWidth > 1199) {
			$(".navbar-nav li.dropdown a, #top-menu li.dropdown a").each(
				function() {
					$(this).removeClass("dropdown-toggle");
					$(this).removeAttr("data-toggle");
				}
			);
		}

		$window.resize(function() {
			if (windowWidth > 1199) {
				$(".navbar-nav li.dropdown a, #top-menu li.dropdown a").each(
					function() {
						$(this).removeClass("dropdown-toggle");
						$(this).removeAttr("data-toggle");
					}
				);
			} else {
				$(".navbar-nav li.dropdown a, #top-menu li.dropdown a").each(
					function() {
						$(this).addClass("dropdown-toggle");
						$(this).attr("data-toggle", "dropdown");
					}
				);
			}
		});
	};

	/**
	 * Remove tabs classnames of WC and adding custom lsx classnames
	 *
	 * @package	lsx
	 * @subpackage scripts
	 */

	lsx.replace_wc_classnames = function() {
		$(".wc-tabs")
			.removeClass("wc-tabs")
			.addClass("nav-tabs");
		$(".tabs")
			.removeClass("tabs")
			.addClass("nav wc-tabs");
	};

	/**
	 * Fix Bootstrap menus (dropdown inside dropdown - click).
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.fix_bootstrap_menus_dropdown_click = function() {
		if (windowWidth < 1200) {
			$(
				".navbar-nav .dropdown .dropdown > a, #top-menu .dropdown .dropdown > a"
			).on("click", function(e) {
				if (
					!$(this)
						.parent()
						.hasClass("open")
				) {
					$(this)
						.parent()
						.addClass("open");
					$(this)
						.next(".dropdown-menu")
						.dropdown("toggle");
					e.stopPropagation();
					e.preventDefault();
				}
			});

			$(
				".navbar-nav .dropdown .dropdown .dropdown-menu a, #top-menu .dropdown .dropdown > a"
			).on("click", function(e) {
				document.location.href = this.href;
			});
		}
	};

	/**
	 * Fix LazyLoad on Envira
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.fix_lazyload_envira_gallery = function() {
		if ($(".lazyload, .lazyloaded").length > 0) {
			if (typeof envira_isotopes == "object") {
				$window.scroll(function() {
					$(".envira-gallery-wrap").each(function() {
						var id = $(this).attr("id");
						id = id.replace("envira-gallery-wrap-", "");

						if (typeof envira_isotopes[id] == "object") {
							envira_isotopes[id].enviratope("layout");
						}
					});
				});
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
		var is_loaded = false;
		if (windowWidth > 1199) {
			if ($("body").hasClass("top-menu-fixed")) {
				$document.on("scroll", function(e) {
					if (false === is_loaded) {
						$(lsx_params.stickyMenuSelector).scrollToFixed({
							marginTop: function() {
								var wpadminbar = $("#wpadminbar");

								if (wpadminbar.length > 0) {
									return wpadminbar.outerHeight();
								}

								return 0;
							},

							minWidth: 768,

							preFixed: function() {
								$(this).addClass("scrolled");
							},

							preUnfixed: function() {
								$(this).removeClass("scrolled");
							}
						});
						is_loaded = true;
					}
				});
			}
		}
	};

	/**
	 * Cover template header height.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.set_cover_template_header_height = function() {
		var mastheadHeight = 0;
		if (
			$("body").hasClass("page-template-template-cover") ||
			$("body").hasClass("post-template-template-cover")
		) {
			mastheadHeight = $("#masthead").outerHeight();

			//console.log(mastheadHeight);
			$("#masthead").css("margin-bottom", -Math.abs(mastheadHeight));
		}
	};

	/**
	 * Search form effect (on mobile).
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.set_search_form_effect_mobile = function() {
		$document.on(
			"click",
			"header.navbar #searchform button.search-submit",
			function(e) {
				if (windowWidth < 1200) {
					e.preventDefault();
					var form = $(this).closest("form");

					if (form.hasClass("hover")) {
						form.submit();
					} else {
						form.addClass("hover");
						form.find(".search-field").focus();
					}
				}
			}
		);

		$document.on(
			"blur",
			"header.navbar #searchform .search-field",
			function(e) {
				if (windowWidth < 1200) {
					var form = $(this).closest("form");
					form.removeClass("hover");
				}
			}
		);
	};

	/**
	 * Search form effect (on mobile).
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.search_form_prevent_empty_submissions = function() {
		$document.on("submit", "#searchform", function(e) {
			if (
				"" ===
				$(this)
					.find('input[name="s"]')
					.val()
			) {
				e.preventDefault();
			}
		});

		$document.on(
			"blur",
			"header.navbar #searchform .search-field",
			function(e) {
				if (windowWidth < 1200) {
					var form = $(this).closest("form");
					form.removeClass("hover");
				}
			}
		);
	};

	/**
	 * Slider Lightbox.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.build_slider_lightbox = function() {
		$("body:not(.single-tour-operator) .gallery").slickLightbox({
			caption: function(element, info) {
				return $(element)
					.find("img")
					.attr("alt");
			}
		});
	};

	/**
	 * Init WooCommerce slider.
	 *
	 * @package	lsx
	 * @subpackage scripts
	 */
	lsx.init_wc_slider = function() {
		var $wcSlider = $(".lsx-woocommerce-slider");

		$wcSlider.each(function(index, el) {
			var $self = $(this),
				_slidesToShow = 4,
				_slidesToScroll = 4,
				_slidesToShow_992 = 3,
				_slidesToScroll_992 = 3,
				_slidesToShow_768 = 1,
				_slidesToScroll_768 = 1;

			if ($self.find(".lsx-woocommerce-review-slot").length > 0) {
				_slidesToShow = 2;
				_slidesToScroll = 2;
				_slidesToShow_992 = 2;
				_slidesToScroll_992 = 2;
			}

			if ($self.closest("#secondary").length > 0) {
				_slidesToShow = 1;
				_slidesToScroll = 1;
				_slidesToShow_992 = 1;
				_slidesToScroll_992 = 1;
			}

			$self.on("init", function(event, slick) {
				if (
					slick.options.arrows &&
					slick.slideCount > slick.options.slidesToShow
				) {
					$self.addClass("slick-has-arrows");
				}
			});

			$self.on("setPosition", function(event, slick) {
				if (!slick.options.arrows) {
					$self.removeClass("slick-has-arrows");
				} else if (slick.slideCount > slick.options.slidesToShow) {
					$self.addClass("slick-has-arrows");
				}
			});

			$self.slick({
				draggable: false,
				infinite: true,
				swipe: false,
				cssEase: "ease-out",
				dots: true,
				slidesToShow: _slidesToShow,
				slidesToScroll: _slidesToScroll,
				responsive: [
					{
						breakpoint: 992,
						settings: {
							slidesToShow: _slidesToShow_992,
							slidesToScroll: _slidesToScroll_992,
							draggable: true,
							arrows: false,
							swipe: true
						}
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: _slidesToShow_768,
							slidesToScroll: _slidesToScroll_768,
							draggable: true,
							arrows: false,
							swipe: true
						}
					}
				]
			});
		});

		if ($('a[href="#tab-bundled_products"]').length > 0) {
			$document.on("click", 'a[href="#tab-bundled_products"]', function(
				e
			) {
				$("#tab-bundled_products .lsx-woocommerce-slider").slick(
					"setPosition"
				);
			});
		}
	};

	/**
	 * Remove gallery IMG width and height.
	 *
	 * @package	lsx
	 * @subpackage scripts
	 */
	lsx.remove_gallery_img_width_height = function() {
		$(".gallery-size-full img").each(function() {
			var $self = $(this);

			$self.removeAttr("height");
			$self.removeAttr("width");
		});
	};

	/**
	 * Helper function to scroll to an element.
	 *
	 * @package	lsx
	 * @subpackage scripts
	 */
	lsx.do_scroll = function(_$el) {
		var _href = _$el.href.replace(/^[^#]*(#.+$)/gi, "$1"),
			_$to = $(_href),
			_top = parseInt(_$to.offset().top),
			_extra = -100;

		$("html, body").animate(
			{
				scrollTop: _top + _extra
			},
			800
		);
	};

	/**
	 * Fix WooCommerce API orders style/HTML.
	 * Fix WooCommerce checkboxes style/HTML.
	 *
	 * @package	lsx
	 * @subpackage scripts
	 */
	lsx.fix_wc_elements = function(_$el) {
		$(
			".woocommerce-MyAccount-content .api-manager-changelog, .woocommerce-MyAccount-content .api-manager-download"
		).each(function() {
			var $this = $(this);

			$this.children("br:first-child").remove();
			$this.children("hr:first-child").remove();

			$this.children("hr:last-child").remove();
			$this.children("br:last-child").remove();
		});

		$(".woocommerce-form__label-for-checkbox.checkbox").removeClass(
			"checkbox"
		);

		$(document.body).on("updated_checkout", function() {
			$(".woocommerce-form__label-for-checkbox.checkbox").removeClass(
				"checkbox"
			);
		});
	};

	/**
	 * Fix Caldera Forms modal title.
	 *
	 * @package	lsx
	 * @subpackage scripts
	 */
	lsx.fix_caldera_form_modal_title = function() {
		$("[data-remodal-id]").each(function() {
			var $form = $(this),
				$button = $('[data-remodal-target="' + $form.attr("id") + '"]'),
				title = $button.text();

			$form
				.find('[role="field"]')
				.first()
				.before("<div><h4>" + title + "</h4></div>");
		});
	};

	/**
	 * Open/close WC footer bar search.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */

	lsx.wc_footer_bar_toggle_handler = function() {
		$(".lsx-wc-footer-bar-link-toogle").on("click", function(event) {
			event.preventDefault();
			$(".lsx-wc-footer-bar-form").slideToggle();
			$(".lsx-wc-footer-bar").toggleClass("lsx-wc-footer-bar-search-on");
		});
	};

	/**
	 * Fix WC messages/notices visual.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */

	lsx.wc_fix_messages_visual = function() {
		$(
			".woocommerce-message," +
				".woocommerce-info:not(.wc_points_redeem_earn_points, .wc_points_rewards_earn_points)," +
				".woocommerce-error," +
				".woocommerce-noreviews," +
				".woocommerce_message," +
				".woocommerce_info:not(.wc_points_redeem_earn_points, .wc_points_rewards_earn_points)," +
				".woocommerce_error," +
				".woocommerce_noreviews," +
				"p.no-comments," +
				".stock," +
				".woocommerce-password-strength"
		).each(function() {
			var _$this = $(this);

			if (0 === _$this.find(".button").length) {
				return;
			}

			_$this.wrapInner(
				'<div class="lsx-woocommerce-message-text"></div>'
			);
			_$this.addClass("lsx-woocommerce-message-wrap");
			_$this.find(".button").appendTo(_$this);
		});
	};

	/**
	 * Fix WC subscrive to replies checkbox visual.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */

	lsx.wc_fix_subscribe_to_replies_checkbox = function() {
		$('input[name="subscribe_to_replies"]').removeClass("form-control");
	};

	/**
	 * Add to the WC Quick View modal the close button.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */

	lsx.wc_add_quick_view_close_button = function() {
		$("body").on("quick-view-displayed", function(event) {
			if (0 === $(".pp_content_container").children(".close").length) {
				$(".pp_content_container").prepend(
					'<button type="button" class="close">&times;</button>'
				);
			}
		});

		$document.on("click", ".pp_content_container .close", function(e) {
			$.prettyPhoto.close();
		});
	};

	/**
	 * Fix WC subscriptions empty message.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */

	lsx.wc_fix_subscriptions_empty_message = function() {
		if ("" === $(".first-payment-date").text()) {
			$(".first-payment-date").remove();
		}
	};

	/**
	 * Check if a courses thumbnail is empty on the archive page.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	lsx.sensei_courses_empty_thumbnail = function() {
		$(".course-thumbnail").each(function() {
			if (!$.trim($(this).html()).length) {
				$(this).addClass("course-thumbnail-empty");
			}
		});
	};

	lsx.sensei_course_participants_widget_more = function() {
		if ($("body").hasClass("sensei")) {
			$(".sensei-course-participant").each(function() {
				if ($(this).hasClass("show")) {
					$(this).addClass("sensei-show");
					$(this).removeClass("show");
				}
				if ($(this).hasClass("hide")) {
					$(this).addClass("sensei-hide");
					$(this).removeClass("hide");
				}
			});
			$(".sensei-view-all-participants a").on("click", function() {
				if ($(this).hasClass("clicked")) {
					$(this).removeClass("clicked");
				} else {
					$(this).addClass("clicked");
				}
				$(".sensei-course-participant.sensei-hide").each(function() {
					if ($(this).hasClass("sensei-clicked")) {
						$(this).removeClass("sensei-clicked");
					} else {
						$(this).addClass("sensei-clicked");
					}
				});
			});
		}
	};

	lsx.detect_has_link_block = function() {
		$(".has-link-color").each(function() {
			$(this)
				.find("a")
				.each(function() {
					$(this).addClass("has-link-anchor");
				});
		});
	};

	//Toggle for woocommerce block filters.
	lsx.woocommerce_filters_mobile = function() {
		if ($("body").hasClass("woocommerce-js")) {
			$(".lsx-wc-filter-toggle").on("click", function() {
				$(this).toggleClass("lsx-wc-filter-toggle-open");

				if ($(this).hasClass("lsx-wc-filter-toggle-open")) {
					$(
						'.lsx-wc-filter-block div[class^="wp-block-woocommerce-"][class$="-filter"]'
					).each(function() {
						$(this).attr("id", "lsx-wc-filter-child-open");
					});
					$(
						".lsx-wc-filter-block .wp-block-woocommerce-product-search"
					).each(function() {
						$(this).attr("id", "lsx-wc-filter-child-open");
					});
				} else {
					$(
						'.lsx-wc-filter-block div[class^="wp-block-woocommerce-"][class$="-filter"]'
					).each(function() {
						$(this).attr("id", "lsx-wc-filter-child-close");
					});
					$(
						".lsx-wc-filter-block .wp-block-woocommerce-product-search"
					).each(function() {
						$(this).attr("id", "lsx-wc-filter-child-close");
					});
				}
			});
		}
	};

	/**
	 * On window resize.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	$window.resize(function() {
		windowHeight =
			window.innerHeight ||
			document.documentElement.clientHeight ||
			document.body.clientHeight;
		windowWidth =
			window.innerWidth ||
			document.documentElement.clientWidth ||
			document.body.clientWidth;
	});

	/**
	 * On document ready.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	$document.ready(function() {
		lsx.navbar_toggle_handler();

		// lsx.fix_bootstrap_menus_touchstart();

		lsx.add_class_browser_to_html();
		lsx.add_class_sidebar_to_body();
		lsx.add_class_bootstrap_to_table();

		lsx.set_main_menu_as_fixed();

		lsx.search_form_prevent_empty_submissions();
		lsx.remove_gallery_img_width_height();
		lsx.replace_wc_classnames();
		lsx.init_wc_slider();
		lsx.fix_wc_elements();
		lsx.fix_caldera_form_modal_title();
		lsx.wc_footer_bar_toggle_handler();
		lsx.wc_fix_messages_visual();
		lsx.wc_fix_subscribe_to_replies_checkbox();
		lsx.wc_add_quick_view_close_button();
		lsx.wc_fix_subscriptions_empty_message();
		lsx.sensei_courses_empty_thumbnail();
		lsx.sensei_course_participants_widget_more();
		lsx.woocommerce_filters_mobile();
		lsx.detect_has_link_block();
	});

	/**
	 * On window load.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	$window.load(function() {
		lsx.fix_bootstrap_menus_dropdown();
		lsx.fix_bootstrap_menus_dropdown_click();
		lsx.fix_lazyload_envira_gallery();
		lsx.set_search_form_effect_mobile();
		lsx.build_slider_lightbox();

		lsx.set_cover_template_header_height();

		/* LAST CODE TO EXECUTE */
		$("body.preloader-content-enable").addClass("html-loaded");
	});
})(jQuery, window, document);
