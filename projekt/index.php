<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT World</title>
    <link href="casopis.css" rel="stylesheet">
    <link href="index.css" rel="stylesheet">
</head>
<body>
	<?php
		//Session start--------
		session_start();
	?>
    <div class="container">
        <div id="login_register">
            <span id="login"><a href="login.php">PŘIHLÁŠENÍ</a></span>
            <span id="register"><a href="register.php">REGISTRACE</a></span>
        </div>
        <div id="heading">
            <h1>IT WORLD</h1>
        </div>
        <div id="navigation">
            <ul> 
                <li><a href="/">ÚVOD</a></li>
                <li><a href="backend/clanky.php">ČLÁNKY</a></li>
                <li><a href="">ARCHIV</a></li>
                <li class="kontakt"><a href="">KONTAKT</a></li>
                <li class="helpdesk"><a href="">HELPDESK</a></li>
            </ul>
        </div>
        <div id="text">
            Tato aplikace je výsledkem školního projektu v kurzu Řízení SW projektů na Vysoké škole<br>
            polytechnické Jihlava. Nejedná se o stránky skutečného odborného časopisu!
        </div>
	
	<?php
		//Session check--------
		if(isset($_SESSION["success"]))
		{
			echo $_SESSION["success"];
			unset($_SESSION["success"]);
		}	
	?>
    </div>
</body>
</html>