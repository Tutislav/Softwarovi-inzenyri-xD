<?php
	//Connect--------
	require("connect.php");
	
	//Variables--------
	$name = $_POST["name"];
	$last_name = $_POST["lastname"];
	$email = $_POST["mail"];
	$password = password_hash($_POST["password"], password_default);
	$role = $_POST["role"];
	
	//Insert--------
	$insert = "insert into uzivatel (jmeno, prijmeni, email, heslo, role) values('$name', '$last_name', '$email', '$password', '$role')";
	$result = mysqli_query($conn, $insert);
	if(!$result) { die("Nepodařilo se přihlásit!"); }
?>