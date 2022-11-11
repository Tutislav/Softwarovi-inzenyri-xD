<?php
    //Session start--------
    session_start();
    //Logout--------
    if (isset($_GET["logout"])) {
        session_destroy();
        header("Location: " . $_GET["logout"]);
    }
    //Roles, login and register--------
    if (!isset($_SESSION["email"])) {
        $login_span = "<a href='/login.php'>PŘIHLÁŠENÍ</a>";
        $register_span = "<a href='/register.php'>REGISTRACE</a>";
        if (isset($role_restriction)) {
            $_SESSION["message"] = "Nejprve se musíte přihlásit.";
            header("Location: /login.php");
        }
    }
    else {
        $login_span = $_SESSION["email"];
        $register_span = "<a href='?logout=" . $_SERVER["REQUEST_URI"] . "'>ODHLÁSIT SE</a>";
        switch ($_SESSION["role"]) {
            case "autor":
                $menu_login = "<li><a href='/add_article.php'>PŘIDAT ČLÁNEK</a></li><li><a href='/my_articles.php'>MOJE ČLÁNKY</a></li>";
                break;
            case "redaktor":
                $menu_login = "<li><a href='/articles_management.php'>SPRÁVA ČLÁNKŮ</a></li>";
                break;
        }
        if (isset($role_restriction) && $role_restriction != $_SESSION["role"]) {
            $_SESSION["message"] = "Na tuto stránku nemáte přístup.";
            header("Location: /");
        }
    }
    //Messages--------
    if (isset($_SESSION["message"])) {
        $message = $_SESSION["message"];
        unset($_SESSION["message"]);
    }
    //User restriction
    function check_restriction($row) {
        if ($row["stav"] != "Schváleno" && $row["id_uzivatele"] != $_SESSION["user_id"]) {
            $_SESSION["message"] = "Na tuto stránku nemáte přístup.";
            header("Location: /");
        }
    }
?>
