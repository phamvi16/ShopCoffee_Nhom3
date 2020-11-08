$(document).ready(function() {
	$(document).on('click', '.btn-update a', function(event) {
		var key = $(this).data('key');
		var modal = $('.modal');
		$('.modal').attr('id', 'exampleModal' + key);
		$.ajax({
			url: '/get-modal',
			type: 'post',
			dataType: 'json',
			data: {key: key},
			success: function(reponse){
				var res = JSON.parse(JSON.stringify(reponse));
				// console.log(res.cart_item);
				// Change image
				modal.find('.modal-header img').attr('src', '/ProductImages/Products/' + res.cart_item['product_image']);
				// Change name
				modal.find('.modal-header h4.name').text(res.cart_item["product_name"]);
				// Change size in header
				modal.find('.modal-header h4.size span').text(res.cart_item["product_size"]);
				// Load available sizes
				modal.find('.size-radio').html(res.size_view);
			},
			error: function(error) {
				console.log(error);
			}
		})
		
		
	});
});