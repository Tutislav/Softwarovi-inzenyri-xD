<?php
	session_start();

	//Connect--------
	require("connect.php");
	
	//Variables--------
	$name = $_POST["name"];
	$last_name = $_POST["lastname"];
	$email = $_POST["mail"];
	$password = $_POST["password"];
	$password_confirm = $_POST["password_confirm"];
	$role = "redaktor";
	
	//Empty check--------
	if(empty($name) || empty($last_name) || empty($email) || empty($password) || empty($password_confirm)) 
	{ 
		$_SESSION["error"] = "Vyplňte všechna políčka.";
		header("Location: ../register.php");
	}
	else if($password != $password_confirm)
	{
		$_SESSION["error"] = "Hesla se neshodují.";
		header("Location: ../register.php");
	}
	else
	{
		$password = password_hash($password, PASSWORD_DEFAULT);

		//Insert--------
		$insert = "insert into uzivatel (jmeno, prijmeni, email, heslo, role) values('$name', '$last_name', '$email', '$password', '$role')";
		$result = mysqli_query($conn, $insert);
		if($result) 
		{
			$_SESSION["success"] = "Registrace byla úspěšná.";
			header("Location: ../index.php");
		}
		else 
		{ 
			$_SESSION["error"] = "Uživatel se stejnou emailovou adresou je zaregistrován.";
			header("Location: ../register.php");
		}
	}
	
?>