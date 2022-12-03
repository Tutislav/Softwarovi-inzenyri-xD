<?php 
        require("common.php");
        require("connect.php");
        $redactor_id = $_SESSION["user_id"];
        $user_id = $_POST['user_id'];
        $text = $_POST['text'];
        $stav = $_POST['stav'];
        $id = $_POST['id'];
        $sql = "INSERT INTO vzkazy (id_odesilatele, id_prijemce, vzkaz_text) VALUES ('$redactor_id', '$user_id', '$text');";
        $result = $conn->query($sql);
       
        if ($result) {
            $_SESSION["message"] = "Zpráva byla úspěšně odeslána.";
            header("Location: /articles_management.php" );
        }
        else {
            $_SESSION["message"] = "Zprávu nelze odeslat.";
            header("Location: /articles_management.php" );
        }

        $sql = "UPDATE prispevek SET stav='$stav' WHERE id_prispevku = '$id'";
        $result = $conn->query($sql);

        $reviewer1 = $_POST["reviewer1"];
        $reviewer2 = $_POST["reviewer2"];
        $deadline = $_POST["deadline"];
        $task_text = "Zrecenzujte prosím tento článek: <a href=\"/clanek.php?id='$id'\">Článek</a>";
        if (!empty($deadline)) {
            $sql = "INSERT INTO ukol (id_uzivatele, id_zadavatele, id_prispevku, termin_splneni, ukol_text) VALUES ('$reviewer1', '$redactor_id', '$id', '$deadline', '$task_text');";
            $result = $conn->query($sql);
            $sql = "INSERT INTO ukol (id_uzivatele, id_zadavatele, id_prispevku, termin_splneni, ukol_text) VALUES ('$reviewer2', '$redactor_id', '$id', '$deadline', '$task_text');";
            $result = $conn->query($sql);
        }
        $conn->close();

?>