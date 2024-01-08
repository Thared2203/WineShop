<!-- <!DOCTYPE html>
<html>
<title>Wine</title>
    
</head>
<body>
<?php
include_once('connection.php');

if (isset($_SESSION["wine"])){
	//shows number in basket if basket exists
	echo ("Basket contains ");
	echo count($_SESSION["wine"])-1;
	echo (" items<br>");
	echo ("<a href=viewbasket.php>View basket contents</a>");
}

	$stmt = $conn->prepare("SELECT * FROM Wine");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	    {//uses a hidden input which contains the ID of the wine selected
			echo'<form action="addtobasket.php" method="post">';
			echo($row["WineName"].' '.$row["WineCategory"].' '.$row["WineDescription"].' '.$row["Country"].' '.$row["WinePrice"].' '.$row["WineStock"]."<input type='number' name='qty' min='1' max='100' value='1'>
			<input type='submit' value='Add Wine'><input type='hidden' name='WineID' value=".$row['WineID']."><br></form>");
	    }



?>   
<a href="checkout.php">Checkout</a>
</body>
</html> -->