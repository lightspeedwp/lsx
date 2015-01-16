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
		
		$('img.lsx-responsive').each( function() {
			$(this).attr('src',$(this).attr('data-desktop'));
		});
		
		var width = $(window).width();
		$(window).resize(function() {
		   //if($(this).width() != width){
			
			if (992 == width || 768 == width){
				
			  var attribute_name = 'data-desktop';
			  
		      width = $(this).width();
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