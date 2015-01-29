var colW;
var gridContainer = jQuery('.lsx-portfolio');


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
    	

		
		if(lsx_params.is_portfolio){
						
			$('.portfolio-content-wrapper').hover(function() {
		        $(this).addClass('active');
		    }, function() {
		        $(this).removeClass('active');
		    });			

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
				  selector.find('.jetpack-portfolio').each( function() {
					  elements.push( $(this) );
					  $('.lsx-portfolio').append($(this));
				});
				  selector.remove();
		     });

		}
    	
		
		
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
		
		
		$(window).resize(function() {
		   //if($(this).width() != width){
			
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
	var gw = jQuery('.lsx-portfolio-wrapper').width();
	if(gw<=700){
		columns = 2;
	}else if(gw<=1700){
			columns = 3;
	}else{
		columns = 6; 
	}
	colW = Math.floor(gw / columns) - 14;
	jQuery('.jetpack-portfolio').each(function(id){
		jQuery(this).css('width',colW + 'px');
	});
	jQuery('.jetpack-portfolio').show();
}

function gridResize() {
	setColumns();
	jQuery('.lsx-portfolio-wrapper').isotope({
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
		itemSelector: '.jetpack-portfolio',
		masonry: {
			columnWidth: colW
		}
	});

	jQuery(".lsx-portfolio .jetpack-portfolio").css("visibility", "visible");
}

///////////////////////////////
//Project Filtering
///////////////////////////////

function projectFilterInit() {
	
	jQuery('#filterNav a').click(function(){
		var selector = jQuery(this).attr('data-filter');
		jQuery('.lsx-portfolio-wrapper .lsx-portfolio').isotope({
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