<?php
    $role_restriction = "autor";
    require("backend/common.php");
    if (isset($_GET["id"])) {
        $review_id = $_GET["id"];
        require("backend/connect.php");
        $sql = "SELECT prispevek.id_uzivatele, jmeno, prijmeni, titulek FROM uzivatel JOIN recenze ON uzivatel.id_uzivatele=recenze.id_recenzenta JOIN prispevek ON recenze.id_prispevku=prispevek.id_prispevku WHERE id_recenze='$review_id';";
        $result = $conn->query($sql);
        $conn->close();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            check_restriction($row["id_uzivatele"]);
            $reviewer_name = $row["jmeno"] . " " . $row["prijmeni"];
            $article_title = $row["titulek"];
        }
    }
    else {
        $_SESSION["message"] = "Recenze neexistuje.";
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
    <script>
        $(document).ready(function(){
            $("#message").fadeIn().fadeOut(10000);
        });
    </script>
</head>
<body>
    <div class="container">
        <div id="login_register">
            <span id="message"><?= $message ?></span>
            <div class="home"><a href="/"><i class="fa fa-home"></i></a></div>
        </div>
        <div class="objection">
		    <h2>Oponentní formulář</h2>
            <form action="backend/review_objection.php" method="POST">
                <p id="reviewer"><i class="fa fa-user"></i>Recenzent: <?= $reviewer_name ?></p>
                <p id="article_title"><i class="fa fa-newspaper-o"></i>Článek: <?= $article_title ?></p><br>
		<label for="text" class="fa fa-commenting"></label><textarea rows="5" placeholder="Námitky" id="text" name="text" required></textarea><br>
                <input type="submit" value="Odeslat">
                <input type="hidden" name="review_id" value="<?= $review_id ?>">
            </form>
        </div>
    </div>
</body>
</html>
