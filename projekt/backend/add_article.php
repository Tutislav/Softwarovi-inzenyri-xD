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

	//Empty check--------
	if(!empty($title) && !empty($authors) && !empty($file) && !empty($theme))
	{		
		//File--------
		$date = date("y-m-d-h-i-s");
		$file_array = explode(".", $file);
		$file_name = $file_array[0];
		$file_ext = $file_array[1];
		$file_name = $file_name."_".$date.".".$file_ext;

		$file_loc = "../clanky/".$file_name;
		$file_name_temp = $_FILES["file"]["tmp_name"];
		if(move_uploaded_file($file_name_temp, $file_loc)) 
		{ 
			//Insert database prispevek--------
			$insert = "insert into prispevek (id_uzivatele, tematicke_cislo, spoluautori, stav, titulek)
					values ($_SESSION[user_id], '$theme', '$authors', 'Nehodnoceno', '$title')";
			$result = mysqli_query($conn, $insert);
			if($result)
			{
				//Insert database soubor--------
				$last_article_id;
				$select = "select id_prispevku from prispevek";
				$result = mysqli_query($conn, $select);
				if($result)
				{
					foreach($result as $item) { $last_article_id = $item["id_prispevku"]; }
					$last_article_id += 1;
					$insert = "insert into soubor (id_prispevku, soubor_cesta)
							values ($last_article_id, '$file_loc')";
					$result = mysqli_query($conn, $insert);
					if($result)
					{
						echo "Zapsání do databáze souborů bylo úspěšné.";
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