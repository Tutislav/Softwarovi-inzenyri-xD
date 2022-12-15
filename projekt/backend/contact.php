<?php
    require("common.php");

    require("connect.php");
    if (isset($_POST["send"])) {
        $title = $_POST["title"];
        $text = $_POST["text"];
        $sql = "INSERT INTO dotaz (dotaz_titulek, dotaz_text) VALUES ('$title', '$text');";
        $result = $conn->query($sql);
        if ($result) {
            $_SESSION["message"] = "Zpráva byla odeslána.";
        }
        else {
            $_SESSION["message"] = "Zprávu nelze odeslat.";
        }
    }
    $conn->close();
    header("Location: /contact.php");
?>