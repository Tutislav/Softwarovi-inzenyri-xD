<?php
    require("backend/common.php");
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje články - IT World</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/<?= basename(__FILE__, ".php") ?>.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?= $scripts ?>
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
        <div id="myArticles">
            <table class="border_sides">
                <tr>
                    <th>Titulek</th>
                    <th>Odkaz</th>
                    <th>Datum zadání</th>
                    <th>Datum splnění</th>
                </tr>
<?php
	require("backend/connect.php");
	$sqlRecenzent="SELECT id_uzivatele FROM uzivatel WHERE email =".$_SESSION["email"]; 
		$result = $conn->query($sqlRecenzent);
		if ($result->num_rows > 0) {
			$row=$result->fetch_assoc();
			$recenzent=$row["id_uzivatele"];
		}
	  
	$sql = "SELECT titulek, datum_zadani, datum_splneni FROM ukol JOIN prispevek ON prispevek.id_prispevku = ukol.id_prispevku WHERE ukol.id_uzivatele = " . $recenzent;
			
	$result = $conn->query($sql);
			
	if ($result->num_rows > 0) {				
		// Výpis článků
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td class='clanekTitle'>" .$row["titulek"]. "</td>";
			echo "<td class='clanekRef'>Odkaz</td>";
           		echo "<td class='clanekDate'>".$row["datum_zadani"]."</td>";
			echo "<td class='clanekDate'>".$row["datum_splneni"]."</td>";
            		echo "</tr>";
		}
	} else {
		echo "0 results";
	}
?>
            </table>
        </div>
    </div>
</body>
</html>
