<?php
	//Session--------
	session_start();

	//Connect database--------
	require("connect.php");
	
	//Variables--------
	$name = $_POST["name"];
	$last_name = $_POST["lastname"];
	$email = $_POST["mail"];
	$password = $_POST["password"];
	$password_confirm = $_POST["password_confirm"];
	$role = "autor";
	
	//Empty check--------
	if(empty($name) || empty($last_name) || empty($email) || empty($password) || empty($password_confirm)) 
	{ 
		$_SESSION["message"] = "Vyplňte všechna políčka.";
		header("Location: ../register.php");
	}
	else if($password != $password_confirm)
	{
		$_SESSION["message"] = "Hesla se neshodují.";
		header("Location: ../register.php");
	}
	else
	{
		$password = password_hash($password, PASSWORD_DEFAULT);

		//Insert database--------
		$insert = "insert into uzivatel (jmeno, prijmeni, email, heslo, role) values('$name', '$last_name', '$email', '$password', '$role')";
		$result = mysqli_query($conn, $insert);
		if($result) 
		{
			$_SESSION["message"] = "Registrace byla úspěšná.";
			$_SESSION["user_id"] = mysqli_insert_id($conn);
			$_SESSION["name"] = $name;
			$_SESSION["last_name"] = $last_name;
			$_SESSION["email"] = $email;
			$_SESSION["role"] = $role;
			header("Location: ../index.php");
		}
		else 
		{ 
			$_SESSION["message"] = "Uživatel se stejnou emailovou adresou je zaregistrován.";
			header("Location: ../register.php");
		}
	}
	
?>