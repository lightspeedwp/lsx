/**
 * A small jquery plugin that does all of the hard work.
 */
jQuery( function( $ ) {

	$.fn.fontPickerCustomControl = function() {

		//return the 'this' selector to maintain jquery chainability
		return this.each(function() {

			// cache this selector for further use
			thisFontPickerCustomControl = this;

			// hide select box
			$("select", this).hide();

			// show fancy content
			$(".fancyDisplay", this).show();

			// add event listeners to fancy display
			$(".fancyDisplay ul li").on("click", function(event){
				// get index of clicked element
				var index = $(".fancyDisplay ul li", thisFontPickerCustomControl).index(this),
					clicked = $(this),
					parent = clicked.closest('.fancyDisplay');

				parent.find('.font-choice').removeClass('selected');

				// unselect all options
				$('select option', thisFontPickerCustomControl).removeAttr('selected');

				clicked.addClass('selected');
				// select new element
				// simulate a change
				$('select :nth-child('+(index+1)+')', thisFontPickerCustomControl).attr('selected', 'selected').change();
			});

		});

	};

} );
