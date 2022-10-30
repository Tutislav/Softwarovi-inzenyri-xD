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
	<?php
		//Session start--------
		session_start();
	?>
    <div class="container">
        <div id="login_register">
            <div class="home"><a href="/"><i class="fa fa-home"></i></a></div>
        </div>
        <div class="login">
		    <h2>Přihlášení uživatele</h2>
            <form action="backend/login.php" method="POST">
                <label for="mail" class="fa fa-envelope"></label><input type="email" placeholder="Email" id="mail" name="mail"><br>
                <label for="password" class="fa fa-lock"></label><input type="password" placeholder="Heslo" id="password" name="password"><br>
                <input type="submit" value="Přihlásit se">
            </form>
        </div>

	<?php
		//Session check--------
		if(isset($_SESSION["error"]))
		{
			echo $_SESSION["error"];
			unset($_SESSION["error"]);
		}
	?>
    </div>
</body>
</html>