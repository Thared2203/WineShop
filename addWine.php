<?php
try{
include_once('connection.php');
array_map("htmlspecialchars", $_POST);

#header('Location:wine.php');
print_r($_POST);
print_r($_FILES["piccy"]["name"]);
$stmt = $conn->prepare("INSERT INTO wine (WineID, WineName, WineCategory, WineDescription, WinePrice, WineStock, Country, piccy)
VALUES 
(null,:WineName,:WineCategory,:WineDescription,:WinePrice,:WineStock,:Country,:Pic)");

$stmt->bindParam(':WineName', $_POST["WineName"]);
$stmt->bindParam(':WineCategory', $_POST["WineCategory"]);
$stmt->bindParam(':WineDescription', $_POST["WineDescription"]);
$stmt->bindParam(':WinePrice', $_POST["WinePrice"]);
$stmt->bindParam(':WineStock', $_POST["WineStock"]);
$stmt->bindParam(':Country', $_POST["Country"]);
$stmt->bindParam(':Pic', $_FILES["piccy"]["name"]);
$stmt->execute();

$target_dir = "images/";
    print_r($_FILES);
    $target_file = $target_dir . basename($_FILES["piccy"]["name"]);
    echo $target_file;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if (move_uploaded_file($_FILES["piccy"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["piccy"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }

header('Location: menu2.php');
}
    catch(PDOException $e)
	    {
		    echo "error".$e->getMessage();
	    }
    $conn=null; 
    ?>