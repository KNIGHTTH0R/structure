var page_content = $( '.page-content' );

$( document ).ready( function() {
	content_resize();
});

$( window ).resize( function() {
	content_resize();
});

function content_resize() {
	var vph = $( window ).height();
	vph = parseInt( vph ) - 145;
	page_content.css({ 'min-height': vph + 'px'});
}