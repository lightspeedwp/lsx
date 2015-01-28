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
	
	/*$('#filterNav a').click(function(){
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
	});	*/

    $(window).load(function() {
    	
		$('.lsx-portfolio').imagesLoaded( function(){
			
		    $('.lsx-portfolio').masonry({
				itemSelector: '.jetpack-portfolio',
				columnWidth: '.jetpack-portfolio',
				isFitWidth: true,
			    visibleStyle: { opacity: 1, transform: 'scale(1)' }
		    });
		    
	    });
		
		if(lsx_params.is_portfolio){
			var infinite_count = 0;
			$( document.body ).on( 'post-load', function () {
				
				infinite_count = infinite_count + 1;
				/*$('#infinite-view-' + infinite_count+' img.lsx-responsive').each( function() {
					$(this).attr('src',$(this).attr('data-desktop'));
				});*/	
				
			    
			    var $container = $('.lsx-portfolio').data('masonry');
			    var $selector = $('#infinite-view-' + infinite_count);
			    var $elements = $selector.find('.jetpack-portfolio');
			    $elements.hide();
			    $container.appended( $elements, true );
			    
			    $elements.fadeIn();
			    $selector.html('');
				
				//$('.lsx-portfolio').masonry('appended',$('.infinite-wrap').html());
	
				/*$('.lsx-portfolio').imagesLoaded( function(){
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
				});*/
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