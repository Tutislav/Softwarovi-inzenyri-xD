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
		//Insert database
		$insert = "insert into prispevek (id_prispevku, id_uzivatele, tematicke_cislo, spoluautori, stav, titulek)
			values (1, $_SESSION[user_id], $theme, $authors, Schváleno, $title)";
		$result = mysqli_query($conn, $insert);
		if($result) { echo "Zapsání do databáze bylo úspěšné."; }
		else { echo "Nepodařilo se zapsat do databáze."; }
		
		//File--------
		$file_loc = "clanky/".$file_name;
		$file_name_temp = $_FILES["file"]["tmp_name"];
		if(move_uploaded_file($file_name_temp, $file_loc)) { echo "Článek byl úspěšně poslán."; }
		else { echo "Článek se nepodařilo poslat."; }
	}
	else 
	{ 
		$_SESSION["message"] = "Vyplňte všechna políčka.";
		header("Location: ../add_article.php");
	}
	echo $_FILES["file"]["error"];
		
?>