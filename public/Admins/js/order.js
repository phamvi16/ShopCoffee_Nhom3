$(document).ready(function() {
	/**
	 * Filter order when change Date filter or Status filter
	 */
	$(document).on('change', 'input[name="FromDate"], input[name="ToDate"], select#filter-status', function(event) {
		// Remove alert
		$('.card').find(".alert-box").remove();

		// Get date
		var fromDate = $('input[name="FromDate"]').val();
		var toDate = $('input[name="ToDate"]').val();

		// Get status
		var status = $('select#filter-status').val();
		
		// Allow ajax
		var allow = false;

		// Check
		if (fromDate != "" && toDate != "" || status != "") {
			// Date filter or Status filter
			// Check status
			if (status == "") {
				$('.card .filter-option').after('<div class="alert-box error"><span>Lỗi: </span>Lọc theo trạng thái không được trống</div>');
				allow = false;
			}
			else {
				allow = true;
			}

			// Check date
			if (fromDate == "" && toDate == ""){
				// Both date are empty
				allow = true;
			}
			else if (fromDate != "" && toDate != ""){
				// Both date are not empty
				if ((Date.parse(fromDate) < Date.parse(toDate))) {
					// fromDate < toDate
					allow = true;
				}
				else {
					// fromDate > toDate
					allow = false;
					$('.card .filter-option').after('<div class="alert-box error"><span>Lỗi: </span>Ngày bắt đầu phải trước hoặc bằng ngày kết thúc</div>');
				}
			}
			else {
				allow = false;
				$('.card .filter-option').after('<div class="alert-box error"><span>Cảnh báo: </span>Ngày bắt đầu và ngày kết thúc không được trống</div>');
			}

			// Check allow ajax
			if (allow == true){
				filter(fromDate, toDate, status);
			} 
			else {
				// Show error
				$('#order-table-body').html('<tr><td colspan="6">Không tìm thấy đơn hàng phù hợp</td></tr>');
			}
		}
	});

	// Exit and reset filter Date -> filter by Status
	$(document).on('click', '#btnHuyFilterDate', function(event) {
		// Remove alert
		$('.card').find(".alert-box").remove();

		// Reset fromDate and toDate
		$('input[name="FromDate"]').val("");
		$('input[name="ToDate"]').val("");

		// Get status
		var status = $('select#filter-status').val();

		// Reset ajax
		if (status != "") {
			filter("", "", status);
		}
	});

});

// Function filter
function filter(fromDate, toDate, status){
	$.ajax({
		url: '/admin/order/filter',
		type: 'get',
		dataType: 'json',
		data: {
			fromDate: fromDate,
			toDate: toDate,
			status: status
		},
		success: function(response) {
			var res = JSON.parse(JSON.stringify(response));
			// Change table
			$('#order-table-body').html(res.filterResultView);

			// Show alert success
			$('.card .filter-option').after('<div class="alert-box success"><span>Thành công: </span>' + res.description + '</div>');
		},
		error: function(error) {
			if (error.status == 422) { //Status code == 422 validation errors
	            // Show validation error
	            $.each(error.responseJSON.errors, function (i, error) {
	                $.each(error, function(index, value) {
	                	$('.card .filter-option').after('<div class="alert-box error"><span>Lỗi: </span>'+ value +'</div>');
	                });
	            });
	            // Show error
				$('#order-table-body').html('<tr><td colspan="6">Không tìm thấy đơn hàng phù hợp</td></tr>');
	        }
			// console.log(error);
		}
	});
}