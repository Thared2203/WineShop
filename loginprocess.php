<?php
session_start();
include_once ("connection.php");
array_map("htmlspecialchars", $_POST);
print_r($_SESSION);
//header('Location:login.php');

$stmt = $conn->prepare("SELECT * FROM People WHERE Forename =:Forename" );

$stmt->bindParam(':Forename', $_POST['Forename']);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
$hashed= $row['Password'];
    $attempt= $_POST['Pword'];
    if(password_verify($attempt,$hashed)){
        {
            $_SESSION['loggedinID']=$row["PeopleID"];
            $_SESSION['Admin']=$row["Admin"];
            if (!isset($_SESSION['backURL'])){
                $backURL= "menu.php"; //Sets a default destination if no BackURL set (parent dir)
            }else{
                $backURL=$_SESSION['backURL'];
            }
            unset($_SESSION['backURL']);
            echo $backURL;
            header('Location: ' . $backURL);
        }
     }else{
        header('Location: login.php');
       
    }      
    }

$conn=null;
?>