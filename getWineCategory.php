<!DOCTYPE html>
<html>
<head>
<title>wines</title>
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

echo($q);
include_once ("connection.php");
if ($q=="All"){
  $stmt = $conn->prepare("SELECT * from wine Order by WinePrice asc" );

  
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {//uses a hidden input which contains the ID of the wine selected
        echo'<form action="addtobasket.php" method="post">';
        echo('The name of the wine is '.$row["WineName"].'. The type of the wine is '.$row["WineCategory"].'. '.$row["WineDescription"].'. This wine is from '.$row["Country"].'. It costs £'.$row["WinePrice"].'. There is a maximum of '.$row["WineStock"].' bottles to be sold.'.' How many do you want to buy '."<input type='number' name='qty' min='0' max='100' value='0'>
        <input type='submit' value='Add Wine'><input type='hidden' name='WineID' value=".$row['WineID']."><br></form>");
        }
      }
else{
$stmt = $conn->prepare("SELECT * from wine where WineCategory =:category and WineStock>0" );

$stmt->bindParam(':category', $q);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	    {//uses a hidden input which contains the ID of the wine selected
			echo'<form action="addtobasket.php" method="post">';
			echo('The name of the wine is '.$row["WineName"].'. The type of the wine is '.$row["WineCategory"].'. '.$row["WineDescription"].'. This wine is from '.$row["Country"].'. It costs £'.$row["WinePrice"].'. There is a maximum of '.$row["WineStock"].' bottles to be sold.'.' How many do you want to buy '."<input type='number' name='qty' min='0' max='100' value='0'>
      <input type='submit' value='Add Wine'><input type='hidden' name='WineID' value=".$row['WineID']."><br></form>");
	    }
    }
$conn=null;


?>
</body>
</html>