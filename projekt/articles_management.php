<?php
    $role_restriction = "redaktor";
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
    <?= $scripts ?>
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
	    
	<div id="clankyFilter">
		<form action="" method="POST">
			<label for="stav">Stav:</label>
			<select name="stav_clanku" id="stav">
				<option value="Vše"<?= $stav_clanku == "Vše" ? " selected" : "" ?>>Vše</option>
				<option value="Schváleno"<?= $stav_clanku == "Schváleno" ? " selected" : "" ?>>Schváleno</option>
				<option value="Vráceno z důvodu tematické nevhodnosti"<?= $stav_clanku == "Vráceno z důvodu tematické nevhodnosti" ? " selected" : "" ?>>Vráceno z důvodu tematické nevhodnosti</option>
				<option value="Čeká na doplnění"<?= $stav_clanku == "Čeká na doplnění" ? " selected" : "" ?>>Čeká na doplnění</option>
				<option value="Upraveno autorem"<?= $stav_clanku == "Upraveno autorem" ? " selected" : "" ?>>Upraveno autorem</option>
				<option value="Předáno recenzentům"<?= $stav_clanku == "Předáno recenzentům" ? " selected" : "" ?>>Předáno recenzentům</option>
				<option value="Zamítnuto"<?= $stav_clanku == "Zamítnuto" ? " selected" : "" ?>>Zamítnuto</option>
			</select><br>
		</form>
	</div>
	    
        <div id="myArticles">
		<table>
<?php
	require("backend/connect.php");
	$sql = "SELECT id_prispevku, titulek, stav FROM prispevek NATURAL JOIN uzivatel";
	
	if(isset($_POST['stav_clanku'])) {
		if($_POST['stav_clanku'] != 'Vše')
			$sql = $sql . " WHERE prispevek.stav='" . $_POST['stav_clanku'] . "'";
	}
		    
	$result = $conn->query($sql);
			
	if ($result->num_rows > 0) {				
		
		echo '<tr><th style="width:50%">Titulek</th><th style="width:20">Stav</th><th style="width:15%"></th><th style="width:15%"></th></tr>';
		
		while($row = $result->fetch_assoc()) {
			echo "<tr>
					<td class='clanekRef'><a href='clanek.php?id=" .$row["id_prispevku"]."'>".$row["titulek"]. "</a></td>
					<td class='clanekStav'>" . $row["stav"] . "</td>";
			if($row["stav"] == "Schváleno" || $row["stav"] == "Zrecenzováno"  || $row["stav"] == "Předáno recenzentům"){
				echo "<td class='clanekRecenze'><a href='my_article_reviews.php?id=" .$row["id_prispevku"]."'>Recenze</a></td>";
			} elseif($row["stav"] == "Upraveno autorem"){
				echo "<td class='clanekRecenze'><a href='article_edit_approve.php?id=" .$row["id_prispevku"]."'>Úprava</a></td>";
			} else echo "<td class='clanekRecenze'></td>";
			echo "<td class='clanekRecenze'><a href='redaktor_review.php?id=".$row["id_prispevku"]."'>Spravovat</a>";
			echo	"</td></tr>";
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
