<?php
	//Session start--------
	session_start();
    //Logout--------
    if (isset($_GET["logout"])) {
        session_destroy();
        header("Location: /");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje článeky</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="casopis.css" rel="stylesheet">
	<link href="css/my_articles.css" rel="stylesheet">
	
</head>
<body>
    <div class="container">
        <div id="login_register">
            <span id="login">
                <?php
                    if (!isset($_SESSION["email"])) echo("<a href='login.php'>PŘIHLÁŠENÍ</a>");
                    else echo($_SESSION["email"]);
                ?>
            </span>
            <span id="register">
                <?php
                    if (!isset($_SESSION["email"])) echo("<a href='register.php'>REGISTRACE</a>");
                    else echo("<a href='/?logout'>ODHLÁSIT SE</a>")
                ?>
            </span>
        </div>
        <div id="heading">
            <h1>IT WORLD</h1>
        </div>
        <div id="navigation">
                <ul> 
                    <li><a href="/">ÚVOD</a></li>
                    <li><a href="backend/clanky.php">ČLÁNKY</a></li>
                    <li><a href="">ARCHIV</a></li>
                    <li class="kontakt"><a href="">KONTAKT</a></li>
                    <li class="helpdesk"><a href="">HELPDESK</a></li>
                </ul>
        </div>

        <div id="clanekText">
<?php
	require("connect.php");
			
	$sql = "SELECT id_prispevku, titulek, stav FROM prispevek NATURAL JOIN uzivatel";
			
	$result = $conn->query($sql);
			
	if ($result->num_rows > 0) {				
			// Výpis článků
		while($row = $result->fetch_assoc()) {
			echo "<a href='backend/clanek.php?id=" .$row["id_prispevku"]."'><div class='clanekRef'>".$row["titulek"]. "</div></a>";
		}
	} else {
		echo "0 results";
	}
?>
        </div>
    </div>
</body>
</html>
