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
/*
    //Masonry blocks
	$blocks = $(".lsx-portfolio");

	$blocks.imagesLoaded(function(){
		$blocks.masonry({
			itemSelector: '.jetpack-portfolio'
		});

		// Fade blocks in after images are ready (prevents jumping and re-rendering)
		$(".jetpack-portfolio").fadeIn();
	});
	
	$(document).ready( function() { setTimeout( function() { $blocks.masonry(); }, 500); });

	$(window).resize(function () {
		$blocks.masonry();
	});

	/*
	$('.lsx-portfolio').masonry({
	    itemSelector: '.jetpack-portfolio',
	    singlemode: true,
	    isAnimated: true,
	    animationOptions: {
	        duration: 700,
	        easing: 'linear',
	        queue: false
	    }
	});

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
*/	
	$(window).load(function() {
	    $('.lsx-portfolio').masonry({
		    itemSelector: '.jetpack-portfolio',
		    singlemode: true,
		    isAnimated: true,
		    animationOptions: {
		        duration: 700,
		        easing: 'linear',
		        queue: false
		    }
		});

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

	