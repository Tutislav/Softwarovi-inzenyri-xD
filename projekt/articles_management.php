<?php
	//Session start--------
	session_start();
    //Logout--------
    if (isset($_GET["logout"])) {
        session_destroy();
        header("Location: /");
    }
    if (isset($_POST["stav_clanku"])) {
        $stav_clanku = $_POST["stav_clanku"];
    }
    else {
        $stav_clanku = "Vše";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Správa článků</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="casopis.css" rel="stylesheet">
    <link href="css/my_articles.css" rel="stylesheet">
	
    <script>
 	$(document).ready(function(){
            $("#stav").change(function(){
                $("#clankyFilter form").submit();
            });
        });
    </script>
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
                    <li><a href="clanky.php">ČLÁNKY</a></li>
                    <li><a href="">ARCHIV</a></li>
		                <?= $menu_login ?>
                    <li class="kontakt"><a href="">KONTAKT</a></li>
                    <li class="helpdesk"><a href="">HELPDESK</a></li>
                </ul>
        </div>
	    
	<div id="clankyFilter">
		<form action="" method="POST">
			<label for="stav">Stav:</label>
			<select name="stav_clanku" id="stav">
				<option value="Vše"<?= $stav_clanku == "Vše" ? " selected" : "" ?>>Vše</option>
				<option value="Schváleno"<?= $stav_clanku == "Schváleno" ? " selected" : "" ?>>Schváleno</option>
				<option value="Vráceno z důvodu tematické nevhodnosti"<?= $stav_clanku == "Vráceno z důvodu tematické nevhodnosti" ? " selected" : "" ?>>Vráceno z důvodu tematické nevhodnosti</option>
				<option value="Předáno recenzentům"<?= $stav_clanku == "Předáno recenzentům" ? " selected" : "" ?>>Předáno recenzentům</option>
				<option value="Zamítnuto"<?= $stav_clanku == "Zamítnuto" ? " selected" : "" ?>>Zamítnuto</option>
			</select><br>
		</form>
	</div>
	    
        <div id="myArticles">
<?php
	require("backend/connect.php");
	require("backend/common.php");	
	$sql = "SELECT id_prispevku, titulek, stav FROM prispevek NATURAL JOIN uzivatel";
	
	if(isset($_POST['stav_clanku'])) {
		if($_POST['stav_clanku'] != 'Vše')
			$sql = $sql . " WHERE prispevek.stav='" . $_POST['stav_clanku'] . "'";
	}
		    
	$result = $conn->query($sql);
			
	if ($result->num_rows > 0) {				
		// Výpis článků
		while($row = $result->fetch_assoc()) {
			echo "<div class='articleRow'>
					<a href='clanek.php?id=" .$row["id_prispevku"]."'><div class='clanekRef'>".$row["titulek"]. "</div></a>
					<div class='clanekStav'>" . $row["stav"] . "</div>";
				if($row["stav"] == "Schváleno")
					"<a href='my_article_reviews.php?id=" .$row["id_prispevku"]."'><div class='clanekRecenze'>Recenze</div></a>";
			echo	"</div>";
		}
	} else {
		echo "0 results";
	}
?>
        </div>
    </div>
</body>
</html>
