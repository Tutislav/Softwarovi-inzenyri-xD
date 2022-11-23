<?php
    require("common.php");

    if (isset($_POST["change_user"])) {
        $change_user_id = $_POST["change_user_id"];
        
        require("connect.php");
        $sql = "SELECT * FROM uzivatel WHERE id_uzivatele='$change_user_id'";
        $result = $conn->query($sql);
        $conn->close();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION["user_id"] = $row["id_uzivatele"];
            $_SESSION["name"] = $row["jmeno"];
            $_SESSION["last_name"] = $row["prijmeni"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["role"] = $row["role"];
            header("Location: /");
        }
    }
?>