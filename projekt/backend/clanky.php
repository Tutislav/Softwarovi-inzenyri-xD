<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Články</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="../casopis.css" rel="stylesheet">
	<link href="clanek.css" rel="stylesheet">	
	
</head>
<body>
    <div class="container">
        <div id="login_register">
            <span id="login"><a href="../login.html">PŘIHLÁŠENÍ</a></span>
            <span id="register"><a href="../registration.html">REGISTRACE</a></span>
        </div>
        <div id="heading">
            <h1>IT WORLD</h1>
        </div>
        <div id="navigation">
                <ul> 
                    <li><a href="../">ŮVOD</a></li>
                    <li><a href="">ČLÁNKY</a></li>
                    <li><a href="">ARCHIV</a></li>
                    <li class="kontakt"><a href="">KONTAKT</a></li>
                    <li class="helpdesk"><a href="">HELPDESK</a></li>
                </ul>
        </div>
	    
        <div id="clankyList">
		<div id="clankyFilter">
			<label for="tema">Téma:</label>
			<select name="tematicke_cislo" id="tema">
				<option value="vse">Vše</option>
 				<option value="hardware">Hardware</option>
  				<option value="software">Software</option>
  				<option value="gaming">Gaming</option>
  				<option value="ai">Ai</option>
			</select>
		</div>
		<?php		
			require("connect.php");
			
			$sql = "SELECT soubor_cesta FROM soubor";
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {				
			// Výpis článků
				while($row = $result->fetch_assoc()) {
					echo "<div class='clanekRef'><a href='clanek.php?soubor=" .$row["soubor_cesta"]."'>" . $row["soubor_cesta"] . "</a></div>";
				}
			} else {
				echo "0 results";
			}
		?>
        </div>
    </div>
</body>
</html>
