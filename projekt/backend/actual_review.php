<?php 
//action stránka pro recenze
        require("common.php");
        require("connect.php");
		$id_ukolu=$_GET["id_ukolu"];
		$id_prispevku=$_GET["id_prispevku"];
		//gety pro data recenze
		$aktualnost = $_GET["aktualnost"];
		$originalita = $_GET["originalita"];
		$odborna_u = $_GET["odborna_u"];
		$jazykova_u = $_GET["jazykova_u"];
		$review = $_GET["review"];
		//*********************
		$today = date("Y-m-d H:i:s");
		$msg = "";
		$sql="UPDATE ukol SET splneno = 1, datum_splneni='".$today."' WHERE id_ukolu='".$id_ukolu."'";//update ukol na splneno = 1 dotaz funguje
		$result = $conn->query($sql);
 
        if ($result) {
            $msg = "Update byl úspěšný";
        }
        else {
            $msg = "Nepovedl se update.";
        }
		$sql="INSERT INTO recenze VALUES ('".$id_prispevku."', '".$_SESSION["user_id"]."', '".$id_ukolu."','".$aktualnost."','".$originalita."','".$odborna_u."','".$jazykova_u."',0)";//INSERT recenze
		$result = $conn->query($sql);
		 if ($result) {
            $msg = "Insert byl úspěšný";
        }
        else {
            $msg = "Nepovedl se Insert.";
        }
		$_SESSION["message"]=$msg;
		$conn->close();
?>