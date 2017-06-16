$(document).ready(function() {
	$(document.body).on('submit', '.js-confirm', function() {
		var $el = $(this)
		var text = $el.data('confirm') ? $el.data('confirm') : 'Anda Yakin Melakukan Tindakan Ini ?'
		var c = confirm(text);
		return c;

		add selectize to select element
		$('.js-selectize').selectize({
			sortField:'text'
		});
	});
});