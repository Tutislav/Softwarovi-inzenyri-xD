<?php
    $role_restriction = "administrator";
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
    <link rel="stylesheet" href="/css/administration.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?= $scripts ?>
    <script>
        $(document).ready(function(){
            $(".manage").click(function(){
                $("#user_" + $(this).parent().parent().children().first().html()).slideToggle("slow");
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
        <div id="navigationMenu">
            <ul> 
                <li id="main"><a href="/"><i class="fa fa-chevron-left"></i>Hlavní menu</a></li>
		<li><a href="/administration.php"><i class="fa fa-user-circle-o"></i>Správa uživatelů</a></li>
                <li><a href="/dministration.php"><i class="fa fa-newspaper-o"></i>Správa článků</a></li>
            </ul>
        </div>
        <div id="content">
            <h2>Správa uživatelů</h2>
            <div id="innercontent">
                <table>
                    <tr id="tableheader">
                        <th id="id">ID</th>
                        <th id="name">Jméno</th>
                        <th id="email">Email</th>
                        <th id="role">Role</th>
                        <th id="manage"></th>
                    </tr>
                    <?php
                        require("backend/connect.php");
			
			$sql = "SELECT id_uzivatele, jmeno, prijmeni, email, role FROM uzivatel";
			$result = $conn->query($sql);
            $roles_array = get_roles();
			if ($result->num_rows > 0) {				
			     // Výpis uživatelů
				while($row = $result->fetch_assoc()) {
					echo "<tr>
                                        	<td>". $row["id_uzivatele"] . "</td>
                                        	<td>". $row["jmeno"] . " " . $row["prijmeni"] . "</td>
                                       		<td>". $row["email"] . "</td>
                                        	<td>". $row["role"] . "</td>
                                        	<td><button class='manage'><i class='fa fa-wrench'>Spravovat</button></td>
                                      	</tr>";
                   echo "<tr id='user_" .  $row["id_uzivatele"] . "' style='display: none;'>";
                   echo "<td><form action='backend/administration.php' method='post'><input type='hidden' name='user_id' id='user_id' value='" . $row["id_uzivatele"] . "'><button type='submit' name='delete' id='delete' title='Smazat' onsubmit='return confirm(\"Opravdu chcete smazat tohoto uživatele?\")'><i class='fa fa-trash'></i></button></form></td>";
                   echo "<td><form action='backend/administration.php' method='post'><input type='hidden' name='user_id' id='user_id' value='" . $row["id_uzivatele"] . "'><input type='text' name='name' id='name' value='" . $row["jmeno"] . "'><input type='text' name='lastname' id='lastname' value='" . $row["prijmeni"] . "'></td>";
                   echo "<td><input type='email' name='email' id='email' value='" . $row["email"] . "'></td>";
                   $roles = "";
                   foreach($roles_array as $role) {
                       $selected = $row["role"] == $role ? " selected" : "";
                       $roles .= "<option value='" . $role . "'" . $selected . ">" . $role . "</option>";
                   }
                   echo "<td><select name='role' id='role'>" . $roles . "</select></td>";
                   echo "<td><button type='submit' name='edit' id='edit'><i class='fa fa-floppy-o'></i>Uložit</button></form></td>";
                   echo "</tr>";
                }
			}
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
