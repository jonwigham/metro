addOnLoad(function() {

	$$("li.widget-container ul li").each(function(el) {

		if ($(el).up("li").id.indexOf("categories") == 0) return;

		var span = document.createElement("SPAN");
		span.innerHTML = el.innerHTML;
		el.innerHTML = "";
		$(el).insert({"top": span});

		var span = document.createElement("SPAN");
		span.className = "arrow";
		$(el).insert({"top": span});

	});

});