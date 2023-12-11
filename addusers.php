<?php
try{
include_once('connection.php');
array_map("htmlspecialchars", $_POST);

header('Location:users.php');
//print_r($_POST);
$stmt = $conn->prepare("INSERT INTO People (PeopleID,Email,Password,Forename,Surname,TelephoneNumber,Postcode,Address,Balance,Admin)
VALUES 
(null,:Email,:Password,:Forename,:Surname,:TelephoneNumber,:Postcode,:Address,:Balance,:Admin)");

// This allows me to get all the details of the person who is signing up which I can store

$hashed_password = password_hash($_POST["Password"], PASSWORD_DEFAULT); //hashes password for security
$stmt->bindParam(':Email', $_POST["Email"]);
$stmt->bindParam(':Password', $hashed_password);
$stmt->bindParam(':Forename', $_POST["Forename"]);
$stmt->bindParam(':Surname', $_POST["Surname"]);
$stmt->bindParam(':TelephoneNumber', $_POST["TelephoneNumber"]);
$stmt->bindParam(':Postcode', $_POST["Postcode"]);
$stmt->bindParam(':Address', $_POST["Address"]);
$stmt->bindParam(':Balance', $_POST["Balance"]);
$stmt->bindParam(':Admin', $_POST["Admin"]);
$stmt->execute();

}

catch(PDOException $e)
	{
		echo "error".$e->getMessage();
	}
$conn=null;
?>