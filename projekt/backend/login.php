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
				$_SESSION["message"] = "Přihlášení bylo úspěšné.";
				$_SESSION["id"] = $item["id_uzivatele"];
				$_SESSION["name"] = $item["jmeno"];
				$_SESSION["last_name"] = $item["prijmeni"];
				$_SESSION["email"] = $item["email"];
				$_SESSION["role"] = $item["role"];
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
?>