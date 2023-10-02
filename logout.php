<?php
session_start();
if(isset($_SESSION['loggedin']))
{
    unset($_SESSION['loggedin']); //logs you out
}
if(isset($_SESSION['basket']))
{
    unset($_SESSION['basket']); //closes your buy page
}
if(isset($_SESSION['wine']))
{
    unset($_SESSION['wine']); //closes your buy page
}
header("Location:menu.php");
?>