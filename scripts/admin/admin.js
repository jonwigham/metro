// JavaScript Document

document.observe("dom:loaded", function() {

	$$("#metro_tabs li").each(function(el) {

		$(el).observe("click", function() {
			toggleMetroTabs(this);
		});

	});

	$$("#suggested_colours li").each(function(el) {

		$(el).down("span").addClassName("hidden");
		$(el).style.backgroundColor = "#" + $(el).down("span").innerHTML;

		$(el).observe("click", function() {
			$("metro_accent_colour").value = $(el).down("span").innerHTML.toUpperCase();
			$("metro_accent_colour").style.backgroundColor = "#" + $(el).down("span").innerHTML;
			highlightMetroSubmitButton();
		});

	});

	$$("#content_social input").each(function(el) {
		$(el).observe("change", highlightMetroSubmitButton);
	});

});

function toggleMetroTabs(li)
{
	$$("#metro_tabs li").each(function(el) {
		$(el).removeClassName("item_active");
	});
	$(li).addClassName("item_active");

	var tab_id = li.id.replace("tab_", "content_");
	$$("#metro_content .metro_content").each(function(el) {
		$(el).addClassName("hidden");
	});
	$(tab_id).removeClassName("hidden");

	$("current_metro_form_page").value = li.id;
}

function setMetroOption(a, v)
{
	var tr = $(a).up("tr");
	$$("#" + tr.id + " img").each(function(el) {
		$(el).removeClassName("img_active");
	});

	$(a).down("img").addClassName("img_active");

	$(tr).down(".row_answer").value = v;

	highlightMetroSubmitButton();
}

function highlightMetroSubmitButton()
{
	$("metro_options_submit").addClassName("highlight");
}