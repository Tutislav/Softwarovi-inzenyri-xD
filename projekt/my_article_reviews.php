<?php
	//Session--------
    	require("backend/common.php");
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení - IT World</title>
    <link href="casopis.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>
    <div class="container">
        <div id="login_register">
            <span id="message"><?= $message ?></span>
            <div class="home"><a href="/"><i class="fa fa-home"></i></a></div>
        </div>
	    <div id="recenze">
		<?php
		//pokud je člověk autor zobraz toho
			echo "<h2>Recenze</h2>";
			require("backend/connect.php");
			$sql = "SELECT jmeno, prijmeni, id_recenze, h_aktualnost, h_originalita, h_odborna_uroven, h_jazykova_uroven, zpristupnena, stav, recenze_text, datum_splneni FROM recenze JOIN uzivatel ON recenze.id_recenzenta=uzivatel.id_uzivatele JOIN prispevek ON recenze.id_prispevku=prispevek.id_prispevku JOIN ukol ON recenze.id_ukolu=ukol.id_ukolu WHERE recenze.id_prispevku=".$_GET['id']." AND zpristupnena=1; ";
			$result = $conn->query($sql);
			$counter_recenze =1;
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
				echo "<div id='recenze_" . $row["id_recenze"] . "'>";
				$ReviewDate = DateTime::createFromFormat('Y-d-m h:i:s', $row["datum_splneni"]);
				$ReviewDate = $ReviewDate->format("d.m.Y");
				echo "Recenze ".$counter_recenze."	Recenzent: ".$row["jmeno"]." ".$row["prijmeni"]." 	" .$reviewDate. "<br>";
				
				//přidat jednu classu pro divy a nastylovat tam!!!!!!!!!!!!!!!
				//aktualnost
				echo "<div class='radky_recenzi' style='display: flex'>";
					echo "<div class='recenze_typ' style='font-size:21.5px; width:200px'>";
						echo "Aktualnost: ";
					echo "</div>";
					echo "<div class='hvezdicky' style='padding: 0 10px'>";
				for($i=0; $i<5;$i++){
					if($row["h_aktualnost"]>$i){
						echo "<span class='fa fa-star'></span>" ;
					}
					else echo "<span class='fa fa-star-o'></span>";
					}
					echo "</div>";
				echo "</div>";
				//originalita
				echo "<div class='radky_recenzi' style='display: flex'>";
					echo "<div class='recenze_typ' style='font-size:21.5px; width:200px'>";
						echo "Originalita: ";
					echo "</div>";
					echo "<div class='hvezdicky' style='padding: 0 10px'>";
				for($i=0; $i<5;$i++){
					if($row["h_originalita"]>$i){
						echo "<span class='fa fa-star'></span>" ;
					}
					else echo "<span class='fa fa-star-o'></span>";
					}
					echo "</div>";
				echo "</div>";
				//odborna uroven
				echo "<div class='radky_recenzi' style='display: flex'>";
					echo "<div class='recenze_typ' style='font-size:21.5px; width:200px'>";
						echo "Odborna úroveň: ";
					echo "</div>";
					echo "<div class='hvezdicky' style='padding: 0 10px'>";
					for($i=0; $i<5;$i++){
						if($row["h_odborna_uroven"]>$i){
							echo "<span class='fa fa-star'></span>" ;
						}
						else echo "<span class='fa fa-star-o'></span>";
					}
					echo "</div>";
				echo "</div>";
				//jazykova uroven
				echo "<div class='radky_recenzi' style='display: flex'>";
					echo "<div class='recenze_typ' style='font-size:21.5px; width:200px'>";
						echo "Jazyková úroveň: ";
					echo "</div>";
					echo "<div class='hvezdicky' style='padding: 0 10px'>";
					for($i=0; $i<5;$i++){
						if($row["h_jazykova_uroven"]>$i){
							echo "<span class='fa fa-star'></span>" ;
						}
						else echo "<span class='fa fa-star-o'></span>";
						}
					echo "</div>";
				echo "</div>";
				echo "<div class='recenzeText'><p>" . $row["recenze_text"] . "</p></div>";
				echo "<div class='reviews'><a href='review_objection.php?id=" . $row["id_recenze"] . "'>Námitky</a></div>";
				echo "</div><br><br>";
				$counter_recenze++;
				}
			}
			$conn->close();
		?>
		</div>
        
           
    </div>
</body>
</html>
