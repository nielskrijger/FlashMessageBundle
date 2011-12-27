/*
* jQuery FlashMessage plugin
*
* Copyright (c) 2011 Niels Krijger
*
* License: use wherever and however you want. No guarantees whatsoever.
*
* Version: 0.1
*/

jQuery.flash = function(settings) {
  
	(function($) {
    
		var message = settings.message || "No Message set";
		var type = settings.type || "success";
		var animationTime = 400;
		var messageDivId = "flashmessages";
		var messageDiv = $("#" + messageDivId);
		
		var bar = jQuery("<div/>", {
			text: message
		}).addClass(type);
		
		messageDiv.prepend(bar);
		messageDiv.css('display', 'block');
		
		// Show bar
		bar.slideDown(animationTime);
	  
		// Hide bar after clicking on it
		bar.click(function() {
			// Hide message container when last visible message is being hidden
			if ($("#" + messageDivId + " div:visible").size() == 1) {
				messageDiv.slideUp(animationTime);
			}
			$(this).slideUp(animationTime);
		})

})(jQuery) };