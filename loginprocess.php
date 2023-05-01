<?php
session_start();
include_once ("connection.php");
array_map("htmlspecialchars", $_POST);

header('Location:login.php');

$stmt = $conn->prepare("SELECT * FROM People WHERE Forename =:Forename ;" );

$stmt->bindParam(':Forename', $_POST['Forename']);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{ 
    if($row['Password']==$_POST['Pword']){
        $_SESSION["loggedin"]=$row["UserID"];
        header('Location: menu2.php');
    }else{

        header('Location: login.php');
    }
}
$conn=null; //closes the
?>