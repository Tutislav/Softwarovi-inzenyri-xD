<?php
	//Session--------
	require("common.php");

	//Variables--------
	$title = $_POST["title"];
	$authors = $_POST["authors"];
	$file = $_POST["file"];
	$theme = $_POST["theme"];

	echo $title;
	echo $authors;
	echo $file;
	echo $theme;
	
	//Connect--------
	require("connect.php");
?>