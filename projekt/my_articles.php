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
                <li class="kontakt"><a href="contact.php">KONTAKT</a></li>
                <li class="helpdesk"><a href="helpdesk.php">HELPDESK</a></li>
            </ul>
        </div>
        <div id="myArticles">
            <table class="border_sides">
                <tr>
                    <th>Titulek</th>
                    <th>Stav</th>
                    <th>Akce</th>
                </tr>
<?php
	require("backend/connect.php");
	$sql = "SELECT id_prispevku, titulek, stav FROM prispevek NATURAL JOIN uzivatel WHERE uzivatel.email='" . $_SESSION["email"] . "'";
			
	$result = $conn->query($sql);
			
	if ($result->num_rows > 0) {				
		// Výpis článků
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td class='clanekRef'><a href='clanek.php?id=" .$row["id_prispevku"]."'>".$row["titulek"]. "</a></td>";
			echo "<td class='clanekStav'>" . $row["stav"] . "</td>";
            if ($row["stav"] == "Čeká na doplnění")
            {
                $actions = "<button onclick='location.href=\"/add_article.php?id=" . $row["id_prispevku"] . "\"'>Upravit</button>";
            }
            else {
                $actions = "<button onclick='location.href=\"/my_article_reviews.php?id=" . $row["id_prispevku"] . "\"'>Recenze</button>";
            }
            echo "<td class='clanekRecenze'>" . $actions . "</td>";
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