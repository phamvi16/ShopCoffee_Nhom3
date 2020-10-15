$(document).ready(function() {
	
	// Checkboxes are checked -> show price and saleprice
	$(document).find("input[type='checkbox']:not('.Category')").each(function(el){
		var ischecked = $(this).is(':checked');
		var size = $(this).attr('id');
		var divSize = $(document).find("div.Size" + size);

		if (ischecked == true) {
			$("div.Size" + size).find("*").attr("style", "display:block");
			$("div.Size" + size).find("*").find("input[type=number]").removeAttr("disabled");

			// if check None then uncheck the orthers
			if (size == "None") {
				$(document).find("input[type='checkbox']:not('.Category, #None')").prop("checked", false);
				$(document).find("div[class*='Size']:not('.SizeNone')").find("*").attr("style", "display:none");
				$(document).find("div[class*='Size']:not('.SizeNone')").find("*").find("input[type=number]").attr("disabled", "disabled");
			}
			else {
				// uncheck None if one of the orthers is checked
				$(document).find("input[type='checkbox']#None").prop("checked", false);
				$(document).find("div.SizeNone").find("*").attr("style", "display:none");
				$(document).find("div.SizeNone").find("*").find("input[type=number]").attr("disabled", "disabled");
			}
		}
		else {
			$("div.Size" + size).find("*").attr("style", "display:none");
			$("div.Size" + size).find("*").find("input[type=number]").attr("disabled", "disabled");
		}
	});

	// Click checkbox show price and saleprice
	$(document).on("change", "input[type='checkbox']:not('.Category')", function(){
		var size = $(this).attr('id');
		var divSize = $(document).find("div.Size" + size);

		if (this.checked) {
			$("div.Size" + size).find("*").attr("style", "display:block");
			$("div.Size" + size).find("*").find("input[type=number]").removeAttr("disabled");

			// if check None then uncheck the orthers
			if (size == "None") {
				$(document).find("input[type='checkbox']:not('.Category, #None')").prop("checked", false);
				$(document).find("div[class*='Size']:not('.SizeNone')").find("*").attr("style", "display:none");
				$(document).find("div[class*='Size']:not('.SizeNone')").find("*").find("input[type=number]").attr("disabled", "disabled");
			}
			else {
				// uncheck None if one of the orthers is checked
				$(document).find("input[type='checkbox']#None").prop("checked", false);
				$(document).find("div.SizeNone").find("*").attr("style", "display:none");
				$(document).find("div.SizeNone").find("*").find("input[type=number]").attr("disabled", "disabled");
			}
		}
		else {
			$("div.Size" + size).find("*").attr("style", "display:none");
			$("div.Size" + size).find("*").find("input[type=number]").attr("disabled", "disabled");
		}

		
	});

});