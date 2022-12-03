<?php
    require("backend/common.php");
    if (isset($_GET["id"])) {
        $article_id = $_GET["id"];
        require("backend/connect.php");
        $sql = "SELECT prispevek.id_uzivatele, jmeno, prijmeni, titulek FROM uzivatel JOIN prispevek ON uzivatel.id_uzivatele=prispevek.id_uzivatele WHERE id_prispevku='$article_id';";
        $result = $conn->query($sql);
        $conn->close();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            check_restriction($row["id_uzivatele"]);
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
            <div class="home"><a href="/"><i class="fa fa-home"></i></a></div>
        </div>
        <div class="approve">
		    <h2>Schválení změn</h2>
            <form action="backend/" method="POST">
                <p id="author"><i class="fa fa-user"></i>Autor: <?= $reviewer_name ?></p>
                <p id="article_title"><i class="fa fa-newspaper-o"></i>Článek: <?= $article_title ?></p><br>
		            
                <input type="submit" id="approve_submit" value="Schválit změnu">
                <input type="submit" id="disapprove_submit" value="Zamítnout změnu">
                <input type="hidden" name="article_id" value="<?= $article_id ?>">
            </form>
        </div>
    </div>
</body>
</html>
