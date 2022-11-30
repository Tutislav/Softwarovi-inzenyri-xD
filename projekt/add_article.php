<?php
	//Session--------
	$role_restriction = "autor";
	require("backend/common.php");
	if (isset($_GET["id"])) {
		$id = $_GET["id"];
		require("backend/connect.php");
		$sql = "SELECT id_uzivatele, id_prispevku, titulek, spoluautori, tematicke_cislo FROM uzivatel NATURAL JOIN prispevek WHERE id_prispevku='$id';";
		$result = $conn->query($sql);
		$conn->close();
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$article_id = $row["id_prispevku"];
			check_restriction($row["id_uzivatele"]);
			$title = $row["titulek"];
			$authors = $row["spoluautori"];
			$theme = $row["tematicke_cislo"];
		}
	}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? "Upravit článek" : "Přidat článek" ?> - IT World</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/<?= basename(__FILE__, ".php") ?>.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?= $scripts ?>
</head>
<body>
	<div class="container">
        	<div id="login_register">
			<span id="message"><?= $message ?></span>
        		<div class="home"><a href="/"><i class="fa fa-home"></i></a></div>
        	</div>
        	<div class="add_article">
			<h2><?= isset($title) ? "Úprava článků" : "Přidávání článků" ?></h2>
            		<form action="backend/add_article.php" method="post" enctype="multipart/form-data">
				<label class="fa fa-font" for="title"></label><input type="text" id="title" name="title" placeholder="Titulek" value="<?= isset($title) ? $title : "" ?>" required><br>
				<label class="fa fa-address-card-o" for="authors"></label><textarea id="authors" name="authors" placeholder="Autoři" value="<?= isset($authors) ? $authors : "" ?>" required></textarea><br>
                		<label class="fa fa-file-word-o" for="file"></label><input type="file" id="file" name="file" onchange="file_check()" required><br>
				<label for="theme">Téma:</label>
				<select id="theme" name="theme">
					<option value="hardware"<?= isset($theme) && $theme == "hardware" ? " selected" : "" ?>>Hardware</option>
					<option value="software"<?= isset($theme) && $theme == "software" ? " selected" : "" ?>>Software</option>
					<option value="gaming"<?= isset($theme) && $theme == "gaming" ? " selected" : "" ?>>Gaming</option>
					<option value="ai"<?= isset($theme) && $theme == "ai" ? " selected" : "" ?>>AI</option>
				</select>
				<input type="hidden" name="article_id" value="<?= isset($article_id) ? $article_id : "" ?>">
				<br>
                		<input type="submit" name="<?= isset($title) ? "edit" : "add" ?>" value="<?= isset($title) ? "Upravit článek" : "Přidat článek" ?>">
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