<?php
    require("../vendor/autoload.php");
    require("common.php");

    require("connect.php");
    if (!empty($_POST["article_checked"])) {
        $theme = $_POST["theme"];
        $files = [];
        foreach ($_POST["article_checked"] as $article_id) {
            $sql = "SELECT soubor_cesta FROM prispevek NATURAL JOIN soubor WHERE id_prispevku='$article_id' AND id_souboru=zobrazeny_soubor;";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $file_name = $row["soubor_cesta"];
                    $file_array = explode(".", $file_name);
                    if ($file_array[1] == "docx" || $file_array[1] == "doc") {
                        $file_name_pdf = $file_array[0] . ".pdf";
                        array_push($files, $file_name_pdf);
                        $pdf = new FPDF();
                        $pdf->AddPage();
                        $pdf->SetFont("Times","",16);
                        // TODO Načíst docx a zapsat ho do PDF
                        $pdf->Output("F", "../" . $file_name_pdf);
                    }
                    else array_push($files, $file_name);
                }
            }
        }
        $pdfmerge = new Jurosh\PDFMerge\PDFMerger();
        foreach ($files as $file) {
            $pdfmerge->addPDF("../" . $file, "all");
        }
        $release_file_name = "clanky/vydani_" . date("Y-m-d-H-i-s") . ".pdf";
        $pdfmerge->merge('file', "../" . $release_file_name);
        $sql = "INSERT INTO archiv (tematicke_cislo, soubor_cesta) VALUES ('$theme', '$release_file_name');";
        $result = $conn->query($sql);
        if ($result) {
            $_SESSION["message"] = "Podařilo se zveřejnit články.";
            header("Location: /archiv.php");
        }
        else {
            $_SESSION["message"] = "Nepodařilo se zveřejnit články.";
            header("Location: /articles_upload.php");
        }
        $conn->close();
    }
    else {
        $_SESSION["message"] = "Nepodařilo se zveřejnit články.";
        header("Location: /articles_upload.php");
    }
?>