<?php
	//Connect--------
	require("connect.php");

	//Variables--------
	$email = $_POST["mail"];
	$password = $_POST["password"];

	//Select--------
	$select = "select * from uzivatel";
	$result = mysqli_query($conn, $select);
	if($result)
	{
		foreach($result as $item)
		{
			if($email == $item["email"] && password_verify($password, $item["heslo"]))
			{
				echo "Uzivatel existuje!";
			}
		}
	}
?>