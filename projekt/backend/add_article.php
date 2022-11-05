<?php
	//Session--------
	require("common.php");

	//Connect--------
	require("connect.php");

	//Variables--------
	$title = $_POST["title"];
	$authors = $_POST["authors"];
	$theme = $_POST["theme"];
	$file_name = $_FILES["file"]["name"];
	

	//Empty check--------
	if(!empty($title) && !empty($authors) && !empty($file_name) && !empty($theme))
	{		
		//File--------
		$file_loc = "../clanky/".$file_name;
		$file_name_temp = $_FILES["file"]["tmp_name"];
		if(move_uploaded_file($file_name_temp, $file_loc)) { echo "Článek byl úspěšně poslán."; }
		else { echo "Článek se nepodařilo poslat."; }
		
		//Insert database
		
	}
	else 
	{ 
		$_SESSION["message"] = "Vyplňte všechna políčka.";
		header("Location: ../add_article.php");
	}
	echo $_FILES["file"]["error"];
		
?>