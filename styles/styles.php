<?php
	header("Content-type: text/css");

	require_once("src/common.css");
	require_once("src/main.css");
	require_once("src/header.css");
	require_once("src/footer.css");
	require_once("src/sidebar.css");
	require_once("src/page.css");
	require_once("src/comments.css");
	require_once("src/mobile.css");
	require_once("src/mobile.css");
?>


<?php
	/**
	 * Theme
	 */
	$theme = (in_array($_GET["theme"], array("light", "dark"))) ? $_GET["theme"] : "light";
	if ($theme == "dark")
	{
		$theme_colour = "dark";
		$font_colour = "ffffff";
		$secondary_font_colour = "888888";
		$bg_colour = "232323";
	}
	else
	{
		$theme_colour = "light";
		$font_colour = "000000";
		$secondary_font_colour = "888888";
		$bg_colour = "ffffff";
	}
?>
/* Theme */
body {
	background-color: #<?php echo $bg_colour; ?>;
	color: #<?php echo $font_colour; ?>;
	}

#site-title a,
.secondary-color { color: #<?php echo $secondary_font_colour; ?>; }

#site-title li.item_active a { color: #<?php echo $font_colour; ?>; }

h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, h7a { color: #<?php echo $font_colour; ?>; }

#comments .comment a,
#comments .pingback a { color: #<?php echo $bg_colour; ?>; text-decoration: underline; }
#comments .comment a:hover,
#comments .pingback a:hover { text-decoration: none; }

.callout span.arrow { background-color: #<?php echo $bg_colour; ?>; }

#sidebar ul li.bullets ul li span.arrow { background-image: url("/wp-content/themes/metro/images/themes/<?php echo $theme_colour; ?>/arrow.png"); }

#sidebar #categories ul li a { border: 1px solid #<?php echo $bg_colour; ?>; }


<?php
	/**
	 * Accent Colour
	 */
	$colour = preg_match("/^[a-f0-9]{6}$/", strtolower($_GET["accent"])) ? $_GET["accent"] : "1ba1e2";
	$dark_colour = ColorDarken($colour, 50);

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
	return $rgb;
	}

?>
/* Accent */

.theme_color, a { color: #<?php echo $colour; ?>; }

.theme_background { background-color: #<?php echo $colour; ?>; color: #ffffff; }
.theme_background_dark { background-color: #<?php echo $dark_colour; ?>; color: #ffffff; }
.theme_background a { color: #ffffff; }

#sidebar ul li.bullets ul li span.arrow,
#searchform div span { background-color: #<?php echo $colour; ?>; }

#masthead,
.entry-meta img.avatar,
.post blockquote,
#sidebar #categories ul li a:hover,
input,
#social { border-color: #<?php echo $colour; ?>; }