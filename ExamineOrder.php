<!DOCTYPE html>
<html>
<title>View Order</title>
    
</head>
<body>

<?php
echo ("<h2> Order ".$_POST["OrderID"]." contained the following items</h2>");
session_start();
print_r($_SESSION);
include_once('connection.php');
array_map("htmlspecialchars", $_POST);
$total=0;
    $stmt = $conn->prepare("SELECT wine.WineName as tn, wine.WinePrice as tp, baskets.Quantity as qty FROM baskets INNER JOIN wine on wine.WineID = wine.WineID where wine.OrderID=:orderid");
    $stmt->bindParam(':orderid', $_POST["OrderID"]);
    $stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
    $total=$total+($row["qty"]*$row["tp"]);
        echo($row["qty"]." x ".$row["tn"]." at ".$row["tp"]."<br>");
        }
echo("Total spent £".number_format($total,2)."<br>");

?>

</body>
</html>