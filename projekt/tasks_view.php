<?php
    $role_restriction = "redaktor";
    require("backend/common.php");
    $user_id = $_SESSION["user_id"];

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
    <title>Evidence úkolů - IT World</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/<?= basename(__FILE__, ".php") ?>.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?= $scripts ?>
    <script>
        $(document).ready(function(){
            $("#new").click(function(){
                $("#task_form").slideDown();
                $(this).slideUp();
            });
            $("#close").click(function(){
                $("#task_form").slideUp();
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
                    <span id="task_form" style="display: none;">
                        <form action="backend/tasks.php" method="post">
                            <label for="recipient_id" class="fa fa-user" title="Uživatel"></label>
                            <select name="recipient_id" id="recipient_id" required><?= $recipients ?></select><br>
                            <label for="text" class="fa fa-commenting" title="Úkol"></label>
                            <textarea name="text" id="text" placeholder="Úkol" required></textarea><br>
							<label for="deadline" class="fa fa-calendar" title="Termín splnění"></label>
							<input type="datetime-local" name="deadline" id="deadline"><br>
                            <input type="hidden" name="url" id="url" value="<?= $_SERVER["REQUEST_URI"] ?>">
                            <button type="submit" name="add" id="add"><i class="fa fa-plus"></i>Přidat</button>
                            <button id="close"><i class="fa fa-close"></i>Zavřít</button>
                        </form>
                    </span>
                    <button id="new"><i class="fa fa-plus"></i>Nový úkol</button>
                </td>
            </tr>
		<tr>
			<th>Datum zadání</th>
			<th>Termín splnění</th>
			<th>Uživatel</th>
			<th>Úkol</th>
			<th>Splněno</th>
		</tr>
		<?php
			//Select from database--------
			$select = "select ukol.datum_zadani, ukol.termin_splneni, ukol.datum_splneni, uzivatel.jmeno, uzivatel.prijmeni, ukol.ukol_text, ukol.splneno from ukol inner join uzivatel on ukol.id_uzivatele = uzivatel.id_uzivatele";
			$result = mysqli_query($conn, $select);
			if($result)
			{
				foreach($result as $item)
				{
					echo "<tr>";
						echo "<td>";
							echo $item["datum_zadani"];
						echo "</td>";
						echo "<td>";
							echo $item["termin_splneni"];
						echo "</td>";
						echo "<td>";
							echo $item["jmeno"] . " " . $item["prijmeni"];
						echo "</td>";
						echo "<td>";
							echo $item["ukol_text"];
						echo "</td>";
						echo "<td>";
							$finished = $item["splneno"];
							if($finished) { echo $item["datum_splneni"]; }
							else { echo "<span class='fa fa-times'></span>"; }
						echo "</td>";
					echo "</tr>";
				}	
			}
			else { echo "Nastal problém při vypisování z databáze."; }
		?>
	</table>
    </div>
</body>
</html>