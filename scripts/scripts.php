<?php
	header("Content-type: text/JavaScript");

	$template_path = str_replace("/scripts/scripts.php", "", $_SERVER["PHP_SELF"]);

	require_once("src/main.js");
	require_once("src/addThis.js");
