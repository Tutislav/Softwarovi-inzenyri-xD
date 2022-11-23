<?php
    require("backend/common.php");
    //clankyFilter--------
    if (isset($_POST["tematicke_cislo"])) {
        $tematicke_cislo = $_POST["tematicke_cislo"];
    }
    else {
        $tematicke_cislo = "vse";
    }
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Články - IT World</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/clanek.css">
    <link rel="stylesheet" href="/css/<?= basename(__FILE__, ".php") ?>.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?= $scripts ?>
    <script>
        $(document).ready(function(){
            $("#tema").change(function(){
                $("#clankyFilter form").submit();
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
                <li><a href="/">ÚVOD</a></li>
                <li><a href="clanky.php">ČLÁNKY</a></li>
                <li><a href="archiv.php">ARCHIV</a></li>
                <?= $menu_login ?>
                <li class="kontakt"><a href="">KONTAKT</a></li>
                <li class="helpdesk"><a href="">HELPDESK</a></li>
            </ul>
        </div>
	    
        <div id="clankyList">
		<div id="clankyFilter">
			<form action="" method="POST">
				<label for="tema">Téma:</label>
				<select name="tematicke_cislo" id="tema">
					<option value="vse"<?= $tematicke_cislo == "vse" ? " selected" : "" ?>>Vše</option>
					<option value="hardware"<?= $tematicke_cislo == "hardware" ? " selected" : "" ?>>Hardware</option>
					<option value="software"<?= $tematicke_cislo == "software" ? " selected" : "" ?>>Software</option>
					<option value="gaming"<?= $tematicke_cislo == "gaming" ? " selected" : "" ?>>Gaming</option>
					<option value="ai"<?= $tematicke_cislo == "ai" ? " selected" : "" ?>>Ai</option>
				</select><br>
			</form>
		</div>
		<?php		
			require("backend/connect.php");
			
			$sql = "SELECT id_prispevku, titulek FROM prispevek WHERE prispevek.stav='Schváleno'";
			
			if(isset($_POST['tematicke_cislo'])) {
				if($_POST['tematicke_cislo'] != 'vse')
					$sql = $sql . " AND prispevek.tematicke_cislo='" . $_POST['tematicke_cislo'] . "'";
			}
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {				
			// Výpis článků
				while($row = $result->fetch_assoc()) {
					echo "<a href='clanek.php?id=" .$row["id_prispevku"]."'><div class='clanekRef'><h3 class='clanekTitulek'>".$row["titulek"]. "</h3></div></a>";
				}
			} else {
				echo "0 results";
			}
		?>
        </div>
    </div>
</body>
</html>