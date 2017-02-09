(function( $ ) {
	$(document).foundation();
	
	// Initalize Foundation components
	var elem = new Foundation.DropdownMenu( $('.header .site') );

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
	if ( $('.background').length ){
		BackgroundCheck.init({
		  targets: '.background',
		  images: '.background',
		  changeParent: true
		});
	}
	
/*
	$('.filter').isotope({
		getSortData: {
			sort: '[data-sort]'
		},
		sortBy: 'sort'
	});
*/
})(jQuery);