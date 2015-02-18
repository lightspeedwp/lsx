var colW;
var gridContainer = jQuery('.filter-items-container');


jQuery(document).ready(function($) {
	$('table#wp-calendar').addClass('table');
	
	$(window).scroll(function(){
	    if($(window).scrollTop() > 100) {
	        $('header.banner').addClass('scrolled');
	    } else {
	        $('header.banner').removeClass('scrolled');
	    }
	});



    $(window).load(function() {
		
    	
    	var has_filter = $('#filterNav');
    	if('undefined' != has_filter){
			$('#main').imagesLoaded( function(){
				
				projectThumbInit();
				projectFilterInit();
	
				jQuery('#main').css('opacity', '1' );
			    
		    });			
			
		     var infinite_count = 0;
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
		     });
    	}
    	
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
		
		$('img.lsx-responsive').each( function() {
			$(this).attr('src',$(this).attr('data-desktop'));
		});
		
		var width = $(window).width();
		if(1186 < width){
			$('.navbar-nav li.dropdown a').each(function(){
				$(this).removeClass('dropdown-toggle');
				$(this).removeAttr('data-toggle');
			});
		}
		
		//Page Banner
		var banner_attribute_name = 'data-desktop';
		if(width <= 768){
			banner_attribute_name = 'data-mobile';
		}
		if($('body').hasClass('page')){		
			var image_url = 'url('+$('header.bs-image-header').attr(banner_attribute_name)+')';
			$('header.bs-image-header').css('background-image',image_url);			
		}
		
		$(window).resize(function() {
		   //if($(this).width() != width){
			
			width = $(window).width();
			
			console.log(width);
			var banner_attribute_name = 'data-desktop';
			if(width <= 768){
				banner_attribute_name = 'data-mobile';
			}
			if($('body').hasClass('page')){		
				var image_url = 'url('+$('header.bs-image-header').attr(banner_attribute_name)+')';
				$('header.bs-image-header').css('background-image',image_url);			
			}
			
			
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
			
			if ('992' == width || '768' == width){
				
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
		      
		      $('img.lsx-responsive').each( function(){
				$(this).attr('src',$(this).attr(attribute_name));
		      });		      
		      
		   }
		});		
	});
});

///////////////////////////////
//Isotope Grid Resize
///////////////////////////////

function lsx_set_portfolio_columns()
{
	var columns;
	var gw = jQuery('.filter-items-wrapper').width();
	if(gw<=992){
		columns = 2;
	}else if(gw<=1700){
			columns = 3;
	}else{
		columns = 6; 
	}
	colW = Math.floor(gw / columns) - 14;
	jQuery('.filter-item').each(function(id){
		jQuery(this).css('width',colW + 'px');
	});
	jQuery('.filter-item').show();
}

function gridResize() {
	setColumns();
	jQuery('.filter-items-wrapper').isotope({
		resizable: false,
		layoutMode: 'fitRows',
		masonry: {
			columnWidth: colW
		}
	});
}

///////////////////////////////
//Project thumbs
///////////////////////////////

function projectThumbInit() {
	lsx_set_portfolio_columns();
	gridContainer.isotope({
		resizable: false,
		layoutMode: 'fitRows',
		itemSelector: '.filter-item',
		masonry: {
			columnWidth: colW
		}
	});

	jQuery(".filter-items-container .filter-item").css("visibility", "visible");
}

///////////////////////////////
//Project Filtering
///////////////////////////////

function projectFilterInit() {
	
	jQuery('#filterNav a').click(function(){
		var selector = jQuery(this).attr('data-filter');
		jQuery('.filter-items-wrapper .filter-items-container').isotope({
			filter: selector,
			hiddenStyle : {
		    	opacity: 0,
		    	scale : 1
			}		
		});

		if ( !jQuery(this).hasClass('selected') ) {
			jQuery(this).parents('#filterNav').find('.selected').removeClass('selected');
			jQuery(this).addClass('selected');
		}

		return false;
	});	
}