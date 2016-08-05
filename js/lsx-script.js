var filter_item_width;

jQuery(document).ready(function($) {
	var $window = $(window),
		windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth,
		windowHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;

	$window.resize(function() {
		windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth,
		windowHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
	});

	if ( $("header.banner").hasClass("navbar-static-top") ) {
		$("body").addClass("top-menu-fixed");
	}
	
	if($('li.menu-item-language-current.dropdown').length){
		$('li.menu-item-language-current.dropdown').find('a:first').append('<span class="caret"></span>');
	}

	if ($('.wp-pagenavi').children().length == 0) {
		$('.wp-pagenavi').remove();
	} else {
		$('.wp-pagenavi').wrap('<div class="wp-pagenavi-wrapper"></div>');
		$('<div class="lsx-breaker"></div>').prependTo( ".wp-pagenavi-wrapper" );
	}

	var sidebarExists = document.getElementById("secondary");
	if (sidebarExists) {
		$('body').addClass('has-sidebar');
	}

	if ( $('header.banner .container form').hasClass('search-form') ) {
		$('body').addClass('has-header-search');
	}

	var neg_margin = $('.portfolio-title').height();
	if (neg_margin > 40) {
		$('.portfolio-title').css('margin-top', -neg_margin);
	} else {
		$('.portfolio-title').css('margin-top', -neg_margin/2);
	}

	$('header.banner .search-toggle').remove();

	filter_item_width = jQuery('.filter-items-container').width();
	if(jQuery('.filter-items-container .filter-item').hasClass('column-1')){
		filter_item_width = 750;
	}else if(jQuery('.filter-items-container .filter-item').hasClass('column-2')){
		filter_item_width = filter_item_width/2;
	}else if(jQuery('.filter-items-container .filter-item').hasClass('column-3')){
		filter_item_width = filter_item_width/3;
	}else if(jQuery('.filter-items-container .filter-item').hasClass('column-4')){
		filter_item_width = filter_item_width/4;
	}else if(jQuery('.filter-items-container .filter-item').hasClass('column-5')){
		filter_item_width = filter_item_width/5;
	}else if(jQuery('.filter-items-container .filter-item').hasClass('column-6')){
		filter_item_width = filter_item_width/6;
	}
	
	if(windowWidth <= 768 && windowWidth > 400){
		filter_item_width = jQuery('.filter-items-container').width()/2;
		
		jQuery('.filter-items-container .filter-item').each(function(){
			jQuery(this).removeClass('column-1 column-2 column-3 column-4 column-5 column-6');
			jQuery(this).addClass('column-2');
		});
	}

	if(windowWidth <= 400){
		filter_item_width = jQuery('.filter-items-container').width();
		jQuery('.filter-items-container .filter-item').each(function(){
			jQuery(this).removeClass('column-1 column-2 column-3 column-4 column-5 column-6');
			jQuery(this).addClass('column-1');
		});
	}	
	
	$('table#wp-calendar').addClass('table');

	$('.dropdown-menu').on('touchstart.dropdown.data-api', function(e){
	    e.stopPropagation();
	});

	$window.scroll(function(){
	    if ( $window.scrollTop() > 250 && windowWidth > 768 ) {
	        $('#top-menu.top-menu-fixed').slideUp();
	        $('header.banner.navbar-static-top').addClass('scrolled');
	    } else {
	        $('#top-menu.top-menu-fixed').slideDown();
	        $('header.banner.navbar-static-top').removeClass('scrolled');
	    }
	});
	
	$window.resize(function () {
		if ( $window.scrollTop() > 250 && windowWidth > 768 ) {
	        $('#top-menu.top-menu-fixed').slideUp();
	        $('header.banner.navbar-static-top').addClass('scrolled');
	    } else {
	        $('#top-menu.top-menu-fixed').slideDown();
	        $('header.banner.navbar-static-top').removeClass('scrolled');
	    }

		var neg_margin = $('.portfolio-title').height();
		if (neg_margin > 40) {
			$('.portfolio-title').css('margin-top', -neg_margin);
		} else {
			$('.portfolio-title').css('margin-top', -neg_margin/2);
		}
	});

	// Disabling homepage slider, background image area on mobile
	$window.resize(function () {
	    if (windowWidth < 768) {
	        $(".home-bg-image").hide();
	        $(".home-bg-image-footer").hide();
	    } else {
	    	$(".home-bg-image-footer").show();
	        $(".home-bg-image").show();
	    }
	});

	// Sticky Info Box widget
	var spacing = 0;
	if ($('body').hasClass('logged-in')) {
		spacing = 125;
	} else {
		spacing = 93;
	}

	$(".info-box-sticky").sticky({ 
		topSpacing: spacing,
		bottomSpacing: 670,
		getWidthFrom: '#secondary',
		responsiveWidth: true,
		responsiveBreakpoint: 992
	});

	// Sticky Book Now widget
	$(".sticky-book").sticky({ 
		topSpacing: spacing,
		bottomSpacing: 520,
		getWidthFrom: '#secondary',
		responsiveWidth: true,
		responsiveBreakpoint: 992
	});

	// Sticky Enquire Now widget
	$(".sticky-enquire").sticky({ 
		topSpacing: spacing,
		bottomSpacing: 2000,
		getWidthFrom: '#secondary',
		responsiveWidth: true,
		responsiveBreakpoint: 992
	});

    $window.load(function() {
		// The sorter for the portfolio.
    	var has_filter = $('#filterNav');
    	if('undefined' !== has_filter){
			$('#main').imagesLoaded( function(){
				lsxProjectThumbInit();
				lsxProjectFilterInit();
	
				jQuery('#main').css('opacity', '1' );
		    });			
    	}
    	
    	//Portfolio Hover Class
		if(lsx_params.is_portfolio){
			$('.portfolio-content-wrapper').hover(function() {
		        $(this).addClass('active');
		    }, function() {
		        $(this).removeClass('active');
		    });
		}
    	
		$('.masonry > article').hover(function() {
	        $(this).addClass('active');
	    }, function() {
	        $(this).removeClass('active');
	    });

		// Bootstrat Menu

		if (1199 < windowWidth) {
			$('.navbar-nav li.dropdown a').each(function() {
				$(this).removeClass('dropdown-toggle');
				$(this).removeAttr('data-toggle');
			});
		}
		
		$('.dropdown').on('show.bs.dropdown', function() {
			if (1200 > windowWidth) {
				$(this).siblings('.open').removeClass('open').find('a.dropdown-toggle').attr('data-toggle', 'dropdown');
				$(this).find('a.dropdown-toggle').removeAttr('data-toggle');
			}
		});

		$window.resize(function() {
			if (1199 < windowWidth) {
				$('.navbar-nav li.dropdown a').each(function() {
					$(this).removeClass('dropdown-toggle');
					$(this).removeAttr('data-toggle');
				});
			} else {
				$('.navbar-nav li.dropdown a').each(function() {
					$(this).addClass('dropdown-toggle');
					$(this).attr('data-toggle','dropdown');
				});				
			}
		});

		// Grandchild Menu

		var fixDropdownPosition = function() {
			$('.navbar-nav .menu-item:last-child').each(function() {
				if ($(this).hasClass('menu-item-has-children')) {
					var $firstMenuItem = $(this),
						$dropdown = $firstMenuItem.children('.dropdown-menu'),
						$dropdownItem = $dropdown.children('.menu-item-has-children'),
						dropdownWidth,
						firstMenuItemRight;

					if ($dropdownItem.length > 0) {
						dropdownWidth = $dropdown.outerWidth(),
						firstMenuItemRight = (windowWidth - ($firstMenuItem.offset().left + $firstMenuItem.outerWidth()));

						if (firstMenuItemRight < dropdownWidth) {
							$dropdown.addClass('pull-right');
							$dropdownItem.addClass('dropdown-menu-left');
						}
					}
				}
			});
		};

		if (1199 < windowWidth) {
			fixDropdownPosition();
		} else {
			$('.dropdown .dropdown > a').on("click", function(e) {
				if (!$(this).hasClass('open')) {
					$(this).addClass('open');
					$(this).next('.dropdown-menu').toggle();
					e.stopPropagation();
					e.preventDefault();
				}
			});
		}

		// Parallax Effect on Banners

		var $banner,
			$bannerImage,
			$bannerContainer,
			bannerHeight,
			bannerContainerBaseSize,
			bannerParallax = function() {
				if ($window.scrollTop() <= windowHeight) {
					var scrolled = $window.scrollTop() / windowHeight * 100,
						paddingTop = (4 * scrolled),
						base = -130,
						top = base + (3 * scrolled),
						bottom = base - (3 * scrolled),
						breakpoint = bannerContainerBaseSize + paddingTop;

					$bannerImage.css('top', top + 'px');
					$bannerImage.css('bottom', bottom + 'px');

					if (breakpoint < bannerHeight) {
						$bannerContainer.css('padding-top', paddingTop + 'px');
					}
				}
			}

		if (991 < windowWidth) {
			$banner = $('.page-banner:not(.gmap-banner)');

			if ($banner.length > 0) {
				$bannerImage = $banner.children('.page-banner-image');
				$bannerContainer = $banner.children('.container');
				bannerHeight = $banner.height();
				bannerContainerBaseSize = $bannerContainer.height() + 
											parseInt(($bannerContainer.css('margin-top')).replace('px', '')) + 
											parseInt(($bannerContainer.css('margin-bottom')).replace('px', '')) + 
											parseInt(($bannerContainer.css('padding-bottom')).replace('px', ''));
				bannerParallax();

				$window.resize(function() {
					bannerHeight = $banner.height();
					bannerContainerBaseSize = $bannerContainer.height() + 
												parseInt(($bannerContainer.css('margin-top')).replace('px', '')) + 
												parseInt(($bannerContainer.css('margin-bottom')).replace('px', '')) + 
												parseInt(($bannerContainer.css('padding-bottom')).replace('px', ''));
				});

				$window.scroll(function(){
					bannerParallax();
				});
			}
		}

		// Comments anchor

		if (document.location.hash == '#comments') {
			var margin = jQuery('body').hasClass('top-menu-fixed') ? jQuery('header.banner').height() : 0;
			margin += jQuery('body').hasClass('admin-bar') ? jQuery('#wpadminbar').height() : 0;

			jQuery('html, body').animate({
				scrollTop: jQuery('.comments-link').offset().top - margin
			}, 500, function() {
				jQuery('.comments-link').trigger('click');
			});
		}

		if ((new RegExp("#comment-", "gi")).test(document.location.hash)) {
			var margin = jQuery('body').hasClass('top-menu-fixed') ? jQuery('header.banner').height() : 0;
			margin += jQuery('body').hasClass('admin-bar') ? jQuery('#wpadminbar').height() : 0;

			jQuery('html, body').animate({
				scrollTop: jQuery('.comments-link').offset().top - margin
			}, 500, function() {
				jQuery('.comments-link').trigger('click');

				jQuery('html, body').animate({
					scrollTop: jQuery(document.location.hash).offset().top - margin
				}, 500);
			});
		}

		// Sensei breadcrumb
		if ($('body').hasClass('sensei')) {
			if ($('header.archive-header').length > 0) {
				$('.woocommerce-breadcrumb').insertAfter('.archive-header');

				if ($('.woocommerce-breadcrumb').length > 1) {
					$('.woocommerce-breadcrumb').slice(1).remove();
				}
			}
		}

		//Lazy Load //Envira Gallery FIX
		if (jQuery('.lazyload, .lazyloaded').length > 0) {
			if (typeof envira_isotopes == 'object') {
				jQuery('.envira-gallery-wrap').each(function() {
					var id = jQuery(this).attr('id');
					id = id.replace('envira-gallery-wrap-', '');

					if (typeof envira_isotopes[id] == 'object') {
						envira_isotopes[id].enviratope('layout');
					}
				});
			}
		}

		//Final load - LAST CODE TO EXECUTE
		$('body').addClass('html-loaded');
	});
});


///////////////////////////////
//Project thumbs
///////////////////////////////

function lsxProjectThumbInit() {
	
	if( jQuery(".filter-items-container .filter-item").length ){
		jQuery('.filter-items-container').imagesLoaded( function() {
			
			jQuery('.filter-items-container').masonry({
				resizable: true,
				columnWidth: filter_item_width,
				itemSelector: '.filter-item'
			});		
		});	
	}
}


///////////////////////////////
//Project Filtering
///////////////////////////////

function lsxProjectFilterInit() {
	
	jQuery('#filterNav a').click(function(){
		var selector = jQuery(this).attr('data-filter');
		selector = selector.replace('.','');
		
		jQuery('.filter-items-container .filter-item').each(function(){
			
			if(jQuery(this).hasClass(selector) || '*' === selector){
				jQuery(this).show();
			}else{
				jQuery(this).hide();
			}
			
		});
		
		jQuery('.filter-items-container').masonry({
			resizable: true,
			columnWidth: filter_item_width,
			itemSelector: '.filter-item'
				
		});
		
		jQuery(window).trigger('resize');

		if ( !jQuery(this).hasClass('selected') ) {
			jQuery(this).parents('#filterNav').find('.selected').removeClass('selected');
			jQuery(this).addClass('selected');
		}

		return false;
	});	
}