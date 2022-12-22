<?php
    $role_restriction = "sefredaktor";
    require("common.php");

    $user_id = $_SESSION["user_id"];
    if (!isset($_POST["review_id"])) {
        $_SESSION["message"] = "Zprávu nelze odeslat.";
        header("Location: /monitoring.php");
        die();
    }
    
    $text = "Vaše recenze byla vrácena šéfredaktorem, prosíme o její úpravu";
    $review_id = $_POST['review_id'];
    require("connect.php");

        if(isset($_POST["Upravit"]))
        {
            $sql = "UPDATE recenze SET zpristupnena = '0' WHERE id_recenze = '$review_id'";
            $result = $conn->query($sql);
            $sql = "SELECT id_prispevku, id_recenzenta FROM recenze NATURAL JOIN ukol WHERE id_recenze='$review_id';";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $reviewer_id = $row["id_recenzenta"];
            $sql = "INSERT INTO vzkazy (id_odesilatele, id_prijemce, id_recenze, vzkaz_text) VALUES ('$user_id', '$reviewer_id', '$review_id', '$text');";
            $result = $conn->query($sql);
            }
            
            $conn->close();
    
        }
        elseif(isset($_POST["Potvrdit"]))
        {
            $sql = "UPDATE recenze SET stav = 'Schváleno' WHERE id_recenze = '$review_id'";
            $result = $conn->query($sql);
            $conn->close();
    
        }

        header("Location: /monitoring.php");
?>