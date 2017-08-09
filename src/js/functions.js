(function( $ ) {
	$(document).foundation();
	
	// Initalize Foundation components
	if( Foundation.MediaQuery.atLeast('medium') ){
		var elem = new Foundation.DropdownMenu( $('.header .site-nav') );
	}
	
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

	function supportsInlineSVG() {
		var div = document.createElement( 'div' );
		div.innerHTML = '<svg/>';
		return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
	}

	if ( true === supportsInlineSVG() ) {
		document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
	}

	function perspective(args) {
		var showMenu = $( args.trigger ),
			perspective = $( args.target );
			
			perspective.addClass('perspective effect-' + args.effect).wrapInner('<div class="wrapper"></div>').wrapInner('<div class="container"></div>');
			
			$('.outer-nav').appendTo(perspective);
			var container = perspective.children( '.container' ),
				wrapper = container.children( '.wrapper' );			
			
		showMenu.on( 'click touchstart', function( event ) {
			var docscroll = window.pageYOffset || $().scrollTop;

			event.stopPropagation();
			event.preventDefault();

			// change top of wrapper
			wrapper[0].top = docscroll * -1 + 'px';

			// mac chrome issue:
			$('body').scrollTop = $().scrollTop = 0;

			// add modalview class
			perspective.addClass( 'modalview' );

			// animate..
			setTimeout( function() { perspective.addClass( 'animate' ); }, 25 );
		});
		
		perspective.on( 'click touchstart', function( event ) {
			container.addClass( 'transform' );
			if( perspective.hasClass( 'animate' ) ) {
					
				perspective.removeClass( 'modalview' );
				container.removeClass( 'transform' );

				// mac chrome issue:
				$('body').scrollTop = $().scrollTop = 0;

				// change top of wrapper
				wrapper.top = '0px';

				perspective.removeClass( 'animate' );
			}
		});
	}
	if( Foundation.MediaQuery.current == 'small' ) {
		$('#perspective').append($('nav.outer-nav'));
		perspective({
			effect: 'moveleft',
			target: '#perspective',
			trigger: '.menu-icon'
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
		function updateAccordion() {
			var accordionOptions = {
						shrink: 75,
						accordionItem: 'article',
						tabContent: '.excerpt'
					};
			if( Foundation.MediaQuery.atLeast('medium') ){
				var elem = new Foundation.blurAccordion( $('#mission'), accordionOptions);
			} else {
		        $('#mission').children('.is-active').removeAttr( 'style' );
		        $('#mission').children('.is-active').children(accordionOptions.tabContent).removeAttr( 'style', 'width' );
		        $('#mission').children(accordionOptions.accordionItem).each(function(idx, el){
					var $el = $(el);
			        $el.find('a:first').removeAttr( 'style' );
		        });
				var elem = new Foundation.Accordion( $('#mission'), accordionOptions);
			}
		}
		updateAccordion();
		
	}).resize();
})(jQuery);