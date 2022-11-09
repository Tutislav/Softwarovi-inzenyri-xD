<?php
	//Session--------
    	require("backend/common.php");
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oponentní formulář - IT World</title>
    <link href="casopis.css" rel="stylesheet">
	<link href="css/review_objection.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div id="login_register">
            <div class="home"><a href="/"><i class="fa fa-home"></i></a></div>
        </div>
        <div class="objection">
		    <h2>Opononentní formulář</h2>
            <form action="" method="POST">
                <p id="reviewer"><i class="fa fa-user"></i>Recenzent: </p><br>
                <p id="article_title"><i class="fa fa-commenting"></i>Článek: </p><br>
		<label for="text" class="fa fa-commenting"></label><textarea rows="5" placeholder="Námitky" id="text" name="text" required></textarea><br>
                <input type="submit" value="Odeslat">
            </form>
        </div>
    </div>
</body>
</html>
