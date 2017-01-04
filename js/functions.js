(function( $ ) {
	$(document).foundation();
	
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
	
	// Initalize Foundation components
	var elem = new Foundation.DropdownMenu( $('.header .navigation .site') );

	var elem = new Foundation.horizontalAccordion( $('#mission'), {
		accordionItem: 'article',
		tabContent: '.excerpt'		
	});
})(jQuery);