<?php
	//Session--------
	require("common.php");

	//Variables--------
	$title = $_POST["title"];
	$authors = $_POST["authors"];
	$theme = $_POST["theme"];

	//File upload--------
	$file_name = $_FILES["file"]["name"];
	$file_loc = "/clanky/".$file_name;
	$file_name_temp = $_FILES["file"]["tmp_name"];
	echo $file_name . "<br>";
	echo $file_loc . "<br>";
	echo $file_name_temp . "<br>";
	if(move_uploaded_file($file_name_temp, $file_loc)) { echo "Článek byl úspěšně poslán."; }
	else { echo "Nepodařilo se poslat článek."; }	

	//Connect--------
	require("connect.php");
?>