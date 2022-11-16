<?php
    require("backend/common.php");
    if (isset($_POST["stav_clanku"])) {
        $stav_clanku = $_POST["stav_clanku"];
    }
    else {
        $stav_clanku = "Vše";
    }
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Správa článků - IT World</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/my_articles.css">
    <link rel="stylesheet" href="/css/<?= basename(__FILE__, ".php") ?>.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#message").fadeIn().fadeOut(10000);
            $("#stav").change(function(){
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
			if($row["stav"] == "Schváleno"){
				echo "<a href='my_article_reviews.php?id=" .$row["id_prispevku"]."'><div class='clanekRecenze'>Recenze</div></a>";
			}
			echo "<a href=''>Zpráva autorovi</a>"
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
