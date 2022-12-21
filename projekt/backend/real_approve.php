<?php
	require("connect.php");
	//funguje
	$sql="";
	if (strcmp($_POST["approve_submit"],"Schválit změnu")==0) {
		$sql = "UPDATE prispevek SET zobrazeny_soubor=".$_POST["souborupraveny_id"]."WHERE id_prispevku='$article_id';";
		
	} else if (strcmp($_POST["disapprove_submit"],"Zamítnout změnu")==0) {
		$sql = "UPDATE prispevek SET zobrazeny_soubor=".$_POST["soubor_id"]."WHERE id_prispevku='$article_id';";
	}
	echo $sql;
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
