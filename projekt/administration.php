<?php
    $role_restriction = "admin";
    require("backend/common.php");
    if(isset($_POST["search"]))
	    $search = $_POST["search"];
    else
	    $search = "";
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
	    var input = $("#search");
    	    var len = input.val().length;
            input[0].focus();
    	    input[0].setSelectionRange(len, len);
		
	    function delay(callback, ms) {
  		var timer = 0;
  		return function() {
   			var context = this, args = arguments;
   			clearTimeout(timer);
    			timer = setTimeout(function () {
      				callback.apply(context, args);
    			}, ms || 0);
  	        };
	    }
		
            $(".manage,.close").click(function(){
                $("#user_" + $(this).parent().parent().children().first().html()).toggle();
                $("#user_" + $(this).parent().parent().children().first().html() + "_manage").toggle();
            });
		
	    $("#search").keyup(delay(function(e){
                $("#searchForm").submit();
            }, 300));
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
                <li id="main"><a href="/"><i class="fa fa-chevron-left"></i>Hlavní stránka</a></li>
		<li>
		    <form action="/administration.php" method="POST">
			<input type="hidden" name="contentChange" value="1">
			<i class="fa fa-user-circle-o"></i>
			<input type="submit" value="Správa uživatelů">			
		    </form>
		</li>
                <li>
		    <form action="/administration.php" method="POST">
			<input type="hidden" name="contentChange" value="2">
			<i class="fa fa-newspaper-o"></i>
			<input type="submit" value="Správa článků">			
		    </form>
		</li>
            </ul>
        </div>
        <div id="content">
                    <?php
                        require("backend/connect.php");
	
			if(isset($_POST["contentChange"]))		
				$content = $_POST["contentChange"];
			else
				$content = 0;

			switch($content){
				case 1:
					
					if($search != "")
						$sql = "SELECT id_uzivatele, jmeno, prijmeni, email, role FROM uzivatel WHERE CAST(id_uzivatele AS varchar(10)) LIKE '" . $search . "%' OR concat(jmeno, ' ', prijmeni) LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%' OR role LIKE '%" . $search . "%'";
					else
						$sql = "SELECT id_uzivatele, jmeno, prijmeni, email, role FROM uzivatel";
					   
					$result = $conn->query($sql);
            				$roles_array = get_roles();
			
					echo "<h2>Správa uživatelů</h2>					
            		     		<div id='innercontent'>
					<form action='administration.php' method='POST' id='searchForm' name='searchForm'>
						<input type='hidden' name='contentChange' value='1'>
						<i class='fa fa-search'></i>	
						<input type='text' name='search' id='search' placeholder='ID/Jméno/Email/Role' value=$search>
					</form>
				  	<table>               
                    			<tr id='tableheader'>
                        			<th id='id'>ID</th>
                        			<th id='name'>Jméno</th>
                        			<th id='email'>Email</th>
                        			<th id='role'>Role</th>
                       				<th id='manage'></th>
                   			</tr>";
					
					if ($result->num_rows > 0) {				
			     			// Výpis uživatelů
						while($row = $result->fetch_assoc()) {
							echo "<tr id='user_" .  $row["id_uzivatele"] . "'>
                                        			<td>". $row["id_uzivatele"] . "</td>
                                        			<td>". $row["jmeno"] . " " . $row["prijmeni"] . "</td>
                                       				<td>". $row["email"] . "</td>
                                        			<td>". $row["role"] . "</td>
                                        			<td><button class='manage'><i class='fa fa-wrench'></i>Spravovat</button></td>
                                      			</tr>";
                  					echo "<tr id='user_" .  $row["id_uzivatele"] . "_manage' style='display: none;'>";
			   				echo "<td>" . $row["id_uzivatele"] . "</td>";
                   					echo "<td><form id='edit_form' action='backend/administration.php' method='post'><input type='hidden' name='user_id' id='user_id' value='" . $row["id_uzivatele"] . "'><input type='text' name='name' id='name' value='" . $row["jmeno"] . "'><input type='text' name='last_name' id='last_name' value='" . $row["prijmeni"] . "'></td>";
                  					echo "<td><input type='email' name='email' id='email' value='" . $row["email"] . "'></td>";
                   					$roles = "";
                   					foreach($roles_array as $role) {
                       						$selected = $row["role"] == $role ? " selected" : "";
                       						$roles .= "<option value='" . $role . "'" . $selected . ">" . $role . "</option>";
                   					}
									$disabled = $row["id_uzivatele"] != $_SESSION["user_id"] ? "" : " disabled";
                   					echo "<td><select name='role' id='role'" . $disabled . ">" . $roles . "</select></td>";
                   					echo "<td><button type='submit' name='edit' id='edit'><i class='fa fa-floppy-o'></i>Uložit</button></form>";
									if ($row["id_uzivatele"] != $_SESSION["user_id"]) {
                   						echo "<form action='backend/administration.php' method='post'><input type='hidden' name='user_id' id='user_id' value='" . $row["id_uzivatele"] . "'><button type='submit' name='delete' id='delete' onclick='return confirm(\"Opravdu chcete smazat tohoto uživatele?\")'><i class='fa fa-trash'></i>Smazat</button></form>";
									}
                   					echo "<button class='close'><i class='fa fa-close'></i>Zavřít</button>";
                   					echo "</td></tr>";
                				}
					}
					echo "</table></div>";
				break;
					
				case 2:					
					if($search != "")
						$sql = "SELECT id_prispevku, titulek, tematicke_cislo, stav FROM prispevek WHERE CAST(id_prispevku AS varchar(10)) LIKE '" . $search . "%' OR titulek LIKE '%" . $search . "%' OR tematicke_cislo LIKE '%" . $search . "%' OR stav LIKE '%" . $search . "%'";
					else
						$sql = "SELECT id_prispevku, titulek, tematicke_cislo, stav FROM prispevek";
					
					$result = $conn->query($sql);
					$themes_array = get_themes();
					
					echo "<h2>Správa článků</h2>
            		      			<div id='innercontent'>
						<form action='administration.php' method='POST' id='searchForm' name='searchForm'>
							<input type='hidden' name='contentChange' value='2'>
							<i class='fa fa-search'></i>	
							<input type='text' name='search' id='search' placeholder='ID/Titulek/Téma/Stav' value=$search>
						</form>
				 		 <table>               
                    					<tr id='tableheader'>
                        					<th id='id'>ID</th>
                        					<th id='title'>Titulek</th>
                        					<th id='theme'>Téma</th>
                        					<th id='state'>Stav</th>
                       						<th id='manage'></th>
                   					</tr>";
					
					if ($result->num_rows > 0) {				
			     			// Výpis článků
						while($row = $result->fetch_assoc()) {
							echo "<tr id='user_" .  $row["id_prispevku"] . "'>
                                        			<td>". $row["id_prispevku"] . "</td>
                                        			<td><a href='clanek.php?id=" .$row["id_prispevku"]."' target='_blank'>". $row["titulek"] . "</a></td>
                                       				<td>". $row["tematicke_cislo"] . "</td>
                                        			<td>". $row["stav"] . "</td>
                                        			<td><button class='manage'><i class='fa fa-wrench'></i>Spravovat</button></td>
                                      			      </tr>";
							echo "<tr id='user_" .  $row["id_prispevku"] . "_manage' style='display: none;'>";
							
			   				echo "<td>" . $row["id_prispevku"] . "</td>";
							
                   					echo "<td><form id='edit_form' action='backend/administration.php' method='post'><input type='hidden' name='article_id' id='article_id' value='" . $row["id_prispevku"] . "'><input type='text' name='title' id='title' value='" . $row["titulek"] . "'></td>";
                  				
                   					$themes = "";
                   					foreach($themes_array as $theme) {
                       						$selected = $row["tematicke_cislo"] == $theme ? " selected" : "";
                       						$themes .= "<option value='" . $theme . "'" . $selected . ">" . $theme . "</option>";
                   					}
                   					echo "<td><select name='theme' id='theme'>" . $themes . "</select></td>";
							
							echo "<td><input type='text' name='state' id='state' value='" . $row["stav"] . "'></td>";
							
                   					echo "<td><button type='submit' name='edit' id='edit'><i class='fa fa-floppy-o'></i>Uložit</button></form>";
                   					echo "<form action='backend/administration.php' method='post'><input type='hidden' name='article_id' id='article_id' value='" . $row["id_prispevku"] . "'><button type='submit' name='delete' id='delete' onclick='return confirm(\"Opravdu chcete smazat tento článek?\")'><i class='fa fa-trash'></i>Smazat</button></form>";
                   					echo "<button class='close'><i class='fa fa-close'></i>Zavřít</button>";
                   					echo "</td></tr>";
						}
						
					}
					echo "</table></div>";
				break;
			}
	
                    ?>
        </div>
    </div>
</body>
</html>
