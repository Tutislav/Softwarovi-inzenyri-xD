<?php
	require("backend/connect.php");
	//funguje
	if (strcmp($_POST["approve_submit"],"Schválit změnu")==0) {
		$stav=1;
		echo $stav;
		
	} else if (strcmp($_POST["disapprove_submit"],"Zamítnout změnu")==0) {
		$stav=2;
		echo $stav;
	}
	//****
        /*$sql = "UPDATE prispevek SET zobrazeny_soubor='$skutecny_soubor' WHERE id_prispevku='$article_id';";
        $result = $conn->query($sql);
        $conn->close();
	if ($result) {
            $_SESSION["message"] = "úspěch";
            header("Location: /articles_management.php");
        }
        else {
            $_SESSION["message"] = "neuspěch";
            header("Location: /articles_management.php");
        }*/
?>
