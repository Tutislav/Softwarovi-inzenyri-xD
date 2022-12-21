<?php
    $role_restriction = "redaktor";
    require("backend/common.php");
    if (isset($_GET["id"])) {
        $article_id = $_GET["id"];
        require("backend/connect.php");
        $sql = "SELECT prispevek.id_uzivatele, jmeno, prijmeni, titulek FROM uzivatel JOIN prispevek ON uzivatel.id_uzivatele=prispevek.id_uzivatele WHERE id_prispevku='$article_id';";
        $result = $conn->query($sql);
	$sql2 = "SELECT id_souboru FROM soubor WHERE id_prispevku='$article_id';";
        $result2 = $conn->query($sql2);
        $conn->close();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $author_name = $row["jmeno"] . " " . $row["prijmeni"];
            $article_title = $row["titulek"];
        }
    }
    else {
        $_SESSION["message"] = "Příspěvek neexistuje.";
        header("Location: /");
    }
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oponentní formulář - IT World</title>
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
	<?php
	if($result2->num_rows > 0) {
            $row=$result2->fetch_assoc();
		$puvodni=$row["id_souboru"];
        }
	  if($result2->num_rows > 0) {
            $row=$result2->fetch_assoc();
		$upraveny=$row["id_souboru"];
        }
	?>
        <div class="approve">
		    <h2>Schválení změn</h2>
            <form action="backend/" method="POST">
                <p id="author"><i class="fa fa-user"></i>Autor: <?= $author_name ?></p>
                <p id="article_title"><i class="fa fa-newspaper-o"></i>Článek: <?= $article_title ?></p><br>
		<p id="article_file"><i class="fa fa-file-word-o"></i>Původní Článek: <?php echo "<a href="."https://itworld-dev.vorpal.tk/clanek.php?id=".$article_id."&sid=".$puvodni."></a>";?></p><br>   
		<p id="article_file"><i class="fa fa-file-word-o"></i>Upravený Článek: <?php echo "<a href="."https://itworld-dev.vorpal.tk/clanek.php?id=".$article_id."&sid=".$upraveny."></a>";?></p><br>        
                <input type="submit" id="approve_submit" value="Schválit změnu">
                <input type="submit" id="disapprove_submit" value="Zamítnout změnu">
                <input type="hidden" name="article_id" value="<?= $article_id ?>">
            </form>
        </div>
    </div>
</body>
</html>
