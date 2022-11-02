<?php
    //Session start--------
    session_start();
    //Logout--------
    if (isset($_GET["logout"])) {
        session_destroy();
        header("Location: /");
    }
    //Login and register--------
    if (!isset($_SESSION["email"])) {
        $login_span = "<a href='login.php'>PŘIHLÁŠENÍ</a>";
        $register_span = "<a href='register.php'>REGISTRACE</a>";
    }
    else {
        $login_span = $_SESSION["email"];
        $register_span = "<a href='/?logout'>ODHLÁSIT SE</a>";
        switch ($_SESSION["role"]) {
            case "autor":
                $menu_login = "<li><a href='add_article.php'>PŘIDAT ČLÁNEK</a></li>";
                break;
        }
    }
    //Messages--------
    if (isset($_SESSION["success"])) {
        $message = $_SESSION["success"];
        unset($_SESSION["success"]);
    }
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT World</title>
    <link href="casopis.css" rel="stylesheet">
    <link href="index.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#message").fadeOut(10000);
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
                <li><a href="backend/clanky.php">ČLÁNKY</a></li>
                <li><a href="">ARCHIV</a></li>
                <?= $menu_login ?>
                <li class="kontakt"><a href="">KONTAKT</a></li>
                <li class="helpdesk"><a href="">HELPDESK</a></li>
            </ul>
        </div>
        <div id="text">
            Tato aplikace je výsledkem školního projektu v kurzu Řízení SW projektů na Vysoké škole<br>
            polytechnické Jihlava. Nejedná se o stránky skutečného odborného časopisu!
        </div>
    </div>
</body>
</html>