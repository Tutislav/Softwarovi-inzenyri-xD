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
    elseif (isset($_POST["reply"])) {
        $question_id = $_POST["question_id"];
        $text = $_POST["text"];
        $sql = "UPDATE dotaz SET dotaz_odpoved='$text', odpovezeno=1 WHERE id_dotazu='$question_id';";
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