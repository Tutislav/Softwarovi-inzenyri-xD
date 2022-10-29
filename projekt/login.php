<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení - IT World</title>
    <link href="casopis.css" rel="stylesheet">
	<link href="login.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
        <div id="login_register">
            <div class="home"><a href="index.html"><i class="fa fa-home" style="font-size:30px"></i> </a></div>
        </div>
        <div class="login">
		    <h2>Přihlášení uživatele</h2>
            <form action="backend/login.php" method="POST">
                <i class="fa fa-envelope" style="font-size:24px"></i><input type="email" placeholder="Email" id="mail" name="mail"><br>
                <i class="fa fa-lock" style="font-size:24px"></i><input type="password" placeholder="Heslo" id="password" name="password"><br>
                <input type="submit" value="Přihlásit se   " id="login-submit">
            </form>
        </div>

	<?php
		session_start();
		if(isset($_SESSION["error"]))
		{
			echo $_SESSION["error"];
			unset($_SESSION["error"]);
		}
	?>
    </div>
</body>
</html>