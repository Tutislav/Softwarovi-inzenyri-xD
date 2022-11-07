<?php
    require("backend/common.php");
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Článek</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="../casopis.css" rel="stylesheet">
	<link href="clanek.css" rel="stylesheet">
	
	<script>
		$(document).ready(function(){
			$("#kontakt").appendTo("#autor");
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
                    <li><a href="../">ÚVOD</a></li>
                    <li><a href="clanky.php">ČLÁNKY</a></li>
                    <li><a href="">ARCHIV</a></li>
                    <li class="kontakt"><a href="">KONTAKT</a></li>
                    <li class="helpdesk"><a href="">HELPDESK</a></li>
                </ul>
        </div>

        <div id="clanekText">
<?php
	function read_file_docx($filename){  
		$striped_content = '';  
		$content = '';  
		if(!$filename || !file_exists($filename)) return false;  
		$zip = zip_open($filename);  
		if (!$zip || is_numeric($zip)) return false;  
		while ($zip_entry = zip_read($zip)) {  
			if (zip_entry_open($zip, $zip_entry) == FALSE) continue;  
			if (zip_entry_name($zip_entry) != "word/document.xml") continue;  
			$content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));  
			zip_entry_close($zip_entry);  
		} 
		zip_close($zip);  
		$content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);   		
		$content = str_replace('</w:r></w:p>', "\r\n", $content);  	
		$content = str_replace('<w:br/>', "\r\n", $content);  
		$striped_content = strip_tags($content);
		$striped_content = html_entity_decode($striped_content);
		return $striped_content;  
	}  
	$id = $_GET["id"];
    require("connect.php");
    $sql = "SELECT id_uzivatele, soubor_cesta, datum_nahrani, stav FROM uzivatel NATURAL JOIN prispevek NATURAL JOIN soubor WHERE id_prispevku=" . $id . " ORDER BY datum_nahrani DESC";
    $result = $conn->query($sql);
    $conn->close();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        check_restriction($row);
        $filename = $row["soubor_cesta"];
        $content = read_file_docx($filename);
        if($content)
            print nl2br($content);
    }
?>
        </div>
    </div>
</body>
</html>
