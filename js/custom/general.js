var filter_item_width;
jQuery(document).ready(function($) {
	
	filter_item_width = jQuery('.filter-items-container').width();
	filter_item_width = filter_item_width/3;
	
	$('table#wp-calendar').addClass('table');
	
	/*
	var div = document.createElement("div");
	div.id = "body-wrapper";
	// Move the body's children into this wrapper
	while (document.body.firstChild)
	{
	    div.appendChild(document.body.firstChild);
	}
	// Append the wrapper to the body
	document.body.appendChild(div);

	$(function () {
	  $.srSmoothscroll({
	    step: 100,
	    speed: 975,
	    ease: 'swing',
	    target: $('body'),
	    conainter: $(window)
	  })
	})
	*/

	$(window).scroll(function(){
	    if($(window).scrollTop() > 180) {
	        $('header.banner').addClass('scrolled');
	    } else {
	        $('header.banner').removeClass('scrolled');
	    }
	});

	// Removing homepage slider for mobile
	$(document).resize(function () {
	    var screen = $(window)    
	    if (screen.width < 768) {
	        $(".home .soliloquy-slider").remove();
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
		bottomSpacing: 590,
		getWidthFrom: '#secondary',
    	responsiveWidth: true
	});

	// Sticky Book Now widget
	$(".sticky-book").sticky({ 
		topSpacing: 127,
		bottomSpacing: 700
	});

    $(window).load(function() {
		
    	// The soprter for the portfolio.
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