<?php
    require("backend/common.php");
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT World</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/<?= basename(__FILE__, ".php") ?>.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?= $scripts ?>
</head>
<body>
    <div class="container">
        <div id="login_register">
            <span id="message"><?= $message ?></span>
            <span id="login"><?= $login_span ?></span>
            <span id="register"><?= $register_span ?></span>
        </div>
        <div id="heading">
            <h1>IT WORLD</h1>
        </div>
        <div id="navigation">
            <ul> 
                <li><a href="/">ÚVOD</a></li>
                <li><a href="clanky.php">ČLÁNKY</a></li>
                <li><a href="archiv.php">ARCHIV</a></li>
                <?= $menu_login ?>
                <li class="kontakt"><a href="contact.php">KONTAKT</a></li>
                <li class="helpdesk"><a href="helpdesk.php">HELPDESK</a></li>
            </ul>
        </div>
        <div class="realhelpdesk" style="border: 2px solid black;float:left">
            <div class="menu" style="background-color:aliceblue; float:left;width:33%">
                <p>Prihlaseni</p>
				<p>Zobrazení článku</p>
                <p>Přidávání článku</p>
				<p>Zobrazení recenzí</p>
				<p>Oponentní formulář</p>
				<p>Recenzování</p>
				<p>Informování autora o stavu článku</p>
				<p>Zpřístupnění recenzí</p>
				<p>Komunikace s recenzenty</p>
				<p>Schvalování drobných změn</p>
                <p>Přidávání recenzí</p>
            </div>
            <div class="content loginhelp" style="border-left:1px solid black;float:left;width:66%">
Přihlášení uživatelů
Jedná se o formulář, který slouží k přihlašování zaregistrovaných uživatelů. Obsahuje dvě textové pole: emailová adresa a heslo; a tlačítko pro přihlášení. Po odeslání formuláře se kontroluje, zda se údaje shodují se zápisy v databázi, jestliže ano, pak je uživatel úspěšně přihlášen, v opačném případě je uživatel přesměrován zpátky na úvodní stránku systému s určitou zprávou.

            </div>
			<div class="content loginhelp" style="border-left:1px solid black;float:left;width:66%;display:none">
			
            </div>
			<div class="content loginhelp" style="border-left:1px solid black;float:left;width:66%;display:none">
			
            </div>
			<div class="content loginhelp" style="border-left:1px solid black;float:left;width:66%;display:none">
			
            </div>
			<div class="content loginhelp" style="border-left:1px solid black;float:left;width:66%;display:none">
			
            </div>
			<div class="content loginhelp" style="border-left:1px solid black;float:left;width:66%;display:none">
			
            </div>
			<div class="content loginhelp" style="border-left:1px solid black;float:left;width:66%;display:none">
			
            </div>
			<div class="content loginhelp" style="border-left:1px solid black;float:left;width:66%;display:none">
			
            </div>
			<div class="content loginhelp" style="border-left:1px solid black;float:left;width:66%;display:none">
			
            </div>
			<div class="content loginhelp" style="border-left:1px solid black;float:left;width:66%;display:none">
			
            </div>
        </div>
    </div>
</body>
</html>
