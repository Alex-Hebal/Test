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

    $WHERE = "WHERE TName='".$_GET["Id"]."'";

    $sql = "SELECT * FROM tbl_teile_baureihen
            LEFT JOIN tbl_teile ON tbl_teile_baureihen.FIdTeil = tbl_teile.IdTeil
            LEFT JOIN tbl_Baureihen ON tbl_teile_baureihen.FIdBaureihe = tbl_Baureihen.IDBaureihe
            LEFT JOIN tbl_modelle ON tbl_baureihen.FIdModell = tbl_modelle.IDModelle
            LEFT JOIN tbl_marken ON tbl_modelle.FIdMarke = tbl_marken.IdMarke ".
            $WHERE; 

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
    <?php
        if($daten !==false){
            test($daten);
            echo("Alle Baureihen die dieses Teil enthalten:");
            echo("<ol>");
            while ($db = $daten->fetch_object()){
                test($db);
                echo("<li>");
                echo($db->Modell." ".$db->Marke);
                echo("</li>");
            }
            echo("</ol>");
        } else{
            echo("<p class='error'>Keine Daten</p>");
        }   
    ?>
</body>
</html>