<?php
    require("backend/common.php");
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt - IT World</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/<?= basename(__FILE__, ".php") ?>.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?= $scripts ?>
    <script>
        $(document).ready(function(){
            $("#new").click(function(){
                $("#question_form").slideDown();
                $(this).slideUp();
            });
            $("#close").click(function(){
                $("#question_form").slideUp();
                $("#new").slideDown();
            });
            $(".show,.reply").click(function(){
                var question_detail = $("#question_" + $(this).parent().parent().children().first().html() + "_detail");
                question_detail.toggle();
                $("[id$='_detail']").not(question_detail).hide();
            });
            $(".reply").click(function(){
                $("#question_" + $(this).parent().parent().children().first().html() + "_detail .reply_form").toggle();
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
                    <span id="question_form" style="display: none;">
                        <form action="backend/contact.php" method="post">
                            <label class="fa fa-font" for="title"></label>
                            <input type="text" name="title" id="title" placeholder="Titulek" required><br>
                            <label for="text" class="fa fa-commenting"></label>
                            <textarea name="text" id="text" placeholder="Dotaz" required></textarea><br>
                            <button type="submit" name="send" id="send"><i class="fa fa-paper-plane"></i>Odeslat</button>
                            <button id="close"><i class="fa fa-close"></i>Zavřít</button>
                        </form>
                    </span>
                    <button id="new"><i class="fa fa-plus"></i>Nový dotaz</button>
                </td>
            </tr>
            <tr>
                <th>Datum</th>
                <th>Dotaz</th>
                <th>Akce</th>
            </tr>
            <?php
                require("backend/connect.php");
                $sql = "SELECT id_dotazu, datum_odeslani, dotaz_titulek, dotaz_text, dotaz_odpoved, odpovezeno FROM dotaz;";
                $result = $conn->query($sql);
                $conn->close();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $date = date("d.m.y H:i", strtotime($row["datum_odeslani"]));
                        $question_title = $row["dotaz_titulek"];
                        $show = "<button class='show'>Zobrazit</button>";
                        if (!$row["odpovezeno"] && $_SESSION["role"] == "redaktor") {
                            $reply = "<button class='reply' title='Odpovědět'><i class='fa fa-reply'></i></button>";
                        }
                        else {
                            $reply = "";
                        }
                        $question_text = $row["dotaz_text"];
                        if (!$row["odpovezeno"] && $_SESSION["role"] == "redaktor") {
                            $question_reply = "<b>Bez odpovědi</b><br><span id='reply_form' style='display: none;'>
                                <b>Odpověď redaktora:</b><br>
                                <form action='backend/contact.php' method='post'>
                                    <label for='text' class='fa fa-commenting'></label>
                                    <textarea name='text' id='text' placeholder='Odpověď' required></textarea><br>
                                    <input type='hidden' name='question_id' id='question_id' value='" . $row["id_dotazu"] . "'>
                                    <button type='submit' name='reply' id='reply'><i class='fa fa-reply'></i>Odeslat</button>
                                </form></span>";
                        }
                        else {
                            $question_reply = "<b>Odpověď redaktora:</b> " . $row["dotaz_odpoved"];
                        }
                        echo("<tr id='question_" . $row["id_dotazu"] . "'>");
                        echo("<td style='display: none;'>" . $row["id_dotazu"] . "</td>");
                        echo("<td>" . $date . "</td><td>" . $question_title ."</td><td>" . $show . $reply . "</td>");
                        echo("</tr>");
                        echo("<tr id='question_" . $row["id_dotazu"] . "_detail' style='display: none;'>");
                        echo("<td colspan='3'>" . $question_text . "<br>" . $question_reply . "</td>");
                        echo("</tr>");
                    }
                }
                else {
                    echo("<tr><td colspan='3'>Žádné dotazy</td></tr>");
                }
            ?>
        </table>
    </div>
</body>
</html>