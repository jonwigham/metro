// Main

function addOnLoad(fn, args)
{
	var current_onload = window.onload;

	if (typeof(current_onload) != "function")
	{
		window.onload = fn;
	}
	else
	{
		window.onload = function() {
			if (current_onload) current_onload();
			fn();
		};
	}
}

addOnLoad(function() {
	var links=document.getElementsByTagName('a');
	for (var i=0; i<links.length; i++)
	{
		if (links[i].rel == 'external' || links[i].rel == "nofollow")
		{
			links[i].onclick = function() {
				return !window.open(this.href);
			};
		}
	}
});

addOnLoad(function() {

	if (!$("comments_form")) return;

	$$("#comments_form .field").each(function(el) {

		clearMetroField(el);

		$(el).observe("focus", function() {
			if (this.value == $(this).up("p").down("label").innerHTML)
			{
				this.value = "";
				$(this).removeClassName("inactive");
			}
		});
		$(el).observe("blur", function() {
			clearMetroField(this);
		});

	});

});

function clearMetroField(el)
{
	if ($(el).value == "")
	{
		$(el).value = $(el).up("p").down("label").innerHTML;
		$(el).addClassName("inactive");
	}
}