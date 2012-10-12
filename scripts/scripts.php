<?php
/**
 * The template for displaying Category Archive pages
 *
 * @package Metro
 * @since Metro 1.0
 */

header("Content-type: text/JavaScript");

$template_path = str_replace("/scripts/scripts.php", "", $_SERVER["PHP_SELF"]);

$scripts = array("main", "addThis", "menu");
foreach ($scripts as $file) require_once("src/{$file}.js");
