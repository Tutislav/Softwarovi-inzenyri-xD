<?php
	//Session--------
	session_start();

	//Connect database--------
	require("connect.php");

	if(!empty($_POST["article_checked"]))
	{
		foreach($_POST["article_checked"] as $article_checked)
		{
			
		}
		$_SESSION["message"] = "Podařilo se zveřejnit článek.";
		header("Location: ../index.php");
	}
	else
	{
		$_SESSION["message"] = "Nepodařilo se zveřejnit článek.";
		header("Location: ../index.php");
	}
	
?>