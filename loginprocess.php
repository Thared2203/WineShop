<?php
session_start();
include_once ("connection.php");
array_map("htmlspecialchars", $_POST);

//header('Location:login.php');

$stmt = $conn->prepare("SELECT * FROM People WHERE Forename =:Forename ;" );

$stmt->bindParam(':Forename', $_POST['Forename']);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
$hashed= $row['Password'];
    $attempt= $_POST['Pword'];
    if(password_verify($attempt,$hashed)){
        echo("login successful");
        $_SESSION['loggedinID']=$row["UserID"];
        $_SESSION['Admin']=$row["Admin"];
        header('Location: menu.php');

        }else{
            header('Location: login.php');
        }
    }
$conn=null;
?>