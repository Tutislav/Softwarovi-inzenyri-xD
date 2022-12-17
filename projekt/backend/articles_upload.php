<?php
	//Session--------
	session_start();

	//Connect database--------
	require("connect.php");

	if(!empty($_POST["article_checked"]))
	{
		$articles_array = array();
		$array_index = 0;
		foreach($_POST["article_checked"] as $article_id)
		{
			$select = "select soubor_cesta from soubor where id_prispevku=$article_id";
			$result = mysqli_query($conn, $select);
			$articles_array[array_index] = $result["soubor_cesta"];
			array_index++;
		}
		$_SESSION["message"] = "Podařilo se zveřejnit článek.";
		header("Location: ../index.php");
		$fileArray= array("name1.pdf","name2.pdf","name3.pdf","name4.pdf");

		$datadir = "save_path/";
		$outputName = $datadir."merged.pdf";

		$cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=$outputName ";
		//Add each pdf file to the end of the command
		foreach($fileArray as $file) { $cmd .= $file." "; }
		$result = shell_exec($cmd);
	}
	else
	{
		$_SESSION["message"] = "Nepodařilo se zveřejnit článek.";
		header("Location: ../index.php");
	}
	
?>