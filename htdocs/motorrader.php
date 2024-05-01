

<?php
	require("config.php");
    require("common.php");
    
    $conn = new MySQLi($host, $username, $password, $database);
    if ($conn->connect_errno >0){
		echo("<p class='error'>Ein fehler mit der Verbindung ist aufgetreten: " . $conn->connect_error . "</p>");
		die();
	} else{
		// echo("<p class='success'>Verbindung erfolgreich</p>");
	}

    $WHERE = "";
    if (isset($_GET["fMarke"]) && ($_GET["fMarke"] != "")){
            $WHERE = "WHERE Marke LIKE '%".$_GET["fMarke"]."%' ";
    }
    if (isset($_GET["fModell"]) && ($_GET["fModell"] != "") && ($WHERE != "")){
        $WHERE = $WHERE." AND Modell LIKE '%".$_GET["fModell"]."%' ";
    } else if (isset($_GET["fModell"]) && ($_GET["fModell"] != "")){
        $WHERE = "WHERE Modell LIKE '%".$_GET["fModell"]."%' ";
    }


    $sql = "SELECT * FROM tbl_baureihen
            LEFT JOIN tbl_modelle ON tbl_baureihen.FidModell = tbl_modelle.IdModelle
            LEFT JOIN tbl_marken ON tbl_modelle.FIdMarke = tbl_marken.IdMarke ".
            $WHERE." 
            ORDER BY Marke, Modell DESC";

    test($sql);

    $daten = $conn->query($sql);
?>


<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Startseite</title>
</head>    
<body>
    <form action="motorrader.php" method="get">
            Marke
            <input type="text" name="fMarke">
            Modell
            <input type="text" name="fModell">
            <input type="submit" value="Submit" id="fSub">
    </form>
    <?php
        if($daten !==false){
            echo("<ol>");
            while ($db = $daten->fetch_object()){
                echo("<li>");
                echo($db->Marke . " " .  $db->Modell);
                echo("</li>");
            }
            echo("</ol>");
        } else{
            echo("<p class='error'>Keine Daten</p>");
        }
    ?>
</body>
</html>