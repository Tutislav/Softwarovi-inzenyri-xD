<?php
    $role_restriction = "redaktor";
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
    <?= $scripts ?>
    <script>
        $(document).ready(function(){
            $("#stav").change(function(){
                if ($("#stav").val() == "Předáno recenzentům") $("#reviewers_select").slideDown();
                else $("#reviewers_select").slideUp();
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

        <br>
        <br>
        
        <?php
        
        require("backend/connect.php");
        $id = $_GET['id'];
        $sql = "SELECT titulek, id_uzivatele FROM prispevek  NATURAL JOIN uzivatel where id_prispevku='$id' ";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {				
            // Výpis článků
            while($row = $result->fetch_assoc()) {
                echo "  Název článku: " .$row['titulek'];
                $user_id = $row['id_uzivatele'];
            }
        }

        $sql = "SELECT id_uzivatele, jmeno, prijmeni FROM uzivatel WHERE role='recenzent';";
        $result = $conn->query($sql);
        $conn->close();
        $reviewers = "";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $reviewers .= "<option value='" . $row["id_uzivatele"] . "'>" . $row["jmeno"] . " " . $row["prijmeni"] . "</option>";
            }
        }
        ?>

        <form action="/backend/redaktor_review.php" method="post">
            <select name="stav" id="stav">
                <option value="Schváleno"<?= $stav_clanku == "Schváleno" ? " selected" : "" ?>>Schválit</option>
				<option value="Vráceno z důvodu tematické nevhodnosti"<?= $stav_clanku == "Vráceno z důvodu tematické nevhodnosti" ? " selected" : "" ?>>Vrátit z důvodu tematické nevhodnosti</option>
				<option value="Předáno recenzentům"<?= $stav_clanku == "Předáno recenzentům" ? " selected" : "" ?>>Předat recenzentům</option>
				<option value="Čeká na doplnění"<?= $stav_clanku == "Čeká na doplnění" ? " selected" : "" ?>>Požádat o doplnění</option>
				<option value="Zamítnuto"<?= $stav_clanku == "Zamítnuto" ? " selected" : "" ?>>Zamítnout</option>
                <option value="Zrecenzováno"<?= $stav_clanku == "Zracenzováno" ? " selected" : "" ?>>Zpřístupnit recenze</option>
            </select><br>
            <span id="reviewers_select" style="display: none;">
                <label for="reviewer1">1.recenzent</label>
                <select name="reviewer1" id="reviewer1"><?= $reviewers ?></select><br>
                <label for="reviewer2">2.recenzent</label>
                <select name="reviewer2" id="reviewer2"><?= $reviewers ?></select><br>
                <label for="deadline">Termín splnění:</label><input type="datetime-local" name="deadline" id="deadline"><br>
            </span>
            <input type="hidden" value="<?= $user_id ?>" id="user_id" name="user_id">
            <input type="hidden" value="<?= $id ?>" id="id" name="id">
            <textarea id="text" name="text" rows="4" cols="50"></textarea><br>
            <input type="submit">
        </form>
	    


    </div>
</body>
</html>


