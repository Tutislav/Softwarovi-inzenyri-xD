<?php
	//Connect--------
	require("connect.php");
	
	//Variables--------
	$name = $_POST["name"];
	$last_name = $_POST["lastname"];
	$email = $_POST["mail"];
	$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
	$role = "redaktor";
	
	//Empty check--------
	if(empty($name) || empty($last_name) || $email) 
	{ 
		header("Location: ../registration.html"); 
	}
	else
	{
		//Insert--------
		$insert = "insert into uzivatel (jmeno, prijmeni, email, heslo, role) values('$name', '$last_name', '$email', '$password', '$role')";
		$result = mysqli_query($conn, $insert);
		if($result) 
		{
			header("Location: ../index.html"); 
		}
		else { die("Nepodařilo se přihlásit!"); }
	}
	
?>