<?php
session_start();
if(isset($_SESSION['loggedin']))
{
    unset($_SESSION['loggedin']); //logs you out
}
if(isset($_SESSION['wine']))
{
    unset($_SESSION['wine']); //closes your buy page
}
header("Location:menu.php");
?>