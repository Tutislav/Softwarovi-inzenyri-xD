<?php
    require __DIR__ . '/vendor/autoload.php';
    require("common.php");

    require("connect.php");

    if(!empty($_POST["article_checked"])) {
        foreach ($_POST["article_checked"] as $article_id) {
            $sql = "SELECT soubor_cesta FROM prispevek NATURAL JOIN soubor WHERE id_prispevku='$id AND id_souboru=zobrazeny_soubor;";
            $result = $conn->query($sql);
            $file_name = $row["soubor_cesta"];
            $file_array = explode(".", $file_name);
            if ($file_array[1] == "docx" || $file_array[1] == "doc") {
                $file_name_pdf = $file_array[0] . ".pdf";
                Gears\Pdf::convert("../" . $file_name, "../" . $file_name_pdf);
            }
        }
        $_SESSION["message"] = "Podařilo se zveřejnit článek.";
        $conn->close();
    }
    else {
        $_SESSION["message"] = "Nepodařilo se zveřejnit článek.";
    }
?>