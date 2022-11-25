<?php
    require("common.php");

    require("connect.php");
    if (isset($_POST["change_user_id"])) {
        $change_user_id = $_POST["change_user_id"];
        
        $sql = "SELECT * FROM uzivatel WHERE id_uzivatele='$change_user_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION["user_id"] = $row["id_uzivatele"];
            $_SESSION["name"] = $row["jmeno"];
            $_SESSION["last_name"] = $row["prijmeni"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["role"] = $row["role"];
            header("Location: " . $_POST["page"]);
        }
    }
    elseif (isset($_POST["edit"])) {
        if(isset($_POST["user_id"])){
            $user_id = $_POST["user_id"];
            $name = $_POST["name"];
            $last_name = $_POST["last_name"];
            $email = $_POST["email"];
            $role = $_POST["role"];

            $sql = "UPDATE uzivatel SET jmeno='$name', prijmeni='$last_name', email='$email', role='$role' WHERE id_uzivatele='$user_id';";
            $result = $conn->query($sql);
            if ($result) {
                $_SESSION["message"] = "Uživatel byl změněn.";
            }
            else {
                $_SESSION["message"] = "Uživatele nelze upravit.";
            }
        } elseif(isset($_POST["aticle_id"])){
            $aticle_id = $_POST["aticle_id"];
            $title = $_POST["title"];
            $theme = $_POST["theme"];
            $state = $_POST["state"];

            $sql = "UPDATE prispevek SET titulek='$title', tematicke_cislo='$theme', stav='$state' WHERE id_prispevku='$article_id';";
            $result = $conn->query($sql);
            if ($result) {
                $_SESSION["message"] = "Článek byl změněn.";
            }
            else {
                $_SESSION["message"] = "Článek nelze upravit.";
            }    
        }
        header("Location: /administration.php");
    }
    elseif (isset($_POST["delete"])) {
        if(isset($_POST["user_id"])){
            $user_id = $_POST["user_id"];

            $sql = "DELETE FROM uzivatel WHERE id_uzivatele='$user_id';";
            $result = $conn->query($sql);
            if ($result) {
                $_SESSION["message"] = "Uživatel byl smazán.";
            }
            else {
                $_SESSION["message"] = "Uživatele nelze smazat.";
            }   
        } else if(isset($_POST["article_id"])) {
            $article_id = $_POST["article_id"];

            $sql = "DELETE FROM prispevek WHERE id_prispevku='$article_id';";
            $result = $conn->query($sql);
            if ($result) {
                $_SESSION["message"] = "Článek byl smazán.";
            }
            else {
                $_SESSION["message"] = "Článek nelze smazat.";
            }  
        }
        header("Location: /administration.php");
    }
    else {
        $_SESSION["message"] = "Chyba.";
        header("Location: /administration.php");
    }
    $conn->close();
?>
