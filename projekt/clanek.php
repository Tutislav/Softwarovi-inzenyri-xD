<?php
    require("backend/common.php");
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Článek</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="casopis.css" rel="stylesheet">
	<link href="clanek.css" rel="stylesheet">
	
	<script>
		$(document).ready(function(){
			$("#kontakt").appendTo("#autor");
			if (location.hash) $(location.hash).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);;
			
			$(".toggle_recenze").click(function()
			{
				$(this).parent().children(".text_recenze").slideToggle("slow");
			});
		});
	</script>
	
</head>
<body>
    <div class="container">
        <div id="login_register">
            <span id="message"><?= $message ?></span>
            <span id="login"><?= $login_span ?></span>
            <span id="register"><?= $register_span ?></span>
        </div>
        <div id="heading">
            <h1>IT WORLD</h1>
        </div>
        <div id="navigation">
                <ul> 
                    <li><a href="../">ÚVOD</a></li>
                    <li><a href="clanky.php">ČLÁNKY</a></li>
                    <li><a href="">ARCHIV</a></li>
                    <li class="kontakt"><a href="">KONTAKT</a></li>
                    <li class="helpdesk"><a href="">HELPDESK</a></li>
                </ul>
        </div>
		<?php
		require("backend/connect.php");
		$id = $_GET["id"];
		$sql = "SELECT jmeno, prijmeni, id_recenze, h_aktualnost, h_originalita, h_odborna_uroven, h_jazykova_uroven, zpristupnena, stav, recenze_text, datum_splneni FROM recenze JOIN uzivatel ON recenze.id_recenzenta=uzivatel.id_uzivatele JOIN prispevek ON recenze.id_prispevku=prispevek.id_prispevku JOIN ukol ON recenze.id_ukolu=ukol.id_ukolu WHERE recenze.id_prispevku=".$id." AND zpristupnena=1; ";
		$result2 = $conn->query($sql);
		?>
		<div id="odkaz_recenze">
			<h1>RECENZNÍ ŘÍZENÍ</h1>
			<button id="tlacitko" onclick="document.location='#recenze'">Zobraz recenze</button>
			<?php
			if ($result2->num_rows > 0) {
				$row = $result2->fetch_assoc();
			echo "Stav článku: ".$row["stav"];
			}
			?>
		</div>
        <div id="clanekText">
<?php
	function read_file_docx($filename){  
		$striped_content = '';  
		$content = '';  
		if(!$filename || !file_exists($filename)) return false;  
		$zip = zip_open($filename);  
		if (!$zip || is_numeric($zip)) return false;  
		while ($zip_entry = zip_read($zip)) {  
			if (zip_entry_open($zip, $zip_entry) == FALSE) continue;  
			if (zip_entry_name($zip_entry) != "word/document.xml") continue;  
			$content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));  
			zip_entry_close($zip_entry);  
		} 
		zip_close($zip);  
		$content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);   		
		$content = str_replace('</w:r></w:p>', "\r\n", $content);  	
		$content = str_replace('<w:br/>', "\r\n", $content);  
		$striped_content = strip_tags($content);
		$striped_content = html_entity_decode($striped_content);
		return $striped_content;  
	}  
    $sql = "SELECT id_uzivatele, soubor_cesta, datum_nahrani, stav FROM uzivatel NATURAL JOIN prispevek NATURAL JOIN soubor WHERE id_prispevku=" . $id . " ORDER BY datum_nahrani DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["stav"] != "Schváleno") check_restriction($row["id_uzivatele"], true);
        $filename = $row["soubor_cesta"];
        $content = read_file_docx($filename);
        if($content)
            print nl2br($content);
    }
?>
        </div>
		<div id="recenze">
		<?php
		//pokud je člověk autor zobraz toho
			echo "<h2>Recenze</h2>";
			$counter_recenze =1;
			if ($result2->num_rows > 0) {
				while($row = $result2->fetch_assoc()) {
				echo "<div id='recenze_" . $row["id_recenze"] . "'>";
				echo "<br>Toto je recenze cislo: ".$counter_recenze." ".$row["jmeno"]." ".$row["prijmeni"]." ".$row["datum_splneni"]."<button class='toggle_recenze'>Zobraz celou recenzi</button><br>"; //tlačítko zde je pro zobrazení textu recenze pomocí jQuery
				
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
				echo "<div class='text_recenze' style='display: none'>";
					echo $row["recenze_text"]."<br>";
					echo "<button onclick=>Oponentní formulář</button><br>";
				echo "</div>";
				echo "</div><br><hr>";
				$counter_recenze++;
				}
			}
			$conn->close();
		?>
		</div>
    </div>
</body>
</html>
