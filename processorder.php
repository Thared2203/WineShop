<?php
//don't order
include_once('connection.php');
$stmt = $conn->prepare("UPDATE wine SET Quantity=Quantity-:bought WHERE WineID=:wineid");
    $stmt->bindParam(':wineid', $entry["wine"]);
    $stmt->bindParam(':bought', $entry["WineStock"]);
    $stmt->execute();
    $stmt->closeCursor(); 


    $stmt = $conn->prepare("UPDATE customer SET Balance=Balance-:newbalance WHERE UserID=:userid");
    $stmt->bindParam(':peopleid', $_SESSION["loggedin"]);
    $stmt->bindParam(':newbalance', $_SESSION["totalcost"]);
    $stmt->execute();
    $stmt->closeCursor(); 
$conn=null;
unset($_SESSION["wine"]);
?>