<?php
session_start(); 
if (!isset($_SESSION['loggedinID']))
{   
   $_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html>
<title>Orders</title>
<link rel="stylesheet" href="styles.css">
    
</head>
<body>
<div class="header">

<h1>Previous Orders</h1>

</div>
    
<?php
include_once('connection.php');

#print_r($_SESSION);

	array_map("htmlspecialchars", $_POST);
    //create order
	
    $total=0;
    $stmt = $conn->prepare("SELECT people.Forename as fn, people.Surname as sn, wine.WineName as wn, wine.WinePrice as wp, baskets.Quantity as qty , orders.OrderID as oid 
    FROM  baskets  
    INNER JOIN wine on wine.WineID = baskets.WineID 
    INNER JOIN orders on orders.OrderID = baskets.OrderID
    INNER JOIN people on orders.PeopleID = people.PeopleID ");


	#$stmt = $conn->prepare("SELECT wine.WineName as wn, wine.WinePrice as wp, baskets.Quantity as qty FROM baskets INNER JOIN wine on wine.WineID = baskets.WineID where baskets.OrderID=:orderid");
	#$stmt->bindParam(':orderid', $_POST["OrderID"]);
	$stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
            #print_r($row);
            #echo("<br>");
            $total=$total+($row["qty"]*$row["wp"]);
			echo($row["fn"]. " ".$row["sn"]. " Order number" .$row["oid"]." - " .$row["qty"]." x ".$row["wn"]." for ".$row["wp"]."<br>");
		}
    echo("Total recieved £".number_format($total,2)."<br>");
    
?>
<a href="accounts.php">View users</a>
<a href="menu2.php">Back to menu</a>
</body>
</html>