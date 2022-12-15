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

			
	
                    ?>            
        </div>
    </div>
</body>
</html>
