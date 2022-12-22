<?php
    require("backend/common.php");
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archiv - IT World</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://itworld.vorpal.tk/css/main.css">
    <link rel="stylesheet" href="https://itworld.vorpal.tk/css/<?= basename(__FILE__, ".php") ?>.css">
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
        <table class="border_sides">
            <tr>
                <th>Měsíc</th>
                <th>Rok</th>
                <th>Téma</th>
                <th>Akce</th>
            </tr>
            <?php
                require("backend/connect.php");
                $sql = "SELECT datum_vydani, tematicke_cislo, soubor_cesta FROM archiv;";
                $result = $conn->query($sql);
                $conn->close();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $month = date("F", strtotime($row["datum_vydani"]));
                        $year = date("Y", strtotime($row["datum_vydani"]));
                        $thema = $row["tematicke_cislo"];
                        $file_path = $row["soubor_cesta"];
                        $show = "<button onclick='location.href=\"" . $file_path . "\">Zobrazit</button>";
                        echo("<tr>");
                        echo("<td>" . $month . "</td><td>" . $year ."</td><td>" . $thema . "</td><td>" . $show . "</td>");
                        echo("</tr>");
                    }
                }
                else {
                    echo("<tr><td colspan='4'>Žádná vydání</td></tr>");
                }
            ?>
        </table>
    </div>
</body>
</html>