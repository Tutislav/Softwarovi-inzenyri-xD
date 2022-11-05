<?php
	require("backend/common.php");
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    	<meta charset="UTF-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<title>IT World - přidávání článků</title>
    	<link href="casopis.css" rel="stylesheet">
	<link href="add_article.css" rel="stylesheet">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        		<div class="home"><a href="/"><i class="fa fa-home"></i></a></div>
        	</div>
        	<div class="add_article">
			<h2>Přidávání článků</h2>
            		<form action="backend/add_article.php" method="post" enctype="multipart/form-data">
				<label class="fa fa-font" for="title"></label><input type="text" id="title" name="title" placeholder="Titulek" required><br>
				<label class="fa fa-address-card-o" for="authors"></label><textarea id="authors" name="authors" placeholder="Spoluautoři" required></textarea><br>
                		<label class="fa fa-file-word-o" for="file"></label><input type="file" id="file" name="file" onchange="file_check()" required><br>
				<label for="theme">Téma:</label>
				<select id="theme" name="theme">
					<option value="hardware">Hardware</option>
					<option value="software">Software</option>
					<option value="gaming">Gaming</option>
					<option value="ai">AI</option>
				</select>
				<br>
                		<input type="submit" value="Přidat článek">
            		</form>
        	</div>
    	</div>
	<script>
		function file_check()
		{
			var file = document.getElementById("file");
			var file_dir = file.value;
			var split_array = file_dir.split(".");
			var file_prefix = split_array[1];
			if(file_prefix != "doc" && file_prefix != "docx" && file_prefix != "pdf") 
			{ 
				file.value = "";
				document.getElementById("message").textContent = "Článek musí být ve formátu doc, docx a pdf.";
				$("#message").fadeIn().fadeOut(10000);
			}
		}
	</script>
</body>
</html>