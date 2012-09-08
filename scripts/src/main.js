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
