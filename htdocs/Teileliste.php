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

    $sql = "SELECT * FROM tbl_teile
            ORDER BY TName DESC";

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
            echo("<ul>");
            while ($db = $daten->fetch_object()){
                test($db);
                echo("<li>");
                echo("<a href=teile_bestimmt.php?Id=".str_replace(" ", "%20", $db->TName).">".$db->TName."</a>");
                echo("</li>");
            }
            echo("</ul>");
        } else{
            echo("<p class='error'>Keine Daten</p>");
        }        
    ?>
</body>
</html>