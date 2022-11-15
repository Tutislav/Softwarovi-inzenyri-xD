<?php
	//Session--------
    	require("backend/common.php");
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace - IT World</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/<?= basename(__FILE__, ".php") ?>.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#message").fadeIn().fadeOut(10000);
        });
    </script>
</head>
<body>
    <div class="container">
        <div id="login_register">
            <span id="message"><?= $message ?></span>
            <div class="home"><a href="/"><i class="fa fa-home"></i></a></div>
        </div>
        <div class="registration">
		    <h2>Registrace uživatele</h2>
            <form action="backend/register.php" method="POST">
                <label for="mail" class="fa fa-envelope"></label><input type="email" placeholder="Email" id="mail" name="mail" required><br>
                <label for="password" class="fa fa-lock"></label><input type="password" placeholder="Heslo" id="password" name="password" onkeyup="password_check()" required><br>
                <label for="password_confirm" class="fa fa-lock"></label><input type="password" placeholder="Potvrzení hesla" id="password_confirm" name="password_confirm" onkeyup="password_check()" required><br>
                <input type="text" placeholder="Jméno" id="name" name="name" required><br>
                <input type="tel"  placeholder="Příjmení" id="lastname" name="lastname" required><br>
                <input type="submit" value="Zaregistrovat">
            </form>
        </div>
		<script>
			function password_check() {
				var password = document.getElementById("password");
				var password_confirm = document.getElementById("password_confirm");
				if (password.value != password_confirm.value) {
					password.style.background = "red";
					password_confirm.style.background = "red";
				} else {
					password.style.background = "#dddddd";
					password_confirm.style.background = "#dddddd";
				}
			}
		</script>
    </div>
</body>
</html>