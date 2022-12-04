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
        <div class="review_form">
        <?php
        require("backend/connect.php");
		$id_ukolu=$_GET["id"];
        $sql = "SELECT titulek, datum_zadani, termin_splneni FROM ukol JOIN prispevek ON prispevek.id_prispevku = ukol.id_prispevku JOIN uzivatel ON ukol.id_uzivatele = uzivatel.id_uzivatele WHERE ukol.splneno = 0 AND uzivatel.email='" . $_SESSION["email"] . "' AND ukol.id_ukolu='".$id_ukolu."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {	
		$row = $result->fetch_assoc();
            //while($row = $result->fetch_assoc()) toto není potřeba
            //{
            echo "<div class='article_title'>";
            echo $row["titulek"]."<br>Článek byl zadán: ".$row["datum_zadani"]."<br> Recenze by měla být hotova do: ".$row["termin_splneni"];
            echo "</div>";
            echo "<div style='padding:25px'>";
			echo "<form action='backend/actual_review.php' method='get'>"; //začátek formuláře
                echo "<div style='float:left;width:500px;height:500px;border: 1px solid black'>";
                    //Recenze
					//zde příjde 4 táhel a textové pole a hidden inputy pro idčka a takový blbosti
					echo "<label for='aktualnost' style='display:block'>Aktualnost: </label>";
					echo "<input type='range' id='aktualnost' name='aktualnost' min='1' max='5' required><br>";
					echo "<label for='originalita' style='display:block'>Originalita: </label>";
					echo "<input type='range' id='originalita' name='originalita' min='1' max='5' required><br>";
					echo "<label for='odborna_u' style='display:block'>Odborná úroveň: </label>";
					echo "<input type='range' id='odborna_u' name='odborna_u' min='1' max='5' required><br>";
					echo "<label for='jazykova_u' style='display:block'>Jazyková úroveň: </label>";
					echo "<input type='range' id='jazykova_u' name='jazykova_u' min='1' max='5' required><br>";
					echo "<textarea id='review' name='review' rows='4' cols='50' placeholder='Zde napište svoji recenzi článku.' required></textarea>";
                echo "</div>";
                echo "<div style='float:left;width:300px;border: 1px solid black'>";
                    echo "<div style='height:300px'>";
                        echo "informace o autorovi";
						//nějaký info o autorovi z databáze
                    echo "</div>";
                    echo "<div style='height:200px;border: 1px solid black'>";
                        echo "<input type='submit' value='Odeslat Recenzi'>";
                    echo "</div>"; 
                echo "</div>";
			echo "</form>"; //konec formuláře
            echo "</div>";
            //} toto patří k "toto není potřeba" (while cyklus)
        }else echo "nic nemam";
        ?>
        </div>
    </div>
</body>
</html>
