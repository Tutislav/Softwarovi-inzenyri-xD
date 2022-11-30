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
                <li class="kontakt"><a href="">KONTAKT</a></li>
                <li class="helpdesk"><a href="">HELPDESK</a></li>
            </ul>
        </div>
	<table class="border_sides">
		<tr>
			<th>Článek</th>
			<th>Zveřejnit</th>
		</tr>
		<?php
			//Database connect--------
			require("backend/connect.php");

			//database select--------
			$select = "select id_prispevku, titulek from prispevek where stav='Schváleno'";
			$result = mysqli_query($conn, $select);
			if($result)
			{
				foreach($result as $item)
				{
					echo "<tr>";
						echo "<td class='clanekTitle'>";
							echo "<a href='../clanek.php?id=".$item["id_prispevku"]."'>".$item["titulek"]."</a></td>";
						echo "</td>";
						echo "<td>";
							echo "<input type='checkbox'>";
						echo "</td>";
					echo "</tr>";
				}
			}
			else { echo "0 results ". $recenzent . " - " . $_SESSION["email"]; }
			
		?>
	</table>
	<button onclick="location.href='/backend/articles_upload.php'">Zveřejnit</button>
	
    </div>
</body>
</html>