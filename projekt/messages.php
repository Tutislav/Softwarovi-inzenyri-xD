<?php
    $role_restriction = "autor";
    require("backend/common.php");
    $user_id = $_SESSION["user_id"];
    check_restriction($user_id);
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vzkazy - IT World</title>
    <link href="casopis.css" rel="stylesheet">
    <link href="index.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#message").fadeOut(10000);
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
        <div>
            <?php
                require("backend/connect.php");
                $sql = "SELECT jmeno, prijmeni, vzkaz_text FROM uzivatel JOIN vzkazy ON uzivatel.id_uzivatele=vzkazy.id_odesilatele WHERE id_prijemce='$user_id';";
                $result = $conn->query($sql);
                $conn->close();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $sender_name = $row["jmeno"] + $row["prijmeni"];
                        $message_text = $row["vzkaz_text"];
                        echo("<p>'$sender_name' - '$message_text'</p>");
                    }
                }
                else {
                    echo("Žádné vzkazy");
                }
            ?>
        </div>
    </div>
</body>
</html>