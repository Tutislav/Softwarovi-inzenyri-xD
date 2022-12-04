<?php
    require("common.php");

    $user_id = $_SESSION["user_id"];
    if (!isset($_POST["message_id"])) {
        $_SESSION["message"] = "Chyba.";
        header("Location: /messages.php");
        die();
    }
    $message_id = $_POST["message_id"];

    require("connect.php");
    if (isset($_POST["read"])) {
        $sql = "SELECT precteno FROM vzkazy WHERE id_vzkazu='$message_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $read = intval(!boolval($row["precteno"]));
            $sql = "UPDATE vzkazy SET precteno='$read' WHERE id_vzkazu='$message_id'";
            $result = $conn->query($sql);
        }
        else {
            $_SESSION["message"] = "Zpráva neexistuje.";
        }
    }
    elseif (isset($_POST["delete"])) {
        $sql = "DELETE FROM vzkazy WHERE id_vzkazu='$message_id'";
        $result = $conn->query($sql);
        if ($result) {
            $_SESSION["message"] = "Zpráva byla smazána.";
        }
        else {
            $_SESSION["message"] = "Zprávu nelze smazat.";
        }
    }
    elseif (isset($_POST["send"])) {
        $recipient_id = $_POST["recipient_id"];
        $text = $_POST["text"];
        $sql = "INSERT INTO vzkazy (id_odesilatele, id_prijemce, id_recenze, vzkaz_text) VALUES ('$user_id', '$recipient_id', 'NULL', '$text');";
        $result = $conn->query($sql);
        if ($result) {
            $_SESSION["message"] = "Zpráva byla odeslána.";
        }
        else {
            $_SESSION["message"] = "Zprávu nelze odeslat.";
        }
    }
    $conn->close();
    header("Location: /messages.php");
?>