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
                    <th>Článek</th>
                    <th>Odkaz</th>
                    <th>Datum zadání</th>
                    <th>Termín splnění</th>
                </tr>
<?php
	require("backend/connect.php");
	
	$sql = "SELECT titulek, datum_zadani, termin_splneni, prispevek.id_prispevku FROM ukol JOIN prispevek ON prispevek.id_prispevku = ukol.id_prispevku JOIN uzivatel ON ukol.id_uzivatele = uzivatel.id_uzivatele WHERE uzivatel.email = '" . $_SESSION["email"] . "' AND ukol.splneno = 0";
			
	$result = $conn->query($sql);
			
	if ($result->num_rows > 0) {				
		// Výpis článků
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td class='clanekTitle'><a href='clanek.php?id=" .$row["id_prispevku"]."'>".$row["titulek"]. "</a></td>";
			echo "<td class='clanekRef'><button onclick='location.href=\"/review_form.php?id=" . $row["id_ukolu"] . "\"'>Recenzní formulář</button></td>";
           		echo "<td class='clanekDate'>".$row["datum_zadani"]."</td>";
			echo "<td class='clanekDate'>".$row["termin_splneni"]."</td>";
            		echo "</tr>";
		}
	} else {
		echo "0 results ". $recenzent . " - " . $_SESSION["email"];
	}
?>
            </table>
        </div>
    </div>
</body>
</html>
