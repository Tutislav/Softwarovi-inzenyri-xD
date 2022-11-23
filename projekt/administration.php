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
                $("#user_" + $(this).parent().children(":first").val()).slideToggle("slow");
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
			
			if ($result->num_rows > 0) {				
			     // Výpis uživatelů
				while($row = $result->fetch_assoc()) {
					echo "<tr>
                                        	<td>". $row["id_uzivatele"] . "</td>
                                        	<td>". $row["jmeno"] . " " . $row["prijmeni"] . "</td>
                                       		<td>". $row["email"] . "</td>
                                        	<td>". $row["role"] . "</td>
                                        	<td>Správa</td>
                                      	</tr>";
                   echo "<tr id=user_'" .  $row["id_uzivatele"] . "' style='display: none;'>";
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
