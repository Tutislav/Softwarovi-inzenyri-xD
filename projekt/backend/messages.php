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
    $conn->close();
    header("Location: /messages.php");
?>