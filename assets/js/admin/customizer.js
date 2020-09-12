/**
 * Theme Customizer enhancements for a better user experience.
 * This is the JS that runs on the site in the preview window.
 */
(function($) {
	// Update the headers layout.css
	wp.customize("lsx_header_layout", function(setting) {
		setting.bind(function(value) {
			console.log(value);
			$("body").removeClass("header-central");
			$("body").removeClass("header-expanded");
			$("body").removeClass("header-inline");
			$("body").addClass("header-" + value);
		});
	});

	// Update the headers layout.css
	wp.customize("lsx_header_mobile_layout", function(setting) {
		setting.bind(function(value) {
			$("body").removeClass("mobile-header-navigation-bar");
			$("body").removeClass("mobile-header-hamburger");
			$("body").addClass("mobile-header-" + value);
		});
	});

	// Update the fixed header in real time...
	wp.customize("lsx_header_fixed", function(setting) {
		setting.bind(function(value) {
			if (true == value) {
				$("body").addClass("top-menu-fixed");
				lsx.set_main_menu_as_fixed();
			} else {
				$("body").removeClass("top-menu-fixed");
				$("body header.navbar").trigger("detach.ScrollToFixed");
			}
		});
	});
})(jQuery);
