<?php 
        
        $redactor_id = $_SESSION["user_id"];
        $sql = "INSERT INTO vzkazy (id_odesilatele, id_prijemce, vzkaz_text) VALUES ('$redactor_id', '$user_id', '$_GET[text]');";
        $result = $conn->query($sql);
        $conn->close();
        if ($result) {
            $_SESSION["message"] = "Zpráva byla úspěšně odeslána.";
            header("Location: /articles_management.php" );
        }
        else {
            $_SESSION["message"] = "Zprávu nelze odeslat.";
            header("Location: /articles_management.php" );
        }

?>