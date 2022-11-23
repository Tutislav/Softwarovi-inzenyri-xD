<?php
    //Session start--------
    session_start();
    //Logout--------
    if (isset($_GET["logout"])) {
        session_destroy();
        header("Location: " . $_GET["logout"]);
        die();
    }
    //Scripts
    $scripts = "<script>";
    $scripts .= '$(document).ready(function(){$("#message").fadeIn().fadeOut(10000);});';
    //Roles, login and register--------
    if (!isset($_SESSION["email"])) {
        $login_span = "<a href='/login.php'>PŘIHLÁŠENÍ</a>";
        $register_span = "<a href='/register.php'>REGISTRACE</a>";
        if (isset($role_restriction)) {
            $_SESSION["message"] = "Nejprve se musíte přihlásit.";
            header("Location: /login.php");
            die();
        }
    }
    else {
        $role = $_SESSION["role"];
        $restricted = false;
        $login_span = $_SESSION["email"];
        $register_span = "<a href='?logout=" . $_SERVER["REQUEST_URI"] . "'>ODHLÁSIT SE</a>";
        switch ($role) {
            case "autor":
                $restricted = isset($role_restriction) && $role_restriction != $role;
                $menu_login = "<li><a href='/add_article.php'>PŘIDAT ČLÁNEK</a></li><li><a href='/my_articles.php'>MOJE ČLÁNKY</a></li>";
                break;
            case "redaktor":
                $menu_login = "<li><a href='/articles_management.php'>SPRÁVA ČLÁNKŮ</a></li>";
                break;
            case "admin":
                $_SESSION["admin_mode"] = true;
                break;
        }
        if (isset($_SESSION["admin_mode"]) && $_SESSION["admin_mode"]) {
            $scripts .= '$(document).ready(function(){$("#change_user_id").change(function(){$("#login form").submit();});});';
            $change_users = "";
            require("connect.php");
            $sql = "SELECT * FROM uzivatel";
            $result = $conn->query($sql);
            $conn->close();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $change_users .= "<option value='" . $row["id_uzivatele"] . "'>" . $row["email"] . "</option>";
                }
            }
            $login_span = "<form action='backend/administration.php' method='post'><select name='change_user_id' id='change_user_id'>" . $change_users . "</select></form> " . $login_span;
        }
        if ($restricted) {
            $_SESSION["message"] = "Na tuto stránku nemáte přístup.";
            header("Location: /");
            die();
        }
        $menu_login .= "<li><a href='/messages.php'>VZKAZY</a></li>";
    }
    $scripts .= "</script>";
    //Messages--------
    if (isset($_SESSION["message"])) {
        $message = $_SESSION["message"];
        unset($_SESSION["message"]);
    }
    //User restriction
    function check_restriction(int $user_id, bool $redactor_access = false) {
        $role = $_SESSION["role"];
        if (!$redactor_access && ($role == "redaktor" || $role == "sefredaktor" || $role == "admin")) {
            if ($user_id != $_SESSION["user_id"]) {
                $_SESSION["message"] = "Na tuto stránku nemáte přístup.";
                header("Location: /");
                die();
            }
        }
    }
?>
