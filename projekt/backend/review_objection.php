<?php
    $role_restriction = "autor";
    require("common.php");

    $user_id = $_SESSION["user_id"];
    if (!isset($_POST["review_id"]) || !isset($_POST["text"])) {
        $_SESSION["message"] = "Zprávu nelze odeslat.";
        header("Location: /");
        die();
    }
    $review_id = $_POST["review_id"];
    $text = $_POST["text"];
    
    require("connect.php");
    $sql = "SELECT id_prispevku, id_zadavatele FROM recenze NATURAL JOIN ukol WHERE id_recenze='$review_id';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $article_id = $row["id_prispevku"];
        $redactor_id = $row["id_zadavatele"];

        $sql = "INSERT INTO vzkazy (id_odesilatele, id_prijemce, id_recenze, vzkaz_text) VALUES ('$user_id', '$redactor_id', '$review_id', '$text');";
        $result = $conn->query($sql);
        $conn->close();
        if ($result) {
            $_SESSION["message"] = "Zpráva byla úspěšně odeslána.";
            header("Location: /clanek.php?id=" . $article_id);
        }
        else {
            $_SESSION["message"] = "Zprávu nelze odeslat.";
            header("Location: /review_objection.php?id=" . $review_id);
        }
    }
    else {
        $_SESSION["message"] = "Recenze neexistuje.";
        header("Location: /review_objection.php?id=" . $review_id);
    }
?>