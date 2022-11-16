<?php
    require("backend/common.php");
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Správa článků - IT World</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://itworld.vorpal.tk/css/main.css">
    <link rel="stylesheet" href="https://itworld.vorpal.tk/css/my_articles.css">
    <link rel="stylesheet" href="https://itworld.vorpal.tk/css/<?= basename(__FILE__, ".php") ?>.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#message").fadeIn().fadeOut(10000);
            $("#stav").change(function(){
                $("#clankyFilter form").submit();
            });
        });
    </script>
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
                <li class="kontakt"><a href="">KONTAKT</a></li>
                <li class="helpdesk"><a href="">HELPDESK</a></li>
            </ul>
        </div>

       <br>
       <br>

       <table border="1">
        <tr>
            <td>Název čísla</td>
            <td>Rok</td>
        </tr>
        <tr>
            <td><a href="https://www.vspj.cz/soubory/download/id/8862">Číslo 1</td>
            <td>2022</td>
        </tr>
        <tr>
            <td><a href="https://www.vspj.cz/soubory/download/id/9077">Číslo 2</td>
            <td>2022</td>
        </tr>

        
       </table>




    </div>
</body>
</html>
