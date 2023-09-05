<?php
session_start();

#next line used to reset basket
#$_SESSION["wine"]=array();



if (!isset($_SESSION["wine"])){
$_SESSION["wine"]=array();#creates basket if not created already!
}


//deal with if already in array
$found=FALSE;
foreach ($_SESSION["wine"] as &$entry){//& allows us to change
    
    if ($entry["wine"]===$_POST["WineID"]){
        $found=TRUE;
        #increase basket by existing qty
        $entry["qty"]=$entry["qty"]+$_POST["qty"];   
    }
}
#echo($found."<br>");
if ($found===FALSE){
    array_push($_SESSION["wine"],array("wine"=>$_POST["WineId"],"qty"=>$_POST["qty"]));
}
header('Location: Menu.php')
?>