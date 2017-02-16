(function( $ ) {
	$(document).foundation();
	
	// Initalize Foundation components
	var elem = new Foundation.DropdownMenu( $('.header .site') );
//  	var elem = new Foundation.OffCanvas($('site'));

	$('.carousel').owlCarousel({
		responsive: {
			0 : {
				items: 2,
				margin: 10
			},
			640 : {
				items: 4,
				margin: 10
			},
			1024 : {
				items: 5,
				margin: 20
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

	$(window).on( 'resize', function(){
		var accordionOptions = {
					accordionItem: 'article',
					tabContent: '.excerpt'	
				};
		if( Foundation.MediaQuery.atLeast('medium') ){
			var elem = new Foundation.horizontalAccordion( $('#mission'), accordionOptions );
		} else {
	        $('#mission').children('.is-active').removeAttr( 'style' );
	        $('#mission').children('.is-active').children(accordionOptions.tabContent).removeAttr( 'style', 'width' );
	        $('#mission').children(accordionOptions.accordionItem).each(function(idx, el){
				var $el = $(el);
		        $el.find('a:first').removeAttr( 'style' );
	        });
			var elem = new Foundation.Accordion( $('#mission'), accordionOptions);
		}
	}).resize();
})(jQuery);