jQuery(document).ready(function($) {
	// Show price when click on Size
	$(document).on('click', 'input[name="Size"]', function(event) {
		console.log('in');
		$(".product-prices #saleprice").text($(this).data('saleprice') + ' VND');
		$(".product-prices #price").text($(this).data('price') + ' VND');
	});
});