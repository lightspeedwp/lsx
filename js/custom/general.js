var filter_item_width;
jQuery(document).ready(function($) {

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
	    if($(window).scrollTop() > 250) {
	        $('header.banner').addClass('scrolled');
	    } else {
	        $('header.banner').removeClass('scrolled');
	    }
	});

	$('img:not([alt])').each(function(){
	    var $img = $(this);
	    var filename = $img.attr('src')
	    $img.attr('alt', filename.substring(0, filename.lastIndexOf('.')));
	});

	// Disabling homepage slider, background image area and page banners on mobile
	$(window).resize(function () {
		var screen = $(window)
	    if (screen.width() < 768) {
	        $(".home .soliloquy-slider").hide();
	        $(".home-bg-image").hide();
	        $(".home-bg-image-footer").hide();
	        $(".page-banner").hide();
	    } else {
	    	$(".home .soliloquy-slider").show();
	    	$(".home-bg-image-footer").show();
	        $(".home-bg-image").show();
	        $(".page-banner").show();
	    }
	});

    $(window).resize(function () {
	    if ( $('.navbar-header').width() + $('.primary-navbar').width() > $('header.banner .container').width() && $(window).width() > 1200 )  {
			$('body').addClass('header-expanded');
		} else {
			$('body').removeClass('header-expanded');
		}
	});

	// Sticky Info Box widget
	if ($('body').hasClass('logged-in')) {
		var spacing = 125;
	} else {
		var spacing = 93;
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
    	if('undefined' != has_filter){
			$('#main').imagesLoaded( function(){
				
				lsxProjectThumbInit();
				lsxProjectFilterInit();
	
				jQuery('#main').css('opacity', '1' );
			    
		    });			
			
		     /*var infinite_count = 0;
		     // Triggers re-layout on infinite scroll
		     $( document.body ).on( 'post-load', function () {
				infinite_count = infinite_count + 1;
	
				var selector = $('#infinite-view-' + infinite_count);
				//var $elements = $selector.find('.jetpack-portfolio');
				  var elements = [];
				  selector.find('.filter-item').each( function() {
					  elements.push( $(this) );
					  $('.filter-items-container').append($(this));
				});
				  selector.remove();
		     });*/
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
		    $('.page-banner').css('top', (scrolled) + 'px');
		}
		function parallax(){
		    var scrolled = $(window).scrollTop();
		    $('.page-banner').css('top', (scrolled * 0.1) + 'px');
		}

		$(window).scroll(function(e){
		    parallax();
		});
		
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