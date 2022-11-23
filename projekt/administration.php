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
    <link rel="stylesheet" href="/css/administration.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#message").fadeIn().fadeOut(10000);
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
                <li id="main"><a href="../">Hlavní menu</a></li>
                <li><a href="/">Správa uživatelů</a></li>
                <li><a href="/">Správa příspěvků</a></li>
            </ul>
        </div>
        <div id="content">
            <h2>Správa uživatelů</h2>
            <div id="innercontent">
                <table>
                    <tr>
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
			
			/*if ($result->num_rows > 0) {				
			     // Výpis uživatelů
				while($row = $result->fetch_assoc()) {
					echo "<tr>"
                                        echo "<th>". $row["id_uzivatele"] . "</th>"
                                        //<th>". $row["jmeno"] . " " . $row["prijmeni"] . "</th>
                                        //<th>". $row["email"] . "</th>
                                        //<th>". $row["role"] . "</th>
                                        echo "<th>Správa</th>"
                                      	echo "</tr>"
			            	}
			            }*/
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
