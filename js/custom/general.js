var colW;


jQuery(document).ready(function($) {
	$('table#wp-calendar').addClass('table');
	
	$(window).scroll(function(){
	    if($(window).scrollTop() > 100) {
	        $('header.banner').addClass('scrolled');
	    } else {
	        $('header.banner').removeClass('scrolled');
	    }
	});

	$('.portfolio-content-wrapper').hover(function() {
        $(this).addClass('active');
    }, function() {
        $(this).removeClass('active');
    });
	
	$('#filterNav a').click(function(){
		var selector = $(this).attr('data-filter');
		$('.lsx-portfolio-wrapper .lsx-portfolio').isotope({
			filter: selector,
			hiddenStyle : {
		    	opacity: 0,
		    	scale : 1
			},
			animationOptions: {
		        duration: 700,
		        easing: 'linear',
		        queue: false
		    }		
		});

		if ( !$(this).hasClass('selected') ) {
			$(this).parents('#filterNav').find('.selected').removeClass('selected');
			$(this).addClass('selected');
		}

		return false;
	});	

    $(window).load(function() {
    	
		$('.lsx-portfolio').imagesLoaded( function(){
			
		    $('.lsx-portfolio').masonry({
				itemSelector: '.jetpack-portfolio',
				isAnimated: true,
				isFitWidth: true,
				animationOptions: {
			        duration: 700,
			        easing: 'linear',
			        queue: false
			    }
		    });
		    
	    });
		
		if(lsx_params.is_portfolio){
			$( document.body ).on( 'post-load', function () {
				
				$('.lsx-portfolio').append($('.infinite-wrap').html());
				$('.infinite-wrap').html('');
				
				$('img.lsx-responsive').each( function() {
					$(this).attr('src',$(this).attr('data-desktop'));
				});	
				
				$('.lsx-portfolio').masonry('destroy');
	
				$('.lsx-portfolio').imagesLoaded( function(){
				    $('.lsx-portfolio').masonry({
						itemSelector: '.jetpack-portfolio',
						isAnimated: true,
						isFitWidth: true,
						animationOptions: {
					        duration: 700,
					        easing: 'linear',
					        queue: false
					    }
				    });
				});
			    console.log('reloaded');
		    } );
		}
    	
    	/*lsx_set_portfolio_columns();*/
		/*$('.lsx-portfolio.masonry').isotope({
			resizable: false,
			layoutMode: 'fitRows',	
			masonry: {
				columnWidth: 300,
				isFitWidth: true,
				itemSelector: '.jetpack-portfolio',
				isAnimated: true,				
				animationOptions: {
			        duration: 700,
			        easing: 'linear',
			        queue: false
			    }				
			}
		});*/
		
		
		
		
		
		$('img.lsx-responsive').each( function() {
			$(this).attr('src',$(this).attr('data-desktop'));
		});
		
		var width = $(window).width();
		if(992 < width){
			$('.navbar-nav li.dropdown a').each(function(){
				$(this).removeClass('dropdown-toggle');
				$(this).removeAttr('data-toggle');
			});
		}
		
		
		$(window).resize(function() {
		   //if($(this).width() != width){
			
			width = $(window).width();
			console.log(width);
			if (992 < width){
				$('.navbar-nav li.dropdown a').each(function(){
					$(this).removeClass('dropdown-toggle');
					$(this).removeAttr('data-toggle');
					console.log('remove dropdown toggle');
				});
			}else{
				$('.navbar-nav li.dropdown a').each(function(){
					$(this).addClass('dropdown-toggle');
					$(this).attr('data-toggle','dropdown');
					console.log('adding dropdown toggle');
				});				
			}
			
			
			if ('992' == width || '768' == width){
				
			  var attribute_name = 'data-desktop';
			  
		      //1200, 992, 768
		      if (width >= 992) {

		    	  attribute_name = 'data-desktop';
		    	  console.log('Changing to Desktop');

		      } else {
		    	  
		    	  if (width < 992 && width >= 768) {
		    		  
		    		  attribute_name = 'data-tablet';
		    		  console.log('Changing to Tablet');
		    		  
		    	  } else {
		    		  attribute_name = 'data-mobile';
		    		  console.log('Changing to Mobile');
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
	colW = Math.floor(gw / columns);
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