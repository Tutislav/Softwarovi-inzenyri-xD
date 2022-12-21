<?php
    require("common.php");

    $user_id = $_SESSION["user_id"];

    require("connect.php");
    if (isset($_POST["add"])) {
        $recipient_id = $_POST["recipient_id"];
        $text = $_POST["text"];
        $deadline = $_POST["deadline"];
        $deadline = date("Y-m-d H:i:s", strtotime($deadline));
        if (!empty($deadline)) {
            $sql = "INSERT INTO ukol (id_uzivatele, id_zadavatele, termin_splneni, ukol_text) VALUES ('$recipient_id', '$user_id', '$deadline', '$text');";
            $result = $conn->query($sql);
            if ($result) {
                $_SESSION["message"] = "Úkol byl přidán.";
            }
            else {
                $_SESSION["message"] = "Úkol nelze přidat.";
            }
            header("Location: " . $_POST["url"]);
        }
    }
    $conn->close();
?>