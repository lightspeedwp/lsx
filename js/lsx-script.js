var filter_item_width;
jQuery(document).ready(function($) {
	if ( $("header.banner").hasClass("navbar-static-top") ) {
		$("body").addClass("top-menu-fixed");
	}
	
	if($('li.menu-item-language-current.dropdown').length){
		$('li.menu-item-language-current.dropdown').find('a:first').append('<span class="caret"></span>');
	}

	$('.wp-pagenavi').wrap('<div class="wp-pagenavi-wrapper"></div>');
	$('<div class="lsx-breaker"></div>').prependTo( ".wp-pagenavi-wrapper" );

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
	var window_width = $(window).width();
	if(window_width <= 768 && window_width > 400){
		filter_item_width = jQuery('.filter-items-container').width()/2;
		
		jQuery('.filter-items-container .filter-item').each(function(){
			jQuery(this).removeClass('column-1 column-2 column-3 column-4 column-5 column-6');
			jQuery(this).addClass('column-2');
		});
	}
	if(window_width <= 400){
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

	$(window).scroll(function(){
	    if ( $(window).scrollTop() > 250 && $(window).width() > 768 ) {
	        $('#top-menu.top-menu-fixed').slideUp();
	        $('header.banner.navbar-static-top').addClass('scrolled');
	    } else {
	        $('#top-menu.top-menu-fixed').slideDown();
	        $('header.banner.navbar-static-top').removeClass('scrolled');
	    }
	});
	
	$(window).resize(function () {
		$(window).scroll(function(){
		    if ( $(window).scrollTop() > 250 && $(window).width() > 768 ) {
		        $('#top-menu.top-menu-fixed').slideUp();
		        $('header.banner.navbar-static-top').addClass('scrolled');
		    } else {
		        $('#top-menu.top-menu-fixed').slideDown();
		        $('header.banner.navbar-static-top').removeClass('scrolled');
		    }
		});

		var neg_margin = $('.portfolio-title').height();
		if (neg_margin > 40) {
			$('.portfolio-title').css('margin-top', -neg_margin);
		} else {
			$('.portfolio-title').css('margin-top', -neg_margin/2);
		}
	});

	// Disabling homepage slider, background image area on mobile
	$(window).resize(function () {
		var screen = $(window);
	    if (screen.width() < 768) {
	        $(".home .soliloquy-slider").hide();
	        $(".home-bg-image").hide();
	        $(".home-bg-image-footer").hide();
	    } else {
	    	$(".home .soliloquy-slider").show();
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
	
		

    $(window).load(function() {
		
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
		
		var width = $(window).width();
		

		//Dropdown Toggle
		if(1186 < width){
			$('.navbar-nav li.dropdown a').each(function(){
				$(this).removeClass('dropdown-toggle');
				$(this).removeAttr('data-toggle');
			});
		}

		// Parallax Effect on Banners
		function parallax(){
		    var scrolled = $(window).scrollTop();
		    $('.page-banner').css('top', (scrolled * 0.1) + 'px');
		}

		if ( $("header.banner").hasClass("navbar-static-top") ) {

		  	$(window).scroll(function(){
			    parallax();
			});
		}
		
		//Page Banner		
		
		//Does everything it did on top
		$(window).resize(function() {
			width = $(window).width();
			
			if (1186 < width){
				$('.navbar-nav li.dropdown a').each(function(){
					$(this).removeClass('dropdown-toggle');
					$(this).removeAttr('data-toggle');
				});
			}else{
				$('.navbar-nav li.dropdown a').each(function(){
					$(this).addClass('dropdown-toggle');
					$(this).attr('data-toggle','dropdown');
				});				
			}
		});	

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