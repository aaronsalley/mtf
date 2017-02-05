(function( $ ) {
	$(document).foundation();
	
	// Initalize Foundation components
	var elem = new Foundation.DropdownMenu( $('#header .site') );

	var elem = new Foundation.horizontalAccordion( $('#mission'), {
		accordionItem: 'article',
		tabContent: '.excerpt'		
	});

	$('.carousel').owlCarousel({
		responsive: {
			0 : {
				items: 4,
				margin: 10
			}
		},
		itemElement: 'article',
		loop: true
	});
	
	/*
    $('.background').colourBrightness();
    if ( $('.background').hasClass('light') ) { $('.background').removeClass('light').parent().addClass('light'); }
	*/
	BackgroundCheck.init({
	  targets: '.background',
	  images: '.background',
	  changeParent: true
	});
})(jQuery);