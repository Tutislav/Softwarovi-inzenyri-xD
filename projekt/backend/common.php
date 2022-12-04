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
	    case "sefredaktor":
                $menu_login = "<li><a href='/articles_upload.php'>ZVEŘEJŃOVÁNÍ ČLÁNKŮ</a></li>";
            break;
            case "recenzent":
                $menu_login = "<li><a href='/articles_to_review.php'>ČLÁNKY K RECENZI</a></li>";
                break;
            case "admin":
                $menu_login = "<li><a href='/administration.php'>ADMINISTRACE</a></li>";
                $_SESSION["admin_mode"] = true;
                break;
        }
        require("connect.php");
        if (isset($_SESSION["admin_mode"]) && $_SESSION["admin_mode"]) {
            $scripts .= '$(document).ready(function(){$("#change_user_id").change(function(){$("#login form").submit();});});';
            $change_users = "";
            $sql = "SELECT * FROM uzivatel";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $selected = $row["id_uzivatele"] == $_SESSION["user_id"] ? " selected" : "";
                    $change_users .= "<option value='" . $row["id_uzivatele"] . "'" . $selected . ">" . $row["email"] . "</option>";
                }
            }
            $login_span = "<form action='backend/administration.php' method='post'><select name='change_user_id' id='change_user_id'>" . $change_users . "</select><input type='hidden' name='page' value='" . $_SERVER["REQUEST_URI"] . "'></form>";
        }
        if ($restricted) {
            $_SESSION["message"] = "Na tuto stránku nemáte přístup.";
            header("Location: /");
            die();
        }
        $unread_messages = "";
        $sql = "SELECT COUNT(*) FROM vzkazy WHERE id_prijemce='$user_id' AND precteno=0;";
        $result = $conn->query($sql);
        $conn->close();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $unread_messages_count = $row["COUNT(*)"];
            $unread_messages = "[" . $unread_messages_count . "]";
        }
        $menu_login .= "<li><a href='/messages.php'>VZKAZY " . $unread_messages . "</a></li>";
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
    //Get array of roles
    function get_roles() {
        require("connect.php");
        $sql = "DESCRIBE uzivatel role;";
        $result = $conn->query($sql);
        $conn->close();
        $row = $result->fetch_assoc();
        $roles = explode("'", $row["Type"]);
        $roles_array = [];
        for ($i=1; $i<count($roles); $i += 2) {
            array_push($roles_array, $roles[$i]);
        }
        return $roles_array;
    }

    function get_themes() {
        require("connect.php");
        $sql = "DESCRIBE prispevek tematicke_cislo;";
        $result = $conn->query($sql);
        $conn->close();
        $row = $result->fetch_assoc();
        $themes = explode("'", $row["Type"]);
        $themes_array = [];
        for ($i=1; $i<count($themes); $i += 2) {
            array_push($themes_array, $themes[$i]);
        }
        return $themes_array;
    }
?>
