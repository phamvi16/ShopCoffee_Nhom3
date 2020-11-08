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
				console.log(res.cart_item);
				modal.find('.modal-header img').attr('src', '/ProductImages/Products/' + res.cart_item['product_image']);
				modal.find('.modal-header h4.name').text(res.cart_item["product_name"]);
				modal.find('.modal-header h4.size').text(res.cart_item["product_size"]);
			},
			error: function(error) {
				console.log(error);
			}
		})
		
		
	});
});