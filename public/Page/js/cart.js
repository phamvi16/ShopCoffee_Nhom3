$(document).ready(function() {
	var modal = $('.modal');
	var buttonOKPrice = modal.find('.update-topping-btn span');
	// Load modal
	$(document).on('click', '.btn-update a', function(event) {
		var key = $(this).data('key');
		$('.modal').attr('id', 'exampleModal' + key);
		$.ajax({
			url: '/gio-hang/get-modal',
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
				// Change price in header
				modal.find('.modal-header h4.price span').text(parseInt(res.cart_item['product_price']).toLocaleString('vi'));
				// Load available sizes
				modal.find('.size-radio').html(res.size_view);
				
				// Change attribute sugar
				modal.find('div.sugar input[name="Sugar"][value="' + res.cart_item["sugar"] + '"]').prop('checked', true);
				// Change attribute ice
				modal.find('div.ice input[name="Ice"][value="' + res.cart_item["ice"] + '"]').prop('checked', true);
				// Change attribute hot
				if (res.cart_item['hot'] != "") {
					modal.find('div.ice input[name="Hot"]').prop('checked', true);	
				}
				
				// Change data key of button update
				modal.find('.update-topping-btn').attr('data-key', key);
				// Load price
				buttonOKPrice.attr('data-total', res.item_total);
				// Change display price in button: toLocaleString('vi'): format number by locale
				buttonOKPrice.text(parseInt(res.item_total).toLocaleString('vi'));
			},
			error: function(error) {
				console.log(error);
			}
		})
	});

	// Change modal information when change size
	$(document).on('click', '.size-radio input[name="product_size"]', function(event) {
		// price of current size
		var size_price = parseInt($(this).attr('data-saleprice'));
		// get previous size
		var old_size = modal.find('.modal-header h4.size span').text();
		// price of previous size
		var old_size_price = parseInt($('.size-radio input[data-size="' + old_size + '"]').attr('data-saleprice'));
		// old total price in button OK
		var old_price = parseInt(buttonOKPrice.attr('data-total'));
		// new total price
		var new_price = (old_price - old_size_price) + size_price;
		// Change size in header
		modal.find('.modal-header h4.size span').text($(this).attr('data-size'));
		// Change price in header
		modal.find('.modal-header h4.price span').text(parseInt(size_price).toLocaleString('vi'));
		// Store price
		buttonOKPrice.attr('data-total', parseInt(new_price));
		// Change display price in button: toLocaleString('vi'): format number by locale
		buttonOKPrice.text(parseInt(new_price).toLocaleString('vi'));
	});

	// Change modal information when changing topping
	$(document).on('click', '.modal .topping input[name="Topping[]"] ', function(event) {
		// price of clicked topping
		var topping_price = parseInt($(this).attr('data-Topping-price'));
		// old total price
		var old_price = parseInt(buttonOKPrice.attr('data-total'));
		var new_price;
		if ($(this).is(':checked')){
			// Checked
			// new total price
			new_price = old_price + topping_price;
		}
		else {
			// Unchecked
			// new total price
			new_price = old_price - topping_price;
		}
		// Store price
		buttonOKPrice.attr('data-total', parseInt(new_price));
		// Change display price in button: toLocaleString('vi'): format number by locale
		buttonOKPrice.text(parseInt(new_price).toLocaleString('vi'));
	});

	// Clicked radio button hot
	$(document).on('click', 'input[name="Hot"]', function(event) {
		$(".modal input[name='Ice']:checked").prop('checked', false);
	});

	// Clicked radio button ice
	$(document).on('click', 'input[name="Ice"]', function(event) {
		$(".modal input[name='Hot']:checked").prop('checked', false);
	});

	// Update
	$(document).on('submit', '#frm-update', function(event) {
		event.preventDefault();
		var buttonOK = modal.find('.update-topping-btn');
		var key = parseInt(buttonOK.attr('data-key'));
		/* Act on the event */
		// Lấy giá trị của form
		var data = $(this).serialize() + "&item_key=" + key;
		
		console.log(data);
		$.ajax({
			url: '/gio-hang/update',
			type: 'post',
			dataType: 'json',
			data: data,
			success: function(reponse) {
				var res = JSON.parse(JSON.stringify(reponse));
				$('div.row.items.' + key).empty();
				$('div.row.items.' + key).prepend(res.item_view);
				$('.total div.pl-5.pt-4.mr-5 span').text(parseInt(res.cart_total).toLocaleString('vi'));
				$('.d-flex div.pl-5.pt-4.mr-5 span').text(parseInt(res.cart_total).toLocaleString('vi'));
				
				console.log(res);
				console.log("success");
			},
			error: function(error) {
				console.log(error);
			}
		});
		
	});
});