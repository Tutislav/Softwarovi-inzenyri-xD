<?php
    require("backend/common.php");
    if (isset($_POST["tematicke_cislo"])) {
        $tematicke_cislo = $_POST["tematicke_cislo"];
    }
    else {
        $tematicke_cislo = "hardware";
    }
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zveřejňování článků - IT World</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/<?= basename(__FILE__, ".php") ?>.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?= $scripts ?>
    <script>
        $(document).ready(function(){
            $("#tema").change(function(){
                $(".border_sides form").submit();
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
                <li class="kontakt"><a href="contact.php">KONTAKT</a></li>
                <li class="helpdesk"><a href="helpdesk.php">HELPDESK</a></li>
            </ul>
        </div>
	<table class="border_sides">
		<tr>
			<td colspan="2">
				<form action="" method="POST">
					<label for="tema">Téma:</label>
					<select name="tematicke_cislo" id="tema">
						<option value="hardware"<?= $tematicke_cislo == "hardware" ? " selected" : "" ?>>Hardware</option>
						<option value="software"<?= $tematicke_cislo == "software" ? " selected" : "" ?>>Software</option>
						<option value="gaming"<?= $tematicke_cislo == "gaming" ? " selected" : "" ?>>Gaming</option>
						<option value="ai"<?= $tematicke_cislo == "ai" ? " selected" : "" ?>>Ai</option>
					</select>
				</form>
			</td>
		</tr>
		<tr>
			<th>Článek</th>
			<th>Zveřejnit</th>
		</tr>
		<?php
			//Database connect--------
			require("backend/connect.php");

			//database select--------
			$select = "select id_prispevku, titulek from prispevek where stav='Schváleno' AND tematicke_cislo='$tematicke_cislo'";
			$result = mysqli_query($conn, $select);
			if($result)
			{
				echo "<form action='/backend/articles_upload.php' method='post'>";
					foreach($result as $item)
					{
						echo "<tr>";
							echo "<td>";
								echo "<a href='../clanek.php?id=".$item["id_prispevku"]."'>".$item["titulek"]."</a></td>";
							echo "</td>";
							echo "<td style='text-align:center'>";
								echo "<input type='checkbox' name='article_checked[".$item["id_prispevku"]."]' value='".$item["id_prispevku"]."' />";
							echo "</td>";
						echo "</tr>";
					}
	echo "</table>";
					echo "<input type='submit' name='submit' value='Zveřejnit' />";
				echo "<input type='hidden' name='theme' id='theme' value='" . $tematicke_cislo . "'>";
				echo "</form>";
			}
			else { echo "0 results ". $recenzent . " - " . $_SESSION["email"]; }
			
		?>
    </div>
</body>
</html>