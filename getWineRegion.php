<!DOCTYPE html>
<html>
<head>
  <title>wines</title>
  <link rel="stylesheet" href="styles.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="shortcut icon" href="images/favicon.ico">

</head>
<body>

<?php

$q = $_GET['q'];

//echo($q);
include_once ("connection.php");
if ($q=="All"){
  $stmt = $conn->prepare("SELECT * from wine WHERE WineStock>0 Order by WinePrice DESC" );
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //uses a hidden input which contains the ID of the wine selected
    echo'<form action="addtobasket.php" method="post">';
    echo'The name of the wine is '.$row["WineName"].'. The type of the wine is '.$row["WineCategory"].'. '.$row["WineDescription"].'. This wine is from '.$row["Country"].'. It costs £'.$row["WinePrice"].'. There is a maximum of '.$row["WineStock"].' bottles to be sold.';        
  
    echo"<br>";
    
    echo '<img src="/WineShop/images/' . $row["piccy"] . '"class="WineImage"><br>';
    echo 'How many do you want to buy <input type="number" name="qty" min="0" max="100" value="0"><br>';
    echo '<input type="submit" value="Add Wine"><input type="hidden" name="WineID" value="'.$row['WineID']. '"></form>';
  }
}
else{
 
  $stmt = $conn->prepare("SELECT * from wine WHERE Country =:region and WineStock>0 Order by WinePrice DESC" );
  $stmt->bindParam(':region', $q);
  $stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Uses a hidden input which contains the ID of the wine selected
    echo '<form action="addtobasket.php" method="post">';
    echo 'The name of the wine is '.$row["WineName"] . '. The type of the wine is ' . $row["WineCategory"].'.'. $row["WineDescription"] .'. This wine is from '. $row["Country"].'. It costs £'.$row["WinePrice"].'. There is a maximum of '.$row["WineStock"].' bottles to be sold.'; 
    
    echo"<br>";

    echo '<img src="/WineShop/images/' . $row["piccy"] . '"class="WineImage"><br>';
    echo 'How many do you want to buy <input type="number" name="qty" min="0" max="100" value="0"><br>';
    echo '<input type="submit" value="Add Wine"><input type="hidden" name="WineID" value="' . $row['WineID'] . '"></form>';
    echo"<br>";
  }
}
?>
<?php
include_once('connection.php');

$stmt = $conn->prepare("SELECT * FROM wine");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))

if (isset($_SESSION["wine"])){
	//shows number in basket if basket exists
	echo ("Basket contains ");
	echo count($_SESSION["WineStock"])-1;
	echo (" items<br>");
	echo ("<a href=viewbasket.php>View basket contents</a>");
}
?>

<a href="checkout.php" >Checkout</a>
</body>
</html>