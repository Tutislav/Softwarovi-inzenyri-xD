<?php
    $role_restriction = "sefredaktor";
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
	    $("#search").keyup(delay(function(e){
                $("#searchForm").submit();
            }, 300));
		
	    $(".details,.close").click(function(){
                $("#detail_" + $(this).parent().parent().children().first().html() + "_manage").toggle();
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
                <li id="main"><a href="/"><i class="fa fa-chevron-left"></i>Hlavní stránka</a></li>
		<li>
		    <form action="/monitoring.php" method="POST">
			<input type="hidden" name="contentChange" value="1">
			<i class="fa fa-newspaper-o"></i>
			<input type="submit" value="Články">			
		    </form>
		</li>
                <li>
		    <form action="/monitoring.php" method="POST">
			<input type="hidden" name="contentChange" value="2">
			<i class="fa fa-address-card"></i>
			<input type="submit" value="Recenze">			
		    </form>
		</li>
               <li>
		    <form action="/monitoring.php" method="POST">
			<input type="hidden" name="contentChange" value="3">
			<i class="fa fa-calendar-check-o"></i>
			<input type="submit" value="Úkoly">			
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
						$sql = "SELECT id_prispevku, titulek, tematicke_cislo, stav FROM prispevek WHERE CAST(id_prispevku AS varchar(10)) LIKE '" . $search . "%' OR titulek LIKE '%" . $search . "%' OR tematicke_cislo LIKE '%" . $search . "%' OR stav LIKE '%" . $search . "%'";
					else
						$sql = "SELECT id_prispevku, titulek, tematicke_cislo, stav FROM prispevek";
          
					$result = $conn->query($sql);
			
					echo "<h2>Články</h2>					
            		     		<div id='innercontent'>
					<form action='monitoring.php' method='POST' id='searchForm' name='searchForm'>
						<input type='hidden' name='contentChange' value='1'>
						<i class='fa fa-search'></i>	
						<input type='text' name='search' id='search' placeholder='ID/Titulek/Téma/Stav' value=$search>
					</form>
				  	<table>               
                    			<tr id='tableheader'>
                        					<th id='id'>ID</th>
                        					<th id='title'>Titulek</th>
                        					<th id='theme'>Téma</th>
                        					<th id='state'>Stav</th>
                   					</tr>";
					
					if ($result->num_rows > 0) {				
			     			// Výpis článků
						while($row = $result->fetch_assoc()) {
							echo "<tr id='article_" .  $row["id_prispevku"] . "'>
                                        			<td>". $row["id_prispevku"] . "</td>
                                        			<td><a href='clanek.php?id=" .$row["id_prispevku"]."' target='_blank'>". $row["titulek"] . "</a></td>
                                       				<td>". $row["tematicke_cislo"] . "</td>
                                        			<td>". $row["stav"] . "</td>
                                      		</tr>";
						}
					}
					echo "</table></div>";
				break;
				case 2:					
					if($search != "")
						$sql = "SELECT * FROM recenze WHERE CAST(id_recenze AS varchar(10)) LIKE '" . $search . "%' OR recenze_text LIKE '%" . $search . "%'";
					else
						$sql = "SELECT * FROM recenze";
					
					$result = $conn->query($sql);
					
					echo "<h2>Recenze</h2>
            		      			<div id='innercontent'>
						<form action='monitoring.php' method='POST' id='searchForm' name='searchForm'>
							<input type='hidden' name='contentChange' value='2'>
							<i class='fa fa-search'></i>	
							<input type='text' name='search' id='search' placeholder='ID/Text recenze' value=$search>
						</form>
				 		 <table>               
                    					<tr id='tableheader'>
                        					<th id='id_review'>ID</th>
                        					<th id='review_score'>Aktuálnost</th>
                        					<th id='review_score'>Originalita</th>
                        					<th id='review_score'>Odborná úroveň</th>
                       						<th id='review_score'>Jazyková úroveň</th>
                                  				<th id='review_text'>Text recenze</th>
								<th id='details'></th>
                   					</tr>";
					if ($result->num_rows > 0) {				
			     			// Výpis recenzí
						while($row = $result->fetch_assoc()) {
							echo "<tr id='review" .  $row["id_recenze"] . "'>
                                        			<td>". $row["id_recenze"] . "</td>
                                       				<td>". $row["h_aktualnost"] . "</td>
								<td>". $row["h_originalita"] . "</td>
								<td>". $row["h_odborna_uroven"] . "</td>
								<td>". $row["h_jazykova_uroven"] . "</td>
                                        			<td>". $row["recenze_text"] . "</td>
								<td><button class='details'><i class='fa fa-chevron-down'></i>Detaily</button></td>
                                      			      </tr>";
							echo "<tr id='detail_" .  $row["id_recenze"] . "_manage' style='display: none;'><td><div>";
                   					echo "<button class='close'><i class='fa fa-close'></i>Skrýt</button>";
                   					echo "</div></td></tr>";
						}
					}
					echo "</table></div>";
				break;
				case 3:					
					if($search != "")
						$sql = "SELECT * FROM ukol WHERE CAST(id_ukolu AS varchar(10)) LIKE '" . $search . "%' OR ukol_text LIKE '%" . $search . "%' OR datum_zadani LIKE '%" . $search . "%' OR termin_splneni LIKE '%" . $search . "%' OR datum_splneni LIKE '%" . $search . "%'";
					else
						$sql = "SELECT * FROM ukol";
					
					$result = $conn->query($sql);
					
					echo "<h2>Ůkoly</h2>
            		      			<div id='innercontent'>
						<form action='monitoring.php' method='POST' id='searchForm' name='searchForm'>
							<input type='hidden' name='contentChange' value='3'>
							<i class='fa fa-search'></i>	
							<input type='text' name='search' id='search' placeholder='ID/Datum/Úkol text' value=$search>
						</form>
				 		 <table>               
                    					<tr id='tableheader'>
                        					<th id='id_task'>ID</th>
                        					<th id='task_date'>Datum zadání</th>
                        					<th id='task_date'>Termín splnění</th>
                        					<th id='task_date'>Datum splnění</th>
                       						<th id='task_text'>Úkol text</th>
                                  				<th id='task_completed'>Splněno</th>
                   					</tr>";
					if ($result->num_rows > 0) {				
			     			// Výpis recenzí
						while($row = $result->fetch_assoc()) {
							echo "<tr id='review" .  $row["id_recenze"] . "'>
                                        			<td>". $row["id_ukolu"] . "</td>
                                       				<td>". $row["datum_zadani"] . "</td>
								<td>". $row["termin_splneni"] . "</td>
								<td>". $row["datum_splneni"] . "</td>
								<td>". $row["ukol_text"] . "</td>
                                        			<td>". $row["splneno"] . "</td>
                                      		</tr>";
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
