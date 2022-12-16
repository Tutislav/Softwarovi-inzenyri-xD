<?php
	//Session--------
	session_start();

	//Connect database--------
	require("connect.php");

	//Variables--------
	$email = $_POST["mail"];
	$password = $_POST["password"];
	$user_exists = false;

	//Empty check--------
	if(!empty($email) && !empty($password))
	{
		//Select database--------
		$select = "select * from uzivatel";
		$result = mysqli_query($conn, $select);
		if($result)
		{
			foreach($result as $item)
			{
				if($email == $item["email"] && password_verify($password, $item["heslo"]))
				{
					$user_exists = true;
					$_SESSION["message"] = "Přihlášení bylo úspěšné.";
					$_SESSION["user_id"] = $item["id_uzivatele"];
					$_SESSION["name"] = $item["jmeno"];
					$_SESSION["last_name"] = $item["prijmeni"];
					$_SESSION["email"] = $item["email"];
					$_SESSION["role"] = $item["role"];
					$_SESSION["justlogged"] = true;
					header("Location: ../index.php");
					break;
				}
			}
			if(!$user_exists)
			{
				$_SESSION["message"] = "Nepodařilo se přihlásit.";
				header("Location: ../login.php");		
			}
		}
	}
	else 
	{
		$_SESSION["message"] = "Vyplňte všechna políčka.";
		header("Location: ../login.php");
	}
	
?>