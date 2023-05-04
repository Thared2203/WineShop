<?php
try{
include_once('connection.php');
array_map("htmlspecialchars", $_POST);

header('Location:wine.php');
//print_r($_POST);
$stmt = $conn->prepare("INSERT INTO wine (WineID, WineName, WineCategory, WineDescription, WinePrie, WineStock, Country)VALUES (null,:WineName,:WineCtegory,:WineDescription,:WinePrice,:WineStock,:Country)");

$stmt->bindParam(':WineName', $_POST["WineName"]);
$stmt->bindParam(':WineCategory', $_POST["WineCategory"]);
$stmt->bindParam(':WineDescription', $_POST["WineDescription"]);
$stmt->bindParam(':WinePrice', $_POST["WinePrice"]);
$stmt->bindParam(':WineStock', $_POST["WineStock"]);
$stmt->bindParam(':Country', $_POST["Country"]);
$stmt->execute();

    }
    catch(PDOException $e)
	    {
		    echo "error".$e->getMessage();
	    }
    $conn=null; 
    ?>