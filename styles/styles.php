<?php
	/**
	 * Main CSS
	 *
	 * We minify everything on the fly so that the source files remain in place and easily editable
	 */
	$css_output = "";
	$style_sheets = array("common", "main", "header", "footer", "sidebar", "page", "comments", "responsive");
	foreach ($style_sheets as $file) $css_output .= file_get_contents("src/{$file}.css");


	/**
	 * Theme colours
	 */
	$template_path = str_replace("/styles/styles.php", "", $_SERVER["PHP_SELF"]);
	$theme = (in_array($_GET["theme"], array("light", "dark"))) ? $_GET["theme"] : "light";
	$theme_css = file_get_contents("src/theme.css");
	if ($theme == "dark")
	{
		$theme_colour = "dark";
		$font_colour = "ffffff";
		$secondary_font_colour = "676767";
		$bg_colour = "232323";
	}
	else
	{
		$theme_colour = "light";
		$font_colour = "000000";
		$secondary_font_colour = "888888";
		$bg_colour = "ffffff";
	}
	$css_output .= str_replace(
		array(
			"{BG_COLOUR}",
			"{FONT_COLOUR}",
			"{SECONDARY_FONT_COLOUR}",
			"{TEMPLATE_PATH}",
			"{THEME_COLOUR}"
		),
		array(
			$bg_colour,
			$font_colour,
			$secondary_font_colour,
			$template_path,
			$theme
		), $theme_css
	);


	/**
	 * Accent Colour
	 */
	$colour = preg_match("/^[a-f0-9]{6}$/", strtolower($_GET["accent"])) ? strtolower($_GET["accent"]) : "1ba1e2";
	$dark_colour = ColorDarken($colour, 50);
	$accent_css = file_get_contents("src/accent.css");
	$css_output .= str_replace(
		array(
			"{COLOUR}",
			"{DARK_COLOUR}",
			"{TEMPLATE_PATH}",
			"{THEME_COLOUR}"
		),
		array(
			$colour,
			$dark_colour,
			$template_path,
			$theme
		), $accent_css
	);


	/**
	 * Return a colour $dif shades darker than the supplied hex
	 */
	function ColorDarken($colour, $dif)
	{
		if (strlen($colour) != 6) return "000000";
		$rgb = "";
		for ($x=0; $x<3; $x++)
		{
			$c = hexdec(substr($colour, (2*$x), 2)) - $dif;
			$c = ($c < 0) ? 0 : dechex($c);
			$rgb .= (strlen($c) < 2) ? "0" . $c : $c;
		}
		return strtolower($rgb);
	}


	/**
	 * Minify the shit out of it all
	 */
	$css_output = preg_replace("/\/\*[^\*]*\*\//", "", $css_output);// remove all comments
	$css_output = preg_replace("/\t/", "", $css_output); // remove tabs
	$css_output = preg_replace("/\n/", "", $css_output); // remove line breaks
	$css_output = preg_replace("/(\s{)/", "{", $css_output); // remove the space around the braces
	$css_output = preg_replace("/({\s)/", "{", $css_output); // remove the space around the braces
	$css_output = preg_replace("/(\s})/", "}", $css_output); // remove the space around the braces
	$css_output = preg_replace("/(,\s)/", ",", $css_output); // remove the space after commas
	$css_output = preg_replace("/(:\s)/", ":", $css_output); // remove the space after colons

	header("Content-type: text/css");
	echo $css_output;
