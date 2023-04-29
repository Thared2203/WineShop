<?php
try{
include_once('connection.php');
array_map("htmlspecialchars", $_POST);

header('Location:users.php');
//print_r($_POST);
$stmt = $conn->prepare("INSERT INTO People (PeopleID,Email,Password,Forename,Surname,TelephoneNumber,Postcode,Address,CardNumber,ExpiryDate,Manager)VALUES (null,:Email,:Password,:Forename,:Surname,:TelephoneNumber,:Postcode,:Address,:CardNumber,:ExpiryDate,:Manager)");


$stmt->bindParam(':Email', $_POST["Email"]);
$stmt->bindParam(':Password', $_POST["Password"]);
$stmt->bindParam(':Forename', $_POST["Forename"]);
$stmt->bindParam(':Surname', $_POST["Surname"]);
$stmt->bindParam(':TelephoneNumber', $_POST["TelephoneNumber"]);
$stmt->bindParam(':Postcode', $_POST["Postcode"]);
$stmt->bindParam(':Address', $_POST["Address"]);
$stmt->bindParam(':CardNumber', $_POST["CardNumber"]);
$stmt->bindParam(':ExpiryDate', $_POST["ExpiryDate"]);
$stmt->bindParam(':Manager', $_POST["Manager"]);
$stmt->execute();

    }
    catch(PDOException $e)
	    {
		    echo "error".$e->getMessage();
	    }
    $conn=null; 
    ?>