<?php
    $role_restriction = "autor";
    require("backend/common.php");
    $user_id = $_SESSION["user_id"];
    check_restriction($user_id);

    require("backend/connect.php");
    $sql = "SELECT id_uzivatele, jmeno, prijmeni, role FROM uzivatel WHERE id_uzivatele!='$user_id';";
    $result = $conn->query($sql);
    $recipients = "";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $recipients .= "<option value='" . $row["id_uzivatele"] . "'>" . $row["jmeno"] . " " . $row["prijmeni"] . " - " . $row["role"] . "</option>";
        }
    }
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vzkazy - IT World</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/<?= basename(__FILE__, ".php") ?>.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?= $scripts ?>
    <script>
        $(document).ready(function(){
            $("#new").click(function(){
                $("#message_form").slideDown();
                $(this).slideUp();
            });
            $("#close").click(function(){
                $("#message_form").slideUp();
                $("#new").slideDown();
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
        <table class="border_sides">
            <tr>
                <td colspan="5">
                    <span id="message_form" style="display: none;">
                        <form action="backend/messages.php" method="post">
                            <label for="recipient_id" class="fa fa-user"></label>
                            <select name="recipient_id" id="recipient_id" required><?= $recipients ?></select><br>
                            <label for="text" class="fa fa-commenting"></label>
                            <textarea name="text" id="text" placeholder="Zpráva" required></textarea><br>
                            <button type="submit" name="send" id="send"><i class="fa fa-paper-plane"></i>Odeslat</button>
                            <button id="close"><i class="fa fa-close"></i>Zavřít</button>
                        </form>
                    </span>
                    <button id="new"><i class="fa fa-plus"></i>Nová zpráva</button>
                </td>
            </tr>
            <tr>
                <th>Datum</th>
                <th>Odesílatel</th>
                <th>Zpráva</th>
                <th>Recenze</th>
                <th>Akce</th>
            </tr>
            <?php
                $sql = "SELECT datum_odeslani, jmeno, prijmeni, vzkaz_text, recenze.id_prispevku, recenze.id_recenze, id_vzkazu, precteno FROM uzivatel JOIN vzkazy ON uzivatel.id_uzivatele=vzkazy.id_odesilatele LEFT JOIN recenze ON vzkazy.id_recenze=recenze.id_recenze WHERE id_prijemce='$user_id';";
                $result = $conn->query($sql);
                $conn->close();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $date = date("d.m.y H:i", strtotime($row["datum_odeslani"]));
                        $sender_name = $row["jmeno"] . " " . $row["prijmeni"];
                        $message_text = $row["vzkaz_text"];
                        if (!empty($row["id_prispevku"])) {
                            $review = "<button onclick='location.href=\"/clanek.php?id=" . $row["id_prispevku"] . "#recenze_" . $row["id_recenze"] . "\"'>Recenze</button>";
                        }
                        else {
                            $review = "";
                        }
                        if ($row["precteno"]) {
                            $read = "<form action='backend/messages.php' method='post'><input type='hidden' name='message_id' id='message_id' value='" . $row["id_vzkazu"] . "'><button type='submit' name='read' id='read' title='Přečteno'><i class='fa fa-check-circle'></i></button></form>";
                        }
                        else {
                            $read = "<form action='backend/messages.php' method='post'><input type='hidden' name='message_id' id='message_id' value='" . $row["id_vzkazu"] . "'><button type='submit' name='read' id='read' title='Přečteno'><i class='fa fa-circle-o'></i></button></form>";
                        }
                        $delete = "<form action='backend/messages.php' method='post'><input type='hidden' name='message_id' id='message_id' value='" . $row["id_vzkazu"] . "'><button type='submit' name='delete' id='delete' title='Smazat'><i class='fa fa-trash'></i></button></form>";
                        echo("<tr>");
                        echo("<td>" . $date . "</td><td>" . $sender_name ."</td><td>" . $message_text . "</td><td>" . $review . "</td><td>" . $read . $delete . "</td>");
                        echo("</tr>");
                    }
                }
                else {
                    echo("<tr><td colspan='3'>Žádné vzkazy</td></tr>");
                }
            ?>
        </table>
    </div>
</body>
</html>