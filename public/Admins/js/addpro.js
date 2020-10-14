$(document).ready(function() {
	// Checkboxes are checked -> show price and saleprice
	$(document).find("input[type='checkbox']:not('.Category')").each(function(el) {
		var ischecked = $(this).is(':checked');
		var size = $(this).attr('id');
		if (ischecked == true) {
			$(document).find("input[name*='Price" + size + "']").each(function(el) {
				$(this).parent().attr("style", "display:block");
				$(this).attr("style", "display:block");
				$(this).removeAttr("disabled");
			});
		}
		else {
			$(document).find("input[name*='Price" + size + "']").each(function(el) {
				$(this).parent().attr("style", "display:none");
				$(this).attr("style", "display:none");
				$(this).attr("disabled", "disabled");
			});
		}
	});

	// Click checkbox show price and saleprice
	$(document).on("change", "input[type='checkbox']:not('.Category')", function(){
		if (this.checked) {
			var size = $(this).attr('id');
			$(document).find("input[name*='Price" + size + "']").each(function(el) {
				$(this).parent().attr("style", "display:block");
				$(this).attr("style", "display:block");
				$(this).removeAttr("disabled");
			});
		}
		else {
			var size = $(this).attr('id');
			$(document).find("input[name*='Price" + size + "']").each(function(el) {
				$(this).parent().attr("style", "display:none");
				$(this).attr("style", "display:none");
				$(this).attr("disabled", "disabled");
			});
			
		}
	});

	

});