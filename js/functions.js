(function( $ ) {
	$(document).foundation();
	
	var elem = new Foundation.HorizontalAccordion( $('#mission'), {
		tab: 'article',
		content: '.excerpt'		
	});
	$('#mission').height(parseInt( $('#mission').closest('section').width() ) + 'px');
	$('#mission').find('.excerpt').height(parseInt( $('section').width() - $('#mission article').height() ) + 'px')
})(jQuery);