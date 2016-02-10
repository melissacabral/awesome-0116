//no-conflict wrapper, so the $ shortcut is available
jQuery(document).ready( function($){
	//slider activation
	$("#awesome-slider ul").responsiveSlides({
		nav 	: true,
		pager 	: true,
		prevText: '&larr;',
		nextText: '&rarr;'
	});

	//hamburger menu
	$('.nav').before('<button id="menu-button">Menu</button>');

	$("#menu-button").click(function() {
		$("body").toggleClass('menu-open');
	});

	if ($(window).width() > 500) {
			$("body").addClass('showmenu');
			$("body").removeClass('menu-open');
		} else {
			$("body").removeClass('showmenu');
			

		}

	$(window).resize(function() {
		if ($(window).width() > 500) {
			$("body").addClass('showmenu');
			$("body").removeClass('menu-open');
		} else {
			$("body").removeClass('showmenu');
			

		}
	});
});