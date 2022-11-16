<?php
    require("backend/common.php");
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Správa článků - IT World</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://itworld.vorpal.tk/css/main.css">
    <link rel="stylesheet" href="https://itworld.vorpal.tk/css/my_articles.css">
    <link rel="stylesheet" href="https://itworld.vorpal.tk/css/<?= basename(__FILE__, ".php") ?>.css">
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

        <br>
        <br>
        
        <?php
        
        require("backend/connect.php");

        $sql = "SELECT titulek FROM prispevek where id_prispevku='$_GET[id]'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {				
            // Výpis článků
            while($row = $result->fetch_assoc()) {
                echo "  Název článku: " .$row['titulek'];
            }
        }

        ?>

        <form action="redaktor_review.php" method="get">
            <select name="stav" id="stav">
                <option value="Schváleno"<?= $stav_clanku == "Schváleno" ? " selected" : "" ?>>Schváleno</option>
				<option value="Vráceno z důvodu tematické nevhodnosti"<?= $stav_clanku == "Vráceno z důvodu tematické nevhodnosti" ? " selected" : "" ?>>Vráceno z důvodu tematické nevhodnosti</option>
				<option value="Předáno recenzentům"<?= $stav_clanku == "Předáno recenzentům" ? " selected" : "" ?>>Předáno recenzentům</option>
				<option value="Zamítnuto"<?= $stav_clanku == "Zamítnuto" ? " selected" : "" ?>>Zamítnuto</option>
            </select><br>
            <textarea id="text" rows="4" cols="50"></textarea><br>
            <input type="submit">
        </form>
	    


    </div>
</body>
</html>

<?php 
        $sql = "INSERT INTO vzkazy (id_odesilatele, id_prijemce, vzkaz_text) VALUES ('$user_id', '$redactor_id', '$text');";
        $result = $conn->query($sql);
        $conn->close();
        if ($result) {
            $_SESSION["message"] = "Zpráva byla úspěšně odeslána.";
            header("Location: /clanek.php?id=" . $article_id);
        }
        else {
            $_SESSION["message"] = "Zprávu nelze odeslat.";
            header("Location: /review_objection.php?id=" . $review_id);
        }

        else {
            $_SESSION["message"] = "Recenze neexistuje.";
            header("Location: /review_objection.php?id=" . $review_id);
        }

?>

