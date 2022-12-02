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
        $sql = "SELECT titulek, datum_zadani, termin_splneni FROM ukol JOIN prispevek ON prispevek.id_prispevku = ukol.id_prispevku JOIN uzivatel ON ukol.id_uzivatele = uzivatel.id_uzivatele WHERE ukol.splneno = 0 AND uzivatel.email='" . $_SESSION["email"] . "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {	
            while($row = $result->fetch_assoc())
            {
            echo "<div class='article_title'>";
            echo $row["titulek"]."<br>Článek byl zadán: ".$row["datum_zadani"]."<br> Recenze by měla být hotova do: ".$row["termin_splneni"];
            echo "</div>";                
                echo "<div style='display:inline-block;width:500px;height:500px;border: 1px solid black'>";
                    echo "Recenze";
                echo "</div>";
                echo "<div style='inline-block;width:300px;height:500px;border: 1px solid black'>";
                    echo "<div style = 'display:block;width:300px;height:300px;border: 1px solid black'>";
                        echo "informace o autorovi";
                    echo "</div>";
                    echo "<div style = 'display:block;width:300px;height:200px;border: 1px solid black'>";
                        echo "button";
                    echo "</div>"; 
                echo "</div>";
            }
        }else echo "nic nemam";
        ?>
        </div>
    </div>
</body>
</html>
