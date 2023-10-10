<?php
session_start();
if(isset($_SESSION['loggedinID']))
{
    unset($_SESSION['loggedinID']); //logs you out
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