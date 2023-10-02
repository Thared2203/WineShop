<?php
session_start();

#next line used to reset basket
#$_SESSION["wine"]=array();

print_r($_POST);

if (!isset($_SESSION["basket"])){
    $_SESSION["basket"]=array();#creates basket if not created already!
}


//deal with if already in array
$found=FALSE;
foreach ($_SESSION["basket"] as &$entry){//& allows us to change
    
    if ($entry["WineID"]===$_POST["WineID"]){
        $found=TRUE;
        #increase basket by existing qty
        $entry["qty"]=$entry["qty"]+$_POST["qty"];   
    }
}
#echo($found."<br>");
if ($found===FALSE){
    array_push($_SESSION["basket"],array("WineID"=>$_POST["WineID"],"qty"=>$_POST["qty"]));
}
header('Location: Menu.php')
?>