jQuery(document).ready(function() {
	jQuery('.wp-block-yoast-faq-block .schema-faq-question').on('click', function() {
		
		var schema_faq_question = jQuery('.wp-block-yoast-faq-block .schema-faq-question');
		schema_faq_question.removeClass('faq-q-open');
		schema_faq_question.siblings('.schema-faq-answer').removeClass('faq-a-open').slideUp();
		
		if (jQuery(this).siblings('.schema-faq-answer').is(':visible')) {
			jQuery(this).removeClass('faq-q-open');
			jQuery(this).siblings('.schema-faq-answer').removeClass('faq-a-open').slideUp();
	} 
	else {
		jQuery(this).addClass('faq-q-open');
		jQuery(this).siblings('.schema-faq-answer').addClass('faq-a-open').slideDown();
		}
	})
});