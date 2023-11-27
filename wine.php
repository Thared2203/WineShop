<?php
session_start();
//print_r($_SESSION);
if($_SESSION["Admin"]!=1){
  header('Location:menu2.php');
  echo ("redirecting");

if($_SESSION["Admin"]=1){
  header('Location:wine.php');
}
}
?>
<!DOCTYPE html>
<html>
<?php
include_once("connection.php");
$stmt = $conn->prepare("INSERT INTO wine (WineID, WineName, WineCategory, WineDescription, WinePrice, WineStock, Country)
VALUES 
(null,:WineName,:WineCtegory,:WineDescription,:WinePrice,:WineStock,:Country)");
?>

<head>
    
    <title>Add Wine</title>
    <link rel="stylesheet" href="styles.css">
    <meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<div class="header">

<h1>Add new Wines</h1>

</div>

<div class="body">
<form action="addWine.php" method="Post" enctype="multipart/form-data">
 
  WineName:<input type="text" name="WineName"><br>
  WineCategory:<input type="text" name="WineCategory"><br>
  WineDescription:<input type="text" name="WineDescription"><br>
  WinePrice:<input type="text" name="WinePrice"><br>
  WineStock:<input type="text" name="WineStock"><br>
  Country:<input type="text" name="Country"><br>
  Image: <input type="file" id="piccy" name="piccy" accept="image/*"><br>
  <input type="submit" value="Add Wine">
</form>
</div>
<?php
include_once('connection.php');

$stmt = $conn->prepare("SELECT * FROM wine ");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
//echo($row["Name"].' '.$row["Cost"].' '.$row["Quantity"]."<br>");
}
?>
</body>
</html>