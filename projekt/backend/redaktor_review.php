<?php 
        require("common.php");
        require("connect.php");
        $redactor_id = $_SESSION["user_id"];
        $user_id = $_POST['user_id'];
        $text = $_POST['text'];
        $sql = "INSERT INTO vzkazy (id_odesilatele, id_prijemce, vzkaz_text) VALUES ('$redactor_id', '$user_id', '$text');";
        echo $sql;
        $result = $conn->query($sql);
        $conn->close();
        /*if ($result) {
            $_SESSION["message"] = "Zpráva byla úspěšně odeslána.";
            header("Location: /articles_management.php" );
        }
        else {
            $_SESSION["message"] = "Zprávu nelze odeslat.";
            header("Location: /articles_management.php" );
        }*/

?>