jQuery(document).ready(function($) {
	$('table#wp-calendar').addClass('table');
	
	$(window).scroll(function(){
	    if($(window).scrollTop() > 100) {
	        $('header.banner').addClass('scrolled');
	    } else {
	        $('header.banner').removeClass('scrolled');
	    }
	});

	$('.portfolio-thumbnail').hover(function() {
        $(this).addClass('zoom');
    }, function() {
        $(this).removeClass('zoom');
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
	});
});

	