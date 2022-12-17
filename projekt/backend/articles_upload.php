<?php
	//Session--------
	session_start();

	//Connect database--------
	require("connect.php");

	
	$_SESSION["message"] = "Nepodařilo se zveřejnit článek.";
	header("Location: ../index.php");
?>