<?php 
//action stránka pro recenze
        require("common.php");
        require("connect.php");
		$sql="INSERT INTO"

        $conn->close();
       
        if ($result) {
            $_SESSION["message"] = "Zpráva byla úspěšně odeslána.";
        }
        else {
            $_SESSION["message"] = "Zprávu nelze odeslat.";
        }

?>