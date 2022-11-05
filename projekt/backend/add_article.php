<?php
	//Session--------
	require("common.php");

	//Connect--------
	require("connect.php");

	//Variables--------
	$title = $_POST["title"];
	$authors = $_POST["authors"];
	$theme = $_POST["theme"];
	$file = $_FILES["file"]["name"];

	//Empty check--------
	if(!empty($title) && !empty($authors) && !empty($file) && !empty($theme))
	{		
		//File--------
		$file_array = explode(".", $file);
		$file_name = $file_array[0];
		$file_ext = $file_array[1];
		$file_name = $file_name."_".date("y-m-d-h-i-s").".".$file_ext;

		$file_loc = "../clanky/".$file_name;
		$file_name_temp = $_FILES["file"]["tmp_name"];
		if(move_uploaded_file($file_name_temp, $file_loc)) 
		{ 
			//Insert database soubor--------
			
			//Insert database prispevek--------	
		}
		else 
		{
			$_SESSION["message"] = "Nepodařilo se poslat soubor článku.";
			header("Location: ../add_article.php");
		}	
	}
	else 
	{ 
		$_SESSION["message"] = "Vyplňte všechna políčka.";
		header("Location: ../add_article.php");
	}		
?>