<?php
    	require("backend/common.php");
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT World</title>
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
    </div>
	<table class="border-sides">
		<tr>
			<th>Datum zadání</th>
			<th>Termín splnění</th>
			<th>Uživatel</th>
			<th>Úkol</th>
			<th>Splněno</th>
		</tr>
		<?php
			//Connect to database--------
			require("backend/connect.php");

			//Select from database--------
			$select = "select ukol.datum_zadani, ukol.termin_splneni, ukol.datum_splneni, uzivatel.jmeno, uzivatel.prijmeni, ukol.ukol_text, ukol.splneno from ukol inner join uzivatel on ukol.id_uzivatele = uzivatel.id_uzivatele";
			$result = mysqli_query($conn, $select);
			if($result)
			{
				foreach($result as $item)
				{
					echo "<tr>";
						echo "<td>";
							echo $item["datum_zadani"];
						echo "</td>";
						echo "<td>";
							echo $item["termin_splneni"];
						echo "</td>";
						echo "<td>";
							echo $item["jmeno"] . " " . $item["prijmeni"];
						echo "</td>";
						echo "<td>";
							echo $item["ukol_text"];
						echo "</td>";
						echo "<td>";
							$finished = $item["splneno"];
							if($finished) { echo $item["datum_splneni"]; }
							else { echo "<span class='fa fa-times'></span>"; }
						echo "</td>";
					echo "</tr>";
				}	
			}
			else { echo "Nastal problém při vypisování z databáze."; }
		?>
	</table>
</body>
</html>