<?php
session_start();
//don't order
include_once('connection.php');
print_r($_SESSION);
foreach  ($_SESSION["basket"] as $entry){
$stmt = $conn->prepare("UPDATE wine SET WineStock=WineStock-:bought WHERE WineID=:wineid");
    $stmt->bindParam(':wineid', $entry["WineID"]);
    $stmt->bindParam(':bought', $entry["qty"]);
    $stmt->execute();
    $stmt->closeCursor(); 

}
     $stmt = $conn->prepare("UPDATE people SET Balance=Balance-:newbalance WHERE PeopleID=:peopleid");
     $stmt->bindParam(':peopleid', $_SESSION["loggedinID"]);
     $stmt->bindParam(':newbalance', $_SESSION["totalcost"]);
     $stmt->execute();
     $stmt->closeCursor();
$conn=null;
unset($_SESSION["wine"]);
header("Location:Menu.php");;
?>