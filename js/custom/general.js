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

    // Masonry
    var msnryContainerSelector = ".lsx-portfolio";
	var msnryItemSelector = ".jetpack-portfolio";

	$(msnryContainerSelector).imagesLoaded(function(){
		
        $(msnryContainerSelector).masonry({
		itemSelector: msnryItemSelector
		});
                
        $(msnryContainerSelector).masonry( 'on', 'layoutComplete', function( msnryInstance, laidOutItems ) {
            var masonryItems = $(this.element).find(msnryItemSelector);
            masonryItems.fadeTo(400, 1);// Fade blocks in after images are ready (prevents jumping and re-rendering)
        });
	});

	$(document).ready( function() { setTimeout( function() { $(msnryContainerSelector).masonry(); }, 500); });

	$(window).resize(function () {
		$(msnryContainerSelector).masonry();
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
	/*
	$('.lsx-portfolio').imagesLoaded( function(){
	    $('.lsx-portfolio').masonry({
			itemSelector: '.jetpack-portfolio',
			isAnimated: true,
			isFitWidth: true
	    });
    });
	*/
});