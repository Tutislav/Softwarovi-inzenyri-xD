<?php
	//Session--------
	require("common.php");

	//Connect--------
	require("connect.php");

	//Variables--------
	$title = $_POST["title"];
	$authors = $_POST["authors"];
	$theme = $_POST["theme"];
	$file = $_FILES["file"]["name"];
	$article_id = $_POST["article_id"];

	//Empty check--------
	if(!empty($title) && !empty($authors) && !empty($file) && !empty($theme))
	{		
		//File--------
		$date = date("Y-m-d-H-i-s");
		$file_array = explode(".", $file);
		$file_name = $file_array[0];
		$file_ext = $file_array[1];
		$file_name = $file_name."_".$date.".".$file_ext;

		$file_loc = "../clanky/".$file_name;
		$file_path = "clanky/".$file_name;
		$file_name_temp = $_FILES["file"]["tmp_name"];
		if(move_uploaded_file($file_name_temp, $file_loc)) 
		{ 
			if (isset($_POST["add"])) {
				//Insert database prispevek--------
				$insert = "insert into prispevek (id_uzivatele, tematicke_cislo, spoluautori, stav, titulek)
						values ($_SESSION[user_id], '$theme', '$authors', 'Nehodnoceno', '$title')";
				$result = mysqli_query($conn, $insert);
			}
			else {
				//Update database prispevek
				$update = "UPDATE prispevek SET titulek='$title', tematicke_cislo='$theme', spoluautori='$authors' WHERE id_prispevku='$article_id';";
				$result = mysqli_query($conn, $update);
			}
			if($result)
			{
				//Insert database soubor--------
				if (isset($_POST["add"])) {
					$select = "select id_prispevku from prispevek order by id_prispevku desc limit 1";
					$result = mysqli_query($conn, $select);
				}
				else $result = 1;
				if($result)
				{
					if (isset($_POST["add"])) $last_article_id = mysqli_fetch_assoc($result)["id_prispevku"];
					else $last_article_id = $article_id;
					$insert = "insert into soubor (id_prispevku, soubor_cesta)
							values ($last_article_id, '$file_path')";
					$result = mysqli_query($conn, $insert);
					if($result)
					{
						$_SESSION["message"] = "Přidání příspěvku bylo úspěšné.";
						header("Location: ../index.php");
					}
					else { echo mysqli_error($conn); }
				}	
			}	
			else 
			{ 
				$_SESSION["message"] = "Nepodařilo se zapsat do databáze příspěvků.";
				header("Location: ../add_article.php");
			}
		}
		else 
		{
			$_SESSION["message"] = "Nepodařilo se poslat soubor článku.";
			header("Location: ../add_article.php");
		}	
	}
	else 
	{ 
		$_SESSION["message"] = "Vyplňte všechna políčka.";
		header("Location: ../add_article.php");
	}		
?>