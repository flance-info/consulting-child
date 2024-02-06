(function ($) {
	"use strict";

	jQuery(document).ready(function ($) {
		$('#menu_toggle').on('click', function () {
			$(this).toggleClass('open');
			$('.mobile_header .top_nav_mobile').slideToggle(300);
			return false;
		});

	});

})(jQuery);