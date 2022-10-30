<?php
	//Session--------
	session_start();

	//Connect--------
	require("connect.php");

	//Variables--------
	$email = $_POST["mail"];
	$password = $_POST["password"];
	$user_exists = false;

	//Select--------
	$select = "select * from uzivatel";
	$result = mysqli_query($conn, $select);
	if($result)
	{
		foreach($result as $item)
		{
			if($email == $item["email"] && password_verify($password, $item["heslo"]))
			{
				$user_exists = true;
				$_SESSION["success"] = "Přihlášení bylo úspěšné.";
				header("Location: ../index.php");
				break;
			}
		}
		if(!$user_exists)
		{
			$_SESSION["error"] = "Nepodařilo se přihlásit.";
			header("Location: ../login.php");		
		}
	}
?>