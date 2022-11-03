<?php
	//Session--------
	require("common.php");

	//Variables--------
	$title = $_POST["title"];
	$authors = $_POST["authors"];
	$theme = $_POST["theme"];

	//File upload--------
	$file_name = $_FILE["file"]["name"];
	$file_loc = "clanky/".$file_name;
	$file_name_temp = $_FILE["file"]["tmp_name"];
	move_uploaded_file($file_name_temp, $file_loc);	

	//Connect--------
	require("connect.php");
?>