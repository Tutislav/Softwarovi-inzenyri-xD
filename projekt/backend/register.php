<?php
	//Connect--------
	require("connect.php");
	
	//Variables--------
	$name = $_POST["name"];
	$last_name = $_POST["lastname"];
	$email = $_POST["mail"];
	$password = $_POST["password"];
	$password_confirm = $_POST["password-confirm"];
	$role = "redaktor";
	
echo $name;
//echo $last_name;
//echo $email
//echo $password;
//echo $password_confirm;
	//Empty check--------
	if(empty($name) || empty($last_name) || empty($email) || empty($password) || empty($password_confirm)) 
	{ 
		//header("Location: ../registration.html");
		echo "Vyplňte všechna políčka.";
	}
	else if($password != $password_confirm)
	{
		//header("Location: ../registration.html");
		echo "Hesla se neshodují.";
	}
	else
	{
		$password = password_hash($password, PASSWORD_DEFAULT);

		//Insert--------
		$insert = "insert into uzivatel (jmeno, prijmeni, email, heslo, role) values('$name', '$last_name', '$email', '$password', '$role')";
		$result = mysqli_query($conn, $insert);
		if($result) 
		{
			//header("Location: ../index.html");
			echo "Přihlášení bylo úspěšné.";
		}
		else { die("Nepodařilo se přihlásit!"); }
	}
	
?>