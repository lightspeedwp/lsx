var filter_item_width;
jQuery(document).ready(function($) {
	
	$('table#wp-calendar').addClass('table');

	$('.dropdown-menu').on('touchstart.dropdown.data-api', function(e){
	    e.stopPropagation();
	});

	$(window).scroll(function(){
	    if($(window).scrollTop() > 250) {
	        $('header.banner').addClass('scrolled');
	    } else {
	        $('header.banner').removeClass('scrolled');
	    }
	});


	$(document).resize(function () {
	    var screen = $(window);    
	    if (screen.width < 992) {
	        $("nav ul li").removeClass('dropdown');
	        $("nav ul li").removeClass('open');
	    }
	});

	// Sticky Info Box widget
	if ($('body').hasClass('logged-in')) {
		var spacing = 125;
	} else {
		var spacing = 93;
	}
	
	if($(".info-box-sticky").length){
		$(".info-box-sticky").sticky({ 
			topSpacing: spacing,
			bottomSpacing: 590,
			getWidthFrom: '#secondary',
	    	responsiveWidth: true
		});
	}

	// Sticky Book Now widget
	if($(".sticky-book").length){
		$(".sticky-book").sticky({ 
			topSpacing: 127,
			bottomSpacing: 1300
		});
	}

    $(window).load(function() {
    	
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
		    $('.page-banner').css('top', (scrolled) + 'px');
		}
		function parallax(){
		    var scrolled = $(window).scrollTop();
		    $('.page-banner').css('top', (scrolled * 0.1) + 'px');
		}

		$(window).scroll(function(e){
		    parallax();
		});
		
		lsxRemasonry();
    	// The sprter for the portfolio.
    	var has_filter = $('#filterNav');
    	if('undefined' != has_filter){
			$('#main').imagesLoaded( function(){
				lsxRemasonry();
				lsxMasonrySorter();
				jQuery('#main').css('opacity', '1' ); 
		    });			
			
    	}			
		
		//Page Banner		
		lsxResizeBanner(width);	
		lsxResizeSingleThumbnail(width);
		
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
			
			lsxResizeBanner(width);	
			lsxResizeSingleThumbnail(width);
			lsxRemasonry();
		});	
		
		$( document.body ).on( 'post-load', function () {
			lsxResizeBanner(width);	
			lsxResizeSingleThumbnail(width);			
		});
	});
});

///////////////////////////////
//Apply the correct banner size
///////////////////////////////

function lsxResizeBanner(width) {
	
	var banner_attribute_name = 'data-desktop';
	if(width <= 768){
		banner_attribute_name = 'data-tablet';
	}
	if(width <= 400){
		banner_attribute_name = 'data-mobile';
	}			
	if(undefined != jQuery('.page-banner') && jQuery('.page-banner').attr('data-desktop') !== undefined){		
		var image_url = 'url('+jQuery('.page-banner').attr(banner_attribute_name)+')';
		jQuery('.page-banner').css('background-image',image_url);	
	}	

}

///////////////////////////////
//Apply the correct single thumbnail size
///////////////////////////////

function lsxResizeSingleThumbnail(width) {
	var attribute_name = 'data-desktop';
	//1200, 992, 768
	if (width >= 992) {
		attribute_name = 'data-desktop';
	} else {
		if (width < 992 && width >= 768) {
			attribute_name = 'data-tablet';
		} else {
			attribute_name = 'data-mobile';
		}
	}

	jQuery('img.lsx-responsive').each( function(){
		if(jQuery(this).attr('data-desktop') !== undefined){
			jQuery(this).attr('src',jQuery(this).attr(attribute_name));
		}
	});	
}

///////////////////////////////
//Sorter Function
///////////////////////////////

function lsxMasonrySorter() {
	
	jQuery('#filterNav a').click(function(){
		var selector = jQuery(this).attr('data-filter');
		selector = selector.replace('.','');
		
		jQuery('.filter-items-container .filter-item').each(function(){
			
			if(jQuery(this).hasClass(selector) || '*' == selector){
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

///////////////////////////////
//realod the masonry layout
///////////////////////////////

function lsxRemasonry() {
	if( jQuery(".filter-items-container .filter-item").length ){
				
		var columns = jQuery('.filter-items-container .filter-item').attr('data-column');
		var window_width = jQuery(window).width();
		if(window_width > 768) {
			if(1 == columns){
				filter_item_width = 750;
			}else {
				filter_item_width = filter_item_width/columns;
			}			
			jQuery('.filter-items-container .filter-item').each(function(){
				jQuery(this).removeClass('column-1 column-2 column-3 column-4 column-5 column-6');
				jQuery(this).addClass('column-'+columns);
			});			
		}
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
	
		jQuery('.filter-items-container').imagesLoaded( function() {
			
			jQuery('.filter-items-container').masonry({
				resizable: true,
				columnWidth: filter_item_width,
				itemSelector: '.filter-item'
			});		
		});	
	}	
}

function lsxDisableMobileBanners(width){
    if (width < 768) {
        $(".home .soliloquy-slider").remove();
        $(".home .home-bg-image").remove();
        $(".page-banner").remove();
    }	
}